<?php
if (!function_exists('sportion_front_page_main_section_2')) :
    /**
     * Banner Slider
     *
     * @since Newsphere 1.0.0
     *
     */
    function sportion_front_page_main_section_2()
    {
        $newsphere_enable_main_slider = newsphere_get_option('show_main_news_section');

        ?>

        <?php do_action('newsphere_action_banner_exclusive_posts'); ?>
        <?php if ($newsphere_enable_main_slider):
        $main_banner_section_background_image = newsphere_get_option('main_banner_section_background_image');
        if(!empty($main_banner_section_background_image)){
            $newsphere_class = 'af-main-banner-image-active';
        }else{
            $newsphere_class = '';
        }
        $dir = 'ltr';
        if(is_rtl()){
            $dir = 'rtl';
        }
        ?>
        <section class="aft-blocks aft-main-banner-section banner-carousel-1-wrap bg-fixed <?php echo $newsphere_class;?>" dir="<?php echo esc_attr($dir);?>">
            <div class="container-wrapper">
                <?php
                if (is_active_sidebar('home-above-main-banner-widgets')): ?>
                    <div class="main-banner-widget-wrapper">
                        <div class="main-banner-widget-section">
                            <?php dynamic_sidebar('home-above-main-banner-widgets'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- <div class="banner-carousel-1 af-widget-carousel owl-carousel owl-theme"> -->
                <div class="aft-main-banner-wrapper af-container-row clearfix">
                    <div class="col col-66 float-l pad full-wid-resp">
                        <?php

                        newsphere_get_block('carousel', 'banner');

                        ?>
                    </div>
                    <div class="aft-trending-latest-popular col col-3 float-l pad full-wid-resp">
                        <?php

                        do_action('newsphere_action_banner_tabbed_posts');

                        ?>
                    </div>
                </div>

                <?php
                if (is_active_sidebar('home-below-main-banner-widgets')): ?>
                    <div class="main-banner-widget-wrapper">
                        <div class="main-banner-widget-section">
                            <?php dynamic_sidebar('home-below-main-banner-widgets'); ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </section>
    <?php endif; ?>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('newsphere_action_front_page_main_section_1', 'sportion_front_page_main_section_2', 40);