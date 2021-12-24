<?php
/**
 * Magazinely functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sp_magazinely
 */

if ( ! function_exists( 'sp_magazinely_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
function sp_magazinely_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Magazinely, use a find and replace
		 * to change 'magazinely' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'magazinely', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );



/**
 * Exclude sticky posts from home page.
 */
function magazinely_ignore_sticky_posts($query){
	if (is_home() && $query->is_main_query())
		$query->set('post__not_in', get_option('sticky_posts'));
}
add_action('pre_get_posts', 'magazinely_ignore_sticky_posts');


		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
	add_image_size( 'magazinely-related', 200, 125, true ); //related
	add_image_size( 'magazinely-featured-images', 800, 800, true ); 


		// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'magazinely' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'magazinely' ),
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
		add_theme_support( 'custom-background', apply_filters( 'sp_magazinely_custom_background_args', array(
			'default-color' => 'fff',
			'default-image' => '',
			) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			) );
	}
	endif;
	add_action( 'after_setup_theme', 'sp_magazinely_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sp_magazinely_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'sp_magazinely_content_width', 640 );
}
add_action( 'after_setup_theme', 'sp_magazinely_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sp_magazinely_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget', 'magazinely' ),
		'id'            => 'header-widget',
		'description'   => esc_html__( 'Displayed beside the website title in the header.', 'magazinely' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'magazinely' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'magazinely' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (First)', 'magazinely' ),
		'id'            => 'footer-widget-one',
		'description'   => esc_html__( 'Add widgets here.', 'magazinely' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (Second)', 'magazinely' ),
		'id'            => 'footer-widget-two',
		'description'   => esc_html__( 'Add widgets here.', 'magazinely' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (Third)', 'magazinely' ),
		'id'            => 'footer-widget-three',
		'description'   => esc_html__( 'Add widgets here.', 'magazinely' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (Third)', 'magazinely' ),
		'id'            => 'footer-widget-three',
		'description'   => esc_html__( 'Add widgets here.', 'magazinely' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		) );


}
add_action( 'widgets_init', 'sp_magazinely_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sp_magazinely_scripts() {
	wp_enqueue_style( 'magazinely-owl-slider-default', get_template_directory_uri() . '/css/owl.carousel.min.css' );
	wp_enqueue_style( 'magazinely-owl-slider-theme', get_template_directory_uri() . '/css/owl.theme.default.css' );

	wp_enqueue_script( 'magazinely-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_script( 'magazinely-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_style( 'magazinely-foundation', get_template_directory_uri() . '/css/foundation.css' );
	wp_enqueue_style( 'magazinely-font', 'https://fonts.googleapis.com/css?family=Saira+Semi+Condensed:400,700' );
	wp_enqueue_style( 'magazinely-dashicons', get_home_url() . '/wp-includes/css/dashicons.css' );

	wp_enqueue_script( 'magazinely-foundation-js-jquery', get_template_directory_uri() . '/js/vendor/foundation.js', array('jquery'), '6', true );
	wp_enqueue_script( 'magazinely-custom-js-jquery', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'magazinely-owl-slider-js-jquery', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_style( 'magazinely-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sp_magazinely_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/** 
 * Magazinely Get Custom Fonts 
 */
function sp_magazinely_load_google_fonts() {
	wp_enqueue_style( 'magazinely-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Merriweather:700,400,700i' ); 
}
add_action( 'wp_enqueue_scripts', 'sp_magazinely_load_google_fonts' );





/**
 * Copyright and License for Upsell button by Justin Tadlock - 2016 © Justin Tadlock. Customizer button https://gitblogily.com/justintadlock/trt-customizer-pro
 */
require_once( trailingslashit( get_template_directory() ) . 'justinadlock-customizer-button/class-customize.php' );


/**
 * Compare page CSS
 */

function writers_blogily_comparepage_css($hook) {
	if ( 'appearance_page_magazinely-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'magazinely-custom-style', get_template_directory_uri() . '/css/compare.css' );
}
add_action( 'admin_enqueue_scripts', 'writers_blogily_comparepage_css' );

/**
 * Compare page content
 */

add_action('admin_menu', 'writers_blogily_themepage');
function writers_blogily_themepage(){
	$theme_info = add_theme_page( __('Magazinely','magazinely'), __('Magazinely','magazinely'), 'manage_options', 'magazinely-info.php', 'writers_blogily_info_page' );
}

function writers_blogily_info_page() {
	$user = wp_get_current_user();
	?>
	<div class="wrap about-wrap magazinely-add-css">
		<div>
			<h1>
				<?php echo __('Welcome to Magazinely!','magazinely'); ?>
			</h1>

			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo __("Contact Support", "magazinely"); ?></h3>
						<p><?php echo __("Getting started with a new theme can be difficult, if you have issues with Magazinely then throw us an email.", "magazinely"); ?></p>
						<p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/help-contact/', 'magazinely'); ?>" class="button button-primary">
							<?php echo __("Contact Support", "magazinely"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo __("View our other themes", "magazinely"); ?></h3>
						<p><?php echo __("Do you like our concept but feel like the design doesn't fit your need? Then check out our website for more designs.", "magazinely"); ?></p>
						<p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/wordpress-themes/', 'magazinely'); ?>" class="button button-primary">
							<?php echo __("View All Themes", "magazinely"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo __("Premium Edition", "magazinely"); ?></h3>
						<p><?php echo __("If you enjoy Magazinely and want to take your website to the next step, then check out our premium edition here.", "magazinely"); ?></p>
						<p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/magazinely/', 'magazinely'); ?>" class="button button-primary">
							<?php echo __("Read More", "magazinely"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php echo __("Free Vs Premium","magazinely"); ?></h2>
		<div class="magazinely-button-container">
			<a target="blank" href="<?php echo esc_url('https://superbthemes.com/magazinely/', 'magazinely'); ?>" class="button button-primary">
				<?php echo __("Read Full Description", "magazinely"); ?>
			</a>
			<a target="blank" href="<?php echo esc_url('https://superbthemes.com/demo/magazinely/', 'magazinely'); ?>" class="button button-primary">
				<?php echo __("View Theme Demo", "magazinely"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead>
				<tr>
					<th><strong><?php echo __("Theme Feature", "magazinely"); ?></strong></th>
					<th><strong><?php echo __("Basic Version", "magazinely"); ?></strong></th>
					<th><strong><?php echo __("Premium Version", "magazinely"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo __("Hide Featured Images On Blog Posts", "magazinely"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Navigation Logo & Title/Tagline", "magazinely"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Hide Navigation Title and/or Tagline", "magazinely"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Hide Navigation Completely	", "magazinely"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Navigation Colors", "magazinely"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Header & Footer Menu", "magazinely"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>


				<tr>
					<td><?php echo __("Premium Support", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Header Content Slideshow", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Header Image Slideshow	", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Show Slideshow On Front Page", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Slideshow Page Template", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Slideshow Colors	", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Slideshow Title, Tagline & Button", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Images In Slideshows", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Easy Google Fonts", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Featured Articles Page Template	", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Hide About The Author Section On Posts", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Hide Sidebar On Posts", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Hide About The Author Section On Posts", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Hide Sidebar On Pages	", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Hide Sidebar On Blog Feed	", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Post & Page Colors", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Footer Copyright Text", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Sidebar Colors	", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Blog Feed Colors", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Custom Footer Colors", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Page Builder Implementation", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr> 
				<tr>
					<td><?php echo __("SEO Plugins", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Contact Form", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Instagram Feed", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo __("Recent Posts Extended", "magazinely"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "magazinely"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "magazinely"); ?>" /></span></td>
				</tr>

			</tbody>
		</table>

	</div>
	<?php
}


