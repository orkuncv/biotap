<?php
/**
 * Title: Contact, newsletter form
 * Slug: nova/contact-newsletter
 * Categories: contact, push
 * Description: A full-width section with a newsletter signup form. Uses Gravity Forms and provides a fallback if the plugin is not active. The background can be a color or an image.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:cover {"dimRatio":90,"overlayColor":"nova-10","isUserOverlayColor":true,"isDark":false,"metadata":{"categories":["contact"],"patternName":"nova/contact-newsletter","name":"Contact, newsletter form"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","right":"var:preset|spacing|50","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-cover alignfull is-light" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50)">
	<span aria-hidden="true" class="wp-block-cover__background has-nova-10-background-color has-background-dim-90 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">

		<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group">

			<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"m-heading"} -->
			<h2 class="wp-block-heading has-text-align-center has-m-heading-font-size">
				<?php echo esc_html_x( 'Stay informed by subscribing to our newsletter', 'Newsletter section heading', 'nova' ); ?>
			</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","fontSize":"p-small"} -->
			<p class="has-text-align-center has-p-small-font-size">
				<?php echo wp_kses_post( __( 'You have the right to access, modify and delete your personal information. For more information, please <a href="#">contact us</a>.', 'nova' ) ); ?>
			</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":"var:preset|spacing|60"} -->
			<div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<?php
			$form_id = 1;

			if ( class_exists( 'GFAPI' ) && ! empty( GFAPI::get_form( $form_id ) ) ) {
				echo '<!-- wp:shortcode -->[gravityform id="' . absint( $form_id ) . '" title="false" description="false" ajax="true"]<!-- /wp:shortcode -->';
			} else {
				echo '<!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"italic"}},"textColor":"nova-75"} -->';
				echo '<p class="has-text-align-center has-nova-75-color has-text-color" style="font-style:italic">';
				echo esc_html__( 'Gravity Form not found. Please create a form in Gravity Forms and replace this block with the correct shortcode.', 'nova' );
				echo '</p><!-- /wp:paragraph -->';
			}
			?>

		</div>
		<!-- /wp:group -->

	</div>
</div>
<!-- /wp:cover -->