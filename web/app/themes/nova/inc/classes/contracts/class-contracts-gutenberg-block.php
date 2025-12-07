<?php
/**
 * Nova Block Contracts
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! interface_exists( 'Nova_Contracts_Gutenberg_Block' ) ) :

	interface Nova_Contracts_Gutenberg_Block {
		/**
		 * Registers the block.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_block(): void;

		/**
		 * Enqueues the block assets.
		 *
		 * @return array
		 */
		public function block_assets(): array;

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
		public function render_block( array $attributes, string $content, ?WP_Block $block = null ): string;
	}

endif;
