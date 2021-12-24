<?php

	$wp_customize->add_panel( 'theme_option', array(
			'priority' => 10,
			'title' => __( 'Theme Option', 'newspaper-magazine' ),
			'description' => __( ' Newpaper Magazine Theme Option', 'newspaper-magazine' ),
		)
	);	

	/**********************************************/
	/*************** Top Header *****************/
	/**********************************************/

	// BREAKING NEWS
	$wp_customize->add_section('newspaper_magazine_breaking_news',array(
			'priority' => 20,
			'title' => __('Top Header','newspaper-magazine'),
			'description' => __('Configure Breaking News type and Social icons.','newspaper-magazine'),
			'panel' => 'theme_option',
		)
	);

	$wp_customize->add_setting('news_disable',array(
			'sanitize_callback' => 'newspaper_magazine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'news_disable',array(
			'label' => __('Show Breaking News','newspaper-magazine'),
			'section' => 'newspaper_magazine_breaking_news',
			'settings' => 'news_disable',
			'type'=> 'checkbox',
		)
	));

	$wp_customize->add_setting('breaking_news_title',array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' =>  __( 'Breaking News', 'newspaper-magazine' )
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'breaking_news_title',array(
			'label' => __('Breaking News Title','newspaper-magazine'),
			'type' => 'text',
			'section' => 'newspaper_magazine_breaking_news',
			'settings' => 'breaking_news_title',
		)
	));

	$wp_customize->add_setting('breaking_news_category',array(
			'sanitize_callback' => 'newspaper_magazine_sanitize_category',
			'default' =>  '1',
		)
	);

	$wp_customize->add_control(new Newspaper_Magazine_Theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'breaking_news_category',array(
			'label' => __('Choose Category','newspaper-magazine'),
			'section' => 'newspaper_magazine_breaking_news',
			'settings' => 'breaking_news_category',
			'type'=> 'dropdown-taxonomies',
		)
	));


	
	

   	
	/**********************************************/
	/*************** Footer *****************/
	/**********************************************/
	$wp_customize->add_section('newspaper_magazine_footer',array(
			'priority' => 60,
			'title' => __('Footer Settings','newspaper-magazine'),
			'description' => __('Footer Settings Section.','newspaper-magazine'),
			'panel' => 'theme_option',
		)
	);

	$wp_customize->add_setting('copyright_textbox',array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => ''
		)
	);

	$wp_customize->add_control('copyright_textbox',array(
			'label' => __('Copyright text','newspaper-magazine'),
			'section' => 'newspaper_magazine_footer',
			'settings' => 'copyright_textbox',
			'type' => 'text',
		)
	);

	/**********************************************/
	/*************** Other Setting *****************/
	/**********************************************/
	$wp_customize->add_section('newspaper_magazine_other_setting',array(
			'priority' => 60,
			'title' => __('Other Settings','newspaper-magazine'),
			'description' => __('Other Settings Section.','newspaper-magazine'),
			'panel' => 'theme_option',
		)
	);

	$wp_customize->add_setting('enable_scrolltotop',array(
			'sanitize_callback' => 'newspaper_magazine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'enable_scrolltotop',array(
			'label' => __('Show Scroll To Top Button','newspaper-magazine'),
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'enable_scrolltotop',
			'type'=> 'checkbox',
		)
	));

	$wp_customize->add_setting('enable_searchbutton',array(
			'sanitize_callback' => 'newspaper_magazine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'enable_searchbutton',array(
			'label' => __('Show Search Option On Header','newspaper-magazine'),
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'enable_searchbutton',
			'type'=> 'checkbox',
		)
	));

	$wp_customize->add_setting( 'display_featured_images', array(
			'sanitize_callback' => 'newspaper_magazine_sanitize_checkbox',
			'default'           => '1',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_featured_images', array(
			'label'    => __( 'Display featured images inside posts', 'newspaper-magazine' ),
			'section'  => 'newspaper_magazine_other_setting',
			'settings' => 'display_featured_images',
			'type'     => 'checkbox',
		)
	) );

	$wp_customize->add_setting( 'enable_breadcrumb', array(
			'sanitize_callback' => 'newspaper_magazine_sanitize_checkbox',
			'default'           => '1',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_breadcrumb', array(
			'label'    => __( 'Enable breadcrumb', 'newspaper-magazine' ),
			'section'  => 'newspaper_magazine_other_setting',
			'settings' => 'enable_breadcrumb',
			'type'     => 'checkbox',
		)
	) );

	//SOCIAL LINKS
	$wp_customize->add_setting('profile_facebook',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_facebook',array(
			'label' => __('Facebook','newspaper-magazine'),
			'type' => 'url',
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'profile_facebook',
		)
	));

	$wp_customize->add_setting('profile_twitter',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_twitter',array(
			'label' => __('Twitter','newspaper-magazine'),
			'type' => 'url',
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'profile_twitter',
		)
	));

	$wp_customize->add_setting('profile_linkedin',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_linkedin',array(
			'label' => __('Linkedin','newspaper-magazine'),
			'type' => 'url',
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'profile_linkedin',
		)
	));

	$wp_customize->add_setting('profile_pinterest',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  '',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_pinterest',array(
			'label' => __('Pinterest','newspaper-magazine'),
			'type' => 'url',
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'profile_pinterest',
		)
	));
	$wp_customize->add_setting('profile_instagram',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  '',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_instagram',array(
			'label' => __('Instagram','newspaper-magazine'),
			'type' => 'url',
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'profile_instagram',
		)
	));
	$wp_customize->add_setting('profile_tumblr',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_tumblr',array(
			'label' => __('Tumblr','newspaper-magazine'),
			'type' => 'url',
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'profile_tumblr',
		)
	));
$wp_customize->add_setting('profile_youtube',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  '',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_youtube',array(
			'label' => __('Youtube','newspaper-magazine'),
			'type' => 'url',
			'section' => 'newspaper_magazine_other_setting',
			'settings' => 'profile_youtube',
		)
	));


	/**********************************************/
	/*************** Theme Sidebar *****************/
	/**********************************************/
	
	$wp_customize->add_section('theme_sidebar' , array(
		'priority' => 10,
		'title' => __('Theme Sidebar','newspaper-magazine'),
		'panel' => 'theme_option'
	));

	$wp_customize->add_setting('theme_sidebar_position', array(
		'sanitize_callback' => 'newspaper_magazine_sanitize_sidebar',
		'default' => 'right'
	));

	$wp_customize->add_control('theme_sidebar_position', array(
		'label'      => __('Sidebar Position', 'newspaper-magazine'),
		'section'    => 'theme_sidebar',
		'settings'   => 'theme_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => __('Left','newspaper-magazine'),
			'right'  => __('Right','newspaper-magazine'),
			'none'	 => __('None','newspaper-magazine'),
		),
	));


	
