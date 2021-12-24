<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Newsphere
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function newsphere_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }


    $global_site_mode_setting = newsphere_get_option('global_site_mode_setting');
    $classes[] = $global_site_mode_setting;


    $single_post_featured_image_view = newsphere_get_option('single_post_featured_image_view');
    if ($single_post_featured_image_view == 'full') {
        $classes[] = 'aft-single-full-header';
    }

    $global_hide_comment_count_in_list = newsphere_get_option('global_hide_comment_count_in_list');
    if ($global_hide_comment_count_in_list == true) {
        $classes[] = 'aft-hide-comment-count-in-list';
    }

    $global_hide_min_read_in_list = newsphere_get_option('global_hide_min_read_in_list');
    if ($global_hide_min_read_in_list == true) {
        $classes[] = 'aft-hide-minutes-read-in-list';
    }


    $global_hide_post_date_author_in_list = newsphere_get_option('global_hide_post_date_author_in_list');
    if ($global_hide_post_date_author_in_list == true) {
        $classes[] = 'aft-hide-date-author-in-list';
    }

    $transparent_main_banner_boxes = newsphere_get_option('transparent_main_banner_boxes');
    if ($transparent_main_banner_boxes == true) {
        $classes[] = 'aft-transparent-main-banner-box';
    }

    global $post;

    $global_layout = newsphere_get_option('global_content_layout');
    if (!empty($global_layout)) {
        $classes[] = $global_layout;
    }


    $global_alignment = newsphere_get_option('global_content_alignment');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = newsphere_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'newsphere-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }


    if (is_front_page() || is_home()) {
        $frontpage_layout = newsphere_get_option('frontpage_content_alignment');

        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        } else {
            $page_layout = $global_alignment;
        }

    }

    if ($page_layout == 'align-content-right') {
        if (is_front_page()) {
            if (is_page_template('tmpl-front-page.php')) {
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-right';
                } else {
                    $classes[] = 'full-width-content';
                }
            } else {
                if (is_active_sidebar('sidebar-1')) {
                    $classes[] = 'align-content-right';
                } else {
                    $classes[] = 'full-width-content';
                }
            }
        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-right';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    } elseif ($page_layout == 'full-width-content') {
        $classes[] = 'full-width-content';
    } else {
        if (is_front_page()) {
            if (is_page_template('tmpl-front-page.php')) {
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-left';
                } else {
                    $classes[] = 'full-width-content';
                }
            } else {
                if (is_active_sidebar('sidebar-1')) {
                    $classes[] = 'align-content-left';
                } else {
                    $classes[] = 'full-width-content';
                }
            }

        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-left';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    }

    return $classes;


}

add_filter('body_class', 'newsphere_body_classes');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function newsphere_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'newsphere_pingback_header');


/**
 * Returns posts.
 *
 * @since Newsphere 1.0.0
 */
if (!function_exists('newsphere_get_posts')):
    function newsphere_get_posts($number_of_posts, $category = '0')
    {

        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );

        $category = isset($category) ? $category : '0';
        if (absint($category) > 0) {
            $ins_args['cat'] = absint($category);
        }

        $all_posts = new WP_Query($ins_args);

        return $all_posts;
    }

endif;


/**
 * Returns no image url.
 *
 * @since  Newsphere 1.0.0
 */
if (!function_exists('newsphere_post_format')):
    function newsphere_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                $post_format = "<div class='af-post-format em-post-format'><i class='fa fa-camera'></i></div>";
                break;
            case "video":
                $post_format = "<div class='af-post-format em-post-format'><i class='fa fa-video-camera'></i></div>";

                break;
            case "gallery":
                $post_format = "<div class='af-post-format em-post-format'><i class='fa fa-camera'></i></div>";
                break;
            default:
                $post_format = "";
        }

        echo $post_format;
    }

endif;


if (!function_exists('newsphere_get_block')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since Newsphere 1.0.0
     *
     */
    function newsphere_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('inc/hooks/blocks/block-' . $section, $block);

    }
endif;

if (!function_exists('newsphere_archive_title')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since Newsphere 1.0.0
     *
     */

    function newsphere_archive_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }

        return $title;
    }

endif;
add_filter('get_the_archive_title', 'newsphere_archive_title');

/* Display Breadcrumbs */
if (!function_exists('newsphere_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function newsphere_get_breadcrumb()
    {

        $enable_breadcrumbs = newsphere_get_option('enable_breadcrumb');
        if (1 != $enable_breadcrumbs) {
            return;
        }
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }


        if (!function_exists('breadcrumb_trail')) {

            /**
             * Load libraries.
             */

            require_once get_template_directory() . '/lib/breadcrumb-trail/breadcrumb-trail.php';
        }

        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        ); ?>


        <div class="af-breadcrumbs font-family-1 color-pad">
            <?php breadcrumb_trail($breadcrumb_args); ?>
        </div>


    <?php }

endif;
add_action('newsphere_action_get_breadcrumb', 'newsphere_get_breadcrumb');


/**
 * Front-page main banner section layout
 */
if (!function_exists('newsphere_front_page_main_section')) {

    function newsphere_front_page_main_section()
    {

        $hide_on_blog = newsphere_get_option('disable_main_banner_on_blog_archive');

            if ($hide_on_blog) {
                if (is_front_page()) {
                    do_action('newsphere_action_front_page_main_section_1');
                }

            } else {
                if (is_front_page() || is_home()) {
                    do_action('newsphere_action_front_page_main_section_1');
                }

            }

    }
}
add_action('newsphere_action_front_page_main_section', 'newsphere_front_page_main_section');


/* Display Breadcrumbs */
if (!function_exists('newsphere_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function newsphere_excerpt_length($length)
    {

        if (is_admin()) {
            return $length;
        }

        return 15;
    }

endif;
add_filter('excerpt_length', 'newsphere_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('newsphere_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function newsphere_excerpt_more($more)
    {
        return '...';
    }

endif;

add_filter('excerpt_more', 'newsphere_excerpt_more');


/* Display Pagination */
if (!function_exists('newsphere_numeric_pagination')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function newsphere_numeric_pagination()
    {

        $pagination_type = newsphere_get_option('archive_pagination_view');
        switch ($pagination_type) {
            case 'archive-default':
                the_posts_pagination(array(
                    'mid_size' => 3,
                    'prev_text' => __('Previous', 'newsphere'),
                    'next_text' => __('Next', 'newsphere'),
                ));
                break;

            default:
                break;
        }

        return;
    }

endif;

/* Word read count Pagination */
if (!function_exists('newsphere_count_content_words')) :
    /**
     * @param $content
     *
     * @return string
     */
    function newsphere_count_content_words($post_id)
    {
        $show_read_mins = newsphere_get_option('global_show_min_read');
        if ($show_read_mins == 'yes') {
            $content = apply_filters('the_content', get_post_field('post_content', $post_id));
            $read_words = newsphere_get_option('global_show_min_read_number');
            $decode_content = html_entity_decode($content);
            $filter_shortcode = do_shortcode($decode_content);
            $strip_tags = wp_strip_all_tags($filter_shortcode, true);
            $count = str_word_count($strip_tags);
            $word_per_min = (absint($count) / $read_words);
            $word_per_min = ceil($word_per_min);

           if ( absint($word_per_min) > 0) {
                $word_count_strings = sprintf(_n('%s min read', '%s min read', number_format_i18n($word_per_min), 'newsphere'), number_format_i18n($word_per_min));
                if ('post' == get_post_type($post_id)):
                    echo '<span class="min-read">';
                    echo esc_html($word_count_strings);
                    echo '</span>';
                endif;
            }

        }
    }

endif;


/**
 * Check if given term has child terms
 *
 * @param Integer $term_id
 * @param String $taxonomy
 *
 * @return Boolean
 */
function newsphere_list_popular_taxonomies($taxonomy = 'post_tag', $title = "Popular Tags", $number = 5)
{
    $popular_taxonomies = get_terms(array(
        'taxonomy' => $taxonomy,
        'number' => absint($number),
        'orderby' => 'count',
        'order' => 'DESC',
        'hide_empty' => true,
    ));

    $html = '';

    if (isset($popular_taxonomies) && !empty($popular_taxonomies)):
        $html .= '<div class="aft-popular-taxonomies-lists clearfix">';
        if (!empty($title)):
            $html .= '<strong>';
            $html .= esc_html($title);
            $html .= '</strong>';
        endif;
        $html .= '<ul>';
        foreach ($popular_taxonomies as $tax_term):
            $html .= '<li>';
            $html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
            $html .= $tax_term->name;
            $html .= '</a>';
            $html .= '</li>';
        endforeach;
        $html .= '</ul>';
        $html .= '</div>';
    endif;

    echo $html;
}


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function newsphere_get_freatured_image_url($post_id, $size = 'newsphere-featured')
{
    if (has_post_thumbnail($post_id)) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
        $url = $thumb['0'];
    } else {
        $url = '';
    }

    return $url;
}


/**
 * @param $post_id
 */
function newsphere_get_comments_count($post_id)
{


    $show_comment_count = newsphere_get_option('global_show_comment_count');
    if ($show_comment_count == 'yes'):

        $comment_count = get_comments_number($post_id);
        if ( absint($comment_count) > 1):
        ?>
        <span class="min-read-post-comment">
        <a href="<?php the_permalink(); ?>">
            <?php echo get_comments_number($post_id); ?>
        </a>
        </span>
    <?php endif;
    endif;

}

/*
 * Enqueue and localization for pagination js
 *
 */
if (!function_exists('newsphere_pagination_scripts_args')):
    function newsphere_pagination_scripts_args()
    {

        //marquee ltr
        $args['dir'] = 'left';
        if (is_rtl()) {
            $args['dir'] = 'right';
        }

        return $args;


    }
endif;



