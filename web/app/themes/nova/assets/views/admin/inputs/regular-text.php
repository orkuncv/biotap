<?php
/**
 * Admin Regular Text Input
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

$id          = $id ?? '';
$name        = $name ?? '';
$label       = $label ?? '';
$value       = $value ?? '';
$placeholder = $placeholder ?? ''; ?>

<div class="nova-form-group">
    <label for="<?php echo $id ?>"><?php esc_html_e( $label, 'nova' ); ?></label>
    <input type="text" id="<?php echo $id ?>" name="<?php echo $name ?>" value="<?php echo esc_attr( $value ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" class="regular-text"/>
</div>
