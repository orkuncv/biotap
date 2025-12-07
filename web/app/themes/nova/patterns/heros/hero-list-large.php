<?php
/**
 * Title: Hero, list large
 * Slug: nova/hero-list-large
 * Categories: heros
 * Description: Hub-hero with heading, intro links and “direct access” card.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"focalPoint":{"x":0.5,"y":0.15},"minHeight":600,"contentPosition":"center left","isDark":false,"metadata":{"categories":["heros"],"patternName":"nova/hero-list-2","name":"Hero, list 2"},"align":"full","className":"nova-hero__list--alt","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"backgroundColor":"nova-10"} -->
<div class="wp-block-cover alignfull is-light has-custom-content-position is-position-center-left nova-hero__list--alt has-nova-10-background-color has-background" style="padding-top:0;padding-bottom:0;min-height:600px">
    <span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>

    <div class="wp-block-cover__inner-container">

        <!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
        <div class="wp-block-columns alignwide are-vertically-aligned-top">

            <!-- wp:column {"verticalAlignment":"top","width":"60%"} -->
            <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:60%">

                <!-- wp:heading {"level":1,"fontSize":"xxl-heading"} -->
                <h1 class="wp-block-heading has-xxl-heading-font-size"><?php echo esc_html_x( 'This is the place for a hub title', 'heading', 'nova' ); ?></h1>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"fontSize":"p-default"} -->
                <p class="has-p-default-font-size"><?php echo esc_html_x( 'This is a place for an excerpt. Lorem ipsum dolor sit amet consectetur. At fusce ac netus non nam ut amet. Arcu tempor rhoncus varius purus aliquam nunc.', 'text', 'nova' ); ?></p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:column -->

            <!-- wp:column {"verticalAlignment":"center","width":"400px"} -->
            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:400px">

                <!-- wp:group {"className":"nova-hero-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
                <div class="wp-block-group nova-hero-card has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">

                    <!-- wp:paragraph {"className":"is-style-uppercase-small","textColor":"nova-75"} -->
                    <p aria-hidden="true" class="is-style-uppercase-small has-nova-75-color has-text-color">
                        Direct access
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:list {"className":"is-style-plain nova-hero-link-list","style":{"spacing":{"margin":{"top":"var:preset|spacing|10"},"padding":{"left":"0"},"listStyleType":"none"}},"fontSize":"p-default"} -->
                    <ul style="margin-top:var(--wp--preset--spacing--10);padding-left:0" class="wp-block-list is-style-plain nova-hero-link-list has-p-default-font-size">

                        <!-- wp:list-item -->
                        <li><a href="#">Non adipiscing ultricies et <span aria-hidden="true">→</span></a></li>
                        <!-- /wp:list-item -->

                        <!-- wp:list-item -->
                        <li><a href="#">Pellentesque elit, turpis pellentesque <span aria-hidden="true">→</span></a></li>
                        <!-- /wp:list-item -->

                        <!-- wp:list-item -->
                        <li><a href="#">Sollicitudin porttitor suspendisse <span aria-hidden="true">→</span></a></li>
                        <!-- /wp:list-item -->

                        <!-- wp:list-item -->
                        <li><a href="#">Elementum aliquam in tortor urna <span aria-hidden="true">→</span></a></li>
                        <!-- /wp:list-item -->
                    </ul>
                    <!-- /wp:list -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:column -->

        </div>
        <!-- /wp:columns -->

    </div>
</div>
<!-- /wp:cover -->
