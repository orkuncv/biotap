<?php

/**
 * Nova Theme
 *
 * @author  Movve - https://movve.nl
 * @since   1.0.0
 */
abstract class AbstractCommand
{

    const GLOBAL_CONFIG = [
        'THEME_SLUG' => 'nova',
        'API_BASE_URL' => '',
        'THEMES_DIR' => 'web/app/themes',
        'LICENSE_ARG' => '--license-key=',
        'WP_LOAD_PATH' => 'web/wp/wp-load.php',
        'CACHE_CLASS_REL_PATH' => '/inc/classes/performance/class-performance-cache-clear.php',
    ];

    /**
     * The global configuration array.
     */
    protected array $globalConfig;

    /**
     * Constructor to initialize the global configuration.
     *
     * @param array $globalConfig The global configuration array.
     */
    public function __construct(array $globalConfig = [])
    {
        $this->globalConfig = $globalConfig;
    }

    /**
     * Get the name of the command.
     *
     * @return string The name of the command.
     */
    abstract public function getName(): string;

    /**
     * Get the description of the command.
     *
     * @return string The description of the command.
     */
    abstract public function getDescription(): string;

    /**
     * Execute the command.
     *
     * @param array $options The options passed to the command.
     *
     * @return int The exit code of the command (0 for success, non-zero for failure).
     */
    abstract public function execute(array $options): int;

    /**
     * Get the options help for the command.
     *
     * @return array The options help for the command.
     */
    public function getOptionsHelp(): array
    {
        return [];
    }

    /**
     * Unzips a zip file to a specified directory.
     *
     * @param string $zipPath The path to the zip file.
     * @param string $extractTo The directory where the files should be extracted.
     *
     * @return bool True on success, false on failure.
     */
    protected function unzipFile(string $zipPath, string $extractTo): bool
    {
        if ( ! extension_loaded('zip')) {
            $this->output("Error: The 'zip' PHP extension is required but not loaded.", 'error');

            return false;
        }
        $zip = new \ZipArchive;
        if ($zip->open($zipPath) === true) {
            if ( ! is_dir($extractTo) && ! mkdir($extractTo, 0755, true)) {
                $this->output("Error: Could not create extraction directory: {$extractTo}", 'error');
                $zip->close();

                return false;
            }
            $tempExtractDir = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . '/vivid_extract_' . uniqid();
            if ( ! mkdir($tempExtractDir, 0755, true)) {
                $this->output("Error: Could not create temporary extraction directory: {$tempExtractDir}", 'error');
                $zip->close();

                return false;
            }
            $this->output("Extracting {$zipPath} to temporary location {$tempExtractDir}...", 'info');
            if ( ! $zip->extractTo($tempExtractDir)) {
                $this->output('Error: Failed to extract zip file to temporary location.', 'error');
                $zip->close();
                system('rm -rf ' . escapeshellarg($tempExtractDir));

                return false;
            }
            $zip->close();
            $extractedItems = scandir($tempExtractDir);
            $themeSourceDir = null;
            foreach ($extractedItems as $item) {
                if ($item === '.' || $item === '..') {
                    continue;
                }
                $potentialPath = $tempExtractDir . DIRECTORY_SEPARATOR . $item;
                if (is_dir($potentialPath)) {
                    if (file_exists($potentialPath . '/style.css')) {
                        $themeSourceDir = $potentialPath;
                        break;
                    }
                }
            }
            if ($themeSourceDir === null) {
                if (file_exists($tempExtractDir . '/style.css')) {
                    $themeSourceDir = $tempExtractDir;
                } else {
                    $this->output("Error: Could not locate the theme folder within the extracted files in {$tempExtractDir}.", 'error');
                    system('rm -rf ' . escapeshellarg($tempExtractDir));

                    return false;
                }
            }
            $this->output("Located theme source folder: {$themeSourceDir}", 'info');
            $finalThemeDir = $extractTo . DIRECTORY_SEPARATOR . self::GLOBAL_CONFIG['THEME_SLUG'];
            if (is_dir($finalThemeDir)) {
                $this->output("Removing existing theme directory: {$finalThemeDir}", 'warning');
                if ( ! system('rm -rf ' . escapeshellarg($finalThemeDir))) {
                    $this->output('Error: Failed to remove existing theme directory.', 'error');
                    system('rm -rf ' . escapeshellarg($tempExtractDir));

                    return false;
                }
            } elseif (is_file($finalThemeDir)) {
                $this->output("Error: A file exists at the target theme path: {$finalThemeDir}", 'error');
                system('rm -rf ' . escapeshellarg($tempExtractDir));

                return false;
            }
            $this->output("Moving theme to final destination: {$finalThemeDir}", 'info');
            if ( ! rename($themeSourceDir, $finalThemeDir)) {
                $this->output('Rename failed, attempting copy...', 'warning');
                if ( ! system('cp -a ' . escapeshellarg($themeSourceDir) . ' ' . escapeshellarg($finalThemeDir))) {
                    $this->output("Error: Failed to move or copy theme from {$themeSourceDir} to {$finalThemeDir}.", 'error');
                    system('rm -rf ' . escapeshellarg($tempExtractDir));

                    return false;
                }
                system('rm -rf ' . escapeshellarg($themeSourceDir));
            }
            system('rm -rf ' . escapeshellarg($tempExtractDir));
            $this->output('Extraction and placement complete.', 'success');

            return true;
        } else {
            $this->output("Error: Failed to open zip file {$zipPath}. Code: " . $zip->status, 'error');

            return false;
        }
    }

    /**
     * Get the usage help for the command.
     *
     * @return string The usage help text.
     */
    public function getUsage(): string
    {
        $usage = "Usage: php bin/nova {$this->getName()} [options]\n\n";
        $usage .= "Description:\n";
        $usage .= "  {$this->getDescription()}\n";

        $optionsHelp = $this->getOptionsHelp();
        if ( ! empty($optionsHelp)) {
            $usage .= "\nOptions:\n";
            foreach ($optionsHelp as $option) {
                $usage .= sprintf("  %-20s %s\n", $option['option'], $option['description']);
            }
        }

        return $usage;
    }

    /**
     * Output a message to the console with optional color formatting.
     *
     * @param string $message The message to output.
     * @param string $type The type of message (info, success, warning, error).
     */
    protected function output(string $message, string $type = 'info'): void
    {
        $colors = [
            'info' => "\033[0;36m", // Cyan
            'success' => "\033[0;32m", // Green
            'warning' => "\033[0;33m", // Yellow
            'error' => "\033[0;31m", // Red
        ];
        $reset = "\033[0m";

        $color = $colors[ $type ] ?? $colors['info'];
        echo $color . $message . $reset . PHP_EOL;
    }

    /**
     * Ask the user for input.
     *
     * @param string $prompt The prompt message.
     * @param string|null $default The default value (optional).
     *
     * @return string The user input.
     */
    protected function ask(string $prompt, ?string $default = null): string
    {
        $promptSuffix = $default !== null ? " [$default]" : '';
        $fullPrompt = "\033[0;33m" . $prompt . $promptSuffix . ': ' . "\033[0m";
        echo $fullPrompt;

        $input = trim(fgets(STDIN));

        return $input !== '' ? $input : ($default ?? '');
    }

    /**
     * Execute a shell command and handle the output.
     *
     * @param string $command The command to execute.
     * @param string $errorMessage The error message to display on failure.
     *
     * @return bool True on success, false on failure.
     */
    protected function executeShellCommand(string $command, string $errorMessage = 'Command failed'): bool
    {
        $this->output('Executing: ' . $command, 'info');

        $descriptorspec = [
            0 => ['pipe', 'r'],  // stdin
            1 => ['pipe', 'w'],  // stdout
            2 => ['pipe', 'w'],   // stderr
        ];

        $process = proc_open($command, $descriptorspec, $pipes);
        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);
        $return_var = proc_close($process);

        if ( ! empty(trim($stdout))) {
            $this->output(trim($stdout), 'info');
        }

        if ($return_var !== 0) {
            $this->output("$errorMessage (Exit code: $return_var)", 'error');
            if ( ! empty(trim($stderr))) {
                $this->output("Error output:\n" . trim($stderr), 'error');
            }

            return false;
        }

        $this->output('Command executed successfully.', 'success');

        return true;
    }

    /**
     * Checks if the required PHP extensions are loaded.
     *
     * @param array $extensions The list of required extensions.
     *
     * @return bool True if all required extensions are loaded, false otherwise.
     */
    protected function checkRequiredExtensions(array $extensions): bool
    {
        foreach ($extensions as $ext) {
            if ( ! extension_loaded($ext)) {
                $this->output("Error: The '{$ext}' PHP extension is required for this command but not loaded.", 'error');

                return false;
            }
        }

        return true;
    }

    /**
     * Gets the current version of the theme from the style.css file.
     *
     * @param string $themeSlug The slug of the theme.
     * @param string $themesDir The directory where themes are stored.
     *
     * @return string|null The current version of the theme, or null if not found.
     */
    protected function getCurrentVersion(string $themeSlug, string $themesDir): ?string
    {
        $styleCssPath = $themesDir . '/' . $themeSlug . '/style.css';
        if ( ! file_exists($styleCssPath)) {
            return null;
        }
        $content = @file_get_contents($styleCssPath);
        if ($content === false) {
            $this->output("Warning: Could not read {$styleCssPath}. Check permissions.", 'warning');

            return null;
        }
        if (preg_match('/^[ \t\/*#]*Version:\s*(.*)$/mi', $content, $matches)) {
            return trim($matches[1]);
        }

        return null;
    }

    /**
     * Checks if the themes directory exists.
     *
     * @return bool True if the themes directory exists, false otherwise.
     */
    protected function checkThemesDir(): bool
    {
        if ( ! is_dir($this->globalConfig['THEMES_DIR'])) {
            $this->output("Error: Themes directory not found at '" . $this->globalConfig['THEMES_DIR'] . "'. Are you running this from the project root?", 'error');

            return false;
        }

        return true;
    }
}
