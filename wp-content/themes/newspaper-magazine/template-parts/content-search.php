<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newspaper_Magazine
 */

?>
<?php
	if( get_the_title() ) :
?>
<!--single search result -->
<div class="single-searchnews">
	<div class="single-searchnews-img">
		<?php
			if( has_post_thumbnail() ) :
				the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
			endif;
		?>
	</div>
	<div class="single-searchnews-contain">
		<div class="innerpage_news_title">
			<h4>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h4>
		</div>
		<?php
			if( get_post_type() == 'post' ) :
		?>
		<div class="author_time news_author">
            <span class="author_img">
            	<i class="fa fa-user" aria-hidden="true"></i>
            	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="">
            		<?php echo esc_html( get_the_author() ); ?>
            	</a>
            </span>
            <span class="publish_date">
            	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            	<?php echo get_the_date(); ?>
            </span>
        </div>
        <?php
        	endif;
        ?>
        <?php the_excerpt(); ?>
	</div>
</div>
<!--single search result -->
<?php
	endif;
?>
