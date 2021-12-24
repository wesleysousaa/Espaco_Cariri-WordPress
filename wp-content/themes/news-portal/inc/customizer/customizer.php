<?php
/**
 * News Portal Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_portal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
    $wp_customize->selective_refresh->add_partial( 
        'blogname', 
        array(
            'selector' => '.site-title a',
            'render_callback' => 'news_portal_customize_partial_blogname',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blogdescription', 
        array(
            'selector' => '.site-description',
            'render_callback' => 'news_portal_customize_partial_blogdescription',
        )
    );

    /**
     * Register custom section types.
     *
     * @since 1.0.6
     */
    $wp_customize->register_section_type( 'News_Portal_Customize_Section_Upsell' );

    /**
     * Register theme upsell sections.
     *
     * @since 1.0.6
     */
    $wp_customize->add_section( new News_Portal_Customize_Section_Upsell(
        $wp_customize,
            'theme_upsell',
            array(
                'title'    => esc_html__( 'News Portal Pro', 'news-portal' ),
                'pro_text' => esc_html__( 'Buy Pro', 'news-portal' ),
                'pro_url'  => 'https://mysterythemes.com/wp-themes/news-portal-pro/',
                'priority'  => 1,
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------*/
    /**
     * Add Important theme links
     *
     * @since 1.1.0
     */
    $wp_customize->add_section(
        'news_portal_imp_link_section',
        array(
            'title'      => __( 'Important Theme Links', 'news-portal' ),
            'priority'   => 35
        )
    );

    $wp_customize->add_setting(
        'news_portal_imp_links',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control( new News_Portal_Info_Content(
        $wp_customize,
            'news_portal_imp_links',
            array(
                'section'       => 'news_portal_imp_link_section',
                'description'   => '<a class="mt-imp-link" href="http://docs.mysterythemes.com/news-portal/" target="_blank">'.__( 'Documentation', 'news-portal' ).'</a><a class="mt-imp-link" href="http://demo.mysterythemes.com/news-portal-landing/" target="_blank">'.__( 'Live Demo', 'news-portal' ).'</a><a class="mt-imp-link" href="https://mysterythemes.com/support/forum/themes/free-themes/news-portal/" target="_blank">'.__( 'Support Forum', 'news-portal' ).'</a><a class="mt-imp-link" href="https://www.facebook.com/mysterythemes/" target="_blank">'.__( 'Like Us in Facebook', 'news-portal' ).'</a><a class="mt-imp-link" href="https://mysterythemes.com/wp-themes/news-portal-pro/" target="_blank">'.__( 'Upgrade to Pro', 'news-portal' ).'</a>',
            )
        )
    );

    $wp_customize->add_setting(
        'news_portal_rate_us',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control( new News_Portal_Info_Content( 
        $wp_customize,
            'news_portal_rate_us',
            array(
                'section'       => 'news_portal_imp_link_section',
                'description'   => sprintf(__( 'Please do rate our theme if you liked it %s', 'news-portal' ), '<a class="mt-imp-link" href="https://wordpress.org/support/theme/news-portal/reviews/?filter=5" target="_blank">Rate/Review</a>' ),
            )
        )
    );

}
add_action( 'customize_register', 'news_portal_customize_register' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function news_portal_customize_preview_js() {
	wp_enqueue_script( 'news_portal_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'news_portal_customize_preview_js' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function news_portal_customize_backend_scripts() {

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
    
    wp_enqueue_style( 'news_portal_admin_customizer_style', get_template_directory_uri() . '/assets/css/np-customizer-style.css' );

    wp_enqueue_script( 'news_portal_admin_customizer', get_template_directory_uri() . '/assets/js/np-customizer-controls.js', array( 'jquery', 'customize-controls' ), '20170616', true );
}
add_action( 'customize_controls_enqueue_scripts', 'news_portal_customize_backend_scripts', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load required files for customizer section
 *
 * @since 1.0.0
 */

require get_template_directory() . '/inc/customizer/np-general-panel.php';          // General Settings
require get_template_directory() . '/inc/customizer/np-header-panel.php';  		    // Header Settings
require get_template_directory() . '/inc/customizer/np-additional-panel.php';       // Additional Settings
require get_template_directory() . '/inc/customizer/np-design-panel.php';           // Design Settings
require get_template_directory() . '/inc/customizer/np-footer-panel.php';           // Footer Settings

require get_template_directory() . '/inc/customizer/np-custom-classes.php';         // Custom Classes
require get_template_directory() . '/inc/customizer/np-customizer-sanitize.php';    // Customizer Sanitize