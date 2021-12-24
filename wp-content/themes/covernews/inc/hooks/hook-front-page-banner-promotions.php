<?php
if (!function_exists('covernews_banner_advertisement')):
    /**
     * Ticker Slider
     *
     * @since CoverNews 1.0.0
     *
     */
    function covernews_banner_advertisement()
    {

        if (('' != covernews_get_option('banner_advertisement_section')) ) { ?>
            <div class="banner-promotions-wrapper">
                <?php if (('' != covernews_get_option('banner_advertisement_section'))):

                    $covernews_banner_advertisement = covernews_get_option('banner_advertisement_section');
                    $covernews_banner_advertisement = absint($covernews_banner_advertisement);
                    $covernews_banner_advertisement = wp_get_attachment_image($covernews_banner_advertisement, 'full');
                    $covernews_banner_advertisement_url = covernews_get_option('banner_advertisement_section_url');
                    $covernews_banner_advertisement_url = isset($covernews_banner_advertisement_url) ? esc_url($covernews_banner_advertisement_url) : '#';
                    $covernews_open_on_new_tab = covernews_get_option('banner_advertisement_open_on_new_tab');
                    $covernews_open_on_new_tab = ('' != $covernews_open_on_new_tab) ? '_blank' : '';

                    ?>
                    <div class="promotion-section">
                        <a href="<?php echo esc_url($covernews_banner_advertisement_url); ?>" target="<?php echo esc_attr($covernews_open_on_new_tab); ?>">
                            <?php echo $covernews_banner_advertisement; ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('home-advertisement-widgets')): ?>
                    <div class="promotion-section">
                        <?php dynamic_sidebar('home-advertisement-widgets'); ?>
                    </div>

                <?php endif; ?>

            </div>
            <!-- Trending line END -->
            <?php
        }
    }
endif;

add_action('covernews_action_banner_advertisement', 'covernews_banner_advertisement', 10);