<?php
/**
 * Title: Features grid
 * Slug: nova/features-grid
 * Categories: features
 * Description: A two-column layout featuring a title, description, and CTAs on the left, with a 2x2 grid of features with icons on the right.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-top">

        <!-- wp:column {"width":"45%","style":{"spacing":{"blockGap":"2rem"}}} -->
		<div class="wp-block-column" style="flex-basis:45%">

			<!-- wp:paragraph {"className":"is-style-uppercase-small","textColor":"nova-75"} -->
			<p class="is-style-uppercase-small has-nova-75-color has-text-color"><?php echo esc_html_x( 'Label', 'Features grid over-title', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"fontSize":"xl-heading"} -->
			<h2 class="wp-block-heading has-xl-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Features grid heading', 'nova' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor gravida viverra. Tempus etiam aliquet sodales quisque consectetur pellentesque in tincidunt nam.', 'Features grid description', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
				<div class="wp-block-button">
					<a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button">
						<?php echo esc_html_x( 'Button Label', 'Features grid primary button', 'nova' ); ?>
					</a>
				</div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline">
					<a class="wp-block-button__link wp-element-button">
						<?php echo esc_html_x( 'Button Label', 'Features grid secondary button', 'nova' ); ?>
					</a>
				</div>
				<!-- /wp:button -->

			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:columns {"style":{"spacing":{"blockGap":"0.75rem"}}} -->
			<div class="wp-block-columns">

                <!-- wp:column {"style":{"spacing":{"blockGap":"0.75rem"}}} -->
				<div class="wp-block-column">

					<!-- wp:image {"width":64,"height":64,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized">
						<img src="<?php echo get_template_directory_uri() . '/assets/svg/nova_theme_icon_color.svg'; ?>" alt="Placeholder icon" width="64" height="64"/>
					</figure>
					<!-- /wp:image -->

                    <!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400","lineHeight":"28px"}},"fontSize":"s-heading"} -->
                    <h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;line-height:28px"><?php echo esc_html_x( 'Feature name', 'Feature name', 'nova' ); ?></h3>
                    <!-- /wp:heading -->

					<!-- wp:paragraph {"fontSize":"p-default"} -->
					<p class="has-p-default-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Feature description 1', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

                    <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
                    <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
                    <!-- /wp:spacer -->

					<!-- wp:image {"width":64,"height":64,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized">
						<img src="<?php echo get_template_directory_uri() . '/assets/svg/nova_theme_icon_color.svg'; ?>" alt="Placeholder icon" width="64" height="64"/>
					</figure>
					<!-- /wp:image -->

                    <!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400","lineHeight":"28px"}},"fontSize":"s-heading"} -->
                    <h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;line-height:28px"><?php echo esc_html_x( 'Feature name', 'Feature name', 'nova' ); ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"fontSize":"p-default"} -->
                    <p class="has-p-default-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Feature description 1', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->

				</div>
				<!-- /wp:column -->

                <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
                <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:column {"style":{"spacing":{"blockGap":"0.75rem"}}} -->
                <div class="wp-block-column">

					<!-- wp:image {"width":64,"height":64,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized">
						<img src="<?php echo get_template_directory_uri() . '/assets/svg/nova_theme_icon_color.svg'; ?>" alt="Placeholder icon" width="64" height="64"/>
					</figure>
					<!-- /wp:image -->

                    <!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400","lineHeight":"28px"}},"fontSize":"s-heading"} -->
                    <h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;line-height:28px"><?php echo esc_html_x( 'Feature name', 'Feature name', 'nova' ); ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"fontSize":"p-default"} -->
                    <p class="has-p-default-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Feature description 1', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
                    <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
                    <!-- /wp:spacer -->

					<!-- wp:image {"width":64,"height":64,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized">
						<img src="<?php echo get_template_directory_uri() . '/assets/svg/nova_theme_icon_color.svg'; ?>" alt="Placeholder icon" width="64" height="64"/>
					</figure>
					<!-- /wp:image -->

                    <!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400","lineHeight":"28px"}},"fontSize":"s-heading"} -->
                    <h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;line-height:28px"><?php echo esc_html_x( 'Feature name', 'Feature name', 'nova' ); ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"fontSize":"p-default"} -->
                    <p class="has-p-default-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Feature description 1', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->

				</div>
				<!-- /wp:column -->

			</div>
			<!-- /wp:columns -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->