<?php
/**
 * Admin Form Spacer
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

$title = $title ?? ''; ?>

<div class="nova-form-spacer"
     <?php if ( ! empty( $title ) ) : ?>
     id="<?php echo strtolower( str_replace( ' ', '-',  $title ) ); ?>"
     <?php endif; ?>
></div>

<?php if ( ! empty( $title ) ) : ?>
    <h3 class="nova-form-spacer-title">
        <?php esc_html_e( $title, 'nova' ); ?>
    </h3>
<?php endif; ?>
