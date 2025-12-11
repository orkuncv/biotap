<?php

/**
 * Website Taxonomies
 */

namespace Aanbod_Websites\Taxonomies;

use Aanbod_Websites\PostTypes\Website_Post_Type;

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Website Taxonomies class
 *
 * Registers taxonomies for the website post type.
 */
class Website_Taxonomies
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('init', [$this, 'register']);
    }

    /**
     * Register taxonomies
     */
    public function register(): void
    {
        $this->register_category_taxonomy();
        $this->register_tag_taxonomy();
    }

    /**
     * Register category taxonomy
     */
    private function register_category_taxonomy(): void
    {
        $labels = [
            'name' => _x('Branches', 'taxonomy general name', 'aanbod-websites'),
            'singular_name' => _x('Branche', 'taxonomy singular name', 'aanbod-websites'),
            'search_items' => __('Branches Zoeken', 'aanbod-websites'),
            'all_items' => __('Alle Branches', 'aanbod-websites'),
            'parent_item' => __('Parent Branche', 'aanbod-websites'),
            'parent_item_colon' => __('Parent Branche:', 'aanbod-websites'),
            'edit_item' => __('Branche Bewerken', 'aanbod-websites'),
            'update_item' => __('Branche Updaten', 'aanbod-websites'),
            'add_new_item' => __('Nieuwe Branche Toevoegen', 'aanbod-websites'),
            'new_item_name' => __('Nieuwe Branche Naam', 'aanbod-websites'),
            'menu_name' => __('Branches', 'aanbod-websites'),
        ];

        $args = [
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'branche'],
        ];

        register_taxonomy('website_categorie', [Website_Post_Type::POST_TYPE], $args);
    }

    /**
     * Register tag taxonomy
     */
    private function register_tag_taxonomy(): void
    {
        $labels = [
            'name' => _x('Branche Tags', 'taxonomy general name', 'aanbod-websites'),
            'singular_name' => _x('Branche Tag', 'taxonomy singular name', 'aanbod-websites'),
            'search_items' => __('Branche Tags Zoeken', 'aanbod-websites'),
            'all_items' => __('Alle Branche Tags', 'aanbod-websites'),
            'edit_item' => __('Branche Tag Bewerken', 'aanbod-websites'),
            'update_item' => __('Branche Tag Updaten', 'aanbod-websites'),
            'add_new_item' => __('Nieuwe Branche Tag Toevoegen', 'aanbod-websites'),
            'new_item_name' => __('Nieuwe Branche Tag Naam', 'aanbod-websites'),
            'menu_name' => __('Branche Tags', 'aanbod-websites'),
        ];

        $args = [
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'branche-tag'],
        ];

        register_taxonomy('website_tag', [Website_Post_Type::POST_TYPE], $args);
    }
}
