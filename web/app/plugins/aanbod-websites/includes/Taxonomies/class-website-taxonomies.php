<?php
/**
 * Website Taxonomies
 *
 * @package Aanbod_Websites
 */

namespace Aanbod_Websites\Taxonomies;

use Aanbod_Websites\PostTypes\Website_Post_Type;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Website Taxonomies class
 *
 * Registers taxonomies for the website post type.
 */
class Website_Taxonomies {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register taxonomies
	 *
	 * @return void
	 */
	public function register(): void {
		$this->register_category_taxonomy();
		$this->register_tag_taxonomy();
	}

	/**
	 * Register category taxonomy
	 *
	 * @return void
	 */
	private function register_category_taxonomy(): void {
		$labels = array(
			'name'              => _x( 'Website Categorieën', 'taxonomy general name', 'aanbod-websites' ),
			'singular_name'     => _x( 'Categorie', 'taxonomy singular name', 'aanbod-websites' ),
			'search_items'      => __( 'Categorieën Zoeken', 'aanbod-websites' ),
			'all_items'         => __( 'Alle Categorieën', 'aanbod-websites' ),
			'parent_item'       => __( 'Parent Categorie', 'aanbod-websites' ),
			'parent_item_colon' => __( 'Parent Categorie:', 'aanbod-websites' ),
			'edit_item'         => __( 'Categorie Bewerken', 'aanbod-websites' ),
			'update_item'       => __( 'Categorie Updaten', 'aanbod-websites' ),
			'add_new_item'      => __( 'Nieuwe Categorie Toevoegen', 'aanbod-websites' ),
			'new_item_name'     => __( 'Nieuwe Categorie Naam', 'aanbod-websites' ),
			'menu_name'         => __( 'Categorieën', 'aanbod-websites' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'website-categorie' ),
		);

		register_taxonomy( 'website_categorie', array( Website_Post_Type::POST_TYPE ), $args );
	}

	/**
	 * Register tag taxonomy
	 *
	 * @return void
	 */
	private function register_tag_taxonomy(): void {
		$labels = array(
			'name'          => _x( 'Website Tags', 'taxonomy general name', 'aanbod-websites' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name', 'aanbod-websites' ),
			'search_items'  => __( 'Tags Zoeken', 'aanbod-websites' ),
			'all_items'     => __( 'Alle Tags', 'aanbod-websites' ),
			'edit_item'     => __( 'Tag Bewerken', 'aanbod-websites' ),
			'update_item'   => __( 'Tag Updaten', 'aanbod-websites' ),
			'add_new_item'  => __( 'Nieuwe Tag Toevoegen', 'aanbod-websites' ),
			'new_item_name' => __( 'Nieuwe Tag Naam', 'aanbod-websites' ),
			'menu_name'     => __( 'Tags', 'aanbod-websites' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'website-tag' ),
		);

		register_taxonomy( 'website_tag', array( Website_Post_Type::POST_TYPE ), $args );
	}
}
