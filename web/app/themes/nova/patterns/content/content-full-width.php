<?php
/**
 * Title: Full width content
 * Slug: nova/content-full-width
 * Categories: content
 * Description: A full-width content block.
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50)">

    <!-- wp:heading -->
    <h2 class="wp-block-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus ex eu libero <strong>eleifend</strong>, ut
       fermentum magna porttitor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
       curae; Vivamus dictum nunc et turpis vehicula, vitae auctor sem facilisis.</p>
    <!-- /wp:paragraph -->

    <!-- wp:separator {"opacity":"css"} -->
    <hr class="wp-block-separator has-css-opacity"/>
    <!-- /wp:separator -->

    <!-- wp:heading {"fontSize":"l-heading"} -->
    <h2 class="wp-block-heading has-l-heading-font-size">Fusce dapibus ex</h2>
    <!-- /wp:heading -->

    <!-- wp:list -->
    <ul class="wp-block-list"><!-- wp:list-item -->
        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                              <!-- /wp:list-item -->

                              <!-- wp:list-item -->
        <li>Vivamus dictum nunc et turpis vehicula.</li>
                              <!-- /wp:list-item -->

                              <!-- wp:list-item -->
        <li>Suspendisse potenti. Cras in dui et risus auctor blandit.</li>
                              <!-- /wp:list-item --></ul>
    <!-- /wp:list -->

    <!-- wp:heading {"level":3,"fontSize":"quote"} -->
    <h3 class="wp-block-heading has-quote-font-size">Donec ullamcorper nulla</h3>
    <!-- /wp:heading -->

    <!-- wp:list {"ordered":true} -->
    <ol class="wp-block-list"><!-- wp:list-item -->
        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                              <!-- /wp:list-item -->

                              <!-- wp:list-item -->
        <li>Integer sit amet elit non ligula luctus commodo.</li>
                              <!-- /wp:list-item -->

                              <!-- wp:list-item -->
        <li>Suspendisse potenti. Cras in dui et risus auctor blandit.</li>
                              <!-- /wp:list-item --></ol>
    <!-- /wp:list -->

    <!-- wp:quote {"className":"is-style-large"} -->
    <blockquote class="wp-block-quote is-style-large"><!-- wp:paragraph -->
        <p>Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non
           magna.</p>
                                                      <!-- /wp:paragraph --><cite>— Lorem Ipsum Dolor</cite>
    </blockquote>
    <!-- /wp:quote -->

    <!-- wp:separator {"opacity":"css"} -->
    <hr class="wp-block-separator has-css-opacity"/>
    <!-- /wp:separator -->

    <!-- wp:heading {"fontSize":"xl-heading"} -->
    <h2 class="wp-block-heading has-xl-heading-font-size">Suspendisse potenti. Cras in dui et.</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"fontSize":"p-large"} -->
    <p class="has-p-large-font-size">Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod.
                                     Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":3,"fontSize":"quote"} -->
    <h3 class="wp-block-heading has-quote-font-size">Vivamus dictum nunc et turpis vehicula</h3>
    <!-- /wp:heading -->

    <!-- wp:list -->
    <ul class="wp-block-list">
        <!-- wp:list-item -->
        <li>Primary<!-- wp:list -->
            <ul class="wp-block-list">
                <!-- wp:list-item -->
                <li>Sub A</li>
                <!-- /wp:list-item -->

                <!-- wp:list-item -->
                <li>Sub B</li>
                <!-- /wp:list-item -->
            </ul>
            <!-- /wp:list -->
        </li>
        <!-- /wp:list-item -->

        <!-- wp:list-item -->
        <li>Secondary</li>
        <!-- /wp:list-item --></ul>
    <!-- /wp:list -->

    <!-- wp:paragraph -->
    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Integer posuere erat a ante venenatis dapibus.</p>
    <!-- /wp:paragraph -->

    <!-- wp:table -->
    <figure class="wp-block-table"><table class="has-fixed-layout"><thead><tr><th>Header label</th><th>Header label</th><th>Header label</th><th>Header label</th></tr></thead><tbody><tr><td>Duis mollis</td><td>Nisi erat porttitor</td><td>vehicula ut id elit.</td><td>Nullam id dolor</td></tr><tr><td>Curabitur blandit tempus porttitor.</td><td><br>vehicula ut id elit.</td><td>Nisi erat porttitor</td><td>Duis mollis</td></tr><tr><td>Nisi erat porttitor</td><td>Nullam id dolor</td><td>Duis mollis</td><td>Curabitur blandit tempus porttitor.</td></tr></tbody><tfoot><tr><td>Footer label</td><td>Footer label</td><td>Footer label</td><td>Footer label</td></tr></tfoot></table></figure>
    <!-- /wp:table -->

</div>
<!-- /wp:group -->