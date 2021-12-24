<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glob
 */
get_header();
$layout = get_theme_mod( 'glob_archive_layout', 'grid' );
?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		
		if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
 		 			get_template_part( 'template-parts/content', $layout );
			endwhile;
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		<?php
		echo '<div class="post-pagination">';
		the_posts_pagination(array(
			'prev_next' => true,
			'prev_text' => '',
			'next_text' => '',
			'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'glob') . ' </span>',
		));
		echo '</div>';
		?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
