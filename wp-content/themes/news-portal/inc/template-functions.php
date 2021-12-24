<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function news_portal_body_classes( $classes ) {

    global $post;
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    /**
     * Sidebar option for post/page/archive
     *
     * @since 1.0.0
     */
    if( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'np_single_post_sidebar', true );
    }

    if( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'np_single_post_sidebar', true );
    }
     
    if( is_home() ) {
        $home_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $home_id, 'np_single_post_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    $archive_sidebar        = get_theme_mod( 'news_portal_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar   = get_theme_mod( 'news_portal_default_post_sidebar', 'right_sidebar' );        
    $page_default_sidebar   = get_theme_mod( 'news_portal_default_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $post_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $post_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( is_page() && !is_page_template( 'templates/home-template.php' ) ) {
            if( $page_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $page_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( $archive_sidebar == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif( $archive_sidebar == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar' ) {
            $classes[] = 'no-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar_center' ) {
            $classes[] = 'no-sidebar-center';
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar' ) {
        $classes[] = 'no-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar_center' ) {
        $classes[] = 'no-sidebar-center';
    }

    /**
     * option for web site layout 
     */
    $news_portal_website_layout = esc_attr( get_theme_mod( 'news_portal_site_layout', 'fullwidth_layout' ) );
    
    if( !empty( $news_portal_website_layout ) ) {
        $classes[] = $news_portal_website_layout;
    }

    /**
     * Class for archive
     */
    if( is_archive() ) {
        $news_portal_archive_layout = get_theme_mod( 'news_portal_archive_layout', 'classic' );
        if( !empty( $news_portal_archive_layout ) ) {
            $classes[] = 'archive-'.$news_portal_archive_layout;
        }
    }

    return $classes;
}
add_filter( 'body_class', 'news_portal_body_classes' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for News Portal.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_fonts_url' ) ) :
    function news_portal_fonts_url() {
        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto Condensed, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'news-portal' ) ) {
            $font_families[] = 'Roboto Condensed:300italic,400italic,700italic,400,300,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'news-portal' ) ) {
            $font_families[] = 'Roboto:300,400,400i,500,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Titillium Web, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Titillium Web font: on or off', 'news-portal' ) ) {
            $font_families[] = 'Titillium Web:400,600,700,300';
        }       

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'news_portal_admin_scripts' );

function news_portal_admin_scripts( $hook ) {

    global $news_portal_version;

    if( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

    wp_enqueue_script( 'jquery-ui-button' );
    
    wp_enqueue_script( 'news-portal-admin-script', get_template_directory_uri() .'/assets/js/np-admin-scripts.js', array( 'jquery' ), esc_attr( $news_portal_version ), true );

    wp_enqueue_style( 'news-portal-admin-style', get_template_directory_uri() . '/assets/css/np-admin-style.css', array(), esc_attr( $news_portal_version ) );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function news_portal_scripts() {
    
    global $news_portal_version;

    wp_enqueue_style( 'news-portal-fonts', news_portal_fonts_url(), array(), null );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    wp_enqueue_style( 'lightslider-style', get_template_directory_uri().'/assets/library/lightslider/css/lightslider.min.css', array(), '1.1.6' );

    wp_enqueue_style( 'news-portal-style', get_stylesheet_uri(), array(), esc_attr( $news_portal_version ) );
    
    wp_enqueue_style( 'news-portal-responsive-style', get_template_directory_uri().'/assets/css/np-responsive.css', array(), '1.0.0' );

    wp_enqueue_script( 'news-portal-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $news_portal_version ), true );

    $menu_sticky_option = get_theme_mod( 'news_portal_menu_sticky_option', 'show' );
    if ( $menu_sticky_option == 'show' ) {
        wp_enqueue_script( 'jquery-sticky', get_template_directory_uri(). '/assets/library/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );
    
        wp_enqueue_script( 'np-sticky-menu-setting', get_template_directory_uri(). '/assets/library/sticky/sticky-setting.js', array( 'jquery-sticky' ), '20150309', true );
    }

    wp_enqueue_script( 'news-portal-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), esc_attr( $news_portal_version ), true );

    wp_enqueue_script( 'lightslider', get_template_directory_uri().'/assets/library/lightslider/js/lightslider.min.js', array('jquery'), '1.1.6', true );

    wp_enqueue_script( 'jquery-ui-tabs' );

    wp_enqueue_script( 'news-portal-custom-script', get_template_directory_uri().'/assets/js/np-custom-scripts.js', array('jquery'), esc_attr( $news_portal_version ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'news_portal_scripts' );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Social media function
 *
 * @since 1.0.0
 */

if( !function_exists( 'news_portal_social_media' ) ):
    function news_portal_social_media() {
        $get_social_media_icons = get_theme_mod( 'social_media_icons', '' );
        $get_decode_social_media = json_decode( $get_social_media_icons );
        if( ! empty( $get_decode_social_media ) ) {
            echo '<div class="mt-social-icons-wrapper">';
            foreach ( $get_decode_social_media as $single_icon ) {
                $icon_class = $single_icon->social_icon_class;
                $icon_url = $single_icon->social_icon_url;
                if( !empty( $icon_url ) ) {
                    echo '<span class="social-link"><a href="'. esc_url( $icon_url ) .'" target="_blank"><i class="'. esc_attr( $icon_class ) .'"></i></a></span>';
                }
            }
            echo '</div><!-- .mt-social-icons-wrapper -->';
        }
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category list
 *
 * @return array();
 */
if( !function_exists( 'news_portal_categories_lists' ) ):
    function news_portal_categories_lists() {
        $news_portal_categories = get_categories( array( 'hide_empty' => 1 ) );
        $news_portal_categories_lists = array();
        foreach( $news_portal_categories as $category ) {
            $news_portal_categories_lists[$category->term_id] = $category->name;
        }
        return $news_portal_categories_lists;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category dropdown
 *
 * @return array();
 */
if( !function_exists( 'news_portal_categories_dropdown' ) ):
    function news_portal_categories_dropdown() {
        $news_portal_categories = get_categories( array( 'hide_empty' => 1 ) );
        $news_portal_categories_lists = array();
        $news_portal_categories_lists['0'] = esc_html__( 'Select Category', 'news-portal' );
        foreach( $news_portal_categories as $category ) {
            $news_portal_categories_lists[esc_attr( $category->term_id )] = esc_html( $category->name );
        }
        return $news_portal_categories_lists;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function news_portal_css_strip_whitespace( $css ){
    $replace = array(
        "#/\*.*?\*/#s" => "",  // Strip C style comments.
        "#\s\s+#"      => " ", // Strip excess whitespace.
    );
    $search = array_keys( $replace );
    $css = preg_replace( $search, $replace, $css );

    $replace = array(
        ": "  => ":",
        "; "  => ";",
        " {"  => "{",
        " }"  => "}",
        ", "  => ",",
        "{ "  => "{",
        ";}"  => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} "  => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css = str_replace( $search, $replace, $css );

    return trim( $css );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_hover_color' ) ) :
    function news_portal_hover_color( $hex, $steps ) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max( -255, min( 255, $steps ) );

        // Normalize into a six character long hex string
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3) {
            $hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex, 1, 1 ), 2 ).str_repeat( substr( $hex,2,1 ), 2 );
        }

        // Split into three parts: R, G and B
        $color_parts = str_split( $hex, 2 );
        $return = '#';

        foreach ( $color_parts as $color ) {
            $color   = hexdec( $color ); // Convert to decimal
            $color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
            $return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
        }

        return $return;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Dynamic style about template
 *
 * @since 1.0.0
 */

add_action( 'wp_enqueue_scripts', 'news_portal_dynamic_styles' );

if( ! function_exists( 'news_portal_dynamic_styles' ) ) :
    function news_portal_dynamic_styles() {

        $get_categories = get_categories( array( 'hide_empty' => 1 ) );
        $news_portal_theme_color = get_theme_mod( 'news_portal_theme_color', '#029FB2' );
        $news_portal_theme_hover_color = news_portal_hover_color( $news_portal_theme_color, '-50' );

        $news_portal_site_title_option = get_theme_mod( 'news_portal_site_title_option', 'true' );        
        $news_portal_site_title_color = get_theme_mod( 'news_portal_site_title_color', '#029FB2' );

        $output_css = '';

        foreach( $get_categories as $category ){

            $cat_color = get_theme_mod( 'news_portal_category_color_'.strtolower( $category->slug ), '#00a9e0' );

            $cat_hover_color = news_portal_hover_color( $cat_color, '-50' );
            $cat_id = $category->term_id;
            
            if( !empty( $cat_color ) ) {
                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a { background: ". esc_attr( $cat_color ) ."}\n";

                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a:hover { background: ". esc_attr( $cat_hover_color ) ."}\n";

                $output_css .= ".np-block-title .np-cat-". esc_attr( $cat_id ) ." { color: ". esc_attr( $cat_color ) ."}\n";
            }
        }

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.widget_search .search-submit,.edit-link .post-edit-link,.reply .comment-reply-link,.np-top-header-wrap,.np-header-menu-wrapper,#site-navigation ul.sub-menu, #site-navigation ul.children,.np-header-menu-wrapper::before, .np-header-menu-wrapper::after,.np-header-search-wrapper .search-form-main .search-submit,.news_portal_slider .lSAction > a:hover,.news_portal_default_tabbed ul.widget-tabs li,.np-full-width-title-nav-wrap .carousel-nav-action .carousel-controls:hover,.news_portal_social_media .social-link a,.np-archive-more .np-button:hover,.error404 .page-title,#np-scrollup,.news_portal_featured_slider .slider-posts .lSAction > a:hover,div.wpforms-container-full .wpforms-form input[type='submit'], div.wpforms-container-full .wpforms-form button[type='submit'],div.wpforms-container-full .wpforms-form .wpforms-page-button,div.wpforms-container-full .wpforms-form input[type='submit']:hover, div.wpforms-container-full .wpforms-form button[type='submit']:hover,div.wpforms-container-full .wpforms-form .wpforms-page-button:hover { background: ". esc_attr( $news_portal_theme_color ) ."}\n";

        $output_css .= ".home .np-home-icon a, .np-home-icon a:hover,#site-navigation ul li:hover > a, #site-navigation ul li.current-menu-item > a,#site-navigation ul li.current_page_item > a,#site-navigation ul li.current-menu-ancestor > a,.news_portal_default_tabbed ul.widget-tabs li.ui-tabs-active, .news_portal_default_tabbed ul.widget-tabs li:hover { background: ". esc_attr( $news_portal_theme_hover_color ) ."}\n";

        $output_css .= ".np-header-menu-block-wrap::before, .np-header-menu-block-wrap::after { border-right-color: ". esc_attr( $news_portal_theme_hover_color ) ."}\n";

        $output_css .= "a,a:hover,a:focus,a:active,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.np-slide-content-wrap .post-title a:hover,#top-footer .widget a:hover,#top-footer .widget a:hover:before,#top-footer .widget li:hover:before,.news_portal_featured_posts .np-single-post .np-post-content .np-post-title a:hover,.news_portal_fullwidth_posts .np-single-post .np-post-title a:hover,.news_portal_block_posts .layout3 .np-primary-block-wrap .np-single-post .np-post-title a:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-title a:hover,.np-block-title,.widget-title,.page-header .page-title,.np-related-title,.np-post-meta span:hover,.np-post-meta span a:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span a:hover,.np-post-title.small-size a:hover,#footer-navigation ul li a:hover,.entry-title a:hover,.entry-meta span a:hover,.entry-meta span:hover,.np-post-meta span:hover, .np-post-meta span a:hover, .news_portal_featured_posts .np-single-post-wrap .np-post-content .np-post-meta span:hover, .news_portal_featured_posts .np-single-post-wrap .np-post-content .np-post-meta span a:hover,.news_portal_featured_slider .featured-posts .np-single-post .np-post-content .np-post-title a:hover { color: ". esc_attr( $news_portal_theme_color ) ."}\n";

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.np-archive-more .np-button:hover { border-color: ". esc_attr( $news_portal_theme_color ) ."}\n";

        $output_css .= ".comment-list .comment-body,.np-header-search-wrapper .search-form-main { border-top-color: ". esc_attr( $news_portal_theme_color ) ."}\n";
        
        $output_css .= ".np-header-search-wrapper .search-form-main:before { border-bottom-color: ". esc_attr( $news_portal_theme_color ) ."}\n";

        $output_css .= "@media (max-width: 768px) { #site-navigation,.main-small-navigation li.current-menu-item > .sub-toggle i { background: ". esc_attr( $news_portal_theme_color ) ." !important } }\n";

        if ( $news_portal_site_title_option == 'false' ) {
                $output_css .=".site-title, .site-description {
                            position: absolute;
                            clip: rect(1px, 1px, 1px, 1px);
                        }\n";
            } else {
                $output_css .=".site-title a, .site-description {
                            color:". esc_attr( $news_portal_site_title_color ) .";
                        }\n";
            }

        $refine_output_css = news_portal_css_strip_whitespace( $output_css );

        wp_add_inline_style( 'news-portal-style', $refine_output_css );
    }
endif;

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_get_sidebar' ) ):
function news_portal_get_sidebar() {
    global $post;

    if( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'np_single_post_sidebar', true );
    }

    if( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'np_single_post_sidebar', true );
    }
     
    if( is_home() ) {
        $set_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $set_id, 'np_single_post_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    
    $archive_sidebar      = get_theme_mod( 'news_portal_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar = get_theme_mod( 'news_portal_default_post_sidebar', 'right_sidebar' );
    $page_default_sidebar = get_theme_mod( 'news_portal_default_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $post_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $post_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( is_page() ) {
            if( $page_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $page_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( $archive_sidebar == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $archive_sidebar == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        get_sidebar();
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        get_sidebar( 'left' );
    }
}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Define font awesome social media icons
 *
 * @return array();
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_font_awesome_social_icon_array' ) ) :
    function news_portal_font_awesome_social_icon_array(){
        return array(
            "fa fa-facebook-square","fa fa-facebook-f","fa fa-facebook","fa fa-facebook-official","fa fa-twitter-square","fa fa-twitter","fa fa-yahoo","fa fa-google","fa fa-google-wallet","fa fa-google-plus-circle","fa fa-google-plus-official","fa fa-instagram","fa fa-linkedin-square","fa fa-linkedin","fa fa-pinterest-p","fa fa-pinterest","fa fa-pinterest-square","fa fa-google-plus-square","fa fa-google-plus","fa fa-youtube-square","fa fa-youtube","fa fa-youtube-play","fa fa-vimeo","fa fa-vimeo-square",
        );
    }
endif;

/*---------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'news_portal_archive_read_more_button' ) ) :

    /**
     * function to show the read more button
     */

    function news_portal_archive_read_more_button() {
        $news_portal_archive_read_more_text = get_theme_mod( 'news_portal_archive_read_more_text', __( 'Continue Reading', 'news-portal' ) );
        if( !empty( $news_portal_archive_read_more_text ) ) {
            echo '<span class="np-archive-more"><a href="'. esc_url( get_the_permalink() ) .'" class="np-button"><i class="fa fa-arrow-circle-o-right"></i>'. esc_html( $news_portal_archive_read_more_text ) .'</a></span>';
        }
    }

endif;