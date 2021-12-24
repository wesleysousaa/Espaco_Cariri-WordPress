<?php

/**
 * Option Panel
 *
 * @package Newsphere
 */

$default = newsphere_get_default_theme_options();

/**
 * Frontpage options section
 *
 * @package Newsphere
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('frontpage_option_panel',
    array(
        'title' => esc_html__('Frontpage Options', 'newsphere'),
        'priority' => 199,
        'capability' => 'edit_theme_options',
    )
);


// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings',
    array(
        'title' => esc_html__('Banner Advertisement', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default' => $default['banner_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label' => esc_html__('Banner Section Advertisement', 'newsphere'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'newsphere'), 930, 100),
            'section' => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default' => $default['banner_advertisement_section_url'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'newsphere'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'text',
        'priority' => 130,
    )
);



//=================================
//Popular tags Section.
//=================================
$wp_customize->add_section('newsphere_popular_tags_section_settings',
    array(
        'title' => esc_html__('Popular Tags', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);

$wp_customize->add_setting('show_popular_tags_section',
    array(
        'default' => $default['show_popular_tags_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_popular_tags_section',
    array(
        'label' => esc_html__('Enable Popular Tags Section', 'newsphere'),
        'section' => 'newsphere_popular_tags_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);

// Setting - number_of_slides.
$wp_customize->add_setting('show_popular_tags_title',
    array(
        'default' => $default['show_popular_tags_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('show_popular_tags_title',
    array(
        'label' => esc_html__('Section Title', 'newsphere'),
        'section' => 'newsphere_popular_tags_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'newsphere_popular_tags_section_status'

    )
);


//=================================
// Trending Posts Section.
//=================================
$wp_customize->add_section('newsphere_flash_posts_section_settings',
    array(
        'title' => esc_html__('Exclusive Posts', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);

$wp_customize->add_setting('show_flash_news_section',
    array(
        'default' => $default['show_flash_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_flash_news_section',
    array(
        'label' => esc_html__('Enable Exclusive Posts Section', 'newsphere'),
        'section' => 'newsphere_flash_posts_section_settings',
        'type' => 'checkbox',
        'priority' => 22,

    )
);

// Setting - number_of_slides.
$wp_customize->add_setting('flash_news_title',
    array(
        'default' => $default['flash_news_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('flash_news_title',
    array(
        'label' => esc_html__('Exclusive Story Title', 'newsphere'),
        'section' => 'newsphere_flash_posts_section_settings',
        'type' => 'text',
        'priority' => 23,
        'active_callback' => 'newsphere_flash_posts_section_status'

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_flash_news_category',
    array(
        'default' => $default['select_flash_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Newsphere_Dropdown_Taxonomies_Control($wp_customize, 'select_flash_news_category',
    array(
        'label' => esc_html__('Exclusive Posts Category', 'newsphere'),
        'description' => esc_html__('Posts to be shown on trending posts ', 'newsphere'),
        'section' => 'newsphere_flash_posts_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 23,
        'active_callback' => 'newsphere_flash_posts_section_status'
    )));




/**
 * Main Banner Slider Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_section_settings',
    array(
        'title' => esc_html__('Main Banner Section', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default' => $default['show_main_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label' => esc_html__('Enable Main Banner Section', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);



// Setting banner_advertisement_section.
$wp_customize->add_setting('main_banner_section_background_image',
    array(
        'default' => $default['main_banner_section_background_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'main_banner_section_background_image',
        array(
            'label' => esc_html__('Background image', 'newsphere'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'newsphere'), 1200, 720),
            'section' => 'frontpage_main_banner_section_settings',
            'width' => 1200,
            'height' => 720,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 100,
            'active_callback' => 'newsphere_main_banner_section_status'
        )
    )
);

// Disable main banner in blog
$wp_customize->add_setting('transparent_main_banner_boxes',
    array(
        'default' => $default['transparent_main_banner_boxes'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('transparent_main_banner_boxes',
    array(
        'label' => esc_html__('Transparent Main Banner Boxes', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status'
    )
);


//section title
$wp_customize->add_setting('vertical_slider_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'vertical_slider_section_title',
        array(
            'label' 			=> esc_html__( 'Vertical Slider Section ', 'newsphere' ),
            'section' 			=> 'frontpage_main_banner_section_settings',
            'priority' 			=> 100,
            'active_callback' => 'newsphere_main_banner_section_status',
        )
    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_vertical_slider_news_category',
    array(
        'default' => $default['select_vertical_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Newsphere_Dropdown_Taxonomies_Control($wp_customize, 'select_vertical_slider_news_category',
    array(
        'label' => esc_html__('Category', 'newsphere'),
        'description' => esc_html__('Posts to be shown on vertical slider section', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status',
    )));



//section title
$wp_customize->add_setting('main_slider_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'main_slider_section_title',
        array(
            'label' 			=> esc_html__( 'Main Slider Section ', 'newsphere' ),
            'section' 			=> 'frontpage_main_banner_section_settings',
            'priority' 			=> 100,
            'active_callback' => 'newsphere_main_banner_section_status'
        )
    )
);
// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default' => $default['select_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Newsphere_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label' => esc_html__('Category', 'newsphere'),
        'description' => esc_html__('Posts to be shown on main slider section', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status'
    )));



//section title
$wp_customize->add_setting('tabbed_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'tabbed_section_title',
        array(
            'label' 			=> esc_html__( 'Tabbed Section ', 'newsphere' ),
            'section' 			=> 'frontpage_main_banner_section_settings',
            'priority' 			=> 100,
            'active_callback' => 'newsphere_main_banner_section_status'
        )
    )
);

// Setting - featured_news_section_title.
$wp_customize->add_setting('latest_tab_title',
    array(
        'default' => $default['latest_tab_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('latest_tab_title',
    array(
        'label' => esc_html__('Latest Tab Title', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status',
    )
);

// Setting - featured_news_section_title.
$wp_customize->add_setting('popular_tab_title',
    array(
        'default' => $default['popular_tab_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('popular_tab_title',
    array(
        'label' => esc_html__('Popular Tab Title', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status',
    )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting('trending_tab_title',
    array(
        'default' => $default['trending_tab_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('trending_tab_title',
    array(
        'label' => esc_html__('Trending Tab Title', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status',
    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_tab_news_category',
    array(
        'default' => $default['select_trending_tab_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Newsphere_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_tab_news_category',
    array(
        'label' => esc_html__('Category', 'newsphere'),
        'description' => esc_html__('Posts to be shown on trending tab', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status'
    )));



// Disable main banner in blog
$wp_customize->add_setting('disable_main_banner_on_blog_archive',
    array(
        'default' => $default['disable_main_banner_on_blog_archive'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('disable_main_banner_on_blog_archive',
    array(
        'label' => esc_html__('Disable Main Banner section on Static Posts page', 'newsphere'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
        'active_callback' => 'newsphere_main_banner_section_status'
    )
);

/**
 * Featured News Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_featured_news_settings',
    array(
        'title' => esc_html__('Featured Section', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);

// Setting - show_featured_news_section.
$wp_customize->add_setting('show_featured_news_section',
    array(
        'default' => $default['show_featured_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_featured_news_section',
    array(
        'label' => esc_html__('Enable Featured Posts Section', 'newsphere'),
        'section' => 'frontpage_featured_news_settings',
        'type' => 'checkbox',
        'priority' => 24,


    )
);

// Setting - featured_news_section_title.
$wp_customize->add_setting('featured_news_section_title',
    array(
        'default' => $default['featured_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('featured_news_section_title',
    array(
        'label' => esc_html__('Featured Posts Section Title', 'newsphere'),
        'section' => 'frontpage_featured_news_settings',
        'type' => 'text',
        'priority' => 24,
        'active_callback' => 'newsphere_featured_news_section_status'

    )
);

// Setting - featured news category.
$wp_customize->add_setting('select_featured_news_category',
    array(
        'default' => $default['select_featured_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(new Newsphere_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_news_category',
    array(
        'label' => esc_html__('Featured Posts Category', 'newsphere'),
        'description' => esc_html__('Posts to be shown on featured section ', 'newsphere'),
        'section' => 'frontpage_featured_news_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 24,
        'active_callback' => 'newsphere_featured_news_section_status'
    )));


// Frontpage Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title' => esc_html__('Frontpage Layout Settings', 'newsphere'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_alignment',
    array(
        'default' => $default['frontpage_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('frontpage_content_alignment',
    array(
        'label' => esc_html__('Frontpage Content alignment', 'newsphere'),
        'description' => esc_html__('Select frontpage content alignment', 'newsphere'),
        'section' => 'frontpage_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Home Content - Home Sidebar', 'newsphere'),
            'align-content-right' => esc_html__('Home Sidebar - Home Content', 'newsphere'),
            'full-width-content' => esc_html__('Only Home Content', 'newsphere')
        ),
        'priority' => 10,
    ));

// Setting - frontpage_sticky_sidebar.
$wp_customize->add_setting('frontpage_sticky_sidebar',
    array(
        'default' => $default['frontpage_sticky_sidebar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('frontpage_sticky_sidebar',
    array(
        'label' => esc_html__('Make Frontpage Sidebar Sticky', 'newsphere'),
        'section' => 'frontpage_layout_settings',
        'type' => 'checkbox',
        'priority' => 24,
        'active_callback' => 'frontpage_content_alignment_status'
    )
);