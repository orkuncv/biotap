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
			'name'                  => _x( 'Aanbod', 'Post Type General Name', 'aanbod-websites' ),
			'singular_name'         => _x( 'Aanbod', 'Post Type Singular Name', 'aanbod-websites' ),
			'menu_name'             => __( 'Aanbod', 'aanbod-websites' ),
			'name_admin_bar'        => __( 'Aanbod', 'aanbod-websites' ),
			'archives'              => __( 'Aanbod Archief', 'aanbod-websites' ),
			'attributes'            => __( 'Aanbod Attributen', 'aanbod-websites' ),
			'parent_item_colon'     => __( 'Parent Aanbod:', 'aanbod-websites' ),
			'all_items'             => __( 'Alle Aanbod', 'aanbod-websites' ),
			'add_new_item'          => __( 'Nieuw Aanbod Toevoegen', 'aanbod-websites' ),
			'add_new'               => __( 'Nieuwe Toevoegen', 'aanbod-websites' ),
			'new_item'              => __( 'Nieuw Aanbod', 'aanbod-websites' ),
			'edit_item'             => __( 'Aanbod Bewerken', 'aanbod-websites' ),
			'update_item'           => __( 'Aanbod Updaten', 'aanbod-websites' ),
			'view_item'             => __( 'Aanbod Bekijken', 'aanbod-websites' ),
			'view_items'            => __( 'Aanbod Bekijken', 'aanbod-websites' ),
			'search_items'          => __( 'Aanbod Zoeken', 'aanbod-websites' ),
			'not_found'             => __( 'Niet Gevonden', 'aanbod-websites' ),
			'not_found_in_trash'    => __( 'Niet Gevonden in Prullenbak', 'aanbod-websites' ),
			'featured_image'        => __( 'Uitgelichte Afbeelding', 'aanbod-websites' ),
			'set_featured_image'    => __( 'Uitgelichte Afbeelding Instellen', 'aanbod-websites' ),
			'remove_featured_image' => __( 'Uitgelichte Afbeelding Verwijderen', 'aanbod-websites' ),
			'use_featured_image'    => __( 'Gebruik als Uitgelichte Afbeelding', 'aanbod-websites' ),
			'insert_into_item'      => __( 'Invoegen in Aanbod', 'aanbod-websites' ),
			'uploaded_to_this_item' => __( 'Geüpload naar dit Aanbod', 'aanbod-websites' ),
			'items_list'            => __( 'Aanbod Lijst', 'aanbod-websites' ),
			'items_list_navigation' => __( 'Aanbod Lijst Navigatie', 'aanbod-websites' ),
			'filter_items_list'     => __( 'Filter Aanbod Lijst', 'aanbod-websites' ),
		);

		$args = array(
			'label'                 => __( 'Aanbod', 'aanbod-websites' ),
			'description'           => __( 'Aanbod items', 'aanbod-websites' ),
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
				'slug'       => 'aanbod',
				'with_front' => false,
			),
		);

		register_post_type( self::POST_TYPE, $args );
	}
}
