<?php
/**
 * NP: Block Posts
 *
 * Widget show the block posts from selected category in different layouts.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

class News_Portal_Block_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_block_posts np-clearfix',
            'description' => __( 'Displays block posts from selected category in different layouts.', 'news-portal' )
        );
        parent::__construct( 'news_portal_block_posts', __( 'NP: Block Posts', 'news-portal' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $news_portal_categories_dropdown = news_portal_categories_dropdown();
        
        $fields = array(

            'block_title' => array(
                'news_portal_widgets_name'         => 'block_title',
                'news_portal_widgets_title'        => __( 'Block title', 'news-portal' ),
                'news_portal_widgets_description'  => __( 'Enter your block title. (Optional - Leave blank to hide the title.)', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'text'
            ),

            'block_cat_id' => array(
                'news_portal_widgets_name'         => 'block_cat_id',
                'news_portal_widgets_title'        => __( 'Block Category', 'news-portal' ),
                'news_portal_widgets_default'      => 0,
                'news_portal_widgets_field_type'   => 'select',
                'news_portal_widgets_field_options' => $news_portal_categories_dropdown
            ),

            'block_layout' => array(
                'news_portal_widgets_name'         => 'block_layout',
                'news_portal_widgets_title'        => __( 'Block Layouts', 'news-portal' ),
                'news_portal_widgets_default'      => 'layout1',
                'news_portal_widgets_field_type'   => 'selector',
                'news_portal_widgets_field_options' => array(
                    'layout1' => esc_url( get_template_directory_uri() . '/assets/images/block-layout1.png' ),
                    'layout2' => esc_url( get_template_directory_uri() . '/assets/images/block-layout2.png' ),
                    'layout3' => esc_url( get_template_directory_uri() . '/assets/images/block-layout3.png' ),
                    'layout4' => esc_url( get_template_directory_uri() . '/assets/images/block-grid-alternate.png' )
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
        $news_portal_block_cat_id   = empty( $instance['block_cat_id'] ) ? '' : $instance['block_cat_id'];
        $news_portal_block_layout   = empty( $instance['block_layout'] ) ? 'layout1' : $instance['block_layout'];

        $widget_title_args = array(
                'title'  => $news_portal_block_title,
                'cat_id' => $news_portal_block_cat_id
            );

        echo $before_widget;
    ?>
        <div class="np-block-wrapper block-posts np-clearfix <?php echo esc_attr( $news_portal_block_layout ); ?>">
            <?php 
                if( !empty( $news_portal_block_title ) ) {
                    do_action( 'news_portal_widget_title', $widget_title_args );
                }
            ?>
            <div class="np-block-posts-wrapper">
            	<?php
            		switch ( $news_portal_block_layout ) {
            			case 'layout2':
            				news_portal_block_second_layout_section( $news_portal_block_cat_id );
            				break;

            			case 'layout3':
            				news_portal_block_box_layout_section( $news_portal_block_cat_id );
            				break;

            			case 'layout4':
            				news_portal_block_alternate_grid_section( $news_portal_block_cat_id );
            				break;
            			
            			default:
            				news_portal_block_default_layout_section( $news_portal_block_cat_id );
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