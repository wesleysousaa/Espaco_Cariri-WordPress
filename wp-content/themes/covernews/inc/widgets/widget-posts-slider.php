<?php
if (!class_exists('CoverNews_Posts_Slider')) :
    /**
     * Adds CoverNews_Posts_Slider widget.
     */
    class CoverNews_Posts_Slider extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('covernews-posts-slider-title');
            $this->select_fields = array('covernews-select-category');

            $widget_ops = array(
                'classname' => 'covernews_posts_slider_widget',
                'description' => __('Displays posts slider from selected category.', 'covernews'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('covernews_posts_slider', __('CoverNews Posts Slider', 'covernews'), $widget_ops);
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
            $instance = parent::covernews_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters('widget_title', $instance['covernews-posts-slider-title'], $instance, $this->id_base);
            $category = isset($instance['covernews-select-category']) ? $instance['covernews-select-category'] : 0;
            $show_excerpt = 'true';
            $excerpt_length = '25';
            $number_of_posts = 5;

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title)): ?>
            <div class="em-title-subtitle-wrap">
                <?php if (!empty($title)): ?>
                    <h4 class="widget-title header-after1">
                        <span class="header-after">
                            <?php echo esc_html($title);  ?>
                            </span>
                    </h4>
                <?php endif; ?>
            </div>
        <?php endif; ?>
            <?php

            $all_posts = covernews_get_posts($number_of_posts, $category);
            ?>
            <div class="posts-slider">
                <?php
                if ($all_posts->have_posts()) :
                    while ($all_posts->have_posts()) : $all_posts->the_post();
                        if (has_post_thumbnail()) {
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-slider-full');
                            $url = $thumb['0'];
                        } else {
                            $url = '';
                        }

                        global $post;
                        ?>
                        <figure class="slick-item">

                            <div class="data-bg data-bg-hover data-widget-slide" data-background="<?php echo esc_url($url); ?>">
                                <?php echo covernews_post_format($post->ID); ?>
                                <figcaption class="slider-figcaption slider-figcaption-1">

                                    <div class="figure-categories figure-categories-bg">
                                       
                                        <?php covernews_post_categories(); ?>
                                    </div>
                                    <h2 class="slide-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <div class="grid-item-metadata grid-item-metadata-1">
                                        <?php covernews_post_item_meta(); ?>
                                    </div>
                                    <?php if ($show_excerpt != 'false'): ?>
                                        <div class="full-item-discription">
                                            <div class="post-description">
                                                <?php if (absint($excerpt_length) > 0) : ?>
                                                    <?php
                                                    $excerpt = covernews_get_excerpt($excerpt_length, get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </figcaption>
                            </div>
                        </figure>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
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

            $categories = covernews_get_terms();
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::covernews_generate_text_input('covernews-posts-slider-title', __('Title', 'covernews'), 'Posts Slider');
                echo parent::covernews_generate_select_options('covernews-select-category', __('Select category', 'covernews'), $categories);

            }
        }
    }
endif;