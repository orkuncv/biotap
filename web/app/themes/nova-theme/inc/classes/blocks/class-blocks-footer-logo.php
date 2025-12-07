<?php
/**
 * Registers Custom Gutenberg Block: Footer Logo
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! interface_exists( 'Nova_Contracts_Gutenberg_Block' ) ) {
	require_once dirname( __DIR__ ) . '/contracts/class-contracts-gutenberg-block.php';
}

if ( ! class_exists( 'Nova_Blocks_Footer_Logo' ) ) :

	class Nova_Blocks_Footer_Logo implements Nova_Contracts_Gutenberg_Block {

		/**
		 * Registers the block.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_block(): void {
			$block_assets = $this->block_assets();

			// Register the editor script
			wp_register_script(
				'nova-footer-logo-editor',
				$block_assets['url'],
				[
					'wp-blocks',
					'wp-element',
					'wp-i18n',
					'wp-server-side-render',
					'wp-block-editor',
				],
				NOVA_THEME_VERSION,
				true
			);

			register_block_type( 'nova/footer-logo', [
				'api_version'     => 2,
				'category'        => 'nova',
				'editor_script'   => 'nova-footer-logo-editor',
				'render_callback' => [ $this, 'render_block' ],
				'attributes'      => [],
				'title'           => __( 'Footer Logo', 'nova' ),
				'description'     => __( 'Displays the site logo in the footer.', 'nova' ),
				'icon'            => 'format-image',
			] );
		}

		/**
		 * Enqueues the block assets.
		 *
		 * @return array
		 * @since 1.0.0
		 */
		public function block_assets(): array {
			return [
				'path' => get_template_directory() . '/assets/js/blocks/footer-logo.js',
				'url'  => get_template_directory_uri() . '/assets/js/blocks/footer-logo.js',
			];
		}

		/**
		 * Renders the block.
		 *
		 * @param array $attributes Block attributes.
		 * @param string $content Block content.
		 * @param ?WP_Block $block Block instance.
		 *
		 * @return string Rendered block content.
		 * @since 1.0.0
		 */
		public function render_block( array $attributes, string $content, ?WP_Block $block = null ): string {
			// First check Nova admin settings
			$logo_url = get_option( 'nova_theme_footer_logo', '' );

			// Fallback to WordPress custom logo if Nova logo not set
			if ( empty( $logo_url ) ) {
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				if ( $custom_logo_id ) {
					$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
				}
			}

			if ( ! empty( $logo_url ) ) {
				$home_url   = home_url( '/' );
				$alt_text   = sprintf( esc_attr__( '%s - Home', 'nova' ), get_bloginfo( 'name', 'display' ) );
				$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );

				$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'nova-footer-logo-block-wrapper' ] );

				ob_start();
				?>
				<div <?php echo $wrapper_attributes; ?>>
					<a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo $site_title; ?>" rel="home">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo $alt_text; ?>" class="nova-footer-logo" loading="lazy" height="42px"/>
					</a>
				</div>
				<?php
				return ob_get_clean();
			}

			return '';
		}

	}

endif;
