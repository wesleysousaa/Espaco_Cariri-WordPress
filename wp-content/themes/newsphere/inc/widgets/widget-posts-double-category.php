<?php
if (!class_exists('Newsphere_Double_Col_Categorised_Posts')) :
    /**
     * Adds Newsphere_Double_Col_Categorised_Posts widget.
     */
    class Newsphere_Double_Col_Categorised_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsphere-categorised-posts-title-1', 'newsphere-categorised-posts-title-2', 'newsphere-posts-number-1', 'newsphere-posts-number-2');
            $this->select_fields = array('newsphere-select-category-1', 'newsphere-select-category-2', 'newsphere-select-layout-1', 'newsphere-select-layout-2');

            $widget_ops = array(
                'classname' => 'newsphere_double_col_categorised_posts',
                'description' => __('Displays posts from 2 selected categories in double column.', 'newsphere'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsphere_double_col_categorised_posts', __('AFTN Double Categories Posts', 'newsphere'), $widget_ops);
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

            $title_1 = apply_filters('widget_title', $instance['newsphere-categorised-posts-title-1'], $instance, $this->id_base);
            $title_2 = apply_filters('widget_title', $instance['newsphere-categorised-posts-title-2'], $instance, $this->id_base);
            $category_1 = isset($instance['newsphere-select-category-1']) ? $instance['newsphere-select-category-1'] : '0';
            $category_2 = isset($instance['newsphere-select-category-2']) ? $instance['newsphere-select-category-2'] : '0';
            $layout_1 = isset($instance['newsphere-select-layout-1']) ? $instance['newsphere-select-layout-1'] : 'full-plus-list';
            $layout_2 = isset($instance['newsphere-select-layout-2']) ? $instance['newsphere-select-layout-2'] : 'list';
            $number_of_posts_1 =  4;
            $number_of_posts_2 =  4;


            // open the widget container
            echo $args['before_widget'];
            ?>


            <div class="widget-block">
                <div class="af-container-row clearfix">
                    <div class="col-2 float-l pad <?php echo esc_attr($layout_1); ?> grid-plus-list af-sec-post">
                        <?php if (!empty($title_1)): ?>
                            <h4 class="widget-title header-after1">
                            <span class="header-after">
                                <?php echo esc_html($title_1); ?>
                            </span>
                            </h4>
                        <?php endif; ?>
                        <div class="af-container-row clearfix af-double-column list-style">
                            <?php $all_posts = newsphere_get_posts($number_of_posts_1, $category_1); ?>
                            <?php
                            $count_1 = 1;


                            if ($all_posts->have_posts()) :
                                while ($all_posts->have_posts()) : $all_posts->the_post();



                                        if ($count_1 == 1) {
                                            $thumbnail_size = 'newsphere-medium';

                                        } else {
                                            $thumbnail_size = 'thumbnail';
                                        }


                                    global $post;
                                    $url = newsphere_get_freatured_image_url($post->ID, $thumbnail_size);

                                    if ($url == '') {
                                        $img_class = 'no-image';
                                    }
                                    global $post;

                                    ?>

                                    <div class="col-1 float-l pad aft-spotlight-posts-<?php echo esc_attr($count_1); ?>">
                                        <div class="read-single color-pad">
                                            <div class="data-bg read-img pos-rel col-4 float-l marg-15-lr read-bg-img"
                                                 data-background="<?php echo esc_url($url); ?>">
                                                <img src="<?php echo esc_url($url); ?>">
                                                <span class="min-read-post-format">
    		  								    <?php echo newsphere_post_format($post->ID); ?>
                                                <?php newsphere_count_content_words($post->ID); ?>

                                                </span>
                                                <a href="<?php the_permalink(); ?>"></a>
                                                <?php
                                                if ($count_1 == 1) {
                                                    newsphere_get_comments_count($post->ID);
                                                } ?>
                                            </div>
                                            <div class="read-details col-75 float-l pad color-tp-pad">
                                                <div class="read-categories">
                                                    <?php newsphere_post_categories(); ?>
                                                </div>
                                                <div class="read-title">
                                                    <h4>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                </div>
                                                <div class="entry-meta">
                                                    <?php
                                                    if ($count_1 > 1) {
                                                        newsphere_get_comments_count($post->ID);
                                                    } ?>
                                                    <?php newsphere_post_item_meta(); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $count_1++;
                                endwhile;
                                ?>
                            <?php endif;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <div class="col-2 float-l pad <?php echo esc_attr($layout_2); ?> grid-plus-list af-sec-post">
                        <?php if (!empty($title_2)): ?>
                            <h4 class="widget-title header-after1">
                    <span class="header-after">
                        <?php echo esc_html($title_2); ?>
                        </span>
                            </h4>
                        <?php endif; ?>
                        <div class="af-container-row clearfix af-double-column list-style">
                            <?php $all_posts = newsphere_get_posts($number_of_posts_2, $category_2); ?>
                            <?php
                            $count_2 = 1;


                            if ($all_posts->have_posts()) :
                                while ($all_posts->have_posts()) : $all_posts->the_post();



                                        if ($count_2 == 1) {
                                            $thumbnail_size = 'newsphere-medium';

                                        } else {
                                            $thumbnail_size = 'thumbnail';
                                        }



                                    global $post;
                                    $url = newsphere_get_freatured_image_url($post->ID, $thumbnail_size);

                                    if ($url == '') {
                                        $img_class = 'no-image';
                                    }


                                    ?>

                                    <div class="col-1 float-l pad aft-spotlight-posts-<?php echo esc_attr($count_2); ?>">
                                        <div class="read-single color-pad">
                                            <div class="data-bg read-img pos-rel col-4 float-l marg-15-lr read-bg-img"
                                                 data-background="<?php echo esc_url($url); ?>">
                                                <img src="<?php echo esc_url($url); ?>">
                                                <span class="min-read-post-format">
		  								    <?php echo newsphere_post_format($post->ID); ?>
                                            <?php newsphere_count_content_words($post->ID); ?>

                                            </span>
                                                <a href="<?php the_permalink(); ?>"></a>
                                                <?php
                                                if ($count_2 == 1) {
                                                    newsphere_get_comments_count($post->ID);
                                                } ?>
                                            </div>
                                            <div class="read-details col-75 float-l pad color-tp-pad">
                                                <div class="read-categories">
                                                    <?php newsphere_post_categories(); ?>
                                                </div>
                                                <div class="read-title">
                                                    <h4>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                </div>
                                                <div class="entry-meta">
                                                    <?php
                                                    if ($count_2 > 1) {
                                                        newsphere_get_comments_count($post->ID);
                                                    } ?>
                                                    <?php newsphere_post_item_meta(); ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $count_2++;
                                endwhile;
                                ?>
                            <?php endif;
                            wp_reset_postdata(); ?>
                        </div>
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

            //print_pre($terms);
            $categories = newsphere_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsphere_generate_text_input('newsphere-categorised-posts-title-1', __('Title 1', 'newsphere'), 'Double Categories Posts 1');
                echo parent::newsphere_generate_select_options('newsphere-select-category-1', __('Select category 1', 'newsphere'), $categories);
                echo parent::newsphere_generate_text_input('newsphere-categorised-posts-title-2', __('Title 2', 'newsphere'), 'Double Categories Posts 2');
                echo parent::newsphere_generate_select_options('newsphere-select-category-2', __('Select category 2', 'newsphere'), $categories);
            }

            //print_pre($terms);


        }

    }
endif;