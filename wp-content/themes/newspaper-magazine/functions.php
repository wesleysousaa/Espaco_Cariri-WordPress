<?php
/**
 * Newspaper Magazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newspaper_Magazine
 */

if ( ! function_exists( 'newspaper_magazine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newspaper_magazine_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Newspaper Magazine, use a find and replace
	 * to change 'newspaper-magazine' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'newspaper-magazine', get_template_directory() . '/languages' );

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
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'newspaper-magazine' ),
		'top-menu' => esc_html__( 'Top', 'newspaper-magazine' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'newspaper_magazine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add theme support for search form.
	add_theme_support( 'html5', array( 'search-form' ) );

	// Add theme support for Custom Logo
	add_theme_support( 'custom-logo', array(
		'height'      => 90,
		'width'       => 300,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Thumbnail Sizes
	add_image_size( 'newspaper-magazine-thumbnail-1', 670, 464, true );
	add_image_size( 'newspaper-magazine-thumbnail-2', 675, 232, true );
	add_image_size( 'newspaper-magazine-thumbnail-3', 327, 364, true );
	add_image_size( 'newspaper-magazine-thumbnail-4', 358, 239, true );
	add_image_size( 'newspaper-magazine-thumbnail-5', 230, 144, true );
	add_image_size( 'newspaper-magazine-thumbnail-6', 115, 72, true );
	add_image_size( 'newspaper-magazine-thumbnail-7', 80, 70, true );
	add_image_size( 'newspaper-magazine-thumbnail-8', 750, 360, true );
}
endif;
add_action( 'after_setup_theme', 'newspaper_magazine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newspaper_magazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newspaper_magazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'newspaper_magazine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newspaper_magazine_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'newspaper-magazine' ),
		'id'            => 'sidebar-7',
		'description'   => esc_html__( 'Add Sidebar Widgets Here.', 'newspaper-magazine' ),
		'before_widget' => '<div class="col-md-12 widget-container"><div class="row"><div class="widget %1$s %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h4 class="news_title"><a><span>',
		'after_title'   => '</span></a></h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'newspaper-magazine' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Default Sidebar Widgets Here.', 'newspaper-magazine' ),
		'before_widget' => '<div class="col-md-12 widget-container"><div class="row"><div class="widget %1$s %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h4 class="news_title"><a><span>',
		'after_title'   => '</span></a></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Highlight Widget Area', 'newspaper-magazine' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add "Main Highlight" and "Slider Highlight" widgets here.', 'newspaper-magazine' ),
		'before_widget' => '<div class="col-xs-12 col-sm-6">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area Top', 'newspaper-magazine' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add Front Page Widgets Here.', 'newspaper-magazine' ),
		'before_widget' => '<div class="col-md-12"><div class="row"><div class="%2$s clearfix" >',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h4 class="header_title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area Bottom', 'newspaper-magazine' ),
		'id'            => 'sidebar-8',
		'description'   => esc_html__( 'Add Front Page Widgets Here.', 'newspaper-magazine' ),
		'before_widget' => '<div class="container"><div class="row">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="header_title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget Area', 'newspaper-magazine' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Add Advertisement Here.', 'newspaper-magazine' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Widget Area', 'newspaper-magazine' ),
		'id'			=> 'footer-sidebar',
		'description'	=> esc_html__( 'Add Footer Widgets Here', 'newspaper-magazine' ),
		'before_widget'	=> '<div class="col-xs-12 col-sm-3"> <div class="widget %2$s">',
		'after_widget'	=> '</div></div>',
		'before_title'	=> '<h4 class="footer_title">',
		'after_title'	=> '</h4>'
	) );

	

}
add_action( 'widgets_init', 'newspaper_magazine_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newspaper_magazine_scripts() {
	$dir = untrailingslashit( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	
	wp_enqueue_style( 'newspaper-magazine-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css' );
	wp_enqueue_style( 'mdb', get_template_directory_uri() . '/assets/css/mdb.css' );
	
	wp_enqueue_style( 'owl-carousel-style', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/assets/css/owl.theme.css' );
	wp_enqueue_style( 'pt-serif', 'https://fonts.googleapis.com/css?family=PT+Serif' );	
	wp_enqueue_style( 'newspaper-magazine-main', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'newspaper-magazine-media', get_template_directory_uri() . '/assets/css/media.css' );

	wp_enqueue_script( 'newspaper-magazine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'newspaper-magazine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'mosonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'mdb', get_template_directory_uri() . '/assets/js/mdb.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.js', array('jquery'), '20151215', true );

	$main_js_file = get_template_directory_uri() . '/assets/js/main.js';		
	$js_ver = date( "ymd-Gis", filemtime( $dir . 'assets/js/main.js' ) );
	wp_enqueue_script( 'newspaper-magazine-main', $main_js_file, array( 'jquery' ), $js_ver, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newspaper_magazine_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Hooks.
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Load Filters.
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Load Breadcrumg
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Load Widgets
 */
require get_template_directory() . '/inc/widgets/main-highlights.php';
require get_template_directory() . '/inc/widgets/news-layout-one.php';
require get_template_directory() . '/inc/widgets/news-layout-two.php';
require get_template_directory() . '/inc/widgets/news-layout-three.php';
require get_template_directory() . '/inc/widgets/news-layout-four.php';
require get_template_directory() . '/inc/widgets/news-layout-five.php';
require get_template_directory() . '/inc/widgets/sidebar-widgets.php';
require get_template_directory() . '/inc/widgets/footer-post-widget.php';
require get_template_directory() . '/inc/widgets/front-page-bottom-widget.php';


//remove_action( 'newspaper_magazine_footer_copyright', 'newspaper_magazine_footer_copyright_action', 10 );