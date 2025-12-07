<?php
/**
 * Title: Footer, columns + actions + ticker
 * Slug: nova/footer-columns-actions
 * Categories: footer
 * BlockTypes: core/template-part/footer
 * Description: Footer columns with multiple actions
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

$menu_titles = [
	'footer_1' => 'Footer Menu 1',
	'footer_2' => 'Footer Menu 2',
	'privacy'  => 'Privacy Menu',
];

$menus = [];

if ( function_exists( 'nova_get_post_by_title' ) ) {
	foreach ( $menu_titles as $key => $title ) {
		$post          = nova_get_post_by_title( $title, 'wp_navigation' );
		$menus[ $key ] = $post ? (int) $post->ID : 0;
	}
} else {
	$menus = array_fill_keys( array_keys( $menu_titles ), 0 );
}
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"nova-100","textColor":"white","className":"vb-footer-columns-actions-ticker","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull vb-footer-columns-actions-ticker has-white-color has-nova-100-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide vb-footer-menus-wrapper">

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column">
			<!-- wp:nova/footer-logo /-->

			<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"}},"fontSize":"s-heading"} -->
			<h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:600;"><?php echo esc_html_x( 'Headquarter', 'Footer headquarter title', 'nova' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.6"}},"fontSize":"p-default"} -->
			<p class="has-p-default-font-size" style="line-height:1.6"><?php echo esc_html_x( '12, Lorum Ipsum,', 'Footer address line 1', 'nova' ); ?><br/><?php echo esc_html_x( '1234 AB Amsterdam', 'Footer address line 2', 'nova' ); ?><br/><?php echo esc_html_x( '01 23 45 67 89', 'Footer phone', 'nova' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
			<h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 1', 'nova' ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_1']; ?>} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
			<h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 2', 'nova' ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_2']; ?>} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:buttons {"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"},"style":{"spacing":{"blockGap":"var:preset|spacing|15"}}, "className":"vb-footer-actions"} -->
			<div class="wp-block-buttons vb-footer-actions">
				<!-- wp:button {"className":"has-white-border-color is-style-outline"} -->
				<div class="wp-block-button has-white-border-color is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'CONTACT', 'Footer contact button', 'nova' ); ?></a></div>
				<!-- /wp:button -->
				<!-- wp:button {"className":"has-white-border-color is-style-outline"} -->
				<div class="wp-block-button has-white-border-color is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'SIGN-IN', 'Footer sign-in button', 'nova' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

	<!-- wp:separator {"align":"wide","backgroundColor":"nova-75","className":"is-style-wide"} -->
	<hr class="wp-block-separator alignwide has-text-color has-nova-75-color has-alpha-channel-opacity has-nova-75-background-color has-background is-style-wide"/>
	<!-- /wp:separator -->

	<!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"className":"vb-footer-socials-ticker"} -->
	<div class="wp-block-group alignwide vb-footer-socials-ticker">
		<!-- wp:nova/social-links /-->

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"vb-footer-ticker"} -->
		<div class="wp-block-group vb-footer-ticker">
			<!-- wp:html -->
			<span aria-hidden="true" class="vb-ticker-icon" style="display:inline-flex;align-items:center"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" role="img" focusable="false"><path d="M3 3v18h18v-2H5.41l6.3-6.3 3.3 3.3 6-6V6.59l-6 6-3.3-3.3L5 15.59V3H3z"/></svg></span>
			<!-- /wp:html -->

			<!-- wp:paragraph {"fontSize":"p-small"} -->
			<p class="has-p-small-font-size"><?php echo esc_html_x( 'Share priceDWG', 'Footer ticker label', 'nova' ); ?> | <?php echo esc_html_x( '20.00 €', 'Footer ticker price', 'nova' ); ?> | <?php echo esc_html_x( '-0.25 %', 'Footer ticker change', 'nova' ); ?> | <?php echo esc_html_x( '12/05/2022', 'Footer ticker date', 'nova' ); ?> | <?php echo esc_html_x( '15:07 CEST', 'Footer ticker time', 'nova' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:separator {"align":"wide","backgroundColor":"nova-75","className":"is-style-wide"} -->
	<hr class="wp-block-separator alignwide has-text-color has-nova-75-color has-alpha-channel-opacity has-nova-75-background-color has-background is-style-wide"/>
	<!-- /wp:separator -->

	<!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['privacy']; ?>} /-->

		<!-- wp:paragraph {"fontSize":"p-small"} -->
		<p class="has-p-small-font-size">
			<?php
			printf(
				'© %s Nova | Design & Webdevelopment by – <a href="%s" target="_blank" rel="noopener">Movve Interactive</a>',
				esc_html( gmdate( 'Y' ) ),
				esc_url( 'https://www.movve.nl/' )
			);
			?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->