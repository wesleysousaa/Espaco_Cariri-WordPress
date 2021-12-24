<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glob
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="xx entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		if ( 'post' === get_post_type() ) {
            if ( get_theme_mod( 'single_enable_author', 1 ) || get_theme_mod( 'single_enable_post_date', 1 ) || get_theme_mod( 'single_enable_comment_count', 1 ) ) {
                ?>
                <div class="entry-meta">
                    <?php
                    if ( get_theme_mod( 'single_enable_author', 1 ) ) {
                        echo glob_posted_on_author();
                    }
                    if ( get_theme_mod( 'single_enable_post_date', 1 ) ) {
                        echo glob_posted_on_date();
                    }
                    if ( get_theme_mod( 'single_enable_comment_count', 1 ) ) {
                        glob_posted_on_comments();
                    }
                    ?>
                </div>
            <?php } ?>
        <?php } ?>
	</header><!-- .entry-header -->
    <?php ?>
    <?php
    if ( get_theme_mod( 'single_enable_feature_image', 1 ) ) {
        if ( has_post_thumbnail() ) { ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail('glob-medium'); ?>
            </div>
        <?php }
    }
    ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'glob' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'glob' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    <?php ?>
	<footer class="entry-footer">
		<?php glob_entry_footer(); ?>
	</footer><!-- .entry-footer -->
    <?php ?>
</article><!-- #post-## -->
