<?php
/**
 * Title: Footer, columns + sign-in
 * Slug: nova/footer-columns-signin
 * Categories: footer
 * BlockTypes: core/template-part/footer
 * Description: Footer met logo, adres, contactlink en social icons links; rechts drie navigatiekolommen en een sign-in knop; onderaan een lichtere balk met juridisch menu en copyright.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

$menu_titles = [
	'footer_1' => 'Footer Menu 1',
	'footer_2' => 'Footer Menu 2',
	'footer_3' => 'Footer Menu 3',
	'privacy'  => 'Privacy Menu',
];

$menus = [];

if ( function_exists( 'nova_get_post_by_title' ) ) {
	foreach ( $menu_titles as $key => $title ) {
		$post        = nova_get_post_by_title( $title, 'wp_navigation' );
		$menus[ $key ] = $post ? (int) $post->ID : 0;
	}
} else {
	$menus = array_fill_keys( array_keys( $menu_titles ), 0 );
}
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"0","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"nova-100","textColor":"white","className":"vb-footer-columns-signin","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull vb-footer-columns-signin has-white-color has-nova-100-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:0;padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
    <div class="wp-block-columns alignwide">

        <!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
        <div class="wp-block-column">

            <!-- wp:nova/footer-logo /-->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group">
                <!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.4"}},"fontSize":"p-default"} -->
                <p class="has-p-default-font-size" style="line-height:1.4"><?php echo esc_html_x( '12, Lorum Ipsum, 1234 AB Amsterdam', 'Footer address', 'nova' ); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"fontSize":"p-default"} -->
                <p class="has-p-default-font-size"><?php echo esc_html_x( '01 23 45 67 89', 'Footer phone number', 'nova' ); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"fontSize":"p-default"} -->
                <p class="has-p-default-font-size"><a href="#"><?php echo esc_html_x( 'Contact us', 'Footer contact link', 'nova' ); ?></a></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

            <!-- wp:separator {"backgroundColor":"nova-75","className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20"}}}} -->
            <hr class="wp-block-separator has-text-color has-nova-75-color has-alpha-channel-opacity has-nova-75-background-color has-background is-style-wide" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--20)"/>
            <!-- /wp:separator -->

            <!-- wp:paragraph {"style":{"typography":{"textTransform":"none","fontStyle":"normal","fontWeight":"600"}},"fontSize":"label"} -->
            <p class="has-label-font-size" style="font-style:normal;font-weight:600;"><?php echo esc_html_x( 'Follow us on', 'Footer social label', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:nova/social-links /-->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
        <div class="wp-block-column">

            <!-- wp:buttons {"className":"is-content-justification-right","layout":{"type":"flex","justifyContent":"right"}} -->
            <div class="wp-block-buttons is-content-justification-right">
                <!-- wp:button {"className":"has-white-border-color is-style-outline"} -->
                <div class="wp-block-button has-white-border-color is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'SIGN-IN', 'Footer sign-in button', 'nova' ); ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

            <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|50"}}}} -->
            <div class="wp-block-columns">

                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
                    <h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 1', 'nova' ); ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_1']; ?>} /-->
                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
                    <h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 2', 'nova' ); ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_2']; ?>} /-->
                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
                    <h3 class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 3', 'nova' ); ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_3']; ?>} /-->
                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"nova-75","textColor":"white","className":"vb-footer-bottombar","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull vb-footer-bottombar has-white-color has-nova-75-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

    <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:paragraph {"fontSize":"p-small"} -->
        <p class="has-p-small-font-size">
            <?php
	        printf(
		        '© %s Nova | Design & Webdevelopment by – <a href="%s" target="_blank" rel="noopener">Movve Interactive</a>',
		        esc_html( gmdate( 'Y' ) ),
		        esc_url( 'https://www.movve.nl/' )
	        );
	        ?>
        </p>
        <!-- /wp:paragraph -->

        <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['privacy']; ?>} /-->
    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->
