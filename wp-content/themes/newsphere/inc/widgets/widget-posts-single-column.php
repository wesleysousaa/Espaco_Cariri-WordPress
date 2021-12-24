<?php
if (!class_exists('Newsphere_Single_Col_Categorised_Posts')) :
    /**
     * Adds Newsphere_Single_Col_Categorised_Posts widget.
     */
    class Newsphere_Single_Col_Categorised_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsphere-categorised-posts-title', 'newsphere-posts-number', 'newsphere-excerpt-length');
            $this->select_fields = array('newsphere-select-category', 'newsphere-show-excerpt');

            $widget_ops = array(
                'classname' => 'newsphere_single_col_categorised_posts',
                'description' => __('Displays posts from selected category in single column.', 'newsphere'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsphere_single_col_categorised_posts', __('AFTN Single Column ', 'newsphere'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {

            $instance = parent::newsphere_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */

            $title = apply_filters('widget_title', $instance['newsphere-categorised-posts-title'], $instance, $this->id_base);
            $category = isset($instance['newsphere-select-category']) ? $instance['newsphere-select-category'] : '0';
            $show_excerpt = isset($instance['newsphere-show-excerpt']) ? $instance['newsphere-show-excerpt'] : 'true';
            $excerpt_length = 25;
            $number_of_posts = 5;

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title) || !empty($subtitle)): ?>
            <div class="em-title-subtitle-wrap">
                <?php if (!empty($title)): ?>
                    <h4 class="widget-title header-after1">
                        <span class="header-after">
                            <?php echo esc_html($title); ?>
                            </span>
                    </h4>
                <?php endif; ?>

            </div>
        <?php endif; ?>
            <?php
            $all_posts = newsphere_get_posts($number_of_posts, $category);
            ?>
            <div class="widget-block list-style clearfix">
                <?php
                if ($all_posts->have_posts()) :
                    while ($all_posts->have_posts()) : $all_posts->the_post();
                        global $post;

                        $url = newsphere_get_freatured_image_url($post->ID, 'newsphere-medium');

                        ?>

                        <div class="read-single color-pad">
                            <div class="data-bg read-img pos-rel col-2 float-l read-bg-img af-sec-list-img"
                                 data-background="<?php echo esc_url($url); ?>">
                                <?php if (!empty($url)): ?>
                                    <img src="<?php echo esc_url($url); ?>">
                                <?php endif; ?>
                                <span class="min-read-post-format">
		  								<?php echo newsphere_post_format($post->ID); ?>
                                        <?php newsphere_count_content_words($post->ID); ?>

                                        </span>

                                <a href="<?php the_permalink(); ?>"></a>
                                <?php newsphere_get_comments_count($post->ID); ?>
                            </div>
                            <div class="read-details col-2 float-l pad af-sec-list-txt color-tp-pad">
                                <div class="read-categories">
                                    <?php newsphere_post_categories(); ?>
                                </div>
                                <div class="read-title">
                                    <h4>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                </div>
                                <div class="entry-meta">
                                    <?php newsphere_post_item_meta(); ?>
                                </div>

                                    <?php if ($show_excerpt != 'false'): ?>
                                        <div class="read-descprition full-item-discription">
                                            <div class="post-description">
                                                <?php if (absint($excerpt_length) > 0) : ?>
                                                    <?php
                                                    $excerpt = newsphere_get_excerpt($excerpt_length, get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                            </div>
                        </div>
                    <?php
                    endwhile;
                    ?>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>

            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            $options = array(
                'true' => __('Yes', 'newsphere'),
                'false' => __('No', 'newsphere')

            );

            $categories = newsphere_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsphere_generate_text_input('newsphere-categorised-posts-title', 'Title', 'Single Column Posts');
                echo parent::newsphere_generate_select_options('newsphere-select-category', __('Select category', 'newsphere'), $categories);

                echo parent::newsphere_generate_select_options('newsphere-show-excerpt', __('Show excerpt', 'newsphere'), $options);



            }

            //print_pre($terms);


        }

    }
endif;