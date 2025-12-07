/**
 * Nova Admin Panel - Dropzone File Upload
 *
 * Initializes custom file upload drop zones used within the theme settings.
 * Handles drag & drop, file selection via button/click, AJAX upload,
 * image/file preview generation, and file removal.
 *
 * @package Nova
 * @since   1.0.0
 * @author  Movve - https://movve.nl
 *
 * @requires {object} jQuery
 * @requires {object} Nova - Global Nova object (loaded via nova-admin-helper.js)
 * @requires {object} nova_ajax - Localized data object containing `nonce`.
 */
(function ($) {
    'use strict';

    $(function () {
        if (typeof nova_ajax === 'undefined' || !nova_ajax.nonce) {
            console.error('Nova Dropzone Error: Localized data (nova_ajax.nonce) not found. File uploads will fail.');
            $('.nova-dropzone').each(function () {
                $(this).css({'opacity': 0.5, 'pointer-events': 'none', 'border-color': 'red'});
                $(this).find('.nova-dropzone-text').append('<p style="color: red; font-weight: bold; margin-top: 10px;">Upload Error: Config missing.</p>');
            });
            return;
        }

        $('.nova-dropzone').each(function () {
            const $dropzone = $(this);
            const $fileInput = $dropzone.find('input[type="file"]').first();
            const $browseButton = $dropzone.find('.nova-dropzone-button');
            const $previewContainer = $dropzone.find('.nova-upload-preview');
            const $fileUrlInput = $dropzone.find('.nova-file-url');

            if (!$fileInput.length || !$browseButton.length || !$previewContainer.length || !$fileUrlInput.length) {
                console.warn('Nova Dropzone Warning: Missing required child elements inside a .nova-dropzone container.', $dropzone);
                return;
            }

            /**
             * Handles the file upload process via AJAX.
             */
            function uploadFile(file) {
                // Client-side Validation
                const maxSizeMB = 5;
                if (file.size > maxSizeMB * 1024 * 1024) {
                    Nova.Element.notice.show(`Bestand is te groot. Maximum grootte is ${maxSizeMB}MB.`, 'error');
                    $fileInput.val('');
                    return;
                }

                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    Nova.Element.notice.show(`Ongeldig bestandstype (${file.type}). Toegestaan: JPG, PNG, GIF, SVG, WEBP.`, 'error');
                    $fileInput.val('');
                    return;
                }

                Nova.State.loader.show();

                const formData = new FormData();
                formData.append('file', file);
                formData.append('action', 'nova_upload_file');
                formData.append('_wpnonce', nova_ajax.nonce);

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success && response.data.url) {
                            const fileUrl = response.data.url;
                            $fileUrlInput.val(fileUrl);
                            displayPreview(fileUrl);
                            $dropzone.addClass('has-image');
                            Nova.Element.notice.show('Bestand succesvol geüpload!', 'success');
                        } else {
                            Nova.Element.notice.show(response.data.message || 'Upload mislukt.', 'error');
                        }
                    },
                    error: function (jqXHR, textStatus) {
                        Nova.Element.notice.show(`Upload mislukt: ${textStatus}`, 'error');
                        console.error('Upload Error:', jqXHR);
                    },
                    complete: function () {
                        Nova.State.loader.hide(300);
                        $fileInput.val('');
                    }
                });
            }

            /**
             * Display preview after upload
             */
            function displayPreview(url) {
                const $preview = $('<p></p>').append(
                    $('<a></a>', {
                        href: url,
                        target: '_blank'
                    }).append(
                        $('<img>', {
                            src: url,
                            width: 150,
                            style: 'display: block; margin-top: 10px; border: 1px solid #ccc;'
                        })
                    )
                );

                const $removeButton = $('<button></button>', {
                    type: 'button',
                    class: 'nova-remove-file button-secondary',
                    title: 'Remove file',
                    'data-input-id': $fileUrlInput.attr('id'),
                    text: '×'
                });

                $previewContainer.html('').append($preview).append($removeButton);
            }

            // Browse button click
            $browseButton.on('click', function () {
                $fileInput.click();
            });

            // File input change
            $fileInput.on('change', function () {
                const files = this.files;
                if (files && files.length > 0) {
                    uploadFile(files[0]);
                }
            });

            // Drag and drop
            $dropzone.on('dragover dragenter', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('dragover');
            });

            $dropzone.on('dragleave dragend drop', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('dragover');
            });

            $dropzone.on('drop', function (e) {
                const files = e.originalEvent.dataTransfer.files;
                if (files && files.length > 0) {
                    uploadFile(files[0]);
                }
            });

            // Remove file
            $(document).on('click', '.nova-remove-file', function (e) {
                e.preventDefault();
                const $button = $(this);
                const inputId = $button.data('input-id');
                const $input = $('#' + inputId);

                if (confirm('Weet je zeker dat je dit bestand wilt verwijderen?')) {
                    Nova.State.loader.show();

                    $.post(ajaxurl, {
                        action: 'nova_remove_file',
                        _wpnonce: nova_ajax.nonce
                    })
                    .done(function (response) {
                        if (response.success) {
                            $input.val('');
                            $previewContainer.html('');
                            $dropzone.removeClass('has-image');
                            Nova.Element.notice.show('Bestand verwijderd!', 'success');
                        } else {
                            Nova.Element.notice.show('Verwijderen mislukt.', 'error');
                        }
                    })
                    .fail(function () {
                        Nova.Element.notice.show('Verwijderen mislukt.', 'error');
                    })
                    .always(function () {
                        Nova.State.loader.hide(300);
                    });
                }
            });
        });
    });
})(jQuery);
