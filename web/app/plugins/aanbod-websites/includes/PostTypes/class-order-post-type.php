<?php
/**
 * Order Post Type
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\PostTypes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Order Post Type class
 *
 * Registers the 'website_order' custom post type.
 */
class Order_Post_Type {

	/**
	 * Post type slug
	 *
	 * @var string
	 */
	public const POST_TYPE = 'website_order';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register the post type
	 *
	 * @return void
	 */
	public function register(): void {
		$labels = array(
			'name'          => _x( 'Bestellingen', 'Post Type General Name', 'aanbod-websites' ),
			'singular_name' => _x( 'Bestelling', 'Post Type Singular Name', 'aanbod-websites' ),
			'menu_name'     => __( 'Bestellingen', 'aanbod-websites' ),
			'name_admin_bar' => __( 'Bestelling', 'aanbod-websites' ),
			'all_items'     => __( 'Alle Bestellingen', 'aanbod-websites' ),
			'add_new_item'  => __( 'Nieuwe Bestelling', 'aanbod-websites' ),
			'edit_item'     => __( 'Bestelling Bewerken', 'aanbod-websites' ),
			'view_item'     => __( 'Bestelling Bekijken', 'aanbod-websites' ),
			'search_items'  => __( 'Bestellingen Zoeken', 'aanbod-websites' ),
			'not_found'     => __( 'Geen Bestellingen Gevonden', 'aanbod-websites' ),
		);

		$args = array(
			'label'              => __( 'Bestelling', 'aanbod-websites' ),
			'description'        => __( 'Website bestellingen', 'aanbod-websites' ),
			'labels'             => $labels,
			'supports'           => array( 'title' ),
			'hierarchical'       => false,
			'public'             => false,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=website',
			'menu_position'      => 5,
			'show_in_admin_bar'  => false,
			'show_in_nav_menus'  => false,
			'can_export'         => true,
			'has_archive'        => false,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'capability_type'    => 'post',
			'show_in_rest'       => false,
			'capabilities'       => array(
				'create_posts' => 'do_not_allow',
			),
			'map_meta_cap'       => true,
		);

		register_post_type( self::POST_TYPE, $args );
	}
}
