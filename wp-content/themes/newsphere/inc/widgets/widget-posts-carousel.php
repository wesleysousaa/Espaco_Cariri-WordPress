<?php
if (!class_exists('Newsphere_Posts_Carousel')) :
    /**
     * Adds Newsphere_Posts_Carousel widget.
     */
    class Newsphere_Posts_Carousel extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsphere-posts-slider-title', 'newsphere-posts-slider-subtitle', 'newsphere-posts-slider-number');
            $this->select_fields = array('newsphere-select-category');

            $widget_ops = array(
                'classname' => 'newsphere_posts_carousel_widget grid-layout',
                'description' => __('Displays posts carousel from selected category.', 'newsphere'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsphere_posts_carousel', __('AFTN Posts Carousel', 'newsphere'), $widget_ops);
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

            $title = apply_filters('widget_title', $instance['newsphere-posts-slider-title'], $instance, $this->id_base);

            $number_of_posts = 5;
            $category = isset($instance['newsphere-select-category']) ? $instance['newsphere-select-category'] : '0';

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
            $all_posts = newsphere_get_posts($number_of_posts, $category);
            ?>

            <div class="posts-carousel af-widget-carousel swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();


                            global $post;
                            $url = newsphere_get_freatured_image_url($post->ID, 'newsphere-medium');
                            ?>

                            <div class="swiper-slide">
                                <div class="read-single color-pad">
                                        <div class="data-bg read-img pos-rel read-bg-img"
                                             data-background="<?php echo esc_url($url); ?>">
                                            <img src="<?php echo esc_url($url); ?>">
                                            <span class="min-read-post-format">
                                            <?php echo newsphere_post_format($post->ID); ?>
                                            <?php newsphere_count_content_words($post->ID); ?>

                                            </span>

                                            <a href="<?php the_permalink(); ?>"></a>
                                            <?php newsphere_get_comments_count($post->ID); ?>
                                        </div>
                                        <div class="read-details color-tp-pad no-color-pad">
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
                                            
                                        </div>
                                    </div>
                            </div>

                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="swiper-button-next af-slider-btn"></div>
                <div class="swiper-button-prev af-slider-btn"></div>
            </div>

            <?php
            //print_pre($all_posts);

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
            $categories = newsphere_get_terms();
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsphere_generate_text_input('newsphere-posts-slider-title', 'Title', 'Posts Carousel');
                echo parent::newsphere_generate_select_options('newsphere-select-category', __('Select category', 'newsphere'), $categories);



            }
        }
    }
endif;