<?php
/**
 * Social Widget
 * Class Glob_Widget_Social
 */
class Glob_Widget_Social extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'social_widget', 'description' => esc_html__( "Display social network icon on any sidebar.", 'glob') );
		parent::__construct('glob_social', esc_html__('FT Socials', 'glob'), $widget_ops);
		$this->alt_option_name = 'widget_social';
	}
	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// Get values from the widget settings.
		echo $args['before_widget'];
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        if ( $title ) echo $args['before_title'] . $title . $args['after_title'];
		?>
        <div class="sidebar-social">
            <?php
            if ( has_nav_menu( 'social' ) ) {
                wp_nav_menu(
                    array(
                        'theme_location'  => 'social',
                        'container'       => 'div',
                        'container_id'    => 'menu-social',
                        'container_class' => 'social-links',
                        'menu_id'         => 'menu-social-items',
                        'menu_class'      => 'menu-items',
                        'depth'           => 1,
                        'link_before'     => '<span class="screen-reader-text">',
                        'link_after'      => '</span>',
                        'fallback_cb'     => '',
                    )
                );
            }
            ?>
        </div>
        <?php
        echo $args['after_widget'];
	}
	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}
	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		// Set default value.
		$defaults = array(
			'title'  => esc_html__( 'Stay Connected', 'glob' )
		);
		$instance   = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Widget Title:', 'glob') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
		    <?php esc_html_e( 'This widget use Social Menu to display social icons.', 'glob' ); ?>
		</p>
<?php
	}
}
