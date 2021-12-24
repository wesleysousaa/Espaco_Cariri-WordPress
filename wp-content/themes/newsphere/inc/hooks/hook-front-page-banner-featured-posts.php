<?php
if (!function_exists('newsphere_banner_featured_posts')):
    /**
     * Ticker Slider
     *
     * @since Newsphere 1.0.0
     *
     */
    function newsphere_banner_featured_posts()
    {
        $color_class = 'category-color-1';
        ?>
        <?php
        $newsphere_enable_featured_news = newsphere_get_option('show_featured_news_section');
        if ($newsphere_enable_featured_news):
            $newsphere_featured_news_title = newsphere_get_option('featured_news_section_title');
	        $dir = 'ltr';
	        if(is_rtl()){
		        $dir = 'rtl';
	        }
            ?>
            <div class="af-main-banner-featured-posts featured-posts" dir="<?php echo esc_attr($dir);?>">
                <?php if (!empty($newsphere_featured_news_title)): ?>
                    <h4 class="header-after1 ">
                                <span class="header-after <?php echo esc_attr($color_class); ?>">
                                    <?php echo esc_html($newsphere_featured_news_title); ?>
                                </span>
                    </h4>
                <?php endif; ?>


                <div class="section-wrapper">
                    <div class="af-double-column list-style af-container-row clearfix">
                        <?php
                        $newsphere_featured_category = newsphere_get_option('select_featured_news_category');
                        $newsphere_number_of_featured_news = newsphere_get_option('number_of_featured_news');

                        $featured_posts = newsphere_get_posts($newsphere_number_of_featured_news, $newsphere_featured_category);
                        if ($featured_posts->have_posts()) :
                            while ($featured_posts->have_posts()) :
                                $featured_posts->the_post();

                                global $post;
                                $url = newsphere_get_freatured_image_url($post->ID, 'thumbnail');
                                ?>

                                <div class="col-3 pad float-l " data-mh="af-feat-list">
                                    <div class="read-single color-pad">
                                        <div class="data-bg read-img pos-rel col-4 float-l read-bg-img"
                                             data-background="<?php echo esc_url($url); ?>">
                                            <img src="<?php echo esc_url($url); ?>">

                                            <span class="min-read-post-format">
		  								<?php echo newsphere_post_format($post->ID); ?>
                                        <?php newsphere_count_content_words($post->ID); ?>
                                        </span>

                                        </div>
                                        <div class="read-details col-75 float-l pad color-tp-pad">
                                            <div class="read-categories">
                                                <?php newsphere_post_categories(); ?>
                                            </div>
                                            <div class="read-title">
                                                <h4>
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                            </div>

                                            <div class="entry-meta">
                                                <?php newsphere_get_comments_count($post->ID); ?>
                                                <?php newsphere_post_item_meta(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- Trending line END -->
        <?php

    }
endif;

add_action('newsphere_action_banner_featured_posts', 'newsphere_banner_featured_posts', 10);