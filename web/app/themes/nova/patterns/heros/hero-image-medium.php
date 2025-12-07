<?php
/**
 * Title: Hero, image medium
 * Slug: nova/hero-image-medium
 * Categories: heros
 * Description: A hero with a full width image, heading, short paragraph and button.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

?>

<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"focalPoint":{"x":0.5,"y":0.15},"minHeight":420,"isDark":false,"align":"full","className":"nova-hero-bg","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"backgroundColor":"nova-10"} -->
<div class="wp-block-cover alignfull is-light nova-hero-bg has-nova-10-background-color has-background" style="padding-top:0;padding-bottom:0;min-height:420px">
    <span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
    <!-- wp:paragraph -->
        <p></p>
    <!-- /wp:paragraph -->
    </div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","className":"nova-hero-card","style":{"spacing":{"margin":{"top":"-200px"},"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nova-hero-card" style="margin-top:-200px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

    <!-- wp:group {"align":"wide","backgroundColor":"white","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
    <div class="wp-block-group alignwide has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group aligncontent">

            <!-- wp:paragraph {"textColor":"nova-75","className":"is-style-uppercase-small","align":"center"} -->
            <p class="has-text-align-center is-style-uppercase-small has-nova-75-color has-text-color"><?php echo esc_html_x( 'A place for the over-title', 'Hero over-title', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"level":1,"textAlign":"center","fontSize":"xxl-heading"} -->
            <h1 class="wp-block-heading has-text-align-center has-xxl-heading-font-size"><?php echo esc_html_x( 'This is the place for a page title', 'Hero title', 'nova' ); ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","fontSize":"p-default"} -->
            <p class="has-text-align-center has-p-default-font-size">
                <?php echo esc_html_x( 'This is a place for an excerpt. Lorem ipsum dolor sit amet consectetur. At fusce ac netus non nam ut amet. Arcu tempor rhoncus varius purus aliquam nunc.', 'Hero description', 'nova' ); ?>
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"24px"} -->
            <div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
            <div class="wp-block-buttons is-content-justification-center is-layout-flex">

                <!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
                <div class="wp-block-button">
                    <a class="wp-block-button__link has-nova-100-background-color has-white-color has-text-color has-background wp-element-button">
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
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->