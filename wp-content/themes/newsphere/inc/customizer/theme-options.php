<?php

/**
 * Option Panel
 *
 * @package Newsphere
 */

$default = newsphere_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/customizer/frontpage-options.php';

// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
    array(
        'title' => esc_html__('Theme Options', 'newsphere'),
        'priority' => 200,
        'capability' => 'edit_theme_options',
    )
);


// Preloader Section.
$wp_customize->add_section('site_preloader_settings',
    array(
        'title' => esc_html__('Preloader Options', 'newsphere'),
        'priority' => 4,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - preloader.
$wp_customize->add_setting('enable_site_preloader',
    array(
        'default' => $default['enable_site_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_site_preloader',
    array(
        'label' => esc_html__('Enable preloader', 'newsphere'),
        'section' => 'site_preloader_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);


/**
 * Header section
 *
 * @package Newsphere
 */

// Frontpage Section.
$wp_customize->add_section('header_options_settings',
    array(
        'title' => esc_html__('Header Options', 'newsphere'),
        'priority' => 49,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('show_date_section',
    array(
        'default' => $default['show_date_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_date_section',
    array(
        'label' => esc_html__('Show date on top header', 'newsphere'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'newsphere_top_header_status'
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('show_social_menu_section',
    array(
        'default' => $default['show_social_menu_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_social_menu_section',
    array(
        'label' => esc_html__('Show social menu on top header', 'newsphere'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 11,
        //'active_callback' => 'newsphere_top_header_status'
    )
);


// Setting - breadcrumb.
$wp_customize->add_setting('enable_breadcrumb',
    array(
        'default' => $default['enable_breadcrumb'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_breadcrumb',
    array(
        'label' => esc_html__('Show breadcrumbs', 'newsphere'),
        'section' => 'site_layout_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);


// Setting - sticky_header_option.
$wp_customize->add_setting('enable_sticky_header_option',
    array(
        'default' => $default['enable_sticky_header_option'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);
$wp_customize->add_control('enable_sticky_header_option',
    array(
        'label' => esc_html__('Enable Sticky Header', 'newsphere'),
        'section' => 'site_layout_settings',
        'type' => 'checkbox',
        'priority' => 11,
        //'active_callback' => 'newsphere_header_layout_status'
    )
);


/**
 * Layout options section
 *
 * @package Newsphere
 */

// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title' => esc_html__('Global Settings', 'newsphere'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - sticky_header_option.
$wp_customize->add_setting('aft_language_switcher',
    array(
        'default' => $default['aft_language_switcher'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('aft_language_switcher',
    array(
        'label' => esc_html__('Language Switcher Shortcode', 'newsphere'),
        'section' => 'site_layout_settings',
        'type' => 'text',
        'priority' => 130,
        //'active_callback' => 'newsphere_header_layout_status'
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_content_alignment',
    array(
        'default' => $default['global_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('global_content_alignment',
    array(
        'label' => esc_html__('Global Content Alignment', 'newsphere'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Content - Primary sidebar', 'newsphere'),
            'align-content-right' => esc_html__('Primary sidebar - Content', 'newsphere'),
            'full-width-content' => esc_html__('Full width content', 'newsphere')
        ),
        'priority' => 130,
    ));

// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_categories',
    array(
        'default' => $default['global_show_categories'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('global_show_categories',
    array(
        'label' => esc_html__('Post Categories', 'newsphere'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'newsphere'),
            'no' => esc_html__('Hide', 'newsphere'),

        ),
        'priority' => 130,
    ));


//========== comment count options ===============

// Global Section.
$wp_customize->add_section('site_comment_count_settings',
    array(
        'title' => esc_html__('Comment Count', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_comment_count',
    array(
        'default' => $default['global_show_comment_count'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('global_show_comment_count',
    array(
        'label' => esc_html__('Comment Count', 'newsphere'),
        'section' => 'site_comment_count_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'newsphere'),
            'no' => esc_html__('Hide', 'newsphere'),

        ),
        'priority' => 130,
    ));


// Setting - sticky_header_option.
$wp_customize->add_setting('global_hide_comment_count_in_list',
    array(
        'default' => $default['global_hide_comment_count_in_list'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);
$wp_customize->add_control('global_hide_comment_count_in_list',
    array(
        'label' => esc_html__('Hide Comment Count in List', 'newsphere'),
        'section' => 'site_comment_count_settings',
        'type' => 'checkbox',
        'priority' => 130,
        'active_callback' => 'newsphere_global_show_comment_count_status'
    )
);


//========== minutes read count options ===============

// Global Section.
$wp_customize->add_section('site_min_read_settings',
    array(
        'title' => esc_html__('Minutes Read Count', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_min_read',
    array(
        'default' => $default['global_show_min_read'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('global_show_min_read',
    array(
        'label' => esc_html__('Minutes Read Count', 'newsphere'),
        'section' => 'site_min_read_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'newsphere'),
            'no' => esc_html__('Hide', 'newsphere'),

        ),
        'priority' => 130,
    ));

// Setting - sticky_header_option.
$wp_customize->add_setting('global_show_min_read_number',
    array(
        'default' => $default['global_show_min_read_number'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('global_show_min_read_number',
    array(
        'label' => esc_html__('Number of Words per Minute Read', 'newsphere'),
        'section' => 'site_min_read_settings',
        'type' => 'number',
        'priority' => 130,
        'active_callback' => 'newsphere_global_show_minutes_count_status'
    )
);

// Setting - sticky_header_option.
$wp_customize->add_setting('global_hide_min_read_in_list',
    array(
        'default' => $default['global_hide_min_read_in_list'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);
$wp_customize->add_control('global_hide_min_read_in_list',
    array(
        'label' => esc_html__('Hide Minutes Read Count in List', 'newsphere'),
        'section' => 'site_min_read_settings',
        'type' => 'checkbox',
        'priority' => 130,
        'active_callback' => 'newsphere_global_show_minutes_count_status'
    )
);


//========== date and author options ===============

// Global Section.
$wp_customize->add_section('site_post_date_author_settings',
    array(
        'title' => esc_html__('Date and Author', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_post_date_author_setting',
    array(
        'default' => $default['global_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);


$wp_customize->add_control('global_post_date_author_setting',
    array(
        'label' => esc_html__('Date and Author', 'newsphere'),
        'section' => 'site_post_date_author_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'newsphere'),
            'show-date-only' => esc_html__('Show Date Only', 'newsphere'),
            'show-author-only' => esc_html__('Show Author Only', 'newsphere'),
            'hide-date-author' => esc_html__('Hide All', 'newsphere'),
        ),
        'priority' => 130,
    ));


// Setting - sticky_header_option.
$wp_customize->add_setting('global_hide_post_date_author_in_list',
    array(
        'default' => $default['global_hide_post_date_author_in_list'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);
$wp_customize->add_control('global_hide_post_date_author_in_list',
    array(
        'label' => esc_html__('Hide Date and Author in List', 'newsphere'),
        'section' => 'site_post_date_author_settings',
        'type' => 'checkbox',
        'priority' => 130,
        'active_callback' => 'newsphere_display_date_author_status'
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_date_display_setting',
    array(
        'default' => $default['global_date_display_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('global_date_display_setting',
    array(
        'label' => esc_html__('Date Format', 'newsphere'),
        'section' => 'site_post_date_author_settings',
        'type' => 'select',
        'choices' => array(
            'theme-date' => esc_html__('Date Format by Theme', 'newsphere'),
            'default-date' => esc_html__('WordPress Default Date Format', 'newsphere'),

        ),
        'priority' => 130,
        'active_callback' => 'newsphere_display_date_status'
    ));

// Setting - global content alignment of news.
$wp_customize->add_setting('global_widget_excerpt_setting',
    array(
        'default' => $default['global_widget_excerpt_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('global_widget_excerpt_setting',
    array(
        'label' => esc_html__('Widget Excerpt Mode', 'newsphere'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'trimmed-content' => esc_html__('Trimmed Content', 'newsphere'),
            'default-excerpt' => esc_html__('Default Excerpt', 'newsphere'),

        ),
        'priority' => 130,
    ));



//========== single posts options ===============

// Single Section.
$wp_customize->add_section('site_single_posts_settings',
    array(
        'title' => esc_html__('Single Post', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_featured_image',
    array(
        'default' => $default['single_show_featured_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('single_show_featured_image',
    array(
        'label' => __('Show on featured image', 'newsphere'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


//========== related posts  options ===============

// Single Section.
$wp_customize->add_section('site_single_related_posts_settings',
    array(
        'title' => esc_html__('Related Posts', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_related_posts',
    array(
        'default' => $default['single_show_related_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('single_show_related_posts',
    array(
        'label' => __('Show on single posts', 'newsphere'),
        'section' => 'site_single_related_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_related_posts_title',
    array(
        'default' => $default['single_related_posts_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('single_related_posts_title',
    array(
        'label' => __('Title', 'newsphere'),
        'section' => 'site_single_related_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'newsphere_related_posts_status'
    )
);



/**
 * Archive options section
 *
 * @package Newsphere
 */

// Archive Section.
$wp_customize->add_section('site_archive_settings',
    array(
        'title' => esc_html__('Archive Settings', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - archive content view of news.
$wp_customize->add_setting('archive_image_alignment_list',
    array(
        'default' => $default['archive_image_alignment_list'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('archive_image_alignment_list',
    array(
        'label' => esc_html__('Image alignment', 'newsphere'),
        'description' => esc_html__('Select image alignment for archive', 'newsphere'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-image-left' => esc_html__('Left', 'newsphere'),
            'archive-image-right' => esc_html__('Right', 'newsphere'),
            'archive-image-alternate' => esc_html__('Alternate', 'newsphere'),
        ),
        'priority' => 130,
        //'active_callback' => 'newsphere_archive_image_status'
    ));

//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section('frontpage_latest_posts_settings',
    array(
        'title' => esc_html__('You May Have Missed', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);
// Setting - latest blog carousel.
$wp_customize->add_setting('frontpage_show_latest_posts',
    array(
        'default' => $default['frontpage_show_latest_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_checkbox',
    )
);

$wp_customize->add_control('frontpage_show_latest_posts',
    array(
        'label' => __('Show Latest Posts Section above Footer', 'newsphere'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting('frontpage_latest_posts_section_title',
    array(
        'default' => $default['frontpage_latest_posts_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_latest_posts_section_title',
    array(
        'label' => esc_html__('Posts Section Title', 'newsphere'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'newsphere_latest_news_section_status'

    )
);




//========== footer section options ===============
// Footer Section.
$wp_customize->add_section('site_footer_settings',
    array(
        'title' => esc_html__('Footer', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('footer_copyright_text',
    array(
        'default' => $default['footer_copyright_text'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('footer_copyright_text',
    array(
        'label' => __('Copyright Text', 'newsphere'),
        'section' => 'site_footer_settings',
        'type' => 'text',
        'priority' => 100,
    )
);


