<?php
/**
 * The template for displaying home page.
 * Template Name: Front-page Template
 * @package CoverNews
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

    /**
     * covernews_action_sidebar_section hook
     * @since CoverNews 1.0.0
     *
     * @hooked covernews_front_page_section -  20
     * @sub_hooked covernews_front_page_section -  20
     */
    do_action('covernews_front_page_section');

}
get_footer();