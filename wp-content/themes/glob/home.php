<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package glob
 */
get_header(); ?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		global $wp_query;
		$total_pages = $wp_query->max_num_pages;
		$current_page = max( 1, get_query_var('paged') );
		$homepage_layout = get_theme_mod( 'glob_homepage_layout', 'default' );
		if ( have_posts() ) :
			
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				switch ( $homepage_layout ) {
		 			case 'home1':
		 				get_template_part( 'template-parts/content', 'list' );
		 				break;
		 			default:
		 				get_template_part( 'template-parts/content', 'grid' );
		 				break;
		 		}
			endwhile;
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		if (  $wp_query->max_num_pages > 1 ) {
			echo '<div class="post-pagination">';
			the_posts_pagination(array(
				'prev_next' => True,
				'prev_text' => '',
				'next_text' => '',
				'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'glob') . ' </span>',
			));
			echo '</div>';
		}
		 ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
