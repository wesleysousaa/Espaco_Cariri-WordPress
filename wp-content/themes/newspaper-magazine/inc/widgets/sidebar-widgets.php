<?php
/**
 * Sidebar Widgets
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'newspaper_magazine_sidebar_widget' ) ) :
	/**
     * Register and load sidebar widgets.
     *
     * @since 1.0.0
     */
	function newspaper_magazine_sidebar_widget() {
		/*
			Social Link Widget Register
		*/
		register_widget( 'Newspaper_Magazine_Social_Widget' );

		/*
			Popular Post Widget Register
		*/
		register_widget( 'Newspaper_Magazine_Popular_Post_Widget' );
	}
endif;
add_action( 'widgets_init', 'newspaper_magazine_sidebar_widget' );

if ( ! class_exists( 'Newspaper_Magazine_Social_Widget' ) ) :
	/**
	 * Social Link Widget
	 *
	 * @since 1.0.0
	 */
	class Newspaper_Magazine_Social_Widget extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname'	=> 'followus social-widget',
				'description'	=> esc_html__( 'Social Widget. Place it in "Sidebar" and only works properly in this widget area.', 'newspaper-magazine' )
			);
			parent::__construct( 'newspaper-magazine-social-widget', esc_html__( 'Sidebar: Social Widget', 'newspaper-magazine' ), $opts );
		}

		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$facebook_link = ! empty( $instance[ 'facebook_link' ] ) ? $instance[ 'facebook_link' ] : '';
			$twitter_link = ! empty( $instance[ 'twitter_link' ] ) ? $instance[ 'twitter_link' ] : '';
			$googleplus_link = ! empty( $instance[ 'googleplus_link' ] ) ? $instance[ 'googleplus_link' ] : '';
			$youtube_link = ! empty( $instance[ 'youtube_link' ] ) ? $instance[ 'youtube_link' ] :  '';
			$instagram_link = ! empty( $instance[ 'instagram_link' ] ) ? $instance[ 'instagram_link' ] : '';
			$pinterest_link = ! empty( $instance[ 'pinterest_link' ] ) ? $instance[ 'pinterest_link' ] : '';
			$dribble_link = ! empty( $instance[ 'dribble_link' ] ) ? $instance[ 'dribble_link' ] : '';
			$vimeo_link = ! empty( $instance[ 'vimeo_link' ] ) ? $instance[ 'vimeo_link' ] : '';
			$tumblr_link = ! empty( $instance[ 'tumblr_link' ] ) ? $instance[ 'tumblr_link' ] : '';
			echo $args['before_widget'];
			echo $args['before_title'];
			?>
				<?php echo $title; ?>
			<?php
			echo $args['after_title'];
			?>
				<ul class="clearfix">
					<?php
						if( !empty( $facebook_link ) ) :
					?>
			        	<li class="facebook"><a href="<?php echo esc_url( $facebook_link ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        	if( !empty( $twitter_link ) ) :
			        ?>
			        	<li class="twitter"><a href="<?php echo esc_url( $twitter_link ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        	if( !empty( $googleplus_link ) ) :
			        ?>
			        	<li class="gplus"><a href="<?php echo esc_url( $googleplus_link ); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        	if( !empty( $youtube_link ) ) :
			        ?>
			        	<li class="youtube"><a href="<?php echo esc_url( $youtube_link ); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        	if( !empty( $instagram_link ) ) :
			        ?>
			        	<li class="instagram"><a href="<?php echo esc_url( $instagram_link ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<?php
			        	endif;
			        	if( !empty( $pinterest_link ) ) :
			        ?>	
			        	<li class="pinterest"><a href="<?php echo esc_url( $pinterest_link ); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        	if( !empty( $dribble_link ) ) :
			        ?>
			        	<li class="dribbble"><a href="<?php echo esc_url( $dribble_link ); ?>"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        	if( !empty( $vimeo_link ) ) :
			        ?>
			        	<li class="vimeo"><a href="<?php echo esc_url( $vimeo_link ); ?>"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        	if( !empty( $tumblr_link ) ) :
			        ?>
			        	<li class="tumblr"><a href="<?php echo esc_url( $tumblr_link ); ?>"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
			        <?php
			        	endif;
			        ?>
			    </ul>
			<?php
			echo $args['after_widget'];
		}


		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'facebook_link' ] = esc_url_raw( $new_instance[ 'facebook_link' ] );
			$instance[ 'twitter_link' ] = esc_url_raw( $new_instance[ 'twitter_link' ] );
			$instance[ 'googleplus_link' ] = esc_url_raw( $new_instance[ 'googleplus_link' ] );
			$instance[ 'youtube_link' ] = esc_url_raw( $new_instance[ 'youtube_link' ] );
			$instance[ 'instagram_link' ] = esc_url_raw( $new_instance[ 'instagram_link' ] );
			$instance[ 'pinterest_link' ] = esc_url_raw( $new_instance[ 'pinterest_link' ] );
			$instance[ 'dribble_link' ] = esc_url_raw( $new_instance[ 'dribble_link' ] );
			$instance[ 'vimeo_link' ] = esc_url_raw( $new_instance[ 'vimeo_link' ] );
			$instance[ 'tumblr_link' ] = esc_url_raw( $new_instance[ 'tumblr_link' ] );

			return $instance;
		}	


		function form( $instance ) {
			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
			$facebook_link = ! empty( $instance[ 'facebook_link' ] ) ? $instance[ 'facebook_link' ] : '';
			$twitter_link = ! empty( $instance[ 'twitter_link' ] ) ? $instance[ 'twitter_link' ] : '';
			$googleplus_link = ! empty( $instance[ 'googleplus_link' ] ) ? $instance[ 'googleplus_link' ] : '';
			$youtube_link = ! empty( $instance[ 'youtube_link' ] ) ? $instance[ 'youtube_link' ] :  '';
			$instagram_link = ! empty( $instance[ 'instagram_link' ] ) ? $instance[ 'instagram_link' ] : '';
			$pinterest_link = ! empty( $instance[ 'pinterest_link' ] ) ? $instance[ 'pinterest_link' ] : '';
			$dribble_link = ! empty( $instance[ 'dribble_link' ] ) ? $instance[ 'dribble_link' ] : '';
			$vimeo_link = ! empty( $instance[ 'vimeo_link' ] ) ? $instance[ 'vimeo_link' ] : '';
			$tumblr_link = ! empty( $instance[ 'tumblr_link' ] ) ? $instance[ 'tumblr_link' ] : ''
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) )?>"><strong><?php echo esc_html__( 'Title: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) )?>" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_link' ) )?>"><strong><?php echo esc_html__( 'Facebook Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_link' ) )?>" value="<?php echo esc_attr( $facebook_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_link' ) )?>"><strong><?php echo esc_html__( 'Twitter Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_link' ) )?>" value="<?php echo esc_attr( $twitter_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'googleplus_link' ) )?>"><strong><?php echo esc_html__( 'Google Plus Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'googleplus_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus_link' ) )?>" value="<?php echo esc_attr( $googleplus_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_link' ) )?>"><strong><?php echo esc_html__( 'Youtube Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_link' ) )?>" value="<?php echo esc_attr( $youtube_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_link' ) )?>"><strong><?php echo esc_html__( 'Instagram Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram_link' ) )?>" value="<?php echo esc_attr( $instagram_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest_link' ) )?>"><strong><?php echo esc_html__( 'Pinterest Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest_link' ) )?>" value="<?php echo esc_attr( $pinterest_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'dribble_link' ) )?>"><strong><?php echo esc_html__( 'Dribble Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribble_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'dribble_link' ) )?>" value="<?php echo esc_attr( $dribble_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo_link' ) )?>"><strong><?php echo esc_html__( 'Vimeo Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo_link' ) )?>" value="<?php echo esc_attr( $vimeo_link ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr_link' ) )?>"><strong><?php echo esc_html__( 'Tumblr Link: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr_link' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr_link' ) )?>" value="<?php echo esc_attr( $tumblr_link ); ?>">
			</p>
			<?php
 		}
	}
endif;

if ( ! class_exists( 'Newspaper_Magazine_Popular_Post_Widget' ) ) :
	/**
	 *  Popular Post Widget
	 *
	 * @since 1.0.0
	 */
	class Newspaper_Magazine_Popular_Post_Widget extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => 'followus clearfix',
				'description' => esc_html__( 'Recent Post Widget. Place it in "Sidebar" and only works in this widget area.', 'newspaper-magazine' )
			);
			parent::__construct( 'newspaper-magazine-recent-post-widget', esc_html__( 'Sidebar: Recent Post', 'newspaper-magazine' ), $opts );
		}

		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 5 );
			echo $args[ 'before_widget' ];
			echo $args[ 'before_title' ];
			?>
				<?php echo esc_html( $title ); ?>
			<?php
				echo $args[ 'after_title' ];
			?>
			<?php
				$arguments_1 = array(
					'posts_per_page' => absint( $post_no ),
				); 
				$query_1 = new WP_Query( $arguments_1 );
				$i = 0;
				if( $query_1->have_posts() ) :
					while( $query_1->have_posts() ) :
						$query_1->the_post();
						if( $i < 1 ) :
						?>
						<div class="col-md-12">
			                <div class="row">
			                    <div class="populartop_news">
			                   		<article>
			                           	<?php
			                                if( has_post_thumbnail() ) : 
			                            ?>
			                              	<div class="block_first_article_img hm-zoom">
			                                    <a href="<?php the_permalink(); ?>">
			                                        <?php the_post_thumbnail('newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' )); ?>
			                                    </a>
			                                </div>
			                            <?php
											endif;
										?>
			                       		<div class="block_article_content">
			                                <h4 class="side_news_heading main_heading">
			                                	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			                                </h4>
			                                <div class="author_time news_author">
			                                    <span class="author_img">
			                                    	<i class="fa fa-user" aria-hidden="true"></i>
			                                    	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt=""><?php echo esc_html( get_the_author() ); ?></a>
			                                    </span>
			                                    <span class="publish_date">
			                                    	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
			                                    	<?php echo get_the_date(); ?>
			                                    </span>
			                                </div>
			                            </div>
			                        </article>
			                    </div>
			                </div>
			            </div>
			            <?php
			            endif;
			            $i = $i + 1;
			        endwhile;
			        $i = 0;
			        wp_reset_postdata();
			    endif;
			?>
                    <div class="col-md-12">
			            <div class="row">
			            	<div class="popularbottom_news">
			            		<?php
                                	if( $query_1->have_posts() ) :
                                		while( $query_1->have_posts() ) :
                                			$query_1->the_post();
                                			if( $i >= 1 ) :
                                			?>
			                    			<article class="clearfix">
						                        <?php
						                        	if( has_post_thumbnail() ) : 
						                        ?>
						                        <div class="side_article_thumbnail hm-zoom">
						                            <a href="<?php the_permalink(); ?>">
						                                <?php the_post_thumbnail('tnewspaper-magazine-thumbnail-6', array( 'class' => 'img-responsive full-img' )); ?>
						                            </a>
						                        </div>
						                        <?php
						                          
													endif;
												?>
						                        <div class="side_article_contain">
						                            <h4 class="side_news_heading">
						                            	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						                            </h4>
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
						                        </div>
						                    </article>
						                    <?php
		                                    endif;
		                                    $i = $i + 1;
		                                endwhile;
		                                wp_reset_postdata();
		                            endif;
		                        ?>
			                </div>
			        	</div>
			        </div>        
			<?php
			echo $args[ 'after_widget' ];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}

		function form( $instance ) {
			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 5 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) )?>"><strong><?php echo esc_html__( 'Title: ', 'newspaper-magazine' ); ?></strong></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) )?>" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html( 'Post No: ', 'newspaper-magazine' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php
		}
	}
endif;


