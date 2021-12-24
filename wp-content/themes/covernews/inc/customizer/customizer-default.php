<?php
/**
 * Default theme options.
 *
 * @package CoverNews
 */

if (!function_exists('covernews_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function covernews_get_default_theme_options() {

    $defaults = array();
    // Preloader options section
    $defaults['enable_site_preloader'] = 1;

    // Header options section
    $defaults['header_layout'] = 'header-layout-1';

    $defaults['show_top_header_section'] = 0;
    $defaults['top_header_background_color'] = "#353535";
    $defaults['top_header_text_color'] = "#ffffff";

    $defaults['show_top_menu'] = 0;
    $defaults['show_social_menu_section'] = 0;
    $defaults['disable_sticky_header_option'] = 0;
    
    $defaults['show_date_section'] = 0;
    $defaults['show_minicart_section'] = 1;

    $defaults['disable_header_image_tint_overlay'] = 0;
    $defaults['show_offpanel_menu_section'] = 1;


    $defaults['banner_advertisement_section'] = '';
    $defaults['banner_advertisement_section_url'] = '';
    $defaults['banner_advertisement_open_on_new_tab'] = 1;
    $defaults['banner_advertisement_scope'] = 'front-page-only';

    // breadcrumb options section
    $defaults['enable_breadcrumb'] = 0;
    $defaults['select_breadcrumb_mode'] = 'simple';

    // Frontpage Section
    $defaults['show_flash_news_section'] = 1;
    $defaults['flash_news_title'] = __('Flash Story', 'covernews');
    $defaults['select_flash_news_category'] = 0;
    $defaults['number_of_flash_news'] = 5;

    $defaults['show_main_news_section'] = 1;

    $defaults['main_news_slider_title'] = __('Main Story', 'covernews');
    $defaults['select_slider_news_category'] = 0;
    $defaults['select_main_banner_section_mode'] = 'slider-editors-picks-trending';
    $defaults['number_of_slides'] = 5;

    $defaults['editors_picks_title'] = __("Editor's Picks", 'covernews');
    $defaults['select_editors_picks_category'] = 0;

    $defaults['trending_slider_title'] = __("Trending Story", 'covernews');
    $defaults['select_trending_news_category'] = 0;
    $defaults['number_of_trending_slides'] = 5;

    $defaults['show_featured_news_section'] = 1;
    $defaults['featured_news_section_title'] = __('Featured Story', 'covernews');
    $defaults['select_featured_news_category'] = 0;
    $defaults['number_of_featured_news'] = 5;

    $defaults['frontpage_content_alignment'] = 'align-content-left';
    $defaults['frontpage_sticky_sidebar'] = 1;

    //layout options
    $defaults['global_content_layout'] = 'default-content-layout';
    $defaults['global_content_alignment'] = 'align-content-left';
    $defaults['global_single_content_mode'] = 'single-content-mode-default';
    $defaults['global_image_alignment'] = 'full-width-image';
    $defaults['global_post_date_author_setting'] = 'show-date-author';
    $defaults['global_excerpt_length'] = 20;
    $defaults['global_read_more_texts'] = __('Read more', 'covernews');
    $defaults['global_widget_excerpt_setting'] = 'trimmed-content';
    $defaults['global_date_display_setting'] = 'theme-date';
    $defaults['single_show_featured_image'] = 1;

    $defaults['archive_layout'] = 'archive-layout-grid';
    $defaults['archive_image_alignment'] = 'archive-image-left';
    $defaults['archive_content_view'] = 'archive-content-excerpt';
    $defaults['disable_main_banner_on_blog_archive'] = 0;

    //Related posts
    $defaults['single_show_related_posts'] = 0;
    $defaults['single_related_posts_title']     = __( 'More Stories', 'covernews' );

    //Pagination.
    $defaults['site_pagination_type'] = 'default';

    // Footer.
    // Latest posts
    $defaults['frontpage_show_latest_posts'] = 1;
    $defaults['frontpage_latest_posts_section_title'] = __('You may have missed', 'covernews');

    $defaults['site_title_font_size']    = 48;
    $defaults['footer_copyright_text'] = esc_html__('Copyright &copy; All rights reserved.', 'covernews');
    $defaults['hide_footer_menu_section']  = 0;

    // Pass through filter.
    $defaults = apply_filters('covernews_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
