<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Glob
 */
get_header(); ?>
<div class="container">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'glob' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'grid' );
			endwhile;
			the_posts_navigation();
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
	</section><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
