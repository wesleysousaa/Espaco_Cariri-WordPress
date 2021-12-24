<?php
/**
 * The template for displaying home page.
 * Template Name: Front-page Template
 * @package Newsphere
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

    /**
     * newsphere_action_sidebar_section hook
     * @since Newsphere 1.0.0
     *
     * @hooked newsphere_front_page_section -  20
     * @sub_hooked newsphere_front_page_section -  20
     */
    do_action('newsphere_front_page_section');


}
get_footer();