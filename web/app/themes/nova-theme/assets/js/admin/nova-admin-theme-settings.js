/**
 * Nova Admin Panel - Theme Settings
 *
 * Handles the AJAX submission for the main Theme Settings form.
 *
 * @package Nova
 * @since   1.0.0
 * @author  Movve - https://movve.nl
 *
 * @requires {object} jQuery
 * @requires {object} Nova - Global Nova object (loaded via nova-admin-helper.js)
 * @requires {object} novaThemeSettings - Localized data object containing `ajaxurl` and `nonce`.
 */
(function ($) {
    'use strict';

    $(function () {
        const $forms = $('.nova-theme-settings-form');
        if (!$forms.length) return;

        if (typeof Nova === 'undefined' || !Nova.State || !Nova.Element) {
            console.error('Nova object ontbreekt.');
            alert('Critical Error: UI-componenten ontbreken. Kan instellingen niet opslaan.');
            return;
        }

        if (!window.novaThemeSettings || !novaThemeSettings.nonce || !novaThemeSettings.ajaxurl) {
            console.error('Localized data (novaThemeSettings) ontbreekt.');
            Nova.Element.notice.show(
                'Configuratiefout: kan instellingen niet opslaan. Neem contact op met de beheerder.',
                'error'
            );
            $forms.find('button[type="submit"], input[type="submit"]').prop('disabled', true);
            return;
        }

        $(document).on('submit', '.nova-theme-settings-form', function (e) {
            e.preventDefault();
            const $form = $(this);
            Nova.State.loader.show();

            // Basis-payload
            const data = {
                action: 'save_theme_settings',
                nonce : novaThemeSettings.nonce,
            };

            novaThemeSettings.fields.forEach(function (field) {
                const $input = $form.find(`#${field}`);
                if (!$input.length) return;

                if ($input.is(':checkbox')) {
                    data[field] = $input.is(':checked') ? '1' : '0';
                } else {
                    data[field] = $input.val();
                }
            });

            console.log('Nova Theme Settings Data:', data);

            $.post(novaThemeSettings.ajaxurl, data)
                .done(function (response) {
                    if (response.success) {
                        Nova.Element.notice.show(
                            response.data.message || 'Thema-instellingen opgeslagen.',
                            'success'
                        );
                    } else {
                        Nova.Element.notice.show(
                            response.data.message || 'Er ging iets mis bij het opslaan van de instellingen.',
                            'error'
                        );
                    }
                })
                .fail(function (jqXHR, textStatus) {
                    Nova.Element.notice.show(`Er ging iets mis: ${textStatus}`, 'error');
                    console.error('Nova Theme Settings Save Error:', jqXHR);
                })
                .always(function () {
                    Nova.State.loader.hide(300);
                    $('html, body').animate({ scrollTop: 0 }, 300);
                });
        });
    });
})(jQuery);
