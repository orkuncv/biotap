# Nova CLI Documentation

## Overview

Nova uses a custom CLI system similar to Magento's `bin/magento` command structure. The CLI is accessible via `bin/nova` and supports multiple commands with options and flags.

## Usage

```bash
php bin/nova <command> [options]
```

### List All Commands

```bash
php bin/nova
```

### Get Help for a Specific Command

```bash
php bin/nova <command> --help
# or
php bin/nova help <command>
```

## Available Commands

### kickstart
Sets up a new Bedrock project in the current directory with Nova defaults.

```bash
php bin/nova kickstart [--existing] [--no-env]
```

**Options:**
- `--existing` - Run on an existing project, preserving specific files/directories
- `--no-env` - Skip .env file interaction (useful for CI/CD)

### install
Install the Nova theme with a license key.

```bash
php bin/nova install --license-key=YOUR_KEY [--skip-activation]
```

**Options:**
- `--license-key=KEY` - Your Nova theme license key (required)
- `--skip-activation` - Skip theme activation after installation

## Creating Custom Commands

### Step 1: Create a New Command Class

Create a new PHP file in `bin/commands/` directory:

```php
<?php
/**
 * Nova Theme - Vivid CLI Tool
 *
 * @author  Movve - https://movve.nl
 * @package Nova/Vivid
 * @since   1.0.0
 */

class YourCustomCommand extends AbstractCommand {

	/**
	 * Get the name of the command.
	 *
	 * @return string The name of the command.
	 */
	public function getName(): string {
		return 'your-command';
	}

	/**
	 * Get the description of the command.
	 *
	 * @return string The description of the command.
	 */
	public function getDescription(): string {
		return 'Description of what your command does.';
	}

	/**
	 * Get the options help for the command.
	 *
	 * @return array The options help for the command.
	 */
	public function getOptionsHelp(): array {
		return [
			[
				'option'      => '--option-name',
				'description' => 'Description of this option'
			],
		];
	}

	/**
	 * Execute the command.
	 *
	 * @param array $options The options passed to the command.
	 *
	 * @return int The exit code (0 for success, non-zero for failure).
	 */
	public function execute( array $options ): int {
		$this->output( "Your command is executing...", 'info' );

		// Your command logic here

		$this->output( "Command completed!", 'success' );

		return 0;
	}
}
```

### Step 2: Register Your Command

Open `bin/nova` and add your command to the registry:

```php
// Register commands
$registry->register( new KickstartCommand() );
$registry->register( new InstallCommand() );
$registry->register( new YourCustomCommand() );  // Add this line
```

### Step 3: Test Your Command

```bash
php bin/nova your-command
```

## AbstractCommand Methods

Your command classes extend `AbstractCommand` and have access to these helper methods:

### output()
Display colored output to the console.

```php
$this->output( "Message here", 'info' );    // Cyan
$this->output( "Success!", 'success' );      // Green
$this->output( "Warning!", 'warning' );      // Yellow
$this->output( "Error!", 'error' );          // Red
```

### ask()
Prompt the user for input.

```php
$name = $this->ask( "What is your name?", "Default Value" );
```

### executeShellCommand()
Execute a shell command with error handling.

```php
$success = $this->executeShellCommand(
	'ls -la',
	'Failed to list directory'
);

if ( !$success ) {
	return 1; // Return error code
}
```

## Command Options

The `execute()` method receives an `$options` array with the following structure:

```php
[
	'option-name' => 'value',      // Long options with values: --option-name=value
	'f'           => true,          // Short flags: -f
	'args'        => [              // Other arguments and flags
		'--flag-option',
		'regular-argument'
	]
]
```

### Accessing Options

```php
public function execute( array $options ): int {
	// Get option with default
	$licenseKey = $options['license-key'] ?? 'default-value';

	// Check if flag exists
	$skipActivation = in_array( '--skip-activation', $options['args'] ?? [] );

	// Get short flag
	$verbose = $options['v'] ?? false;

	return 0;
}
```

## Examples

### Example 1: Simple Command

```php
class HelloCommand extends AbstractCommand {
	public function getName(): string {
		return 'hello';
	}

	public function getDescription(): string {
		return 'Say hello to someone.';
	}

	public function getOptionsHelp(): array {
		return [
			[
				'option'      => '--name=NAME',
				'description' => 'Name to greet'
			],
		];
	}

	public function execute( array $options ): int {
		$name = $options['name'] ?? $this->ask( "What is your name?", "World" );
		$this->output( "Hello, {$name}!", 'success' );
		return 0;
	}
}
```

Usage:
```bash
php bin/nova hello --name=John
# or
php bin/nova hello
```

### Example 2: Command with Multiple Steps

```php
class SetupCommand extends AbstractCommand {
	public function getName(): string {
		return 'setup';
	}

	public function getDescription(): string {
		return 'Set up the development environment.';
	}

	public function execute( array $options ): int {
		$this->output( "Starting setup...\n", 'info' );

		// Step 1
		$this->output( "Step 1: Installing dependencies...", 'info' );
		if ( !$this->executeShellCommand( 'composer install', 'Failed to install dependencies' ) ) {
			return 1;
		}

		// Step 2
		$this->output( "\nStep 2: Building assets...", 'info' );
		if ( !$this->executeShellCommand( 'npm install && npm run build', 'Failed to build assets' ) ) {
			return 1;
		}

		// Step 3
		$this->output( "\nStep 3: Setting up database...", 'info' );
		$dbName = $this->ask( "Database name?" );
		$this->output( "Database '{$dbName}' configured.", 'success' );

		$this->output( "\nSetup completed successfully!", 'success' );
		return 0;
	}
}
```

## Best Practices

1. **Return exit codes**: Always return `0` for success, non-zero for errors
2. **Validate input**: Check required options and provide helpful error messages
3. **Use output types**: Use appropriate output types (info, success, warning, error)
4. **Provide help**: Always implement `getOptionsHelp()` with clear descriptions
5. **Handle errors**: Use try-catch and provide meaningful error messages
6. **Test thoroughly**: Test your commands with various options and edge cases

## Architecture

The Nova CLI system consists of:

- **bin/nova** - Main entry point and command dispatcher
- **bin/CommandRegistry.php** - Registers and manages commands
- **bin/commands/AbstractCommand.php** - Base class for all commands
- **bin/commands/*.php** - Individual command implementations

```
bin/
├── nova                           # Main CLI entry point
├── CommandRegistry.php            # Command registry and dispatcher
└── commands/
    ├── AbstractCommand.php        # Base command class
    ├── KickstartCommand.php       # Kickstart command
    ├── InstallCommand.php         # Install command
    └── YourCustomCommand.php      # Your custom commands
```

## Troubleshooting

### Command not found
- Ensure your command file is in `bin/commands/`
- Verify the class name matches the filename
- Check that you registered the command in `bin/nova`

### Permission denied
Make sure `bin/nova` is executable:
```bash
chmod +x bin/nova
```

### Autoloading issues
The CLI uses a custom autoloader that loads from:
1. `bin/commands/` directory
2. `bin/` directory

Ensure your class files are in one of these locations.

---

*Last updated: November 11 2025 - Copyright © 2025 Movve. All rights reserved.*
