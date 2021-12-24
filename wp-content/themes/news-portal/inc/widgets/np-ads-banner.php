<?php
/**
 * NP: Banner Ads 
 *
 * Widget show the banner ads of different size
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

class News_Portal_Ads_Banner extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_ads_banner',
            'description' => __( 'You can place a banner as an advertisement with links.', 'news-portal' )
        );
        parent::__construct( 'news_portal_ads_banner', __( 'NP: Banner Ads', 'news-portal' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'banner_title' => array(
                'news_portal_widgets_name'         => 'banner_title',
                'news_portal_widgets_title'        => __( 'Banner title', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'text'
            ),

            'banner_image' => array(
                'news_portal_widgets_name'         => 'banner_image',
                'news_portal_widgets_title'        => __( 'Select banner image', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'upload',
            ),

            'banner_url' => array(
                'news_portal_widgets_name'         => 'banner_url',
                'news_portal_widgets_title'        => __( 'Banner Link', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'url'
            ),

            'banner_target' => array(
                'news_portal_widgets_name'         => 'banner_target',
                'news_portal_widgets_title'        => __( 'Open in new tab', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'checkbox'
            ),

            'banner_rel' => array(
                'news_portal_widgets_name'         => 'banner_rel',
                'news_portal_widgets_title'        => __( 'Rel attribute for link', 'news-portal' ),
                'news_portal_widgets_field_type'   => 'checkbox'
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

        $news_portal_banner_title  = empty( $instance['banner_title'] ) ? '' : $instance['banner_title'];
        $news_portal_banner_image  = empty( $instance['banner_image'] ) ? '' : $instance['banner_image'];
        $news_portal_banner_url    = empty( $instance['banner_url'] ) ? '' : $instance['banner_url'];
        $news_portal_banner_target = empty( $instance['banner_target'] ) ? '_self' : '_blank';
        $news_portal_banner_rel    = empty( $instance['banner_rel'] ) ? '' : 'nofollow';

        echo $before_widget;

        if( !empty( $news_portal_banner_image ) ) {
    ?>
            <div class="np-ads-wrapper">
                <?php
                    if( !empty( $news_portal_banner_title ) ) {
                        echo $before_title . esc_html( $news_portal_banner_title ) . $after_title;
                    }
                ?>
                <?php
                    if( !empty( $news_portal_banner_url ) ) {
                ?>
                    <a href="<?php echo esc_url( $news_portal_banner_url );?>" target="<?php echo esc_attr( $news_portal_banner_target ); ?>" rel="<?php echo esc_attr( $news_portal_banner_rel ); ?>"><img src="<?php echo esc_url( $news_portal_banner_image ); ?>" /></a>
                <?php
                    } else {
                ?>
                    <img src="<?php echo esc_url( $news_portal_banner_image ); ?>" />
                <?php
                    }
                ?>
            </div><!-- .np-ads-wrapper -->
    <?php
        }
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