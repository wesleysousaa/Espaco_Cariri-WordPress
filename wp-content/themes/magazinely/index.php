<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sp_magazinely
 */

get_header();
?>


<?php if ( get_theme_mod( 'featured_posts_toggle' ) == 'gridtwo' ) : ?>
	<div class="content-area large-12 cell">
		<div class="sticky-posts-wrapper-grid-five">
			<?php 
			$args = array(
				'posts_per_page' => 5,
				'post__in'  => get_option( 'sticky_posts' ),
				'ignore_sticky_posts' => 1
				);
			$my_query = new WP_Query( $args );
			$do_not_duplicate = array();
			while ( $my_query->have_posts() ) : $my_query->the_post();
			$do_not_duplicate[] = $post->ID; ?>
			<?php if (is_sticky()) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>  style="background-image:url('<?php the_post_thumbnail_url("magazinely-featured-images"); ?>')">
				<div class="sticky-posts-content">
					<div class="categories-featured-posts">
						<?php $categories = get_the_category();
						if ( ! empty( $categories ) ) {
							echo esc_html( $categories[0]->name );   
						} ?>
					</div>
					<h2><?php the_title(); ?></h2>
				</div>
			</a>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</div>
</div>
</div>
</div>
<?php else : ?>
	<div class="content-area large-12 cell">
		<div class="sticky-posts-wrapper">
			<?php 
			$args = array(
				'posts_per_page' => 4,
				'post__in'  => get_option( 'sticky_posts' ),
				'ignore_sticky_posts' => 1
				);
			$my_query = new WP_Query( $args );
			$do_not_duplicate = array();
			while ( $my_query->have_posts() ) : $my_query->the_post();
			$do_not_duplicate[] = $post->ID; ?>
			<?php if (is_sticky()) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>  style="background-image:url('<?php the_post_thumbnail_url("magazinely-featured-images"); ?>')">
				<div class="sticky-posts-content">
					<div class="categories-featured-posts">
						<?php $categories = get_the_category();
						if ( ! empty( $categories ) ) {
							echo esc_html( $categories[0]->name );   
						} ?>
					</div>
					<h2><?php the_title(); ?></h2>
				</div>
			</a>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</div>
</div>
</div>
</div>
<?php endif; ?>

<div id="page" class="site grid-container start-container-head">
	<div id="content" class="site-content grid-x grid-padding-x">

		<div id="primary" class="content-area large-8 medium-8 small-12 cell fp-blog-grid">
			<main id="main" class="site-main">




				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
					<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :


						the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'excerpt' );

				endwhile;

				the_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>


			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
		get_sidebar();
		get_footer();
