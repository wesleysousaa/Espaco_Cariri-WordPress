<?php
if (!class_exists('CoverNews_Double_Col_Categorised_Posts')) :
    /**
     * Adds CoverNews_Double_Col_Categorised_Posts widget.
     */
    class CoverNews_Double_Col_Categorised_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('covernews-categorised-posts-title-1', 'covernews-categorised-posts-title-2');
            $this->select_fields = array('covernews-select-category-1', 'covernews-select-category-2');

            $widget_ops = array(
                'classname' => 'covernews_Posts_Grid',
                'description' => __('Displays posts from 2 selected categories in double column.', 'covernews'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('covernews_Posts_Grid', __('CoverNews Double Categories Posts', 'covernews'), $widget_ops);
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

            $title_1 = apply_filters('widget_title', $instance['covernews-categorised-posts-title-1'], $instance, $this->id_base);
            $title_2 = apply_filters('widget_title', $instance['covernews-categorised-posts-title-2'], $instance, $this->id_base);
            $category_1 = isset($instance['covernews-select-category-1']) ? $instance['covernews-select-category-1'] : '0';
            $category_2 = isset($instance['covernews-select-category-2']) ? $instance['covernews-select-category-2'] : '0';
            $layout_1 = 'full-plus-list';
            $layout_2 = 'list';
            $number_of_posts_1 = 4;
            $number_of_posts_2 = 5;


            // open the widget container
            echo $args['before_widget'];
            ?>


            <div class="widget-block">
                <div class="row">


                    <div class="col-sm-6 <?php echo esc_attr($layout_1); ?>">
                        <?php if (!empty($title_1)): ?>
                            <h4 class="widget-title header-after1">
                        <span class="header-after">
                            <?php echo esc_html($title_1); ?>
                            </span>
                            </h4>
                        <?php endif; ?>
                        <?php $all_posts = covernews_get_posts($number_of_posts_1, $category_1); ?>
                        <?php

                        if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-medium');
                                    $url = $thumb['0'];

                                } else {
                                    $url = '';

                                }

                                if ($url == '') {
                                    $img_class = 'no-image';
                                }
                                global $post;

                                ?>

                                <div class="spotlight-post">
                                    <figure class="categorised-article">
                                        <div class="categorised-article-wrapper">
                                            <div class="data-bg data-bg-hover data-bg-categorised"
                                                 data-background="<?php echo esc_url($url); ?>"><a
                                                        href="<?php the_permalink(); ?>"></a>

                                            </div>
                                        </div>
                                    </figure>

                                    <?php echo covernews_post_format($post->ID); ?>
                                    <figcaption>
                                        <div class="figure-categories figure-categories-bg">
                                            <?php covernews_post_categories(); ?>
                                        </div>
                                        <h3 class="article-title article-title-1">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="grid-item-metadata">
                                            <?php covernews_post_item_meta(); ?>
                                        </div>
                                    </figcaption>
                                </div>

                            <?php

                            endwhile;
                            ?>
                        <?php endif;
                        wp_reset_postdata(); ?>
                    </div>

                    <div class="col-sm-6 <?php echo esc_attr($layout_2); ?>">
                        <?php if (!empty($title_2)): ?>
                            <h4 class="widget-title header-after1">
                        <span class="header-after">
                            <?php echo esc_html($title_2); ?>
                            </span>
                            </h4>
                        <?php endif; ?>
                        <?php $all_posts = covernews_get_posts($number_of_posts_2, $category_2); ?>
                        <?php
                        $count = 1;
                        if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-medium');
                                    $url = $thumb['0'];

                                } else {
                                    $url = '';

                                }

                                if ($url == '') {
                                    $img_class = 'no-image';
                                }
                                global $post;

                                ?>

                                <div class="spotlight-post">
                                    <figure class="categorised-article">
                                        <div class="categorised-article-wrapper">
                                            <div class="data-bg data-bg-hover data-bg-categorised"
                                                 data-background="<?php echo esc_url($url); ?>"><a
                                                        href="<?php the_permalink(); ?>"></a>

                                            </div>
                                        </div>
                                    </figure>
                                    <?php echo covernews_post_format($post->ID); ?>
                                    <figcaption>
                                        <div class="figure-categories figure-categories-bg">

                                            <?php covernews_post_categories(); ?>
                                        </div>
                                        <h3 class="article-title article-title-1">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="grid-item-metadata">
                                            <?php covernews_post_item_meta(); ?>
                                        </div>
                                    </figcaption>
                                </div>

                                <?php
                                $count++;
                            endwhile;
                            ?>
                        <?php endif;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
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
                'full-plus-list' => __('Big thumb in first and other in list', 'covernews'),
                'list' => __('All in list', 'covernews')

            );


            //print_pre($terms);
            $categories = covernews_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::covernews_generate_text_input('covernews-categorised-posts-title-1', __('Title 1', 'covernews'), 'Double Categories Posts 1');
                echo parent::covernews_generate_select_options('covernews-select-category-1', __('Select category 1', 'covernews'), $categories);
                echo parent::covernews_generate_text_input('covernews-categorised-posts-title-2', __('Title 2', 'covernews'), 'Double Categories Posts 2');
                echo parent::covernews_generate_select_options('covernews-select-category-2', __('Select category 2', 'covernews'), $categories);

            }

            //print_pre($terms);


        }

    }
endif;