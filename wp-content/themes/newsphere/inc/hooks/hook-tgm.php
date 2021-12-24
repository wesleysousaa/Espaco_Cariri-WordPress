<?php
/**
 * Recommended plugins
 *
 * @package Newsphere
 */

if ( ! function_exists( 'newsphere_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function newsphere_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'WP Post Author', 'newsphere' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'newsphere' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),

        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'newsphere_recommended_plugins' );
