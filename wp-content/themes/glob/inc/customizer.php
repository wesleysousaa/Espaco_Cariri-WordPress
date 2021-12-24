<?php
/**
 * Glob Theme Customizer.
 *
 * @package Glob
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function glob_customize_register( $wp_customize ) {
    require_once get_template_directory() . '/inc/customizer-controls.php';
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control('display_header_text');
    /*------------------------------------------------------------------------*/
    /*  Tagline and Logo
    /*------------------------------------------------------------------------*/
    $wp_customize->add_setting( 'hide_sitetitle',
        array(
            'sanitize_callback' => 'glob_sanitize_checkbox',
            'default'           => false,
        )
    );
    $wp_customize->add_control(
        'hide_sitetitle',
        array(
            'label' 		=> esc_html__('Hide site title', 'glob'),
            'section' 		=> 'title_tagline',
            'type'          => 'checkbox',
            'priority'      => 47
        )
    );
    $wp_customize->add_setting( 'hide_tagline',
        array(
            'sanitize_callback' => 'glob_sanitize_checkbox',
            'default'           => false
        )
    );
    $wp_customize->add_control(
        'hide_tagline',
        array(
            'label' 		=> esc_html__('Hide site tagline', 'glob'),
            'section' 		=> 'title_tagline',
            'type'          => 'checkbox',
            'priority'      => 48
        )
    );
	/*------------------------------------------------------------------------*/
	/*  Section: Theme Options
	/*------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'glob_panel_options', array(
        'priority'       => 28,
        //'capability'     => 'edit_theme_options',
        'title'          => esc_html__( 'Theme Options', 'glob' ),
        'description'    => '',
    ) );
        /**
         * Header
         */
        $wp_customize->add_section( 'glob_header_settings', array(
            'priority'       => 9,
            'panel'          => 'glob_panel_options',
            'title'          => esc_html__( 'Header', 'glob' ),
            'description'    => '',
        ) );
            $wp_customize->add_setting( 'glob_logo_position',
                array(
                    'default'           => 'left',
                    'sanitize_callback'	=> 'glob_sanitize_select',
                )
            );
            $wp_customize->add_control( 'glob_logo_position',
                array(
                    'label' 		=> esc_html__( 'Logo/Site Identity Position', 'glob' ),
                    'type'			=> 'radio',
                    'section' 		=> 'glob_header_settings',
                    'choices'   	=> array(
                        'left' 	        => esc_html__( 'Left', 'glob' ),
                        'center' 	    => esc_html__( 'Center', 'glob' ),
                        'right'   	 => esc_html__( 'Right', 'glob' )
                    )
                )
            );
            $wp_customize->add_setting( 'glob_breaking_layout',
                array(
                    'default'           => 'boxed',
                    'sanitize_callback'	=> 'glob_sanitize_select',
                )
            );
            $wp_customize->add_control( 'glob_breaking_layout',
                array(
                    'label' 		=> esc_html__( 'Breaking News Sticker Layout', 'glob' ),
                    'type'			=> 'radio',
                    'section' 		=> 'glob_header_settings',
                    'choices'   	=> array(
                        'boxed' 	        => esc_html__( 'Boxed', 'glob' ),
                        'fullwidth' 	    => esc_html__( 'Full Width', 'glob' )
                    )
                )
            );
            $wp_customize->add_setting( 'glob_nav_layout',
                array(
                    'default'           => 'boxed',
                    'sanitize_callback'	=> 'glob_sanitize_select',
                )
            );
            $wp_customize->add_control( 'glob_nav_layout',
                array(
                    'label' 		=> esc_html__( 'Primary Navigation Layout', 'glob' ),
                    'type'			=> 'radio',
                    'section' 		=> 'glob_header_settings',
                    'choices'   	=> array(
                        'boxed' 	        => esc_html__( 'Boxed', 'glob' ),
                        'fullwidth' 	    => esc_html__( 'Full Width', 'glob' )
                    )
                )
            );
           
                $wp_customize->add_setting('glob_nav_bg_color',
                    array(
                        'default' => '1',
                        'sanitize_callback' => 'sanitize_text_field',
                    )
                );
                $wp_customize->add_control( new Glob_Message_Control( $wp_customize, 'glob_nav_bg_color', array(
                    'label'        => esc_html__( 'Navigation Background Colors', 'glob' ),
                    'description'  => sprintf( esc_html__( 'Upgrade to %1s in order to change the navigation background colors.', 'glob' ), '<a target="_blank" href="' . glob_get_premium_url() . '">Glob Pro</a>' ),
                    'section'      => 'glob_header_settings',
                    'type'         => 'message',
                ) ) );
            
        /**
         * Breaking News
         */
        $wp_customize->add_section( 'glob_breaking_news', array(
            'priority'       => 10,
            'panel'          => 'glob_panel_options',
            'title'          => esc_html__( 'Breaking news', 'glob' ),
            'description'    => '',
        ) );
        $wp_customize->add_setting('glob_breaking_news_enable',
            array(
                'sanitize_callback' => 'glob_sanitize_checkbox',
                'default' => 1
            )
        );
        $wp_customize->add_control(
            'glob_breaking_news_enable',
            array(
                'label' => esc_html__('Enable Breaking News', 'glob'),
                'section' => 'glob_breaking_news',
                'type' => 'checkbox',
            )
        );
        $wp_customize->add_setting( 'breaking_news_label',
            array(
                'default'           => esc_html__( 'Breaking', 'glob' ),
                'sanitize_callback'	=> 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( 'breaking_news_label',
            array(
                'label' 		=> esc_html__( 'Label', 'glob' ),
                'type'			=> 'text',
                'section' 		=> 'glob_breaking_news',
            )
        );
        $wp_customize->add_setting( 'breaking_news_numpost',
            array(
                'default'           => '4',
                'sanitize_callback'	=> 'absint',
            )
        );
        $wp_customize->add_control( 'breaking_news_numpost',
            array(
                'label' 		=> esc_html__( 'Number posts to show', 'glob' ),
                'type'			=> 'text',
                'section' 		=> 'glob_breaking_news',
            )
        );
        $wp_customize->add_setting( 'breaking_news_tag',
            array(
                'default'           => '',
                'sanitize_callback'	=> 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( 'breaking_news_tag',
            array(
                'label' 		=> esc_html__( 'Tags', 'glob' ),
                'type'			=> 'text',
                'description'	=> esc_html__( 'Easily breaking all posts with the tags of your choice. Separated by comma (,).', 'glob' ),
                'section' 		=> 'glob_breaking_news',
            )
        );
        /**
         * Layout
         */
        $wp_customize->add_section( 'glob_archive_section', array(
            'priority'       => 30,
            'panel'          => 'glob_panel_options',
            'title'          => esc_html__( 'Archive Layout', 'glob' ),
            'description'    => '',
        ) );
        $wp_customize->add_setting( 'glob_archive_layout',
            array(
                'default'           => 'grid',
                'sanitize_callback'	=> 'glob_sanitize_select',
            )
        );
        $wp_customize->add_control( 'glob_archive_layout',
            array(
                'label' 		=> esc_html__( 'Archive Layout', 'glob' ),
                'description'	=> esc_html__( 'Apply for archive pages.', 'glob' ),
                'type'			=> 'radio',
                'section' 		=> 'glob_archive_section',
                'choices'   	=> array(
                    'grid' 	=> esc_html__( 'Grid', 'glob' ),
                    'list'   	=> esc_html__( 'List', 'glob' )
                )
            )
        );
        /**
         * Singe post
         */
        $wp_customize->add_section( 'glob_single_section', array(
            'priority'       => 30,
            'panel'          => 'glob_panel_options',
            'title'          => esc_html__( 'Single Post', 'glob' ),
            'description'    => '',
        ) );
        $wp_customize->add_setting( 'single_enable_feature_image',
            array(
                'default'           => '1',
                'sanitize_callback'	=> 'glob_sanitize_checkbox',
            )
        );
        $wp_customize->add_control( 'single_enable_feature_image',
            array(
                'label' 		=> esc_html__( 'Enable Featured image', 'glob' ),
                'type'			=> 'checkbox',
                'section' 		=> 'glob_single_section',
            )
        );
        $wp_customize->add_setting( 'single_enable_author',
            array(
                'default'           => '1',
                'sanitize_callback'	=> 'glob_sanitize_checkbox',
            )
        );
        $wp_customize->add_control( 'single_enable_author',
            array(
                'label' 		=> esc_html__( 'Enable Post Author', 'glob' ),
                'type'			=> 'checkbox',
                'section' 		=> 'glob_single_section',
            )
        );
        $wp_customize->add_setting( 'single_enable_post_date',
            array(
                'default'           => '1',
                'sanitize_callback'	=> 'glob_sanitize_checkbox',
            )
        );
        $wp_customize->add_control( 'single_enable_post_date',
            array(
                'label' 		=> esc_html__( 'Enable Post Date', 'glob' ),
                'type'			=> 'checkbox',
                'section' 		=> 'glob_single_section',
            )
        );
        $wp_customize->add_setting( 'single_enable_comment_count',
            array(
                'default'           => '1',
                'sanitize_callback'	=> 'glob_sanitize_checkbox',
            )
        );
        $wp_customize->add_control( 'single_enable_comment_count',
            array(
                'label' 		=> esc_html__( 'Enable Comment Count', 'glob' ),
                'type'			=> 'checkbox',
                'section' 		=> 'glob_single_section',
            )
        );
       
            $wp_customize->add_setting('single_enable_social',
                array(
                    'default' => '1',
                    'sanitize_callback' => 'sanitize_text_field',
                )
            );
            $wp_customize->add_control( new Glob_Message_Control( $wp_customize, 'single_enable_social', array(
                'label'        => esc_html__( 'Enable Social Share', 'glob' ),
                'description'  => sprintf( esc_html__( 'Upgrade to %1s in order to enable social share.', 'glob' ), '<a target="_blank" href="' . glob_get_premium_url() . '">Glob Pro</a>' ),
                'section'      => 'glob_single_section',
                'type'         => 'message',
            ) ) );
            $wp_customize->add_setting('single_enable_author_box',
                array(
                    'default' => '1',
                    'sanitize_callback' => 'sanitize_text_field',
                )
            );
            $wp_customize->add_control( new Glob_Message_Control( $wp_customize, 'single_enable_author_box', array(
                'label'        => esc_html__( 'Enable Author Box', 'glob' ),
                'description'  => sprintf( esc_html__( 'Upgrade to %1s in order to enable author box.', 'glob' ), '<a target="_blank" href="' . glob_get_premium_url() . '">Glob Pro</a>' ),
                'section'      => 'glob_single_section',
                'type'         => 'message',
            ) ) );
        
        /**
         * Footer
         */
        $wp_customize->add_section( 'glob_footer_section', array(
            'priority'       => 190,
            'panel'          => 'glob_panel_options',
            'title'          => esc_html__( 'Footer Settings', 'glob' ),
            'description'    => '',
        ) );
        $wp_customize->add_setting( 'footer_layout',
            array(
                'default'           => '4',
                'sanitize_callback'	=> 'glob_sanitize_select',
            )
        );
        $wp_customize->add_control( 'footer_layout',
            array(
                'label' 		=> esc_html__( 'Footer Layout', 'glob' ),
                'description'	=> esc_html__( 'Number footer columns to display.', 'glob' ),
                'type'			=> 'select',
                'section' 		=> 'glob_footer_section',
                'choices'   	=> array(
                    '1' 	=> esc_html__( '1 Column', 'glob' ),
                    '2'   	=> esc_html__( '2 Columns', 'glob' ),
                    '3'   	=> esc_html__( '3 Columns', 'glob' ),
                    '4'   	=> esc_html__( '4 Columns', 'glob' ),
                )
            )
        );
        $wp_customize->add_setting( 'footer_4_columns',
            array(
                'default'           => '3+3+3+3',
                'sanitize_callback'	=> 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( 'footer_4_columns',
            array(
                'label' 		=> esc_html__( 'Custom footer 4 columns width', 'glob' ),
                'description'	=> esc_html__( 'Enter int numbers and sum of them must smaller or equal 12, separated by "+"', 'glob' ),
                'section' 		=> 'glob_footer_section',
            )
        );
        $wp_customize->add_setting( 'footer_3_columns',
            array(
                'default'           => '4+4+4',
                'sanitize_callback'	=> 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( 'footer_3_columns',
            array(
                'label' 		=> esc_html__( 'Custom footer 3 columns width', 'glob' ),
                'description'	=> esc_html__( 'Enter int numbers and sum of them must smaller or equal 12, separated by "+"', 'glob' ),
                'section' 		=> 'glob_footer_section',
            )
        );
        $wp_customize->add_setting( 'footer_2_columns',
            array(
                'default'           => '6+6',
                'sanitize_callback'	=> 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( 'footer_2_columns',
            array(
                'label' 		=> esc_html__( 'Custom footer 2 columns width', 'glob' ),
                'description'	=> esc_html__( 'Enter int numbers and sum of them must smaller or equal 12, separated by "+"', 'glob' ),
                'section' 		=> 'glob_footer_section',
            )
        );
       
            $wp_customize->add_setting( 'footer__message' , array(
                'sanitize_callback'	=> 'sanitize_text_field',
                'default'     => '',
            ) );
            $wp_customize->add_control( new Glob_Message_Control( $wp_customize, 'footer__message', array(
                'label'        => esc_html__( 'Change Footer Copyright Text and Hide Theme Author Link', 'glob' ),
                'description'  => sprintf( esc_html__( 'Upgrade to %1s in order to change site footer copyright information and hide theme author link via Customizer.', 'glob' ), '<a target="_blank" href="' . glob_get_premium_url() . '">Glob Pro</a>' ),
                'section'      => 'glob_footer_section',
                'priority'     => 190,
                'type'         => 'message',
            ) ) );
        
        // settings
		$wp_customize->add_setting( 'glob_homepage_layout',
			array(
				'default'           => 'default',
				'sanitize_callback'	=> 'glob_sanitize_select',
			)
		);
		$wp_customize->add_control( 'glob_homepage_layout',
			array(
				'label' 		=> esc_html__( 'Posts page layout', 'glob' ),
				'description'	=> esc_html__( 'Apply when front page display is latest posts.', 'glob' ),
				'type'			=> 'radio',
				'section' 		=> 'static_front_page',
				'choices'   	=> array(
					'default' 	=> esc_html__( 'Default', 'glob' ),
					'home1'   	=> esc_html__( 'List', 'glob' )
				)
			)
		);
		// Primary color setting
		$wp_customize->add_setting( 'primary_color' , array(
			'sanitize_callback'	=> 'sanitize_hex_color',
			'default'     => '#fa4c2a',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
			'label'        => esc_html__( 'Primary Color', 'glob' ),
			'section'    => 'colors',
			'settings'   => 'primary_color',
		) ) );
		// Second color setting
		$wp_customize->add_setting( 'secondary_color' , array(
			'default'     => '#494949',
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
			'label'        => esc_html__( 'Secondary Color', 'glob' ),
			'section'    => 'colors',
			'settings'   => 'secondary_color',
		) ) );
       
       
            $wp_customize->add_section( 'glob_pro', array(
                'title' => esc_html__( 'View PRO Version', 'glob' ),
                'priority'     => 300,
            ) );
            $wp_customize->add_setting( 'glob_pro' , array(
                'sanitize_callback'	=> 'sanitize_text_field',
                'default'     => '',
            ) );
            $wp_customize->add_control( new Glob_Message_Control( $wp_customize, 'glob_pro', array(
                'label'        => '',
                'description'  => '',
                'section'      => 'glob_pro',
                'priority'     => 190,
                'type'         => 'list',
                'list'         => array(
                    esc_html__( 'Advanced typography settings', 'glob' ),
                    esc_html__( '600+ google fonts.', 'glob' ),
                    esc_html__( 'Custom navigation style.', 'glob' ),
                    esc_html__( 'More block post widgets.', 'glob' ),
                    esc_html__( 'More hero style widgets.', 'glob' ),
                    esc_html__( 'Social sharing features.', 'glob' ),
                    esc_html__( 'Author box with social.', 'glob' ),
                    esc_html__( 'More sidebar location.', 'glob' ),
                    esc_html__( 'Live change footer text.', 'glob' ),
                    esc_html__( 'Hide theme author links', 'glob' ),
                    esc_html__( 'Premium email support.', 'glob' ),
                ),
                'button' => array(
                    'link' => glob_get_premium_url(),
                    'label' => esc_html__( 'Upgrade to Glob Pro', 'glob' ),
                )
            ) ) );
        
}
add_action( 'customize_register', 'glob_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function glob_customize_preview_js() {
	wp_enqueue_script( 'glob-customizer-preview', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'glob_customize_preview_js' );
/**
 * Load customizer css
 */
function glob_customizer_load_scripts(){
    wp_enqueue_style( 'glob-customizer', get_template_directory_uri() . '/assets/css/customizer.css' );
    wp_enqueue_script( 'glob-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-controls', 'wp-color-picker' ) );
    // Pro
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_localize_script( 'glob-customizer', 'Glob_Customizer', array(
        'menus' => get_registered_nav_menus(),
        'color_menu' => esc_html__( 'Setup color for: ', 'glob' ),
        'setup_colors' => esc_html__( 'Setup colors', 'glob' )
    ) );
}
add_action('customize_controls_print_scripts', 'glob_customizer_load_scripts');
/*------------------------------------------------------------------------*/
/*  Glob Sanitize Functions.
/*------------------------------------------------------------------------*/
function glob_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function glob_sanitize_checkbox( $input ){
    if ( $input == 1 || $input == 'true' || $input === true ) {
        return 1;
    } else {
        return 0;
    }
}
