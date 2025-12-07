<?php
/**
 * Title: Text description, full width
 * Slug: nova/description-text-full
 * Categories: description, text
 * Description: A full-width text block with an over-title, heading, tags, and a call-to-action button.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">

		<!-- wp:paragraph {"className":"is-style-uppercase-small","textColor":"nova-75"} -->
		<p aria-hidden="true" class="is-style-uppercase-small has-nova-75-color has-text-color"><?php echo esc_html_x( 'Open', 'Description over-title', 'nova' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"xl-heading"} -->
		<h2 class="wp-block-heading has-xl-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Description heading', 'nova' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left","flexWrap":"wrap"}} -->
		<div class="wp-block-buttons is-content-justification-left is-layout-flex">

			<!-- wp:button {"className":"is-style-rounded-outline","style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40","top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"fontSize":"label"} -->
			<div class="wp-block-button is-style-rounded-outline">
				<a class="wp-block-button__link has-label-font-size has-custom-font-size wp-element-button" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--40)"><?php echo esc_html_x( '32/40 uur', 'Description tag 1', 'nova' ); ?></a>
			</div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-rounded-outline","style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40","top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"fontSize":"label"} -->
			<div class="wp-block-button is-style-rounded-outline">
				<a class="wp-block-button__link has-label-font-size has-custom-font-size wp-element-button" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--40)"><?php echo esc_html_x( 'Gouda', 'Description tag 2', 'nova' ); ?></a>
			</div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-rounded-outline","style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40","top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"fontSize":"label"} -->
			<div class="wp-block-button is-style-rounded-outline">
				<a class="wp-block-button__link has-label-font-size has-custom-font-size wp-element-button" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--40)"><?php echo esc_html_x( 'HBO', 'Description tag 3', 'nova' ); ?></a>
			</div>
			<!-- /wp:button -->

		</div>
		<!-- /wp:buttons -->

		<!-- wp:spacer {"height":"16px"} -->
		<div style="height:16px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">

			<!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
			<div class="wp-block-button">
				<a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button"><?php echo esc_html_x( 'Solliciteer direct', 'Description CTA button', 'nova' ); ?></a>
			</div>
			<!-- /wp:button -->

		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->