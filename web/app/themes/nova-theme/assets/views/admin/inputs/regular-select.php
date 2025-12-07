<?php
/**
 * Admin Theme Settings Select Input
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
$options     = $options ?? [];
$description = $description ?? '';
?>

<div class="nova-form-group">
    <label for="<?php echo esc_attr( $id ); ?>" class="nova-form-label">
		<?php echo esc_html( $label ); ?>
    </label>
	<?php if ( ! empty( $description ) ): ?>
        <p class="nova-form-description"><?php echo esc_html( $description ); ?></p>
	<?php endif; ?>
    <select
            id="<?php echo esc_attr( $id ); ?>"
            name="<?php echo esc_attr( $name ); ?>"
            class="nova-form-input nova-form-select"
    >
		<?php foreach ( $options as $option_value => $option_label ): ?>
            <option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $value, $option_value ); ?>>
				<?php echo esc_html( $option_label ); ?>
            </option>
		<?php endforeach; ?>
    </select>
</div>
