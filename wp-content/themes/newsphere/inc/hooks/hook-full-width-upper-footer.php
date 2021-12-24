<?php

/**
 * Front page section additions.
 */


if (!function_exists('newsphere_full_width_upper_footer_section')) :
    /**
     *
     * @since Newsphere 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function newsphere_full_width_upper_footer_section()
    {

        if ( 1 == newsphere_get_option('frontpage_show_latest_posts') ) {
            newsphere_get_block('latest');
        }

    }
endif;
add_action('newsphere_action_full_width_upper_footer_section', 'newsphere_full_width_upper_footer_section');
