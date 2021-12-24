<?php
/**
 * Recent Posts widget
 *
 * Class Glob_Recent_Post_Widget
 */
class Glob_Widget_Recent_Posts extends WP_Widget {
    function __construct() {
        parent::__construct(
            'glob-posts',
            esc_html__( 'FT Sidebar Posts with Thumbnail', 'glob' ),
            array(
                'classname' => 'glob-posts-widget',
                'description' => esc_html__( 'Displays list of posts with small thumbnail.', 'glob' ),
                'customize_selective_refresh' => true
            )
        );
    }
    function widget( $args, $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'number' => 4,
            'orderby' => 'date',
            'order' => 'desc',
        ) );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Recent Posts', 'glob' ) : $instance['title'], $instance, $this->id_base );
        $post_args = array(
            'posts_per_page' => absint( $instance['number'] ),
            'order' =>   $instance['order'],
            'orderby' => $instance['orderby'],
            'post_type' => 'post',
            'meta_key' => '_thumbnail_id',
        );
        $query = new WP_Query( $post_args );
        echo $args['before_widget'];
        if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };
        if ( $query->have_posts() ) {
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
            }
            ?>
            <ul class="widget-posts"><?php
            while ( $query->have_posts() ) {
                $query->the_post();
                ?>
                <li class="<?php echo ( has_post_thumbnail() ) ? 'has-thumb' : 'no-thumb'; ?>">
                    <?php
                    if ( has_post_thumbnail() ) {
                        ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a><?php
                    }
                    ?>
                    <div class="p-info">
                    <h2 class="entry-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title( ); ?></a></h2>
                    <?php
                    echo '<span class="entry-date">' . get_the_date() . '</span>';
                    ?>
                    </div>
                </li>
                <?php
            }
            ?></ul><?php
        }
        wp_reset_postdata();
        echo $args['after_widget'];
    }
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'title' => esc_html__( 'Recent Posts', 'glob' ),
            'number' => 4,
            'orderby' => 'date',
            'order' => 'desc'
        ) );
        $title = $instance['title'];
        $number = absint( $instance['number'] );
        $orderby = $instance['orderby'];
        $order = $instance['order'];
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'glob' ); ?>:
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'glob' ); ?>:
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order by', 'glob' ); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" class="widefat">
                <option value="date" <?php selected( 'date', $orderby ) ?>><?php esc_html_e( 'Date', 'glob' ); ?></option>
                <option value="title" <?php selected( 'title', $orderby ) ?>><?php esc_html_e( 'Title', 'glob' ); ?></option>
                <option value="comment_count" <?php selected( 'Comment count', $orderby ) ?>><?php esc_html_e( 'Comment count', 'glob' ); ?></option>
                <option value="rand" <?php selected( 'rand', $orderby ) ?>><?php esc_html_e( 'Random', 'glob' ); ?></option>
            </select>
        </p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'glob' ); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" class="widefat">
                <option value="DESC" <?php selected( 'DESC', $order ) ?>><?php esc_html_e( 'DESC', 'glob' ); ?></option>
                <option value="ASC" <?php selected( 'ASC', $order ) ?>><?php esc_html_e( 'ASC', 'glob' ); ?></option>
            </select>
        </p>
        <?php
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array(
            'title' => '',
            'number' => 4,
            'orderby' => 'date',
            'order' => 'desc',
            'skip_featured' => ''
        ) );
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = ! absint( $new_instance['number'] ) ? 4 : absint( $new_instance['number'] );
        $instance['orderby'] =  sanitize_text_field( $new_instance['orderby'] );
        $instance['order'] =  sanitize_text_field( $new_instance['order'] );
        return $instance;
    }
}
