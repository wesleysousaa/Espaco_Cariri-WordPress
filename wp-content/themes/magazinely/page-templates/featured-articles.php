<?php

/* 
Template Name: Featured Articles
 */

/**
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sp_magazinely
 */

get_header();
?>


<?php if ( get_theme_mod( 'hide_featured_image' ) == '' ) : ?>
	<!-- Featured img -->
	<?php if ( has_post_thumbnail() ) : ?>
</div>
</div>
<div class="post-thumbnail">
	<?php the_post_thumbnail('full'); ?>
</div>
<div id="page" class="site grid-container">
	<div id="content" class="site-content grid-x grid-padding-x">
	<?php endif; ?>
	<!-- / Featured img -->
<?php else : ?>
<?php endif; ?>


<?php if ( get_theme_mod( 'featured_posts_toggle' ) == 'gridtwo' ) : ?>
	<div class="content-area large-12 cell featured-sticky-posts-page-template">
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

<?php else : ?>
	<div class="content-area large-12 cell featured-sticky-posts-page-template">
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

<?php endif; ?>


	<div id="primary" class="content-area large-8 medium-8 small-12 cell">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
