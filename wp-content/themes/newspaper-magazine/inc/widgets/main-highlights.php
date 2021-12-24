<?php
/**
 * Custom Widgets
 *
 * @since 1.0.0
 */

if( ! function_exists( 'newspaper_magazine_load_widgets' ) ) :
	/**
     * Register and load widgets.
     *
     * @since 1.0.0
     */
	function newspaper_magazine_load_widgets() {

		/*
			Main Highlight Widget Register
		*/
		register_widget( 'Newspapaer_Magazine_Main_Highlight' );

		/*
			Slider Highlight Widget Register
		*/
		register_widget( 'Newspaper_Magazine_Slider_Highlight' );

	}
endif;
add_action( 'widgets_init', 'newspaper_magazine_load_widgets' );


if( ! class_exists( 'Newspapaer_Magazine_Main_Highlight' ) ) :
	/**
	 * Main Highlight
	 *
	 * @since 1.0.0
	 */
	class Newspapaer_Magazine_Main_Highlight extends WP_Widget
	{

		function __construct()
		{
			$opts = array(
				'classname' => '',
				'description'	=> esc_html__( 'Displays three distinct highlight posts. Place it in "Highlight Widget Area" widget area.', 'newspaper-magazine' )
			);
			parent::__construct( 'newspaper-magazine-main-highlight', esc_html__( 'Main Highlight', 'newspaper-magazine' ), $opts );
		}

		function widget( $args, $instance ) {
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : absint( 0 );
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : absint( 0 );
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : absint( 0 );
			?>
			<section class="breaking_news clearfix">
	         	<div class="container-fluid">
	            	<div class="row">
	            		<!-- Left section -->
	              		<div class="col-xs-12 col-sm-6">
	              		<?php
	              			$arguments_1 = array(
								'cat'				=> absint( $cat_1 ),
								'posts_per_page' 	=> 1,
								'post_type'			=> 'post',
								'post__not_in'=>get_option("sticky_posts")
							);
							$query_1 = new WP_Query( $arguments_1 );
							if( $query_1->have_posts() ) :
								while( $query_1->have_posts() ) :
									$query_1->the_post();
	              		?>
			                		<div class="row breakingnews_left clearfix">
										<div class="breaking_left">
											<div class="view hm-zoom hm-black-light">
												<?php if( has_post_thumbnail() ) : ?>
                                                    <a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail( 'newspaper-magazine-thumbnail-1', array( 'class' => 'img-fluid' ) ); ?>
                                                    </a>
												<?php endif;?>
                                                <div class="mask flex-center"><a href="<?php the_permalink(); ?>"></a></div>

							                </div>
							                <div class="breakingnews_titles wow fadeInUp" data-wow-duration=".5s">
							                    <div class="breaking_category">
							                    	<?php
							                    		$categories_list = get_the_category_list( esc_html__( ', ', 'newspaper-magazine' ) );
							                    	?>
							                    	<h6><?php echo $categories_list; ?></h6>
							                    </div>
							                    <div class="author_time">
							                        <span class="author_img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
							                        	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="">
							                        		<?php echo esc_html( get_the_author() ); ?>
							                        	</a>
							                        </span>
							                        <span class="publish_date"><?php echo get_the_date(); ?></span>
							                    </div>
							                    <div class="breakingnews_title">
							                        <h4>
							                        	<a href="<?php the_permalink(); ?>" alt="">
							                        		<?php the_title(); ?>
							                        	</a>
							                        </h4>
							                    </div>
							                </div>
										</div>
						            </div>
	                	<?php
	                			endwhile;
	                			wp_reset_postdata();
	                		endif;
	                	?>
	              		</div>
	              		<!-- End Left section -->

	              		<!-- Right section -->
	                	<div class="col-xs-12 col-sm-6">
	                  		<div class="row breakingnews_right clearfix">
	                  		<?php
	                  			$arguments_2 = array(
									'cat'				=> absint( $cat_2 ),
									'posts_per_page' 	=> 1,
									'post_type'			=> 'post',
									'post__not_in'=>get_option("sticky_posts")
								);

								$query_2 = new WP_Query( $arguments_2 );
								if( $query_2->have_posts() ) :
									while( $query_2->have_posts() ) :
										$query_2->the_post();
	                  		?>
			                      		<div class="right_top clearfix">
			                        		<div class="view hm-zoom hm-black-light">
						                        <?php if( has_post_thumbnail() ) : ?>
                                                    <a href="<?php the_permalink(); ?>">
								                        <?php the_post_thumbnail( 'newspaper-magazine-thumbnail-2', array( 'class' => 'img-fluid' ) ); ?>
                                                    </a>
						                        <?php endif;?>
                                                <div class="mask flex-center"><a href="<?php the_permalink(); ?>"></a></div>
							                </div>
							                <div class="breakingnews_titles wow fadeInUp" data-wow-duration=".5s">
							                    <div class="breaking_category">
							                    	<?php
							                    		$categories_list = get_the_category_list( esc_html__( ', ', 'newspaper-magazine' ) );
							                    	?>
							                    	<h6><?php echo $categories_list; ?></h6>
							                    </div>
							                    <div class="author_time">
							                        <span class="author_img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
							                        	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="">
							                        		<?php echo esc_html( get_the_author() ); ?>
							                        	</a>
							                        </span>
							                        <span class="publish_date"><?php echo get_the_date(); ?></span>
							                    </div>
							                    <div class="breakingnews_title">
							                        <h4>
							                        	<a href="<?php the_permalink(); ?>" alt="">
							                        		<?php the_title(); ?>
							                        	</a>
							                        </h4>
							                    </div>
							                </div>
			                      		</div>
			                <?php
			                		endwhile;
			                		wp_reset_postdata();
			                	endif;

			                	$arguments_3 = array(
									'cat'				=> absint( $cat_3 ),
									'posts_per_page' 	=> 1,
									'post_type'			=> 'post',
									'post__not_in'=>get_option("sticky_posts")
								);

								$query_3 = new WP_Query( $arguments_3 );
								if( $query_3->have_posts() ) :
									while( $query_3->have_posts() ) :
										$query_3->the_post();
			                ?>
			                      		<div class="right_top clearfix">
			                        		<div class="view hm-zoom hm-black-light">
						                        <?php if( has_post_thumbnail() ) : ?>
                                                    <a href="<?php the_permalink(); ?>">
								                        <?php the_post_thumbnail( 'newspaper-magazine-thumbnail-2', array( 'class' => 'img-fluid' ) ); ?>
                                                    </a>
						                        <?php endif;?>
                                                <div class="mask flex-center"><a href="<?php the_permalink(); ?>"></a></div>
							                </div>
							                <div class="breakingnews_titles wow fadeInUp" data-wow-duration=".5s">
							                    <div class="breaking_category">
							                    	<?php
							                    		$categories_list = get_the_category_list( esc_html__( ', ', 'newspaper-magazine' ) );
							                    	?>
							                    	<h6><?php echo $categories_list; ?></h6>
							                    </div>
							                    <div class="author_time">
							                        <span class="author_img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
							                        	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="">
							                        		<?php echo esc_html( get_the_author() ); ?>
							                        	</a>
							                        </span>
							                        <span class="publish_date"><?php echo get_the_date(); ?></span>
							                    </div>
							                    <div class="breakingnews_title">
							                        <h4><a href="<?php the_permalink(); ?>" alt=""><?php the_title(); ?></a></h4>
							                    </div>
							                </div>
			                      		</div>
			                <?php
			                		endwhile;
			                		wp_reset_postdata();
			                	endif;
			                ?>
	                		</div>
	               		</div>
	              		<!-- End right section -->
	            	</div>
	         	</div>
	      	</section>
      		<?php
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'cat_1' ] = absint( $new_instance[ 'cat_1' ] );
			$instance[ 'cat_2' ] = absint( $new_instance[ 'cat_2' ] );
			$instance[ 'cat_3' ] = absint( $new_instance[ 'cat_3' ] );

			return $instance;
		}
		function form( $instance ) {
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : absint( 0 );
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : absint( 0 );
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : absint( 0 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_1' ) )?>"><strong><?php echo esc_html__( 'Left Highlight: ', 'newspaper-magazine' ); ?></strong></label>
				<?php
					$cat_args_1 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_1' ),
						'name'	=> $this->get_field_name( 'cat_1' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_1 ),
						'show_option_all'	=> esc_html__( 'All Categories', 'newspaper-magazine' )
					);
					wp_dropdown_categories( $cat_args_1 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_2' ) )?>"><strong><?php echo esc_html__( 'Right Highlight Top: ', 'newspaper-magazine' ); ?></strong></label>
				<?php
					$cat_args_2 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_2' ),
						'name'	=> $this->get_field_name( 'cat_2' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_2 ),
						'show_option_all'	=> esc_html__( 'All Categories', 'newspaper-magazine' )
					);
					wp_dropdown_categories( $cat_args_2 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_3' ) )?>"><strong><?php echo esc_html__( 'Right Highlight Bottom: ', 'newspaper-magazine' ); ?></strong></label>
				<?php
					$cat_args_3 = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat_3' ),
						'name'	=> $this->get_field_name( 'cat_3' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat_3 ),
						'show_option_all'	=> esc_html__( 'All Categories', 'newspaper-magazine' )
					);
					wp_dropdown_categories( $cat_args_3 );
				?>
			</p>
			<?php
		}
	}
endif;

if( ! class_exists( 'Newspaper_Magazine_Slider_Highlight' ) ) :
	/**
	 * Slider Highlight
	 *
	 */
	class Newspaper_Magazine_Slider_Highlight extends WP_Widget
	{

		function __construct()
		{
			$opts = array(
				'classname' => '',
				'description' => esc_html__( 'Displays posts as slider. Place it in "Highlight Wiget Area" widget area. It only works in the widget area.', 'newspaper-magazine' )
			);
			parent::__construct( 'newspaper-magazine-slider-highlight', esc_html__( 'Slider Highlight', 'newspaper-magazine' ), $opts );
		}

		function widget( $args, $instance ) {
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 5 );

			$arguments = array(
				'cat'				=> absint( $cat ),
				'posts_per_page' 	=> absint( $post_no ),
				'post_type'			=> 'post',
				'post__not_in'=>get_option("sticky_posts")
			);

			$query = new WP_Query( $arguments );
			?>
			<section class="slidingnews">
            	<div class="container-fluid">
            		<div class="row">
						<div id="owl-demo1" class="owl-demo1 owl-carousel owl-theme">
						<?php
						if( $query->have_posts() ) :
							while( $query->have_posts() ) :
								$query->the_post();
						?>
								    <!-- Start single slidingnews -->
					                <div class="item">
					                    <div class="singleslidingnews">
					                      <div class="view hm-zoom hm-black-light">
					                            <?php if( has_post_thumbnail() ) : ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail( 'newspaper-magazine-thumbnail-3', array( 'class' => 'img-fluid' ) ); ?>
                                                    </a>
                                                <?php endif;?>
                                                <div class="mask flex-center"><a href="<?php the_permalink(); ?>"></a></div>
					                      </div>
					                      <div class="singlesliding_cat">
					                          	<div class="breaking_category">
					                          		<?php
							                    		$categories_list = get_the_category_list( esc_html__( ', ', 'newspaper-magazine' ) );
							                    	?>
							                    	<h6><?php echo $categories_list; ?></h6>
					                          	</div>
					                           	<div class="publish_time">
					                             	<span class="publish_date"><?php echo get_the_date(); ?></span>
					                           	</div>
					                           	<div class="slidingnews_title">
					                            	<h4><a href="<?php the_permalink(); ?>" alt=""><?php the_title(); ?></a></h4>
					                           	</div>
					                      </div>
					                    </div>
					                </div>
					                <!-- End single slidingnews -->
						<?php
							endwhile;
						endif;
						?>
						</div>
					</div>
				</div>
			</section>
			<?php
		}


		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}


		function form( $instance ) {
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 5 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category: ', 'newspaper-magazine' ); ?></strong></label>
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
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'newspaper-magazine' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php
		}
	}
endif;