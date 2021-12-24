<?php
/**
 * FullWidth Posts
 *
 * Widget show the full width posts from selected categories in different layouts.
 *
 * @package Mystery Themes
 * @subpackage News Portal Mag
 * @since 1.0.0
 */

class News_Portal_Mag_FullWidth_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_mag_fullwidth_posts',
            'description' => __( 'Displays fullwidth posts from selected categories in different layouts.', 'news-portal-mag' )
        );
        parent::__construct( 'news_portal_mag_fullwidth_posts', __( 'NP: FullWidth Posts', 'news-portal-mag' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $npm_categories_lists = news_portal_categories_lists();
        
        $fields = array(

            'block_title' => array(
                'news_portal_widgets_name'         => 'block_title',
                'news_portal_widgets_title'        => __( 'Block title', 'news-portal-mag' ),
                'news_portal_widgets_description'  => __( 'Enter your block title. (Optional - Leave blank to hide title.)', 'news-portal-mag' ),
                'news_portal_widgets_field_type'   => 'text'
            ),

            'block_cat_ids' => array(
                'news_portal_widgets_name'         => 'block_cat_ids',
                'news_portal_widgets_title'        => __( 'Block Categories', 'news-portal-mag' ),
                'news_portal_widgets_field_type'   => 'multicheckboxes',
                'news_portal_widgets_field_options' => $npm_categories_lists
            ),

            'np_block_column' => array(
                'news_portal_widgets_name'         => 'np_block_column',
                'news_portal_widgets_title'        => __( 'No. of Columns', 'news-portal-mag' ),
                'news_portal_widgets_default'      => '4',
                'news_portal_widgets_field_type'   => 'select',
                'news_portal_widgets_field_options'=> array(
                        '2' => __( 'Columns 2', 'news-portal-mag' ),
                        '3' => __( 'Columns 3', 'news-portal-mag' ),
                        '4' => __( 'Columns 4', 'news-portal-mag' ),
                        '5' => __( 'Columns 5', 'news-portal-mag' )
                    )
            ),

            'checkbox_group_title' => array(
                'news_portal_widgets_name' => 'checkbox_group_title',
                'news_portal_widgets_title' => __( 'Featured Posts Settings', 'news-portal-mag' ),
                'news_portal_widgets_field_type' => 'np_option_title'
            ),

            'cats_list_option' => array(
                'news_portal_widgets_name' => 'cats_list_option',
                'news_portal_widgets_title' => __( 'Categories Lists', 'news-portal-mag' ),
                'news_portal_widgets_default'    => 'show',
                'news_portal_widgets_field_type' => 'switch',
                'news_portal_widgets_field_options' => array(
                        'show' => __( 'Show', 'news-portal-mag' ),
                        'hide' => __( 'Hide', 'news-portal-mag' )
                    )
            ),

            'np_posts_count' => array(
                'news_portal_widgets_name'         => 'np_posts_count',
                'news_portal_widgets_title'        => __( 'No. of Posts', 'news-portal-mag' ),
                'news_portal_widgets_default'      => '8',
                'news_portal_widgets_field_type'   => 'number'
            )

        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $np_block_title    = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $np_block_cat_ids  = empty( $instance['block_cat_ids'] ) ? '' : $instance['block_cat_ids'];

        $cats_list_option  = empty( $instance['cats_list_option'] ) ? 'show' : $instance['cats_list_option'];
        $np_posts_count    = empty( $instance['np_posts_count'] ) ? 8 : $instance['np_posts_count'];
        $np_block_column   = empty( $instance['np_block_column'] ) ? 4 : $instance['np_block_column'];

        
        if( ! empty( $np_block_cat_ids ) ) {
            $checked_cats = array();            
            foreach( $np_block_cat_ids as $cat_key => $cat_value ){
                $checked_cats[] = $cat_key;
            }            
        } else {
            return;
        }
        $np_get_cats_ids = implode( ",", $checked_cats );
        $block_args = array(
            'cat' => $np_get_cats_ids,
            'posts_per_page' => $np_posts_count,
        );       

        echo $before_widget;
    ?>
        <div class="np-block-wrapper block-posts">
            
            <?php 
                if( !empty( $np_block_title ) ) {
                    echo '<div class="np-full-width-title-nav-wrap">'.$before_title . esc_html( $np_block_title ) . $after_title.'</div> <!-- np-full-width-title-nav-wrap -->';
                }
            ?>
            
            <div class="np-block-posts-wrapper">
                <?php news_portal_mag_fullwidth_section( $block_args, $np_block_column, $cats_list_option ); ?>
            </div><!-- .np-block-posts-wrapper -->
            
        </div><!--- .np-block-wrapper -->
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    news_portal_widgets_updated_field_value()     defined in np-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$news_portal_widgets_name] = news_portal_widgets_updated_field_value( $widget_field, $new_instance[$news_portal_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    news_portal_widgets_show_widget_field()       defined in np-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $news_portal_widgets_field_value = !empty( $instance[$news_portal_widgets_name] ) ? wp_kses_post( $instance[$news_portal_widgets_name] ) : '';
            news_portal_widgets_show_widget_field( $this, $widget_field, $news_portal_widgets_field_value );
        }
    }
}