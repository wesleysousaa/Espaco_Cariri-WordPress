<?php
/**
 * Customizer callback functions for active_callback.
 *
 * @package CoverNews
 */

/*select page for slider*/
if ( ! function_exists( 'covernews_frontpage_content_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_frontpage_content_status( $control ) {

        if ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;


    /*select page for trending news*/
if ( ! function_exists( 'covernews_flash_posts_section_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_flash_posts_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_flash_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

    /*select page for slider*/
if ( ! function_exists( 'covernews_main_banner_section_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_main_banner_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_main_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if ( ! function_exists( 'covernews_banner_mode_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_banner_mode_status( $control ) {

        if ( 'slider-editors-picks-trending' == $control->manager->get_setting( 'select_main_banner_section_mode' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if ( ! function_exists( 'covernews_featured_news_section_status' ) ) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_featured_news_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_featured_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if ( ! function_exists( 'covernews_featured_product_section_status' ) ) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_featured_product_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_featured_products_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select sticky sidebar*/
if ( ! function_exists( 'frontpage_content_alignment_status' ) ) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function frontpage_content_alignment_status( $control ) {

        if ( 'align-content-left' == $control->manager->get_setting( 'frontpage_content_alignment' )->value() || 'align-content-right' == $control->manager->get_setting( 'frontpage_content_alignment' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if ( ! function_exists( 'covernews_latest_news_section_status' ) ) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_latest_news_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'frontpage_show_latest_posts' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;




/*select page for slider*/
if ( ! function_exists( 'covernews_archive_image_status' ) ) :

    /**
     * Check if archive no image is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_archive_image_status( $control ) {

        if ( 'archive-layout-list' == $control->manager->get_setting( 'archive_layout' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*related posts*/
if ( ! function_exists( 'covernews_related_posts_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_related_posts_status( $control ) {

        if ( true == $control->manager->get_setting( 'single_show_related_posts' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;



/*mailchimp*/
if ( ! function_exists( 'covernews_mailchimp_subscriptions_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_mailchimp_subscriptions_status( $control ) {

        if ( true == $control->manager->get_setting( 'footer_show_mailchimp_subscriptions' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

    /*select page for slider*/
if ( ! function_exists( 'covernews_footer_instagram_posts_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function covernews_footer_instagram_posts_status( $control ) {

        if ( true == $control->manager->get_setting( 'footer_show_instagram_post_carousel' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

