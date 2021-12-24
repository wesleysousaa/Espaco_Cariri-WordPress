<?php
/**
 * News Portal Header Settings panel at Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_header_settings_register' );

function news_portal_header_settings_register( $wp_customize ) {

	/**
     * Add Header Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'news_portal_header_settings_panel',
	    array(
	        'priority'       => 10,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Header Settings', 'news-portal' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
	
	/**
     * Top Header Section
     */
    $wp_customize->add_section(
        'news_portal_top_header_section',
        array(
            'title'     => __( 'Top Header Section', 'news-portal' ),
            'priority'  => 5,
            'panel'     => 'news_portal_header_settings_panel'
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_top_header_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'news_portal_top_header_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Top Header Section', 'news-portal' ),
                'description'   => esc_html__( 'Show/Hide option for top header section.', 'news-portal' ),
                'section'   => 'news_portal_top_header_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Switch option for Current Date
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_top_date_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'news_portal_top_date_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Current Date', 'news-portal' ),
                'description'   => esc_html__( 'Show/Hide option for current date at top header section.', 'news-portal' ),
                'section'   => 'news_portal_top_header_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Switch option for Social Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_top_social_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'news_portal_top_social_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Social Icons', 'news-portal' ),
                'description'   => esc_html__( 'Show/Hide option for social media icons at top header section.', 'news-portal' ),
                'section'   => 'news_portal_top_header_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal' )
                    ),
                'priority'  => 15,
            )
        )
    );
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Header Section
     */
    $wp_customize->add_section(
        'news_portal_header_option_section',
        array(
            'title'     => __( 'Header Option', 'news-portal' ),
            'priority'  => 10,
            'panel'     => 'news_portal_header_settings_panel'
        )
    );    

    /**
     * Switch option for primary menu sticky
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_menu_sticky_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'news_portal_menu_sticky_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Sticky Menu', 'news-portal' ),
                'description'   => esc_html__( 'Enable/Disable option for sticky menu.', 'news-portal' ),
                'section'   => 'news_portal_header_option_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Enable', 'news-portal' ),
                    'hide'  => esc_html__( 'Disable', 'news-portal' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Switch option for Home Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_home_icon_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'news_portal_home_icon_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Home Icon', 'news-portal' ),
                'description'   => esc_html__( 'Show/Hide option for home icon at primary menu.', 'news-portal' ),
                'section'   => 'news_portal_header_option_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Switch option for Search Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_search_icon_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'news_portal_search_icon_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Search Icon', 'news-portal' ),
                'description'   => esc_html__( 'Show/Hide option for search icon at primary menu.', 'news-portal' ),
                'section'   => 'news_portal_header_option_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal' )
                    ),
                'priority'  => 15,
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Ticker Section
     */
    $wp_customize->add_section(
        'news_portal_ticker_section',
        array(
            'title'     => __( 'Ticker Section', 'news-portal' ),
            'priority'  => 15,
            'panel'     => 'news_portal_header_settings_panel'
        )
    );

    /**
     * Switch option for ticker section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_ticker_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'news_portal_ticker_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Ticker Option', 'news-portal' ),
                'description'   => esc_html__( 'Show/Hide option for news ticker section.', 'news-portal' ),
                'section'   => 'news_portal_ticker_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Text field for ticker caption
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_ticker_caption',
        array(
            'default'    => __( 'Breaking News', 'news-portal' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'news_portal_ticker_caption',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Ticker Caption', 'news-portal' ),
            'section'   => 'news_portal_ticker_section',
            'priority'  => 10
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'news_portal_ticker_caption', 
        array(
            'selector' => '.ticker-caption',
            'render_callback' => 'news_portal_customize_partial_ticker_caption',
        )
    );
}