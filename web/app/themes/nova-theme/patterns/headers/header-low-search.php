<?php
/**
 * Title: Header low search
 * Slug: nova/header-low-search
 * Categories: header
 * Description: A single row header with a logo, navigation, search bar and a CTA button.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

$menu_post = function_exists( 'nova_get_post_by_title' ) ? nova_get_post_by_title( 'Hoofdmenu', 'wp_navigation' ) : null;
$menu_id   = $menu_post ? $menu_post->ID : 0;
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"backgroundColor":"white","className":"nova-header__low-search"},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nova-header__low-search has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);">

    <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group alignwide">

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group is-vertically-aligned-center">

            <!-- wp:nova/header-logo /-->

		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group is-vertically-aligned-center nova-header__low-search-actions">

            <?php if ( $menu_id > 0 ) : ?>
                <!-- wp:navigation {"ref":<?php echo $menu_id; ?>,"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","layout":{"type":"flex","justifyContent":"left","flexWrap":"wrap"},"className":"nova-header-nav__menu"} -->
                <!-- wp:search {"label":"Zoeken","showLabel":false,"buttonText":"Zoek","buttonPosition":"button-inside","placeholder":"Zoek..."} /-->
                <!-- /wp:navigation -->
			<?php else : ?>
                <!-- wp:navigation {"overlayBackgroundColor":"nova-10","overlayTextColor":"nova-100","layout":{"type":"flex"},"className":"nova-header-nav__menu"} -->
                <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'About us', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
                <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Hub title', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
                <!-- wp:navigation-submenu {"label":"<?php echo esc_html_x( 'Solutions', 'Header navigation item', 'nova' ); ?>","url":"#"} -->
                <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'Sub item', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
                <!-- /wp:navigation-submenu -->
                <!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'News', 'Header navigation item', 'nova' ); ?>","url":"#"} /-->
                <!-- wp:search {"label":"Zoeken","showLabel":false,"buttonText":"Zoek","buttonPosition":"button-inside","placeholder":"Zoek..."} /-->
                <!-- /wp:navigation -->
			<?php endif; ?>

            <!-- wp:search {"label":"","placeholder":"<?php echo esc_html_x( 'Zoeken...', 'Search input placeholder', 'nova' ); ?>","showLabel":false,"buttonText":"","buttonUseIcon":true,"className":"nova-header__search-search"} /-->

            <!-- wp:buttons -->
			<div class="wp-block-buttons nova-header__buttons nova-header__mobile-nav--inject">

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Contact Us', 'Header CTA button', 'nova' ); ?></a></div>
				<!-- /wp:button -->

            </div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->