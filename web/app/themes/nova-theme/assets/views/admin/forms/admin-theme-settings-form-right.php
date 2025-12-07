<?php
/**
 * Admin Theme Settings Form - Right (Developer Settings)
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

if ( ! defined( 'NOVA_INIT' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

$parent_patterns_enabled = $parent_patterns_enabled ?? '';
$disable_default_post_types = $disable_default_post_types ?? '';
$disallow_file_edit = $disallow_file_edit ?? '';
?>

<form id="nova-theme-settings-form-right" class="nova-theme-settings-form" enctype="multipart/form-data">

    <!-- Nonce -->
	<?php wp_nonce_field( 'save_theme_settings_nonce', 'theme_settings_nonce' ); ?>

	<?php if ( nova( 'user.role' )->is( 'developer' ) ): ?>

        <!-- Title -->
        <h2><?php esc_html_e( 'Developer Instellingen', 'nova' ); ?></h2>
        <p class="description"><?php esc_html_e( 'Deze instellingen zijn alleen zichtbaar voor developers.', 'nova' ); ?></p>

        <!-- Spacer -->
		<?php echo nova_get_admin_template( 'inputs/spacer'); ?>

        <!-- Parent patterns -->
		<?php echo nova_get_admin_template( 'inputs/regular-toggle', [
			'id'          => 'nova_theme_parent_patterns_enabled',
			'name'        => 'nova_theme_parent_patterns_enabled',
			'label'       => __( 'Parent theme patronen', 'nova' ),
			'value'       => $parent_patterns_enabled,
			'description' => __( 'Activeer de patronen uit de parent theme.', 'nova'),
		] ); ?>

        <!-- Disable default post types -->
		<?php echo nova_get_admin_template( 'inputs/regular-toggle', [
			'id'          => 'nova_theme_disable_default_post_types',
			'name'        => 'nova_theme_disable_default_post_types',
			'label'       => __( 'Verwijder standaard "Posts"', 'nova' ),
			'value'       => $disable_default_post_types,
			'description' => __( 'Verwijder de standaard "Posts" post type uit de admin en frontend.', 'nova' ),
		] ); ?>

        <!-- Disallow file edit -->
		<?php echo nova_get_admin_template( 'inputs/regular-toggle', [
			'id'          => 'nova_theme_disallow_file_edit',
			'name'        => 'nova_theme_disallow_file_edit',
			'label'       => __( 'Upload Mogelijkheden', 'nova' ),
			'value'       => $disallow_file_edit,
			'description' => __( 'Verwijder de mogelijkheid om plugins en thema\'s te uploaden via de admin.', 'nova' ),
		] ); ?>

	<?php else: ?>

        <!-- Message for non-developers -->
        <div class="notice notice-info inline">
            <p><?php esc_html_e( 'Developer instellingen zijn alleen zichtbaar voor gebruikers met de Developer role.', 'nova' ); ?></p>
        </div>

	<?php endif; ?>

    <!-- Spacer -->
	<?php echo nova_get_admin_template( 'inputs/spacer'); ?>

    <!-- Save Button -->
	<?php submit_button( __( 'Instellingen Opslaan', 'nova' ) ); ?>
</form>
