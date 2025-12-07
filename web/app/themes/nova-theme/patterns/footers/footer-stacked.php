<?php
/**
 * Title: Footer, stacked
 * Slug: nova/footer-stacked
 * Categories: footer
 * BlockTypes: core/template-part/footer
 * Description: A large footer with logo, contact information, multiple navigation columns, social links, and legal notices.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

$menu_titles = [
	'footer_1' => 'Footer Menu 1',
	'footer_2' => 'Footer Menu 2',
	'footer_3' => 'Footer Menu 3',
	'footer_4' => 'Footer Menu 4',
	'privacy'  => 'Privacy Menu',
];

$menus = [];

if ( function_exists( 'nova_get_post_by_title' ) ) {
	foreach ( $menu_titles as $key => $title ) {
		$post    = nova_get_post_by_title( $title, 'wp_navigation' );
		$menus[$key] = $post ? (int) $post->ID : 0;
	}
} else {
	$menus = array_fill_keys( array_keys( $menu_titles ), 0 );
}
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"nova-100","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-nova-100-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">

        <!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
			<div class="wp-block-group">

                <!-- wp:nova/footer-logo /-->

                <!-- wp:group -->
				<div class="wp-block-group">

                    <!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.4"}},"fontSize":"p-default"} -->
					<p class="has-p-default-font-size" style="line-height:1.4"><?php echo esc_html_x( '12, Lorum Ipsum, 1234 AB Amsterdam', 'Footer address', 'nova' ); ?> - <?php echo esc_html_x( '01 23 45 67 89', 'Footer phone number', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:group -->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">

            <!-- wp:buttons {"className":"is-content-justification-right","layout":{"type":"flex","justifyContent":"right"}} -->
            <div class="wp-block-buttons is-content-justification-right">

                <!-- wp:button {"backgroundColor":"white","textColor":"nova-100","className":"has-white-border-color is-style-outline","style":{"elements":{"link":{"color":{"text":"var:preset|color|nova-100"}}}}} -->
                <div class="wp-block-button has-white-border-color is-style-outline">
                    <a class="wp-block-button__link has-nova-100-color has-white-background-color has-text-color has-background has-link-color wp-element-button"><?php echo esc_html_x( 'Contact Us', 'Footer contact button', 'nova' ); ?></a>
                </div>
                <!-- /wp:button -->

            </div>
            <!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

    <!-- wp:columns {"className":"alignwide vb-footer-menus-wrapper","style":{"spacing":{"blockGap":"2rem"}}} -->
    <div class="wp-block-columns alignwide vb-footer-menus-wrapper">

        <!-- wp:column {"style":{"spacing":{"blockGap":"1rem"}}} -->
		<div class="wp-block-column">

            <!-- wp:paragraph {"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
            <p class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 4', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_1']; ?>,"style":{"spacing":{"blockGap":"0.75rem"},"layout":{"alignItems":"flex-start"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} /-->

            <!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"color":{"text":"var:preset|color|white"}},"fontSize":"label"} -->
            <p class="has-label-font-size vb-special-link has-white-color" style="font-style:normal;font-weight:600;text-transform:uppercase">
                <a href="#"><?php echo esc_html_x( 'Special Link', 'Footer special link', 'nova' ); ?></a>
            </p>
            <!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap":"1rem"}}} -->
		<div class="wp-block-column">

            <!-- wp:paragraph {"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
            <p class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 4', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_2']; ?>,"style":{"spacing":{"blockGap":"0.75rem"},"layout":{"alignItems":"flex-start"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} /-->

            <!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"color":{"text":"var:preset|color|white"}},"fontSize":"label"} -->
            <p class="has-label-font-size vb-special-link has-white-color" style="font-style:normal;font-weight:600;text-transform:uppercase">
                <a href="#"><?php echo esc_html_x( 'Special Link', 'Footer special link', 'nova' ); ?></a>
            </p>
            <!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap":"1rem"}}} -->
		<div class="wp-block-column">

            <!-- wp:paragraph {"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
            <p class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 4', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_3']; ?>,"style":{"spacing":{"blockGap":"0.75rem"},"layout":{"alignItems":"flex-start"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} /-->

            <!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"color":{"text":"var:preset|color|white"}},"fontSize":"label"} -->
            <p class="has-label-font-size vb-special-link has-white-color" style="font-style:normal;font-weight:600;text-transform:uppercase">
                <a href="#"><?php echo esc_html_x( 'Special Link', 'Footer special link', 'nova' ); ?></a>
            </p>
            <!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap":"1rem"}}} -->
		<div class="wp-block-column">

            <!-- wp:paragraph {"style":{"typography":{"fontWeight":"400"}},"fontSize":"s-heading"} -->
            <p class="wp-block-heading has-s-heading-font-size" style="font-weight:400;"><?php echo esc_html_x( 'Group', 'Footer column title 4', 'nova' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['footer_4']; ?>,"style":{"spacing":{"blockGap":"0.75rem"},"layout":{"alignItems":"flex-start"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} /-->

            <!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"color":{"text":"var:preset|color|white"}},"fontSize":"label"} -->
            <p class="has-label-font-size vb-special-link has-white-color" style="font-style:normal;font-weight:600;text-transform:uppercase">
                <a href="#"><?php echo esc_html_x( 'Special Link', 'Footer special link', 'nova' ); ?></a>
            </p>
            <!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

	<!-- wp:separator {"align":"wide","backgroundColor":"nova-75","className":"is-style-wide"} -->
	<hr class="wp-block-separator alignwide has-text-color has-nova-75-color has-alpha-channel-opacity has-nova-75-background-color has-background is-style-wide vb-footer-separator"/>
	<!-- /wp:separator -->

	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
	<div class="wp-block-group alignwide vb-footer-bottom-wrapper">

        <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
        <div class="wp-block-columns are-vertically-aligned-center vb-footer-bottom-inner">

            <!-- wp:column -->
            <div class="wp-block-column">

                <!-- wp:nova/social-links /-->

            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column">

                <!-- wp:navigation {"overlayMenu":"never","ref":<?php echo $menus['privacy']; ?>} /-->

                <!-- wp:paragraph {"align":"right","fontSize":"p-small","textColor":"white","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}}} -->
                <p class="has-text-align-right has-white-color has-p-small-font-size">
		            <?php
		            printf(
			            '© %s Nova | Design & Webdevelopment by – <a href="%s" target="_blank" rel="noopener">Movve Interactive</a>',
			            esc_html( gmdate( 'Y' ) ),
			            esc_url( 'https://www.movve.nl/' )
		            );
		            ?>
                </p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:column -->

        </div>
        <!-- /wp:columns -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->