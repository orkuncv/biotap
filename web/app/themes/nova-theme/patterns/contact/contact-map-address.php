<?php
/**
 * Title: Contact, map and address
 * Slug: nova/contact-map-address
 * Categories: contact
 * Description: A two-column layout with contact details on the left and a Google Map on the right.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-top">

		<!-- wp:column {"verticalAlignment":"top"} -->
		<div class="wp-block-column is-vertically-aligned-top">

			<!-- wp:heading {"level":2,"fontSize":"xl-heading"} -->
			<h2 class="wp-block-heading has-xl-heading-font-size">
				<?php echo esc_html_x( 'Visit us', 'Contact section heading', 'nova' ); ?>
			</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>
				<?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor gravida viverra. Tempus etiam aliquet sodales quisque consectetur pellentesque in tincidunt nam.', 'Contact section description', 'nova' ); ?>
			</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
			<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading {"level":4,"fontSize":"s-heading"} -->
			<h4 class="wp-block-heading has-s-heading-font-size">
				<?php echo esc_html_x( 'Headquarter', 'Contact address heading', 'nova' ); ?>
			</h4>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>
				<?php echo esc_html_x( '123 Example Street', 'Contact address street', 'nova' ); ?><br>
				<?php echo esc_html_x( 'City name 12345', 'Contact address city', 'nova' ); ?>
			</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top"} -->
		<div class="wp-block-column is-vertically-aligned-top">

			<!-- wp:nova/google-map {"height":"540","mapUrl":""} /-->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->