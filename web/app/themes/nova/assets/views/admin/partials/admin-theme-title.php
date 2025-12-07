<?php
/**
 * Admin Theme Title
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

$slot    = $slot ?? '';
$title   = $title ?? '';
$active  = $active ?? null;

if ( nova_is_child_theme_active() ) {
	$title = str_replace( 'Nova', 'Nova Child', $title );
} ?>

<header class="nova-header">
    <div class="nova-header-inner">
        <div class="nova-header-button-links">
	        <?php echo get_svg('nova_theme_icon_color'); ?>
	        <?php echo nova_get_admin_template( 'partials/admin-theme-sidebar', [
                'active' => $active,
            ] ); ?>
        </div>
        <div class="nova-header-logo">
            <span style="font-weight: 700; font-size: 20px; color: #ffffff;">Movve</span>
        </div>
    </div>
</header>

<div class="nova-topbar">
    <div class="nova-topbar-inner">
        <h1><?php echo $title ?></h1>
        <?php echo $slot; ?>
    </div>
</div>
