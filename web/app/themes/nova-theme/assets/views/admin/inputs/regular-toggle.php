<?php
/**
 * Admin Theme Page
 *
 * @author  Accent - https://accentinteractive.nl
 * @package Nova
 * @since   1.0.0
 */

if ( ! defined( 'NOVA_INIT' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

$id          = $id ?? '';
$name        = $name ?? '';
$label       = $label ?? '';
$value       = $value ?? ''; // Expected to be '1' for checked, '0' or '' for unchecked
$description = $description ?? '';
?>

<div class="nova-form-group">
	<label class="nova-toggle" for="<?php echo esc_attr( $id ); ?>">
        <input class="nova-toggle-checkbox" type="checkbox" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="1" <?php checked( '1', $value ); ?> />
        <span class="nova-toggle-switch"></span>
        <span class="nova-toggle-label">
            <span><?php esc_html_e( $label, 'nova.admin' ); ?></span>
            <span><?php esc_html_e( $description, 'nova.admin' ); ?></span>
        </span>
	</label>
</div>