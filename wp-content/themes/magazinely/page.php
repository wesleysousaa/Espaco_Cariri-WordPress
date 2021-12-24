<?php
/**
 * The template for displaying all pages
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
