<?php
/**
 * Title: Header stacked socials
 * Slug: nova/header-stacked-socials
 * Categories: header
 * Description: A stacked header with a logo and social icons on the top row, and navigation on the bottom row.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

$menu_post = function_exists( 'nova_get_post_by_title' ) ? nova_get_post_by_title( 'Hoofdmenu', 'wp_navigation' ) : null;
$menu_id   = $menu_post ? $menu_post->ID : 0;
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"backgroundColor":"white","className":"nova-header-stacked"},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nova-header-stacked has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);">

	<!-- wp:group {"align":"wide","className":"nova-header-stacked__top","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group alignwide nova-header-stacked__top">

		<!-- wp:nova/header-logo /-->

		<!-- wp:nova/social-links /-->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}}},"className":"nova-header-stacked__bottom","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"flex-start","verticalAlignment":"center"}} -->
	<div class="wp-block-group alignwide nova-header-stacked__bottom" style="padding-bottom:var(--wp--preset--spacing--20)">

        <?php if ( $menu_id > 0 ) : ?>
            <!-- wp:navigation {"ref":<?php echo $menu_id; ?>,"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","layout":{"type":"flex","justifyContent":"left","flexWrap":"wrap"},"className":"nova-header-nav__menu"} /-->
        <?php else : ?>
            <!-- wp:navigation {"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","layout":{"type":"flex"},"className":"nova-header-nav__menu"} -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Home', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Over ons', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Contact', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- /wp:navigation -->
        <?php endif; ?>

	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->