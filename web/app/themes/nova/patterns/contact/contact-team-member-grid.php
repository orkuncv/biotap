<?php
/**
 * Title: Contact, team member grid
 * Slug: nova/contact-team-member-grid
 * Categories: contact, team
 * Description: A full-width section with a centered title and a grid of team member profiles.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xl-heading"} -->
	<h2 class="wp-block-heading has-text-align-center has-xl-heading-font-size">
		<?php echo esc_html_x( 'This is a headline for the title part', 'Team grid heading', 'nova' ); ?>
	</h2>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"var:preset|spacing|60"} -->
	<div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">

        <!-- wp:column {"style":{"spacing":{"blockGap": 0}}} -->
        <div class="wp-block-column">

            <!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"isDark":false,"className":"nova-cloud-placeholder","backgroundColor":"nova-10"} -->
            <div class="wp-block-cover is-light nova-cloud-placeholder has-nova-10-background-color has-background">
                <span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>
                <div class="wp-block-cover__inner-container">
                    <!-- wp:paragraph -->
                    <p></p>
                    <!-- /wp:paragraph -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:spacer {"height":"var:preset|spacing|m"} -->
            <div style="height:var(--wp--preset--spacing--m)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

			<!-- wp:heading {"textAlign":"center","level":4,"fontSize":"s-heading"} -->
			<h4 class="wp-block-heading has-text-align-center has-s-heading-font-size"><?php echo esc_html_x( 'Person Name', 'Team member name 1', 'nova' ); ?></h4>
			<!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|nova-75"}}}},"textColor":"nova-75","fontSize":"xs-mobile"} -->
            <p class="has-text-align-center has-nova-75-color has-text-color has-link-color has-xs-mobile-font-size" style="font-weight:500"><?php echo esc_html_x( 'Job title', 'Team member job title 1', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|m"} -->
            <div style="height:var(--wp--preset--spacing--m)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

			<!-- wp:paragraph {"align":"center","fontSize":"p-default"} -->
			<p class="has-text-align-center has-p-default-font-size"><?php echo esc_html_x( 'Enim tincidunt mattis sed ante sit morbi rhoncus quam nulla. Eget nibh purus at non ut. Laoreet cursus hac maecenas tristique blandit vitae faucibus. Platea proin diam eu dignissim vel risus lacinia turpis.', 'Team member description 1', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|l"} -->
            <div style="height:var(--wp--preset--spacing--l)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

			<!-- wp:social-links {"iconColor":"nova-100","iconColorValue":"#414B5A","size":"has-default-icon-size","className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
			<ul class="wp-block-social-links has-default-icon-size has-icon-color is-style-logos-only">
				<!-- wp:social-link {"url":"#","service":"linkedin"} /-->
				<!-- wp:social-link {"url":"#","service":"x"} /-->
			</ul>
			<!-- /wp:social-links -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap": 0}}} -->
        <div class="wp-block-column">

            <!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"isDark":false,"className":"nova-cloud-placeholder","backgroundColor":"nova-10"} -->
            <div class="wp-block-cover is-light nova-cloud-placeholder has-nova-10-background-color has-background">
                <span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>
                <div class="wp-block-cover__inner-container">
                    <!-- wp:paragraph -->
                    <p></p>
                    <!-- /wp:paragraph -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:spacer {"height":"var:preset|spacing|m"} -->
            <div style="height:var(--wp--preset--spacing--m)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"s-heading"} -->
            <h4 class="wp-block-heading has-text-align-center has-s-heading-font-size"><?php echo esc_html_x( 'Person Name', 'Team member name 1', 'nova' ); ?></h4>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|nova-75"}}}},"textColor":"nova-75","fontSize":"xs-mobile"} -->
            <p class="has-text-align-center has-nova-75-color has-text-color has-link-color has-xs-mobile-font-size" style="font-weight:500"><?php echo esc_html_x( 'Job title', 'Team member job title 1', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|m"} -->
            <div style="height:var(--wp--preset--spacing--m)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:paragraph {"align":"center","fontSize":"p-default"} -->
            <p class="has-text-align-center has-p-default-font-size"><?php echo esc_html_x( 'Enim tincidunt mattis sed ante sit morbi rhoncus quam nulla. Eget nibh purus at non ut. Laoreet cursus hac maecenas tristique blandit vitae faucibus. Platea proin diam eu dignissim vel risus lacinia turpis.', 'Team member description 1', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|l"} -->
            <div style="height:var(--wp--preset--spacing--l)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:social-links {"iconColor":"nova-100","iconColorValue":"#414B5A","size":"has-default-icon-size","className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
            <ul class="wp-block-social-links has-default-icon-size has-icon-color is-style-logos-only">
                <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                <!-- wp:social-link {"url":"#","service":"x"} /-->
            </ul>
            <!-- /wp:social-links -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap": 0}}} -->
        <div class="wp-block-column">

            <!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"isDark":false,"className":"nova-cloud-placeholder","backgroundColor":"nova-10"} -->
            <div class="wp-block-cover is-light nova-cloud-placeholder has-nova-10-background-color has-background">
                <span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>
                <div class="wp-block-cover__inner-container">
                    <!-- wp:paragraph -->
                    <p></p>
                    <!-- /wp:paragraph -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:spacer {"height":"var:preset|spacing|m"} -->
            <div style="height:var(--wp--preset--spacing--m)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:heading {"textAlign":"center","level":4,"fontSize":"s-heading"} -->
            <h4 class="wp-block-heading has-text-align-center has-s-heading-font-size"><?php echo esc_html_x( 'Person Name', 'Team member name 1', 'nova' ); ?></h4>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|nova-75"}}}},"textColor":"nova-75","fontSize":"xs-mobile"} -->
            <p class="has-text-align-center has-nova-75-color has-text-color has-link-color has-xs-mobile-font-size" style="font-weight:500"><?php echo esc_html_x( 'Job title', 'Team member job title 1', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|m"} -->
            <div style="height:var(--wp--preset--spacing--m)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:paragraph {"align":"center","fontSize":"p-default"} -->
            <p class="has-text-align-center has-p-default-font-size"><?php echo esc_html_x( 'Enim tincidunt mattis sed ante sit morbi rhoncus quam nulla. Eget nibh purus at non ut. Laoreet cursus hac maecenas tristique blandit vitae faucibus. Platea proin diam eu dignissim vel risus lacinia turpis.', 'Team member description 1', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|l"} -->
            <div style="height:var(--wp--preset--spacing--l)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:social-links {"iconColor":"nova-100","iconColorValue":"#414B5A","size":"has-default-icon-size","className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
            <ul class="wp-block-social-links has-default-icon-size has-icon-color is-style-logos-only">
                <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
                <!-- wp:social-link {"url":"#","service":"x"} /-->
            </ul>
            <!-- /wp:social-links -->

        </div>
        <!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->