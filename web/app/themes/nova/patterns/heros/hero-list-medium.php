<?php
/**
 * Title: Hero, list
 * Slug: nova/hero-list-medium
 * Categories: heros
 * Description: A hub-style hero with heading, short intro on the left and a list of links with arrows on the right, followed by a wide hero image.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

?>

<!-- wp:group {"align":"full","className":"nova-hero__list","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nova-hero__list" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">

    <!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-top">

        <!-- wp:column {"width":"60%","verticalAlignment":"top"} -->
        <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:60%">

            <!-- wp:heading {"level":1,"fontSize":"xxl-heading"} -->
            <h1 class="wp-block-heading has-xxl-heading-font-size">
				<?php echo esc_html_x( 'This is the place for a hub title', 'Hero-list title', 'nova' ); ?>
            </h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"fontSize":"p-default"} -->
            <p class="has-p-default-font-size">
				<?php echo esc_html_x( 'This is a place for an excerpt. Lorem ipsum dolor sit amet consectetur. At fusce ac netus non nam ut amet. Arcu tempor rhoncus varius purus aliquam nunc.', 'Hero-list description', 'nova' ); ?>
            </p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">

            <!-- wp:list {"className":"nova-hero-link-list is-style-links-arrow","fontSize":"p-default"} -->
            <ul class="nova-hero-link-list is-style-links-arrow has-p-default-font-size">
                <li><a href="#"><?php echo esc_html_x( 'Non adipiscing ultricies et',   'Hero-list link 1', 'nova' ); ?> <span aria-hidden="true">→</span></a></li>
                <li><a href="#"><?php echo esc_html_x( 'Pellentesque elit, turpis pellentesque', 'Hero-list link 2', 'nova' ); ?> <span aria-hidden="true">→</span></a></li>
                <li><a href="#"><?php echo esc_html_x( 'Sollicitudin porttitor suspendisse', 'Hero-list link 3', 'nova' ); ?> <span aria-hidden="true">→</span></a></li>
                <li><a href="#"><?php echo esc_html_x( 'Elementum aliquam in tortor urna', 'Hero-list link 4', 'nova' ); ?> <span aria-hidden="true">→</span></a></li>
            </ul>
            <!-- /wp:list -->

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

    <!-- wp:cover {"dimRatio":0,"overlayColor":"nova-50","isUserOverlayColor":true,"minHeight":420,"isDark":false,"align":"wide","className":"nova-hero-placeholder","backgroundColor":"nova-10"} -->
    <div class="wp-block-cover alignwide is-light nova-hero-placeholder has-nova-10-background-color has-background" style="min-height:420px">
        <span aria-hidden="true" class="wp-block-cover__background has-nova-50-background-color has-background-dim-0 has-background-dim"></span>
        <div class="wp-block-cover__inner-container"></div>
    </div>
    <!-- /wp:cover -->

</div>
<!-- /wp:group -->