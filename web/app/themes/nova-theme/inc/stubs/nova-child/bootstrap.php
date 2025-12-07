<?php
/**
 * Nova Child Theme Bootstrap
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

/**
 * Initialize the Nova Child theme setup
 *
 * @since 1.0.0
 */
add_action( 'after_setup_theme', function() {
	// Register child theme setup class
	$child_setup = new Nova_Child_Theme_Setup();
}, 11 );
