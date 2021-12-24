<?php
/**
 * NP: Featured Slider
 *
 * Widget to display posts from selected categories in featured slider ( slider + featured section )
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

class News_Portal_Featured_Slider extends WP_widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_featured_slider',
            'description' => __( 'Displays posts from selected categories in the slider with the featured section.', 'news-portal' )
        );
        parent::__construct( 'news_portal_featured_slider', __( 'NP: Featured Slider', 'news-portal' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $news_portal_categories_lists = news_portal_categories_lists();

        $fields = array(
            'slider_cat_ids' => array(
                'news_portal_widgets_name'         => 'slider_cat_ids',
                'news_portal_widgets_title'        => __( 'Slider Categories', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'multicheckboxes',
                'news_portal_widgets_field_options' => $news_portal_categories_lists
            ),

            'featured_cat_ids' => array(
                'news_portal_widgets_name'         => 'featured_cat_ids',
                'news_portal_widgets_title'        => __( 'Featured Post Categories', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'multicheckboxes',
                'news_portal_widgets_field_options' => $news_portal_categories_lists
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

        $news_portal_slider_cat_ids    = empty( $instance['slider_cat_ids'] ) ? '' : $instance['slider_cat_ids'];
        $news_portal_featured_cat_ids  = empty( $instance['featured_cat_ids'] ) ? '' : $instance['featured_cat_ids'];

        echo $before_widget;
    ?>
        <div class="np-block-wrapper np-clearfix">
            <div class="slider-posts">
                <?php
                    if( !empty( $news_portal_slider_cat_ids ) ) {
                        $checked_cats = array();
                        foreach( $news_portal_slider_cat_ids as $cat_key => $cat_value ){
                            $checked_cats[] = $cat_key;
                        }
                        $get_cats_ids = implode( ",", $checked_cats );
                        $news_portal_post_count = apply_filters( 'news_portal_slider_posts_count', 4 );
                        $news_portal_slider_args = array(
                                'post_type' => 'post',
                                'cat' => $get_cats_ids,
                                'posts_per_page' => absint( $news_portal_post_count )
                            );
                        $news_portal_slider_query = new WP_Query( $news_portal_slider_args );
                        if( $news_portal_slider_query->have_posts() ) {
                            echo '<ul id="npSlider" class="cS-hidden np-main-slider">';
                            while( $news_portal_slider_query->have_posts() ) {
                                $news_portal_slider_query->the_post();
                                if( has_post_thumbnail() ) {
                    ?>
                                    <li>
                                        <div class="np-single-slide-wrap">
                                            <div class="np-slide-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail( 'news-portal-slider-medium' ); ?>
                                                </a>
                                            </div><!-- .np-slide-thumb -->
                                            <div class="np-slide-content-wrap">
                                                <?php news_portal_post_categories_list(); ?>
                                                <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                <div class="np-post-meta"><?php news_portal_posted_on(); ?></div>
                                            </div> <!-- np-slide-content-wrap -->
                                        </div><!-- .single-slide-wrap -->
                                    </li>
                    <?php
                                }
                            }
                            echo '</ul>';
                        }
                        wp_reset_postdata();
                    }
                ?>
            </div><!-- .slider-posts -->
            <div class="featured-posts">
                <div class="featured-posts-wrapper">
                <?php
                    if( !empty( $news_portal_featured_cat_ids ) ) {
                        $checked_cats = array();
                        foreach( $news_portal_featured_cat_ids as $cat_key => $cat_value ){
                            $checked_cats[] = $cat_key;
                        }
                        $get_cats_ids = implode( ",", $checked_cats );
                        $news_portal_post_count = apply_filters( 'news_portal_slider_featured_posts_count', 4 );
                        $news_portal_slider_args = array(
                                'post_type' => 'post',
                                'cat' => $get_cats_ids,
                                'posts_per_page' => absint( $news_portal_post_count )
                            );
                        $news_portal_slider_query = new WP_Query( $news_portal_slider_args );
                        if( $news_portal_slider_query->have_posts() ) {
                            while( $news_portal_slider_query->have_posts() ) {
                                $news_portal_slider_query->the_post();
                    ?>
                                <div class="np-single-post-wrap np-clearfix">
                                    <div class="np-single-post">
                                        <div class="np-post-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                    if( has_post_thumbnail() ) {
                                                        the_post_thumbnail( 'news-portal-block-medium' );
                                                    }
                                                ?>
                                            </a>
                                        </div><!-- .np-post-thumb -->
                                        <div class="np-post-content">
                                            <?php news_portal_post_categories_list(); ?>
                                            <h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <div class="np-post-meta"><?php news_portal_posted_on(); ?></div>
                                        </div><!-- .np-post-content -->
                                    </div> <!-- np-single-post -->
                                </div><!-- .np-single-post-wrap -->
                                    
                    <?php
                            }
                        }
                        wp_reset_postdata();
                    }
                ?>
                </div>
            </div><!-- .featured-posts -->
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