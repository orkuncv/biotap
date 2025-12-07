<?php
/**
 * Registers Custom Gutenberg Blocks for the Nova Theme.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! class_exists( 'Nova_Support_Gutenberg_Blocks' ) ) :

	class Nova_Support_Gutenberg_Blocks {

		/**
		 * Array of block classes.
		 *
		 * @var array<Nova_Contracts_Gutenberg_Block>
		 * @since 1.0.0
		 */
		private array $block_classes = [];

		/**
		 * Constructor. Hooks into WordPress initialization.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->get_block_classes();

			add_action( 'init', [ $this, 'register_blocks' ] );
			add_action( 'block_categories_all', [ $this, 'register_category' ], 10, 2 );
		}

		/**
		 * Registers the custom block category.
		 *
		 * @param array $categories Default block categories.
		 * @param WP_Block_Editor_Context $editor_context Editor context.
		 *
		 * @return array Filtered block categories.
		 * @since 1.0.0
		 */
		public function register_category( array $categories, WP_Block_Editor_Context $editor_context ): array {
			$category_slugs = wp_list_pluck( $categories, 'slug' );

			if ( ! in_array( 'nova', $category_slugs, true ) ) {
				$categories[] = [
					'slug'  => 'nova',
					'title' => __( 'Nova Theme', 'nova' ),
				];
			}

			return $categories;
		}

		/**
		 * Retrieves the block classes.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		private function get_block_classes(): void {
			$directory   = get_template_directory() . '/inc/classes/blocks/';
			$block_files = glob( $directory . '*.php' );

			foreach ( $block_files as $file ) {
				$class_name = basename( $file, '.php' );
				$class_name = str_replace( 'class-', '', $class_name );
				$class_name = str_replace( '-', '_', $class_name );
				$class_name = preg_replace_callback(
					'/_(.)/',
					function ( $matches ) {
						return '_' . strtoupper( $matches[1] );
					},
					$class_name
				);

				$class_name = 'Nova_' . $class_name;

				if ( class_exists( $class_name ) && is_subclass_of( $class_name, 'Nova_Contracts_Gutenberg_Block' ) ) {
					$this->block_classes[$class_name] = new $class_name();
				}
			}
		}

		/**
		 * Registers the custom block types.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_blocks(): void {
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			if ( empty( $this->block_classes ) ) {
				return;
			}

			foreach ( $this->block_classes as $block_class ) {
				$block_class->register_block();
			}
		}
	}

endif;
