<?php
/**
 * Admin Theme Sidebar
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

/**
 * Filter the admin sidebar items
 * Expose the sidebar items to be filtered by other plugins or child-themes.
 *
 * @hook nova/admin/sidebar/items
 *
 * @param array $items
 *
 * @return array
 * @since 1.0.0
 */
$items = apply_filters( 'nova/admin/sidebar/items', [
	'settings' => [
		'icon'   => get_svg('settings'),
		'title'  => __( 'Instellingen', 'nova' ),
		'url'    => admin_url( 'admin.php?page=nova-theme-settings' ),
		'active' => false,
	],
] );

$active = $active ?? '';
if ( isset( $items[ $active ] ) ) {
	$items[ $active ]['active'] = true;
} ?>

<?php foreach ( $items as $item ) : ?>

	<?php if ( ! isset( $item['url'] ) || ! isset( $item['icon'] ) || ! isset( $item['title'] ) ) {
		continue;
	} ?>

    <a class="nova-tab nova-header-tab-nova-field-group nova-header-tab <?php echo $item['active'] ? 'nova-active' : ''; ?>"
       href="<?php echo $item['url']; ?>"
       onmouseenter="if(typeof Nova !== 'undefined' && Nova.Helper && Nova.Helper.prefetch) { Nova.Helper.prefetch(this); }"
    >
        <span class="nova-icon"><?php echo $item['icon']; ?></span>
        <span class="nova-title"><?php echo $item['title']; ?></span>
    </a>
<?php endforeach; ?>
