<?php
/**
 * Custom hooks functions are define.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Related Posts start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_related_posts_start' ) ) :
	function news_portal_related_posts_start() {
		echo '<div class="np-related-section-wrapper">';
	}
endif;

/**
 * Related Posts section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_related_posts_section' ) ) :
	function news_portal_related_posts_section() {
		$news_portal_related_option = get_theme_mod( 'news_portal_related_posts_option', 'show' );
		
		global $post;
        if( empty( $post ) ) {
            $post_id = '';
        } else {
            $post_id = $post->ID;
        }

        $categories = get_the_category( $post_id );

		if( $news_portal_related_option == 'hide' || empty( $categories ) ) {
			return;
		}
		$news_portal_related_title = get_theme_mod( 'news_portal_related_posts_title', __( 'Related Posts', 'news-portal' ) );
		if( !empty( $news_portal_related_title ) ) {
			echo '<h2 class="np-related-title np-clearfix">'. esc_html( $news_portal_related_title ) .'</h2>';
		}
        
        if ( $categories ) {
            $category_ids = array();
            foreach( $categories as $category_ed ) {
                $category_ids[] = $category_ed->term_id;
            }
        }

		$news_portal_post_count = apply_filters( 'news_portal_related_posts_count', 3 );
		
		$related_args = array(
				'no_found_rows'            	=> true,
                'update_post_meta_cache'   	=> false,
                'update_post_term_cache'   	=> false,
                'ignore_sticky_posts'      	=> 1,
                'orderby'                  	=> 'rand',
                'post__not_in'             	=> array( $post_id ),
                'category__in'				=> $category_ids,
				'posts_per_page' 		   	=> $news_portal_post_count
			);
		
		$related_query = new WP_Query( $related_args );
		if( $related_query->have_posts() ) {
			echo '<div class="np-related-posts-wrap np-clearfix">';
			while( $related_query->have_posts() ) {
				$related_query->the_post();
	?>
				<div class="np-single-post np-clearfix">
					<div class="np-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'news-portal-block-medium' ); ?>
						</a>
					</div><!-- .np-post-thumb -->
					<div class="np-post-content">
						<h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="np-post-meta">
							<?php news_portal_posted_on(); ?>
						</div>
					</div><!-- .np-post-content -->
				</div><!-- .np-single-post -->
	<?php
			}
			echo '</div><!-- .np-related-posts-wrap -->';
		}
		wp_reset_postdata();
	}
endif;

/**
 * Related Posts end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_related_posts_end' ) ) :
	function news_portal_related_posts_end() {
		echo '</div><!-- .np-related-section-wrapper -->';
	}
endif;

/**
 * Managed functions for related posts section
 *
 * @since 1.0.0
 */
add_action( 'news_portal_related_posts', 'news_portal_related_posts_start', 5 );
add_action( 'news_portal_related_posts', 'news_portal_related_posts_section', 10 );
add_action( 'news_portal_related_posts', 'news_portal_related_posts_end', 15 );