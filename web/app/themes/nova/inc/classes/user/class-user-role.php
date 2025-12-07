<?php
/**
 * Nova_User_Role Class
 * Handles a separate custom user role functionality.
 * Custom roles (e.g., 'developer') are stored as user meta and displayed on the
 * user profile page. This does not affect the built-in WordPress roles.
 * API example:
 *   if ( nova()->call( 'user.role', 'is', 'developer' ) ) {
 *       // The current user's custom role is developer.
 *   }
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

declare( strict_types=1 );

if ( ! class_exists( 'Nova_User_Role' ) ) :

	class Nova_User_Role {

		/**
		 * The username that is accepted for custom roles.
		 * This is used to check if the current user has this username.
		 *
		 * @since 1.0.0
		 */
		const ACCEPTED_USERNAME = 'supportocn';

		/**
		 * Array of custom roles.
		 * Format: [ 'role_slug' => 'Display Name', ... ]
		 *
		 * @var array
		 * @since 1.0.0
		 */
		protected array $roles = [];

		/**
		 * Meta key used for storing the custom role.
		 *
		 * @var string
		 * @since 1.0.0
		 */
		protected string $meta_key = 'nova_custom_role';

		/**
		 * Constructor.
		 * Registers default custom roles and adds admin hooks to display and save
		 * the custom role on the user profile page.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->add_custom_role( 'developer', 'Developer' );

			if ( is_admin() ) {
				add_action( 'show_user_profile', [ $this, 'display_custom_role_field' ] );
				add_action( 'edit_user_profile', [ $this, 'display_custom_role_field' ] );
				add_action( 'personal_options_update', [ $this, 'save_custom_role_field' ] );
				add_action( 'edit_user_profile_update', [ $this, 'save_custom_role_field' ] );
			}
		}

		/**
		 * Register a new custom role.
		 * This does not override WordPress's native roles—it merely defines a list
		 * of custom roles for this separate functionality.
		 *
		 * @param string $slug The role slug (e.g., 'developer').
		 * @param string $display_name The display name for the role.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_custom_role( string $slug, string $display_name ): void {
			$this->roles[ $slug ] = $display_name;
		}

		/**
		 * Check if the current user's custom role matches a given role.
		 * Example usage:
		 *   if ( nova()->call( 'user.role', 'is', 'developer' ) ) { ... }
		 *   if ( nova('user.role')->is( 'developer' ) ) { ... }
		 *
		 * @param string $role_slug The desired custom role slug.
		 *
		 * @return bool True if the current user's custom role matches; false otherwise.
		 * @since 1.0.0
		 */
		public function is( string $role_slug ): bool {
			$current_user = wp_get_current_user();
			if ( ! $current_user || ! $current_user->ID ) {
				return false;
			}
			$user_custom_role = get_user_meta( $current_user->ID, $this->meta_key, true );

			return $user_custom_role === $role_slug;
		}

		/**
		 * Check if the current user's custom role matches any of the given roles.
		 * Example usage:
		 *   if ( nova()->call( 'user.role', 'can', [ 'developer', 'editor' ] ) ) { ... }
		 *   if ( nova('user.role')->can( [ 'developer', 'editor' ] ) ) { ... }
		 *
		 * @param array $permissions An array of custom role slugs to check against.
		 *
		 * @return bool True if the current user's custom role matches any of the given roles; false otherwise.
		 * @since 1.0.0
		 */
		public function can( array $permissions ): bool {
			$current_user = wp_get_current_user();
			if ( ! $current_user || ! $current_user->ID ) {
				return false;
			}
			$user_custom_role = get_user_meta( $current_user->ID, $this->meta_key, true );

			return in_array( $user_custom_role, $permissions, true );
		}

		/**
		 * Display the custom role selection field on the user profile page.
		 *
		 * @param WP_User $user The user object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function display_custom_role_field( WP_User $user ): void {
			$current_user = wp_get_current_user();
			if ( ! $current_user || ! $current_user->ID || $current_user->user_login !== self::ACCEPTED_USERNAME ) {
				return;
			}

			if ( ! current_user_can( 'edit_users' ) ) {
				return;
			}

			$user_custom_role = get_user_meta( $user->ID, $this->meta_key, true );
			?>
			<h3><?php esc_html_e( 'Nova Theme User Role', 'nova' ); ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label for="nova_custom_role"><?php esc_html_e( 'Nova Theme Role', 'nova' ); ?></label>
					</th>
					<td>
						<select name="nova_custom_role" id="nova_custom_role">
							<option value=""><?php esc_html_e( 'None', 'nova' ); ?></option>
							<?php foreach ( $this->roles as $slug => $name ) : ?>
								<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $user_custom_role, $slug ); ?>>
									<?php echo esc_html( $name ); ?>
								</option>
							<?php endforeach; ?>
						</select>
						<p class="description">
							<?php esc_html_e( "Select the user's role for the Nova theme.", 'nova' ); ?>
						</p>
					</td>
				</tr>
			</table>
			<?php
		}

		/**
		 * Save the custom role selection when the user profile is updated.
		 *
		 * @param int $user_id The ID of the user being updated.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function save_custom_role_field( int $user_id ): void {
			if ( ! current_user_can( 'edit_user', $user_id ) ) {
				return;
			}

			if ( isset( $_POST['nova_custom_role'] ) ) {
				$role = sanitize_text_field( wp_unslash( $_POST['nova_custom_role'] ) );
				if ( '' === $role || array_key_exists( $role, $this->roles ) ) {
					update_user_meta( $user_id, $this->meta_key, $role );
				}
			}
		}
	}

endif;
