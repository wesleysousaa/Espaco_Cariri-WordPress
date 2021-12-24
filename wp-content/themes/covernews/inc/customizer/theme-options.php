<?php

/**
 * Option Panel
 *
 * @package CoverNews
 */

$default = covernews_get_default_theme_options();
/*theme option panel info*/
require get_template_directory().'/inc/customizer/frontpage-options.php';



// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
	array(
		'title'      => esc_html__('Theme Options', 'covernews'),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);


// Preloader Section.
$wp_customize->add_section('site_preloader_settings',
    array(
        'title'      => esc_html__('Preloader Options', 'covernews'),
        'priority'   => 4,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - preloader.
$wp_customize->add_setting('enable_site_preloader',
    array(
        'default'           => $default['enable_site_preloader'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_site_preloader',
    array(
        'label'    => esc_html__('Enable preloader', 'covernews'),
        'section'  => 'site_preloader_settings',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);


/**
 * Header section
 *
 * @package CoverNews
 */

// Frontpage Section.
$wp_customize->add_section('header_options_settings',
	array(
		'title'      => esc_html__('Header Options', 'covernews'),
		'priority'   => 49,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting - show_site_title_section.
$wp_customize->add_setting('show_date_section',
    array(
        'default'           => $default['show_date_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_date_section',
    array(
        'label'    => esc_html__('Show date on top header', 'covernews'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'covernews_top_header_status'
    )
);



// Setting - show_site_title_section.
$wp_customize->add_setting('show_social_menu_section',
    array(
        'default'           => $default['show_social_menu_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_social_menu_section',
    array(
        'label'    => esc_html__('Show social menu on top header', 'covernews'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 11,
        //'active_callback' => 'covernews_top_header_status'
    )
);



// Setting - sticky_header_option.
$wp_customize->add_setting('disable_sticky_header_option',
    array(
        'default'           => $default['disable_sticky_header_option'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);
$wp_customize->add_control('disable_sticky_header_option',
    array(
        'label'    => esc_html__('Disable Sticky Header', 'covernews'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 11,
        //'active_callback' => 'storecommerce_header_layout_status'
    )
);

// Breadcrumb Section.
$wp_customize->add_section('site_breadcrumb_settings',
    array(
        'title'      => esc_html__('Breadcrumb Options', 'covernews'),
        'priority'   => 49,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - breadcrumb.
$wp_customize->add_setting('enable_breadcrumb',
    array(
        'default'           => $default['enable_breadcrumb'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_breadcrumb',
    array(
        'label'    => esc_html__('Show breadcrumbs', 'covernews'),
        'section'  => 'site_breadcrumb_settings',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);



/**
 * Layout options section
 *
 * @package CoverNews
 */

// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title'      => esc_html__('Global Settings', 'covernews'),
        'priority'   => 9,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_content_alignment',
    array(
        'default'           => $default['global_content_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'global_content_alignment',
    array(
        'label'       => esc_html__('Content Alignment', 'covernews'),
        'description' => esc_html__('Select global content alignment', 'covernews'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'align-content-left' => esc_html__( 'Content - Primary sidebar', 'covernews' ),
            'align-content-right' => esc_html__( 'Primary sidebar - Content', 'covernews' ),
            'full-width-content' => esc_html__( 'Full width content', 'covernews' )
        ),
        'priority'    => 130,
    ));


// Setting - global content alignment of news.
$wp_customize->add_setting('global_single_content_mode',
    array(
        'default'           => $default['global_single_content_mode'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'global_single_content_mode',
    array(
        'label'       => esc_html__('Single Content mode', 'covernews'),
        'description' => esc_html__('Select global single content mode', 'covernews'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'single-content-mode-default' => esc_html__( 'Wide - Default', 'covernews' ),
            'single-content-mode-boxed' => esc_html__( 'Boxed', 'covernews' ),
        ),
        'priority'    => 130,
    ));


// Setting - global content alignment of news.
$wp_customize->add_setting('global_post_date_author_setting',
    array(
        'default'           => $default['global_post_date_author_setting'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'global_post_date_author_setting',
    array(
        'label'       => esc_html__('Date and Author Display', 'covernews'),
        'description' => esc_html__('Select date and author display settings below post title', 'covernews'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'show-date-author' => esc_html__( 'Show Date and Author', 'covernews' ),
            'show-date-only' => esc_html__( 'Show Date Only', 'covernews' ),
            'show-author-only' => esc_html__( 'Show Author Only', 'covernews' ),
            'hide-date-author' => esc_html__( 'Hide All', 'covernews' ),
        ),
        'priority'    => 130,
    ));

// Setting - global content alignment of news.
$wp_customize->add_setting('global_widget_excerpt_setting',
    array(
        'default'           => $default['global_widget_excerpt_setting'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'global_widget_excerpt_setting',
    array(
        'label'       => esc_html__('Widget Excerpt Mode', 'covernews'),
        'description' => esc_html__('Select Widget Excerpt display mode', 'covernews'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'trimmed-content' => esc_html__( 'Trimmed Content', 'covernews' ),
            'default-excerpt' => esc_html__( 'Default Excerpt', 'covernews' ),

        ),
        'priority'    => 130,
    ));


// Setting - global content alignment of news.
$wp_customize->add_setting('global_date_display_setting',
    array(
        'default'           => $default['global_date_display_setting'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'global_date_display_setting',
    array(
        'label'       => esc_html__('Date Display Format', 'covernews'),
        'description' => esc_html__('Select date display display format', 'covernews'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'theme-date' => esc_html__( 'Date Format by Theme', 'covernews' ),
            'default-date' => esc_html__( 'WordPress Default Date Format', 'covernews' ),

        ),
        'priority'    => 130,
    ));


// Setting - related posts.
$wp_customize->add_setting('single_show_featured_image',
    array(
        'default'           => $default['single_show_featured_image'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control( 'single_show_featured_image',
    array(
        'label'    => __( 'Show Featured Image in single post', 'covernews' ),
        'section'  => 'site_layout_settings',
        'type'     => 'checkbox',
        'priority' => 130,
    )
);

/**
 * Archive options section
 *
 * @package CoverNews
 */

// Archive Section.
$wp_customize->add_section('site_archive_settings',
    array(
        'title'      => esc_html__('Archive Settings', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

 //Setting - archive content view of news.
$wp_customize->add_setting('archive_layout',
    array(
        'default'           => $default['archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_layout',
    array(
        'label'       => esc_html__('Archive layout', 'covernews'),
        'description' => esc_html__('Select layout for archive', 'covernews'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-layout-full' => esc_html__( 'Full', 'covernews' ),
            'archive-layout-grid' => esc_html__( 'Grid', 'covernews' ),
        ),
        'priority'    => 130,
    ));

// Setting - archive content view of news.
$wp_customize->add_setting('archive_image_alignment',
    array(
        'default'           => $default['archive_image_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_image_alignment',
    array(
        'label'       => esc_html__('Image alignment', 'covernews'),
        'description' => esc_html__('Select image alignment for archive', 'covernews'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-image-left' => esc_html__( 'Left', 'covernews' ),
            'archive-image-right' => esc_html__( 'Right', 'covernews' )
        ),
        'priority'    => 130,
        'active_callback' => 'covernews_archive_image_status'
    ));

 //Setting - archive content view of news.
$wp_customize->add_setting('archive_content_view',
    array(
        'default'           => $default['archive_content_view'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_content_view',
    array(
        'label'       => esc_html__('Content view', 'covernews'),
        'description' => esc_html__('Select content view for archive', 'covernews'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-content-excerpt' => esc_html__( 'Post excerpt', 'covernews' ),
            'archive-content-full' => esc_html__( 'Full Content', 'covernews' ),
            'archive-content-none' => esc_html__( 'None', 'covernews' ),

        ),
        'priority'    => 130,
    ));


//========== related posts  options ===============

// Single Section.
$wp_customize->add_section('site_single_related_posts_settings',
    array(
        'title'      => esc_html__('Related Posts', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_related_posts',
    array(
        'default'           => $default['single_show_related_posts'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control( 'single_show_related_posts',
    array(
        'label'    => __( 'Show on single posts', 'covernews' ),
        'section'  => 'site_single_related_posts_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_related_posts_title',
    array(
        'default'           => $default['single_related_posts_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'single_related_posts_title',
    array(
        'label'    => __( 'Title', 'covernews' ),
        'section'  => 'site_single_related_posts_settings',
        'type'     => 'text',
        'priority' => 100,
        'active_callback' => 'covernews_related_posts_status'
    )
);




//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section('frontpage_latest_posts_settings',
    array(
        'title'      => esc_html__('Latest Posts Options', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);
// Setting - latest blog carousel.
$wp_customize->add_setting('frontpage_show_latest_posts',
    array(
        'default'           => $default['frontpage_show_latest_posts'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'covernews_sanitize_checkbox',
    )
);

$wp_customize->add_control( 'frontpage_show_latest_posts',
    array(
        'label'    => __( 'Show Latest Posts Section above Footer', 'covernews' ),
        'section'  => 'frontpage_latest_posts_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting('frontpage_latest_posts_section_title',
    array(
        'default'           => $default['frontpage_latest_posts_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_latest_posts_section_title',
    array(
        'label'    => esc_html__('Latest Posts Section Title', 'covernews'),
        'section'  => 'frontpage_latest_posts_settings',
        'type'     => 'text',
        'priority' => 100,
        'active_callback' => 'covernews_latest_news_section_status'

    )
);


//========== footer section options ===============
// Footer Section.
$wp_customize->add_section('site_footer_settings',
    array(
        'title'      => esc_html__('Footer', 'covernews'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('footer_copyright_text',
    array(
        'default'           => $default['footer_copyright_text'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'footer_copyright_text',
    array(
        'label'    => __( 'Copyright Text', 'covernews' ),
        'section'  => 'site_footer_settings',
        'type'     => 'text',
        'priority' => 100,
    )
);

