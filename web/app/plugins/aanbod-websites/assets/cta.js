jQuery(document).ready(function($) {
    console.log('CTA script loaded');

    $(document).on('click', '.website-cta-button', function(e) {
        e.preventDefault();
        console.log('CTA button clicked');

        var $button = $(this);
        var websiteId = $button.data('website-id');
        var checkoutUrl = $button.data('checkout-url');
        var originalText = $button.text();

        console.log('Website ID:', websiteId);
        console.log('Checkout URL:', checkoutUrl);
        console.log('AJAX URL:', aanbodWebsitesCTA.ajaxUrl);

        $button.text('Laden...');

        $.ajax({
            url: aanbodWebsitesCTA.ajaxUrl,
            type: 'POST',
            data: {
                action: 'set_selected_website',
                website_id: websiteId
            },
            success: function(response) {
                console.log('AJAX response:', response);
                if (response.success) {
                    window.location.href = checkoutUrl;
                } else {
                    alert(response.data.message || 'Er is een fout opgetreden.');
                    $button.text(originalText);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                alert('Er is een fout opgetreden. Probeer het opnieuw.');
                $button.text(originalText);
            }
        });
    });
});
