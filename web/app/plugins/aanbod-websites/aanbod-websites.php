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
        add_action('init', [$this, 'start_session']);
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_orders_post_type']);
        add_action('init', [$this, 'register_taxonomies']);
        add_action('init', [$this, 'register_pattern_category']);
        add_action('init', [$this, 'register_patterns']);
        add_action('add_meta_boxes', [$this, 'add_website_meta_boxes']);
        add_action('add_meta_boxes', [$this, 'add_order_meta_boxes']);
        add_action('save_post_website', [$this, 'save_website_meta'], 10, 2);
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_shortcode('website_checkout', [$this, 'render_checkout_shortcode']);
        add_shortcode('website_cta', [$this, 'render_cta_button']);
        add_shortcode('website_packages', [$this, 'render_packages_shortcode']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
        add_action('wp_ajax_submit_website_order', [$this, 'handle_order_submission']);
        add_action('wp_ajax_nopriv_submit_website_order', [$this, 'handle_order_submission']);
        add_action('wp_ajax_set_selected_website', [$this, 'handle_set_selected_website']);
        add_action('wp_ajax_nopriv_set_selected_website', [$this, 'handle_set_selected_website']);
        add_action('wp_ajax_set_selected_website_and_package', [$this, 'handle_set_selected_website_and_package']);
        add_action('wp_ajax_nopriv_set_selected_website_and_package', [$this, 'handle_set_selected_website_and_package']);
        add_action('wp_ajax_clear_selected_website', [$this, 'handle_clear_selected_website']);
        add_action('wp_ajax_nopriv_clear_selected_website', [$this, 'handle_clear_selected_website']);
        add_action('wp_ajax_get_website_id_by_slug', [$this, 'handle_get_website_id_by_slug']);
        add_action('wp_ajax_nopriv_get_website_id_by_slug', [$this, 'handle_get_website_id_by_slug']);
    }

    public function start_session() {
        if (!session_id() && !headers_sent()) {
            session_start();
        }
    }

    public function register_post_type() {
        $labels = [
            'name'                  => _x('Aanbod', 'Post Type General Name', 'aanbod-websites'),
            'singular_name'         => _x('Aanbod', 'Post Type Singular Name', 'aanbod-websites'),
            'menu_name'             => __('Aanbod', 'aanbod-websites'),
            'name_admin_bar'        => __('Aanbod', 'aanbod-websites'),
            'archives'              => __('Aanbod Archief', 'aanbod-websites'),
            'attributes'            => __('Aanbod Attributen', 'aanbod-websites'),
            'parent_item_colon'     => __('Parent Aanbod:', 'aanbod-websites'),
            'all_items'             => __('Alle Aanbod', 'aanbod-websites'),
            'add_new_item'          => __('Nieuw Aanbod Toevoegen', 'aanbod-websites'),
            'add_new'               => __('Nieuwe Toevoegen', 'aanbod-websites'),
            'new_item'              => __('Nieuw Aanbod', 'aanbod-websites'),
            'edit_item'             => __('Aanbod Bewerken', 'aanbod-websites'),
            'update_item'           => __('Aanbod Updaten', 'aanbod-websites'),
            'view_item'             => __('Aanbod Bekijken', 'aanbod-websites'),
            'view_items'            => __('Aanbod Bekijken', 'aanbod-websites'),
            'search_items'          => __('Aanbod Zoeken', 'aanbod-websites'),
            'not_found'             => __('Niet Gevonden', 'aanbod-websites'),
            'not_found_in_trash'    => __('Niet Gevonden in Prullenbak', 'aanbod-websites'),
            'featured_image'        => __('Uitgelichte Afbeelding', 'aanbod-websites'),
            'set_featured_image'    => __('Uitgelichte Afbeelding Instellen', 'aanbod-websites'),
            'remove_featured_image' => __('Uitgelichte Afbeelding Verwijderen', 'aanbod-websites'),
            'use_featured_image'    => __('Gebruik als Uitgelichte Afbeelding', 'aanbod-websites'),
            'insert_into_item'      => __('Invoegen in Aanbod', 'aanbod-websites'),
            'uploaded_to_this_item' => __('Geüpload naar dit Aanbod', 'aanbod-websites'),
            'items_list'            => __('Aanbod Lijst', 'aanbod-websites'),
            'items_list_navigation' => __('Aanbod Lijst Navigatie', 'aanbod-websites'),
            'filter_items_list'     => __('Filter Aanbod Lijst', 'aanbod-websites'),
        ];

        $args = [
            'label'                 => __('Aanbod', 'aanbod-websites'),
            'description'           => __('Aanbod items', 'aanbod-websites'),
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
            'rewrite'               => ['slug' => 'aanbod', 'with_front' => false],
        ];

        register_post_type('website', $args);
    }

    public function register_orders_post_type() {
        $labels = [
            'name'                  => _x('Bestellingen', 'Post Type General Name', 'aanbod-websites'),
            'singular_name'         => _x('Bestelling', 'Post Type Singular Name', 'aanbod-websites'),
            'menu_name'             => __('Bestellingen', 'aanbod-websites'),
            'name_admin_bar'        => __('Bestelling', 'aanbod-websites'),
            'all_items'             => __('Alle Bestellingen', 'aanbod-websites'),
            'add_new_item'          => __('Nieuwe Bestelling', 'aanbod-websites'),
            'edit_item'             => __('Bestelling Bewerken', 'aanbod-websites'),
            'view_item'             => __('Bestelling Bekijken', 'aanbod-websites'),
            'search_items'          => __('Bestellingen Zoeken', 'aanbod-websites'),
            'not_found'             => __('Geen Bestellingen Gevonden', 'aanbod-websites'),
        ];

        $args = [
            'label'                 => __('Bestelling', 'aanbod-websites'),
            'description'           => __('Website bestellingen', 'aanbod-websites'),
            'labels'                => $labels,
            'supports'              => ['title'],
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => 'edit.php?post_type=website',
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'capability_type'       => 'post',
            'show_in_rest'          => false,
            'capabilities'          => [
                'create_posts' => 'do_not_allow',
            ],
            'map_meta_cap'          => true,
        ];

        register_post_type('website_order', $args);
    }

    public function register_taxonomies() {
        // Categorie taxonomie
        $category_labels = [
            'name'              => _x('Branches', 'taxonomy general name', 'aanbod-websites'),
            'singular_name'     => _x('Branche', 'taxonomy singular name', 'aanbod-websites'),
            'search_items'      => __('Branches Zoeken', 'aanbod-websites'),
            'all_items'         => __('Alle Branches', 'aanbod-websites'),
            'parent_item'       => __('Parent Branche', 'aanbod-websites'),
            'parent_item_colon' => __('Parent Branche:', 'aanbod-websites'),
            'edit_item'         => __('Branche Bewerken', 'aanbod-websites'),
            'update_item'       => __('Branche Updaten', 'aanbod-websites'),
            'add_new_item'      => __('Nieuwe Branche Toevoegen', 'aanbod-websites'),
            'new_item_name'     => __('Nieuwe Branche Naam', 'aanbod-websites'),
            'menu_name'         => __('Branches', 'aanbod-websites'),
        ];

        $category_args = [
            'hierarchical'      => true,
            'labels'            => $category_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => ['slug' => 'branche'],
        ];

        register_taxonomy('website_categorie', ['website'], $category_args);

        // Tags taxonomie
        $tag_labels = [
            'name'              => _x('Branche Tags', 'taxonomy general name', 'aanbod-websites'),
            'singular_name'     => _x('Branche Tag', 'taxonomy singular name', 'aanbod-websites'),
            'search_items'      => __('Branche Tags Zoeken', 'aanbod-websites'),
            'all_items'         => __('Alle Branche Tags', 'aanbod-websites'),
            'edit_item'         => __('Branche Tag Bewerken', 'aanbod-websites'),
            'update_item'       => __('Branche Tag Updaten', 'aanbod-websites'),
            'add_new_item'      => __('Nieuwe Branche Tag Toevoegen', 'aanbod-websites'),
            'new_item_name'     => __('Nieuwe Branche Tag Naam', 'aanbod-websites'),
            'menu_name'         => __('Branche Tags', 'aanbod-websites'),
        ];

        $tag_args = [
            'hierarchical'      => false,
            'labels'            => $tag_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => ['slug' => 'branche-tag'],
        ];

        register_taxonomy('website_tag', ['website'], $tag_args);
    }

    public function register_pattern_category() {
        register_block_pattern_category(
            'aanbod-websites',
            [
                'label' => __('Websites', 'aanbod-websites'),
            ]
        );
    }

    public function register_patterns() {
        $patterns_dir = plugin_dir_path(__FILE__) . 'patterns/';

        if (!is_dir($patterns_dir)) {
            return;
        }

        $patterns = glob($patterns_dir . '*.php');

        foreach ($patterns as $pattern_file) {
            $pattern_data = get_file_data($pattern_file, [
                'title'       => 'Title',
                'slug'        => 'Slug',
                'description' => 'Description',
                'categories'  => 'Categories',
                'keywords'    => 'Keywords',
            ]);

            if (empty($pattern_data['slug'])) {
                continue;
            }

            ob_start();
            include $pattern_file;
            $pattern_content = ob_get_clean();

            $categories = !empty($pattern_data['categories'])
                ? array_map('trim', explode(',', $pattern_data['categories']))
                : ['aanbod-websites'];

            $keywords = !empty($pattern_data['keywords'])
                ? array_map('trim', explode(',', $pattern_data['keywords']))
                : [];

            register_block_pattern(
                'aanbod-websites/' . $pattern_data['slug'],
                [
                    'title'       => $pattern_data['title'],
                    'description' => $pattern_data['description'],
                    'content'     => $pattern_content,
                    'categories'  => $categories,
                    'keywords'    => $keywords,
                ]
            );
        }
    }

    public function add_website_meta_boxes() {
        add_meta_box(
            'website_pricing',
            __('Prijzen', 'aanbod-websites'),
            [$this, 'render_pricing_meta_box'],
            'website',
            'normal',
            'high'
        );
    }

    public function render_pricing_meta_box($post) {
        wp_nonce_field('website_pricing_nonce', 'website_pricing_nonce');

        $base_price = get_post_meta($post->ID, '_website_base_price', true);
        $extras = get_post_meta($post->ID, '_website_extras', true);

        if (!is_array($extras)) {
            $extras = [];
        }
        ?>
        <div class="website-pricing-fields">
            <style>
                .website-pricing-fields { padding: 10px 0; }
                .pricing-field { margin-bottom: 20px; }
                .pricing-field label { display: block; margin-bottom: 5px; font-weight: 600; }
                .pricing-field input[type="number"] { width: 200px; }
                .extras-list { margin-top: 10px; }
                .extra-item { display: flex; gap: 10px; margin-bottom: 10px; align-items: center; padding: 10px; background: #f5f5f5; border-radius: 4px; }
                .extra-item input[type="text"] { flex: 1; }
                .extra-item input[type="number"] { width: 150px; }
                .button-remove-extra { color: #b32d2e; }
                .button-remove-extra:hover { color: #dc3232; }
            </style>

            <div class="pricing-field">
                <label for="website_base_price"><?php _e('Basisprijs (€)', 'aanbod-websites'); ?></label>
                <input
                    type="number"
                    id="website_base_price"
                    name="website_base_price"
                    value="<?php echo esc_attr($base_price); ?>"
                    step="0.01"
                    min="0"
                    placeholder="0.00"
                />
            </div>

            <div class="pricing-field">
                <label><?php _e('Website-specifieke Extra Opties', 'aanbod-websites'); ?></label>
                <p style="color: #666; font-size: 13px; margin: 5px 0 10px 0;">
                    <?php _e('Deze opties zijn alleen voor deze website. ', 'aanbod-websites'); ?>
                    <a href="<?php echo admin_url('edit.php?post_type=website&page=website-global-extras'); ?>" target="_blank">
                        <?php _e('Beheer globale opties →', 'aanbod-websites'); ?>
                    </a>
                </p>
                <div class="extras-list" id="extras-list">
                    <?php
                    if (!empty($extras)) {
                        foreach ($extras as $index => $extra) {
                            $this->render_extra_field($index, $extra);
                        }
                    }
                    ?>
                </div>
                <button type="button" class="button" id="add-extra"><?php _e('Website-specifieke Optie Toevoegen', 'aanbod-websites'); ?></button>
            </div>
        </div>

        <script>
        jQuery(document).ready(function($) {
            var extraIndex = <?php echo count($extras); ?>;

            $('#add-extra').on('click', function() {
                var html = `
                    <div class="extra-item">
                        <input
                            type="text"
                            name="website_extras[${extraIndex}][name]"
                            placeholder="<?php _e('Naam van extra optie', 'aanbod-websites'); ?>"
                        />
                        <input
                            type="number"
                            name="website_extras[${extraIndex}][price]"
                            placeholder="0.00"
                            step="0.01"
                            min="0"
                        />
                        <span>€</span>
                        <button type="button" class="button button-remove-extra">Verwijder</button>
                    </div>
                `;
                $('#extras-list').append(html);
                extraIndex++;
            });

            $(document).on('click', '.button-remove-extra', function() {
                $(this).closest('.extra-item').remove();
            });
        });
        </script>
        <?php
    }

    private function render_extra_field($index, $extra) {
        ?>
        <div class="extra-item">
            <input
                type="text"
                name="website_extras[<?php echo $index; ?>][name]"
                value="<?php echo esc_attr($extra['name'] ?? ''); ?>"
                placeholder="<?php _e('Naam van extra optie', 'aanbod-websites'); ?>"
            />
            <input
                type="number"
                name="website_extras[<?php echo $index; ?>][price]"
                value="<?php echo esc_attr($extra['price'] ?? ''); ?>"
                placeholder="0.00"
                step="0.01"
                min="0"
            />
            <span>€</span>
            <button type="button" class="button button-remove-extra">Verwijder</button>
        </div>
        <?php
    }

    public function save_website_meta($post_id, $post) {
        if (!isset($_POST['website_pricing_nonce']) || !wp_verify_nonce($_POST['website_pricing_nonce'], 'website_pricing_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save base price
        if (isset($_POST['website_base_price'])) {
            update_post_meta($post_id, '_website_base_price', sanitize_text_field($_POST['website_base_price']));
        }

        // Save extras
        if (isset($_POST['website_extras']) && is_array($_POST['website_extras'])) {
            $extras = [];
            foreach ($_POST['website_extras'] as $extra) {
                if (!empty($extra['name'])) {
                    $extras[] = [
                        'name' => sanitize_text_field($extra['name']),
                        'price' => sanitize_text_field($extra['price'] ?? '0'),
                    ];
                }
            }
            update_post_meta($post_id, '_website_extras', $extras);
        } else {
            delete_post_meta($post_id, '_website_extras');
        }
    }

    public function add_order_meta_boxes() {
        add_meta_box(
            'order_details',
            __('Bestelling Details', 'aanbod-websites'),
            [$this, 'render_order_details_meta_box'],
            'website_order',
            'normal',
            'high'
        );
    }

    public function render_order_details_meta_box($post) {
        $website_id = get_post_meta($post->ID, '_order_website_id', true);
        $package = get_post_meta($post->ID, '_order_package', true);
        $form_data = get_post_meta($post->ID, '_order_form_data', true);
        $selected_extras = get_post_meta($post->ID, '_order_selected_extras', true);
        $total_price = get_post_meta($post->ID, '_order_total_price', true);

        $website = $website_id ? get_post($website_id) : null;
        ?>
        <style>
            .order-details { padding: 10px 0; }
            .order-section { margin-bottom: 25px; padding: 15px; background: #f5f5f5; border-radius: 4px; }
            .order-section h3 { margin-top: 0; }
            .order-field { margin-bottom: 10px; }
            .order-field strong { display: inline-block; width: 150px; }
            .order-price { font-size: 1.5em; color: #2271b1; font-weight: bold; }
        </style>
        <div class="order-details">
            <?php if ($website): ?>
            <div class="order-section">
                <h3><?php _e('Gekozen Website', 'aanbod-websites'); ?></h3>
                <div class="order-field">
                    <strong><?php _e('Website:', 'aanbod-websites'); ?></strong>
                    <a href="<?php echo get_edit_post_link($website_id); ?>" target="_blank">
                        <?php echo esc_html($website->post_title); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($package) && is_array($package)): ?>
            <div class="order-section">
                <h3><?php _e('Gekozen Pakket', 'aanbod-websites'); ?></h3>
                <div class="order-field">
                    <strong><?php _e('Pakket:', 'aanbod-websites'); ?></strong>
                    <?php echo esc_html($package['name']); ?>
                </div>
                <div class="order-field">
                    <strong><?php _e('Prijs:', 'aanbod-websites'); ?></strong>
                    €<?php echo number_format((float)$package['price'], 2, ',', '.'); ?>
                </div>
                <?php if (!empty($package['description'])): ?>
                <div class="order-field">
                    <strong><?php _e('Beschrijving:', 'aanbod-websites'); ?></strong>
                    <?php echo esc_html($package['description']); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($selected_extras) && is_array($selected_extras)): ?>
            <div class="order-section">
                <h3><?php _e('Geselecteerde Extra Opties', 'aanbod-websites'); ?></h3>
                <?php foreach ($selected_extras as $extra): ?>
                <div class="order-field">
                    <strong><?php echo esc_html($extra['name']); ?>:</strong>
                    €<?php echo number_format((float)$extra['price'], 2, ',', '.'); ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($total_price): ?>
            <div class="order-section">
                <h3><?php _e('Totaalprijs', 'aanbod-websites'); ?></h3>
                <div class="order-price">€<?php echo number_format((float)$total_price, 2, ',', '.'); ?></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($form_data) && is_array($form_data)): ?>
            <div class="order-section">
                <h3><?php _e('Klantgegevens', 'aanbod-websites'); ?></h3>
                <?php foreach ($form_data as $key => $value): ?>
                <div class="order-field">
                    <strong><?php echo esc_html(ucfirst(str_replace('_', ' ', $key))); ?>:</strong>
                    <?php echo esc_html($value); ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }

    public function add_settings_page() {
        add_submenu_page(
            'edit.php?post_type=website',
            __('Pakketten', 'aanbod-websites'),
            __('Pakketten', 'aanbod-websites'),
            'manage_options',
            'website-packages',
            [$this, 'render_packages_page']
        );

        add_submenu_page(
            'edit.php?post_type=website',
            __('Checkout Instellingen', 'aanbod-websites'),
            __('Checkout Instellingen', 'aanbod-websites'),
            'manage_options',
            'website-checkout-settings',
            [$this, 'render_settings_page']
        );

        add_submenu_page(
            'edit.php?post_type=website',
            __('Globale Extra Opties', 'aanbod-websites'),
            __('Globale Extra Opties', 'aanbod-websites'),
            'manage_options',
            'website-global-extras',
            [$this, 'render_global_extras_page']
        );
    }

    public function register_settings() {
        register_setting('website_checkout_settings', 'website_checkout_fields');
    }

    public function render_settings_page() {
        if (isset($_POST['save_checkout_fields']) && check_admin_referer('website_checkout_fields_nonce')) {
            $fields = isset($_POST['checkout_fields']) ? $_POST['checkout_fields'] : [];
            $sanitized_fields = [];

            foreach ($fields as $field) {
                if (!empty($field['label'])) {
                    $sanitized_fields[] = [
                        'label' => sanitize_text_field($field['label']),
                        'type' => sanitize_text_field($field['type']),
                        'required' => isset($field['required']) ? 1 : 0,
                        'placeholder' => sanitize_text_field($field['placeholder'] ?? ''),
                        'width' => sanitize_text_field($field['width'] ?? '100'),
                    ];
                }
            }

            update_option('website_checkout_fields', $sanitized_fields);
            echo '<div class="notice notice-success"><p>' . __('Instellingen opgeslagen!', 'aanbod-websites') . '</p></div>';
        }

        $fields = get_option('website_checkout_fields', []);
        ?>
        <div class="wrap">
            <h1><?php _e('Checkout Formulier Instellingen', 'aanbod-websites'); ?></h1>
            <p><?php _e('Beheer de velden die worden getoond op de checkout pagina.', 'aanbod-websites'); ?></p>

            <style>
                .checkout-fields-table { width: 100%; max-width: 1000px; margin-top: 20px; }
                .checkout-fields-table th { text-align: left; padding: 10px; background: #f5f5f5; }
                .checkout-fields-table td { padding: 10px; border-bottom: 1px solid #ddd; }
                .checkout-fields-table input[type="text"] { width: 100%; }
                .checkout-fields-table select { width: 100%; }
                .field-actions { text-align: center; }
            </style>

            <form method="post" action="">
                <?php wp_nonce_field('website_checkout_fields_nonce'); ?>

                <table class="checkout-fields-table">
                    <thead>
                        <tr>
                            <th style="width: 20%;"><?php _e('Label', 'aanbod-websites'); ?></th>
                            <th style="width: 15%;"><?php _e('Type', 'aanbod-websites'); ?></th>
                            <th style="width: 20%;"><?php _e('Placeholder', 'aanbod-websites'); ?></th>
                            <th style="width: 15%;"><?php _e('Breedte', 'aanbod-websites'); ?></th>
                            <th style="width: 15%;"><?php _e('Verplicht', 'aanbod-websites'); ?></th>
                            <th style="width: 15%;"><?php _e('Acties', 'aanbod-websites'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="checkout-fields-list">
                        <?php
                        if (!empty($fields)) {
                            foreach ($fields as $index => $field) {
                                $this->render_field_row($index, $field);
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <p>
                    <button type="button" class="button" id="add-checkout-field"><?php _e('Veld Toevoegen', 'aanbod-websites'); ?></button>
                    <button type="submit" name="save_checkout_fields" class="button button-primary"><?php _e('Instellingen Opslaan', 'aanbod-websites'); ?></button>
                </p>
            </form>

            <script>
            jQuery(document).ready(function($) {
                var fieldIndex = <?php echo count($fields); ?>;

                $('#add-checkout-field').on('click', function() {
                    var html = `
                        <tr>
                            <td>
                                <input type="text" name="checkout_fields[${fieldIndex}][label]" placeholder="Bijv. Naam" />
                            </td>
                            <td>
                                <select name="checkout_fields[${fieldIndex}][type]">
                                    <option value="text">Tekst</option>
                                    <option value="email">Email</option>
                                    <option value="tel">Telefoon</option>
                                    <option value="textarea">Tekstgebied</option>
                                    <option value="number">Nummer</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="checkout_fields[${fieldIndex}][placeholder]" placeholder="Placeholder tekst" />
                            </td>
                            <td>
                                <select name="checkout_fields[${fieldIndex}][width]">
                                    <option value="50">50%</option>
                                    <option value="100" selected>100%</option>
                                </select>
                            </td>
                            <td style="text-align: center;">
                                <input type="checkbox" name="checkout_fields[${fieldIndex}][required]" value="1" />
                            </td>
                            <td class="field-actions">
                                <button type="button" class="button button-remove-field">Verwijder</button>
                            </td>
                        </tr>
                    `;
                    $('#checkout-fields-list').append(html);
                    fieldIndex++;
                });

                $(document).on('click', '.button-remove-field', function() {
                    $(this).closest('tr').remove();
                });
            });
            </script>
        </div>
        <?php
    }

    private function render_field_row($index, $field) {
        $width = isset($field['width']) ? $field['width'] : '100';
        ?>
        <tr>
            <td>
                <input type="text" name="checkout_fields[<?php echo $index; ?>][label]" value="<?php echo esc_attr($field['label']); ?>" />
            </td>
            <td>
                <select name="checkout_fields[<?php echo $index; ?>][type]">
                    <option value="text" <?php selected($field['type'], 'text'); ?>>Tekst</option>
                    <option value="email" <?php selected($field['type'], 'email'); ?>>Email</option>
                    <option value="tel" <?php selected($field['type'], 'tel'); ?>>Telefoon</option>
                    <option value="textarea" <?php selected($field['type'], 'textarea'); ?>>Tekstgebied</option>
                    <option value="number" <?php selected($field['type'], 'number'); ?>>Nummer</option>
                </select>
            </td>
            <td>
                <input type="text" name="checkout_fields[<?php echo $index; ?>][placeholder]" value="<?php echo esc_attr($field['placeholder'] ?? ''); ?>" />
            </td>
            <td>
                <select name="checkout_fields[<?php echo $index; ?>][width]">
                    <option value="50" <?php selected($width, '50'); ?>>50%</option>
                    <option value="100" <?php selected($width, '100'); ?>>100%</option>
                </select>
            </td>
            <td style="text-align: center;">
                <input type="checkbox" name="checkout_fields[<?php echo $index; ?>][required]" value="1" <?php checked($field['required'], 1); ?> />
            </td>
            <td class="field-actions">
                <button type="button" class="button button-remove-field">Verwijder</button>
            </td>
        </tr>
        <?php
    }

    public function render_global_extras_page() {
        if (isset($_POST['save_global_extras']) && check_admin_referer('website_global_extras_nonce')) {
            $extras = isset($_POST['global_extras']) ? $_POST['global_extras'] : [];
            $sanitized_extras = [];

            foreach ($extras as $extra) {
                if (!empty($extra['name'])) {
                    $sanitized_extras[] = [
                        'name' => sanitize_text_field($extra['name']),
                        'price' => sanitize_text_field($extra['price']),
                    ];
                }
            }

            update_option('website_global_extras', $sanitized_extras);
            echo '<div class="notice notice-success"><p>' . __('Globale extra opties opgeslagen!', 'aanbod-websites') . '</p></div>';
        }

        $global_extras = get_option('website_global_extras', []);
        ?>
        <div class="wrap">
            <h1><?php _e('Globale Extra Opties', 'aanbod-websites'); ?></h1>
            <p><?php _e('Beheer extra opties die beschikbaar zijn voor alle websites. Deze worden altijd getoond op de checkout pagina, naast eventuele website-specifieke opties.', 'aanbod-websites'); ?></p>

            <style>
                .global-extras-table { width: 100%; max-width: 800px; margin-top: 20px; }
                .global-extras-table th { text-align: left; padding: 10px; background: #f5f5f5; }
                .global-extras-table td { padding: 10px; border-bottom: 1px solid #ddd; }
                .global-extras-table input[type="text"] { width: 100%; }
                .global-extras-table input[type="number"] { width: 100%; }
            </style>

            <form method="post" action="">
                <?php wp_nonce_field('website_global_extras_nonce'); ?>

                <table class="global-extras-table">
                    <thead>
                        <tr>
                            <th style="width: 50%;"><?php _e('Naam Extra Optie', 'aanbod-websites'); ?></th>
                            <th style="width: 30%;"><?php _e('Prijs (€)', 'aanbod-websites'); ?></th>
                            <th style="width: 20%;"><?php _e('Acties', 'aanbod-websites'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="global-extras-list">
                        <?php
                        if (!empty($global_extras)) {
                            foreach ($global_extras as $index => $extra) {
                                $this->render_global_extra_row($index, $extra);
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <p>
                    <button type="button" class="button" id="add-global-extra"><?php _e('Extra Optie Toevoegen', 'aanbod-websites'); ?></button>
                    <button type="submit" name="save_global_extras" class="button button-primary"><?php _e('Opties Opslaan', 'aanbod-websites'); ?></button>
                </p>
            </form>

            <script>
            jQuery(document).ready(function($) {
                var extraIndex = <?php echo count($global_extras); ?>;

                $('#add-global-extra').on('click', function() {
                    var html = `
                        <tr>
                            <td>
                                <input type="text" name="global_extras[${extraIndex}][name]" placeholder="Bijv. SEO Optimalisatie" />
                            </td>
                            <td>
                                <input type="number" name="global_extras[${extraIndex}][price]" placeholder="0.00" step="0.01" min="0" />
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="button button-remove-global-extra">Verwijder</button>
                            </td>
                        </tr>
                    `;
                    $('#global-extras-list').append(html);
                    extraIndex++;
                });

                $(document).on('click', '.button-remove-global-extra', function() {
                    $(this).closest('tr').remove();
                });
            });
            </script>
        </div>
        <?php
    }

    private function render_global_extra_row($index, $extra) {
        ?>
        <tr>
            <td>
                <input type="text" name="global_extras[<?php echo $index; ?>][name]" value="<?php echo esc_attr($extra['name']); ?>" />
            </td>
            <td>
                <input type="number" name="global_extras[<?php echo $index; ?>][price]" value="<?php echo esc_attr($extra['price']); ?>" step="0.01" min="0" />
            </td>
            <td style="text-align: center;">
                <button type="button" class="button button-remove-global-extra">Verwijder</button>
            </td>
        </tr>
        <?php
    }

    public function render_packages_page() {
        if (isset($_POST['save_packages']) && check_admin_referer('website_packages_nonce')) {
            $packages = isset($_POST['packages']) ? $_POST['packages'] : [];
            $sanitized_packages = [];

            foreach ($packages as $package) {
                if (!empty($package['name'])) {
                    $sanitized_packages[] = [
                        'name' => sanitize_text_field($package['name']),
                        'description' => sanitize_textarea_field($package['description']),
                        'price' => sanitize_text_field($package['price']),
                        'features' => sanitize_textarea_field($package['features']),
                    ];
                }
            }

            update_option('website_packages', $sanitized_packages);
            echo '<div class="notice notice-success"><p>' . __('Pakketten opgeslagen!', 'aanbod-websites') . '</p></div>';
        }

        $packages = get_option('website_packages', []);
        ?>
        <div class="wrap">
            <h1><?php _e('Pakketten Beheer', 'aanbod-websites'); ?></h1>
            <p><?php _e('Beheer de pakketten die klanten kunnen kiezen bij een website. Pakketten bepalen de prijs en features.', 'aanbod-websites'); ?></p>
            <p><strong><?php _e('Shortcode:', 'aanbod-websites'); ?></strong> <code>[website_packages]</code> - <?php _e('Gebruik deze shortcode om alle pakketten te tonen op een pagina.', 'aanbod-websites'); ?></p>

            <style>
                .packages-table { width: 100%; max-width: 1200px; margin-top: 20px; border-collapse: collapse; }
                .packages-table th { text-align: left; padding: 10px; background: #f5f5f5; border: 1px solid #ddd; }
                .packages-table td { padding: 10px; border: 1px solid #ddd; vertical-align: top; }
                .packages-table input[type="text"], .packages-table textarea { width: 100%; }
                .packages-table textarea { min-height: 80px; resize: vertical; }
                .package-row { background: #fff; }
                .package-row:nth-child(even) { background: #f9f9f9; }
            </style>

            <form method="post" action="">
                <?php wp_nonce_field('website_packages_nonce'); ?>

                <table class="packages-table">
                    <thead>
                        <tr>
                            <th style="width: 20%;"><?php _e('Pakket Naam', 'aanbod-websites'); ?></th>
                            <th style="width: 30%;"><?php _e('Beschrijving', 'aanbod-websites'); ?></th>
                            <th style="width: 15%;"><?php _e('Prijs (€)', 'aanbod-websites'); ?></th>
                            <th style="width: 25%;"><?php _e('Features', 'aanbod-websites'); ?></th>
                            <th style="width: 10%;"><?php _e('Acties', 'aanbod-websites'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="packages-list">
                        <?php
                        if (!empty($packages)) {
                            foreach ($packages as $index => $package) {
                                $this->render_package_row($index, $package);
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <p>
                    <button type="button" class="button" id="add-package"><?php _e('Pakket Toevoegen', 'aanbod-websites'); ?></button>
                    <button type="submit" name="save_packages" class="button button-primary"><?php _e('Pakketten Opslaan', 'aanbod-websites'); ?></button>
                </p>
            </form>

            <script>
            jQuery(document).ready(function($) {
                var packageIndex = <?php echo count($packages); ?>;

                $('#add-package').on('click', function() {
                    var html = `
                        <tr class="package-row">
                            <td>
                                <input type="text" name="packages[${packageIndex}][name]" placeholder="Bijv. Basis Pakket" />
                            </td>
                            <td>
                                <textarea name="packages[${packageIndex}][description]" placeholder="Korte beschrijving van het pakket"></textarea>
                            </td>
                            <td>
                                <input type="number" name="packages[${packageIndex}][price]" placeholder="0.00" step="0.01" min="0" />
                            </td>
                            <td>
                                <textarea name="packages[${packageIndex}][features]" placeholder="Eén feature per regel"></textarea>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="button button-remove-package">Verwijder</button>
                            </td>
                        </tr>
                    `;
                    $('#packages-list').append(html);
                    packageIndex++;
                });

                $(document).on('click', '.button-remove-package', function() {
                    $(this).closest('tr').remove();
                });
            });
            </script>
        </div>
        <?php
    }

    private function render_package_row($index, $package) {
        ?>
        <tr class="package-row">
            <td>
                <input type="text" name="packages[<?php echo $index; ?>][name]" value="<?php echo esc_attr($package['name']); ?>" />
            </td>
            <td>
                <textarea name="packages[<?php echo $index; ?>][description]"><?php echo esc_textarea($package['description']); ?></textarea>
            </td>
            <td>
                <input type="number" name="packages[<?php echo $index; ?>][price]" value="<?php echo esc_attr($package['price']); ?>" step="0.01" min="0" />
            </td>
            <td>
                <textarea name="packages[<?php echo $index; ?>][features]"><?php echo esc_textarea($package['features']); ?></textarea>
            </td>
            <td style="text-align: center;">
                <button type="button" class="button button-remove-package">Verwijder</button>
            </td>
        </tr>
        <?php
    }

    public function render_packages_shortcode($atts) {
        global $post;

        $atts = shortcode_atts([
            'website_id' => 0,
            'checkout_page' => 'checkout',
            'button_text' => __('Kies dit pakket', 'aanbod-websites'),
        ], $atts);

        // Get website ID from attribute, current post, or get_the_ID()
        $website_id = $atts['website_id'] ? intval($atts['website_id']) : ($post->ID ?? get_the_ID());

        // Only show packages on website post types
        if (!$website_id || get_post_type($website_id) !== 'website') {
            return '<p>' . __('Deze shortcode werkt alleen op website paginas.', 'aanbod-websites') . '</p>';
        }

        $packages = get_option('website_packages', []);

        if (empty($packages)) {
            return '<p>' . __('Geen pakketten beschikbaar.', 'aanbod-websites') . '</p>';
        }

        $checkout_url = home_url('/' . $atts['checkout_page'] . '/');

        ob_start();
        ?>
        <div class="website-packages-wrapper" data-website-id="<?php echo esc_attr($website_id); ?>" data-checkout-url="<?php echo esc_url($checkout_url); ?>">
            <style>
                .website-packages-wrapper {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 30px;
                    margin: 40px 0;
                }
                .package-card {
                    background: #fff;
                    border: 2px solid #e5e5e5;
                    border-radius: 8px;
                    padding: 30px;
                    transition: all 0.3s ease;
                    display: flex;
                    flex-direction: column;
                }
                .package-card:hover {
                    border-color: #2271b1;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                }
                .package-card h3 {
                    margin: 0 0 15px 0;
                    color: #2271b1;
                    font-size: 24px;
                }
                .package-price {
                    font-size: 32px;
                    font-weight: bold;
                    color: #333;
                    margin: 15px 0;
                }
                .package-price small {
                    font-size: 16px;
                    font-weight: normal;
                    color: #666;
                }
                .package-description {
                    color: #666;
                    margin: 15px 0;
                    line-height: 1.6;
                }
                .package-features {
                    list-style: none;
                    padding: 0;
                    margin: 20px 0;
                    flex: 1;
                }
                .package-features li {
                    padding: 8px 0;
                    border-bottom: 1px solid #f0f0f0;
                    color: #444;
                }
                .package-features li:before {
                    content: "✓";
                    color: #2271b1;
                    font-weight: bold;
                    margin-right: 10px;
                }
                .package-cta-button {
                    display: inline-block;
                    width: 100%;
                    padding: 15px 30px;
                    background: #2271b1;
                    color: #fff;
                    text-align: center;
                    text-decoration: none;
                    border-radius: 4px;
                    font-weight: 600;
                    font-size: 16px;
                    transition: background 0.3s ease;
                    border: none;
                    cursor: pointer;
                    margin-top: 20px;
                }
                .package-cta-button:hover {
                    background: #135e96;
                    color: #fff;
                }
            </style>
            <?php foreach ($packages as $index => $package): ?>
            <div class="package-card" data-package-index="<?php echo $index; ?>">
                <h3><?php echo esc_html($package['name']); ?></h3>
                <div class="package-price">
                    €<?php echo number_format((float)$package['price'], 2, ',', '.'); ?>
                    <small>/eenmalig</small>
                </div>
                <?php if (!empty($package['description'])): ?>
                <div class="package-description">
                    <?php echo wp_kses_post(nl2br($package['description'])); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($package['features'])):
                    $features = array_filter(explode("\n", $package['features']));
                    if (!empty($features)):
                ?>
                <ul class="package-features">
                    <?php foreach ($features as $feature): ?>
                    <li><?php echo esc_html(trim($feature)); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; endif; ?>
                <button
                    class="package-cta-button"
                    data-package-index="<?php echo $index; ?>"
                    data-website-id="<?php echo esc_attr($website_id); ?>"
                    data-checkout-url="<?php echo esc_url($checkout_url); ?>">
                    <?php echo esc_html($atts['button_text']); ?>
                </button>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    public function render_cta_button($atts) {
        global $post;

        $atts = shortcode_atts([
            'text' => __('Website Bestellen', 'aanbod-websites'),
            'checkout_page' => 'checkout',
            'website_id' => 0,
        ], $atts);

        // Get post ID from attribute, current post, or get_the_ID()
        $post_id = $atts['website_id'] ? intval($atts['website_id']) : ($post->ID ?? get_the_ID());

        if (!$post_id || get_post_type($post_id) !== 'website') {
            return '';
        }

        $checkout_url = home_url('/' . $atts['checkout_page'] . '/');

        return sprintf(
            '<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button website-cta-button" href="%s" data-website-id="%s" data-checkout-url="%s">%s</a></div></div>',
            esc_url($checkout_url),
            esc_attr($post_id),
            esc_url($checkout_url),
            esc_html($atts['text'])
        );
    }

    public function enqueue_frontend_assets() {
        // Enqueue CTA assets on all pages (since shortcode can be in patterns)
        wp_enqueue_style('aanbod-websites-cta', plugin_dir_url(__FILE__) . 'assets/cta.css', [], '1.0.0');
        wp_enqueue_script('aanbod-websites-cta', plugin_dir_url(__FILE__) . 'assets/cta.js', ['jquery'], '1.0.0', true);
        wp_localize_script('aanbod-websites-cta', 'aanbodWebsitesCTA', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
        ]);

        // Enqueue packages assets on all pages (since shortcode can be anywhere)
        wp_enqueue_script('aanbod-websites-packages', plugin_dir_url(__FILE__) . 'assets/packages.js', ['jquery'], '1.0.0', true);
        wp_localize_script('aanbod-websites-packages', 'aanbodWebsitesPackages', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
        ]);

        // Enqueue checkout assets only on checkout page
        if (has_shortcode(get_post()->post_content ?? '', 'website_checkout')) {
            wp_enqueue_style('aanbod-websites-checkout', plugin_dir_url(__FILE__) . 'assets/checkout.css', [], '1.0.0');
            wp_enqueue_script('aanbod-websites-checkout', plugin_dir_url(__FILE__) . 'assets/checkout.js', ['jquery'], '1.0.0', true);

            $selected_package_index = isset($_SESSION['selected_package_index']) ? intval($_SESSION['selected_package_index']) : -1;

            wp_localize_script('aanbod-websites-checkout', 'aanbodWebsites', [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('website_order_nonce'),
                'preselectedPackage' => $selected_package_index,
            ]);
        }
    }

    public function render_checkout_shortcode($atts) {
        // Get website ID from session
        $website_id = isset($_SESSION['selected_website_id']) ? intval($_SESSION['selected_website_id']) : 0;

        if (!$website_id || get_post_type($website_id) !== 'website') {
            return '<div class="no-website-selected">
                <p>' . __('Geen website geselecteerd. Kies eerst een website om te bestellen.', 'aanbod-websites') . '</p>
            </div>';
        }

        $website = get_post($website_id);
        $packages = get_option('website_packages', []);
        $global_extras = get_option('website_global_extras', []);
        $custom_extras = get_post_meta($website_id, '_website_extras', true);
        $checkout_fields = get_option('website_checkout_fields', []);

        // Combine global and custom extras
        $has_extras = (!empty($global_extras) && is_array($global_extras)) || (!empty($custom_extras) && is_array($custom_extras));

        ob_start();
        ?>
        <div class="website-checkout-wrapper">
            <div class="checkout-container">
                <!-- LEFT COLUMN: Product Showcase -->
                <div class="checkout-left">
                    <h2><?php _e('Je Keuze', 'aanbod-websites'); ?></h2>

                    <div class="product-showcase">
                        <?php if (has_post_thumbnail($website_id)): ?>
                            <div class="website-image">
                                <?php echo get_the_post_thumbnail($website_id, 'medium'); ?>
                            </div>
                        <?php endif; ?>

                        <h3><?php echo esc_html($website->post_title); ?></h3>
                        <?php if ($website->post_excerpt): ?>
                            <div class="website-excerpt">
                                <?php echo wp_kses_post($website->post_excerpt); ?>
                            </div>
                        <?php endif; ?>

                        <button type="button" class="button-change-website" id="change-website-btn">
                            <?php _e('Website Wijzigen', 'aanbod-websites'); ?>
                        </button>
                    </div>

                    <script>
                    jQuery(document).ready(function($) {
                        $('#change-website-btn').on('click', function() {
                            if (confirm('<?php _e('Weet je zeker dat je de geselecteerde website wilt wijzigen? Je selecties worden gewist.', 'aanbod-websites'); ?>')) {
                                $.ajax({
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    type: 'POST',
                                    data: {
                                        action: 'clear_selected_website'
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            window.location.href = '<?php echo home_url('/websites/'); ?>';
                                        }
                                    }
                                });
                            }
                        });
                    });
                    </script>
                </div>
                <!-- END LEFT COLUMN -->

                <!-- RIGHT COLUMN: Checkout Form -->
                <div class="checkout-right">
                    <h2><?php _e('Start nu je bestelling', 'aanbod-websites'); ?></h2>
                    <p class="subtitle"><?php echo esc_html($website->post_title); ?> - Vul je gegevens in</p>

                    <?php if (!empty($packages)): ?>
                    <div class="package-selection-section">
                        <p class="section-title"><?php _e('Kies een Pakket', 'aanbod-websites'); ?> <span class="required">*</span></p>
                        <p class="section-description"><?php _e('Selecteer het pakket dat bij je past', 'aanbod-websites'); ?></p>

                        <div class="packages-grid">
                            <?php foreach ($packages as $index => $package): ?>
                            <label class="package-option" data-package-index="<?php echo $index; ?>">
                                <input
                                    type="radio"
                                    name="selected_package"
                                    value="<?php echo $index; ?>"
                                    data-price="<?php echo esc_attr($package['price']); ?>"
                                    data-name="<?php echo esc_attr($package['name']); ?>"
                                    required
                                />
                                <div class="package-option-content">
                                    <h4><?php echo esc_html($package['name']); ?></h4>
                                    <div class="package-option-price">€<?php echo number_format((float)$package['price'], 2, ',', '.'); ?></div>
                                    <?php if (!empty($package['description'])): ?>
                                    <p class="package-option-desc"><?php echo esc_html(wp_trim_words($package['description'], 15)); ?></p>
                                    <?php endif; ?>
                                </div>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($has_extras): ?>
                    <div class="extras-selection">
                        <p><?php _e('Extra Opties', 'aanbod-websites'); ?></p>

                        <?php if (!empty($global_extras) && is_array($global_extras)): ?>
                            <?php foreach ($global_extras as $index => $extra): ?>
                            <label class="extra-option">
                                <input
                                    type="checkbox"
                                    name="extras[]"
                                    value="global_<?php echo $index; ?>"
                                    data-price="<?php echo esc_attr($extra['price']); ?>"
                                    data-name="<?php echo esc_attr($extra['name']); ?>"
                                    data-type="global"
                                />
                                <span class="extra-name"><?php echo esc_html($extra['name']); ?></span>
                                <span class="extra-price">€<?php echo number_format((float)$extra['price'], 2, ',', '.'); ?></span>
                            </label>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($custom_extras) && is_array($custom_extras)): ?>
                            <?php if (!empty($global_extras)): ?>
                                <div style="margin: 15px 0; padding-top: 15px; border-top: 1px solid #ddd;">
                                    <strong style="display: block; margin-bottom: 10px; color: #666; font-size: 14px;">
                                        <?php _e('Website-specifieke opties:', 'aanbod-websites'); ?>
                                    </strong>
                                </div>
                            <?php endif; ?>
                            <?php foreach ($custom_extras as $index => $extra): ?>
                            <label class="extra-option">
                                <input
                                    type="checkbox"
                                    name="extras[]"
                                    value="custom_<?php echo $index; ?>"
                                    data-price="<?php echo esc_attr($extra['price']); ?>"
                                    data-name="<?php echo esc_attr($extra['name']); ?>"
                                    data-type="custom"
                                />
                                <span class="extra-name"><?php echo esc_html($extra['name']); ?></span>
                                <span class="extra-price">€<?php echo number_format((float)$extra['price'], 2, ',', '.'); ?></span>
                            </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($checkout_fields)): ?>
                    <div class="checkout-form-section">
                        <p><?php _e('Uw Gegevens', 'aanbod-websites'); ?></p>
                        <form id="website-checkout-form">
                            <input type="hidden" name="website_id" value="<?php echo $website_id; ?>">
                            <input type="hidden" name="action" value="submit_website_order">
                            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('website_order_nonce'); ?>">

                            <div class="form-fields-grid">
                                <?php foreach ($checkout_fields as $index => $field):
                                    $width = isset($field['width']) ? $field['width'] : '100';
                                    $span = $width == '50' ? '6' : '12';
                                ?>
                                <div class="form-field col-span-<?php echo $span; ?>">
                                    <label for="field_<?php echo $index; ?>">
                                        <?php echo esc_html($field['label']); ?>
                                        <?php if ($field['required']): ?>
                                            <span class="required">*</span>
                                        <?php endif; ?>
                                    </label>

                                    <?php if ($field['type'] === 'textarea'): ?>
                                        <textarea
                                            id="field_<?php echo $index; ?>"
                                            name="form_fields[<?php echo sanitize_key($field['label']); ?>]"
                                            placeholder="<?php echo esc_attr($field['placeholder']); ?>"
                                            <?php echo $field['required'] ? 'required' : ''; ?>
                                        ></textarea>
                                    <?php else: ?>
                                        <input
                                            type="<?php echo esc_attr($field['type']); ?>"
                                            id="field_<?php echo $index; ?>"
                                            name="form_fields[<?php echo sanitize_key($field['label']); ?>]"
                                            placeholder="<?php echo esc_attr($field['placeholder']); ?>"
                                            <?php echo $field['required'] ? 'required' : ''; ?>
                                        />
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <button type="submit" class="button-submit"><?php _e('Bestelling Plaatsen', 'aanbod-websites'); ?></button>
                        </form>
                        <div id="form-messages"></div>
                    </div>
                    <?php endif; ?>

                    <!-- Order Summary (inside right column) -->
                    <div class="order-summary">
                        <h3><?php _e('Besteloverzicht', 'aanbod-websites'); ?></h3>

                        <div class="summary-row" id="package-price-row" style="display: none;">
                            <span id="package-name"><?php _e('Pakket', 'aanbod-websites'); ?></span>
                            <span class="price" id="package-price" data-price="0">€0,00</span>
                        </div>

                        <div id="selected-extras-summary"></div>

                        <div class="summary-divider"></div>

                        <div class="summary-row summary-total">
                            <span><?php _e('Vandaag te betalen', 'aanbod-websites'); ?></span>
                            <span class="price total-price" id="total-price">
                                €<?php echo number_format((float)$base_price, 2, ',', '.'); ?>
                            </span>
                        </div>

                        <p class="vat-notice">0% btw</p>
                    </div>

                </div>
                <!-- END RIGHT COLUMN -->
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function handle_order_submission() {
        check_ajax_referer('website_order_nonce', 'nonce');

        $website_id = isset($_POST['website_id']) ? intval($_POST['website_id']) : 0;
        $selected_package_index = isset($_POST['selected_package']) ? intval($_POST['selected_package']) : -1;
        $form_fields = isset($_POST['form_fields']) ? $_POST['form_fields'] : [];
        $selected_extras_indexes = isset($_POST['selected_extras']) ? $_POST['selected_extras'] : [];

        if (!$website_id || get_post_type($website_id) !== 'website') {
            wp_send_json_error(['message' => __('Ongeldige website.', 'aanbod-websites')]);
        }

        // Get packages and validate selection
        $packages = get_option('website_packages', []);
        if ($selected_package_index < 0 || !isset($packages[$selected_package_index])) {
            wp_send_json_error(['message' => __('Selecteer een pakket om door te gaan.', 'aanbod-websites')]);
        }

        $selected_package = $packages[$selected_package_index];

        // Get website data
        $website = get_post($website_id);
        $global_extras = get_option('website_global_extras', []);
        $custom_extras = get_post_meta($website_id, '_website_extras', true);

        // Calculate total starting with package price
        $total_price = (float) $selected_package['price'];
        $selected_extras = [];

        if (!empty($selected_extras_indexes) && is_array($selected_extras_indexes)) {
            foreach ($selected_extras_indexes as $extra_key) {
                // Check if it's a global or custom extra
                if (strpos($extra_key, 'global_') === 0) {
                    $index = intval(str_replace('global_', '', $extra_key));
                    if (isset($global_extras[$index])) {
                        $extra = $global_extras[$index];
                        $selected_extras[] = $extra;
                        $total_price += (float) $extra['price'];
                    }
                } elseif (strpos($extra_key, 'custom_') === 0) {
                    $index = intval(str_replace('custom_', '', $extra_key));
                    if (is_array($custom_extras) && isset($custom_extras[$index])) {
                        $extra = $custom_extras[$index];
                        $selected_extras[] = $extra;
                        $total_price += (float) $extra['price'];
                    }
                }
            }
        }

        // Sanitize form data
        $sanitized_form_data = [];
        foreach ($form_fields as $key => $value) {
            $sanitized_form_data[sanitize_key($key)] = sanitize_text_field($value);
        }

        // Create order
        $order_title = sprintf(
            __('Bestelling - %s - %s', 'aanbod-websites'),
            $website->post_title,
            date('d-m-Y H:i')
        );

        $order_id = wp_insert_post([
            'post_title' => $order_title,
            'post_type' => 'website_order',
            'post_status' => 'publish',
        ]);

        if ($order_id) {
            update_post_meta($order_id, '_order_website_id', $website_id);
            update_post_meta($order_id, '_order_package', $selected_package);
            update_post_meta($order_id, '_order_form_data', $sanitized_form_data);
            update_post_meta($order_id, '_order_selected_extras', $selected_extras);
            update_post_meta($order_id, '_order_total_price', $total_price);

            // Send email notification
            $this->send_order_notification($order_id, $website, $selected_package, $sanitized_form_data, $selected_extras, $total_price);

            wp_send_json_success([
                'message' => __('Bestelling succesvol geplaatst! We nemen zo snel mogelijk contact met u op.', 'aanbod-websites'),
            ]);
        } else {
            wp_send_json_error(['message' => __('Er is een fout opgetreden bij het plaatsen van de bestelling.', 'aanbod-websites')]);
        }
    }

    private function send_order_notification($order_id, $website, $package, $form_data, $selected_extras, $total_price) {
        $admin_email = get_option('admin_email');
        $subject = sprintf(__('Nieuwe Website Bestelling - %s', 'aanbod-websites'), $website->post_title);

        $message = sprintf(__('Er is een nieuwe bestelling geplaatst voor: %s', 'aanbod-websites'), $website->post_title) . "\n\n";

        $message .= "======================\n";
        $message .= __('Gekozen Pakket', 'aanbod-websites') . "\n";
        $message .= "======================\n\n";
        $message .= $package['name'] . ": €" . number_format((float)$package['price'], 2, ',', '.') . "\n\n";

        $message .= "======================\n";
        $message .= __('Klantgegevens', 'aanbod-websites') . "\n";
        $message .= "======================\n\n";

        foreach ($form_data as $key => $value) {
            $message .= ucfirst(str_replace('_', ' ', $key)) . ": " . $value . "\n";
        }

        if (!empty($selected_extras)) {
            $message .= "\n======================\n";
            $message .= __('Geselecteerde Extra Opties', 'aanbod-websites') . "\n";
            $message .= "======================\n\n";

            foreach ($selected_extras as $extra) {
                $message .= $extra['name'] . ": €" . number_format((float)$extra['price'], 2, ',', '.') . "\n";
            }
        }

        $message .= "\n======================\n";
        $message .= __('Totaalprijs', 'aanbod-websites') . ": €" . number_format($total_price, 2, ',', '.') . "\n";
        $message .= "======================\n\n";

        $message .= sprintf(__('Bekijk de bestelling in WordPress: %s', 'aanbod-websites'), admin_url('post.php?post=' . $order_id . '&action=edit'));

        wp_mail($admin_email, $subject, $message);

        // Send confirmation to customer if email field exists
        if (isset($form_data['email']) || isset($form_data['e_mail'])) {
            $customer_email = $form_data['email'] ?? $form_data['e_mail'] ?? '';
            if (is_email($customer_email)) {
                $customer_subject = __('Bedankt voor uw bestelling', 'aanbod-websites');
                $customer_message = __('Bedankt voor uw interesse in onze website. We hebben uw bestelling ontvangen en nemen zo snel mogelijk contact met u op.', 'aanbod-websites') . "\n\n";
                $customer_message .= sprintf(__('Website: %s', 'aanbod-websites'), $website->post_title) . "\n";
                $customer_message .= sprintf(__('Totaalprijs: €%s', 'aanbod-websites'), number_format($total_price, 2, ',', '.'));

                wp_mail($customer_email, $customer_subject, $customer_message);
            }
        }
    }

    public function handle_set_selected_website() {
        $website_id = isset($_POST['website_id']) ? intval($_POST['website_id']) : 0;

        if (!$website_id || get_post_type($website_id) !== 'website') {
            wp_send_json_error(['message' => __('Ongeldige website.', 'aanbod-websites')]);
        }

        $_SESSION['selected_website_id'] = $website_id;

        $checkout_url = home_url('/checkout/');
        wp_send_json_success(['checkout_url' => $checkout_url]);
    }

    public function handle_set_selected_website_and_package() {
        $website_id = isset($_POST['website_id']) ? intval($_POST['website_id']) : 0;
        $package_index = isset($_POST['package_index']) ? intval($_POST['package_index']) : -1;

        if (!$website_id || get_post_type($website_id) !== 'website') {
            wp_send_json_error(['message' => __('Ongeldige website.', 'aanbod-websites')]);
        }

        // Validate package
        $packages = get_option('website_packages', []);
        if ($package_index < 0 || !isset($packages[$package_index])) {
            wp_send_json_error(['message' => __('Ongeldig pakket.', 'aanbod-websites')]);
        }

        $_SESSION['selected_website_id'] = $website_id;
        $_SESSION['selected_package_index'] = $package_index;

        $checkout_url = home_url('/checkout/');
        wp_send_json_success(['checkout_url' => $checkout_url]);
    }

    public function handle_clear_selected_website() {
        unset($_SESSION['selected_website_id']);
        unset($_SESSION['selected_package_index']);
        wp_send_json_success(['message' => __('Website verwijderd.', 'aanbod-websites')]);
    }

    public function handle_get_website_id_by_slug() {
        $slug = isset($_POST['slug']) ? sanitize_title($_POST['slug']) : '';

        if (!$slug) {
            wp_send_json_error(['message' => __('Geen slug opgegeven.', 'aanbod-websites')]);
        }

        $post = get_page_by_path($slug, OBJECT, 'website');

        if ($post && $post->post_type === 'website') {
            wp_send_json_success(['id' => $post->ID]);
        } else {
            wp_send_json_error(['message' => __('Website niet gevonden.', 'aanbod-websites')]);
        }
    }
}

// Initialize plugin
Aanbod_Websites::get_instance();
