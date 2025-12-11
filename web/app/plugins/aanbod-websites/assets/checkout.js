jQuery(document).ready(function($) {
    let selectedPackage = null;
    let selectedExtras = [];

    // Format price in Dutch format
    function formatPrice(price) {
        return '€' + price.toFixed(2).replace('.', ',');
    }

    // Update price summary
    function updatePriceSummary() {
        let total = 0;

        // Add package price if selected
        if (selectedPackage) {
            total += parseFloat(selectedPackage.price) || 0;
        }

        // Add extras
        let extrasHtml = '';
        selectedExtras.forEach(function(extra) {
            const extraPrice = parseFloat(extra.price) || 0;
            total += extraPrice;
            extrasHtml += `
                <div class="summary-row">
                    <span>${extra.name}</span>
                    <span class="price">${formatPrice(extraPrice)}</span>
                </div>
            `;
        });

        $('#selected-extras-summary').html(extrasHtml);
        $('#total-price').text(formatPrice(total));
    }

    // Handle package selection
    $('input[name="selected_package"]').on('change', function() {
        const radio = $(this);
        const packageName = radio.data('name');
        const packagePrice = radio.data('price');

        selectedPackage = {
            index: radio.val(),
            name: packageName,
            price: packagePrice
        };

        // Update package display in summary
        $('#package-name').text(packageName);
        $('#package-price').text(formatPrice(parseFloat(packagePrice))).data('price', packagePrice);
        $('#package-price-row').show();

        // Add visual feedback
        $('.package-option').removeClass('selected');
        radio.closest('.package-option').addClass('selected');

        updatePriceSummary();
    });

    // Handle extra options checkbox change
    $('input[name="extras[]"]').on('change', function() {
        const checkbox = $(this);
        const extraIndex = checkbox.val();
        const extraName = checkbox.data('name');
        const extraPrice = checkbox.data('price');

        if (checkbox.is(':checked')) {
            selectedExtras.push({
                index: extraIndex,
                name: extraName,
                price: extraPrice
            });
        } else {
            selectedExtras = selectedExtras.filter(function(extra) {
                return extra.index != extraIndex;
            });
        }

        updatePriceSummary();
    });

    // Handle form submission
    $('#website-checkout-form').on('submit', function(e) {
        e.preventDefault();

        // Check if package is selected
        if (!selectedPackage) {
            alert('Selecteer eerst een pakket om door te gaan.');
            return;
        }

        const form = $(this);
        const submitButton = form.find('.button-submit');
        const messagesContainer = $('#form-messages');

        // Disable submit button
        submitButton.prop('disabled', true).text('Bezig met versturen...');
        messagesContainer.removeClass('success error').empty();

        // Get form data
        const formData = form.serialize();

        // Add selected package
        let packageData = '&selected_package=' + selectedPackage.index;

        // Add selected extras to form data
        let extrasData = '';
        selectedExtras.forEach(function(extra) {
            extrasData += '&selected_extras[]=' + extra.index;
        });

        // Submit via AJAX
        $.ajax({
            url: aanbodWebsites.ajaxUrl,
            type: 'POST',
            data: formData + packageData + extrasData,
            success: function(response) {
                if (response.success) {
                    messagesContainer
                        .addClass('success')
                        .html('<strong>Gelukt!</strong> ' + response.data.message);

                    // Reset form
                    form[0].reset();
                    $('input[name="extras[]"]').prop('checked', false);
                    $('input[name="selected_package"]').prop('checked', false);
                    $('.package-option').removeClass('selected');
                    selectedExtras = [];
                    selectedPackage = null;
                    $('#package-price-row').hide();
                    updatePriceSummary();

                    // Scroll to message
                    $('html, body').animate({
                        scrollTop: messagesContainer.offset().top - 100
                    }, 500);
                } else {
                    messagesContainer
                        .addClass('error')
                        .html('<strong>Fout:</strong> ' + response.data.message);
                }
            },
            error: function() {
                messagesContainer
                    .addClass('error')
                    .html('<strong>Fout:</strong> Er is een fout opgetreden. Probeer het later opnieuw.');
            },
            complete: function() {
                // Re-enable submit button
                submitButton.prop('disabled', false).text('Bestelling Plaatsen');
            }
        });
    });

    // Auto-select pre-selected package if available
    if (typeof aanbodWebsites.preselectedPackage !== 'undefined' && aanbodWebsites.preselectedPackage >= 0) {
        const preselectedRadio = $('input[name="selected_package"][value="' + aanbodWebsites.preselectedPackage + '"]');
        if (preselectedRadio.length) {
            preselectedRadio.prop('checked', true).trigger('change');
        }
    }

    // Initialize price summary
    updatePriceSummary();
});
