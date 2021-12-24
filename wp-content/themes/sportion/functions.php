<?php
/*This file is part of Sportion child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function sportion_enqueue_child_styles() {
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'newsphere-style';
    $fonts_url = 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700';
    wp_enqueue_style('sportion-google-fonts', $fonts_url, array(), null);
    wp_enqueue_style('sidr', get_template_directory_uri().'/assets/sidr/css/jquery.sidr.dark.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'sportion',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );

}
add_action( 'wp_enqueue_scripts', 'sportion_enqueue_child_styles' );



/**
 * Trending posts additions.
 */
require get_stylesheet_directory().'/inc/hooks/hook-front-page-main-banner-section.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sportion_customize_register($wp_customize) {

    $wp_customize->remove_control('vertical_slider_section_title');
    $wp_customize->remove_control('select_vertical_slider_news_category');
    $wp_customize->get_control('tabbed_section_title')->label = esc_html__('Thumbs Section', 'sportion');
    $wp_customize->get_control('select_trending_tab_news_category')->description = esc_html__('Posts to be shown on thumbs section', 'sportion');

}
add_action('customize_register', 'sportion_customize_register', 99999 );



function sportion_remove_parent_main_banner(){
    remove_action('newsphere_action_front_page_main_section_1', 'newsphere_front_page_main_section_1', 40);
}
add_action('wp_loaded', 'sportion_remove_parent_main_banner');