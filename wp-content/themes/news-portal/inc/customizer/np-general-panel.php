<?php
/**
 * News Portal General Settings panel at Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_general_settings_register' );

function news_portal_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';
    $wp_customize->get_section( 'colors' )->panel    = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';
    $wp_customize->get_section( 'background_image' )->panel = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';
    $wp_customize->get_section( 'static_front_page' )->panel = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'news_portal_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'General Settings', 'news-portal' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Color option for theme
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_theme_color',
        array(
            'default'     => '#029FB2',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'news_portal_theme_color',
            array(
                'label'      => __( 'Theme Color', 'news-portal' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );

    /**
     * Title Color
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting(
        'news_portal_site_title_color',
        array(
            'default'     => '#029FB2',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'news_portal_site_title_color',
            array(
                'label'      => __( 'Header Text Color', 'news-portal' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );
    
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Website layout section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'news_portal_website_layout_section',
        array(
            'title'         => __( 'Website Layout', 'news-portal' ),
            'description'   => __( 'Choose a site to display your website more effectively.', 'news-portal' ),
            'priority'      => 55,
            'panel'         => 'news_portal_general_settings_panel',
        )
    );
    
    $wp_customize->add_setting(
        'news_portal_site_layout',
        array(
            'default'           => 'fullwidth_layout',
            'sanitize_callback' => 'news_portal_sanitize_site_layout',
        )       
    );
    $wp_customize->add_control(
        'news_portal_site_layout',
        array(
            'type'          => 'radio',
            'priority'      => 5,
            'label'         => __( 'Site Layout', 'news-portal' ),
            'section'       => 'news_portal_website_layout_section',
            'choices'       => array(
                'fullwidth_layout' => __( 'FullWidth Layout', 'news-portal' ),
                'boxed_layout' => __( 'Boxed Layout', 'news-portal' )
            ),
        )
    );
/*------------------------------------------------------------------------------------------*/
    /**
     * Title and tagline checkbox
     *
     * @since 1.0.1
     */
    $wp_customize->add_setting( 
        'news_portal_site_title_option', 
        array(
            'default' => 'true',
            'sanitize_callback' => 'news_portal_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 
        'news_portal_site_title_option', 
        array(
            'label'     => esc_html__( 'Display Site Title and Tagline', 'news-portal' ),
            'section'   => 'title_tagline',
            'type'      => 'checkbox'
        )
    );

}