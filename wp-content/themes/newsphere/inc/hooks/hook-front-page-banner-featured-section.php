<?php
if (!function_exists('newsphere_banner_featured_section')):
    /**
     * Ticker Slider
     *
     * @since Newsphere 1.0.0
     *
     */
    function newsphere_banner_featured_section()
    {

        $hide_on_blog = newsphere_get_option('disable_main_banner_on_blog_archive');
        if ($hide_on_blog) {
            if (is_front_page()) {
                $newsphere_enable_featured_news = newsphere_get_option('show_featured_news_section');
                if ($newsphere_enable_featured_news): ?>

                    <section class="aft-blocks">
                        <div class="container-wrapper">
                            <?php do_action('newsphere_action_banner_featured_posts'); ?>

                        </div>
                    </section>
                <?php endif;
            }

        } else {
            if (is_front_page() || is_home()) {
                $newsphere_enable_featured_news = newsphere_get_option('show_featured_news_section');
                if ($newsphere_enable_featured_news): ?>

                    <section class="aft-blocks">
                        <div class="container-wrapper">
                            <?php do_action('newsphere_action_banner_featured_posts'); ?>

                        </div>
                    </section>
                <?php endif;
            }

        }

    }
endif;

add_action('newsphere_action_banner_featured_section', 'newsphere_banner_featured_section', 10);