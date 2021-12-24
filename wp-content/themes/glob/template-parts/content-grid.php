<?php
/**
 * Template part for displaying Homepage layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package glob
 */
?>
<!-- begin .hentry -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-grid' ); ?> >
	<!-- begin .featured-image -->
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="featured-image">
		<?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'glob-thumbnail-large' ); ?></a><?php endif; ?>
	</div>
	<?php } ?>
	<!-- end .featured-image -->
	<!-- begin .entry-header -->
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<div class="entry-meta">
			<?php
			echo glob_posted_on_author();
			echo glob_posted_on_date();
			?>
		</div>
	</header>
	<!-- end .entry-header -->
	<!-- begin .entry-info -->
	<div class="entry-info">
		<!-- begin .entry-content -->
		<section class="entry-excerpt">
            <?php the_excerpt(); ?>
        </section>
		<!-- end .entry-content -->
	</div>
	<!-- end .entry-info -->
</article>
<!-- end .hentry -->
