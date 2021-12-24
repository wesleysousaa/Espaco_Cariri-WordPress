<?php
/**
 * NP: Carousel
 *
 * Widget show the posts from selected categories in carousel layouts.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

class News_Portal_Carousel extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_carousel',
            'description' => __( 'Displays posts from selected categories in carousel layouts.', 'news-portal' )
        );
        parent::__construct( 'news_portal_carousel', __( 'NP: Carousel', 'news-portal' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $news_portal_categories_lists = news_portal_categories_lists();
        
        $fields = array(

            'block_title' => array(
                'news_portal_widgets_name'         => 'block_title',
                'news_portal_widgets_title'        => __( 'Block title', 'news-portal' ),
                'news_portal_widgets_description'  => __( 'Enter your block title. (Optional - Leave blank to hide the title.)', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'text'
            ),

            'block_cat_ids' => array(
                'news_portal_widgets_name'         => 'block_cat_ids',
                'news_portal_widgets_title'        => __( 'Block Categories', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'multicheckboxes',
                'news_portal_widgets_field_options' => $news_portal_categories_lists
            ),

            'block_layout' => array(
                'news_portal_widgets_name'         => 'block_layout',
                'news_portal_widgets_title'        => __( 'Block Layouts', 'news-portal' ),
                'news_portal_widgets_default'      => 'layout1',
                'news_portal_widgets_field_type'   => 'selector',
                'news_portal_widgets_field_options' => array(
                    'layout1' => esc_url( get_template_directory_uri() . '/assets/images/full-width1.png' )
                )
            ),

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

        $news_portal_block_title    = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $news_portal_block_cat_ids  = empty( $instance['block_cat_ids'] ) ? '' : $instance['block_cat_ids'];
        $news_portal_block_layout   = empty( $instance['block_layout'] ) ? 'layout1' : $instance['block_layout'];

        if( !empty( $news_portal_block_cat_ids ) ) {
            $checked_cats = array();
            foreach( $news_portal_block_cat_ids as $cat_key => $cat_value ){            
                $checked_cats[] = $cat_key;
            }
        } else {
            return;
        }        
        $news_portal_get_cats_ids = implode( ",", $checked_cats );
        $news_portal_post_count = apply_filters( 'news_portal_carousel_default_posts_count', 10 );
        $news_portal_block_args = array(
                'cat' => $news_portal_get_cats_ids,
                'posts_per_page' => absint( $news_portal_post_count )
            );

        echo $before_widget;
    ?>
        <div class="np-block-wrapper carousel-posts np-clearfix <?php echo esc_attr( $news_portal_block_layout ); ?>">
            <div class="np-block-title-nav-wrap">
                <?php 
                    if( !empty( $news_portal_block_title ) ) {
                        echo $before_title . esc_html( $news_portal_block_title ) . $after_title;
                    }
                ?>
                    <div class="carousel-nav-action">
                        <div class="np-navPrev carousel-controls"><i class="fa fa-angle-left"></i></div>
                        <div class="np-navNext carousel-controls"><i class="fa fa-angle-right"></i></div>
                    </div>                    
                </div> <!-- np-full-width-title-nav-wrap -->
            <div class="np-block-posts-wrapper">
                <?php
                    switch ( $news_portal_block_layout ) {
                        
                        default:
                            news_portal_carousel_default_layout_section( $news_portal_block_args );
                            break;
                    }
                ?>
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