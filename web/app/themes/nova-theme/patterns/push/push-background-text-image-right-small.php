<?php
/**
 * Title: Push, background text image right (Small)
 * Slug: nova/push-background-text-image-right-small
 * Categories: push
 * Description: A standard-width, two-column layout with a prominent text block on the left and an image placeholder on the right.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:cover {"dimRatio":80,"overlayColor":"nova-100","isUserOverlayColor":true,"contentPosition":"center center","metadata":{"categories":["push"],"patternName":"nova/push-background-text-image-right-small","name":"Push, background text small"},"className":"push-background-text-small is-light"} -->
<div class="wp-block-cover push-background-text-small is-light">
    <span aria-hidden="true" class="wp-block-cover__background has-nova-100-background-color has-background-dim-80 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">

        <!-- wp:group {"textColor":"white","style":{"spacing":{"blockGap":"2rem","padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group has-white-color has-text-color" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50)">

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"textColor":"white","className":"is-style-outline-rounded has-white-border-color is-style-rounded-outline","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30","top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"fontSize":"label","borderColor":"white"} -->
                <div class="wp-block-button is-style-outline-rounded has-white-border-color is-style-rounded-outline">
                    <a class="wp-block-button__link has-white-color has-text-color has-link-color has-border-color has-white-border-color has-label-font-size has-custom-font-size wp-element-button" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--30)"><?php echo esc_html_x( 'Content tag', 'Push section content tag', 'nova' ); ?></a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

            <!-- wp:heading {"textAlign":"center","level":2,"fontSize":"m-heading"} -->
            <h2 class="wp-block-heading has-text-align-center has-m-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Push section heading', 'nova' ); ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor.', 'Push section description', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
            <div class="wp-block-buttons is-content-justification-center is-layout-flex">

                <!-- wp:button {"backgroundColor":"white","textColor":"nova-100"} -->
                <div class="wp-block-button">
                    <a class="wp-block-button__link has-nova-100-color has-white-background-color has-text-color has-background wp-element-button"><?php echo esc_html_x( 'Primary button', 'Push section primary button', 'nova' ); ?></a>
                </div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline has-white-border-color","borderColor":"white"} -->
                <div class="wp-block-button is-style-outline has-white-border-color">
                    <a class="wp-block-button__link has-border-color has-white-border-color wp-element-button"><?php echo esc_html_x( 'Secondary button', 'Push section secondary button 1', 'nova' ); ?></a>
                </div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline has-white-border-color","borderColor":"white"} -->
                <div class="wp-block-button is-style-outline has-white-border-color">
                    <a class="wp-block-button__link has-border-color has-white-border-color wp-element-button"><?php echo esc_html_x( 'Secondary button', 'Push section secondary button 1', 'nova' ); ?></a>
                </div>
                <!-- /wp:button -->

            </div>
            <!-- /wp:buttons -->

        </div>
        <!-- /wp:group -->

    </div>
</div>
<!-- /wp:cover -->