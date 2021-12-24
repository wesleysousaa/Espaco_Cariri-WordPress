<?php

/**
 * Font and Color Option Panel
 *
 * @package Newsphere
 */

$default = newsphere_get_default_theme_options();

//section title
$wp_customize->add_setting('global_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'global_color_section_title',
        array(
            'label' => esc_html__('Global Color Section ', 'newsphere'),
            'section' => 'colors',
            'priority' => 5,
            'active_callback' => 'global_site_mode_status'
        )
    )
);


//section title
$wp_customize->add_setting('global_color_section_notice',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Simple_Notice_Custom_Control(
        $wp_customize,
        'global_color_section_notice',
        array(
            'description' => esc_html__('Background Color will not be applicable for this mode.', 'newsphere'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => 'global_site_mode_dark_light_status'
        )
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_site_mode_setting',
    array(
        'default' => $default['global_site_mode_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);

$wp_customize->add_control('global_site_mode_setting',
    array(
        'label' => esc_html__('Site Color Mode', 'newsphere'),
        'section' => 'colors',
        'type' => 'select',
        'choices' => array(
            'aft-default-mode' => esc_html__('Default', 'newsphere'),
            'aft-light-mode' => esc_html__('Light', 'newsphere'),
            'aft-dark-mode' => esc_html__('Dark', 'newsphere'),


        ),
        'priority' => 5,
    ));

// Setting - primary_color.
$wp_customize->add_setting('primary_color',
    array(
        'default' => $default['primary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'primary_color',
        array(
            'label' => esc_html__('Primary Color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 5,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - secondary_color.
$wp_customize->add_setting('secondary_color',
    array(
        'default' => $default['secondary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'secondary_color',
        array(
            'label' => esc_html__('Secondary Color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 5,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - primary_color.
$wp_customize->add_setting('site_wide_title_color',
    array(
        'default' => $default['site_wide_title_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'site_wide_title_color',
        array(
            'label' => esc_html__('Single Title Color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - secondary_color.
$wp_customize->add_setting('link_color',
    array(
        'default' => $default['link_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'link_color',
        array(
            'label' => esc_html__('General Link Color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);


// Setting - default color mode.
$wp_customize->add_setting('site_default_post_box_color',
    array(
        'default' => $default['site_default_post_box_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'site_default_post_box_color',
        array(
            'label' => esc_html__('Box color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);


// Setting - slider_caption_bg_color.
$wp_customize->add_setting('post_format_color',
    array(
        'default' => $default['post_format_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'post_format_color',
        array(
            'label' => esc_html__('Post Format Icon', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);


//section title
$wp_customize->add_setting('top_header_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'top_header_section_title',
        array(
            'label' => esc_html__('Top Header Section ', 'newsphere'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    newsphere_header_status($control)
                    &&
                    global_site_mode_status($control)
                );
            },

        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('top_header_background_color',
    array(
        'default' => $default['top_header_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'top_header_background_color',
        array(
            'label' => esc_html__('Background color', 'newsphere'),
            'section' => 'colors',
            'settings' => 'top_header_background_color',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    newsphere_header_status($control)
                    &&
                    global_site_mode_status($control)
                );
            },
        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('top_header_text_color',
    array(
        'default' => $default['top_header_text_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'top_header_text_color',
        array(
            'label' => esc_html__('Texts color', 'newsphere'),
            'section' => 'colors',
            'settings' => 'top_header_text_color',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    newsphere_header_status($control)
                    &&
                    global_site_mode_status($control)
                );
            },
        )
    )
);


//section title
$wp_customize->add_setting('main_navigation_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'main_navigation_section_title',
        array(
            'label' => esc_html__('Main Navigation Section ', 'newsphere'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_custom_background_color',
    array(
        'default' => $default['main_navigation_custom_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_custom_background_color',
        array(
            'label' => esc_html__('Background Color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_link_color',
    array(
        'default' => $default['main_navigation_link_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_link_color',
        array(
            'label' => esc_html__('Menu Item Color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_badge_background',
    array(
        'default' => $default['main_navigation_badge_background'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'active_callback' => 'global_site_mode_status'
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_badge_background',
        array(
            'label' => esc_html__('Badge Background', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_badge_color',
    array(
        'default' => $default['main_navigation_badge_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_badge_color',
        array(
            'label' => esc_html__('Badge Color', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);


//section title
$wp_customize->add_setting('background_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'background_color_section_title',
        array(
            'label' => esc_html__('Main Banner Section ', 'newsphere'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    newsphere_main_banner_section_status($control)
                    &&
                    global_site_mode_status($control)
                );
            },
        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('main_banner_section_background_color',
    array(
        'default' => $default['main_banner_section_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'main_banner_section_background_color',
        array(
            'label' => esc_html__('Background color', 'newsphere'),
            'section' => 'colors',
            'settings' => 'main_banner_section_background_color',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    newsphere_main_banner_section_status($control)
                    &&
                    global_site_mode_status($control)
                );
            },
        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('main_banner_section_secondary_background_color',
    array(
        'default' => $default['main_banner_section_secondary_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'main_banner_section_secondary_background_color',
        array(
            'label' => esc_html__('Foreground color', 'newsphere'),
            'section' => 'colors',
            'settings' => 'main_banner_section_secondary_background_color',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    newsphere_main_banner_section_status($control)
                    &&
                    global_site_mode_status($control)
                );
            },
        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('main_banner_section_texts_color',
    array(
        'default' => $default['main_banner_section_texts_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'main_banner_section_texts_color',
        array(
            'label' => esc_html__('Texts color', 'newsphere'),
            'section' => 'colors',
            'settings' => 'main_banner_section_texts_color',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    newsphere_main_banner_section_status($control)
                    &&
                    global_site_mode_status($control)
                );
            },
        )
    )
);

//section title
$wp_customize->add_setting('archive_widget_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'archive_widget_section_title',
        array(
            'label' => esc_html__('Archive/Widget Section ', 'newsphere'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);


// Setting - slider_caption_bg_color.
$wp_customize->add_setting('title_link_color',
    array(
        'default' => $default['title_link_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'title_link_color',
        array(
            'label' => esc_html__('Post Title', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('title_over_image_color',
    array(
        'default' => $default['title_over_image_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'title_over_image_color',
        array(
            'label' => esc_html__('Post Title Over Image', 'newsphere'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);

//section title
$wp_customize->add_setting('footer_mailchimp_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Newsphere_Section_Title(
        $wp_customize,
        'footer_mailchimp_section_title',
        array(
            'label' => esc_html__('Mailchimp Section ', 'newsphere'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => 'global_site_mode_status'
        )
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('footer_mailchimp_background_color',
    array(
        'default' => $default['footer_mailchimp_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_mailchimp_background_color',
        array(
            'label' => esc_html__('Background color', 'newsphere'),
            'section' => 'colors',
            'settings' => 'footer_mailchimp_background_color',
            'priority' => 10,
            'active_callback' => 'newsphere_mailchimp_subscriptions_status'

        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('footer_mailchimp_text_color',
    array(
        'default' => $default['footer_mailchimp_text_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_mailchimp_text_color',
        array(
            'label' => esc_html__('Title color', 'newsphere'),
            'section' => 'colors',
            'settings' => 'footer_mailchimp_text_color',
            'priority' => 10,
            'active_callback' => 'newsphere_mailchimp_subscriptions_status'

        )
    )
);



//========== category colors  options ===============

// Single Section.
$wp_customize->add_section('site_category_color_settings',
    array(
        'title' => esc_html__('Category Colors', 'newsphere'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


for ($i = 1; $i <= 7; $i++) {
// Setting - slider_caption_bg_color.
    $wp_customize->add_setting('category_color_' . $i,
        array(
            'default' => $default['category_color_' . $i],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'category_color_' . $i,
            array(
                'label' => sprintf(__('Category %d Background Color', 'newsphere'), $i),
                'section' => 'site_category_color_settings',
                'type' => 'color',
                'priority' => 100,
            )
        )
    );


}

//============= Font Options ===================
// font Section.
$wp_customize->add_section('font_typo_section',
    array(
        'title' => esc_html__('Fonts & Typography', 'newsphere'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

global $newsphere_google_fonts;


// Setting - primary_font.
$wp_customize->add_setting('primary_font',
    array(
        'default' => $default['primary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);
$wp_customize->add_control('primary_font',
    array(
        'label' => esc_html__('Primary Font', 'newsphere'),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $newsphere_google_fonts,
        'priority' => 100,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('secondary_font',
    array(
        'default' => $default['secondary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsphere_sanitize_select',
    )
);
$wp_customize->add_control('secondary_font',
    array(
        'label' => esc_html__('Secondary Font', 'newsphere'),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $newsphere_google_fonts,
        'priority' => 110,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('letter_spacing',
    array(
        'default' => $default['letter_spacing'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('letter_spacing',
    array(
        'label' => esc_html__('Global Letter Spacing', 'newsphere'),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('line_height',
    array(
        'default' => $default['line_height'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('line_height',
    array(
        'label' => esc_html__('Global Line height', 'newsphere'),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);


// Setting - secondary_font.
$wp_customize->add_setting('main_banner_silder_caption_font_size',
    array(
        'default' => $default['main_banner_silder_caption_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_banner_silder_caption_font_size',
    array(
        'label' => esc_html__('Main Banner Slider Caption Size', 'newsphere'),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);


// Setting - secondary_font.
$wp_customize->add_setting('newsphere_section_title_font_size',
    array(
        'default' => $default['newsphere_section_title_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('newsphere_section_title_font_size',
    array(
        'label' => esc_html__('Global Section Title Size', 'newsphere'),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);


// Setting - secondary_font.
$wp_customize->add_setting('newsphere_page_posts_title_font_size',
    array(
        'default' => $default['newsphere_page_posts_title_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('newsphere_page_posts_title_font_size',
    array(
        'label' => esc_html__('Page/Posts Title Size', 'newsphere'),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

