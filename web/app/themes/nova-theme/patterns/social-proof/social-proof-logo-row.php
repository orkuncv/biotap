<?php
/**
 * Title: Social proof, logo row
 * Slug: nova/social-proof-logo-row
 * Categories: social-proof
 * Description: A full-width section with a centered title, description, a row of logos, and call-to-action buttons.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xl-heading"} -->
	<h2 class="wp-block-heading has-text-align-center has-xl-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Logo row heading', 'nova' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor gravida viverra. Tempus etiam aliquet sodales quisque consectetur pellentesque in tincidunt nam.', 'Logo row description', 'nova' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
	<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":90,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:90px">
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

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":90,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:90px">
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

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":90,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:90px">
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

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":90,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:90px">
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

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":90,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:90px">
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

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":90,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:90px">
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

	</div>
	<!-- /wp:columns -->

	<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
	<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons is-content-justification-center is-layout-flex">

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
<!-- /wp:group -->