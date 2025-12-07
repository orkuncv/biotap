<?php
/**
 * Title: Social proof, key figures grid
 * Slug: nova/social-proof-key-figures-grid
 * Categories: social-proof
 * Description: A two-column layout featuring a title, description, and CTAs on the left, with a 2x2 grid of key figures on the right.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-top alignwide">

		<!-- wp:column {"width":"45%","style":{"spacing":{"blockGap":"2rem"}}} -->
		<div class="wp-block-column" style="flex-basis:45%">

			<!-- wp:heading {"level":2,"fontSize":"xl-heading"} -->
			<h2 class="wp-block-heading has-xl-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Pattern social proof heading', 'nova' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque pellentesque pharetra quam enim porttitor gravida viverra. Tempus etiam aliquet sodales quisque consectetur pellentesque in tincidunt nam.', 'Pattern social proof description', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">

				<!-- wp:button {"backgroundColor":"nova-100","textColor":"white"} -->
				<div class="wp-block-button">
					<a class="wp-block-button__link has-white-color has-nova-100-background-color has-text-color has-background wp-element-button"><?php echo esc_html_x( 'Button Label', 'Pattern primary button', 'nova' ); ?></a>
				</div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline">
					<a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Button Label', 'Pattern secondary button', 'nova' ); ?></a>
				</div>
				<!-- /wp:button -->

			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:columns -->
			<div class="wp-block-columns">

				<!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
				<div class="wp-block-column">

					<!-- wp:paragraph {"fontSize":"p-giga"} -->
					<p class="has-p-giga-font-size"><?php echo esc_html_x( '+00 nb', 'Key figure number 1', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"fontSize":"p-default"} -->
					<p class="has-p-default-font-size"><?php echo esc_html_x( 'Tellus dui fringilla in velit non rhoncu luctus ut. Enim nisl.', 'Key figure description 1', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:column -->

				<!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
				<div class="wp-block-column">

					<!-- wp:paragraph {"fontSize":"p-giga"} -->
					<p class="has-p-giga-font-size"><?php echo esc_html_x( '+00 nb', 'Key figure number 2', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"fontSize":"p-default"} -->
					<p class="has-p-default-font-size"><?php echo esc_html_x( 'Tellus dui fringilla in velit non rhoncu luctus ut. Enim nisl.', 'Key figure description 2', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:column -->

			</div>
			<!-- /wp:columns -->

			<!-- wp:columns -->
			<div class="wp-block-columns">

				<!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
				<div class="wp-block-column">

					<!-- wp:paragraph {"fontSize":"p-giga"} -->
					<p class="has-p-giga-font-size"><?php echo esc_html_x( '+00 nb', 'Key figure number 3', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"fontSize":"p-default"} -->
					<p class="has-p-default-font-size"><?php echo esc_html_x( 'Tellus dui fringilla in velit non rhoncu luctus ut. Enim nisl.', 'Key figure description 3', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:column -->

				<!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
				<div class="wp-block-column">

					<!-- wp:paragraph {"fontSize":"p-giga"} -->
					<p class="has-p-giga-font-size"><?php echo esc_html_x( '+00 nb', 'Key figure number 4', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"fontSize":"p-default"} -->
					<p class="has-p-default-font-size"><?php echo esc_html_x( 'Tellus dui fringilla in velit non rhoncu luctus ut. Enim nisl.', 'Key figure description 4', 'nova' ); ?></p>
					<!-- /wp:paragraph -->

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