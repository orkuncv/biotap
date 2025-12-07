<?php
/**
 * Title: Hero with Feature List
 * Slug: nova/hero-feature-list
 * Categories: heros
 * Description: A hero section with heading, feature list and call-to-action button.
 *
 * @author Nova Theme
 * @package Nova
 * @since 1.0.0
 */
?>

<!-- wp:group {"metadata":{"categories":["heros"],"patternName":"nova/hero-feature-list","name":"Hero with Feature List"},"align":"full","backgroundColor":"background-primary","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background-primary-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xxl);padding-left:var(--wp--preset--spacing--xl)">

    <!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|xxl"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-top">

        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:paragraph {"textColor":"white","fontSize":"p-default"} -->
            <p class="has-white-color has-text-color has-p-default-font-size"><?php echo esc_html_x( 'A place for the over-title', 'Hero over-title', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"level":1,"textColor":"white","fontSize":"xl-heading","style":{"spacing":{"margin":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|xl"}}}} -->
            <h1 class="wp-block-heading has-white-color has-text-color has-xl-heading-font-size" style="margin-top:var(--wp--preset--spacing--m);margin-bottom:var(--wp--preset--spacing--xl)"><?php echo esc_html_x( 'This is the place for a page title', 'Hero title', 'nova' ); ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"textColor":"white","fontSize":"p-default","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xs"}}}} -->
            <p class="has-white-color has-text-color has-p-default-font-size" style="margin-bottom:var(--wp--preset--spacing--xs)"><?php echo esc_html_x( '✓ Feature benefit number one', 'Hero feature 1', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"textColor":"white","fontSize":"p-default","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xs"}}}} -->
            <p class="has-white-color has-text-color has-p-default-font-size" style="margin-bottom:var(--wp--preset--spacing--xs)"><?php echo esc_html_x( '✓ Feature benefit number two', 'Hero feature 2', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"textColor":"white","fontSize":"p-default","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xxl"}}}} -->
            <p class="has-white-color has-text-color has-p-default-font-size" style="margin-bottom:var(--wp--preset--spacing--xxl)"><?php echo esc_html_x( '✓ Feature benefit number three', 'Hero feature 3', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
                <div class="wp-block-button">
                    <a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button"><?php echo esc_html_x( 'Primary CTA', 'Hero primary button', 'nova' ); ?></a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

            <!-- wp:paragraph {"textColor":"white","fontSize":"p-small"} -->
            <p class="has-white-color has-text-color has-p-small-font-size"><?php echo esc_html_x( '★★★★★ Wij scoren een 4.9 op Google uit 84 beoordelingen', 'Hero additional info', 'nova' ); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

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
    </div>
    <!-- /wp:columns --></div>
<!-- /wp:group -->
