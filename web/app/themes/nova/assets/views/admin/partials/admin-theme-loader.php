<?php
/**
 * Admin Theme Loader
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

<div id="nova-loader" class="nova-loader" style="display: none;">
    <div class="nova-loader-content">
        <div class="nova-spinner"></div>
        <p>Laden...</p>
    </div>
</div>

<script>
    if (typeof Nova === 'undefined') {
        window.Nova = {};
    }
    if (typeof Nova.State === 'undefined') {
        Nova.State = {};
    }
    Nova.State.loader = {
        show: function() {
            document.getElementById('nova-loader').style.display = 'flex';
        },
        hide: function() {
            document.getElementById('nova-loader').style.display = 'none';
        }
    };
</script>
