# Nova CLI Documentation

## Overview

Nova uses a custom CLI system similar to Magento's `bin/magento` command structure. The CLI is accessible via `bin/nova` and supports multiple commands with options and flags.

## Quick Reference

```bash
# List all commands
php bin/nova

# Get help
php bin/nova <command> --help

# Setup new project
php bin/nova kickstart

# Setup existing project
php bin/nova kickstart --existing

# Install Nova theme
php bin/nova init-theme --license-key=YOUR_KEY

# Create theme package only (no install)
php bin/nova init-theme --skip-install

# Install specific branch
php bin/nova init-theme --license-key=YOUR_KEY --branch=development
```

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

**What it does:**
1. Downloads Roots Bedrock WordPress boilerplate
2. Copies files to your project directory
3. Creates/configures `.env` file with database settings
4. Fetches WordPress security salts
5. Configures environment files with Nova-specific constants

**Use cases:**
- Starting a new project: `php bin/nova kickstart`
- Cloning existing project: `php bin/nova kickstart --existing`
- CI/CD pipelines: `php bin/nova kickstart --no-env`

### init-theme
Clones the Nova theme from Git, prepares it, zips it, and installs it into your WordPress project.

```bash
php bin/nova init-theme --license-key=YOUR_KEY [options]
```

**Options:**
- `--license-key=KEY` - Your Nova theme license key (required for installation)
- `--branch=NAME` - Clone a specific git branch (default: master)
- `--force` - Force overwrite existing theme without confirmation
- `--skip-install` - Only build the theme zip, don't install it
- `--keep-zip` - Keep the generated zip file after installation

**What it does:**
1. **Clones** the Nova theme repository from Git (`git@github.com:orkuncv/nova-theme.git`)
2. **Removes** Git versioning (`.git` directory) from cloned theme
3. **Installs** Composer dependencies with production optimizations
4. **Creates** a distributable zip file (`nova.zip`)
5. **Cleans up** temporary clone directory
6. **Unzips** theme into `web/app/themes/nova/` (unless `--skip-install`)
7. **Removes** zip file after installation (unless `--keep-zip`)

**Use cases:**

**Standard installation:**
```bash
php bin/nova init-theme --license-key=YOUR_LICENSE_KEY
```
Clones, builds, and installs the Nova theme in one command.

**Install development branch:**
```bash
php bin/nova init-theme --license-key=YOUR_KEY --branch=development
```
Useful for testing unreleased features.

**Create distributable package only:**
```bash
php bin/nova init-theme --skip-install
```
Builds `nova.zip` without installing - great for creating theme packages for distribution.

**Force update without prompts:**
```bash
php bin/nova init-theme --license-key=YOUR_KEY --force
```
Overwrites existing theme installation without asking for confirmation.

**Keep zip for backup:**
```bash
php bin/nova init-theme --license-key=YOUR_KEY --keep-zip
```
Installs theme but keeps the zip file for backup or distribution.

**Requirements:**
- `git` command available in PATH
- `composer` command available in PATH
- `zip` command available in PATH
- PHP `zip` extension enabled

## Typical Workflow

### Starting a New Project from Scratch

```bash
# Step 1: Clone nova-kickstart repository
git clone git@github.com:orkuncv/nova-kickstart.git my-project
cd my-project

# Step 2: Setup Bedrock and WordPress
php bin/nova kickstart

# Step 3: Install Nova theme
php bin/nova init-theme --license-key=YOUR_LICENSE_KEY

# Step 4: Setup WordPress database (if needed)
wp core install --url=https://my-project.test --title="My Project" --admin_user=admin --admin_email=you@movve.nl --skip-email

# Step 5: Activate Nova theme
wp theme activate nova

# Step 6: Create child theme (optional)
wp nova create child-theme
wp theme activate nova-child
```

### Cloning an Existing Project

```bash
# Step 1: Clone the project repository
git clone <your-project-repo> my-project
cd my-project

# Step 2: Install WordPress and dependencies
php bin/nova kickstart --existing

# Step 3: Install Nova parent theme
php bin/nova init-theme --license-key=YOUR_LICENSE_KEY

# Step 4: Import database or install fresh
wp db import backup.sql
# OR
wp core install --url=https://my-project.test --title="My Project" --admin_user=admin --admin_email=you@movve.nl --skip-email

# Step 5: Activate themes
wp theme activate nova-child
```

### Updating Nova Theme

```bash
# Update to latest version from master branch
php bin/nova init-theme --license-key=YOUR_KEY --force

# Update to specific branch
php bin/nova init-theme --license-key=YOUR_KEY --branch=v2.0 --force
```

## Command Flow Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                     NOVA CLI WORKFLOW                        │
└─────────────────────────────────────────────────────────────┘

NEW PROJECT:
  Clone nova-kickstart
           ↓
  php bin/nova kickstart
           ↓
  ┌─────────────────────────┐
  │ • Download Bedrock      │
  │ • Setup .env file       │
  │ • Configure WordPress   │
  │ • Add Nova constants    │
  └─────────────────────────┘
           ↓
  php bin/nova init-theme --license-key=KEY
           ↓
  ┌─────────────────────────┐
  │ • Clone Nova theme      │
  │ • Remove .git           │
  │ • Composer install      │
  │ • Create nova.zip       │
  │ • Extract to themes/    │
  └─────────────────────────┘
           ↓
  wp core install + wp theme activate
           ↓
  🎉 READY TO DEVELOP


EXISTING PROJECT:
  Clone project repository
           ↓
  php bin/nova kickstart --existing
           ↓
  ┌─────────────────────────┐
  │ • Install WordPress     │
  │ • Preserve config/      │
  │ • Preserve child theme  │
  │ • Update .env           │
  └─────────────────────────┘
           ↓
  php bin/nova init-theme --license-key=KEY
           ↓
  ┌─────────────────────────┐
  │ • Install Nova parent   │
  └─────────────────────────┘
           ↓
  wp db import + wp theme activate
           ↓
  🎉 READY TO DEVELOP


THEME UPDATES:
  php bin/nova init-theme --license-key=KEY --force
           ↓
  ┌─────────────────────────┐
  │ • Fetch latest version  │
  │ • Overwrite theme       │
  │ • Keep child theme      │
  └─────────────────────────┘
           ↓
  🎉 THEME UPDATED
```

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
$registry->register( new InstallCommand() );  // init-theme command
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
    ├── KickstartCommand.php       # Kickstart command (setup Bedrock)
    ├── InstallCommand.php         # Init-theme command (install Nova theme)
    └── YourCustomCommand.php      # Your custom commands
```

## Troubleshooting

### General Issues

#### Command not found
- Ensure your command file is in `bin/commands/`
- Verify the class name matches the filename
- Check that you registered the command in `bin/nova`

#### Permission denied
Make sure `bin/nova` is executable:
```bash
chmod +x bin/nova
```

#### Autoloading issues
The CLI uses a custom autoloader that loads from:
1. `bin/commands/` directory
2. `bin/` directory

Ensure your class files are in one of these locations.

### kickstart Command Issues

#### "Database already exists" error
The kickstart command doesn't create databases. Create the database first:
```bash
# MySQL
mysql -u root -p -e "CREATE DATABASE your_database_name;"

# Or use your database management tool (TablePlus, phpMyAdmin, etc.)
```

#### ".env file already exists"
Use the `--existing` flag to preserve your existing configuration:
```bash
php bin/nova kickstart --existing
```

### init-theme Command Issues

#### "Git command not found"
Install Git on your system:
```bash
# macOS (using Homebrew)
brew install git

# Ubuntu/Debian
sudo apt-get install git

# Windows
# Download from https://git-scm.com/download/win
```

#### "Composer command not found"
Install Composer globally:
```bash
# Download and install
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### "zip command not found"
Install zip utility:
```bash
# Ubuntu/Debian
sudo apt-get install zip

# macOS (usually pre-installed)
brew install zip
```

#### "Permission denied" when cloning from Git
Ensure your SSH key is added to your Git account:
```bash
# Generate SSH key (if you don't have one)
ssh-keygen -t ed25519 -C "your_email@movve.nl"

# Add to ssh-agent
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519

# Copy public key and add to GitHub/GitLab
cat ~/.ssh/id_ed25519.pub
```

#### "Failed to clone repository"
Check your Git repository URL and access:
```bash
# Test SSH connection
ssh -T git@github.com

# Or manually clone to test
git clone git@github.com:orkuncv/nova-theme.git test-clone
```

#### "Composer install failed"
Common causes:
1. **PHP version mismatch**: Ensure you're using PHP 8.2+
   ```bash
   php -v
   ```
2. **Memory limit**: Increase PHP memory limit
   ```bash
   php -d memory_limit=512M bin/nova init-theme --license-key=YOUR_KEY
   ```
3. **Missing PHP extensions**: Check required extensions
   ```bash
   php -m | grep -E 'zip|curl|mbstring'
   ```

#### "Theme already installed" warning
Use the `--force` flag to overwrite:
```bash
php bin/nova init-theme --license-key=YOUR_KEY --force
```

#### Temporary directory not cleaned up
Manually remove it:
```bash
rm -rf temp-nova-theme-clone
```

#### License key validation fails
- Verify your license key is correct
- Check if you have an active license
- Contact support if issues persist

---

*Last updated: November 11 2025 - Copyright © 2025 Movve. All rights reserved.*
