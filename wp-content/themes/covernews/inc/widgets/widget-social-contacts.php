<?php
if (!class_exists('CoverNews_Social_Contacts')) :
/**
 * Adds CoverNews_Social_Contacts widget.
 */
class CoverNews_Social_Contacts extends AFthemes_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct()
    {
        $this->text_fields = array( 'covernews-social-contacts-title' );
        

        $widget_ops = array(
            'classname' => 'covernews_social_contacts_widget',
            'description' => __('Displays social contacts lists from selected settings.', 'covernews'),
            'customize_selective_refresh' => true,
        );

        parent::__construct('covernews_social_contacts', __('CoverNews Social Contacts', 'covernews'), $widget_ops );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */

    public function widget($args, $instance)
    {
        $instance = parent::covernews_sanitize_data( $instance, $instance );
        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters( 'widget_title', $instance['covernews-social-contacts-title'], $instance, $this->id_base );
        $title = isset($title) ? $title : __('CoverNews Social', 'covernews');


        // open the widget container
        echo $args['before_widget'];
        ?>
        <?php if (!empty($title)): ?>
        <div class="em-title-subtitle-wrap">
            <?php if (!empty($title)): ?>
                <h2 class="widget-title">
                    <span><?php echo esc_html($title); ?></span>
                </h2>
            <?php endif; ?>
        </div>
    <?php endif; ?>
        <?php
        if (!empty($social_note)) {
            echo "<p class='widget-description'>";
            echo esc_html($social_note);
            echo "</p>";
        } ?>
        <div class="social-widget-menu">
                <?php
                if ( has_nav_menu( 'aft-social-nav' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'aft-social-nav',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after'     => '</span>',
                    ) );
                } ?>
            </div>
            <?php if ( ! has_nav_menu( 'aft-social-nav' ) ) : ?>
            <p>
                <?php esc_html_e( 'Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'covernews' ); ?>
            </p>
        <?php endif;

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
    public function form($instance) {
        $this->form_instance = $instance;

            // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
            echo parent::covernews_generate_text_input( 'covernews-social-contacts-title', 'Title', 'CoverNews Social' );

    }




}
endif;