<?php
/**
 * News Layout one
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'newspaper_magazine_news_layout_one_register' ) ) :
	function newspaper_magazine_news_layout_one_register() {
		/**
		 * Register Widget
		 */
		register_widget( 'Newspaper_Magazine_News_Layout_One' );
	}
endif;
add_action( 'widgets_init', 'newspaper_magazine_news_layout_one_register' );

if ( ! class_exists( 'Newspaper_Magazine_News_Layout_One' ) ) :
	/**
	* News Layout Class one
	*/
	class Newspaper_Magazine_News_Layout_One extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => 'latest_news wow fadeInUp',
				'description'	=> esc_html__( 'Displays posts. Place it in "Front Page Widget Area Top" widget area.', 'newspaper-magazine' )
			);

			parent::__construct( 'news-layout-widget-one', esc_html__( 'News Widget One', 'newspaper-magazine' ), $opts );
		}

		function widget( $args, $instance ){
			$icon = ! empty( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : '';
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			echo $args[ 'before_widget' ];
				echo $args[ 'before_title' ]; 
				?>
					<a href="<?php echo get_category_link($cat);?>"><i class="fa <?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i> <span><?php echo esc_html( $title ); ?></span></a>
				<?php
				echo $args[ 'after_title' ];
				$i = 1;
				$arguments = array(
					'cat'	=> absint( $cat ),
					'posts_per_page' => 5,
				); 
				$query = new WP_Query( $arguments );
				?>
				<div class="row latest_news_detail">
				<?php
					if( $query->have_posts() ) :
						while( $query->have_posts() ) :
							$query->the_post();
							if( $i == 1 ) :
							?>
								<div class="col-xs-12 col-sm-6">
                        			<div class="block_first_article">
                                         <article class="clearfix">
                                         	<?php
                                         		if( has_post_thumbnail() ) : 
                                         	?>
                                            <div class="view block_first_article_img hm-zoom">
                                                <a href="<?php the_permalink(); ?>">
                                                   <?php the_post_thumbnail('newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' )); ?>
                                                </a>
                                            </div>
                                            <?php
                                            
												endif;
											?>
                                            <div class="latest_world_news_content">
                                                <h4 class="side_news_heading main_heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <div class="author_time news_author">
                                                  <span class="author_img"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt=""><?php echo esc_html( get_the_author() ); ?></a></span>
                                                  <span class="publish_date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
                                                </div>
                                                <p class="article_contain"><?php the_excerpt(); ?></p> 
                                              </div>
                                         </article>
                                    </div>
                                </div>
							<?php 	
							endif;
							$i = $i + 1;
						endwhile;
						$i = 1;
						wp_reset_postdata();
					endif;
				?>
					<div class="col-xs-12 col-sm-6">
                        <div class="block_left_article clearfix">
						<?php
							if( $query->have_posts() ) :
								while( $query->have_posts() ) :
									$query->the_post();
									if( $i > 1 ) : 
									?>
		                                <article class="clearfix">
											<?php
												if( has_post_thumbnail() ) :
											?>
			                                	<div class="side_article_thumbnail hm-zoom">
                                                    <a href="<?php the_permalink(); ?>">
			                                       	    <?php the_post_thumbnail('newspaper-magazine-thumbnail-6', array( 'class' => 'img-responsive full-img' )); ?>
                                                    </a>
			                                 	</div>
			                                <?php 
			                                   	
												endif;
											?>
		                                   	<div class="side_article_contain">
		                                      	<h4 class="side_news_heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		                                       	<div class="author_time news_author">
		                                       		<span class="author_img"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt=""><?php echo esc_html( get_the_author() ); ?></a></span>
		                                       		<span class="publish_date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
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

			$instance[ 'icon' ] = sanitize_text_field( $new_instance[ 'icon' ] );
			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );

			return $instance;
		}

		function form( $instance ) {

			$icon = ! empty( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : '';
			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><strong><?php echo esc_html( 'Icon: ' )?></strong></label>
				<p><i><?php echo esc_html__('Use FontAwesome Icon. Example: fa-cog', 'newspaper-magazine');?></i></p>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" value="<?php echo esc_attr( $icon ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html( 'Title: ' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html( 'Select Category: ', 'newspaper-magazine' ); ?></strong></label>
				<?php
					$cat_args = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat' ),
						'name'	=> $this->get_field_name( 'cat' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat ),
						'show_option_all'	=> esc_html__( 'All Categories', 'newspaper-magazine' )
					);
					wp_dropdown_categories( $cat_args );
				?>
			</p>
			<?php			
		}
	}
endif;
?>