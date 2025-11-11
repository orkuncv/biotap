<?php
/**
 * Nova Theme - Vivid CLI Tool
 *
 * @author  Movve - https://movve.nl
 * @package Nova/Vivid
 * @since   1.0.0
 */

abstract class AbstractCommand {

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
	abstract public function execute( array $options ): int;

	/**
	 * Get the options help for the command.
	 *
	 * @return array The options help for the command.
	 */
	public function getOptionsHelp(): array {
		return [];
	}

	/**
	 * Get the usage help for the command.
	 *
	 * @return string The usage help text.
	 */
	public function getUsage(): string {
		$usage = "Usage: php bin/nova {$this->getName()} [options]\n\n";
		$usage .= "Description:\n";
		$usage .= "  {$this->getDescription()}\n";

		$optionsHelp = $this->getOptionsHelp();
		if ( ! empty( $optionsHelp ) ) {
			$usage .= "\nOptions:\n";
			foreach ( $optionsHelp as $option ) {
				$usage .= sprintf( "  %-20s %s\n", $option['option'], $option['description'] );
			}
		}

		return $usage;
	}

	/**
	 * Output a message to the console with optional color formatting.
	 *
	 * @param string $message The message to output.
	 * @param string $type The type of message (info, success, warning, error).
	 *
	 * @return void
	 */
	protected function output( string $message, string $type = 'info' ): void {
		$colors = [
			'info'    => "\033[0;36m", // Cyan
			'success' => "\033[0;32m", // Green
			'warning' => "\033[0;33m", // Yellow
			'error'   => "\033[0;31m", // Red
		];
		$reset  = "\033[0m";

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
	protected function ask( string $prompt, ?string $default = null ): string {
		$promptSuffix = $default !== null ? " [$default]" : "";
		$fullPrompt   = "\033[0;33m" . $prompt . $promptSuffix . ": " . "\033[0m";
		echo $fullPrompt;

		$input = trim( fgets( STDIN ) );

		return $input !== '' ? $input : ( $default ?? '' );
	}

	/**
	 * Execute a shell command and handle the output.
	 *
	 * @param string $command The command to execute.
	 * @param string $errorMessage The error message to display on failure.
	 *
	 * @return bool True on success, false on failure.
	 */
	protected function executeShellCommand( string $command, string $errorMessage = "Command failed" ): bool {
		$this->output( "Executing: " . $command, 'info' );

		$descriptorspec = [
			0 => [ "pipe", "r" ],  // stdin
			1 => [ "pipe", "w" ],  // stdout
			2 => [ "pipe", "w" ]   // stderr
		];

		$process    = proc_open( $command, $descriptorspec, $pipes );
		$stdout     = stream_get_contents( $pipes[1] );
		fclose( $pipes[1] );
		$stderr     = stream_get_contents( $pipes[2] );
		fclose( $pipes[2] );
		$return_var = proc_close( $process );

		if ( ! empty( trim( $stdout ) ) ) {
			$this->output( trim( $stdout ), 'info' );
		}

		if ( $return_var !== 0 ) {
			$this->output( "$errorMessage (Exit code: $return_var)", 'error' );
			if ( ! empty( trim( $stderr ) ) ) {
				$this->output( "Error output:\n" . trim( $stderr ), 'error' );
			}

			return false;
		}

		$this->output( "Command executed successfully.", 'success' );

		return true;
	}
}
