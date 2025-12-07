<?php
/**
 * Admin Theme Settings Page
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

$options            = $options ?? [];
$form_right_title   = __( 'Developer Instellingen', 'nova' );
$form_right_tooltip = __( 'Hier kun je de ontwikkelaarsinstellingen van het thema beheren. Deze instellingen zijn alleen zichtbaar voor ontwikkelaars.', 'nova' );
?>

    <div class="wrap nova-theme-settings-wrap">

		<?php echo nova_get_admin_template( 'partials/admin-theme-title', [
            'title'  => __( 'Nova Thema', 'nova' ),
            'active' => 'settings',
        ] ); ?>

        <div class="nova-inner">

            <div class="nova-main">

				<?php echo nova_get_admin_template( 'partials/admin-theme-notification' ); ?>

                <div class="nova-card nova-card-md">

					<?php echo nova_get_admin_template( 'partials/admin-theme-header', [
                        'icon'    => 'settings',
                        'title'   => __( 'Thema Instellingen', 'nova' ),
                        'tooltip' => __( 'Hier kun je de instellingen van het thema configureren. Dit omvat onder andere visuele elementen van het thema.', 'nova' ),
                    ] ); ?>

                    <div class="nova-card-body">

						<?php echo nova_get_admin_template( 'forms/admin-theme-settings-form-left', $options ); ?>

                    </div>

                </div>

                <div class="nova-card nova-card-md">

		            <?php echo nova_get_admin_template( 'partials/admin-theme-header', [
                        'icon'    => 'key',
                        'title'   => $form_right_title,
                        'tooltip' => $form_right_tooltip,
                    ] ); ?>

                    <div class="nova-card-body">

			            <?php echo nova_get_admin_template( 'forms/admin-theme-settings-form-right', $options ); ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php echo nova_get_admin_template( 'partials/admin-theme-loader' ); ?>
