jQuery(document).ready(function($) {
    // Handle package CTA button clicks
    $('.package-cta-button').on('click', function(e) {
        e.preventDefault();

        const button = $(this);
        const packageIndex = button.data('package-index');
        const websiteId = button.data('website-id');
        const checkoutUrl = button.data('checkout-url');

        // Disable button and show loading state
        const originalText = button.text();
        button.prop('disabled', true).text('Bezig...');

        // Send AJAX request to store website and package in session
        $.ajax({
            url: aanbodWebsitesPackages.ajaxUrl,
            type: 'POST',
            data: {
                action: 'set_selected_website_and_package',
                website_id: websiteId,
                package_index: packageIndex
            },
            success: function(response) {
                if (response.success) {
                    // Redirect to checkout
                    window.location.href = checkoutUrl;
                } else {
                    alert(response.data.message || 'Er is een fout opgetreden.');
                    button.prop('disabled', false).text(originalText);
                }
            },
            error: function() {
                alert('Er is een fout opgetreden. Probeer het later opnieuw.');
                button.prop('disabled', false).text(originalText);
            }
        });
    });
});
