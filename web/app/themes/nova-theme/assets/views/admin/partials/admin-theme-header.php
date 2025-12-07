<?php
/**
 * Admin Theme Header
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

$icon    = $icon ?? null;
$title   = $title ?? '';
$tooltip = $tooltip ?? null;

if ( nova_is_child_theme_active() ) {
	$title = str_replace( 'Nova', 'Nova Child', $title );
} ?>

<div class="nova-card-header">
    <h2>
        <?php if( isset( $icon ) ): echo '<span>' . get_svg( $icon ) . '</span>'; endif; ?>
        <?php echo $title; ?>
        <?php if( isset( $tooltip ) ): ?>
            <span class="tooltip">
                <?php echo $tooltip; ?>
                <span class="tooltip-arrow"></span>
            </span>
            <?php echo get_svg('question' ); ?>
        <?php endif; ?>
    </h2>
</div>
