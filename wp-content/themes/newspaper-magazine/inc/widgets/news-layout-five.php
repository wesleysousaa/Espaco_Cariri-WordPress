<?php
/**
 * News Layout Five
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'newspaper_magazine_news_layout_five_register' ) ) :
	function newspaper_magazine_news_layout_five_register() {
		/**
		 * Register Widget
		 */
		register_widget( 'Newspaper_Magazine_News_Layout_Five' );
	}
endif;
add_action( 'widgets_init', 'newspaper_magazine_news_layout_five_register' );

if ( ! class_exists( 'Newspaper_Magazine_News_Layout_Five' ) ) :
	/**
	* News Layout Class Five
	*/
	class Newspaper_Magazine_News_Layout_Five extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'description'	=> esc_html__( 'Displays posts. Place it in "Front Page Widget Area Top" widget area.', 'newspaper-magazine' )
			);

			parent::__construct( 'news-layout-widget-five', esc_html__( 'News Widget Five', 'newspaper-magazine' ), $opts );
		}

		function widget( $args, $instance ){
			$icon_1 = ! empty( $instance[ 'icon_1' ] ) ? $instance[ 'icon_1' ] : '';
			$title_1 = apply_filters( 'widget_title', ! empty( $instance['title_1'] ) ? $instance['title_1'] : '', $instance, $this->id_base );
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : absint( 0 );

			$icon_2 = ! empty( $instance[ 'icon_2' ] ) ? $instance[ 'icon_2' ] : '';
			$title_2 = apply_filters( 'widget_title', ! empty( $instance['title_2'] ) ? $instance['title_2'] : '', $instance, $this->id_base );
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : absint( 0 );

			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 4 );
 			?>
			<div class="col-md-12">
                <div class="row sportlifestyle clearfix wow fadeInUp" data-wow-duration=".5s">
               		<!-- Left News Section -->
                    <div class="col-xs-12 col-sm-6">
                       	<div class="row sport_news clearfix">
                       		<?php echo $args['before_title']; ?>
								<a href="<?php echo get_category_link($cat_1);?>"><i class="fa <?php echo esc_attr( $icon_1 ); ?>" aria-hidden="true"></i> <span><?php echo esc_html( $title_1 ); ?></span></a>
							<?php echo $args['after_title']; ?>
							<?php
								$arguments_1 = array(
									'cat'	=> absint( $cat_1 ),
									'posts_per_page' => absint( $post_no ),
								); 
								$query_1 = new WP_Query( $arguments_1 );
								$i = 0;
								if( $query_1->have_posts() ) :
									while( $query_1->have_posts() ) :
										$query_1->the_post();
										if( $i < 1 ) :
										?>
										<!--  Left top News Section -->
										<div class="col-xs-12">
			                                <div class="row technology_top_news">
			                                  	<?php
			                                        if( has_post_thumbnail() ) : 
			                                    ?>
			                                    	<div class="view hm-zoom hm-black-light">
			                                            <a href="<?php the_permalink(); ?>">
			                                                <?php the_post_thumbnail('newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' )); ?>
			                                            </a>
			                                        </div>
			                                    <?php
			                                      
													endif;
												?>
			                                	<div class="breakingnews_titles">
			                                   		<div class="author_time">
			                                     		<span class="author_img"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt=""><?php echo esc_html( get_the_author() ); ?></a></span>
			                                     		<span class="publish_date"><?php echo get_the_date(); ?></span>
			                                   		</div>
			                                   		<div class="breakingnews_title">
			                                    		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			                                   		</div>
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
                            <!-- End Left top News Section -->
                            <!-- Left bottom News Section -->
                            <div class="col-xs-12">
                                <div class="row sport_bottom_news">
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
			                                                <?php the_post_thumbnail('newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' )); ?>
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
                            <!-- End Left bottom News Section -->
                        </div>
                    </div>
                    <!-- Right News Section -->
                    <div class="col-xs-12 col-sm-6">
                       	<div class="row lifestyle_news clearfix">
                       		<?php echo $args['before_title']; ?>
								<a href="<?php echo get_category_link($cat_2);?>"><i class="fa <?php echo esc_attr( $icon_2 ); ?>" aria-hidden="true"></i> <span><?php echo esc_html( $title_2 ); ?></span></a>
							<?php echo $args['after_title']; ?>
							<?php
								$arguments_2 = array(
									'cat'	=> absint( $cat_2 ),
									'posts_per_page' => absint( $post_no ),
								); 
								$query_2 = new WP_Query( $arguments_2 );
								$i = 0;
								if( $query_2->have_posts() ) :
									while( $query_2->have_posts() ) :
										$query_2->the_post();
										if( $i < 1 ) :
										?>
										<!--  Right top News Section -->
										<div class="col-xs-12">
			                                <div class="row technology_top_news">
			                                  	<?php
			                                        if( has_post_thumbnail() ) : 
			                                    ?>
			                                    	<div class="view hm-zoom hm-black-light">
			                                            <a href="<?php the_permalink(); ?>">
			                                                <?php the_post_thumbnail('newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' )); ?>
			                                            </a>
			                                        </div>
			                                    <?php
			                                       	
													endif;
												?>
			                                	<div class="breakingnews_titles">
			                                   		<div class="author_time">
			                                     		<span class="author_img"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt=""><?php echo esc_html( get_the_author() ); ?></a></span>
			                                     		<span class="publish_date"><?php echo get_the_date(); ?></span>
			                                   		</div>
			                                   		<div class="breakingnews_title">
			                                    		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			                                   		</div>
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
                            <!-- End Right top News Section -->
                            <!-- Right bottom News Section -->
                            <div class="col-xs-12">
                                <div class="row sport_bottom_news">
                                	<?php
                                	if( $query_2->have_posts() ) :
                                		while( $query_2->have_posts() ) :
                                			$query_2->the_post();
                                			if( $i >= 1 ) :
                                			?>
		                                	<article class="clearfix">
		                                      	<?php
			                                        if( has_post_thumbnail() ) : 
			                                    ?>
			                                    	<div class="side_article_thumbnail hm-zoom">
			                                            <a href="<?php the_permalink(); ?>">
			                                                <?php the_post_thumbnail('newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' )); ?>
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
                            <!-- End Right bottom News Section -->
						</div>
					</div>
				</div>
			</div>
		<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'icon_1' ] = sanitize_text_field( $new_instance[ 'icon_1' ] );
			$instance[ 'title_1' ] = sanitize_text_field( $new_instance[ 'title_1' ] );
			$instance[ 'cat_1' ] = absint( $new_instance[ 'cat_1' ] );

			$instance[ 'icon_2' ] = sanitize_text_field( $new_instance[ 'icon_2' ] );
			$instance[ 'title_2' ] = sanitize_text_field( $new_instance[ 'title_2' ] );
			$instance[ 'cat_2' ] = absint( $new_instance[ 'cat_2' ] );

			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}

		function form( $instance ) {

			$icon_1 = ! empty( $instance[ 'icon_1' ] ) ? $instance[ 'icon_1' ] : '';
			$title_1 = ! empty( $instance[ 'title_1' ] ) ? $instance[ 'title_1' ] : '';
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : absint( 0 );

			$icon_2 = ! empty( $instance[ 'icon_2' ] ) ? $instance[ 'icon_2' ] : '';
			$title_2 = ! empty( $instance[ 'title_2' ] ) ? $instance[ 'title_2' ] : '';
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : absint( 0 );

			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 4 );
			?>
			<h4>Left News</h4>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon_1' ) ); ?>"><strong><?php echo esc_html( 'Icon: ' )?></strong></label>
				<p><i><?php echo esc_html__('Use FontAwesome Icon. Example: fa-cog', 'newspaper-magazine');?></i></p>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'icon_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_1' ) ); ?>" value="<?php echo esc_attr( $icon_1 ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title_1' ) ); ?>"><strong><?php echo esc_html( 'Title: ' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_1' ) ); ?>" value="<?php echo esc_attr( $title_1 ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_1' ) )?>"><strong><?php echo esc_html__( 'Select Category: ', 'newspaper-magazine' ); ?></strong></label>
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
			<br/>		

			<h4>Right News</h4>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon_2' ) ); ?>"><strong><?php echo esc_html( 'Icon: ' )?></strong></label>
				<p><i><?php echo esc_html__('Use FontAwesome Icon. Example: fa-cog', 'newspaper-magazine');?></i></p>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'icon_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_2' ) ); ?>" value="<?php echo esc_attr( $icon_2 ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title_2' ) ); ?>"><strong><?php echo esc_html( 'Title: ' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_2' ) ); ?>" value="<?php echo esc_attr( $title_2 ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_2' ) )?>"><strong><?php echo esc_html__( 'Select Category: ', 'newspaper-magazine' ); ?></strong></label>
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
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No For Both News: ', 'newspaper-magazine' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php			
		}
	}
endif;
?>