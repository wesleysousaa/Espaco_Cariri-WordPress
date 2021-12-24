<?php
/**
 * Newspaper Magazine Theme Customizer
 *
 * @package Newspaper_Magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspaper_magazine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// 
	require_once trailingslashit( get_template_directory() ) . '/inc/class.php'; 

	// Sanitization Callback
	require_once trailingslashit( get_template_directory() ) . '/inc/sanitize.php'; 

	// Customization Options
	require_once trailingslashit( get_template_directory() ) . '/inc/options.php';

	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Newspaper_Magazine_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Newspaper_Magazine_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Newspaper Magazine Pro', 'newspaper-magazine' ),
				'pro_text' => esc_html__( 'Buy Pro', 'newspaper-magazine' ),
				'pro_url'  => 'http://hummingbirdthemes.com/themes/newspaper-magazine-pro-wordpress-theme/',
				'priority' => 1,
			)
		)
	);

}
add_action( 'customize_register', 'newspaper_magazine_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newspaper_magazine_customize_preview_js() {
	wp_enqueue_script( 'newspaper_magazine_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'newspaper_magazine_customize_preview_js' );

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.4
 */
function newspaper_magazine_customizer_control_scripts() {

	wp_enqueue_script( 'newspaper-magazine-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

	wp_enqueue_style( 'newspaper-magazine-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'newspaper_magazine_customizer_control_scripts', 0 );
