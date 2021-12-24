<?php
/**
 * Newsphere functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsphere
 */

if (!function_exists('newsphere_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
    /**
     *
     */
    /**
     *
     */
    function newsphere_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Newsphere, use a find and replace
	 * to change 'newsphere' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('newsphere', get_template_directory().'/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');
        // Add featured image sizes
        add_image_size('newsphere-slider-full', 1280, 720, true); // width, height, crop
        add_image_size('newsphere-featured', 1024, 0, false ); // width, height, crop
        add_image_size('newsphere-medium', 720, 380, true); // width, height, crop


    /*
     * Enable support for Post Formats on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array( 'image', 'video', 'gallery' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
			'aft-primary-nav' => esc_html__('Primary Menu', 'newsphere'),
			'aft-social-nav' => esc_html__('Social Menu', 'newsphere'),
			'aft-footer-nav' => esc_html__('Footer Menu', 'newsphere'),
		));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

	// Set up the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('newsphere_custom_background_args', array(
				'default-color' => 'f3f3f3',
				'default-image' => '',
			)));

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		));



	    /*
	    * Add theme support for gutenberg block
	    */
	    add_theme_support( 'align-wide' );


    }
endif;
add_action('after_setup_theme', 'newsphere_setup');

/**
 * Demo export/import
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Newsphere
 */
if (!function_exists('newsphere_ocdi_files')) :
    /**
     * OCDI files.
     *
     * @since 1.0.0
     *
     * @return array Files.
     */
    function newsphere_ocdi_files() {

        return apply_filters( 'aft_demo_import_files', array(
            array(

                'import_file_name'             => esc_html__( 'Newsphere Default', 'newsphere' ),
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/default/newsphere.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/default/newsphere.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/default/newsphere.dat',
                'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/newsphere.jpg',
                'preview_url'                  => 'https://demo.afthemes.com/newsphere/',
            ),
            array(

                'import_file_name'             => esc_html__( 'Newsphere Sport', 'newsphere' ),
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/sport/newsphere.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/sport/newsphere.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/sport/newsphere.dat',
                'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/sport.jpg',
                'preview_url'                  => 'https://demo.afthemes.com/newsphere/sport',
            ),
            array(

                'import_file_name'             => esc_html__( 'Newsphere Fashion', 'newsphere' ),
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/fashion/newsphere.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/fashion/newsphere.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/fashion/newsphere.dat',
                'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/fashion.jpg',
                'preview_url'                  => 'https://demo.afthemes.com/newsphere/fashion',
            ),
        ));
    }
endif;
add_filter( 'pt-ocdi/import_files', 'newsphere_ocdi_files');

/**
 * function for google fonts
 */
if (!function_exists('newsphere_fonts_url')):

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function newsphere_fonts_url() {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Oswald, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Roboto Sans Pro font: on or off', 'newsphere')) {
            $fonts[] = 'Roboto:100,300,400,500,700';
        }

        /* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Rubik font: on or off', 'newsphere')) {
            $fonts[] = 'Rubik:300,300i,400,400i,500,500i,700,700i,900,900i';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }

        return $fonts_url;
    }
endif;


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newsphere_content_width() {
	$GLOBALS['content_width'] = apply_filters('newsphere_content_width', 640);
}
add_action('after_setup_theme', 'newsphere_content_width', 0);




/**
 * Enqueue scripts and styles.
 */
function newsphere_scripts() {

	$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG?'':'.min';
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome'.$min.'.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/bootstrap/css/bootstrap'.$min.'.css');
    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/swiper/css/swiper'.$min.'.css');
	wp_enqueue_style('sidr', get_template_directory_uri().'/assets/sidr/css/jquery.sidr.dark.css');
	wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/magnific-popup/magnific-popup.css');


    $fonts_url = newsphere_fonts_url();

    if (!empty($fonts_url)) {
        wp_enqueue_style('newsphere-google-fonts', $fonts_url, array(), null);
    }

    /**
     * Load WooCommerce compatibility file.
     */
    if (class_exists('WooCommerce')) {
        wp_enqueue_style('newsphere-woocommerce-style', get_template_directory_uri() . '/woocommerce.css');

        $font_path = WC()->plugin_url() . '/assets/fonts/';
        $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

        wp_add_inline_style('newsphere-woocommerce-style', $inline_font);
    }


	wp_enqueue_style('newsphere-style', get_stylesheet_uri());

	wp_enqueue_script('newsphere-navigation', get_template_directory_uri().'/js/navigation.js', array(), '20151215', true);
	wp_enqueue_script('newsphere-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/swiper/js/swiper'.$min.'.js', array('jquery'), '', true);


    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/bootstrap/js/bootstrap'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('sidr', get_template_directory_uri().'/assets/sidr/js/jquery.sidr'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('magnific-popup', get_template_directory_uri().'/assets/magnific-popup/jquery.magnific-popup'.$min.'.js', array('jquery'), '', true);

	wp_enqueue_script('matchheight', get_template_directory_uri().'/assets/jquery-match-height/jquery.matchHeight'.$min.'.js', array('jquery'), '', true);

    wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/marquee/jquery.marquee.js', array('jquery'), '', true);
    wp_enqueue_script('sticky-sidebar', get_template_directory_uri() . '/assets/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);

    wp_enqueue_script('newsphere-script', get_template_directory_uri().'/assets/script.js', array('jquery'), '', 1);
	
$enable_sticky_header_option = newsphere_get_option('enable_sticky_header_option');
    if($enable_sticky_header_option == true ){
    wp_enqueue_script('newsphere-fixed-header-script', get_template_directory_uri().'/assets/fixed-header-script.js', array('jquery'), '', 1);
}

	wp_enqueue_script( 'newsphere-pagination-js',  get_template_directory_uri().'/assets/pagination-script.js', array('jquery'), '', true );

	$localized_args = newsphere_pagination_scripts_args();

	wp_localize_script('newsphere-pagination-js', 'AFurl', $localized_args);


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'newsphere_scripts');



/**
 * Enqueue admin scripts and styles.
 *
 * @since Newsphere 1.0.0
 */
function newsphere__admin_scripts($hook){
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('newsphere-widgets', get_template_directory_uri() . '/assets/widgets.js', array('jquery'), '1.0.0', true);
    }


}
add_action('admin_enqueue_scripts', 'newsphere__admin_scripts');



/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-images.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory().'/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory().'/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/init.php';


/**
 * Customizer additions.
 */
require get_template_directory().'/inc/ocdi.php';



/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory().'/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Descriptions on Header Menu
 * @author AF themes
 * @param string $item_output, HTML outputp for the menu item
 * @param object $item, menu item object
 * @param int $depth, depth in menu structure
 * @param object $args, arguments passed to wp_nav_menu()
 * @return string $item_output
 */
function newsphere_header_menu_desc( $item_output, $item, $depth, $args ) {

    if( 'aft-primary-nav' == $args->theme_location  && $item->description )
        $item_output = str_replace( '</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output );

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'newsphere_header_menu_desc', 10, 4 );

function newsphere_menu_notitle( $menu ){
    return $menu = preg_replace('/ title=\"(.*?)\"/', '', $menu );

}
add_filter( 'wp_nav_menu', 'newsphere_menu_notitle' );
add_filter( 'wp_page_menu', 'newsphere_menu_notitle' );
add_filter( 'wp_list_categories', 'newsphere_menu_notitle' );


function print_pre($args)
{
    if ($args) {
        echo "<pre>";
        print_r($args);
        echo "</pre>";
    } else {
        echo "<pre>";
        print_r('Empty');
        echo "</pre>";
    }

}

//
//===============

