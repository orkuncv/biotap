<?php
/**
 * Admin Theme Notification
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

if ( ! defined( 'NOVA_INIT' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
} ?>

<div id="nova-settings-message">
    <!-- Notification message will be displayed here -->

	<?php
	// Check if the current theme is not a child theme (i.e. using the parent theme directly)
	if ( get_stylesheet() === get_template() ) : ?>

        <script>
            setTimeout(function () {
                Nova.Element.notice.show(
					<?php if ( ! nova_has_child_theme_installed() ) : ?>
                    '<b>Nova Child Theme:</b> <?php esc_html_e( 'Je maakt op dit moment gebruik van het parent-theme. Maak een child-theme aan om toekomstige updates te kunnen installeren.', 'nova' ); ?>',
                    'error',
                    '<a id="nova-create-child-theme-btn" href="<?php echo esc_url( admin_url( 'admin.php?page=nova-child-theme-create' ) ); ?>"><?php esc_html_e( 'Installeer Nova Child Theme', 'nova' ); ?></a>'
				<?php else : ?>
                    '<b>Nova Child Theme:</b> <?php esc_html_e( 'Je maakt op dit moment gebruik van het parent-theme. Activeer het child-thema om je website te beschermen tegen toekomstige updates.', 'nova' ); ?>',
                    'error',
                    '<a id="nova-create-child-theme-btn" href="<?php echo esc_url( admin_url( 'themes.php' ) ); ?>"><?php esc_html_e( 'Activeer Nova Child Theme', 'nova' ); ?></a>'
				<?php endif; ?>
                );
            }, 100);
        </script>
	<?php endif; ?>
</div>
