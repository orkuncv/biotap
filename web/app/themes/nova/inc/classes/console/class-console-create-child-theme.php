<?php
/**
 * Class Nova_Console_Create_Child_Theme
 *
 * Creates the fixed 'nova-child' theme via WP-CLI.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

use WP_CLI\Utils;

class Nova_Console_Create_Child_Theme {

	/**
	 * Default child theme version.
	 * @var string
	 */
	private const DEFAULT_VERSION = '1.0.0';

	/**
	 * Default parent theme template slug.
	 * @var string
	 */
	private const DEFAULT_TEMPLATE = 'nova';

	/**
	 * Default author.
	 * @var string
	 */
	private const DEFAULT_AUTHOR = 'Movve';

	/**
	 * Default author URI.
	 * @var string
	 */
	private const DEFAULT_AUTHOR_URI = 'https://movve.nl';

	/**
	 * Base path to the stubs in the parent theme.
	 * @var string
	 */
	private string $stubs_base_path;

	/**
	 * The fixed slug for the child theme.
	 * @var string
	 */
	private string $child_theme_slug;

	/**
	 * Creates child theme from admin context (without WP-CLI).
	 *
	 * @return bool True on success, false on failure.
	 * @since 1.0.0
	 */
	public static function create_from_admin(): bool {
		$child_theme_slug = defined('NOVA_CHILD_THEME_SLUG') ? NOVA_CHILD_THEME_SLUG : 'nova-child';
		$child_theme_slug = sanitize_key( $child_theme_slug );

		$theme_root         = get_theme_root();
		$child_theme_path   = $theme_root . '/' . $child_theme_slug;
		$parent_theme_dir   = get_template_directory();
		$stubs_base_path    = $parent_theme_dir . '/inc/stubs/nova-child';

		// Check if parent theme directory exists
		if ( ! is_dir( $parent_theme_dir ) ) {
			return false;
		}

		// Check if stubs directory exists
		if ( ! is_dir( $stubs_base_path ) ) {
			return false;
		}

		// Create child theme directory if it doesn't exist
		if ( ! is_dir( $child_theme_path ) ) {
			if ( ! wp_mkdir_p( $child_theme_path ) ) {
				return false;
			}
		}

		// Create directory structure
		$directories = [
			'assets', 'assets/css',
			'inc', 'inc/classes', 'inc/classes/theme',
			'parts', 'patterns', 'styles', 'templates',
		];

		foreach ( $directories as $relative_dir ) {
			$full_dir_path = $child_theme_path . '/' . $relative_dir;
			if ( ! is_dir( $full_dir_path ) ) {
				if ( ! wp_mkdir_p( $full_dir_path ) ) {
					return false;
				}
			}
		}

		// Copy stub files
		$files_to_copy = [
			'style.css'                     => 'style.css',
			'readme.txt'                    => 'readme.txt',
			'functions.php'                 => 'functions.php',
			'screenshot.png'                => 'screenshot.png',
			'imports.css'                   => 'assets/css/imports.css',
			'variables.css'                 => 'assets/css/variables.css',
			'bootstrap.php'                 => 'inc/bootstrap.php',
			'class-child-theme-setup.php'   => 'inc/classes/theme/class-child-theme-setup.php',
			'nova-child.json'               => 'styles/nova-child.json',
		];

		foreach ( $files_to_copy as $source_relative => $dest_relative ) {
			$source_path = $stubs_base_path . '/' . $source_relative;
			$dest_path = $child_theme_path . '/' . $dest_relative;

			if ( ! file_exists( $source_path ) ) {
				continue;
			}

			$dest_dir = dirname( $dest_path );
			if ( ! is_dir( $dest_dir ) && ! wp_mkdir_p( $dest_dir ) ) {
				continue;
			}

			copy( $source_path, $dest_path );
		}

		return true;
	}

	/**
	 * Creates the 'nova-child' theme.
	 *
	 * ## OPTIONS
	 *
	 * [--version=<version>]
	 * : The version for the child theme (overrides NOVA_CHILD_THEME_VERSION constant).
	 * ---
	 * default: Value of NOVA_CHILD_THEME_VERSION or '1.0.0'
	 * ---
	 *
	 * [--template=<template>]
	 * : The slug of the parent theme (overrides NOVA_THEME_TEMPLATE constant).
	 * ---
	 * default: Value of NOVA_THEME_TEMPLATE or 'nova'
	 * ---
	 *
	 * [--author=<author>]
	 * : The author of the child theme (for documentation/reference).
	 * ---
	 * default: Movve
	 * ---
	 *
	 * [--authoruri=<uri>]
	 * : The URI of the author (for documentation/reference).
	 * ---
	 * default: https://movve.nl
	 * ---
	 *
	 * [--force]
	 * : Force overwriting existing files and directories in the child theme directory.
	 *
	 * ## EXAMPLES
	 *
	 *     # Create the default 'nova-child' theme
	 *     $ wp nova create child-theme
	 *
	 *     # Create it and force overwrite if it already exists
	 *     $ wp nova create child-theme --force
	 *
	 *     # Create it with a specific version
	 *     $ wp nova create child-theme --version=1.1.0
	 *
	 * @when wp_loaded
	 * @since 1.0.0
	 *
	 * @param array $args Positional arguments (unused).
	 * @param array $assoc_args Associative arguments (--key=value).
	 */
	public function __invoke( array $args, array $assoc_args ): void {
		// Only allow this method to run in WP-CLI context
		if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
			return;
		}

		$this->child_theme_slug = defined('NOVA_CHILD_THEME_SLUG') ? NOVA_CHILD_THEME_SLUG : 'nova-child';

		if ( empty( $this->child_theme_slug ) ) {
			WP_CLI::error( 'Constant NOVA_CHILD_THEME_SLUG is not defined or empty. Cannot create child theme.' );
			return;
		}
		$this->child_theme_slug = sanitize_key( $this->child_theme_slug );

		$defaults = [
			'version'    => defined('NOVA_CHILD_THEME_VERSION') ? NOVA_CHILD_THEME_VERSION : self::DEFAULT_VERSION,
			'template'   => defined('NOVA_THEME_TEMPLATE') ? NOVA_THEME_TEMPLATE : self::DEFAULT_TEMPLATE,
			'author'     => self::DEFAULT_AUTHOR,
			'authoruri'  => self::DEFAULT_AUTHOR_URI,
			'force'      => false,
		];

		$params             = array_merge( $defaults, $assoc_args );
		$theme_root         = get_theme_root();
		$child_theme_path   = $theme_root . '/' . $this->child_theme_slug;
		$parent_theme_dir   = get_template_directory();

		if ( ! is_dir( $parent_theme_dir ) ) {
			WP_CLI::error( sprintf( "Could not determine parent theme directory. Path check: %s", $parent_theme_dir ) );
			return;
		}

		$this->stubs_base_path = $parent_theme_dir . '/inc/stubs/nova-child';

		if ( ! is_dir( $this->stubs_base_path ) ) {
			WP_CLI::error( sprintf( "Required stub directory not found at: %s", $this->stubs_base_path ) );
			return;
		}

		$force = isset( $params['force'] ) && $params['force'];
		if ( is_dir( $child_theme_path ) ) {
			if ( $force ) {
				WP_CLI::warning( sprintf( "Directory '%s' already exists. Files may be overwritten (--force used).", $this->child_theme_slug ) );
			} else {
				WP_CLI::error( sprintf( "Directory '%s' already exists in '%s'. Use --force to overwrite.", $this->child_theme_slug, $theme_root ) );
				return;
			}
		} elseif ( ! wp_mkdir_p( $child_theme_path ) ) {
			WP_CLI::error( sprintf( "Could not create directory '%s' in '%s'. Check permissions.", $this->child_theme_slug, $theme_root ) );
			return;
		} else {
			WP_CLI::log( sprintf( "Directory '%s' successfully created.", $child_theme_path ) );
		}

		if ( ! $this->create_directories( $child_theme_path ) ) {
			return;
		}

		if ( ! $this->add_stub_files( $child_theme_path, $force ) ) {
			WP_CLI::warning( 'Not all stub files could be copied successfully.' );
		}

		WP_CLI::success( sprintf( "Child theme '%s' created/updated successfully!", $this->child_theme_slug ) );
		WP_CLI::log( sprintf( "Path: %s", $child_theme_path ) );
		WP_CLI::log( "You may need to activate the theme using 'wp theme activate {$this->child_theme_slug}' or via the WordPress Dashboard." );
	}

	/**
	 * Creates the necessary directory structure within the child theme.
	 * @param string $child_theme_path  Full path to the child theme directory.
	 * @return bool                     True on success, false on failure.
	 * @since 1.0.0
	 */
	private function create_directories( string $child_theme_path ): bool {
		$directories = [
			'assets', 'assets/css',
			'inc', 'inc/classes', 'inc/classes/theme',
			'parts', 'patterns', 'styles', 'templates',
		];

		WP_CLI::log( 'Creating directory structure...' );
		foreach ( $directories as $relative_dir ) {
			$full_dir_path = $child_theme_path . '/' . $relative_dir;
			if ( ! is_dir( $full_dir_path ) ) {
				if ( ! wp_mkdir_p( $full_dir_path ) ) {
					WP_CLI::error( sprintf( "Could not create directory: %s", $full_dir_path ) );
					return false;
				}
				WP_CLI::debug( sprintf( "Directory created: %s", $full_dir_path ), 'child-theme-creation');
			} else {
				WP_CLI::debug( sprintf( "Directory already exists: %s", $full_dir_path ), 'child-theme-creation');
			}
		}
		return true;
	}

	/**
	 * Copies the stub files to the child theme.
	 *
	 * @param string $child_theme_path      Full path to the child theme directory.
	 * @param bool   $force                 Whether to overwrite existing files.
	 * @return bool                         True if all existing stubs were copied successfully, false otherwise.
	 */
	private function add_stub_files( string $child_theme_path, bool $force ): bool {
		$files_to_copy = [
            'style.css'                     => 'style.css',
			'readme.txt'                    => 'readme.txt',
			'functions.php'                 => 'functions.php',
			'screenshot.png'                => 'screenshot.png',
			'imports.css'                   => 'assets/css/imports.css',
			'variables.css'                 => 'assets/css/variables.css',
			'bootstrap.php'                 => 'inc/bootstrap.php',
			'class-child-theme-setup.php'   => 'inc/classes/theme/class-child-theme-setup.php',
			'nova-child.json'               => 'styles/nova-child.json',
		];

		WP_CLI::log( 'Copying stub files...' );
		$all_successful = true;

		foreach ( $files_to_copy as $source_relative => $dest_relative ) {
			$source_path = $this->stubs_base_path . '/' . $source_relative;
			$dest_path = $child_theme_path . '/' . $dest_relative;

			if ( ! file_exists( $source_path ) ) {
				WP_CLI::warning( sprintf( "Source file not found, skipped: %s", $source_path ) );
				$all_successful = false;
				continue;
			}

			if ( file_exists( $dest_path ) && ! $force ) {
				WP_CLI::log( sprintf( "File already exists, skipped (use --force to overwrite): %s", $dest_path ) );
				continue;
			}

			$dest_dir = dirname( $dest_path );
			if ( ! is_dir( $dest_dir ) && ! wp_mkdir_p( $dest_dir ) ) {
				WP_CLI::warning( sprintf( "Could not create destination directory for file %s. Skipping.", $dest_path ) );
				$all_successful = false;
				continue;
			}

			if ( ! copy( $source_path, $dest_path ) ) {
				WP_CLI::warning( sprintf( "Could not copy file from %s to %s", $source_path, $dest_path ) );
				$all_successful = false;
			} else {
				WP_CLI::debug( sprintf( "File copied: %s", $dest_path ), 'child-theme-creation');
			}
		}
		return $all_successful;
	}
}

// Register the command only if WP-CLI is running
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'nova create child-theme', 'Nova_Console_Create_Child_Theme' );
}
