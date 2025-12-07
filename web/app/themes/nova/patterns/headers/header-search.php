<?php
/**
 * Title: Header search
 * Slug: nova/header-search
 * Categories: header
 * Description: A stacked header with a logo and search bar on the top row, and navigation on the bottom row.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

$menu_post = function_exists( 'nova_get_post_by_title' ) ? nova_get_post_by_title( 'Hoofdmenu', 'wp_navigation' ) : null;
$menu_id   = $menu_post ? $menu_post->ID : 0;
?>

<!-- wp:group {"align":"full","className":"nova-header__search","backgroundColor":"white","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nova-header__search has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50)">

    <!-- wp:group {"align":"wide","className":"nova-header__search__top","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
    <div class="wp-block-group alignwide nova-header__search__top">
        <!-- wp:nova/header-logo /-->

        <!-- wp:search {"label":"","showLabel":false,"placeholder":"<?php echo esc_html_x( 'Zoeken...', 'Search input placeholder', 'nova' ); ?>","buttonText":"","buttonUseIcon":true,"className":"nova-header__search-search desktop-only"} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"align":"wide","className":"nova-header__bottom","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"flex-end","verticalAlignment":"center"}} -->
    <div class="wp-block-group alignwide nova-header__bottom" style="padding-bottom:var(--wp--preset--spacing--20)">

		<?php if ( $menu_id > 0 ) : ?>
            <!-- wp:navigation {"ref":<?php echo (int) $menu_id; ?>,"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","className":"nova-header-nav__menu","layout":{"type":"flex","justifyContent":"left","flexWrap":"wrap"}} /-->
		<?php else : ?>
            <!-- wp:navigation {"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","className":"nova-header-nav__menu","layout":{"type":"flex"}} -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'About us', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Hub title', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- wp:navigation-submenu {"label":"<?php echo esc_html_x( 'Solutions', 'Header navigation item', 'nova' ); ?>","url":"#"} -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Sub item', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- /wp:navigation-submenu -->
            <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'News', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
            <!-- /wp:navigation -->
		<?php endif; ?>

        <!-- wp:search {"label":"","showLabel":false,"placeholder":"<?php echo esc_html_x( 'Zoeken...', 'Search input placeholder', 'nova' ); ?>","buttonText":"","buttonUseIcon":true,"className":"nova-header__search-search mobile-only"} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->