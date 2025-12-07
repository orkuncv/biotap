<?php
/**
 * Nova Child Theme Setup Class
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! class_exists( 'Nova_Child_Theme_Setup' ) ) :

	class Nova_Child_Theme_Setup {

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		}

		/**
		 * Enqueue child theme styles
		 *
		 * @since 1.0.0
		 */
		public function enqueue_styles(): void {
			$parent_version = wp_get_theme( get_template() )->get( 'Version' );
			$child_version  = wp_get_theme()->get( 'Version' );

			// Enqueue parent theme styles
			wp_enqueue_style(
				'nova-parent-style',
				get_template_directory_uri() . '/style.css',
				[],
				$parent_version
			);

			// Enqueue child theme styles
			wp_enqueue_style(
				'nova-child-style',
				get_stylesheet_uri(),
				[ 'nova-parent-style' ],
				$child_version
			);
		}
	}

endif;
