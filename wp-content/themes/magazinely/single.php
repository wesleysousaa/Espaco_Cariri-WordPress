<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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



<div id="primary" class="content-area large-8 medium-8 small-12 cell">
	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

		get_template_part( 'template-parts/content', get_post_type() );

			// About the author start
		echo '<div class="about-the-author">';
		echo '<div class="grid-x grid-padding-x">';
		echo '<div class="large-2 medium-3 small-12 cell">';
		echo get_avatar( get_the_author_meta( 'ID' ), 100 ); 
		echo '</div>';
		echo '<div class="large-10 medium-9 small-12 cell">';
		echo '<h3>';
		echo esc_html_e('About the author','magazinely');
		echo '</h3>';
		echo nl2br(get_the_author_meta('description'));
		echo '</div>';
		echo '</div>';
		echo '</div>';
			// About the author end

			// Related posts start
		$categories = get_the_category($post->ID); 
		if ($categories) { $category_ids = array(); 
			foreach($categories as $individual_category) 
				$category_ids[] = $individual_category->term_id; 
			$args=array( 'category__in' => $category_ids, 
				'post__not_in' => array($post->ID), 
				'ignore_sticky_posts' => 1, 
				'showposts'=> 3,
				'orderby' => 'rand' );
			$my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
				echo '<div class="related-posts blog"><div class="postauthor-top"><h3>'.esc_html__('Related Posts', 'magazinely').'</h3></div><main>';
				$pexcerpt=1; $j = 0; $counter = 0; 
				while( $my_query->have_posts() ) { 
					$my_query->the_post();?>
					<article class="post excerpt  <?php echo (++$j % 3== 0) ? 'last' : ''; ?>">
						<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_html(the_title_attribute()); ?>">
							<?php the_post_thumbnail('large'); ?>
						</a>
					<?php endif; ?>
					<div class="article-contents">
						<header class="entry-header">
							<?php 
							if ( 'post' === get_post_type() ) :
								?>
							<div class="entry-meta">
								<?php echo esc_html(get_the_date('F j, Y')); ?>
							</div>
							<?php
							the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
							?>
						<?php endif; ?>
					</div>
				</article><!--.post.excerpt-->
				<?php $pexcerpt++;?>
				<?php } echo '</div></main>'; }} wp_reset_postdata();
						// Related posts end

						// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->

					<!-- Start Related Posts -->

					<!-- End Related Posts -->

				</div><!-- #primary -->

				<?php
				get_sidebar();
				get_footer();
