<?php
/**
 * Nova_Admin_Theme_Create_Child Class.
 * This class handles the admin page for creating a child theme.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! class_exists( 'Nova_Admin_Theme_Create_Child' ) ) :

	class Nova_Admin_Theme_Create_Child {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
		}

		/**
		 * Add the menu page.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_menu_page(): void {
			add_submenu_page(
				'nova-theme-settings',
				__( 'Nova Child Theme', 'nova' ),
				__( 'Create Child Theme', 'nova' ),
				'manage_options',
				'nova-child-theme-create',
				[ $this, 'install_or_redirect' ]
			);
		}

		/**
		 * Install the child theme or redirect to the theme settings page.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function install_or_redirect(): void {
			// Show the loader
			echo '<script>if(typeof Nova !== "undefined" && Nova.State && Nova.State.loader) { Nova.State.loader.show(); }</script>';

			if ( get_stylesheet() === get_template() ) {
				if ( ! nova_has_child_theme_installed() ) {
					// Create child theme using the static method
					$success = Nova_Console_Create_Child_Theme::create_from_admin();

					if ( ! $success ) {
						echo '<script>alert("Child theme creation failed. Please check permissions.");</script>';
						echo '<script>window.location = "' . admin_url( 'admin.php?page=nova-theme-settings' ) . '";</script>';
						return;
					}
				}

				// Due to header already sent, we need to use JavaScript to redirect
				echo '<script>window.location = "' . admin_url( 'themes.php' ) . '";</script>';
			} else {
				// Due to header already sent, we need to use JavaScript to redirect
				echo '<script>window.location = "' . admin_url( 'admin.php?page=nova-theme-settings' ) . '";</script>';
			}
		}
	}

endif;
