<?php
/**
 * Glob functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Glob
 */
if ( ! function_exists( 'glob_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function glob_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Glob, use a find and replace
	 * to change 'glob' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'glob', get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for custom logo.
	 *
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 49,
		'width'       => 162,
        'flex-height' => true,
        'flex-width'  => true,
	) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'glob-thumbnail-large', 548, 300, true );
	add_image_size( 'glob-thumbnail-medium', 260, 160, true );
	add_image_size( 'glob-medium', 980, 400, true );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'glob' ),
		'footer'  => esc_html__( 'Footer', 'glob' ),
		'social'  => esc_html__( 'Social Network', 'glob' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'gallery',
		'caption',
	) );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'glob_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
    add_editor_style( get_template_directory_uri().'/assets/css/editor-style.css' );
   
}
endif;
add_action( 'after_setup_theme', 'glob_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function glob_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'glob_content_width', 640 );
}
add_action( 'after_setup_theme', 'glob_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function glob_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'glob' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'glob' ),
		'before_widget' => '<section id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Right', 'glob' ),
		'id'            => 'header-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'glob' ),
		'before_widget' => '<section id="%1$s" class="header-right-widget %2$s">',
		'after_widget'  => '</section>'
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Hero Top', 'glob' ),
		'id'            => 'hero-top',
		'description'   => esc_html__( 'Add widgets here.', 'glob' ),
		'before_widget' => '<section id="%1$s" class="home-hero-widget %2$s">',
		'after_widget'  => '</section>',
        'before_title'  => '<h4 class="block-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Content Top', 'glob' ),
		'id'            => 'home-1',
		'description'   => esc_html__( 'Add widgets here.', 'glob' ),
		'before_widget' => '<section id="%1$s" class="home-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="block-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Contet Left', 'glob' ),
		'id'            => 'home-2',
		'description'   => esc_html__( 'Add widgets here.', 'glob' ),
		'before_widget' => '<section id="%1$s" class="home-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="block-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Content Right', 'glob' ),
		'id'            => 'home-3',
		'description'   => esc_html__( 'Add widgets here.', 'glob' ),
		'before_widget' => '<section id="%1$s" class="home-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="block-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Content Bottom', 'glob' ),
		'id'            => 'home-4',
		'description'   => esc_html__( 'Add widgets here.', 'glob' ),
		'before_widget' => '<section id="%1$s" class="home-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="block-title">',
		'after_title'   => '</h4>',
	) );
   
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'glob' ),
        'id'            => 'footer-1',
        'description'   => glob_sidebar_desc( 'footer-1' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'glob' ),
        'id'            => 'footer-2',
        'description'   => glob_sidebar_desc( 'footer-2' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'glob' ),
        'id'            => 'footer-3',
        'description'   => glob_sidebar_desc( 'footer-3' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 4', 'glob' ),
        'id'            => 'footer-4',
        'description'   => glob_sidebar_desc( 'footer-4' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'glob_widgets_init' );
if ( ! function_exists( 'glob_fonts_url' ) ) {
    /**
     * @return string Google fonts URL for the theme.
     */
    function glob_fonts_url()
    {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';
        /*
         * Translators: If there are characters in your language that are not supported
         * by Noto Sans, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Lato font: on or off', 'glob')) {
            $fonts[] = 'Open Sans:400,400i,600,600i';
        }
        if ('off' !== _x('on', 'Merriweather font: on or off', 'glob')) {
            $fonts[] = 'Roboto:300,400,400italic,500,500italic,700';
        }
        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'glob');
        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }
        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return esc_url($fonts_url);
    }
}
/**
 * Enqueue scripts and styles.
 */
function glob_scripts() {
    $theme = wp_get_theme();
    $version =  $theme->get( 'Version' );
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'glob-fonts', glob_fonts_url(), array(),  $version );
	// Add Font Awesome, used in the main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5' );
	wp_enqueue_style( 'glob-style', get_stylesheet_uri(), array(), $version );
	wp_add_inline_style( 'glob-style', glob_custom_style() );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'classie', get_template_directory_uri() . '/assets/js/classie.js', $version, true );
	wp_enqueue_script( 'glob-sidebar-menu', get_template_directory_uri() . '/assets/js/sidebar-menu.js', array( 'jquery', 'classie' ), $version, true );
	wp_enqueue_script( 'jquery-inview', get_template_directory_uri() . '/assets/js/inview.js', array( 'jquery' ), $version, true );
   
	wp_enqueue_script( 'glob-themes-js', get_template_directory_uri() . '/assets/js/themes.js', array( 'jquery', 'glob-sidebar-menu', 'jquery-slick', 'jquery-inview' ), $version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'glob_scripts' );
/**
 * Theme dashboard
 */
require_once get_template_directory() . '/inc/dashboard.php';
/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/customizer-selective-refresh.php';
/**
 *  Widgets
 */
require_once get_template_directory() . '/inc/widgets/widget-hero-1.php';
require_once get_template_directory() . '/inc/widgets/widget-block-1.php';
require_once get_template_directory() . '/inc/widgets/widget-block-2.php';
require_once get_template_directory() . '/inc/widgets/widget-block-3.php';
require_once get_template_directory() . '/inc/widgets/widget-social.php';
require_once get_template_directory() . '/inc/widgets/widget-recent-posts.php';
/**
 * Load plugins recommended.
 */
require get_template_directory() . '/inc/plugins-recommend.php';
/**
 * Register widgets
 */
function glob_register_widgets(){
   
        $widgets = array(
            'Glob_Widget_Block_1',
            'Glob_Widget_Block_2',
            'Glob_Widget_Block_3',
            'Glob_Widget_Header_Posts',
            'Glob_Widget_Hero_1',
            'Glob_Widget_Recent_Posts',
            'Glob_Widget_Social',
        );
    
    foreach ( $widgets as $class_name ) {
        if ( class_exists( $class_name ) ) {
            register_widget( $class_name );
        }
    }
}
add_action( 'widgets_init', 'glob_register_widgets');
