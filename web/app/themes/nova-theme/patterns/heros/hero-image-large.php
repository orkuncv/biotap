<?php
/**
 * Title: Hero, image large
 * Slug: nova/hero-image-large
 * Categories: heros
 * Description: A full-width hero with background image, over-title, large heading, description and CTA buttons (left-aligned).
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

?>

<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"focalPoint":{"x":0.5,"y":0.15},"minHeight":640,"contentPosition":"left center","isDark":false,"metadata":{"categories":["heros"],"patternName":"nova/hero-image-large","name":"Hero, image large"},"align":"full","className":"nova-hero-bg","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"backgroundColor":"nova-10"} -->
<div class="wp-block-cover alignfull is-light has-custom-content-position nova-hero-bg has-nova-10-background-color has-background" style="padding-top:0;padding-bottom:0;min-height:640px">
    <span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">

        <!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"2rem","padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">

            <!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
            <div class="wp-block-columns alignwide are-vertically-aligned-top">

                <!-- wp:column {"width":"58%","verticalAlignment":"center","style":{"spacing":{"blockGap":"2rem"}}} -->
                <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">

                    <!-- wp:paragraph {"className":"is-style-uppercase-small","textColor":"nova-75"} -->
                    <p class="is-style-uppercase-small has-nova-75-color has-text-color"><?php echo esc_html_x( 'A place for the over-title', 'Hero over-title', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:heading {"level":1,"fontSize":"xxl-heading","textColor":"nova-100"} -->
                    <h1 class="wp-block-heading has-xxl-heading-font-size has-nova-100-color has-text-color"><?php echo esc_html_x( 'This is the place for a page title', 'Hero title', 'nova' ); ?></h1>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"fontSize":"p-default","textColor":"nova-100"} -->
                    <p class="has-p-default-font-size has-nova-100-color has-text-color"><?php echo esc_html_x( 'This is a place for an excerpt. Lorem ipsum dolor sit amet consectetur. At fusce ac netus non nam ut amet. Arcu tempor rhoncus varius purus aliquam nunc.', 'Hero description', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"className":"is-content-justification-left is-layout-flex","layout":{"type":"flex","justifyContent":"left","flexWrap":"wrap"}} -->
                    <div class="wp-block-buttons is-content-justification-left is-layout-flex">

                        <!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
                        <div class="wp-block-button">
                            <a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button">
						        <?php echo esc_html_x( 'Primary CTA', 'Hero primary button', 'nova' ); ?>
                            </a>
                        </div>
                        <!-- /wp:button -->

                        <!-- wp:button {"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline">
                            <a class="wp-block-button__link wp-element-button">
						        <?php echo esc_html_x( 'Secondary CTA', 'Hero secondary button', 'nova' ); ?>
                            </a>
                        </div>
                        <!-- /wp:button -->

                    </div>
                    <!-- /wp:buttons -->


                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"top"} -->
                <div class="wp-block-column is-vertically-aligned-top">


                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </div>
</div>
<!-- /wp:cover -->