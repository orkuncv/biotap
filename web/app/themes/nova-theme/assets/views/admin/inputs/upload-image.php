<?php
/**
 * Image Upload Field for Header/Footer Logo
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

$id    = $id ?? '';
$name  = $name ?? '';
$label = $label ?? '';
$value = $value ?? '';
?>

<div class="nova-form-group">
    <label for="nova-upload-input" class="nova-dropzone-label">
		<?php esc_html_e( $label, 'nova' ); ?>
    </label>

    <div class="nova-dropzone<?php if ( $value ) : ?> has-image<?php endif; ?>" id="nova-dropzone-<?php echo esc_attr( $id ); ?>">
        <div class="nova-dropzone-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M12 16V4M12 4L8 8M12 4L16 8M20 16C21.1046 16 22 16.8954 22 18V19C22 20.1046 21.1046 21 20 21H4C2.89543 21 2 20.1046 2 19V18C2 16.8954 2.89543 16 4 16H6.5"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                />
            </svg>
        </div>

        <p class="nova-dropzone-text">
			<?php esc_html_e( 'Sleep bestanden hierheen om te uploaden', 'nova' ); ?><br/>
            <span><?php esc_html_e( 'of', 'nova' ); ?><br/></span>
        </p>

        <button type="button" class="nova-dropzone-button" data-input-id="<?php echo esc_attr( $id ); ?>">
			<?php esc_html_e( 'Bladeren', 'nova' ); ?>
        </button>

        <p class="nova-dropzone-support">
			<?php esc_html_e( 'Ondersteunde bestanden: jpg, jpeg, png, gif, svg', 'nova' ); ?><br/>
			<?php esc_html_e( 'Maximale bestandsgrootte: 2MB', 'nova' ); ?>
        </p>

        <input type="file" id="<?php echo $id; ?>_files" name="<?php echo $id; ?>_files[]" multiple hidden/>
        <input class="nova-file-url" type="hidden" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $id ); ?>" value="<?php echo esc_attr( $value ); ?>"/>

        <div class="nova-upload-preview">
			<?php if ( $value ) : ?>
                <p>
                    <a href="<?php echo esc_url( $value ); ?>" target="_blank">
                        <img src="<?php echo esc_url( $value ); ?>" width="150" height="auto" style="display: block; margin-top: 10px; border: 1px solid #ccc;"/>
                    </a>
                </p>
                <button type="button" class="nova-remove-file button-secondary" data-input-id="<?php echo esc_attr( $id ); ?>" title="Remove file">×</button>
			<?php endif; ?>
        </div>
    </div>
</div>
