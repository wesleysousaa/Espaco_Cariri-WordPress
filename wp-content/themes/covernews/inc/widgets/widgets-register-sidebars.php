<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function covernews_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'covernews'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets for main sidebar.', 'covernews'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Content Section', 'covernews'),
        'id' => 'home-content-widgets',
        'description' => esc_html__('Add widgets to front-page contents section.', 'covernews'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Sidebar Section', 'covernews'),
        'id' => 'home-sidebar-widgets',
        'description' => esc_html__('Add widgets to front-page sidebar section.', 'covernews'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer First Section', 'covernews'),
        'id' => 'footer-first-widgets-section',
        'description' => esc_html__('Displays items on footer first column.', 'covernews'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer Second Section', 'covernews'),
        'id' => 'footer-second-widgets-section',
        'description' => esc_html__('Displays items on footer second column.', 'covernews'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Third Section', 'covernews'),
        'id' => 'footer-third-widgets-section',
        'description' => esc_html__('Displays items on footer third column.', 'covernews'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));

}

add_action('widgets_init', 'covernews_widgets_init');