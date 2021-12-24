<?php

/**
 * Add panels
 */


/* adding lanewspapersst panel */

Kirki::add_panel( 'upgradepro_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'About Theme', 'newspaperss' ),
    'icon' => 'dashicons-warning'

) );

Kirki::add_panel( 'bglayout_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'General settings', 'newspaperss' ),

) );

Kirki::add_panel( 'header_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'Header settings', 'newspaperss' ),
) );

Kirki::add_panel( 'homepage_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'Home page options', 'newspaperss' ),
) );

Kirki::add_panel( 'newspapersspost_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'Post settings', 'newspaperss' ),
) );

Kirki::add_panel( 'newspapersspage_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'Page settings', 'newspaperss' ),
) );
if ( newspaperss_is_woocommerce_active()) :
Kirki::add_panel( 'woocommercecustom_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'Woocommerce settings', 'newspaperss' ),
) );
endif;

Kirki::add_panel( 'newspaperssfooter_options', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'Footer settings', 'newspaperss' ),
) );
