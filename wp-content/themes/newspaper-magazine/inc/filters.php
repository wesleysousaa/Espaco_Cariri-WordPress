<?php
/**
 * Add custom style of form field
 */
add_filter( 'comment_form_default_fields', 'newspaper_magazine_theme_comment_form_fileds' );
function newspaper_magazine_theme_comment_form_fileds( $fields ) {
	$commenter = wp_get_current_commenter();
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

	$fields   =  array(
		'author'=>  '<div class="form-group">
						<label for="author">'.__("Full Name*", "newspaper-magazine").'</label>
						<input class="form-control" placeholder="'.esc_attr__('Full Name','newspaper-magazine').'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
					</div>'. ( $req ? '<span class="required"></span>' : '' ),

		'email'=>   '<div class="form-group">
						<label for="email">'.__("Email Address*", "newspaper-magazine").'</label>
						<input class="form-control" placeholder="'.esc_attr__('Email','newspaper-magazine').'" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) .	'" ' . $aria_req . ' />
					</div>' . ( $req ? '<span class="required"></span>' : '' ),

		'url'=>     '<div class="form-group">
						<label for="url">'.__('Website', 'newspaper-magazine').'</label>
						<input class="form-control" id="url" name="url" placeholder="'.esc_attr__('Website','newspaper-magazine').'" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" />
					</div>',
	);

	return $fields;
}

/**
 * Add custom default values of form.
 */
add_filter( 'comment_form_defaults', 'newspaper_magazine_theme_comment_form' );
function newspaper_magazine_theme_comment_form( $args ) {
	$args['class_form'] = esc_attr__('comment_news', 'newspaper-magazine');
	$args['title_reply'] = esc_html__('Leave a comment.','newspaper-magazine');
	$args['title_reply_before'] = '<h4>';
	$args['title_reply_after'] = '</h4>';
	$args['comment_notes_before'] = '<p>'. __( 'Your email address will not be published. Required fields are marked*','newspaper-magazine' ).'</p>';
	$args['comment_field'] = '<label for="comment">'.__('Comment','newspaper-magazine').'</label>
							  <textarea id="comment" name="comment" rows="3" class="form-control" placeholder="'.''.'" aria-required="true"></textarea>';
	$args['class_submit'] = esc_attr__('btn btn-default btn-md', 'newspaper-magazine'); 
	$args['label_submit'] = esc_attr__('Post A Comment', 'newspaper-magazine');

	return $args;
}



/**
 * Filter For Custom Search Form
 *
 */
function newspaper_magazine_search_form( $form ) {
	$form = '<form method="get" id="searchform" class="td-search-form-widget" action="' . esc_url( home_url( '/' ) ) . '" >
    <div role="search">
	    <input type="text" value="' . get_search_query() . '" name="s" id="s" class="td-widget-search-input" />
	    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'newspaper-magazine' ) .'" class="wpb_button wpb_btn-inverse btn" />
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'newspaper_magazine_search_form' );

/*
* Filter For Archive Title
*/
if( !function_exists( 'newspaper_magazine_archive_title' ) ) :
	function newspaper_magazine_archive_title( $title ) {
		/*
		 * Archive Title
		 */
	    if ( is_category() ) {
	        $title = single_cat_title( '', false );
	    } elseif ( is_tag() ) {
	        $title = single_tag_title( '', false );
	    } elseif ( is_author() ) {
	        $title = '<span class="vcard">' . get_the_author() . '</span>';
	    } elseif ( is_post_type_archive() ) {
	        $title = post_type_archive_title( '', false );
	    } elseif ( is_tax() ) {
	        $title = single_term_title( '', false );
	    }	  
	    return $title;
	}
endif;
 
add_filter( 'get_the_archive_title', 'newspaper_magazine_archive_title' );

?>