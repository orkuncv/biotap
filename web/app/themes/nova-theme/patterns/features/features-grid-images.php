<?php
/**
 * Title: Features Grid with Images
 * Slug: nova/features-grid-images
 * Categories: features
 * Description: A feature grid with images and call-to-action buttons.
 *
 * @author Nova Theme
 * @package Nova
 * @since 1.0.0
 */
?>

<!-- wp:group {"align":"full","backgroundColor":"white","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">

    <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"xl-heading"} -->
    <h2 class="wp-block-heading has-text-align-center has-xl-heading-font-size">
        <?php echo esc_html_x( 'Our Features', 'Section title', 'nova' ); ?>
    </h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","fontSize":"p-large"} -->
    <p class="has-text-align-center has-p-large-font-size">
        <?php echo esc_html_x( 'This is a place for an excerpt. Lorem ipsum dolor sit amet consectetur adipiscing elit.', 'Section description', 'nova' ); ?>
    </p>
    <!-- /wp:paragraph -->

    <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
    <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|xl"}}}} -->
    <div class="wp-block-columns alignwide">

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large"} -->
            <figure class="wp-block-image size-large"><img src="" alt="<?php echo esc_attr_x( 'Feature image', 'Image alt text', 'nova' ); ?>" /></figure>
            <!-- /wp:image -->

            <!-- wp:group {"backgroundColor":"nova-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}}} -->
            <div class="wp-block-group has-nova-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
                <!-- wp:paragraph {"align":"center","textColor":"white","fontSize":"p-default"} -->
                <p class="has-text-align-center has-white-color has-text-color has-p-default-font-size">
                    <?php echo esc_html_x( 'Feature name', 'Feature title', 'nova' ); ?>
                </p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large"} -->
            <figure class="wp-block-image size-large"><img src="" alt="<?php echo esc_attr_x( 'Feature image', 'Image alt text', 'nova' ); ?>" /></figure>
            <!-- /wp:image -->

            <!-- wp:group {"backgroundColor":"nova-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}}} -->
            <div class="wp-block-group has-nova-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
                <!-- wp:paragraph {"align":"center","textColor":"white","fontSize":"p-default"} -->
                <p class="has-text-align-center has-white-color has-text-color has-p-default-font-size">
                    <?php echo esc_html_x( 'Feature name', 'Feature title', 'nova' ); ?>
                </p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large"} -->
            <figure class="wp-block-image size-large"><img src="" alt="<?php echo esc_attr_x( 'Feature image', 'Image alt text', 'nova' ); ?>" /></figure>
            <!-- /wp:image -->

            <!-- wp:group {"backgroundColor":"nova-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}}} -->
            <div class="wp-block-group has-nova-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
                <!-- wp:paragraph {"align":"center","textColor":"white","fontSize":"p-default"} -->
                <p class="has-text-align-center has-white-color has-text-color has-p-default-font-size">
                    <?php echo esc_html_x( 'Feature name', 'Feature title', 'nova' ); ?>
                </p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large"} -->
            <figure class="wp-block-image size-large"><img src="" alt="<?php echo esc_attr_x( 'Feature image', 'Image alt text', 'nova' ); ?>" /></figure>
            <!-- /wp:image -->

            <!-- wp:group {"backgroundColor":"nova-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}}} -->
            <div class="wp-block-group has-nova-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)">
                <!-- wp:paragraph {"align":"center","textColor":"white","fontSize":"p-default"} -->
                <p class="has-text-align-center has-white-color has-text-color has-p-default-font-size">
                    <?php echo esc_html_x( 'Feature name', 'Feature title', 'nova' ); ?>
                </p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

    <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
    <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
        <div class="wp-block-button">
            <a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button">
                <?php echo esc_html_x( 'Primary CTA', 'Button text', 'nova' ); ?>
            </a>
        </div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->

</div>
<!-- /wp:group -->
