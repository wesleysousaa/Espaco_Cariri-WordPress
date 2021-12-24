<?php
/**
 * Custom hooks functions for different layout in widget section.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Widget Title
 *
 * @since 1.0.0
 */
add_action( 'news_portal_widget_title', 'news_portal_widget_title_callback' );
if( ! function_exists( 'news_portal_widget_title_callback' ) ) :
	function news_portal_widget_title_callback( $news_portal_title_args ) {
		$news_portal_block_title  = $news_portal_title_args['title'];
		$news_portal_block_cat_id = $news_portal_title_args['cat_id'];
		$news_portal_title_cat_link  = get_theme_mod( 'news_portal_widget_cat_link_option', 'show' );
		$news_portal_title_cat_color = get_theme_mod( 'news_portal_widget_cat_color_option', 'show' );
		if( $news_portal_title_cat_color == 'show' ) {
			$title_class = 'np-title np-cat-'. $news_portal_block_cat_id;
		} else {
			$title_class = 'np-title';
		}
		
		if( !empty( $news_portal_block_cat_id ) && $news_portal_title_cat_link == 'show' ) {
			$news_portal_blcok_cat_link = get_category_link( $news_portal_block_cat_id );
			echo '<h2 class="np-block-title"><a href="'. esc_url( $news_portal_blcok_cat_link ) .'"><span class="'. esc_attr( $title_class ) .'">'. esc_html( $news_portal_block_title ) .'</span></a></h2>';
		} else {
			echo '<h2 class="np-block-title"><span class="'. esc_attr( $title_class ) .'">'. esc_html( $news_portal_block_title ) .'</span></h2>';
		}		
	}
endif;


/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Default Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_block_default_layout_section' ) ) :
	function news_portal_block_default_layout_section( $cat_id ) {
		if( empty( $cat_id ) ) {
			return;
		}
		$news_portal_post_count = apply_filters( 'news_portal_block_default_posts_count', 6 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => absint( $news_portal_post_count ),
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			$post_count = 1;
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				if( $post_count == 1 ) {
					echo '<div class="np-primary-block-wrap">';
					$title_size = 'large-size';
				} elseif( $post_count == 2 ) {
					echo '<div class="np-secondary-block-wrap">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
	?>
					<div class="np-single-post np-clearfix">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php 
									if( $post_count == 1 ) {
										the_post_thumbnail( 'news-portal-slider-medium' );
									} else {
										the_post_thumbnail( 'news-portal-block-thumb' );
									}
								?>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta"><?php news_portal_posted_on(); ?></div>							
							<?php if( $post_count == 1 ) { ?>
								<div class="np-post-excerpt"><?php the_excerpt(); ?></div>
							<?php } ?>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
	<?php
				if( $post_count == 1 ) {
					echo '</div><!-- .np-primary-block-wrap -->';
				} elseif( $post_count == $total_posts_count ) {
					echo '</div><!-- .np-secondary-block-wrap -->';
				}
			$post_count++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Second Layout
 *
 * @since 1.0.0
 */

if( ! function_exists( 'news_portal_block_second_layout_section' ) ) :
	function news_portal_block_second_layout_section( $cat_id ) {
		if( empty( $cat_id ) ) {
			return;
		}
		$news_portal_post_count = apply_filters( 'news_portal_block_second_layout_posts_count', 6 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => absint( $news_portal_post_count ),
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			$post_count = 1;
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				if( $post_count == 1 ) {
					echo '<div class="np-primary-block-wrap">';
				} elseif( $post_count == 3 ) {
					echo '<div class="np-secondary-block-wrap">';
				}
				if( $post_count <= 2 ) {
					$title_size = 'large-size';
				} else {
					$title_size = 'small-size';
				}
	?>
					<div class="np-single-post np-clearfix">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php 
									if( $post_count <= 2 ) {
										the_post_thumbnail( 'news-portal-slider-medium' );
									} else {
										the_post_thumbnail( 'news-portal-block-thumb' );
									}
								?>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta"><?php news_portal_posted_on(); ?></div>
							<?php if( $post_count <= 2 ) { ?>
								<div class="np-post-excerpt"><?php the_excerpt(); ?></div>
							<?php } ?>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
	<?php
				if( $post_count == 2 ) {
					echo '</div><!-- .np-primary-block-wrap -->';
				} elseif( $post_count == $total_posts_count ) {
					echo '</div><!-- .np-secondary-block-wrap -->';
				}
				$post_count++;
			}
		}
		wp_reset_postdata();
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Box Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_block_box_layout_section' ) ) :
	function news_portal_block_box_layout_section( $cat_id ) {
		if( empty( $cat_id ) ) {
			return;
		}
		$news_portal_post_count = apply_filters( 'news_portal_block_box_posts_count', 4 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => absint( $news_portal_post_count ),
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			$post_count = 1;
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				if( $post_count == 1 ) {
					echo '<div class="np-primary-block-wrap">';
					$title_size = 'large-size';
				} elseif( $post_count == 2 ) {
					echo '<div class="np-secondary-block-wrap np-clearfix">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
	?>
					<div class="np-single-post">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php 
									if( $post_count == 1 ) {
										the_post_thumbnail( 'full' );
									} else {
										the_post_thumbnail( 'news-portal-block-medium' );
									}
								?>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta"><?php news_portal_posted_on(); ?></div>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
	<?php
				if( $post_count == 1 ) {
					echo '</div><!-- .np-primary-block-wrap -->';
				} elseif( $post_count == $total_posts_count ) {
					echo '</div><!-- .np-secondary-block-wrap -->';
				}
			$post_count++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block alternate grid
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_block_alternate_grid_section' ) ) :
	function news_portal_block_alternate_grid_section( $cat_id ) {
		if( empty( $cat_id ) ) {
			return;
		}
		$news_portal_post_count = apply_filters( 'news_portal_block_alternate_grid_posts_count', 3 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => absint( $news_portal_post_count ),
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			while( $block_query->have_posts() ) {
				$block_query->the_post();
	?>
				<div class="np-alt-grid-post np-single-post np-clearfix">
					<div class="np-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'news-portal-alternate-grid' ); ?>
						</a>
					</div><!-- .np-post-thumb -->
					<div class="np-post-content">
						<h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="np-post-meta"><?php news_portal_posted_on(); ?></div>
						<div class="np-post-excerpt"><?php the_excerpt(); ?></div>
					</div><!-- .np-post-content -->
				</div><!-- .np-single-post -->
	<?php
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Carousel Default Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_carousel_default_layout_section' ) ) :
	function news_portal_carousel_default_layout_section( $news_portal_block_args ) {
		$news_portal_block_query = new WP_Query( $news_portal_block_args );
		if( $news_portal_block_query->have_posts() ) {
			echo '<ul id="blockCarousel" class="cS-hidden">';
			while( $news_portal_block_query->have_posts() ) {
				$news_portal_block_query->the_post();
	?>
				<li>
					<div class="np-single-post np-clearfix">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'news-portal-carousel-portrait' ); ?>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<?php news_portal_post_categories_list(); ?>
							<h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta"><?php news_portal_posted_on(); ?></div>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
				</li>
	<?php
			}
			echo '</ul>';
		}
		wp_reset_postdata();
	}
endif;
