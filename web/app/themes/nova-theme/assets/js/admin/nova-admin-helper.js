/**
 * Nova Admin Panel - Helper Functions
 *
 * Global helper functions and utilities for the Nova admin interface.
 *
 * @package Nova
 * @since   1.0.0
 * @author  Movve - https://movve.nl
 */
(function ($) {
    'use strict';

    // Create Nova global object
    window.Nova = window.Nova || {};
    window.Nova.Helper = window.Nova.Helper || {};
    window.Nova.State = window.Nova.State || {};
    window.Nova.Element = window.Nova.Element || {};

    /**
     * Prefetch link on mouseenter
     */
    Nova.Helper.prefetch = function(link) {
        if (!link || !link.href) return;
        const $link = $('<link>', {
            rel: 'prefetch',
            href: link.href
        });
        $('head').append($link);
    };

    /**
     * Show/hide loader
     */
    Nova.State.loader = {
        show: function() {
            $('#nova-loader').fadeIn(200);
        },
        hide: function(delay = 0) {
            setTimeout(function() {
                $('#nova-loader').fadeOut(200);
            }, delay);
        }
    };

    /**
     * Dismiss button HTML
     */
    Nova.Element.notice = Nova.Element.notice || {};
    Nova.Element.notice.dismiss = '<button type="button" onclick="this.parentElement.remove()" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';

    /**
     * Show notification
     * @param {string} message The message content (HTML allowed)
     * @param {string} type The type of notice ('success', 'error', 'warning', 'info')
     * @param {string|null} button Optional HTML string for an additional button or action link
     */
    Nova.Element.notice.show = function(message, type = 'success', button = null) {
        requestAnimationFrame(function() {
            const noticeContainer = document.getElementById('nova-settings-message');

            if (!noticeContainer) {
                console.warn('Nova.Element.notice.show: Container #nova-settings-message not found.');
                alert(type + ': ' + message.replace(/<[^>]*>/g, ''));
                return;
            }

            // Map type to WordPress notice classes
            const typeMap = {
                'success': 'updated',
                'error': 'error',
                'warning': 'warning',
                'info': 'info'
            };
            const noticeType = typeMap[type] || 'updated';

            const notice = document.createElement('div');
            notice.classList.add('notice', 'is-dismissible', 'notice-' + noticeType);
            notice.innerHTML = '<p>' + message + '</p>' + Nova.Element.notice.dismiss;

            if (button) {
                const p = notice.querySelector('p');
                if (p) {
                    p.insertAdjacentHTML('afterend', button);
                } else {
                    notice.insertAdjacentHTML('beforeend', button);
                }
            }

            noticeContainer.appendChild(notice);
        });
    };

})(jQuery);
