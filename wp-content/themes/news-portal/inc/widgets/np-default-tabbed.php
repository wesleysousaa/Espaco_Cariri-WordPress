<?php
/**
 * NP: Default Tabbed
 *
 * Widget to display latest posts and comment in tabbed layout.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

class News_Portal_Default_Tabbed extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_default_tabbed',
            'description' => __( 'A widget shows recent posts and comment in tabbed layout.', 'news-portal' )
        );
        parent::__construct( 'news_portal_default_tabbed', __( 'NP: Default Tabbed', 'news-portal' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'latest_tab_title' => array(
                'news_portal_widgets_name'         => 'latest_tab_title',
                'news_portal_widgets_title'        => __( 'Latest Tab title', 'news-portal' ),
                'news_portal_widgets_default'      => __( 'Latest', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'text'
            ),

            'comments_tab_title' => array(
                'news_portal_widgets_name'         => 'comments_tab_title',
                'news_portal_widgets_title'        => __( 'Comments Tab title', 'news-portal' ),
                'news_portal_widgets_default'      => __( 'Comments', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'text'
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

        $news_portal_latest_title   = empty( $instance['latest_tab_title'] ) ? __( 'Latest', 'news-portal' ) : $instance['latest_tab_title'];
        $news_portal_comments_title  = empty( $instance['comments_tab_title'] ) ? __( 'Comments', 'news-portal' ) : $instance['comments_tab_title'];

        echo $before_widget;
    ?>
            <div class="np-default-tabbed-wrapper np-clearfix" id="np-tabbed-widget">
                
                <ul class="widget-tabs np-clearfix" id="np-widget-tab">
                    <li><a href="#latest"><?php echo esc_html( $news_portal_latest_title ); ?></a></li>
                    <li><a href="#comments"><?php echo esc_html( $news_portal_comments_title ); ?></a></li>
                </ul><!-- .widget-tabs -->

                <div id="latest" class="np-tabbed-section np-clearfix">
                    <?php
                        $news_portal_post_count = apply_filters( 'news_portal_latest_tabbed_posts_count', 5 );
                        $latest_args = array(
                                'posts_per_page' => $news_portal_post_count
                            );
                        $latest_query = new WP_Query( $latest_args );
                        if( $latest_query->have_posts() ) {
                            while( $latest_query->have_posts() ) {
                                $latest_query->the_post();
                    ?>
                                <div class="np-single-post np-clearfix">
                                    <div class="np-post-thumb">
                                        <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail( 'news-portal-block-thumb' ); ?> </a>
                                    </div><!-- .np-post-thumb -->
                                    <div class="np-post-content">
                                        <h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="np-post-meta"><?php news_portal_posted_on(); ?></div>
                                    </div><!-- .np-post-content -->
                                </div><!-- .np-single-post -->
                    <?php
                            }
                        }
                        wp_reset_postdata();
                    ?>
                </div><!-- #latest -->

                <div id="comments" class="np-tabbed-section np-clearfix">
                    <ul>
                        <?php
                            $news_portal_comments_count = apply_filters( 'news_portal_comment_tabbed_posts_count', 5 );
                            $news_portal_tabbed_comments = get_comments( array( 'number' => $news_portal_comments_count ) );
                            foreach( $news_portal_tabbed_comments as $comment  ) {
                        ?>
                                <li class="np-single-comment np-clearfix">
                                    <?php
                                        $title = get_the_title( $comment->comment_post_ID );
                                        echo '<div class="np-comment-avatar">'. get_avatar( $comment, '55' ) .'</div>';
                                    ?>
                                    <div class="np-comment-desc-wrap">
                                        <strong><?php echo esc_html( $comment->comment_author ); ?></strong>
                                        <?php esc_html_e( '&nbsp;commented on', 'news-portal' ); ?> 
                                        <a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>" rel="external nofollow" title="<?php echo esc_attr( $title ); ?>"> <?php echo esc_html( $title ); ?></a>: <?php echo esc_html( wp_html_excerpt( $comment->comment_content, 50 ) ); ?>
                                    </div><!-- .np-comment-desc-wrap -->
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div><!-- #comments -->

            </div><!-- .np-default-tabbed-wrapper -->
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