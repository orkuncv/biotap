<?php
/**
 * Registers Custom Gutenberg Block: Social Icons
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! interface_exists( 'Nova_Contracts_Gutenberg_Block' ) ) {
	require_once dirname( __DIR__ ) . '/contracts/class-contracts-gutenberg-block.php';
}

if ( ! class_exists( 'Nova_Blocks_Social_Icons' ) ) :

	class Nova_Blocks_Social_Icons implements Nova_Contracts_Gutenberg_Block {

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
				'nova-social-icons-editor',
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

			register_block_type( 'nova/social-links', [
				'api_version'     => 2,
				'category'        => 'nova',
				'editor_script'   => 'nova-social-icons-editor',
				'render_callback' => [ $this, 'render_block' ],
				'attributes'      => [],
				'title'           => __( 'Social Media Links', 'nova' ),
				'description'     => __( 'Displays the social media links defined in theme settings.', 'nova' ),
				'icon'            => 'share',
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
				'path' => get_template_directory() . '/assets/js/blocks/social-icons.js',
				'url'  => get_template_directory_uri() . '/assets/js/blocks/social-icons.js',
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
			$links_data = [];
			$networks   = [ 'instagram', 'facebook', 'linkedin', 'youtube' ];

			foreach ( $networks as $network ) {
				$url = get_option( "nova_theme_{$network}", '' );
				$url = esc_url( $url );

				if ( ! empty( $url ) ) {
					$network_slug = sanitize_key( $network );
					$network_name = ucfirst( $network );

					$links_data[] = [
						'network_slug'       => esc_attr( $network_slug ),
						'url'                => $url,
						'aria_label'         => sprintf( esc_attr__( 'Follow us on %s', 'nova' ), $network_name ),
						'screen_reader_text' => esc_html( $network_name ),
					];
				}
			}

			if ( empty( $links_data ) ) {
				return '';
			}

			$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'nova-social-links-block-wrapper' ] );

			ob_start();
			?>
			<div <?php echo $wrapper_attributes; ?>>
				<ul class="nova-social-links-list">
					<?php foreach ( $links_data as $link_data ) : ?>
						<?php
						$network_slug       = $link_data['network_slug'];
						$url                = $link_data['url'];
						$aria_label         = $link_data['aria_label'];
						$screen_reader_text = $link_data['screen_reader_text'];
						$icon_html          = function_exists( 'get_svg' ) ? get_svg( $network_slug ) : "<!-- SVG {$network_slug} -->";
						?>
						<li class="social-item social-item-<?php echo esc_attr( $network_slug ); ?>">
							<a href="<?php echo esc_url( $url ); ?>"
							   target="_blank"
							   rel="noopener noreferrer"
							   class="social-link social-link-<?php echo esc_attr( $network_slug ); ?>"
							   aria-label="<?php echo esc_attr( $aria_label ); ?>"
							   title="<?php echo esc_attr( $aria_label ); ?>"
							>
								<span class="screen-reader-text"><?php echo esc_html( $screen_reader_text ); ?></span>
								<?php echo $icon_html; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php
			return ob_get_clean();
		}

	}

endif;
