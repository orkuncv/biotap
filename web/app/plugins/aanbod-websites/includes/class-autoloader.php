<?php
/**
 * PSR-4 Autoloader for Aanbod Websites Plugin
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoloader class
 *
 * Handles PSR-4 autoloading with WordPress file naming conventions.
 */
class Autoloader {

	/**
	 * Namespace prefix
	 *
	 * @var string
	 */
	private string $namespace = 'Aanbod_Websites';

	/**
	 * Base directory path
	 *
	 * @var string
	 */
	private string $base_path;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->base_path = AANBOD_WEBSITES_PATH . 'includes/';
	}

	/**
	 * Register the autoloader
	 *
	 * @return void
	 */
	public function register(): void {
		spl_autoload_register( array( $this, 'load_class' ) );
	}

	/**
	 * Load a class file
	 *
	 * @param string $class The fully-qualified class name.
	 * @return void
	 */
	private function load_class( string $class ): void {
		// Check if class uses our namespace.
		if ( 0 !== strpos( $class, $this->namespace . '\\' ) ) {
			return;
		}

		// Remove namespace prefix.
		$relative_class = substr( $class, strlen( $this->namespace ) + 1 );

		// Convert namespace separators to directory separators.
		$relative_class = str_replace( '\\', '/', $relative_class );

		// Convert to WordPress file naming convention.
		// MyClass -> class-my-class.php
		$parts      = explode( '/', $relative_class );
		$class_name = array_pop( $parts );
		$class_file = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';

		// Build full path.
		$file = $this->base_path;
		if ( ! empty( $parts ) ) {
			$file .= implode( '/', $parts ) . '/';
		}
		$file .= $class_file;

		// Load file if exists.
		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
}
