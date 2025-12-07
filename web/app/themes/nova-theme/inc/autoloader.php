<?php
/**
 * Dependency bootstrap for the Nova theme.
 *
 * @package Nova\Core
 * @author  Movve – https://movve.nl
 * @since   1.0.0
 */

declare(strict_types=1);

if ( ! class_exists( 'Nova_Dependency_Manager' ) ) :

final class Nova_Dependency_Manager {

	/**
	 * The instance of the class.
	 *
	 * @var self|null
	 */
	private static ?self $instance = null;

	/**
	 * The constructor is private to prevent direct instantiation.
	 */
	private function __construct() {}

	/**
	 * The boot method is used to initialize the class.
	 *
	 * @return void
	 */
	public static function boot(): void {
		if ( self::$instance instanceof self ) {
			return;
		}
		self::$instance = new self();
		self::$instance->init();
	}

	/**
	 * The init method is used to initialize the class.
	 *
	 * @return void
	 */
	private function init(): void {
		$parent = get_template_directory();
		$child  = get_stylesheet_directory();

		// Composer autoload (PSR-4).
		$vendor = $parent . '/vendor/autoload.php';
		if ( file_exists( $vendor ) ) {
			require_once $vendor; // @codingStandardsIgnoreLine
		}

		// Legacy procedural helpers.
		$this->require_php_from( $parent . '/inc/functions' );
		$this->require_php_from( $parent . '/inc/classes' );

		if ( $child !== $parent ) {
			$this->require_php_from( $child . '/inc/functions' );
			$this->require_php_from( $child . '/inc/classes' );
		}
	}

	/**
	 * Recursively require all *.php files inside a directory.
	 *
	 * @param string $directory The directory to require files from.
	 *
	 * @return void
	 */
	private function require_php_from( string $directory ): void {
		if ( ! is_dir( $directory ) ) {
			return;
		}
		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $directory, \RecursiveDirectoryIterator::SKIP_DOTS )
		);

		/** @var SplFileInfo $file */
		foreach ( $iterator as $file ) {
			if ( $file->getExtension() === 'php' ) {
				require_once $file->getRealPath(); // @codingStandardsIgnoreLine
			}
		}
	}
}

endif;

/**
 * Boot the dependency manager.
 * This method is used to initialize the dependency manager.
 *
 * @since 1.0.0
 */
Nova_Dependency_Manager::boot();
