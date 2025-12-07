<?php
/**
 * Title: Services List with Content
 * Slug: nova/features-services-list
 * Categories: features
 * Description: A two-column layout with a services menu list and content section.
 *
 * @author Nova Theme
 * @package Nova
 * @since 1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl);">

    <!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|xxl"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-top">

        <!-- wp:column -->
        <div class="wp-block-column">

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|l"}}} -->
            <div class="wp-block-group">

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);">
                    <!-- wp:paragraph -->
                    <p><?php echo esc_html_x( 'Service item one', 'Service menu item 1', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph -->
                    <p>&rarr;</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);">
                    <!-- wp:paragraph -->
                    <p><?php echo esc_html_x( 'Service item two', 'Service menu item 2', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph -->
                    <p>&rarr;</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);">
                    <!-- wp:paragraph -->
                    <p><?php echo esc_html_x( 'Service item three', 'Service menu item 3', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph -->
                    <p>&rarr;</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);">
                    <!-- wp:paragraph -->
                    <p><?php echo esc_html_x( 'Service item four', 'Service menu item 4', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph -->
                    <p>&rarr;</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);">
                    <!-- wp:paragraph -->
                    <p><?php echo esc_html_x( 'Service item five', 'Service menu item 5', 'nova' ); ?></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph -->
                    <p>&rarr;</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">

            <!-- wp:paragraph {"level":3,"fontSize":"m-heading"} -->
            <p class="wp-block-heading has-m-heading-font-size"><?php echo esc_html_x( 'This is a headline for the content section', 'Content heading', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"fontSize":"p-default"} -->
            <p class="has-p-default-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor gravida viverra. Tempus etiam aliquet sodales quisque consectetur pellentesque in tincidunt nam.', 'Content description', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"level":3,"fontSize":"m-heading"} -->
            <p class="wp-block-heading has-m-heading-font-size"><?php echo esc_html_x( 'Subheading for additional context', 'Content subheading', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"fontSize":"p-default"} -->
            <p class="has-p-default-font-size"><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'Content paragraph', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
                <div class="wp-block-button">
                    <a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button"><?php echo esc_html_x( 'Primary CTA', 'Content CTA button', 'nova' ); ?></a>
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
