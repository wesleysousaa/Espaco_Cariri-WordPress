<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CoverNews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function covernews_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    global $post;

    $global_layout = covernews_get_option('global_content_layout');
    if (!empty($global_layout)) {
        $classes[] = $global_layout;
    }


    $global_alignment = covernews_get_option('global_content_alignment');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = covernews_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'covernews-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }


    if (is_front_page() || is_home()) {
        $frontpage_layout = covernews_get_option('frontpage_content_alignment');

        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        } else {
            $page_layout = $global_alignment;
        }

    }

    // Check if single.
    if ($post && is_singular()) {
        $global_single_content_mode = covernews_get_option('global_single_content_mode');
        $post_single_content_mode = get_post_meta($post->ID, 'covernews-meta-content-mode', true);
        if (!empty($post_single_content_mode)) {
            $classes[] = $post_single_content_mode;
        } else {
            $classes[] = $global_single_content_mode;
        }
    }


    if($page_layout == 'align-content-right'){
        if(is_front_page()){
            if(is_page_template('tmpl-front-page.php')){
                if(is_active_sidebar('home-sidebar-widgets')){
                    $classes[] = 'align-content-right';
                }else{
                    $classes[] = 'full-width-content';
                }
            }else{
                if(is_active_sidebar('sidebar-1')){
                    $classes[] = 'align-content-right';
                }else{
                    $classes[] = 'full-width-content';
                }
            }
        }else{
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-right';
            }else{
                $classes[] = 'full-width-content';
            }
        }
    }elseif($page_layout == 'full-width-content'){
        $classes[] = 'full-width-content';
    }else{
        if(is_front_page()){
            if(is_page_template('tmpl-front-page.php')){
                if(is_active_sidebar('home-sidebar-widgets')){
                    $classes[] = 'align-content-left';
                }else{
                    $classes[] = 'full-width-content';
                }
            }else{
                if(is_active_sidebar('sidebar-1')){
                    $classes[] = 'align-content-left';
                }else{
                    $classes[] = 'full-width-content';
                }
            }

        }else{
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-left';
            }else{
                $classes[] = 'full-width-content';
            }
        }
    }
    return $classes;


}

add_filter('body_class', 'covernews_body_classes');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function covernews_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'covernews_pingback_header');


/**
 * Returns no image url.
 *
 * @since  CoverNews 1.0.0
 */
if (!function_exists('covernews_post_format')):
    function covernews_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                echo "<div class='em-post-format'><i class='fas fa-camera'></i></div>";
                break;
            case "video":
                echo "<div class='em-post-format'><i class='fas fa-video'></i></div>";

                break;
            case "gallery":
                echo "<div class='em-post-format'><i class='fas fa-camera'></i></div>";
                break;
            default:
                echo "";
        }


    }

endif;


if (!function_exists('covernews_get_block')) :
    /**
     *
     * @since CoverNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function covernews_get_block($block = 'grid')
    {

        get_template_part('inc/hooks/blocks/block-post', $block);

    }
endif;

if (!function_exists('covernews_archive_title')) :
    /**
     *
     * @since CoverNews 1.0.0
     *
     * @param null
     * @return null
     *
     */

    function covernews_archive_title($title)
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
add_filter('get_the_archive_title', 'covernews_archive_title');

/* Display Breadcrumbs */
if (!function_exists('covernews_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function covernews_get_breadcrumb()
    {

        $enable_breadcrumbs = covernews_get_option('enable_breadcrumb');
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


        <div class="em-breadcrumbs font-family-1">
                <div class="row">
                        <?php breadcrumb_trail($breadcrumb_args); ?>
                </div>
        </div>


    <?php }

endif;
add_action('covernews_action_get_breadcrumb', 'covernews_get_breadcrumb');


/**
 * Front-page main banner section layout
 */
if(!function_exists('covernews_front_page_main_section')){

    function covernews_front_page_main_section(){

        $hide_on_blog = covernews_get_option('disable_main_banner_on_blog_archive');

            if ($hide_on_blog) {
                if (is_front_page()) {
                    do_action('covernews_action_front_page_main_section_1');
                }

            } else {
                if (is_front_page() || is_home()) {
                    do_action('covernews_action_front_page_main_section_1');
                }

        }
    }
}
add_action('covernews_action_front_page_main_section', 'covernews_front_page_main_section');



/* Display Breadcrumbs */
if (!function_exists('covernews_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function covernews_excerpt_length($length)
    {
        
        if ( is_admin() ) {
                return $length;
        }

        return 15;
    }

endif;
add_filter('excerpt_length', 'covernews_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('covernews_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function covernews_excerpt_more($more)
    {
        return '...';
    }

endif;

add_filter('excerpt_more', 'covernews_excerpt_more');

// if (!is_admin()) {
//     function covernews_search_filter($query)
//     {
//         if ($query->is_search) {
//             $query->set('post_type', 'post');
//         }
//         return $query;
//     }

//     add_filter('pre_get_posts', 'covernews_search_filter');
// }

/* Display Pagination */
if (!function_exists('covernews_numeric_pagination')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function covernews_numeric_pagination()
    {
        the_posts_pagination(array(
            'mid_size' => 3,
            'prev_text' => __( 'Previous', 'covernews' ),
            'next_text' => __( 'Next', 'covernews' ),
        ));
    }

endif;