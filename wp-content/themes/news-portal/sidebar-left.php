<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'news_portal_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'news_portal_left_sidebar' ); ?>
</aside><!-- #secondary -->
