<?php
/**
 * Title: Header low socials
 * Slug: nova/header-low-socials
 * Categories: header
 * Description: A single row header with a logo, navigation, and social icons.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

$menu_post = function_exists( 'nova_get_post_by_title' ) ? nova_get_post_by_title( 'Hoofdmenu', 'wp_navigation' ) : null;
$menu_id   = $menu_post ? $menu_post->ID : 0;
?>

<!-- wp:group {"align":"full","className":"nova-header-low","backgroundColor":"white","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nova-header-low has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--50)">

    <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
    <div class="wp-block-group alignwide">

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
        <div class="wp-block-group is-vertically-aligned-center">

            <!-- wp:nova/header-logo /-->

        </div>
        <!-- /wp:group -->

		<?php if ( $menu_id > 0 ) : ?>
            <!-- wp:navigation {"ref":<?php echo (int) $menu_id; ?>,"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","className":"nova-header-nav__menu","layout":{"type":"flex","justifyContent":"left","flexWrap":"wrap"}} /-->
		<?php else : ?>
            <!-- wp:navigation {"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","className":"nova-header-nav__menu","layout":{"type":"flex"}} -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'this is a link', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- wp:navigation-submenu {"label":"<?php echo esc_html_x( 'A submenu', 'Header navigation item', 'nova' ); ?>","url":"#"} -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Sub item', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- /wp:navigation-submenu -->
            <!-- wp:navigation-submenu {"label":"<?php echo esc_html_x( 'A submenu', 'Header navigation item', 'nova' ); ?>","url":"#"} -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Sub item', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- /wp:navigation-submenu -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'this is a link', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- /wp:navigation -->
		<?php endif; ?>

        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
        <div class="wp-block-group is-vertically-aligned-center nova-header__socials nova-header__mobile-nav--inject">

            <!-- wp:nova/social-links /-->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->