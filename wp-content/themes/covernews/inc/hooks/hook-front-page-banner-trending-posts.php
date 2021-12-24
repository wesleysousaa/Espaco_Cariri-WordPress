<?php
if (!function_exists('covernews_banner_trending_posts')):
    /**
     * Ticker Slider
     *
     * @since CoverNews 1.0.0
     *
     */
    function covernews_banner_trending_posts()
    {

        ?>
            <div class="banner-trending-posts-wrapper clearfix">

                <?php
                $covernews_trending_slider_title = covernews_get_option('trending_slider_title');
                $covernews_nav_control_class = empty($covernews_trending_slider_title) ? 'no-section-title' : '';
                $category = covernews_get_option('select_trending_news_category');
                $number_of_posts = covernews_get_option('number_of_trending_slides');
                $all_posts = covernews_get_posts($number_of_posts, $category);
                $count = 1;
                ?>
                <div class="trending-posts-carousel">
                    <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }

                            global $post;
                            ?>
                            <div class="slick-item">
                                <!-- <span style="margin: 0 0 10px 0; display: block;"> -->
                                <figure class="carousel-image">
                                    <div class="no-gutter-col">
                                        <figure class="featured-article">
                                            <div class="featured-article-wrapper">
                                                <div class="data-bg data-bg-hover data-bg-hover data-bg-featured" data-background="<?php echo esc_url($url); ?>">
                                                    <a href="<?php the_permalink(); ?>"></a>
                                                </div>
                                            </div>
                                            <span class="trending-no">
                                                <?php echo sprintf('%s', esc_html($count)); ?>
                                            </span>
                                            <?php //echo covernews_post_format($post->ID); ?>
                                        </figure>

                                        <figcaption>
                                            <div class="figure-categories figure-categories-bg">
                                                <?php covernews_post_categories(); ?>
                                            </div>
                                            <div class="title-heading">
                                                <h3 class="article-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                        </figcaption>
                                    </div>
                                    </figcaption>
                                </figure>
                                <!-- </span> -->
                            </div>
                        <?php
                        $count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="af-trending-navcontrols <?php echo esc_attr($covernews_nav_control_class); ?>"></div>

            </div>
            <!-- Trending line END -->
            <?php

    }
endif;

add_action('covernews_action_banner_trending_posts', 'covernews_banner_trending_posts', 10);