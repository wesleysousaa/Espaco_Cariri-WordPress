<?php
	if( get_the_title() ) :
?>
	<article class="col-xs-12 col-sm-6 grid-item">
		<div class="horizental_cat_news wow fadeInUp" data-wow-duration=".5s">
			<?php
		        if( has_post_thumbnail() ) : 
		    ?>
                <div class="view hm-zoom single_news_img">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' ) ); ?>
                    </a>
               </div>
		    <?php
				endif;
			?>
			<div class="horizantal_singlenews_contain">
				<div class="innerpage_news_title">
					<h4>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h4>
				</div>
				<div class="author_time news_author">
		            <span class="author_img">
		            	<i class="fa fa-user" aria-hidden="true"></i>
		            	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="">
		            		<?php echo esc_html( get_the_author() ); ?>
		            	</a>
		            </span>
		            <span class="publish_date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
                    <div class="nm-content nm-content-archive">
		                <?php the_excerpt(); ?>
                    </div>
		        </div>
			</div>
		</div>
	</article>
<?php
	endif;
?>