<?php
/**
 * Title: Enkele Website
 * Slug: single-website
 * Description: Layout voor enkele website pagina
 * Categories: aanbod-websites
 * Keywords: website, single, detail
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">

    <!-- wp:post-featured-image {"align":"wide","style":{"border":{"radius":"12px"}}} /-->

    <!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
    <div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)">

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group">

            <!-- wp:post-terms {"term":"website_categorie"} /-->

            <!-- wp:post-date /-->

        </div>
        <!-- /wp:group -->

        <!-- wp:post-title {"level":1} /-->

        <!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false} /-->

        <!-- wp:shortcode -->
        [website_cta]
        <!-- /wp:shortcode -->

        <!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
        <hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"/>
        <!-- /wp:separator -->

        <!-- wp:post-content {"align":"wide","layout":{"type":"constrained"}} /-->

        <!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"}}}} -->
        <hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40)"/>
        <!-- /wp:separator -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
        <div class="wp-block-group">

            <!-- wp:paragraph -->
            <p><strong>Tags:</strong></p>
            <!-- /wp:paragraph -->

            <!-- wp:post-terms {"term":"website_tag"} /-->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"contrast","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-contrast-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">

    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50)">Meer Websites</h2>
    <!-- /wp:heading -->

    <!-- wp:query {"queryId":2,"query":{"perPage":3,"pages":0,"offset":0,"postType":"website","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
    <div class="wp-block-query alignwide">

        <!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3}} -->

            <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"var:preset|spacing|30"},"border":{"radius":"8px"}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-base-background-color has-background" style="border-radius:8px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":{"top":"8px","left":"8px","bottom":"0px","right":"8px"}}}} /-->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|20"}}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">

                    <!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} /-->

                    <!-- wp:post-excerpt {"moreText":"Lees meer","excerptLength":15} /-->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        <!-- /wp:post-template -->

    </div>
    <!-- /wp:query -->

</div>
<!-- /wp:group -->
