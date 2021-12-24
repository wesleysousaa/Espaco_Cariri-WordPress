<?php
/*This file is part of Newsport child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function newsport_enqueue_child_styles() {
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'covernews-style';

    $fonts_url = 'https://fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic,700';
    wp_enqueue_style('newsport-google-fonts', $fonts_url, array(), null);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'newsport',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );


}
add_action( 'wp_enqueue_scripts', 'newsport_enqueue_child_styles' );


/**
 * slider additions.
 */
require get_stylesheet_directory().'/inc/hooks/hook-front-page-main-banner-section-2.php';



/**
 * Front-page main banner section layout
 */
if(!function_exists('newsport_front_page_main_section_selection')){

    function newsport_front_page_main_section_selection(){

        $hide_on_blog = covernews_get_option('disable_main_banner_on_blog_archive');

            if ($hide_on_blog) {
                if (is_front_page()) {
                    do_action('covernews_action_front_page_main_section_2');
                }

            } else {
                if (is_front_page() || is_home()) {
                    do_action('covernews_action_front_page_main_section_2');
                }

        }
    }
}
add_action('newsport_action_front_page_main_section', 'newsport_front_page_main_section_selection');


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newsport_customize_register($wp_customize) {     
     $wp_customize->remove_control('trending_slider_title');
     $wp_customize->remove_control('select_trending_news_category');     
}
add_action('customize_register', 'newsport_customize_register', 99999 );


