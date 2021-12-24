<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Glob
 */
function glob_get_premium_url(){
    return 'https://www.famethemes.com/themes/glob-pro';
}
if ( ! function_exists( 'glob_setup_cat_title' ) ) {
    function glob_setup_widget_cat_title( $cat = null , $title = null ){
        $c = get_category( $cat );
        if ( $c && ! is_wp_error( $c ) ) {
            return array(
                'title' => esc_html( $c->name ),
                'link' =>  get_category_link( $c )
            );
        } elseif ( $title ) {
            return array(
                'title' => esc_html( $title ),
                'link' =>  false
            );
        }
        return false;
    }
}
if ( ! function_exists( 'glob_sidebar_desc' ) ) {
    /**
     * Output the status of widets for footer column.
     *
     */
    function glob_sidebar_desc( $sidebar_id )
    {
        $desc = '';
        $column = str_replace('footer-', '', $sidebar_id);
        $footer_columns = absint(get_theme_mod('footer_layout', 4));
        if ($column > $footer_columns) {
            $desc = esc_html__('This widget area is currently disabled. You can enable it Customizer &rarr; Theme Options &rarr; Footer section.', 'glob');
        }
        return esc_html($desc);
    }
}
if ( ! function_exists( 'glob_body_classes' ) ) {
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    function glob_body_classes($classes)
    {
        // Adds a class of group-blog to blogs with more than 1 published author.
        if (is_multi_author()) {
            $classes[] = 'group-blog';
        }
        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $classes[] = 'hfeed';
        }
        if (is_front_page() || is_home()) {
            $homepage_layout = get_theme_mod('glob_homepage_layout', 'default');
            $classes[] = 'homepage-' . $homepage_layout;
        }
        if (is_page_template('template-fullwidth.php')) {
            $classes[] = 'full-width';
        }
        return $classes;
    }
}
add_filter( 'body_class', 'glob_body_classes' );
if ( ! function_exists( 'glob_no_thumbnail_class' ) ) {
    function glob_no_thumbnail_class($classes)
    {
        global $post;
        if (!has_post_thumbnail($post->ID)) {
            $classes[] = 'no-post-thumbnail';
        }
        return $classes;
    }
}
add_filter( 'post_class', 'glob_no_thumbnail_class' );
if ( ! function_exists( 'glob_custom_excerpt_length' ) && ! is_admin() ) {
    function glob_custom_excerpt_length($length)
    {
        return 30;
    }
}
add_filter('excerpt_length', 'glob_custom_excerpt_length', 999);
if ( ! function_exists( 'glob_excerpt_more' ) && ! is_admin() ) {
    function glob_excerpt_more($more)
    {
        return '&hellip;';
    }
}
add_filter('excerpt_more', 'glob_excerpt_more', 15 );
add_filter('wp_list_categories', 'glob_cat_count_inline');
if ( ! function_exists( 'glob_cat_count_inline' ) ) {
    function glob_cat_count_inline($links)
    {
        $links = str_replace('</a> (', '</a><span class="cat-count">', $links);
        $links = str_replace(')', '</span>', $links);
        return $links;
    }
}
if ( ! function_exists( 'glob_search_form' ) )  {
	function glob_search_form( $form ) {
	    $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
	    <label for="s">
			<span class="screen-reader-text">' . esc_html__( 'Search for:', 'glob' ) . '</span>
			<input type="text" class="search-field" placeholder="'. esc_attr__( 'Search', 'glob' ) .'" value="' . get_search_query() . '" name="s" id="s" />
		</label>
		<button type="submit" class="search-submit">
	        <i class="fa fa-search"></i>
	    </button>
	    </form>';
	    return $form;
	}
}
add_filter( 'get_search_form', 'glob_search_form' );
if ( ! function_exists( 'glob_custom_style' ) ) {
    /**
     * Get custom style
     *
     * @return string
     */
    function glob_custom_style(){
        $custom_css = '';
       
            $primary   = maybe_hash_hex_color( esc_attr( get_theme_mod( 'primary_color', '#fa4c2a' ) ) );
            $secondary = maybe_hash_hex_color( esc_attr( get_theme_mod( 'secondary_color', '#222222' ) ) );
            $custom_css .= "
            a, .comments-area .logged-in-as a {
                color: {$secondary};
            }
            .header-breaking .breaking_text strong,
            a:hover,
            .social-links ul a:hover::before,
            .footer-widgets .widget a:hover,
            .entry-title:hover, .entry-title a:hover, h2.entry-title a:hover,
            .social-links ul a:hover
            {
                 color : {$primary};
            }
            .block-slider .entry .entry-cat,
            .entry-footer .cat-links span, .entry-footer .tags-links span {
                background-color: {$primary};
            }
            button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"],
            .st-menu .btn-close-home .home-button,
            .st-menu .btn-close-home .close-button {
                background-color: {$primary};
                border-color : {$primary};
            }
            .widget_tag_cloud a:hover, .slick-arrow:hover { border-color : {$primary};}
            .main-navigation li:hover > a,
            .main-navigation li.focus > a {
                 background-color : {$primary};
            }
            .main-navigation a:hover,
            .main-navigation .current_page_item > a,
            .main-navigation .current-menu-item > a,
            .main-navigation .current_page_ancestor > a {
                background-color : {$primary};
                color : #fff;
            }
            h2.entry-title a,
            h1.entry-title,
            .widget-title,
            .footer-staff-picks h3
            {
                color: {$secondary};
            }
            button:hover, input[type=\"button\"]:hover,
            input[type=\"reset\"]:hover,
            input[type=\"submit\"]:hover,
            .st-menu .btn-close-home .home-button:hover,
            .st-menu .btn-close-home .close-button:hover {
                    background-color: {$secondary};
                    border-color: {$secondary};
            }";
        
        if ( get_header_image() ) :
			$custom_css .= '.site-header {  background-image: url('. esc_url( get_header_image() ) .'); background-repeat: no-repeat; background-size: cover; }';
		endif;
        return $custom_css;
    }
}
if ( ! function_exists( 'glob_get_archives_link' ) ) {
    /**
     * @see get_archives_link
     *
     * @param $url
     * @param $text
     * @param string $format
     * @param string $before
     * @param string $after
     * @return mixed|void
     */
    function glob_get_archives_link( $link_html, $url, $text, $format = 'html', $before = '', $after = '')
    {
        if ('link' == $format)
            $link_html = "\t<link rel='archives' title='" . esc_attr($text) . "' href='$url' />\n";
        elseif ('option' == $format)
            $link_html = "\t<option value='$url'>$before $text $after</option>\n";
        elseif ('html' == $format)
            $link_html = "\t<li><a href='$url'>{$before}{$text}{$after}</a></li>\n";
        else // custom
            $link_html = "\t<a href='$url'>{$before}{$text}{$after}</a>\n";
        return $link_html;
    }
}
add_filter( 'get_archives_link', 'glob_get_archives_link', 15, 6 );
