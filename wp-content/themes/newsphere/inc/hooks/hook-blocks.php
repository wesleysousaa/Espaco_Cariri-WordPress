<?php
if ( ! function_exists( 'newsphere_archive_layout_selection' ) ) :
	/**
	 *
	 * @param null
	 *
	 * @return null
	 *
	 * @since Newsphere 1.0.0
	 *
	 */
	function newsphere_archive_layout_selection( $archive_layout = 'full' ) {

		//$archive_layout = newsphere_get_option( 'archive_layout' );

        //print_pre($archive_layout);

		switch ( $archive_layout ) {
			case "archive-layout-grid":
				newsphere_get_block( 'grid', 'archive' );
				break;
			case "archive-layout-list":
				newsphere_get_block( 'list', 'archive' );
				break;
			case "archive-layout-full":
				newsphere_get_block( 'full', 'archive' );
				break;

			case "archive-layout-masonry":
				newsphere_get_block( 'masonry', 'archive' );
				break;
			default:
				newsphere_get_block( 'full', 'archive' );
		}
	}
endif;


if ( ! function_exists( 'newsphere_archive_layout' ) ) :
	/**
	 *
	 * @param null
	 *
	 * @return null
	 *
	 * @since Newsphere 1.0.0
	 *
	 */
	function newsphere_archive_layout( $cat_slug = '') {

		//$archive_class = newsphere_get_option('archive_layout');

        $archive_args = newsphere_archive_layout_class($cat_slug);

		?>

		<?php if ( ! empty( $archive_args['data_mh'] ) ): ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( $archive_args['add_archive_class'] ); ?>
                     data-mh="<?php echo esc_attr( $archive_args['data_mh'] ); ?>">
				<?php newsphere_archive_layout_selection( $archive_args['archive_layout'] ); ?>
            </article>
		<?php else: ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( $archive_args['add_archive_class'] ); ?> >
				<?php newsphere_archive_layout_selection( $archive_args['archive_layout'] ); ?>
            </article>
		<?php endif; ?>

		<?php

	}

	add_action( 'newsphere_action_archive_layout', 'newsphere_archive_layout', 10, 1 );
endif;

function newsphere_archive_layout_class($cat_slug){

    if(is_category() && !empty($cat_slug)){
        $term_meta = '';
        $term_meta_list = '';
        $term_meta_grid = '';
        if(!empty($cat_slug)){
            $ajax_term = get_term_by('slug', $cat_slug, 'category');
            $t_id = $ajax_term->term_id;
        }else{
            $queried_object = get_queried_object();
            $t_id           = $queried_object->term_id;

        }

        $term_meta      = get_option( "category_layout_$t_id" );
        $term_meta_list = get_option( "category_layout_list_$t_id" );
        $term_meta_grid = get_option( "category_layout_grid_$t_id" );

        $archive_args = array();



        if ( ! empty( $term_meta ) ) {
            $archive_class = $term_meta['archive_layout_term_meta'];
        } else {
            $archive_class = newsphere_get_option( 'archive_layout' );
        }

        if ( ! empty( $term_meta_list ) ) {
            $archive_layout_list = $term_meta_list['archive_layout_alignment_term_meta_list'];

        } else {

            $archive_layout_list = newsphere_get_option( 'archive_image_alignment' );

        }

        if ( ! empty( $term_meta_grid ) ) {
            $archive_layout_grid = $term_meta_grid['archive_layout_alignment_term_meta_gird'];
        } else {
            $archive_layout_grid = newsphere_get_option( 'archive_image_alignment_grid' );
        }

    }else{

        $archive_class = newsphere_get_option( 'archive_layout' );
        $archive_layout_list = newsphere_get_option( 'archive_image_alignment_list' );
        $archive_layout_grid = newsphere_get_option( 'archive_image_alignment_grid' );

    }

    if ( $archive_class == 'archive-layout-grid' ) {
        $archive_args['archive_layout']    = 'archive-layout-grid';
        $archive_args['add_archive_class'] = 'af-sec-post latest-posts-grid col-3 float-l pad ';
        //$archive_layout_mode = newsphere_get_option('archive_image_alignment_grid');
        $archive_layout_mode = $archive_layout_grid;
        if ( $archive_layout_mode == 'archive-image-full-alternate' || $archive_layout_mode == 'archive-image-list-alternate' ) {
            $archive_args['data_mh'] = '';
        } else {
            $archive_args['data_mh'] = 'archive-layout-grid';
        }
        //$image_align_class = newsphere_get_option('archive_image_alignment_grid');
        $image_align_class = $archive_layout_grid;
        $archive_args['add_archive_class'] .= ' ' . $archive_class . ' ' . $image_align_class;

    } elseif ( $archive_class == 'archive-layout-masonry' ) {
        $archive_args['archive_layout']    = 'archive-layout-masonry';
        $archive_args['add_archive_class'] = 'latest-posts-masonry col-3 float-l pad';
        $archive_args['data_mh']           = '';
    } elseif ( $archive_class == 'archive-layout-list' ) {
        $archive_args['archive_layout']    = 'archive-layout-list';
        $archive_args['add_archive_class'] = 'latest-posts-list col-1 float-l pad';
        $archive_args['data_mh']           = '';
        //$image_align_class = newsphere_get_option('archive_image_alignment');
        $image_align_class = $archive_layout_list;
        $archive_args['add_archive_class'] .= ' ' . $archive_class . ' ' . $image_align_class;
    } else {
        $archive_args['archive_layout']    = 'archive-layout-full';
        $archive_args['add_archive_class'] = 'latest-posts-full col-1 float-l pad';
        $archive_args['data_mh']           = '';
    }

    return $archive_args;

}


//Archive div wrap before loop

if(!function_exists('newsphere_archive_layout_before_loop')) :

	/**
	 *
	 * @param null
	 *
	 * @return null
	 *
	 * @since Newsphere 1.0.0
	 *
	 */

    function newsphere_archive_layout_before_loop(){

        if(is_category()) {
	        $archive_class  = '';
	        $archive_mode   = newsphere_get_option( 'archive_layout' );
	        $queried_object = get_queried_object();
	        $t_id           = $queried_object->term_id;
	        $term_meta      = get_option( "category_layout_$t_id" );


	        if ( ! empty( $term_meta ) ) {
		        $term_meta = $term_meta['archive_layout_term_meta'];
		        if ( $term_meta == 'archive-layout-masonry' ) {
			        $archive_class = 'aft-masonry-archive-posts';
		        } else {
			        $archive_class = $term_meta;
		        }
	        } else {
		        if ( $archive_mode == 'archive-layout-masonry' ) {
			        $archive_class = 'aft-masonry-archive-posts';
		        } else {

			        $archive_class = $archive_mode;
		        }
	        }
        }else{
	        $archive_mode   = newsphere_get_option( 'archive_layout' );
	        if ( $archive_mode == 'archive-layout-masonry' ) {
		        $archive_class = 'aft-masonry-archive-posts';
	        } else {

		        $archive_class = $archive_mode;
	        }
        }
	    ?>
    <div class="af-container-row aft-archive-wrapper clearfix <?php echo esc_attr( $archive_class ); ?>">
    <?php

    }
	add_action( 'newsphere_archive_layout_before_loop', 'newsphere_archive_layout_before_loop' );
endif;

if(!function_exists('newsphere_archive_layout_after_loop')):

    function newsphere_archive_layout_after_loop(){?>
        </div>
    <?php }

add_action( 'newsphere_archive_layout_after_loop', 'newsphere_archive_layout_after_loop' );

endif;