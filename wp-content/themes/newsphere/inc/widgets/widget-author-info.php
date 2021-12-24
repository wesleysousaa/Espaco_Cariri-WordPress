<?php
if (!class_exists('Newsphere_author_info')) :
    /**
     * Adds Newsphere_author_info widget.
     */
    class Newsphere_author_info extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsphere-author-info-title', 'newsphere-author-info-subtitle', 'newsphere-author-info-image', 'newsphere-author-info-name', 'newsphere-author-info-desc', 'newsphere-author-info-phone', 'newsphere-author-info-email');
            $this->url_fields = array('newsphere-author-info-facebook', 'newsphere-author-info-twitter', 'newsphere-author-info-linkedin', 'newsphere-author-info-instagram', 'newsphere-author-info-vk', 'newsphere-author-info-youtube');

            $widget_ops = array(
                'classname' => 'newsphere_author_info_widget',
                'description' => __('Displays author info.', 'newsphere'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsphere_author_info', __('AFTSC Author Info', 'newsphere'), $widget_ops);
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
            echo $args['before_widget'];
            $title = apply_filters('widget_title', $instance['newsphere-author-info-title'], $instance, $this->id_base);

            $profile_image = isset($instance['newsphere-author-info-image']) ? ($instance['newsphere-author-info-image']) : '';

            if ($profile_image) {
                $image_attributes = wp_get_attachment_image_src($profile_image, 'large');
                $image_src = $image_attributes[0];
                $image_class = 'data-bg data-bg-hover';

            } else {
                $image_src = '';
                $image_class = 'no-bg';
            }

            $name = isset($instance['newsphere-author-info-name']) ? ($instance['newsphere-author-info-name']) : '';

            $desc = isset($instance['newsphere-author-info-desc']) ? ($instance['newsphere-author-info-desc']) : '';
            $facebook = isset($instance['newsphere-author-info-facebook']) ? ($instance['newsphere-author-info-facebook']) : '';
            $twitter = isset($instance['newsphere-author-info-twitter']) ? ($instance['newsphere-author-info-twitter']) : '';
            $linkedin = isset($instance['newsphere-author-info-linkedin']) ? ($instance['newsphere-author-info-linkedin']) : '';
            $youtube = isset($instance['newsphere-author-info-youtube']) ? ($instance['newsphere-author-info-youtube']) : '';
            $instagram = isset($instance['newsphere-author-info-instagram']) ? ($instance['newsphere-author-info-instagram']) : '';
            $vk = isset($instance['newsphere-author-info-vk']) ? ($instance['newsphere-author-info-vk']) : '';

            ?>
            <section class="products">
                <div class="container-wrapper">
                    <?php if (!empty($title)): ?>
                        <div class="section-head">
                            <?php if (!empty($title)): ?>
                                <h4 class="widget-title section-title">
                                    <span class="header-after">
                                        <?php echo esc_html($title); ?>
                                    </span>
                                </h4>
                            <?php endif; ?>


                        </div>

                    <?php endif; ?>
                    <div class="posts-author-wrapper">

                        <?php if (!empty($image_src)) : ?>


                            <figure class="data-bg read-img pos-rel read-bg-img af-author-img <?php echo esc_attr($image_class); ?>"
                                    data-background="<?php echo esc_url($image_src); ?>">
                                <img src="<?php echo esc_attr($image_src); ?>" alt=""/>
                            </figure>

                        <?php endif; ?>
                        <div class="af-author-details">
                            <?php if (!empty($name)) : ?>
                                <h4 class="af-author-display-name"><?php echo esc_html($name); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($desc)) : ?>
                                <p class="af-author-display-name"><?php echo esc_html($desc); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($facebook) || !empty($twitter) || !empty($linkedin)) : ?>
                                <div class="social-navigation aft-small-social-menu">
                                    <ul>
                                        <?php if (!empty($facebook)) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($facebook); ?>" target="_blank"></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($youtube)) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($youtube); ?>" target="_blank"></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($twitter)) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($twitter); ?>" target="_blank"></a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            //print_pre($all_posts);
            // close the widget container
            echo $args['after_widget'];

            //$instance = parent::newsphere_sanitize_data( $instance, $instance );


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
                echo parent::newsphere_generate_text_input('newsphere-author-info-title', __('About Store', 'newsphere'), __('Title', 'newsphere'));

                echo parent::newsphere_generate_image_upload('newsphere-author-info-image', __('Profile image', 'newsphere'), __('Profile image', 'newsphere'));
                echo parent::newsphere_generate_text_input('newsphere-author-info-name', __('Name', 'newsphere'), __('Name', 'newsphere'));
                echo parent::newsphere_generate_text_input('newsphere-author-info-desc', __('Descriptions', 'newsphere'), '');
                echo parent::newsphere_generate_text_input('newsphere-author-info-facebook', __('Facebook', 'newsphere'), '');
                echo parent::newsphere_generate_text_input('newsphere-author-info-twitter', __('Twitter', 'newsphere'), '');
                echo parent::newsphere_generate_text_input('newsphere-author-info-youtube', __('Youtube', 'newsphere'), '');

            }
        }
    }
endif;