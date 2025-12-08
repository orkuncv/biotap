<?php
/**
 * Title: Websites Archief
 * Slug: archive-websites
 * Description: Hero layout voor websites archief pagina
 * Categories: aanbod-websites
 * Keywords: websites, archief, hero, cards
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"80px","bottom":"80px","left":"20px","right":"20px"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:80px;padding-right:20px;padding-bottom:80px;padding-left:20px">

    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px","fontWeight":"600"},"color":{"text":"#2271b1"}}} -->
    <p class="has-text-align-center has-text-color" style="color:#2271b1;font-size:18px;font-weight:600">Zo ziet het eruit</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"10px","bottom":"20px"}},"typography":{"fontSize":"48px","fontWeight":"700"}}} -->
    <h1 class="wp-block-heading has-text-align-center" style="margin-top:10px;margin-bottom:20px;font-size:48px;font-weight:700">Bekijk de voorbeeldwebsites</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"color":{"text":"#666"},"spacing":{"margin":{"bottom":"60px"}}}} -->
    <p class="has-text-align-center has-text-color" style="color:#666;margin-bottom:60px;font-size:18px">Benieuwd naar jouw toekomstige website? Laat je inspireren door onze demo websites.</p>
    <!-- /wp:paragraph -->

    <!-- wp:query {"queryId":1,"query":{"perPage":12,"pages":0,"offset":0,"postType":"website","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide"} -->
    <div class="wp-block-query alignwide">

        <!-- wp:post-template {"style":{"spacing":{"blockGap":"40px"}},"layout":{"type":"grid","columnCount":3},"className":"website-cards-grid"} -->

            <!-- wp:cover {"useFeaturedImage":true,"dimRatio":40,"overlayColor":"black","minHeight":400,"minHeightUnit":"px","style":{"border":{"radius":"16px"},"spacing":{"padding":{"top":"40px","right":"40px","bottom":"40px","left":"40px"}}},"layout":{"type":"constrained"},"className":"website-card"} -->
            <div class="wp-block-cover website-card" style="border-radius:16px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px;min-height:400px">
                <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-40 has-background-dim"></span>

                <div class="wp-block-cover__inner-container">
                    <!-- wp:post-title {"textAlign":"left","level":2,"style":{"typography":{"fontSize":"32px","fontWeight":"700"},"color":{"text":"#ffffff"},"spacing":{"margin":{"bottom":"15px"}}}} /-->

                    <!-- wp:post-excerpt {"textAlign":"left","moreText":"","excerptLength":15,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"16px"},"spacing":{"margin":{"bottom":"30px"}}}} /-->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"black","style":{"border":{"radius":"8px"},"spacing":{"padding":{"left":"24px","right":"24px","top":"12px","bottom":"12px"}}}} -->
                        <div class="wp-block-button">
                            <a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:8px;padding-top:12px;padding-right:24px;padding-bottom:12px;padding-left:24px">Bekijk website →</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                    <!-- wp:shortcode -->
                    [website_cta text="Bekijk website →"]
                    <!-- /wp:shortcode -->
                </div>
            </div>
            <!-- /wp:cover -->

        <!-- /wp:post-template -->

        <!-- wp:query-pagination {"paginationArrow":"arrow","align":"wide","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"60px"}}}} -->
            <!-- wp:query-pagination-previous /-->
            <!-- wp:query-pagination-numbers /-->
            <!-- wp:query-pagination-next /-->
        <!-- /wp:query-pagination -->

        <!-- wp:query-no-results -->
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"color":{"text":"#666"}}} -->
            <p class="has-text-align-center has-text-color" style="color:#666;font-size:18px">Geen websites gevonden.</p>
            <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->

    </div>
    <!-- /wp:query -->

</div>
<!-- /wp:group -->
