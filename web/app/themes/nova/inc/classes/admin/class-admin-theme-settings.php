<?php
/**
 * Nova Admin Theme Settings
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! class_exists( 'Nova_Admin_Theme_Settings' ) ):

	class Nova_Admin_Theme_Settings {

		/**
		 * Settings page inputs
		 *
		 * @var array
		 * @since 1.0.0
		 */
		const SETTINGS_PAGE_INPUTS = [
			'nova_theme_gtm_id',
			'nova_theme_youtube',
			'nova_theme_linkedin',
			'nova_theme_facebook',
			'nova_theme_instagram',
			'nova_theme_header_logo',
			'nova_theme_footer_logo',
		    'nova_theme_header_logo_size',
		    'nova_theme_footer_logo_size',
			'nova_theme_cookiebot_script',
		'nova_theme_parent_patterns_enabled',
		'nova_theme_disable_default_post_types',
		'nova_theme_disallow_file_edit',
		];

		/**
		 * Nova_Admin_Theme_Settings constructor.
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

			add_action( 'wp_ajax_save_theme_settings', [ $this, 'ajax_save_settings' ] );
			add_action( 'wp_ajax_nova_upload_file', [ $this, 'upload_file' ] );
			add_action( 'wp_ajax_nova_remove_file', [ $this, 'remove_file' ] );

			add_filter( 'custom_menu_order', '__return_true' );
			add_filter( 'menu_order', [ $this, 'custom_admin_menu_order' ] );
		}

		/**
		 * Custom admin menu order
		 *
		 * @param array|bool $menu_order
		 *
		 * @return array|bool
		 * @since 1.0.0
		 */
		public function custom_admin_menu_order( array|bool $menu_order ): array|bool {
			if ( ! $menu_order ) {
				return true;
			}

			// Move 'index.php' to the top
			// Move 'nova-theme-settings' as second item
			// Move 'separator1' as third item
			// Move 'site-editor.php' as fourth item
			$menu_order = array_diff( $menu_order, [
				'index.php',
				'nova-theme-settings',
				'separator1',
				'site-editor.php',
			] );

			return array_merge( [ 'index.php', 'nova-theme-settings', 'separator1', 'site-editor.php' ], $menu_order );
		}

		/**
		 * Add admin menu
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_admin_menu(): void {
			remove_submenu_page( 'themes.php', 'site-editor.php' );

			add_menu_page(
				__( 'Nova', 'nova' ),
				__( 'Nova', 'nova' ),
				'manage_options',
				'nova-theme-settings',
				[ $this, 'create_admin_page' ],
				get_template_directory_uri() . '/assets/svg/nova_theme_icon.svg',
			);

			add_menu_page(
				__( 'Site-editor', 'nova' ),
				__( 'Site-editor', 'nova' ),
				'edit_theme_options',
				'site-editor.php',
				'',
				'dashicons-admin-appearance',
				61
			);
		}

		/**
		 * Create admin page
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function create_admin_page(): void {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$options = [];
			foreach ( self::SETTINGS_PAGE_INPUTS as $input ) {
				$options[ str_replace('nova_theme_', '', $input) ] = get_option( $input, '' );
			}

			echo nova_get_admin_template( 'admin-theme-settings-page', [
				'options' => $options,
			] );
		}

		/**
		 * Enqueue scripts
		 *
		 * @param $hook
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function enqueue_scripts( $hook ): void {
			wp_enqueue_script(
				'nova-admin-helper',
				get_template_directory_uri() . '/assets/js/admin/nova-admin-helper.js',
				[ 'jquery' ],
				NOVA_THEME_VERSION,
				true
			);

			// From here we only want to load the scripts on the theme settings page
			if ( $hook !== 'toplevel_page_nova-theme-settings' ) {
				return;
			}

			add_filter( 'should_load_separate_core_block_assets', '__return_true' );

			wp_enqueue_script(
				'nova-upload-image',
				get_template_directory_uri() . '/assets/js/admin/nova-upload-image.js',
				[ 'jquery' ],
				NOVA_THEME_VERSION,
				true
			);

			wp_enqueue_script(
				'nova-theme-settings',
				get_template_directory_uri() . '/assets/js/admin/nova-admin-theme-settings.js',
				[ 'jquery' ],
				NOVA_THEME_VERSION,
				true
			);

			wp_enqueue_style(
				'nova-theme-settings-admin',
				get_template_directory_uri() . '/assets/css/admin/nova-admin-styles.css',
				[],
				NOVA_THEME_VERSION
			);

			wp_localize_script( 'nova-theme-settings', 'novaThemeSettings', [
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'save_theme_settings_nonce' ),
				'fields'  => self::SETTINGS_PAGE_INPUTS,
			] );

			wp_localize_script( 'nova-upload-image', 'nova_ajax', [
				'nonce' => wp_create_nonce( 'nova_ajax_nonce' ),
			] );
		}

		/**
		 * Save settings via AJAX
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function ajax_save_settings(): void {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( [ 'message' => __( 'Niet bevoegd', 'nova' ) ] );
			}

			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'save_theme_settings_nonce' ) ) {
				wp_send_json_error( [ 'message' => __( 'Nonce verificatie mislukt', 'nova' ) ] );
			}

			$updated = [];

			foreach ( self::SETTINGS_PAGE_INPUTS as $input ) {
				if ( isset( $_POST[ $input ] ) ) {
					$value         = sanitize_text_field( $_POST[ $input ] ) ?: '';
					$current_value = get_option( $input, '' );
					if ( $current_value === $value ) {
						continue;
					}

					update_option( $input, $value );
					$updated[] = $input;
				}
			}

			wp_send_json_success( [ 'message' => '<b>' . __( 'Succes:', 'nova' ) . '</b> ' . __( 'Instellingen zijn bijgewerkt en opgeslagen.', 'nova' ) ] );
		}

		/**
		 * Upload file via AJAX
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function upload_file(): void {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( [ 'message' => 'Geen permissie' ] );
			}

			if ( ! isset( $_FILES['file'] ) ) {
				wp_send_json_error( [ 'message' => 'Geen bestand ontvangen' ] );
			}

			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';

			$file_id = media_handle_upload( 'file', 0 );

			if ( is_wp_error( $file_id ) ) {
				wp_send_json_error( [ 'message' => 'Upload mislukt' ] );
			}

			$url = wp_get_attachment_url( $file_id );
			update_option( 'nova_uploaded_file', $url );

			wp_send_json_success( [ 'url' => $url, 'filename' => basename( $url ) ] );
		}

		/**
		 * Remove file via AJAX
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function remove_file(): void {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( [ 'message' => 'Geen permissie' ] );
			}

			delete_option( 'nova_uploaded_file' );
			wp_send_json_success();
		}
	}

endif;
