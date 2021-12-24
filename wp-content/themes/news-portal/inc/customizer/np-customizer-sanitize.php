<?php
/**
 * File to sanitize customizer field
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/**
 * Sanitize checkbox value
 *
 * @since 1.0.1
 */
function news_portal_sanitize_checkbox( $input ) {
    //returns true if checkbox is checked
    return ( ( isset( $input ) && 'true' == $input ) ? 'true' : 'false' );
}

/**
 * Sanitize repeater value
 *
 * @since 1.0.0
 */
function news_portal_sanitize_repeater( $input ){
    $input_decoded = json_decode( $input, true );
        
    if( !empty( $input_decoded ) ) {
        foreach ( $input_decoded as $boxes => $box ){
            foreach ( $box as $key => $value ){
                $input_decoded[$boxes][$key] = wp_kses_post( $value );
            }
        }
        return json_encode( $input_decoded );
    }
    
    return $input;
}

/**
 * Sanitize site layout
 *
 * @since 1.0.0
 */
function news_portal_sanitize_site_layout( $input ) {
    $valid_keys = array(
        'fullwidth_layout' => __( 'Fullwidth Layout', 'news-portal' ),
        'boxed_layout' => __( 'Boxed Layout', 'news-portal' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * switch option (show/hide)
 *
 * @since 1.0.0
 */
function news_portal_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => __( 'Show', 'news-portal' ),
            'hide'  => __( 'Hide', 'news-portal' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Render the site title for the selective refresh partial.
 *
 * @since News Portal 1.0.1
 * @see news_portal_customize_register()
 *
 * @return void
 */
function news_portal_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since News Portal 1.0.1
 * @see news_portal_customize_register()
 *
 * @return void
 */
function news_portal_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since News Portal 1.0.1
 * @see news_portal_footer_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_copyright() {
    return get_theme_mod( 'news_portal_copyright_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since News Portal 1.0.1
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_related_title() {
    return get_theme_mod( 'news_portal_related_posts_title' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since News Portal 1.0.1
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_archive_more() {
    return get_theme_mod( 'news_portal_archive_read_more_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since News Portal 1.0.1
 * @see news_portal_header_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_ticker_caption() {
    return get_theme_mod( 'news_portal_ticker_caption' );
}