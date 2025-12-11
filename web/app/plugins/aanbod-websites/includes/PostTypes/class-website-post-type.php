<?php
/**
 * Website Post Type
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\PostTypes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Website Post Type class
 *
 * Registers the 'website' custom post type.
 */
class Website_Post_Type {

	/**
	 * Post type slug
	 *
	 * @var string
	 */
	public const POST_TYPE = 'website';

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
			'name'                  => _x( 'Websites', 'Post Type General Name', 'aanbod-websites' ),
			'singular_name'         => _x( 'Website', 'Post Type Singular Name', 'aanbod-websites' ),
			'menu_name'             => __( 'Websites', 'aanbod-websites' ),
			'name_admin_bar'        => __( 'Website', 'aanbod-websites' ),
			'archives'              => __( 'Website Archief', 'aanbod-websites' ),
			'attributes'            => __( 'Website Attributen', 'aanbod-websites' ),
			'parent_item_colon'     => __( 'Parent Website:', 'aanbod-websites' ),
			'all_items'             => __( 'Alle Websites', 'aanbod-websites' ),
			'add_new_item'          => __( 'Nieuwe Website Toevoegen', 'aanbod-websites' ),
			'add_new'               => __( 'Nieuwe Toevoegen', 'aanbod-websites' ),
			'new_item'              => __( 'Nieuwe Website', 'aanbod-websites' ),
			'edit_item'             => __( 'Website Bewerken', 'aanbod-websites' ),
			'update_item'           => __( 'Website Updaten', 'aanbod-websites' ),
			'view_item'             => __( 'Website Bekijken', 'aanbod-websites' ),
			'view_items'            => __( 'Websites Bekijken', 'aanbod-websites' ),
			'search_items'          => __( 'Website Zoeken', 'aanbod-websites' ),
			'not_found'             => __( 'Niet Gevonden', 'aanbod-websites' ),
			'not_found_in_trash'    => __( 'Niet Gevonden in Prullenbak', 'aanbod-websites' ),
			'featured_image'        => __( 'Uitgelichte Afbeelding', 'aanbod-websites' ),
			'set_featured_image'    => __( 'Uitgelichte Afbeelding Instellen', 'aanbod-websites' ),
			'remove_featured_image' => __( 'Uitgelichte Afbeelding Verwijderen', 'aanbod-websites' ),
			'use_featured_image'    => __( 'Gebruik als Uitgelichte Afbeelding', 'aanbod-websites' ),
			'insert_into_item'      => __( 'Invoegen in Website', 'aanbod-websites' ),
			'uploaded_to_this_item' => __( 'Geüpload naar deze Website', 'aanbod-websites' ),
			'items_list'            => __( 'Websites Lijst', 'aanbod-websites' ),
			'items_list_navigation' => __( 'Websites Lijst Navigatie', 'aanbod-websites' ),
			'filter_items_list'     => __( 'Filter Websites Lijst', 'aanbod-websites' ),
		);

		$args = array(
			'label'                 => __( 'Website', 'aanbod-websites' ),
			'description'           => __( 'Websites aanbod', 'aanbod-websites' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-admin-site-alt3',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rewrite'               => array(
				'slug'       => 'websites',
				'with_front' => false,
			),
		);

		register_post_type( self::POST_TYPE, $args );
	}
}
