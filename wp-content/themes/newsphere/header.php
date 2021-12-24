<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newsphere
 */

?>
    <!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<?php
$enable_preloader = newsphere_get_option('enable_site_preloader');
if (1 == $enable_preloader):
    ?>
    <div id="af-preloader">
        <div class="af-preloader-wrap">
            <div class="af-sp af-sp-wave">
            </div>
        </div>
    </div>
<?php endif; ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'newsphere'); ?></a>

<?php

do_action('newsphere_action_header_section');

do_action('newsphere_action_front_page_main_section');

do_action('newsphere_action_banner_featured_section');


if (is_singular('post')) {
    $single_post_featured_image_view = newsphere_get_option('single_post_featured_image_view');
    if ($single_post_featured_image_view == 'full') {
        do_action('newsphere_action_single_header');
    }
}
?>


    <div id="content" class="container-wrapper">
<?php

do_action('newsphere_action_get_breadcrumb');