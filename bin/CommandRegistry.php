<?php
/**
 * Nova Theme - Vivid CLI Tool
 *
 * @author  Movve - https://movve.nl
 * @package Nova/Vivid
 * @since   1.0.0
 */

class CommandRegistry {

	/**
	 * @var AbstractCommand[] Registered commands
	 */
	private array $commands = [];

	/**
	 * Register a command.
	 *
	 * @param AbstractCommand $command The command to register.
	 *
	 * @return void
	 */
	public function register( AbstractCommand $command ): void {
		$this->commands[ $command->getName() ] = $command;
	}

	/**
	 * Get all registered commands.
	 *
	 * @return AbstractCommand[] The registered commands.
	 */
	public function getCommands(): array {
		return $this->commands;
	}

	/**
	 * Get a command by name.
	 *
	 * @param string $name The name of the command.
	 *
	 * @return AbstractCommand|null The command or null if not found.
	 */
	public function getCommand( string $name ): ?AbstractCommand {
		return $this->commands[ $name ] ?? null;
	}

	/**
	 * Display the list of available commands.
	 *
	 * @return void
	 */
	public function showCommandList(): void {
		echo "\033[0;32m" . "Nova CLI - Available Commands" . "\033[0m" . PHP_EOL;
		echo str_repeat( "=", 50 ) . PHP_EOL . PHP_EOL;

		if ( empty( $this->commands ) ) {
			echo "\033[0;33m" . "No commands registered." . "\033[0m" . PHP_EOL;

			return;
		}

		foreach ( $this->commands as $command ) {
			printf(
				"  \033[0;36m%-15s\033[0m %s\n",
				$command->getName(),
				$command->getDescription()
			);
		}

		echo PHP_EOL . "Usage: php bin/nova <command> [options]" . PHP_EOL;
		echo "For help on a specific command, use: php bin/nova <command> --help" . PHP_EOL;
	}

	/**
	 * Run a command with the given arguments.
	 *
	 * @param array $argv The command-line arguments.
	 *
	 * @return int The exit code.
	 */
	public function run( array $argv ): int {
		// Remove script name
		array_shift( $argv );

		// Check if a command is provided
		if ( empty( $argv ) ) {
			$this->showCommandList();

			return 0;
		}

		$commandName = array_shift( $argv );

		// Handle --help or help
		if ( $commandName === '--help' || $commandName === 'help' ) {
			if ( ! empty( $argv ) ) {
				$helpCommandName = array_shift( $argv );
				$command         = $this->getCommand( $helpCommandName );
				if ( $command ) {
					echo $command->getUsage();

					return 0;
				} else {
					echo "\033[0;31m" . "Command '{$helpCommandName}' not found." . "\033[0m" . PHP_EOL;

					return 1;
				}
			}
			$this->showCommandList();

			return 0;
		}

		// Get the command
		$command = $this->getCommand( $commandName );

		if ( ! $command ) {
			echo "\033[0;31m" . "Command '{$commandName}' not found." . "\033[0m" . PHP_EOL . PHP_EOL;
			$this->showCommandList();

			return 1;
		}

		// Check for --help flag for specific command
		if ( in_array( '--help', $argv ) || in_array( '-h', $argv ) ) {
			echo $command->getUsage();

			return 0;
		}

		// Parse options
		$options = $this->parseOptions( $argv );

		// Execute the command
		try {
			return $command->execute( $options );
		} catch ( Exception $e ) {
			echo "\033[0;31m" . "Error executing command: " . $e->getMessage() . "\033[0m" . PHP_EOL;

			return 1;
		}
	}

	/**
	 * Parse command-line options.
	 *
	 * @param array $argv The arguments to parse.
	 *
	 * @return array The parsed options.
	 */
	private function parseOptions( array $argv ): array {
		$options = [
			'args' => []
		];

		foreach ( $argv as $arg ) {
			if ( strpos( $arg, '--' ) === 0 ) {
				// Long option: --key=value or --flag
				$arg = substr( $arg, 2 );
				if ( strpos( $arg, '=' ) !== false ) {
					list( $key, $value ) = explode( '=', $arg, 2 );
					$options[ $key ] = $value;
				} else {
					$options['args'][] = '--' . $arg;
				}
			} elseif ( strpos( $arg, '-' ) === 0 && strlen( $arg ) > 1 ) {
				// Short option: -k value or -f
				$key             = substr( $arg, 1 );
				$options[ $key ] = true;
			} else {
				// Regular argument
				$options['args'][] = $arg;
			}
		}

		return $options;
	}
}
