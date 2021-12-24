<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspaper_Magazine
 */

if ( ! is_active_sidebar( 'sidebar-7' ) ) {
	return;
}
?>
<!-- Begining of Sidebar -->
<div class="col-xs-12 col-sm-12 col-md-4">
	<div class="right_news sidebar clearfix">
		<?php dynamic_sidebar( 'sidebar-7' ); ?>
		<?php dynamic_sidebar( 'primary' ); ?>
	</div>
</div>
<!-- End of Sidebar -->
