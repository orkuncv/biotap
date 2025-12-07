<?php
/**
 * Title: Description, image right
 * Slug: nova/description-image-left
 * Categories: description
 * Description: A two-column layout with text and buttons on the right and an image placeholder on the left.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-top alignwide">

		<!-- wp:column {"verticalAlignment":"top"} -->
		<div class="wp-block-column is-vertically-aligned-top">

			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":640,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:640px">
				<span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>
				<div class="wp-block-cover__inner-container">
					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph -->
				</div>
			</div>
			<!-- /wp:cover -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"58%","verticalAlignment":"center","style":{"spacing":{"blockGap":"2rem"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">

			<!-- wp:paragraph {"className":"is-style-uppercase-small","textColor":"nova-75"} -->
			<p class="is-style-uppercase-small has-nova-75-color has-text-color"><?php echo esc_html_x( 'Label', 'Pattern description label', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"fontSize":"xl-heading"} -->
			<h2 class="wp-block-heading has-xl-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Pattern description heading', 'nova' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Eget ut malesuada purus vitae eu sapien felis. This is a place for an excerpt. Lorem ipsum dolor sit amet consectetur.', 'Pattern description text', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">

				<!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
				<div class="wp-block-button">
					<a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button"><?php echo esc_html_x( 'Button Label', 'Pattern primary button', 'nova' ); ?></a>
				</div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline">
					<a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Button Label', 'Pattern secondary button', 'nova' ); ?></a>
				</div>
				<!-- /wp:button -->

			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->