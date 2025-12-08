<?php
/**
 * Plugin Name: Aanbod Websites
 * Plugin URI: https://biotap.nl
 * Description: Custom post type voor websites aanbod
 * Version: 1.0.0
 * Author: BioTap
 * Author URI: https://biotap.nl
 * Text Domain: aanbod-websites
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

class Aanbod_Websites {

    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_taxonomies']);
    }

    public function register_post_type() {
        $labels = [
            'name'                  => _x('Websites', 'Post Type General Name', 'aanbod-websites'),
            'singular_name'         => _x('Website', 'Post Type Singular Name', 'aanbod-websites'),
            'menu_name'             => __('Websites', 'aanbod-websites'),
            'name_admin_bar'        => __('Website', 'aanbod-websites'),
            'archives'              => __('Website Archief', 'aanbod-websites'),
            'attributes'            => __('Website Attributen', 'aanbod-websites'),
            'parent_item_colon'     => __('Parent Website:', 'aanbod-websites'),
            'all_items'             => __('Alle Websites', 'aanbod-websites'),
            'add_new_item'          => __('Nieuwe Website Toevoegen', 'aanbod-websites'),
            'add_new'               => __('Nieuwe Toevoegen', 'aanbod-websites'),
            'new_item'              => __('Nieuwe Website', 'aanbod-websites'),
            'edit_item'             => __('Website Bewerken', 'aanbod-websites'),
            'update_item'           => __('Website Updaten', 'aanbod-websites'),
            'view_item'             => __('Website Bekijken', 'aanbod-websites'),
            'view_items'            => __('Websites Bekijken', 'aanbod-websites'),
            'search_items'          => __('Website Zoeken', 'aanbod-websites'),
            'not_found'             => __('Niet Gevonden', 'aanbod-websites'),
            'not_found_in_trash'    => __('Niet Gevonden in Prullenbak', 'aanbod-websites'),
            'featured_image'        => __('Uitgelichte Afbeelding', 'aanbod-websites'),
            'set_featured_image'    => __('Uitgelichte Afbeelding Instellen', 'aanbod-websites'),
            'remove_featured_image' => __('Uitgelichte Afbeelding Verwijderen', 'aanbod-websites'),
            'use_featured_image'    => __('Gebruik als Uitgelichte Afbeelding', 'aanbod-websites'),
            'insert_into_item'      => __('Invoegen in Website', 'aanbod-websites'),
            'uploaded_to_this_item' => __('Geüpload naar deze Website', 'aanbod-websites'),
            'items_list'            => __('Websites Lijst', 'aanbod-websites'),
            'items_list_navigation' => __('Websites Lijst Navigatie', 'aanbod-websites'),
            'filter_items_list'     => __('Filter Websites Lijst', 'aanbod-websites'),
        ];

        $args = [
            'label'                 => __('Website', 'aanbod-websites'),
            'description'           => __('Websites aanbod', 'aanbod-websites'),
            'labels'                => $labels,
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'],
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
            'rewrite'               => ['slug' => 'websites', 'with_front' => false],
        ];

        register_post_type('website', $args);
    }

    public function register_taxonomies() {
        // Categorie taxonomie
        $category_labels = [
            'name'              => _x('Website Categorieën', 'taxonomy general name', 'aanbod-websites'),
            'singular_name'     => _x('Categorie', 'taxonomy singular name', 'aanbod-websites'),
            'search_items'      => __('Categorieën Zoeken', 'aanbod-websites'),
            'all_items'         => __('Alle Categorieën', 'aanbod-websites'),
            'parent_item'       => __('Parent Categorie', 'aanbod-websites'),
            'parent_item_colon' => __('Parent Categorie:', 'aanbod-websites'),
            'edit_item'         => __('Categorie Bewerken', 'aanbod-websites'),
            'update_item'       => __('Categorie Updaten', 'aanbod-websites'),
            'add_new_item'      => __('Nieuwe Categorie Toevoegen', 'aanbod-websites'),
            'new_item_name'     => __('Nieuwe Categorie Naam', 'aanbod-websites'),
            'menu_name'         => __('Categorieën', 'aanbod-websites'),
        ];

        $category_args = [
            'hierarchical'      => true,
            'labels'            => $category_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => ['slug' => 'website-categorie'],
        ];

        register_taxonomy('website_categorie', ['website'], $category_args);

        // Tags taxonomie
        $tag_labels = [
            'name'              => _x('Website Tags', 'taxonomy general name', 'aanbod-websites'),
            'singular_name'     => _x('Tag', 'taxonomy singular name', 'aanbod-websites'),
            'search_items'      => __('Tags Zoeken', 'aanbod-websites'),
            'all_items'         => __('Alle Tags', 'aanbod-websites'),
            'edit_item'         => __('Tag Bewerken', 'aanbod-websites'),
            'update_item'       => __('Tag Updaten', 'aanbod-websites'),
            'add_new_item'      => __('Nieuwe Tag Toevoegen', 'aanbod-websites'),
            'new_item_name'     => __('Nieuwe Tag Naam', 'aanbod-websites'),
            'menu_name'         => __('Tags', 'aanbod-websites'),
        ];

        $tag_args = [
            'hierarchical'      => false,
            'labels'            => $tag_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => ['slug' => 'website-tag'],
        ];

        register_taxonomy('website_tag', ['website'], $tag_args);
    }
}

// Initialize plugin
Aanbod_Websites::get_instance();
