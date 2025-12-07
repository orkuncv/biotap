<?php
/**
 * Title: Contact, grid
 * Slug: nova/contact-grid
 * Categories: contact
 * Description: A full-width section with a centered title, description, and a row of three contact methods (Email, Call, Address).
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xl-heading"} -->
	<h2 class="wp-block-heading has-text-align-center has-xl-heading-font-size">
		<?php echo esc_html_x( 'This is a headline for the title part', 'Contact grid heading', 'nova' ); ?>
	</h2>
	<!-- /wp:heading -->

    <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
    <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">
		<?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor gravida viverra. Tempus etiam aliquet sodales quisque consectetur pellentesque in tincidunt nam.', 'Contact grid description', 'nova' ); ?>
	</p>
	<!-- /wp:paragraph -->

    <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
    <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column {"style":{"spacing":{"blockGap": 0}}} -->
		<div class="wp-block-column">

            <!-- wp:image {"width":"64px","aspectRatio":"1","scale":"contain","sizeSlug":"full","linkDestination":"none","className":"nova-icon-center"} -->
            <figure class="wp-block-image size-full is-resized nova-icon-center">
                <img src="<?php echo get_template_directory_uri() . '/assets/svg/block/mail.svg'; ?>" alt="<?php echo esc_html_x( 'Mail', 'mail icon', 'nova' ); ?>" style="aspect-ratio:1;object-fit:contain;width:64px"/>
            </figure>
            <!-- /wp:image -->

            <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
            <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"400","lineHeight":"32px"}},"fontSize":"s-heading"} -->
            <h3 class="wp-block-heading has-text-align-center has-s-heading-font-size" style="font-weight:400;line-height:32px"><?php echo esc_html_x( 'Email', 'Contact item title email', 'nova' ); ?></h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|nova-75"}}}},"textColor":"nova-75","fontSize":"xs-mobile"} -->
            <p class="has-text-align-center has-nova-75-color has-text-color has-link-color has-xs-mobile-font-size has-nova-reverse-underline" style="font-weight:500">
                <a href="mailto:contact@mycompany.com"><?php echo esc_html_x( 'contact@mycompany.com', 'Contact item email address', 'nova' ); ?></a>
            </p>
            <!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap": 0}}} -->
        <div class="wp-block-column">

            <!-- wp:image {"width":"64px","aspectRatio":"1","scale":"contain","sizeSlug":"full","linkDestination":"none","className":"nova-icon-center"} -->
            <figure class="wp-block-image size-full is-resized nova-icon-center">
                <img src="<?php echo get_template_directory_uri() . '/assets/svg/block/phone.svg'; ?>" alt="<?php echo esc_html_x( 'Phone', 'phone icon', 'nova' ); ?>" style="aspect-ratio:1;object-fit:contain;width:64px"/>
            </figure>
            <!-- /wp:image -->

            <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
            <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"400","lineHeight":"32px"}},"fontSize":"s-heading"} -->
            <h3 class="wp-block-heading has-text-align-center has-s-heading-font-size" style="font-weight:400;line-height:32px"><?php echo esc_html_x( 'Email', 'Contact item title call', 'nova' ); ?></h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|nova-75"}}}},"textColor":"nova-75","fontSize":"xs-mobile"} -->
            <p class="has-text-align-center has-nova-75-color has-text-color has-link-color has-xs-mobile-font-size has-nova-reverse-underline" style="font-weight:500">
				<a href="tel:0123456789"><?php echo esc_html_x( '01 23 45 67 89', 'Contact item phone number', 'nova' ); ?></a>
			</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap": 0}}} -->
        <div class="wp-block-column">

            <!-- wp:image {"width":"64px","aspectRatio":"1","scale":"contain","sizeSlug":"full","linkDestination":"none","className":"nova-icon-center"} -->
            <figure class="wp-block-image size-full is-resized nova-icon-center">
                <img src="<?php echo get_template_directory_uri() . '/assets/svg/block/marker.svg'; ?>" alt="<?php echo esc_html_x( 'Marker', 'marker icon', 'nova' ); ?>" style="aspect-ratio:1;object-fit:contain;width:64px"/>
            </figure>
            <!-- /wp:image -->

            <!-- wp:spacer {"height":"var:preset|spacing|xl"} -->
            <div style="height:var(--wp--preset--spacing--xl)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"400","lineHeight":"32px"}},"fontSize":"s-heading"} -->
            <h3 class="wp-block-heading has-text-align-center has-s-heading-font-size" style="font-weight:400;line-height:32px"><?php echo esc_html_x( 'Address', 'Contact item title address', 'nova' ); ?></h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|nova-75"}}}},"textColor":"nova-75","fontSize":"xs-mobile"} -->
            <p class="has-text-align-center has-nova-75-color has-text-color has-link-color has-xs-mobile-font-size" style="font-weight:500">
				<?php echo esc_html_x( '87, chemin Susan Lefebvre', 'Contact item address line 1', 'nova' ); ?><br>
				<?php echo esc_html_x( '73 181 Poulainnec', 'Contact item address line 2', 'nova' ); ?>
			</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->