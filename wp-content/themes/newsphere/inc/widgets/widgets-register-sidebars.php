<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newsphere_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'newsphere'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets for main sidebar.', 'newsphere'),
        'before_widget' => '<div id="%1$s" class="widget newsphere-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));


    register_sidebar(array(
        'name'          => esc_html__('Off Canvas', 'newsphere'),
        'id'            => 'off-canvas-panel',
        'description'   => esc_html__('Add widgets for off-canvas section.', 'newsphere'),
        'before_widget' => '<div id="%1$s" class="widget newsphere-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));



    register_sidebar(array(
        'name' => esc_html__('Front-page Content Section', 'newsphere'),
        'id' => 'home-content-widgets',
        'description' => esc_html__('Add widgets to front-page contents section.', 'newsphere'),
        'before_widget' => '<div id="%1$s" class="widget newsphere-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Sidebar Section', 'newsphere'),
        'id' => 'home-sidebar-widgets',
        'description' => esc_html__('Add widgets to front-page sidebar section.', 'newsphere'),
        'before_widget' => '<div id="%1$s" class="widget newsphere-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer First Section', 'newsphere'),
        'id' => 'footer-first-widgets-section',
        'description' => esc_html__('Displays items on footer first column.', 'newsphere'),
        'before_widget' => '<div id="%1$s" class="widget newsphere-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer Second Section', 'newsphere'),
        'id' => 'footer-second-widgets-section',
        'description' => esc_html__('Displays items on footer second column.', 'newsphere'),
        'before_widget' => '<div id="%1$s" class="widget newsphere-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Third Section', 'newsphere'),
        'id' => 'footer-third-widgets-section',
        'description' => esc_html__('Displays items on footer third column.', 'newsphere'),
        'before_widget' => '<div id="%1$s" class="widget newsphere-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));




}

add_action('widgets_init', 'newsphere_widgets_init');