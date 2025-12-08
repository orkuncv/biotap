jQuery(document).ready(function($) {
    // Fix CTA button IDs in archive/loop context
    $('.website-cta-button').each(function() {
        var $button = $(this);
        var $postCard = $button.closest('.wp-block-group');
        var $postTitleLink = $postCard.find('.wp-block-post-title a, h3 a').first();

        if ($postTitleLink.length) {
            var postUrl = $postTitleLink.attr('href');
            var postId = null;

            // Try to extract from ?p=123 format
            var pMatch = postUrl.match(/[?&]p=(\d+)/);
            if (pMatch) {
                postId = pMatch[1];
            } else {
                // Extract slug and get ID via AJAX
                var urlParts = postUrl.replace(/\/$/, '').split('/');
                var slug = urlParts[urlParts.length - 1];

                $.ajax({
                    url: aanbodWebsitesCTA.ajaxUrl,
                    type: 'POST',
                    async: false,
                    data: {
                        action: 'get_website_id_by_slug',
                        slug: slug
                    },
                    success: function(response) {
                        if (response.success && response.data.id) {
                            postId = response.data.id;
                        }
                    }
                });
            }

            if (postId) {
                $button.attr('data-website-id', postId);
                $button.data('website-id', postId);
            }
        }
    });

    $(document).on('click', '.website-cta-button', function(e) {
        e.preventDefault();

        var $button = $(this);
        var websiteId = $button.data('website-id');
        var checkoutUrl = $button.data('checkout-url');
        var originalText = $button.text();

        $button.text('Laden...');

        $.ajax({
            url: aanbodWebsitesCTA.ajaxUrl,
            type: 'POST',
            data: {
                action: 'set_selected_website',
                website_id: websiteId
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = checkoutUrl;
                } else {
                    alert(response.data.message || 'Er is een fout opgetreden.');
                    $button.text(originalText);
                }
            },
            error: function() {
                alert('Er is een fout opgetreden. Probeer het opnieuw.');
                $button.text(originalText);
            }
        });
    });
});
