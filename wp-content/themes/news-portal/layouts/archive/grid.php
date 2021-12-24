<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

global $wp_query;

$post_count = $wp_query->current_post;
$total_post_count = $wp_query->found_posts;

if( $post_count % 5 == 0 ) {
	$article_layout = 'classic-post';
	echo '<div class="np-archive-classic-post-wrapper">';
} else {
	if( $post_count == 1 || $post_count == 6 ) {
		echo '<div class="np-archive-grid-post-wrapper np-clearfix">';
	}
	$article_layout = 'grid-post';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

	<div class="np-article-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'full' ); ?>
		</a>
	</div><!-- .np-article-thumb -->

	<div class="np-archive-post-content-wrapper">
		<header class="entry-header">
			<?php			
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

				if ( 'post' === get_post_type() ) :
			?>
					<div class="entry-meta">
						<?php news_portal_inner_posted_on(); ?>
					</div><!-- .entry-meta -->
			<?php
				endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt();
				news_portal_archive_read_more_button();
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php news_portal_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .np-archive-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php
	if( $post_count % 5 == 0 ) {
		echo '</div>';
	} else {
		if( $post_count == 4 || $post_count == 9 || $post_count == $total_post_count-1 ) {
			echo '</div>';
		}
	}
?>