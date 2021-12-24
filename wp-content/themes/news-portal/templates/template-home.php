<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all widgets included in homepage widget area.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

get_header(); 

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Top Section Area
 * 
 * @since 1.0.0
 */
	if ( is_active_sidebar( 'news_portal_home_top_section_area' ) ) {
?>
		<div class="np-home-top-section np-clearfix">
			<?php dynamic_sidebar( 'news_portal_home_top_section_area' ); ?>
		</div><!-- .np-home-top-section -->
<?php 
	}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Middle Section Area
 * 
 * @since 1.0.0
 */
	if ( is_active_sidebar( 'news_portal_home_middle_section_area' ) ) {
?>
		<div class="np-home-middle-section np-clearfix">
			<div class="middle-primary">
				<?php dynamic_sidebar( 'news_portal_home_middle_section_area' ); ?>
			</div><!-- .middle-primary -->
			<div class="middle-aside">
				<?php dynamic_sidebar( 'news_portal_home_middle_aside_area' ); ?>
			</div><!-- .middle-aside -->
		</div><!-- .np-home-middle-section -->
<?php 
	}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Bottom Section Area
 * 
 * @since 1.0.0
 */
	if ( is_active_sidebar( 'news_portal_home_bottom_section_area' ) ) {
?>
		<div class="np-home-bottom-section">
			<?php dynamic_sidebar( 'news_portal_home_bottom_section_area' ); ?>
		</div><!-- .np-home-bottom-section -->
<?php 
	}

get_footer();