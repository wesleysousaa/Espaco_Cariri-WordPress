<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sp_magazinely
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
		<div class="entry-meta">
			<?php sp_magazinely_posted_by(); ?>
			<span class="post-divider"><?php echo esc_html( ' | ', 'magazinely' ); ?></span>
			<?php sp_magazinely_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</header><!-- .entry-header -->

<div class="entry-content">
	<?php
	the_content( sprintf(
		wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'magazinely' ),
			array(
				'span' => array(
					'class' => array(),
					),
				)
			),
		get_the_title()
		) );

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php sp_magazinely_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
