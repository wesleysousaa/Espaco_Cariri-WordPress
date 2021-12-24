<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Glob
 */
function glob_site_branding(){
    $hide_site_title = get_theme_mod( 'hide_sitetitle', 0 );
    $hide_tagline = get_theme_mod( 'hide_tagline', 0 );
    $has_logo = has_custom_logo();
    $classes = array( 'site-branding' );
    if ( $has_logo ) {
        $classes[] = 'has-logo' ;
    }
    if ( $hide_site_title ) {
        $classes[] = 'hide-site-title';
    } else {
        $classes[] = 'show-site-title';
    }
    if ( $hide_tagline ) {
        $classes[] = 'hide-tagline';
    } else {
        $classes[] = 'show-tagline';
    }
    if ( ! $hide_site_title ) {
        if ( ! $has_logo && $hide_site_title ) {
            $hide_site_title = false;
        }
    }
    ?>
    <div class="<?php echo join( " ", $classes ); ?>">
        <?php if ( $has_logo ) { ?>
            <div class="site-logo">
                <?php echo get_custom_logo(); ?>
            </div>
        <?php } ?>
        <?php
        if ( get_theme_mod( 'display_header_text', 1 ) ) {
            if (!$hide_site_title) {
                if (is_front_page() || is_home()) { ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php } else { ?>
                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php
                }
            }
            if (!$hide_tagline) {
                $description = get_bloginfo('description', 'display');
                if ($description) { ?>
                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php
                }
            }
        }
        ?>
    </div><!-- .site-branding -->
    <?php
}
if ( ! function_exists( 'glob_posted_on_author' ) ) :
function glob_posted_on_author() {
	return '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
}
endif;
if ( ! function_exists( 'glob_posted_on_date' ) ) :
function glob_posted_on_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	return '<span class="posted-on">'.$time_string.'</span>';
}
endif;
if ( ! function_exists( 'glob_posted_on_comments' ) ) :
	function glob_posted_on_comments( $show_text = false ) {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo '<i class="fa fa-comments-o"></i>';
            if ( ! $show_text ) {
                comments_popup_link( '0', '1', '%' );
            } else {
                comments_popup_link( esc_html__( '0 Comments', 'glob' ), esc_html__( '1 Comment', 'glob' ), esc_html__( '% Comments', 'glob' ) );
            }
			echo '</span>';
		}
	}
endif;
if ( ! function_exists( 'glob_get_first_category' ) ) {
    function glob_get_first_category($post_id = null)
    {
        $cats = get_the_category($post_id);
        if (!empty($cats)) {
            $category = current($cats);
            return '<a rel="category" href="' . esc_url(get_category_link($category)) . '">' . $category->name . '</a>';
        }
        return false;
    }
}
if ( ! function_exists( 'glob_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function glob_posted_on() {
	echo glob_posted_on_author();
	echo glob_posted_on_date();
	glob_posted_on_comments();
}
endif;
if ( ! function_exists( 'glob_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function glob_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' ', 'glob' ) );
		if ( $categories_list && glob_categorized_blog() ) {
			printf( '<div class="cat-links"><span>' . esc_html__( 'Posted in', 'glob' ) . '</span>%1$s</div>', $categories_list ); // WPCS: XSS OK.
		}
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( ' ', esc_html__( '', 'glob' ) );
		if ( $tags_list ) {
			printf( '<div class="tags-links"><span>' . esc_html__( 'Tagged', 'glob' ) . '</span>%1$s</div>', $tags_list ); // WPCS: XSS OK.
		}
	}
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'glob' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'glob' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function glob_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'glob_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'glob_categories', $all_the_cool_cats );
	}
	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so glob_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so glob_categorized_blog should return false.
		return false;
	}
}
/**
 * Flush out the transients used in glob_categorized_blog.
 */
function glob_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'glob_categories' );
}
add_action( 'edit_category', 'glob_category_transient_flusher' );
add_action( 'save_post',     'glob_category_transient_flusher' );
if ( ! function_exists( 'glob_comments' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
 function glob_comments( $comment, $args, $depth ) {
 	switch ( $comment->comment_type ) :
 		case 'pingback' :
 		case 'trackback' :
 	?>
 	<li class="pingback">
 		<p><?php _e( 'Pingback:', 'glob' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'glob' ), ' ' ); ?></p>
 	<?php
 			break;
 		default :
 	?>
 	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
 		<article id="comment-<?php comment_ID(); ?>" class="comment">
 			<div class="comment-author vcard">
 				<?php echo get_avatar( $comment, 60 ); ?>
 				<?php //printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
 			</div><!-- .comment-author .vcard -->
 			<div class="comment-wrapper">
 				<?php if ( $comment->comment_approved == '0' ) : ?>
 					<em><?php _e( 'Your comment is awaiting moderation.', 'glob' ); ?></em>
 				<?php endif; ?>
 				<div class="comment-meta comment-metadata">
          <strong><?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?></strong>
					<span class="says"><?php esc_html_e( 'says:', 'glob' ) ?></span><br>
 					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
 					<?php
 						/* translators: 1: date, 2: time */
 						printf( __( '%1$s at %2$s', 'glob' ), get_comment_date(), get_comment_time() ); ?>
 					</time></a>
 				</div><!-- .comment-meta .commentmetadata -->
 				<div class="comment-content"><?php comment_text(); ?></div>
 				<div class="comment-actions">
 					<?php comment_reply_link( array_merge( array( 'after' => '<i class="fa fa-reply"></i>' ), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
 				</div><!-- .reply -->
 			</div> <!-- .comment-wrapper -->
 		</article><!-- #comment-## -->
 	<?php
 			break;
 	endswitch;
 }
endif;
if ( ! function_exists( 'glob_footer_site_info' ) ) {
    function glob_footer_site_info()
    {
       
            ?>
            <div class="site-copyright">
                <?php printf(esc_html__('Copyright %1$s %2$s %3$s', 'glob'), '&copy;', esc_attr(date_i18n(__('Y', 'glob'))), esc_attr(get_bloginfo())); ?>
                <span class="sep"> &ndash; </span>
                <?php printf(esc_html__('%1$s theme by %2$s', 'glob'), 'Glob', '<a href="' . esc_url('https://famethemes.com', 'glob') . '">FameThemes</a>'); ?>
            </div>
            <?php
        
    }
}
add_action( 'glob_footer_site_info', 'glob_footer_site_info' );
if( ! function_exists( 'glob_breaking_news' ) ) {
    function glob_breaking_news(){
        $enable = get_theme_mod( 'glob_breaking_news_enable', 1 );
        $breaking_layout = get_theme_mod( 'glob_breaking_layout', 'boxed' );
        $primary_nav_layout = get_theme_mod( 'glob_nav_layout', 'boxed' );
        if ( ! $enable ) {
            return false;
        }
        $title = get_theme_mod( 'breaking_news_label', esc_html__( 'Breaking', 'glob' ) );
        $numpost = get_theme_mod( 'breaking_news_numpost', 4 );
        $tag = sanitize_text_field( get_theme_mod( 'breaking_news_tag' ) );
        if ( ! $tag ) {
            $tag = null;
        }
        $post_args = array(
            'post_type'           => 'post',
            'posts_per_page'      => $numpost,
            'post_status'         => 'publish',
            'category__in'        => null ,
            'order'               => 'DESC',
            'orderby'             => 'date',
            'tag'                 => $tag,
        );
        $custom_query = new WP_Query( apply_filters( 'glob_breaking_posts_args', $post_args ) );
        if ( $custom_query->have_posts() ) {
            ?>
            <div class="breaking_wrapper<?php echo ' breaking-layout-'.esc_attr( $breaking_layout ).' nav-'.esc_attr( $primary_nav_layout ) ?>">
                <div class="container ">
                    <div class="trending_wrapper trending_widget header-breaking">
                        <?php if ( $title ) { ?>
                        <div class="breaking_text"><strong><i class="fa fa-star"></i> <span><?php echo wp_kses_post( $title ); ?>:</span></strong></div>
                        <?php } ?>
                        <div class="trending_slider_wrapper">
                            <div class="breaking_slider">
                                <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                                    <article class="entry-breaking">
                                        <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h4>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php
            wp_reset_postdata(); // reset the query
        }
    }
}
add_action( 'glob_after_nav', 'glob_breaking_news' );
