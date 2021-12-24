<article>
    <div class="innerpage_news_title">
        <h4 class="news_title">
            <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
        </h4>
    </div>
    <div class="author_time news_author">
        <span class="author_img"><i class="fa fa-user" aria-hidden="true"></i><a
                    href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                    alt=""><?php echo esc_html( get_the_author() ); ?></a></span>
        <span class="publish_date"><i class="fa fa-calendar-check-o"
                                      aria-hidden="true"></i><?php echo get_the_date(); ?></span>
    </div>
	<?php
	if ( has_post_thumbnail() ) :
		?>
		<?php
		$display_featured_images = get_theme_mod( 'display_featured_images', 1 );
		if ( ! empty( $display_featured_images ) && $display_featured_images == 1 ) :
			?>
            <div class="single_news_img">
				<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive full-img' ) ); ?>
            </div>
		<?php endif; ?>
		<?php
	endif;
	?>
    <div class="nm-content nm-content-single">
	<?php the_content(); ?>
    </div>

    <?php
	wp_link_pages( array(
		'before' => '<div class="page-links clearfix">' . esc_html__( 'Pages:', 'newspaper-magazine' ),
		'after'  => '</div>',
	) );
	?>
</article>