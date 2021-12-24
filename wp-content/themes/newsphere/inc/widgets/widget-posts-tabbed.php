<?php
if (!class_exists('Newsphere_Tabbed_Posts')) :
    /**
     * Adds Newsphere_Tabbed_Posts widget.
     */
    class Newsphere_Tabbed_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsphere-tabbed-popular-posts-title', 'newsphere-tabbed-latest-posts-title', 'newsphere-tabbed-categorised-posts-title', 'newsphere-excerpt-length', 'newsphere-posts-number');

            $this->select_fields = array('newsphere-show-excerpt', 'newsphere-enable-categorised-tab', 'newsphere-select-category');

            $widget_ops = array(
                'classname' => 'newsphere_tabbed_posts_widget',
                'description' => __('Displays tabbed posts lists from selected settings.', 'newsphere'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsphere_tabbed_posts', __('AFTN Tabbed Posts', 'newsphere'), $widget_ops);
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
            $tab_id = 'tabbed-' . $this->number;


            /** This filter is documented in wp-includes/default-widgets.php */

            $show_excerpt = 'false';
            $excerpt_length = '20';
            $number_of_posts =  '5';


            $popular_title = isset($instance['newsphere-tabbed-popular-posts-title']) ? $instance['newsphere-tabbed-popular-posts-title'] : __('AFTN Popular', 'newsphere');
            $latest_title = isset($instance['newsphere-tabbed-latest-posts-title']) ? $instance['newsphere-tabbed-latest-posts-title'] : __('AFTN Latest', 'newsphere');


            $enable_categorised_tab = isset($instance['newsphere-enable-categorised-tab']) ? $instance['newsphere-enable-categorised-tab'] : 'true';
            $categorised_title = isset($instance['newsphere-tabbed-categorised-posts-title']) ? $instance['newsphere-tabbed-categorised-posts-title'] : __('Trending', 'newsphere');
            $category = isset($instance['newsphere-select-category']) ? $instance['newsphere-select-category'] : '0';


            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="tabbed-head">
                    <ul class="nav nav-tabs af-tabs tab-warpper" role="tablist">
                        <li class="tab tab-recent active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_attr_e('Recent', 'newsphere'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <i class="fa fa-bolt" aria-hidden="true"></i>  <?php echo esc_html($latest_title); ?>
                            </a>
                        </li>
                        <li role="presentation" class="tab tab-popular">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_attr_e('Popular', 'newsphere'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>  <?php echo esc_html($popular_title); ?>
                            </a>
                        </li>

                        <?php if ($enable_categorised_tab == 'true'): ?>
                            <li class="tab tab-categorised">
                                <a href="#<?php echo esc_attr($tab_id); ?>-categorised"
                                   aria-controls="<?php esc_attr_e('Categorised', 'newsphere'); ?>" role="tab"
                                   data-toggle="tab" class="font-family-1">
                                   <i class="fa fa-fire" aria-hidden="true"></i>  <?php echo esc_html($categorised_title); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane active">
                        <?php
                        newsphere_render_posts('recent', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane">
                        <?php
                        newsphere_render_posts('popular', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>
                    <?php if ($enable_categorised_tab == 'true'): ?>
                        <div id="<?php echo esc_attr($tab_id); ?>-categorised" role="tabpanel" class="tab-pane">
                            <?php
                            newsphere_render_posts('categorised', $show_excerpt, $excerpt_length, $number_of_posts, $category);
                            ?>
                        </div>
                    <?php endif; ?>
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
            $enable_categorised_tab = array(
                'true' => __('Yes', 'newsphere'),
                'false' => __('No', 'newsphere')

            );



            // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
            ?><h4><?php _e('Latest Posts', 'newsphere'); ?></h4><?php
            echo parent::newsphere_generate_text_input('newsphere-tabbed-latest-posts-title', __('Title', 'newsphere'), __('Latest', 'newsphere'));

            ?><h4><?php _e('Popular Posts', 'newsphere'); ?></h4><?php
            echo parent::newsphere_generate_text_input('newsphere-tabbed-popular-posts-title', __('Title', 'newsphere'), __('Popular', 'newsphere'));

            $categories = newsphere_get_terms();
            if (isset($categories) && !empty($categories)) {
                ?><h4><?php _e('Categorised Posts', 'newsphere'); ?></h4>
                <?php
                echo parent::newsphere_generate_select_options('newsphere-enable-categorised-tab', __('Enable Categorised Tab', 'newsphere'), $enable_categorised_tab);
                echo parent::newsphere_generate_text_input('newsphere-tabbed-categorised-posts-title', __('Title', 'newsphere'), __('Trending', 'newsphere'));
                echo parent::newsphere_generate_select_options('newsphere-select-category', __('Select category', 'newsphere'), $categories);

            }

        }
    }
endif;