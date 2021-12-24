<?php
/**
 * News Portal custom function and work related to widgets.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function news_portal_widgets_init() {
	
	/**
	 * Register right sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'news-portal' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register left sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'news-portal' ),
		'id'            => 'news_portal_left_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register header ads area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Header Ads', 'news-portal' ),
		'id'            => 'news_portal_header_ads_area',
		'description'   => esc_html__( 'Add banner widgets here.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home top section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Top Section', 'news-portal' ),
		'id'            => 'news_portal_home_top_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="np-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register home middle section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle Section', 'news-portal' ),
		'id'            => 'news_portal_home_middle_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="np-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register home middle aside area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle Aside', 'news-portal' ),
		'id'            => 'news_portal_home_middle_aside_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="np-block-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home bottom section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Bottom Section', 'news-portal' ),
		'id'            => 'news_portal_home_bottom_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="np-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register 4 different footer area 
	 *
	 * @since 1.0.0
	 */
	register_sidebars( 4 , array(
		'name'          => esc_html__( 'Footer %d', 'news-portal' ),
		'id'            => 'news_portal_footer_sidebar',
		'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'news-portal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'news_portal_widgets_init' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register different widgets
 *
 * @since 1.1.8
 */

add_action( 'widgets_init', 'news_portal_register_widgets' );

function news_portal_register_widgets() {
	
	// Ads Banner widget
	register_widget( 'News_Portal_Ads_Banner' );

	// Block Posts widget
	register_widget( 'News_Portal_Block_Posts' );

	// Carousel widget
	register_widget( 'News_Portal_Carousel' );

	// Default Tabbed widget
	register_widget( 'News_Portal_Default_Tabbed' );

	// Featured Posts widget
	register_widget( 'News_Portal_Featured_Posts' );

	// Featured Slider widget
	register_widget( 'News_Portal_Featured_Slider' );

	// Recent Posts widget
	register_widget( 'News_Portal_Recent_Posts' );

	// Social Media widget
	register_widget( 'News_Portal_Social_Media' );

}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load widget required files
 *
 * @since 1.0.0
 */

require get_template_directory() . '/inc/widgets/np-widget-fields.php';    // Widget fields
require get_template_directory() . '/inc/widgets/np-ads-banner.php';       // Ads banner widget
require get_template_directory() . '/inc/widgets/np-featured-slider.php';  // Featured Slider widget
require get_template_directory() . '/inc/widgets/np-featured-posts.php';   // Featured posts widget
require get_template_directory() . '/inc/widgets/np-block-posts.php';      // Block posts widget
require get_template_directory() . '/inc/widgets/np-carousel.php';  	   // Carousel widget
require get_template_directory() . '/inc/widgets/np-social-media.php';     // Social Media widget
require get_template_directory() . '/inc/widgets/np-recent-posts.php';     // Recent Posts widget
require get_template_directory() . '/inc/widgets/np-default-tabbed.php';   // Default Tabbed widget