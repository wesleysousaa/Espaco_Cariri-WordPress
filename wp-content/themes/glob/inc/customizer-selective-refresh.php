<?php
/**
 * Add customizer selective refresh
 *
 * @since 1.0.0
 *
 * @param $wp_customize
 */
function glob_customizer_partials( $wp_customize )
{
    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }
    $selective_refresh_keys = array(
        array(
            'id' => 'glob_site_branding',
            'selector' => '#site-branding',
            'callback' => 'glob_site_branding',
            'settings' => array(
                'custom_logo',
                'blogname',
                'blogdescription',
                'hide_sitetitle',
                'hide_tagline',
            ),
        ),
    );
    $selective_refresh_keys = apply_filters( 'glob_customizer_selective_refresh_sections', $selective_refresh_keys );
    foreach ( $selective_refresh_keys as $section ) {
        if ( $section['id'] ) {
            foreach ($section['settings'] as $index => $key) {
                if ($wp_customize->get_setting($key)) {
                    $wp_customize->get_setting($key)->transport = 'postMessage';
                } else {
                    // remove not existing setting
                    unset( $section['settings'][ $index ] );
                }
            }
            $func_name = isset( $section['callback'] ) ? $section['callback']: 'glob_selective_refresh_render_section_content';
            $selector = isset( $section['selector']  ) ? $section['selector'] : 'section.section-' . $section['id'] ;
            $wp_customize->selective_refresh->add_partial('section-' . $section['id'], array(
                'selector' => $selector,
                'settings' => $section['settings'],
                'render_callback' => $func_name,
            ));
        }
    }
    // Custom Selective refresh
    $custom_css = array(
        'primary_color',
        'secondary_color',
        'primary_menu_colors',
    );
    foreach ( $custom_css as $index => $key ) {
        if ( $wp_customize->get_setting( $key ) ) {
            $wp_customize->get_setting( $key )->transport = 'postMessage';
        } else {
            unset( $custom_css[ $index ] );
        }
    }
    /**
     * @see wellness_custom_style
     */
    $wp_customize->selective_refresh->add_partial( 'custom_style' , array(
        'selector' => '#glob-style-inline-css',
        'settings' => $custom_css,
        'render_callback' => 'glob_custom_style',
    ));
}
add_action( 'customize_register', 'glob_customizer_partials', 95 );
/**
 * Selective render content
 *
 * @param $partial
 * @param array $container_context
 */
function glob_selective_refresh_render_section_content( $partial, $container_context = array() ) {
    $GLOBALS['glob_is_selective_refresh'] = true;
    $id = $partial->id;
    $id = str_replace( 'section-', '', $id );
    do_action( 'glob_selective_refresh_before_render_section_content', $partial, $container_context );
    if ( $id ) {
        $function = 'glob_'.$id.'_section' ;
        $hook = 'glob_section_'.$id;
        if ( function_exists( $function ) ) {
            add_action( $hook, $function );
        }
        do_action( $hook );
    }
    do_action( 'glob_selective_refresh_after_render_section_content', $partial, $container_context );
}