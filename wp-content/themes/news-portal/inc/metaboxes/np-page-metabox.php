<?php
/**
 * Create a metabox to added some custom filed in pages.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.8
 */

 add_action( 'add_meta_boxes', 'news_portal_page_meta_options' );
 
 if( ! function_exists( 'news_portal_page_meta_options' ) ):
 function  news_portal_page_meta_options() {
    add_meta_box(
        'news_portal_page_meta',
        esc_html__( 'Page Meta Options', 'news-portal' ),
        'news_portal_page_meta_callback',
        'page',
        'normal',
        'high'
    );
 }
 endif;

$news_portal_post_sidebar_options = array(
    'default-sidebar' => array(
            'id'		=> 'post-defalut-sidebar',
            'value'     => 'default_sidebar',
            'label'     => __( 'Default Sidebar', 'news-portal' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
        ),
    'left-sidebar' => array(
            'id'		=> 'post-right-sidebar',
            'value'     => 'left_sidebar',
            'label'     => __( 'Left sidebar', 'news-portal' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
        ),
    'right-sidebar' => array(
            'id'		=> 'post-left-sidebar',
            'value'     => 'right_sidebar',
            'label'     => __( 'Right sidebar', 'news-portal' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
        ),
    'no-sidebar' => array(
            'id'		=> 'post-no-sidebar',
            'value'     => 'no_sidebar',
            'label'     => __( 'No sidebar Full width', 'news-portal' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
        ),
    'no-sidebar-center' => array(
            'id'		=> 'post-no-sidebar-center',
            'value'     => 'no_sidebar_center',
            'label'     => __( 'No sidebar Content Centered', 'news-portal' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
        )
);

/**
 * Callback function for post option
 */
if( ! function_exists( 'news_portal_page_meta_callback' ) ):
	function news_portal_page_meta_callback() {
		global $post, $news_portal_post_sidebar_options;

        $get_post_meta_identity = get_post_meta( $post->ID, 'post_meta_identity', true );
        $post_identity_value = empty( $get_post_meta_identity ) ? 'np-metabox-info' : $get_post_meta_identity;

		wp_nonce_field( basename( __FILE__ ), 'news_portal_page_meta_nonce' );
?>
		<div class="np-meta-container np-clearfix">
			<ul class="np-meta-menu-wrapper">
				<li class="np-meta-tab <?php if( $post_identity_value == 'np-metabox-info' ) { echo 'active'; } ?>" data-tab="np-metabox-info"><span class="dashicons dashicons-clipboard"></span><?php esc_html_e( 'Information', 'news-portal' ); ?></li>
				<li class="np-meta-tab <?php if( $post_identity_value == 'np-metabox-sidebar' ) { echo 'active'; } ?>" data-tab="np-metabox-sidebar"><span class="dashicons dashicons-exerpt-view"></span><?php esc_html_e( 'Sidebars', 'news-portal' ); ?></li>
			</ul><!-- .np-meta-menu-wrapper -->
			<div class="np-metabox-content-wrapper">
				
				<!-- Info tab content -->
				<div class="np-single-meta active" id="np-metabox-info">
					<div class="content-header">
						<h4><?php esc_html_e( 'About Metabox Options', 'news-portal' ) ;?></h4>
					</div><!-- .content-header -->
					<div class="meta-options-wrap"><?php esc_html_e( 'In this section we have lots of features which make your post unique and completely different.', 'news-portal' ); ?></div><!-- .meta-options-wrap  -->
				</div><!-- #np-metabox-info -->

				<!-- Sidebar tab content -->
				<div class="np-single-meta" id="np-metabox-sidebar">
					<div class="content-header">
						<h4><?php esc_html_e( 'Available Sidebars', 'news-portal' ) ;?></h4>
						<span class="section-desc"><em><?php esc_html_e( 'Select sidebar from available options which replaced sidebar layout from customizer settings.', 'news-portal' ); ?></em></span>
					</div><!-- .content-header -->
					<div class="np-meta-options-wrap">
						<div class="buttonset">
							<?php
			                   	foreach ( $news_portal_post_sidebar_options as $field ) {
			                    	$news_portal_post_sidebar = get_post_meta( $post->ID, 'np_single_post_sidebar', true );
                                    $news_portal_post_sidebar = ( $news_portal_post_sidebar ) ? $news_portal_post_sidebar : 'default_sidebar';
			                ?>
			                    	<input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="np_single_post_sidebar" <?php checked( $field['value'], $news_portal_post_sidebar ); ?> />
			                    	<label for="<?php echo esc_attr( $field['id'] ); ?>">
			                    		<span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
			                    		<img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
			                    	</label>
			                    
			                <?php } ?>
						</div><!-- .buttonset -->
					</div><!-- .meta-options-wrap  -->
				</div><!-- #np-metabox-sidebar -->

            </div><!-- .np-metabox-content-wrapper -->

            <div class="clear"></div>
            <input type="hidden" id="post-meta-selected" name="post_meta_identity" value="<?php echo esc_attr( $post_identity_value ); ?>" />
		</div><!-- .np-meta-container -->
<?php
	}
endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta options
 *
 * @since 1.0.8
 */
add_action( 'save_post', 'news_portal_save_page_meta' );

if( ! function_exists( 'news_portal_save_page_meta' ) ):

function news_portal_save_page_meta( $post_id ) {

    global $post, $np_allowed_textarea;

    // Verify the nonce before proceeding.
    $news_portal_post_nonce   = isset( $_POST['news_portal_page_meta_nonce'] ) ? $_POST['news_portal_page_meta_nonce'] : '';
    $news_portal_post_nonce_action = basename( __FILE__ );

    //* Check if nonce is set...
    if ( ! isset( $news_portal_post_nonce ) ) {
        return;
    }

    //* Check if nonce is valid...
    if ( ! wp_verify_nonce( $news_portal_post_nonce, $news_portal_post_nonce_action ) ) {
        return;
    }

    //* Check if user has permissions to save data...
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    //* Check if not an autosave...
    if ( wp_is_post_autosave( $post_id ) ) {
        return;
    }

    //* Check if not a revision...
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    /**
     * Post sidebar
     */
    $post_sidebar = get_post_meta( $post_id, 'np_single_post_sidebar', true );
    $stz_post_sidebar = sanitize_text_field( $_POST['np_single_post_sidebar'] );

    if ( $stz_post_sidebar && $stz_post_sidebar != $post_sidebar ) {  
        update_post_meta ( $post_id, 'np_single_post_sidebar', $stz_post_sidebar );
    } elseif ( '' == $stz_post_sidebar && $post_sidebar ) {  
        delete_post_meta( $post_id,'np_single_post_sidebar', $post_sidebar );  
    }

    /**
     * post meta identity
     */
    $post_identity = get_post_meta( $post_id, 'post_meta_identity', true );
    $stz_post_identity = sanitize_text_field( $_POST[ 'post_meta_identity' ] );

    if ( $stz_post_identity && '' == $stz_post_identity ){
        add_post_meta( $post_id, 'post_meta_identity', $stz_post_identity );
    }elseif ( $stz_post_identity && $stz_post_identity != $post_identity ) {
        update_post_meta($post_id, 'post_meta_identity', $stz_post_identity );
    } elseif ( '' == $stz_post_identity && $post_identity ) {
        delete_post_meta( $post_id, 'post_meta_identity', $post_identity );
    }
}
endif;