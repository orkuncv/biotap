<?php
/**
 * Nova Theme - Vivid CLI Tool
 *
 * @author  Movve - https://movve.nl
 * @package Nova/Vivid
 * @since   1.0.0
 */

class KickstartCommand extends AbstractCommand {

	// Project details
	protected string $projectName;
	protected string $projectBaseDir;
	protected string $projectFullPath;

	// .env details
	protected string $dbName;
	protected string $dbUser;
	protected string $dbPassword;
	protected string $wpHome;

	// Salts
	protected string $nvSyncApiUser = 'api_user_placeholder';
	protected string $nvSyncApiToken;
	protected string $wpCacheKeySalt;

	// Command State
	protected bool $runningAsExisting = false;
	protected bool $skipEnvSetup = false;

	// Temporary installation directory
	const TEMP_INSTALL_DIR = 'temp-nova-kickstart';

	/**
	 * Get the name of the command.
	 *
	 * @return string The name of the command.
	 */
	public function getName(): string {
		return 'kickstart';
	}

	/**
	 * Get the description of the command.
	 *
	 * @return string The description of the command.
	 */
	public function getDescription(): string {
		return 'Sets up a new Bedrock project in the current directory with Nova defaults, or updates an existing one.';
	}

	/**
	 * Get the options help for the command.
	 *
	 * @return array The options help for the command.
	 */
	public function getOptionsHelp(): array {
		return [
			[ 'option'      => '--existing',
			  'description' => 'Run the command on an existing project, preserving specific files/directories.'
			],
			[ 'option'      => '--no-env',
			  'description' => 'Skip all .env file interaction (questions, creation, modification) and related environment configuration. Useful for CI/CD.'
			],
		];
	}

	/**
	 * Execute the command.
	 *
	 * @param array $options The options passed to the command.
	 *
	 * @return int The exit code of the command.
	 */
	public function execute( array $options ): int {
		$this->projectBaseDir  = getcwd();
		$this->projectFullPath = $this->projectBaseDir;
		$this->projectName     = $options['project-name'] ?? basename( $this->projectFullPath );

		$this->runningAsExisting = isset( $options['args'][0] ) && $options['args'][0] === '--existing';
		$this->skipEnvSetup      = isset( $options['args'][1] ) && $options['args'][1] === '--no-env';

		if ( $this->runningAsExisting ) {
			$this->output( "Running in --existing mode. Specific files will be preserved.", 'info' );
		}
		if ( $this->skipEnvSetup ) {
			$this->output( "Running with --no-env. .env interaction and environment configuration will be skipped.", 'info' );
		}

		$this->output( "Script will be executed in directory: " . $this->projectFullPath, 'info' );
		$this->output( "Default project name: " . $this->projectName, 'info' );

		if ( ! $this->runningAsExisting && ! $this->skipEnvSetup
		     && // Only warn if we might overwrite .env
		     ( file_exists( $this->projectFullPath . '/.env' )
		       || file_exists( $this->projectFullPath . '/web/wp-config.php' )
		       || file_exists( $this->projectFullPath . '/wp-config.php' ) ) ) {
			$this->output( "WARNING: It seems like this directory already contains a WordPress installation.", 'warning' );
			$confirm = $this->ask( "This script might overwrite existing files (including .env). Consider using --existing or --no-env flags if this is intended. Continue? (yes/no)", "no" );
			if ( strtolower( $confirm ) !== 'yes' ) {
				$this->output( "Installation cancelled.", 'info' );

				return 0;
			}
		}

		// --- Start Setup ---
		$this->output( "Start setup...", 'info' );
		if ( ! $this->skipEnvSetup ) {
			if ( ! $this->collectEnvDetails( $options ) ) {
				return 1;
			}
		} else {
			$this->output( "Skipping .env details collection due to --no-env flag.", 'info' );
			$this->dbName         = $this->dbName ?? '[NOT_SET_BY_SCRIPT]';
			$this->dbUser         = $this->dbUser ?? '[NOT_SET_BY_SCRIPT]';
			$this->dbPassword     = $this->dbPassword ?? '';
			$this->wpHome         = $this->wpHome ?? '[NOT_SET_BY_SCRIPT]';
			$this->nvSyncApiToken = $this->nvSyncApiToken ?? '[NOT_SET_BY_SCRIPT]';
			$this->wpCacheKeySalt = $this->wpCacheKeySalt ?? '[NOT_SET_BY_SCRIPT]';
		}

		// --- Step 1: Download Bedrock ---
		$this->output( "\n--- Step 1: Download Bedrock ---", 'info' );
		if ( file_exists( self::TEMP_INSTALL_DIR ) ) {
			$this->output( "Temporary directory '" . self::TEMP_INSTALL_DIR . "' already exists. Attempting to remove it.", 'warning' );
			if ( ! $this->executeShellCommand( "rm -rf " . escapeshellarg( self::TEMP_INSTALL_DIR ), "could not remove temporary directory" ) ) {
				return 1;
			}
		}

		if ( ! $this->executeShellCommand( "composer create-project roots/bedrock " . escapeshellarg( self::TEMP_INSTALL_DIR ), "Could not download Bedrock" ) ) {
			return 1;
		}

		// --- Step 2: Copy Bedrock files to project directory ---
		$this->output( "\n--- Step 2: Copy Bedrock files to project directory: {$this->projectFullPath} ---", 'info' );
		if ( ! $this->copyBedrockFiles() ) {
			// Cleanup might be needed even on failure
			if ( is_dir( self::TEMP_INSTALL_DIR ) ) {
				$this->executeShellCommand( "rm -rf " . escapeshellarg( self::TEMP_INSTALL_DIR ), "Attempting to remove temporary directory after failed copy" );
			}

			return 1;
		}

		if ( ! chdir( $this->projectFullPath ) ) {
			$this->output( "Could not change to project directory: {$this->projectFullPath}", 'error' );

			return 1;
		}
		$this->output( "Current working directory: " . getcwd(), 'info' );

		// --- Step 3: Create/Update .env file ---
		if ( ! $this->skipEnvSetup ) {
			$this->output( "\n--- Step 3: Create/Update .env file ---", 'info' );
			if ( ! $this->setupEnvFile() ) {
				// If setupEnvFile returns false because user chose not to overwrite, it's not a fatal error for the script.
				// However, if copying failed, it is fatal. setupEnvFile returns false on copy failure.
				if ( ! file_exists( $this->projectFullPath . '/.env' ) ) {
					$this->output( "Failed to create .env file.", 'error' );

					return 1;
				}
			}
		} else {
			$this->output( "\n--- Step 3: Skipped .env file setup (--no-env) ---", 'info' );
		}

		// --- Step 4: Configure .env variables ---
		if ( ! $this->skipEnvSetup ) {
			if ( file_exists( $this->projectFullPath . '/.env' ) ) {
				$this->output( "\n--- Step 4: Configure .env variables ---", 'info' );
				if ( ! $this->configureEnvVariables() ) {
					return 1;
				}
			} else {
				$this->output( "\n--- Step 4: Skipped configuring .env variables (.env not found or creation skipped) ---", 'info' );
			}
		} else {
			$this->output( "\n--- Step 4: Skipped .env variable configuration (--no-env) ---", 'info' );
		}

		// --- Step 5: Add environment constants to config/environments ---
		if ( ! $this->skipEnvSetup ) {
			if ( is_dir( $this->projectFullPath . '/config/environments' ) ) {
				$this->output( "\n--- Step 5: Add environment constants to config/environments ---", 'info' );
				$this->setupEnvironmentConfigs();
			} else {
				$this->output( "\n--- Step 5: Skipped adding environment constants (config/environments directory not found) ---", 'info' );
			}
		} else {
			$this->output( "\n--- Step 5: Skipped adding environment constants to config/environments (--no-env) ---", 'info' );
		}

		$this->output( "\n--- Setup complete! ---", 'success' );
		$this->output( "Installation completed in the following directory: " . $this->projectFullPath, 'info' );

		if ( ! $this->skipEnvSetup ) {
			$this->output( "Do not forget to check/change placeholders in config/environments/*.php for constant: NV_SYNC_API_USER.", 'warning' );
			$this->output( "Be sure to check the database '{$this->dbName}' exists and is accessible with user '{$this->dbUser}'.", 'warning' );
		} else {
			$this->output( "Environment configuration was skipped due to --no-env. Ensure your .env and config/environments/*.php files are set up manually if needed.", 'warning' );
		}

		$this->output( "Continue with the README.", 'info' );

		return 0;
	}


	/**
	 * Fetch WordPress salts from the API.
	 *
	 * @return array The fetched salts.
	 */
	protected function fetchWordPressSalts(): array {
		$this->output( "Fetching WordPress salts from api.wordpress.org...", 'info' );
		$saltContent = @file_get_contents( 'https://api.wordpress.org/secret-key/1.1/salt/' );
		if ( $saltContent === false ) {
			$this->output( "Could not fetch salts from api.wordpress.org. Check your internet connection.", 'error' );
			$this->output( "Salts will not be added to .env. Please add them manually.", 'warning' );

			return [];
		}

		$salts = [];
		preg_match_all( "/define\('(.*?)', *'(.*?)'\);/", $saltContent, $matches );
		if ( isset( $matches[1] ) && isset( $matches[2] ) ) {
			for ( $i = 0; $i < count( $matches[1] ); $i ++ ) {
				$salts[ $matches[1][ $i ] ] = $matches[2][ $i ];
			}
		}
		if ( count( $salts ) < 8 ) {
			$this->output( "Not all salts were fetched. Please check the .env file manually.", 'warning' );
		} else {
			$this->output( "WordPress salts fetched successfully.", 'success' );
		}

		return $salts;
	}

	/**
	 * Collect environment details from the user.
	 * This method should not be called if --no-env is active.
	 *
	 * @param array $options The options passed to the command.
	 *
	 * @return bool True on success, false on failure.
	 */
	protected function collectEnvDetails( array $options ): bool {
		$this->output( "Collecting .env details...", 'info' );

		$existingEnv = [];
		if ( $this->runningAsExisting && file_exists( $this->projectFullPath . '/.env' ) ) {
			$envContent = file_get_contents( $this->projectFullPath . '/.env' );
			if ( $envContent ) {
				preg_match_all( '/^\s*([^#\s=]+)\s*=\s*(.*?)?\s*$/m', $envContent, $matches, PREG_SET_ORDER );
				foreach ( $matches as $match ) {
					$value = trim( $match[2] );
					if ( preg_match( '/^(\'(.*)\'|"(.*)")$/', $value, $quoteMatches ) ) {
						$value = $quoteMatches[2] !== '' ? $quoteMatches[2] : $quoteMatches[3];
					}
					$existingEnv[ $match[1] ] = $value;
				}
				$this->output( "Found existing .env file. Using values as defaults.", 'info' );
			}
		}

		// DB_NAME
		$this->dbName = $options['db-name'] ?? $this->ask( "Database name (DB_NAME)", $existingEnv['DB_NAME'] ?? null );
		if ( empty( $this->dbName ) ) {
			if ( ! isset( $existingEnv['DB_NAME'] ) ) {
				// If ask() returned empty and there's no existing default, this is a problem in CI.
				$this->output( "Database name (DB_NAME) is required but was not provided (and no default/existing value found). If running in CI, ensure --no-env is used and correctly processed by the calling script.", 'error' );
				return false; // Exit the function, indicating failure
			} else {
				// Use the existing value if the initial ask (which might have a different default) returned empty
				$this->output( "Database name was empty after initial prompt, using existing value '{$existingEnv['DB_NAME']}'.", 'warning' );
				$this->dbName = $existingEnv['DB_NAME'];
			}
		}

		$this->dbUser     = $options['db-user'] ?? $this->ask( "Database user (DB_USER)", $existingEnv['DB_USER'] ?? "root" );
		// DB_PASSWORD can be empty, so no strict check here.
		$this->dbPassword = $options['db-password'] ?? $this->ask( "Database password (DB_PASSWORD)", $existingEnv['DB_PASSWORD'] ?? "" );

		$defaultHome  = $existingEnv['WP_HOME'] ?? "https://{$this->projectName}.test";
		$defaultHome  = $options['wp-home'] ?? $defaultHome;
		$this->wpHome = $this->ask( "Local development URL (WP_HOME)", $defaultHome );
		if (empty($this->wpHome)) { // WP_HOME is generally required
			$this->output("Local development URL (WP_HOME) is required but was not provided. If running in CI, ensure --no-env is used.", 'error');
			return false;
		}


		$this->output( "Collecting SALTS...", 'info' );
		$this->output( "For NV_SYNC_API_USER, copy an Env Format SALT from https://roots.io/salts.html", 'info' );

		// NV_SYNC_API_TOKEN
		$this->nvSyncApiToken = $options['nv-sync-token'] ?? $this->ask( "paste the NV_SYNC_API_TOKEN SALT here", $existingEnv['NV_SYNC_API_TOKEN'] ?? null );
		if ( empty( $this->nvSyncApiToken ) ) {
			if ( ! isset( $existingEnv['NV_SYNC_API_TOKEN'] ) ) {
				$this->output( "NV_SYNC_API_TOKEN is required but was not provided. If running in CI, ensure --no-env is used.", 'error' );
				return false;
			} else {
				$this->output( "NV_SYNC_API_TOKEN was empty after initial prompt, using existing value.", 'warning' );
				$this->nvSyncApiToken = $existingEnv['NV_SYNC_API_TOKEN'];
			}
		}

		// WP_CACHE_KEY_SALT
		$this->wpCacheKeySalt = $options['wp-cache-salt'] ?? $this->ask( "paste the WP_CACHE_KEY_SALT SALT here", $existingEnv['WP_CACHE_KEY_SALT'] ?? null );
		if ( empty( $this->wpCacheKeySalt ) ) {
			if ( ! isset( $existingEnv['WP_CACHE_KEY_SALT'] ) ) {
				$this->output( "WP_CACHE_KEY_SALT is required but was not provided. If running in CI, ensure --no-env is used.", 'error' );
				return false;
			} else {
				$this->output( "WP_CACHE_KEY_SALT was empty after initial prompt, using existing value.", 'warning' );
				$this->wpCacheKeySalt = $existingEnv['WP_CACHE_KEY_SALT'];
			}
		}

		if ( isset( $existingEnv['NV_SYNC_API_USER'] ) && ! empty( $existingEnv['NV_SYNC_API_USER'] ) ) {
			$this->nvSyncApiUser = $existingEnv['NV_SYNC_API_USER'];
			$this->output( "Using existing NV_SYNC_API_USER: " . $this->nvSyncApiUser, 'info' );
		}
		// NV_SYNC_API_USER uses a placeholder by default, so an empty check might not be strictly needed unless you want to enforce it.

		return true;
	}

	/**
	 * Copy Bedrock files from the temporary directory to the project directory.
	 * Handles --existing flag to exclude specific files/directories and skip prompts.
	 *
	 * @return bool True on success, false on failure.
	 */
	protected function copyBedrockFiles(): bool {
		$rsyncBaseSource = escapeshellarg( self::TEMP_INSTALL_DIR . '/' );
		$rsyncBaseTarget = escapeshellarg( $this->projectFullPath . '/' );
		$rsyncCommand    = '';

		if ( $this->runningAsExisting ) {
			$this->output( "Running as existing project. Excluding specific files/directories.", 'info' );
			$excludes = [
				'config/',
				// Exclude the entire config directory
				'web/app/themes/nova-child/',
				// Exclude the specific theme
				'.gitignore',
				'README.md',
				'.env.example',
				// If --no-env is specified, we might still want to update .env.example if it's newer from Bedrock.
				// However, .env itself is handled by skipEnvSetup.
				// This logic is for rsync, not .env creation itself.
				// '.env', // Do not exclude .env here, rsync might update it if it's part of bedrock. Actual .env content handling is separate.
				'composer.json',
				'composer.lock',
				'LICENSE.md',
				'pint.json',
				'wp-cli.yml',
			];
			// If --no-env is specified, we should also exclude .env from being copied if it exists in Bedrock source
			// and preserve the existing one. This is subtle.
			// copyBedrockFiles is about copying from Bedrock *source*. If Bedrock source has an .env (it shouldn't, but .env.example yes)
			// Rsync's -u (update) or --ignore-existing handles existing files in target.
			// The current logic for --existing mode with -au should generally preserve an existing .env in the project.
			// No specific change needed here for --no-env regarding rsync, as .env creation/modification is handled elsewhere.

			$excludeFlags = '';
			foreach ( $excludes as $exclude ) {
				$excludeFlags .= " --exclude=" . escapeshellarg( $exclude );
			}

			$rsyncCommand = "rsync -au --remove-source-files" . $excludeFlags . " " . $rsyncBaseSource . " " . $rsyncBaseTarget;
			$this->output( "Existing files will be updated if newer (excluding specified items). New files will be added.", 'info' );
		} else {
			$potentialOverwrites = $this->checkPotentialOverwrites( self::TEMP_INSTALL_DIR, $this->projectFullPath );
			$rsyncCommand        = "rsync -a --remove-source-files " . $rsyncBaseSource . " " . $rsyncBaseTarget; // Default: Replace

			if ( ! empty( $potentialOverwrites ) ) {
				$this->output( "The following files/directories already exist in the target directory ('" . $this->projectFullPath . "') and would be affected:", 'warning' );
				foreach ( $potentialOverwrites as $item ) {
					echo "\033[0;33m" . "  - " . $item . "\033[0m" . PHP_EOL;
				}

				$choice       = '';
				$validChoices = [ 'R', 'U', 'I', 'A' ];
				while ( ! in_array( strtoupper( $choice ), $validChoices ) ) {
					echo "\033[0;33m" . "What do you want to do?\n";
					echo "  (R)eplace: Overwrite existing files.\n";
					echo "  (U)pdate: Update existing files if newer, add new files.\n";
					echo "  (I)gnore: Ignore existing files, only copy new files.\n";
					echo "  (A)bort: Abort the installation.\n";
					$choice = $this->ask( "Choice (R/U/I/A)", "I" );
					$choice = strtoupper( $choice );
				}

				if ( $choice === 'A' ) {
					$this->output( "Aborting installation.", 'error' );

					return false;
				} elseif ( $choice === 'U' ) {
					$rsyncCommand = "rsync -au --remove-source-files " . $rsyncBaseSource . " " . $rsyncBaseTarget;
					$this->output( "Existing files will be updated if newer. New files will be added.", 'info' );
				} elseif ( $choice === 'I' ) {
					$rsyncCommand = "rsync -a --ignore-existing --remove-source-files " . $rsyncBaseSource . " " . $rsyncBaseTarget;
					$this->output( "Existing files will be ignored. Only new files will be copied.", 'info' );
				} elseif ( $choice === 'R' ) {
					$this->output( "Existing files will be replaced.", 'info' );
				}
			}
		}

		// Execute the determined rsync command
		if ( empty( $rsyncCommand ) ) {
			$this->output( "Failed to determine rsync command.", 'error' );

			return false;
		}

		if ( ! $this->executeShellCommand( $rsyncCommand, "Could not copy Bedrock files" ) ) {
			$this->output( "Rsync command failed.", 'error' );

			return false;
		}

		// Clean up the temporary directory only after successful copy
		if ( is_dir( self::TEMP_INSTALL_DIR ) ) {
			if ( ! $this->executeShellCommand( "rm -rf " . escapeshellarg( self::TEMP_INSTALL_DIR ), "Could not remove temporary directory" ) ) {
				$this->output( "Temporary directory '" . self::TEMP_INSTALL_DIR . "' could not be removed. Manual cleanup may be required.", 'error' );
				// Don't return false here, copy was successful
			}
		}

		return true;
	}


	/**
	 * Check for potential overwrites in the target directory.
	 *
	 * @param string $sourceDir The source directory.
	 * @param string $targetDir The target directory.
	 *
	 * @return array List of potential overwrites.
	 */
	protected function checkPotentialOverwrites( string $sourceDir, string $targetDir ): array {
		$potentialOverwrites = [];
		if ( ! is_dir( $sourceDir ) ) {
			return $potentialOverwrites;
		}

		$sourceDirRealPath = realpath( $sourceDir );
		if ( $sourceDirRealPath === false ) {
			return [];
		}

		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $sourceDirRealPath, RecursiveDirectoryIterator::SKIP_DOTS ),
			RecursiveIteratorIterator::SELF_FIRST
		);

		foreach ( $iterator as $item ) {
			$relativePath = str_replace( $sourceDirRealPath . DIRECTORY_SEPARATOR, '', $item->getPathname() );
			$targetPath   = rtrim( $targetDir, DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . $relativePath;

			// Special handling for .env if --no-env is active: don't list it as a potential overwrite.
			if ( $this->skipEnvSetup && basename( $relativePath ) === '.env' ) {
				continue;
			}
			// Same for .env.example as it's closely related, and we don't want to prompt about it if --no-env.
			// Its actual copying is handled by rsync logic depending on --existing or user choice (U/I/R).
			if ( $this->skipEnvSetup && basename( $relativePath ) === '.env.example' ) {
				// If not running as existing, we might still want to list it if user chooses (R)eplace for all files.
				// However, the main point of --no-env is to avoid .env interaction.
				// Let's be consistent and skip warning about it if --no-env.
				// The rsync logic will copy it based on other flags (e.g., if not --existing and user chooses Replace).
				// This checkPotentialOverwrites is for *warning* the user.
				// If --no-env, they've signaled they don't want .env interaction.
				// continue; // Decided against this: .env.example is a template, not live config.
			}
            // Do not overwrite essential Nova kickstart files
            $noOverwrites = ['README.md', '.gitignore'];
            if ( in_array( basename( $relativePath ), $noOverwrites )) {
                continue;
            }

			if ( file_exists( $targetPath ) ) {
				// Skip check for directories if running as existing, as they might be excluded later
				if ( $this->runningAsExisting && $item->isDir() ) {
					// Basic check if the dir itself exists, rsync --exclude handles contents
					if ( is_dir( $targetPath ) ) {
						// Optionally add specific handling or logging here if needed
					}
				} elseif ( ! $this->runningAsExisting || ! $item->isDir() ) {
					$potentialOverwrites[] = $relativePath . ( $item->isDir() ? DIRECTORY_SEPARATOR : '' );
				}
			}
		}

		return $potentialOverwrites;
	}

	/**
	 * Set up the .env file.
	 * This method should not be called if --no-env is active.
	 *
	 * @return bool True on success or if user chooses not to overwrite, false on copy failure.
	 */
	protected function setupEnvFile(): bool {
		$envExampleFile = $this->projectFullPath . '/.env.example';
		$envFile        = $this->projectFullPath . '/.env';

		if ( ! file_exists( $envExampleFile ) ) {
			if ( file_exists( $envFile ) ) {
				$this->output( ".env.example not found, but .env exists. Will attempt to configure existing .env.", 'warning' );

				return true;
			} else {
				$this->output( ".env.example not found in directory: " . $this->projectFullPath . ". Cannot create .env.", 'error' );

				return false;
			}
		}

		if ( file_exists( $envFile ) && filesize( $envFile ) > 0 ) {
			$this->output( ".env already exists and is not empty.", 'info' );
			$overwriteEnv = $this->ask( "Do you want to overwrite it using .env.example and collected details? (yes/no)", "no" );
			if ( strtolower( $overwriteEnv ) !== 'yes' ) {
				$this->output( ".env file will not be overwritten. Attempting to configure existing file.", 'info' );

				return true;
			}
			$this->output( ".env file will be overwritten.", 'warning' );
		}

		if ( ! copy( $envExampleFile, $envFile ) ) {
			$this->output( "Could not copy .env.example to .env", 'error' );

			return false;
		}
		$this->output( ".env file created/overwritten successfully from .env.example.", 'success' );

		return true;
	}

	/**
	 * Configure the .env file with database and other settings.
	 * This method should not be called if --no-env is active.
	 *
	 * @return bool True on success, false on failure.
	 */
	protected function configureEnvVariables(): bool {
		$envFile = $this->projectFullPath . '/.env';
		if ( ! file_exists( $envFile ) || ! is_readable( $envFile ) ) {
			$this->output( ".env not found or not readable in directory: " . $this->projectFullPath . ". Cannot configure.", 'error' );

			return false;
		}
		$envContent = file_get_contents( $envFile );
		if ( $envContent === false ) {
			$this->output( "Could not read .env file.", 'error' );

			return false;
		}

		$replacements = [
			'DB_NAME'     => $this->dbName,
			'DB_USER'     => $this->dbUser,
			'DB_PASSWORD' => $this->dbPassword,
			'WP_HOME'     => $this->wpHome,
		];

		foreach ( $replacements as $key => $value ) {
			$envContent = $this->setEnvVar( $envContent, $key, $value );
		}

		$envContent = $this->setEnvVar( $envContent, 'DB_PREFIX', 'mv_' );
		$envContent = $this->setEnvVar( $envContent, 'WP_ENV', 'development' );

		$wpSalts = $this->fetchWordPressSalts();
		if ( ! empty( $wpSalts ) ) {
			foreach ( $wpSalts as $key => $value ) {
				$envContent = $this->setEnvVar( $envContent, $key, $value, true );
			}
			$this->output( "WordPress SALTS updated in .env file.", 'success' );
		} else {
			$this->output( "No WordPress SALTS were fetched. Existing SALTS (if any) remain unchanged.", 'warning' );
		}

		$envContent = $this->setEnvVar( $envContent, 'NV_SYNC_API_TOKEN', $this->nvSyncApiToken, true ); // Treat as salt for quoting
		$envContent = $this->setEnvVar( $envContent, 'WP_CACHE_KEY_SALT', $this->wpCacheKeySalt, true ); // Treat as salt for quoting
		$envContent = $this->setEnvVar( $envContent, 'NV_SYNC_API_USER', $this->nvSyncApiUser, false );

		if ( file_put_contents( $envFile, $envContent ) === false ) {
			$this->output( "Could not write to .env file.", 'error' );

			return false;
		}
		$this->output( ".env file updated successfully.", 'success' );

		return true;
	}

	/**
	 * Set an environment variable in the .env file content string.
	 * Handles existing keys (updates value) and adds new keys if they don't exist.
	 * Correctly quotes values containing spaces, #, quotes, or if empty, or if $isSalt is true.
	 *
	 * @param string $envContent The content of the .env file.
	 * @param string $key The key of the environment variable.
	 * @param string $value The value of the environment variable.
	 * @param bool $isSalt Whether the value should always be quoted (like salts).
	 *
	 * @return string The updated .env content.
	 */
	private function setEnvVar( string $envContent, string $key, string $value, bool $isSalt = false ): string {
		$finalValueString = $value;

		$needsQuotes = $isSalt || empty( $finalValueString ) || preg_match( '/[\s#\'"]/', $finalValueString );

		if ( $needsQuotes ) {
			$finalValueString = '"' . str_replace( '"', '\\"', $finalValueString ) . '"';
		}

		$pattern = "/^(#?\s*" . preg_quote( $key, '/' ) . "\s*=)(?:['\"]?)?(.*?)(?:['\"]?)?(\s*#.*)?$/m";

		$count      = 0;
		$envContent = preg_replace_callback(
			$pattern,
			function ( $matches ) use ( $key, $finalValueString ) {
				return $matches[1] . $finalValueString . ( $matches[3] ?? '' ); // Corrected to $matches[1]
			},
			$envContent,
			- 1,
			$count
		);

		if ( $count === 0 ) {
			if ( preg_match( "/^#\s*" . preg_quote( $key, '/' ) . "\s*=/m", $envContent ) ) {
				$this->output( "Key '{$key}' found commented out but could not be updated automatically. Please check manually.", 'warning' );
			} else {
				$envContent = rtrim( $envContent ) . PHP_EOL . "{$key}={$finalValueString}" . PHP_EOL;
			}
		}

		return $envContent;
	}


	/**
	 * Set up environment configurations.
	 * This method should not be called if --no-env is active.
	 *
	 * @return void
	 */
	protected function setupEnvironmentConfigs(): void {
		$devConfigPath     = $this->projectFullPath . '/config/environments/development.php';
		$stagingConfigPath = $this->projectFullPath . '/config/environments/staging.php';

		$nvSyncApiTokenEscaped = addslashes( $this->nvSyncApiToken );
		$wpCacheKeySaltEscaped = addslashes( $this->wpCacheKeySalt );
		$nvSyncApiUserEscaped  = addslashes( $this->nvSyncApiUser );

		$constantsToAdd = <<<PHP
// Constants below this line are added/updated by the Vivid kickstart script
Config::define('WP_MEMORY_LIMIT', env('WP_MEMORY_LIMIT') ?: '512M');
Config::define('WP_DEFAULT_THEME', env('WP_DEFAULT_THEME') ?: 'nova');
Config::define('WP_DEVELOPMENT_MODE', env('WP_DEVELOPMENT_MODE') ?: 'theme');

//Config::define('NV_SYNC_DISABLED', env('NV_SYNC_DISABLED') ?: false);
Config::define('NV_SYNC_API_USER', env('NV_SYNC_API_USER') ?: '{$nvSyncApiUserEscaped}');
Config::define('NV_SYNC_API_TOKEN', env('NV_SYNC_API_TOKEN') ?: '{$nvSyncApiTokenEscaped}');

Config::define('WP_REDIS_PORT', env('WP_REDIS_PORT') ?: 6379);
Config::define('WP_REDIS_HOST', env('WP_REDIS_HOST') ?: '127.0.0.1');
// WP_CACHE_KEY_SALT should preferentially come from .env if defined there
Config::define('WP_CACHE_KEY_SALT', env('WP_CACHE_KEY_SALT') ?: '{$wpCacheKeySaltEscaped}');

PHP;
		$this->addConstantsToFile( $devConfigPath, $constantsToAdd );
		$this->addConstantsToFile( $stagingConfigPath, $constantsToAdd );
	}

	/**
	 * Add constants to the specified file, replacing the previously added block.
	 * Attempts to insert before Config::apply();
	 *
	 * @param string $filePath The path to the file.
	 * @param string $constantsBlock The block of constants to add.
	 *
	 * @return void
	 */
	protected function addConstantsToFile( string $filePath, string $constantsBlock ): void {
		if ( ! file_exists( $filePath ) || ! is_readable( $filePath ) ) {
			$this->output( "Configuration file '{$filePath}' not found or not readable. Skipping.", 'warning' );

			return;
		}

		$content = file_get_contents( $filePath );
		if ( $content === false ) {
			$this->output( "Could not read configuration file '{$filePath}'.", 'error' );

			return;
		}

		$uniqueMarker   = "// Constants below this line are added/updated by the Vivid kickstart script";
		$configApplyLine = "Config::apply();";

		$pattern = '/' . preg_quote( $uniqueMarker, '/' ) . '.*?' . '(?=\n\s*' . preg_quote( $configApplyLine, '/' ) . '|\Z)/s';
		$content = preg_replace( $pattern, '', $content );
		$content = preg_replace( '/(\R){3,}/', "\n\n", $content );
		$content = rtrim( $content );

		$applyPos = strpos( $content, $configApplyLine );
		if ( $applyPos !== false ) {
			$insertBefore = substr( $content, 0, $applyPos );
			$insertAfter  = substr( $content, $applyPos );
			$insertBefore = rtrim( $insertBefore );
			$content      = $insertBefore . PHP_EOL . PHP_EOL . $constantsBlock . PHP_EOL . $insertAfter;
		} else {
			$this->output( "Anchor 'Config::apply();' not found in {$filePath}. Appending constants to the end.", 'info' );
			$content = rtrim( $content ) . PHP_EOL . PHP_EOL . $constantsBlock . PHP_EOL;
		}

		if ( file_put_contents( $filePath, $content ) === false ) {
			$this->output( "Could not write to configuration file '{$filePath}'.", 'error' );
		} else {
			$this->output( "Constants updated in configuration file '{$filePath}' successfully.", 'success' );
		}
	}
}