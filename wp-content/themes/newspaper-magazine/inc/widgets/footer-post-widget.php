<?php
/**
 * Newspaper Magazine Footer Post Widget
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'newspaper_magazine_post_widget_register' ) ) :
	/**
     * Register and load widgets.
     *
     * @since 1.0.0
     */
	
	function newspaper_magazine_post_widget_register() {
		/*
			Latest Post Widget Register
		*/
		register_widget( 'Newspaper_Magazine_Post_Widget' );
	}
endif;
add_action( 'widgets_init', 'newspaper_magazine_post_widget_register' );


if( ! class_exists( 'Newspaper_Magazine_Post_Widget' )  ) :
	/**
	 * Lastest Post Widget Class
	 *
	 * @since 1.0.0
	 */
	class Newspaper_Magazine_Post_Widget extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => 'latest_post',
				'description' => esc_html__( 'Displays posts. Place it in "Footer Widget Area" and only works properly in this widget area.', 'newspaper-magazine' ),
			);
			parent::__construct( 'newspaper-magazine-post-widget', esc_html__( 'Footer: Post Widget', 'newspaper-magazine' ), $opts );  
		}

		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no	= ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 4 );
			echo $args[ 'before_widget' ];
			echo $args[ 'before_title' ];
			echo $title;		
			echo $args[ 'after_title' ];
			$arguments = array(
				'cat'	=> $cat,
				'posts_per_page'	=> $post_no
			);	
			$query = new WP_Query( $arguments );
			if( $query->have_posts() ) :
				while( $query->have_posts() ) :
					$query->the_post();
					?>
					<article class="clearfix">
                        <div class="side_article_thumbnail hm-zoom">
                        	<?php
								if( has_post_thumbnail() ) :
									the_post_thumbnail( 'newspaper-magazine-thumbnail-7', array( 'class' => 'img-fluid' ) );
								endif;
							?>
                        </div>
                        <div class="side_article_contain">
                            <h4 class="side_news_heading"><a href="<?php the_permalink(); ?>" alt=""><?php the_title(); ?></a></h4>
                            <div class="author_time news_author">
                                <span class="author_img"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt=""><?php echo esc_html( get_the_author() ); ?></a></span>
                                <span class="publish_date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                    </article>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			echo $args[ 'after_widget' ];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance; 
		}

		function form( $instance ) {
			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no	= ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 4 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) )?>"><?php echo esc_html__( 'Title', 'newspaper-magazine' ); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) )?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) )?>" value="<?php echo esc_attr( $title ); ?>">
			</p>
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
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html( 'Post No: ', 'newspaper-magazine' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php
 		}
	}
endif;
