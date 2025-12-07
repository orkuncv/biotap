<?php
/**
 * Admin Theme Settings Form
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

$gtm_id             = $gtm_id ?? '';
$youtube            = $youtube ?? '';
$linkedin           = $linkedin ?? '';
$facebook           = $facebook ?? '';
$instagram          = $instagram ?? '';
$header_logo        = $header_logo ?? '';
$footer_logo        = $footer_logo ?? '';
$header_logo_size   = $header_logo_size ?? 'medium';
$footer_logo_size   = $footer_logo_size ?? 'medium';
$cookiebot_script   = $cookiebot_script ?? ''; ?>

<form id="nova-theme-settings-form-left" class="nova-theme-settings-form" enctype="multipart/form-data">

    <!-- Nonce -->
	<?php wp_nonce_field( 'save_theme_settings_nonce', 'theme_settings_nonce' ); ?>

    <!-- Header Logo -->
	<?php echo nova_get_admin_template( 'inputs/upload-image', [
		'id'    => 'nova_theme_header_logo',
		'name'  => 'nova_theme_header_logo',
		'label' => __( 'Header Logo', 'nova' ),
		'value' => $header_logo,
	] ); ?>

    <!-- Header Logo Size -->
	<?php echo nova_get_admin_template( 'inputs/regular-select', [
		'id'          => 'nova_theme_header_logo_size',
		'name'        => 'nova_theme_header_logo_size',
		'label'       => __( 'Header Logo Grootte', 'nova' ),
		'value'       => $header_logo_size,
		'description' => __( 'Kies de grootte van het header logo', 'nova' ),
		'options'     => [
			'small'  => __( 'Klein (48px)', 'nova' ),
			'medium' => __( 'Gemiddeld (72px)', 'nova' ),
			'large'  => __( 'Groot (96px)', 'nova' ),
		],
	] ); ?>

    <!-- Footer Logo -->
	<?php echo nova_get_admin_template( 'inputs/upload-image', [
		'id'    => 'nova_theme_footer_logo',
		'name'  => 'nova_theme_footer_logo',
		'label' => __( 'Footer Logo', 'nova' ),
		'value' => $footer_logo,
	] ); ?>

    <!-- Footer Logo Size -->
	<?php echo nova_get_admin_template( 'inputs/regular-select', [
		'id'          => 'nova_theme_footer_logo_size',
		'name'        => 'nova_theme_footer_logo_size',
		'label'       => __( 'Footer Logo Grootte', 'nova' ),
		'value'       => $footer_logo_size,
		'description' => __( 'Kies de grootte van het footer logo', 'nova' ),
		'options'     => [
			'small'  => __( 'Klein (56px)', 'nova' ),
			'medium' => __( 'Gemiddeld (76px)', 'nova' ),
			'large'  => __( 'Groot (96px)', 'nova' ),
		],
	] ); ?>

    <!-- Spacer -->
	<?php echo nova_get_admin_template( 'inputs/spacer'); ?>

    <!-- Facebook -->
	<?php echo nova_get_admin_template( 'inputs/regular-text', [
		'id'    => 'nova_theme_facebook',
        'name'  => 'nova_theme_facebook',
        'label' => __( 'Facebook', 'nova' ),
        'value' => $facebook,
    ] ); ?>

    <!-- Instagram -->
    <?php echo nova_get_admin_template( 'inputs/regular-text', [
        'id'    => 'nova_theme_instagram',
        'name'  => 'nova_theme_instagram',
        'label' => __( 'Instagram', 'nova' ),
        'value' => $instagram,
    ] ); ?>

    <!-- LinkedIn -->
    <?php echo nova_get_admin_template( 'inputs/regular-text', [
        'id'    => 'nova_theme_linkedin',
        'name'  => 'nova_theme_linkedin',
        'label' => __( 'LinkedIn', 'nova' ),
        'value' => $linkedin,
    ] ); ?>

    <!-- YouTube -->
    <?php echo nova_get_admin_template( 'inputs/regular-text', [
        'id'    => 'nova_theme_youtube',
        'name'  => 'nova_theme_youtube',
        'label' => __( 'YouTube', 'nova' ),
        'value' => $youtube,
    ] ); ?>

    <!-- Spacer -->
	<?php echo nova_get_admin_template( 'inputs/spacer'); ?>

    <!-- Google Tag Manager -->
	<?php echo nova_get_admin_template( 'inputs/regular-text', [
		'id'    => 'nova_theme_gtm_id',
		'name'  => 'nova_theme_gtm_id',
		'label' => __( 'Google Tag Manager Id', 'nova' ),
		'value' => $gtm_id,
	] ); ?>

    <!-- Cookiebot Script -->
	<?php echo nova_get_admin_template( 'inputs/regular-text', [
		'id'    => 'nova_theme_cookiebot_script',
		'name'  => 'nova_theme_cookiebot_script',
		'label' => __( 'CookieBot Script Id', 'nova' ),
		'value' => $cookiebot_script,
	] ); ?>

    <!-- Spacer -->
	<?php echo nova_get_admin_template( 'inputs/spacer'); ?>

    <!-- Save Button -->
	<?php submit_button( __( 'Instellingen Opslaan', 'nova' ) ); ?>
</form>
