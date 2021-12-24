<?php
/**
 * Block 2 Widget
 *
 * Class Glob_Widget_Block2
 */
class Glob_Widget_Block_2 extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'block2_widget', 'description' => esc_html__( "Block posts widget, best for Home Content Top & Home Content Bottom Sidebar.", 'glob') );
		parent::__construct('glob_block_2_widget', esc_html__('FT Block 2', 'glob'), $widget_ops);
		$this->alt_option_name = 'widget_block2';
	}
	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance )
    {
        $instance = wp_parse_args( $instance, array(
            'title'               => '',
            'block_category'      => '',
            'ignore_sticky'		  => 1,
            'number_posts'        => 3,
            'order'               => 'DESC',
            'orderby'             => 'date',
            'column'              => '3'
        ) );
        // Get values from the widget settings.
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $block_category = (!empty($instance['block_category'])) ? $instance['block_category'] : '';
        $ignore_sticky = isset($instance['ignore_sticky']) ? $instance['ignore_sticky'] : 1;
        $orderby = (!empty($instance['orderby'])) ? $instance['orderby'] : 'date';
        $order = (!empty($instance['order'])) ? $instance['order'] : 'DESC';
        $number_posts = (!empty($instance['number_posts'])) ? absint($instance['number_posts']) : 3;
        if ( ! $number_posts ) {
            $number_posts = 3;
        }
        if ( ! $instance['column'] ) {
            $instance['column'] = 3;
        }
        $custom_query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $number_posts,
            'post_status' => 'publish',
            'ignore_sticky_posts' => $ignore_sticky,
            'category__in' => $block_category,
            'order' => $order,
            'orderby' => $orderby,
            'meta_query' => array(array('key' => '_thumbnail_id'))
        );
        $custom_query = new WP_Query(apply_filters('widget_block_2_posts_args', $custom_query_args));
        if ($custom_query->have_posts()) {
            echo $args['before_widget'];
            $widget_title = glob_setup_widget_cat_title( $block_category, $title );
            if ( $widget_title ) {
                ?>
                <div class="block_title_wrapper">
                    <?php
                    echo $args['before_title'];
                    if ( ! $widget_title[ 'link' ] ) {
                        echo  '<span class="block_title_text">'.$widget_title['title'].'</span>';
                    } else {
                        ?>
                        <a rel="category" href="<?php echo esc_url( $widget_title['link'] ); ?>"><?php echo esc_html( $widget_title['title'] ); ?></a>
                        <?php
                    }
                    echo $args['after_title'];
                    ?>
                </div>
            <?php } ?>
            <div class="block2_widget_content row-<?php echo esc_attr( $instance['column'] ); ?>-col">
                <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                    <article <?php post_class('col block-posts-2'); ?> >
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="featured-image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('glob-thumbnail-medium'); ?></a>
                            </div>
                        <?php } ?>
                        <header class="entry-header">
                            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                        </header>
                    </article>
                    <?php
                endwhile; ?>
            </div> <!-- .block2_widget_content -->
            <?php echo $args['after_widget']; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();
        } // end if posts
	}
	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( $new_instance, array(
            'title'               => '',
			'block_category'      => '',
			'ignore_sticky'		  => 1,
			'number_posts'        => 3,
			'order'               => 'DESC',
			'orderby'             => 'date',
			'column'              => '3'
		) );
        $instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['ignore_sticky']       = isset($new_instance['ignore_sticky']) && $new_instance['ignore_sticky'] ? 1 : 0;
		$instance['block_category']      = isset( $new_instance['block_category'] ) ?  absint( $new_instance['block_category'] ) : '' ;
		$instance['number_posts']        = absint( $new_instance['number_posts'] );
        $instance['order'] 		         = sanitize_text_field( $new_instance['order'] );
		$instance['orderby'] 		     = sanitize_text_field( $new_instance['orderby'] );
        $instance['column'] 		     = absint( $new_instance['column'] );
		return $instance;
	}
	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
        // Set default value.
		$defaults = array(
			'title'               => '',
			'block_category'      => '',
			'ignore_sticky'		  => 1,
			'number_posts'        => 3,
			'order'               => 'DESC',
			'orderby'             => 'date',
			'column'              => '3'
		);
		$instance        = wp_parse_args( (array) $instance, $defaults );
		$block_category  = $instance['block_category'];
        $list_categories = get_categories();
		$order           = array( 'ASC', 'DESC' );
		$orderby         = array('date', 'comment_count', 'rand');
        if ( ! $instance['column'] ) {
            $instance['column'] = 3;
        }
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Widget Title:', 'glob') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'block_category' ); ?>"><?php esc_html_e('Block Category:', 'glob') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'block_category' );?>" id="<?php echo $this->get_field_id( 'block_category' );?>">
				<option value="0" <?php if ( ! $instance['block_category']) echo 'selected="selected"'; ?>><?php esc_html_e('All', 'glob'); ?></option>
				<?php foreach ( $list_categories as $category ) { ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $block_category, $category->term_id ); ?>><?php echo $category->name . " (". $category->count . ")"; ?></option>
				<?php } ?>
			</select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'column' ); ?>"><?php esc_html_e('Column Layout:', 'glob') ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'column' );?>" id="<?php echo $this->get_field_id( 'column' );?>">
                <?php foreach ( array( 2,3,4,6 ) as $n ) { ?>
                    <option value="<?php echo esc_attr( $n ); ?>" <?php selected( $instance['column'], $n ); ?>><?php echo $n; ?></option>
                <?php } ?>
            </select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e('Number of posts to show:', 'glob') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" value="<?php echo esc_attr( $instance['number_posts'] ); ?>" />
		</p>
		<p>
		   <input id="<?php echo $this->get_field_id('ignore_sticky'); ?>" name="<?php echo $this->get_field_name('ignore_sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['ignore_sticky']); ?>/>
		   <label for="<?php echo $this->get_field_id('ignore_sticky'); ?>"><?php esc_html_e('Ignore Sticky Posts', 'glob') ?></label>
	    </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php esc_html_e('Order:', 'glob') ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'order' );?>" id="<?php echo $this->get_field_id( 'order' );?>">
                <?php for ( $i = 0; $i <= 1; $i++ ){ ?>
                    <option value="<?php echo esc_attr( $order[$i] ); ?>" <?php selected( $instance['order'], $order[$i] ); ?>><?php echo esc_html( $order[$i] ); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('Order By:', 'glob') ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'orderby' );?>" id="<?php echo $this->get_field_id( 'orderby' );?>">
                <?php for ( $i = 0; $i <= 2; $i++ ){ ?>
                    <option value="<?php echo esc_attr( $orderby[$i] ); ?>" <?php selected( $instance['orderby'], $orderby[$i] ); ?>><?php echo esc_html( $orderby[$i] ); ?></option>
                <?php } ?>
            </select>
        </p>
<?php
	}
}
