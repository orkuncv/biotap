<?php
/**
 * Title: Features row
 * Slug: nova/features-row
 * Categories: features
 * Description: A two-column layout with a title, intro, and a row of three features on the left, and an image placeholder on the right.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-top">

		<!-- wp:column {"width":"58%","verticalAlignment":"top"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:58%">

			<!-- wp:paragraph {"className":"is-style-uppercase-small","textColor":"nova-75"} -->
			<p class="is-style-uppercase-small has-nova-75-color has-text-color"><?php echo esc_html_x( 'Label', 'Features row label', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"fontSize":"xl-heading"} -->
			<h2 class="wp-block-heading has-xl-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Features row heading', 'nova' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor gravida viverra. Tempus etiam aliquet sodales quisque consectetur pellentesque in tincidunt nam.', 'Features row intro text', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
			<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-columns">
				<!-- wp:column {"layout":{"type":"flex","orientation":"vertical","justifyContent":"start"}} -->
				<div class="wp-block-column">
					<!-- wp:image {"width":64,"height":64,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized">
						<img src="<?php echo get_template_directory_uri() . '/assets/svg/nova_theme_icon_color.svg'; ?>" alt="Placeholder icon" width="64" height="64"/>
					</figure>
					<!-- /wp:image -->
					<!-- wp:heading {"textAlign":"center","level":4,"fontSize":"s-heading"} -->
					<h4 class="wp-block-heading has-text-align-center has-s-heading-font-size"><?php echo esc_html_x( 'Feature name', 'Feature item title 3', 'nova' ); ?></h4>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"align":"left","fontSize":"p-small"} -->
					<p class="has-text-align-left has-p-small-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Feature item description 3', 'nova' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column {"layout":{"type":"flex","orientation":"vertical","justifyContent":"start"}} -->
				<div class="wp-block-column">
					<!-- wp:image {"width":64,"height":64,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized">
						<img src="<?php echo get_template_directory_uri() . '/assets/svg/nova_theme_icon_color.svg'; ?>" alt="Placeholder icon" width="64" height="64"/>
					</figure>
					<!-- /wp:image -->
					<!-- wp:heading {"textAlign":"center","level":4,"fontSize":"s-heading"} -->
					<h4 class="wp-block-heading has-text-align-center has-s-heading-font-size"><?php echo esc_html_x( 'Feature name', 'Feature item title 3', 'nova' ); ?></h4>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"align":"left","fontSize":"p-small"} -->
					<p class="has-text-align-left has-p-small-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Feature item description 3', 'nova' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column {"layout":{"type":"flex","orientation":"vertical","justifyContent":"start"}} -->
				<div class="wp-block-column">
					<!-- wp:image {"width":64,"height":64,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized">
						<img src="<?php echo get_template_directory_uri() . '/assets/svg/nova_theme_icon_color.svg'; ?>" alt="Placeholder icon" width="64" height="64"/>
					</figure>
					<!-- /wp:image -->
					<!-- wp:heading {"textAlign":"center","level":4,"fontSize":"s-heading"} -->
					<h4 class="wp-block-heading has-text-align-center has-s-heading-font-size"><?php echo esc_html_x( 'Feature name', 'Feature item title 3', 'nova' ); ?></h4>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"align":"left","fontSize":"p-small"} -->
					<p class="has-text-align-left has-p-small-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Feature item description 3', 'nova' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top"} -->
		<div class="wp-block-column is-vertically-aligned-top">
			<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":510,"isDark":false,"className":"nova-image-placeholder","backgroundColor":"nova-10"} -->
			<div class="wp-block-cover is-light nova-image-placeholder has-nova-10-background-color has-background" style="min-height:510px">
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

</div>
<!-- /wp:group -->