<?php
if (!function_exists('covernews_banner_featured_posts')):
    /**
     * Ticker Slider
     *
     * @since CoverNews 1.0.0
     *
     */
    function covernews_banner_featured_posts()
    {

         ?>
            <div class="featured-posts-grid">
                <div class="row">
                    <?php
                    $covernews_featured_category = covernews_get_option('select_featured_news_category');
                    $covernews_number_of_featured_news = covernews_get_option('number_of_featured_news');
                    $featured_posts = covernews_get_posts($covernews_number_of_featured_news, $covernews_featured_category);
                    if ($featured_posts->have_posts()) :
                        while ($featured_posts->have_posts()) :
                            $featured_posts->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-medium-square');
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }
                            global $post;

                            ?>
                            <div class="col-sm-15">
                                <div class="spotlight-post" data-mh="banner-height">
                                    <figure class="featured-article">
                                        <div class="featured-article-wrapper">
                                            <div class="data-bg data-bg-hover data-bg-hover data-bg-featured"
                                                 data-background="<?php echo esc_url($url); ?>">
                                                <a href="<?php the_permalink(); ?>"></a>
                                            </div>
                                            <?php echo covernews_post_format($post->ID); ?>
                                            <div class="figure-categories figure-categories-bg">

                                                <?php covernews_post_categories(); ?>
                                            </div>
                                        </div>
                                    </figure>

                                    <figcaption>

                                        <div class="title-heading">
                                            <h3 class="article-title article-title-1">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                        </div>
                                        <div class="grid-item-metadata">
                                            <?php covernews_post_item_meta(); ?>
                                        </div>
                                    </figcaption>
                                </div>
                            </div>

                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <!-- Trending line END -->
            <?php

    }
endif;

add_action('covernews_action_banner_featured_posts', 'covernews_banner_featured_posts', 10);