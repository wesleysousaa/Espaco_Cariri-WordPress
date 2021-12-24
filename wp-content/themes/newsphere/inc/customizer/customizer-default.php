<?php
/**
 * Default theme options.
 *
 * @package Newsphere
 */

if (!function_exists('newsphere_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function newsphere_get_default_theme_options() {

    $defaults = array();

    $defaults['site_title_font_size']    = 42;
    // Preloader options section
    $defaults['enable_site_preloader'] = 1;

    // Header options section
    $defaults['header_layout'] = 'header-layout-1';

    $defaults['show_top_header_section'] = 0;
    $defaults['top_header_background_color'] = "#1c1c1c";
    $defaults['top_header_text_color'] = "#ffffff";

    $defaults['show_top_menu'] = 1;
    $defaults['show_social_menu_section'] = 1;
    $defaults['enable_sticky_header_option'] = 0;
    
    $defaults['show_date_section'] = 1;
    $defaults['show_minicart_section'] = 1;

    $defaults['disable_header_image_tint_overlay'] = 0;
    $defaults['show_offpanel_menu_section'] = 1;


    $defaults['banner_advertisement_section'] = '';
    $defaults['banner_advertisement_section_url'] = '';
    $defaults['banner_advertisement_open_on_new_tab'] = 1;
    $defaults['banner_advertisement_scope'] = 'front-page-only';


    // breadcrumb options section
    $defaults['enable_breadcrumb'] = 1;
    $defaults['select_breadcrumb_mode'] = 'simple';


    // Frontpage Section.

    $defaults['show_popular_tags_section'] = 1;
    $defaults['show_popular_tags_title'] = __('Popular Tags', 'newsphere');
    $defaults['number_of_popular_tags'] = 7;
    $defaults['select_popular_tags_mode'] = 'post_tag';

    $defaults['show_flash_news_section'] = 1;
    $defaults['flash_news_title'] = __('Exclusive', 'newsphere');
    $defaults['select_flash_news_category'] = 0;
    $defaults['number_of_flash_news'] = 5;
    $defaults['select_flash_new_mode'] = 'flash-slide-left';
    $defaults['banner_flash_news_scope'] = 'front-page-only';

    $defaults['show_main_news_section'] = 1;

    $defaults['select_main_banner_section_mode'] = 'default';
    $defaults['select_vertical_slider_news_category'] = 0;
    $defaults['vertical_slider_number_of_slides'] = 5;
    $defaults['select_slider_news_category'] = 0;
    $defaults['select_tabbed_thumbs_section_mode'] = 'tabbed';
    $defaults['select_tab_section_mode'] = 'default';
    $defaults['latest_tab_title'] = __("Latest", 'newsphere');
    $defaults['popular_tab_title'] = __("Popular", 'newsphere');
    $defaults['trending_tab_title'] = __("Trending", 'newsphere');
    $defaults['select_trending_tab_news_category'] = 0;
    $defaults['select_thumbs_news_category'] = 0;

    $defaults['main_banner_section_background_color'] = '#1c1c1c';
    $defaults['main_banner_section_secondary_background_color'] = '#212121';
    $defaults['main_banner_section_texts_color'] = '#ffffff';
    $defaults['main_banner_section_background_image'] = 0;
    $defaults['transparent_main_banner_boxes'] = 0;
    $defaults['number_of_slides'] = 5;

    $defaults['editors_picks_title'] = __("Editor's Picks", 'newsphere');
    $defaults['select_editors_picks_category'] = 0;

    $defaults['trending_slider_title'] = __("Trending Story", 'newsphere');
    $defaults['select_trending_news_category'] = 0;
    $defaults['number_of_trending_slides'] = 5;

    $defaults['show_featured_news_section'] = 1;
    $defaults['featured_news_section_title'] = __('Featured Story', 'newsphere');
    $defaults['select_featured_news_category'] = 0;
    $defaults['number_of_featured_news'] = 6;


    $defaults['show_editors_pick_section'] = 1;
    $defaults['editors_pick_section_title'] = __("Editor's Pick", 'newsphere');
    $defaults['select_editors_pick_category'] = 0;
    $defaults['number_of_editors_pick_news'] = 4;

    $defaults['frontpage_content_alignment'] = 'align-content-left';
    $defaults['frontpage_sticky_sidebar'] = 1;

    //layout options
    $defaults['global_content_layout'] = 'default-content-layout';
    $defaults['global_content_alignment'] = 'align-content-left';
    $defaults['global_image_alignment'] = 'full-width-image';
    $defaults['global_post_date_author_setting'] = 'show-date-author';
    $defaults['global_hide_post_date_author_in_list'] = 1;
    $defaults['global_excerpt_length'] = 20;
    $defaults['global_read_more_texts'] = __('Read more', 'newsphere');
    $defaults['global_widget_excerpt_setting'] = 'trimmed-content';
    $defaults['global_date_display_setting'] = 'theme-date';

    $defaults['archive_layout'] = 'archive-layout-list';
    $defaults['archive_pagination_view'] = 'archive-default';
    $defaults['archive_image_alignment_grid'] = 'archive-image-default';
    $defaults['archive_image_alignment_list'] = 'archive-image-left';
    $defaults['archive_image_alignment'] = 'archive-image-default';
    $defaults['archive_content_view'] = 'archive-content-excerpt';
    $defaults['disable_main_banner_on_blog_archive'] = 0;


    //Related posts
    $defaults['single_show_featured_image'] = 1;
    $defaults['single_post_featured_image_view']     = 'default';


    //Related posts
    $defaults['single_show_related_posts'] = 1;
    $defaults['single_related_posts_title']     = __( 'More Stories', 'newsphere' );
    $defaults['single_number_of_related_posts']  = 3;

    //Pagination.
    $defaults['site_pagination_type'] = 'default';

    // Footer.
    // Latest posts
    $defaults['frontpage_show_latest_posts'] = 1;
    $defaults['frontpage_latest_posts_section_title'] = __('You may have missed', 'newsphere');
    $defaults['frontpage_latest_posts_category'] = 0;
    $defaults['number_of_frontpage_latest_posts'] = 4;


    $defaults['footer_copyright_text'] = esc_html__('Copyright &copy; All rights reserved.', 'newsphere');
    $defaults['hide_footer_menu_section']  = 0;
    $defaults['number_of_footer_widget']  = 3;

    $defaults['global_show_home_menu']           = 'yes';
    $defaults['global_show_comment_count']           = 'yes';
    $defaults['global_hide_comment_count_in_list']   = 1;
    $defaults['global_show_min_read']           = 'yes';
    $defaults['global_hide_min_read_in_list']   = 1;
    $defaults['global_show_min_read_number']   = 250;
    $defaults['aft_language_switcher']           = '';
    $defaults['global_show_categories']           = 'yes';
    $defaults['global_show_home_menu_border']    = 'show-menu-border';
    $defaults['global_site_mode_setting']    = 'aft-default-mode';


    // Pass through filter.
    $defaults = apply_filters('newsphere_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
