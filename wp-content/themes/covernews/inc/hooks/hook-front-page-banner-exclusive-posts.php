<?php
if (!function_exists('covernews_banner_trending_posts')):
    /**
     * Ticker Slider
     *
     * @since CoverNews 1.0.0
     *
     */
    function covernews_banner_exclusive_posts()
    {

        if ('' != covernews_get_option('show_flash_news_section')) { ?>
            <div class="banner-exclusive-posts-wrapper clearfix">

                <?php
                $category = covernews_get_option('select_flash_news_category');
                $number_of_posts = covernews_get_option('number_of_flash_news');
                $em_ticker_news_title = covernews_get_option('flash_news_title');
                $em_ticker_news_mode = covernews_get_option('select_flash_new_mode');
                $all_posts = covernews_get_posts($number_of_posts, $category);

                if(is_rtl()){
                    $em_ticker_news_mode = 'flash-slide-right';
                    $dir = 'right';
                }else{
                    $em_ticker_news_mode = 'flash-slide-left';
                    $dir = 'left';
                }

                ?>

                <div class="exclusive-posts">
                    <div class="exclusive-now primary-color">
                        <div class="alert-spinner">
                            <div class="double-bounce1"></div>
                            <div class="double-bounce2"></div>
                        </div>
                        <strong><?php echo esc_html($em_ticker_news_title); ?></strong>
                    </div>
                    <div class="exclusive-slides" dir="ltr">
                        <?php
                        if ($all_posts->have_posts()) : ?>
                        <div class='marquee <?php echo esc_attr($em_ticker_news_mode); ?>' data-speed='80000' data-gap='0' data-duplicated='true' data-direction='<?php echo esc_attr($dir); ?>'>
                            <?php
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                                    $url = $thumb['0'];
                                } else {
                                    $url = '';
                                }
                                ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if ($url) { ?>
                                        <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php } ?>
                                    <?php the_title(); ?>
                                </a>
                            <?php

                            endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Excluive line END -->
            <?php
        }
    }
endif;

add_action('covernews_action_banner_exclusive_posts', 'covernews_banner_exclusive_posts', 10);