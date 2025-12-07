<?php
/**
 * Title: Social proof, key figures row
 * Slug: nova/social-proof-key-figures-row
 * Categories: social-proof
 * Description: A full-width section with a centered title and a row of three key figures.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xl-heading"} -->
	<h2 class="wp-block-heading has-text-align-center has-xl-heading-font-size"><?php echo esc_html_x( 'This is a headline for the title part', 'Key figures row heading', 'nova' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:spacer {"height":"var:preset|spacing|60"} -->
	<div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">

		<!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
		<div class="wp-block-column">

			<!-- wp:paragraph {"align":"center","fontSize":"p-giga"} -->
			<p class="has-text-align-center has-p-giga-font-size"><?php echo esc_html_x( '+00 nb', 'Key figure number 1', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","fontSize":"p-default"} -->
			<p class="has-text-align-center has-p-default-font-size"><?php echo esc_html_x( 'Tellus dui fringilla in velit non rhoncu luctus ut. Enim nisl.', 'Key figure description 1', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
		<div class="wp-block-column">

			<!-- wp:paragraph {"align":"center","fontSize":"p-giga"} -->
			<p class="has-text-align-center has-p-giga-font-size"><?php echo esc_html_x( '+00 nb', 'Key figure number 2', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","fontSize":"p-default"} -->
			<p class="has-text-align-center has-p-default-font-size"><?php echo esc_html_x( 'Tellus dui fringilla in velit non rhoncu luctus ut. Enim nisl.', 'Key figure description 2', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
		<div class="wp-block-column">

			<!-- wp:paragraph {"align":"center","fontSize":"p-giga"} -->
			<p class="has-text-align-center has-p-giga-font-size"><?php echo esc_html_x( '+00 nb', 'Key figure number 3', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","fontSize":"p-default"} -->
			<p class="has-text-align-center has-p-default-font-size"><?php echo esc_html_x( 'Tellus dui fringilla in velit non rhoncu luctus ut. Enim nisl.', 'Key figure description 3', 'nova' ); ?></p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->