<?php

/**
 * Nova Theme - Vivid CLI Tool
 *
 * @author  Movve - https://movve.nl
 *
 * @since   1.0.0
 */
class InstallCommand extends AbstractCommand
{

    // Git repository URL
    const GIT_REPO_URL = 'git@github.com:orkuncv/nova-theme.git';

    // Temporary directory for cloning
    const TEMP_CLONE_DIR_NAME = 'temp-nova-theme-clone';

    // Default branch to clone
    const DEFAULT_GIT_BRANCH = 'master';

    protected string $projectBaseDir;

    protected string $tempCloneFullPath;

    protected string $outputZipFilename;

    protected string $themeSlug;

    /**
     * Get the name of the command.
     *
     * @return string The name of the command.
     */
    public function getName(): string
    {
        return 'init-theme';
    }

    /**
     * Get the description of the command.
     *
     * @return string The description of the command.
     */
    public function getDescription(): string
    {
        return 'Clones the Nova theme, prepares it, zips it, and installs it.';
    }

    /**
     * Get the options help for the command.
     *
     * @return array The options help for the command.
     */
    public function getOptionsHelp(): array
    {
        return [
            ['option' => '--license-key=<key>', 'description' => 'License key (required for the install step).'],
            [
                'option' => '--branch=<name>',
                'description' => 'Specify a git branch to clone (default: '.self::DEFAULT_GIT_BRANCH.').',
            ],
            [
                'option' => '--force',
                'description' => 'Force overwrite of existing theme zip file and installed theme.',
            ],
            ['option' => '--skip-install', 'description' => 'Only build the theme zip, do not install it.'],
            ['option' => '--keep-zip', 'description' => 'Do not delete the generated zip file after installation.'],
        ];
    }

    /**
     * Execute the command.
     *
     * @param  array  $options  The options passed to the command.
     * @return int The exit code of the command.
     */
    public function execute(array $options): int
    {
        $this->projectBaseDir = getcwd();
        $this->themeSlug = self::GLOBAL_CONFIG['THEME_SLUG'] ?? 'nova';
        $this->outputZipFilename = $this->themeSlug.'.zip';
        $this->tempCloneFullPath = $this->projectBaseDir.DIRECTORY_SEPARATOR.self::TEMP_CLONE_DIR_NAME;

        $this->output('Starting theme initialization...', 'info');

        // --- Validations ---
        if (! $this->checkRequiredSystemCommands(['git', 'composer', 'zip'])) {
            return 1;
        }
                if ( ! $this->checkRequiredExtensions(['zip'])) { // zip extension is for unzipping during install
                    return 1;
                }
        //        if ( ! ($options['skip_install'] ?? false) && ! $this->checkThemesDir()) {
        //            return 1;
        //        }
        //        if ( ! ($options['skip_install'] ?? false) && ! $this->requireLicenseKey($options, $this->getName())) {
        //            return 1;
        //        }

        $gitBranch = $options['branch'] ?? self::DEFAULT_GIT_BRANCH;

        // --- Cleanup old temp dir if exists ---
        if (file_exists($this->tempCloneFullPath)) {
            $this->output("Temporary clone directory '{$this->tempCloneFullPath}' already exists. Removing...", 'warning');
            if (! $this->executeShellCommand('rm -rf '.escapeshellarg($this->tempCloneFullPath), 'Could not remove existing temporary clone directory')) {
                return 1;
            }
        }

        // --- Cleanup old zip file if exists and not --force ---
        $zipFilePath = $this->projectBaseDir.DIRECTORY_SEPARATOR.$this->outputZipFilename;
        if (file_exists($zipFilePath) && ! ($options['force'] ?? false)) {
            $confirm = $this->ask("Zip file '{$this->outputZipFilename}' already exists. Overwrite? (yes/no)", 'no');
            if (strtolower($confirm) !== 'yes') {
                $this->output('Operation cancelled by user.', 'info');

                return 0;
            }
        }
        if (file_exists($zipFilePath)) {
            if (! unlink($zipFilePath)) {
                $this->output("Could not remove existing zip file '{$zipFilePath}'. Check permissions.", 'error');

                return 1;
            }
        }

        // --- Step 1: Clone de repository ---
        $this->output("\n--- Step 1: Cloning theme repository '".self::GIT_REPO_URL."' (branch: {$gitBranch}) ---", 'info');
        $cloneCommand = sprintf(
            'git clone --depth 1 %s %s',
            escapeshellarg(self::GIT_REPO_URL),
            escapeshellarg(self::TEMP_CLONE_DIR_NAME)
        );
        if (! $this->executeShellCommand($cloneCommand, 'Failed to clone repository')) {
            $this->cleanupTempDir();

            return 1;
        }

        // --- Step 2: Remove Git versioning from cloned theme ---
        $this->output("\n--- Step 2: Removing Git versioning from cloned theme ---", 'info');
        if (! chdir($this->tempCloneFullPath)) {
            $this->output("Failed to change directory to '{$this->tempCloneFullPath}'.", 'error');
            $this->cleanupTempDir();
            chdir($this->projectBaseDir);

            return 1;
        }
        if (! $this->executeShellCommand('rm -rf .git', 'Failed to remove .git directory')) {
            $this->cleanupTempDir();
            chdir($this->projectBaseDir);

            return 1;
        }

        // --- Step 3: Composer install ---
        $this->output("\n--- Step 3: Running composer install in cloned theme ---", 'info');
        if (! $this->executeShellCommand('composer install --no-dev --optimize-autoloader', 'Composer install failed')) {
            $this->cleanupTempDir();
            chdir($this->projectBaseDir);

            return 1;
        }

        // Back to the project base directory
        if (! chdir($this->projectBaseDir)) {
            $this->output("Failed to change directory back to '{$this->projectBaseDir}'.", 'error');
            $this->cleanupTempDir();

            return 1;
        }

        // --- Step 4: Zip the prepared theme ---
        $this->output("\n--- Step 4: Zipping the prepared theme to '{$this->outputZipFilename}' ---", 'info');
        $zipCommandBase = 'zip -rq ';
        $zipCommand = sprintf(
            'cd %s && %s %s . && cd %s',
            escapeshellarg(self::TEMP_CLONE_DIR_NAME),
            $zipCommandBase,
            escapeshellarg($zipFilePath),
            escapeshellarg($this->projectBaseDir)
        );

        if (! $this->executeShellCommand($zipCommand, 'Failed to zip the theme directory')) {
            $this->cleanupTempDir();
            @unlink($zipFilePath);

            return 1;
        }
        $this->output("Theme successfully zipped to '{$zipFilePath}'.", 'success');

        // --- Step 5: Cleanup temporary clone directory ---
        $this->output("\n--- Step 5: Cleaning up temporary clone directory ---", 'info');
        if (! $this->cleanupTempDir()) {
            $this->output("Could not automatically remove temporary clone directory '{$this->tempCloneFullPath}'. Please remove it manually.", 'warning');
        }

        if ($options['skip_install'] ?? false) {
            $this->output("\nSkipping theme installation as per --skip-install option.", 'info');
            $this->output("Theme package is ready at: {$zipFilePath}", 'success');

            return 0;
        }

        // --- Step 6: Install the theme ---
        $this->output("\n--- Step 6: Installing the theme ---", 'info');

        $currentVersion = $this->getCurrentVersion($this->themeSlug, self::GLOBAL_CONFIG['THEMES_DIR']);
        if ($currentVersion && ! ($options['force'] ?? false)) {
            $this->output("Theme '{$this->themeSlug}' version {$currentVersion} is already installed.", 'warning');
            $confirmInstall = $this->ask('Do you want to overwrite it with the newly built version? (yes/no)', 'no');
            if (strtolower($confirmInstall) !== 'yes') {
                $this->output('Installation aborted by user.', 'info');
                if (! ($options['keep_zip'] ?? false)) {
                    $this->output("Removing generated zip file '{$zipFilePath}'. Use --keep-zip to prevent this.", 'info');
                    @unlink($zipFilePath);
                }

                return 0;
            }
        }

        if (! $this->unzipFile($zipFilePath, self::GLOBAL_CONFIG['THEMES_DIR'])) {
            $this->output("Failed to install the theme from '{$zipFilePath}'.", 'error');

            return 1;
        }

        $this->output("Theme '{$this->themeSlug}' successfully installed from local zip.", 'success');

        if (! ($options['keep_zip'] ?? false)) {
            $this->output("Removing generated zip file '{$zipFilePath}'. Use --keep-zip to prevent this.", 'info');
            @unlink($zipFilePath);
        }

        $this->output("\nTheme initialization complete!", 'success');

        return 0;
    }

    /**
     * Removes the temporary clone directory.
     *
     * @return bool True on success, false on failure.
     */
    protected function cleanupTempDir(): bool
    {
        if (file_exists($this->tempCloneFullPath)) {
            if (getcwd() !== $this->projectBaseDir) {
                chdir($this->projectBaseDir);
            }

            return $this->executeShellCommand('rm -rf '.escapeshellarg(self::TEMP_CLONE_DIR_NAME), 'Could not remove temporary directory');
        }

        return true;
    }

    /**
     * Execute a shell command and handle the output.
     *
     * @param  string  $command  The command to execute.
     * @param  string  $errorMessage  The error message to display on failure.
     * @param  string|null  $cwd  The working directory for the command. Defaults to current.
     * @return bool True on success, false on failure.
     */
    protected function executeShellCommand(string $command, string $errorMessage = 'Command failed', ?string $cwd = null): bool
    {
        $this->output("Executing command: $command".($cwd ? " in {$cwd}" : ''), 'info');

        $originalCwd = null;
        if ($cwd && getcwd() !== $cwd) {
            $originalCwd = getcwd();
            if (! chdir($cwd)) {
                $this->output("Failed to change directory to {$cwd}", 'error');

                return false;
            }
        }

        $descriptorspec = [
            0 => ['pipe', 'r'],  // stdin
            1 => ['pipe', 'w'],  // stdout
            2 => ['pipe', 'w'],   // stderr
        ];
        $process = proc_open($command, $descriptorspec, $pipes);

        if (! is_resource($process)) {
            $this->output("Failed to open process for command: $command", 'error');
            if ($originalCwd) {
                chdir($originalCwd);
            }

            return false;
        }

        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);
        $return_var = proc_close($process);

        if ($originalCwd) {
            chdir($originalCwd);
        }

        if (! empty(trim((string) $stdout))) {
            $this->output(trim((string) $stdout), 'info');
        }

        if ($return_var !== 0) {
            $this->output("$errorMessage (Exit code: $return_var)", 'error');
            if (! empty(trim((string) $stderr))) {
                $this->output("Error output:\n".trim((string) $stderr), 'error');
            }

            return false;
        }

        return true;
    }

    /**
     * Ask the user for input.
     *
     * @param  string  $prompt  The prompt message.
     * @param  string|null  $default  The default value (optional).
     * @return string The user input.
     */
    protected function ask(string $prompt, ?string $default = null): string
    {
        $promptSuffix = $default ? " [$default]" : '';
        $fullPrompt = "\033[0;33m".$prompt.$promptSuffix.': '."\033[0m";
        echo $fullPrompt;
        $input = trim(fgets(STDIN));

        return $input !== '' ? $input : (string) $default;
    }

    /**
     * Checks if required system commands are available.
     *
     * @param  array  $commands  List of commands to check (e.g., ['git', 'composer']).
     * @return bool True if all commands are found, false otherwise.
     */
    protected function checkRequiredSystemCommands(array $commands): bool
    {
        foreach ($commands as $command) {
            $checkProcess = proc_open('command -v '.escapeshellarg($command), [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ], $pipes);
            if (is_resource($checkProcess)) {
                stream_get_contents($pipes[1]);
                fclose($pipes[1]);
                stream_get_contents($pipes[2]);
                fclose($pipes[2]);
                $return_var = proc_close($checkProcess);
                if ($return_var !== 0) {
                    $this->output("Error: System command '{$command}' not found. Please install it and ensure it's in your PATH.", 'error');

                    return false;
                }
            } else {
                $this->output("Error: Could not check for system command '{$command}'.", 'error');

                return false;
            }
        }

        return true;
    }

    /**
     * Parses command line arguments.
     *
     * @param  array  $argv  The command line arguments.
     * @return array The parsed arguments.
     */
    public function parseArguments(array $argv): array
    {
        $parsed = parent::parseArguments($argv);

        foreach (array_slice($argv, 2) as $arg) {
            if (str_starts_with($arg, '--branch=')) {
                $parsed['options']['branch'] = substr($arg, strlen('--branch='));
            } elseif ($arg === '--skip-install') {
                $parsed['options']['skip_install'] = true;
            } elseif ($arg === '--keep-zip') {
                $parsed['options']['keep_zip'] = true;
            }
        }

        return $parsed;
    }
}
