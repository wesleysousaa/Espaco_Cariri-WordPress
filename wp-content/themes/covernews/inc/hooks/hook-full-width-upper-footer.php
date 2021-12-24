<?php

/**
 * Front page section additions.
 */


if (!function_exists('covernews_full_width_upper_footer_section')) :
    /**
     *
     * @since CoverNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function covernews_full_width_upper_footer_section()
    {

        if (1 == covernews_get_option('frontpage_show_latest_posts')) {
            covernews_get_block('latest');
        }

    }
endif;
add_action('covernews_action_full_width_upper_footer_section', 'covernews_full_width_upper_footer_section');
