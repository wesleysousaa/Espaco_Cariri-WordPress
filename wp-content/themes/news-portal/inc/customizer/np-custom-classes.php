<?php
/**
 * Define customizer custom classes
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

if( class_exists( 'WP_Customize_Control' ) ) {

	class News_Portal_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 1.0.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'news-portal' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                $this->label,
                $this->description,
                $dropdown
            );
        }
    } // end News_Portal_Customize_Category_Control

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Switch button customize control.
     *
     * @since 1.0.3
     * @access public
     */
    class News_Portal_Customize_Switch_Control extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'switch';

        /**
         * Displays the control content.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function render_content() {
    ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
                <div class="switch_options">
                    <?php 
                        $show_choices = $this->choices;
                        foreach ( $show_choices as $key => $value ) {
                            echo '<span class="switch_part '. esc_attr( $key ) .'" data-switch="'. esc_attr( $key ) .'">'. esc_html( $value ) .'</span>';
                        }
                    ?>
                    <input type="hidden" id="mt_switch_option" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
                </div>
            </label>
    <?php
        }
    } // end News_Portal_Customize_Switch_Control

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Radio image customize control.
     *
     * @since  1.0.0
     * @access public
     */
    class News_Portal_Customize_Control_Radio_Image extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'radio-image';

        /**
         * Loads the jQuery UI Button script and custom scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // We need to make sure we have the correct image URL.
            foreach ( $this->choices as $value => $args )
                $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
        }


        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */

        public function content_template() { ?>
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="buttonset">

                <# for ( key in data.choices ) { #>

                    <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

                    <label for="{{ data.id }}-{{ key }}">
                        <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
                        <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
                    </label>
                <# } #>

            </div><!-- .buttonset -->
        <?php }
    } // end News_Portal_Customize_Control_Radio_Image
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Customize controls for repeater field
     *
     * @since 1.0.0
     */
    class News_Portal_Repeater_Controler extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';

        public $news_portal_box_label = '';

        public $news_portal_box_add_control = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct( $manager, $id, $args = array(), $fields = array() ) {
            $this->fields = $fields;
            $this->news_portal_box_label = $args['news_portal_box_label'] ;
            $this->news_portal_box_add_control = $args['news_portal_box_add_control'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {

            $values = json_decode( $this->value() );
        ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php if( $this->description ){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <ul class="np-repeater-field-control-wrap">
                <?php $this->news_portal_get_fields(); ?>
            </ul>

            <input type="hidden" <?php esc_attr( $this->link() ); ?> class="np-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
            <button type="button" class="button np-repeater-add-control-field"><?php echo esc_html( $this->news_portal_box_add_control ); ?></button>
    <?php
        }

        private function news_portal_get_fields(){
            $fields = $this->fields;
            $values = json_decode( $this->value() );

            if( is_array( $values ) ){
            foreach( $values as $value ){
        ?>
            <li class="np-repeater-field-control">
            <h3 class="np-repeater-field-title"><?php echo esc_html( $this->news_portal_box_label ); ?></h3>
            
            <div class="np-repeater-fields">
            <?php
                foreach ( $fields as $key => $field ) {
                $class = isset( $field['class'] ) ? $field['class'] : '';
            ?>
                <div class="np-repeater-field np-repeater-type-<?php echo esc_attr( $field['type'] ).' '. esc_attr( $class ); ?>">

                <?php 
                    $label = isset( $field['label'] ) ? $field['label'] : '';
                    $description = isset( $field['description'] ) ? $field['description'] : '';
                    if( $field['type'] != 'checkbox' ) { 
                ?>
                        <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                <?php 
                    }

                    $new_value = isset( $value->$key ) ? $value->$key : '';
                    $default = isset( $field['default'] ) ? $field['default'] : '';

                    switch ( $field['type'] ) {
                        case 'text':
                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_attr( $new_value ).'"/>';
                            break;

                        case 'url':
                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_url( $new_value ).'"/>';
                            break;

                        case 'social_icon':
                            echo '<div class="np-repeater-selected-icon">';
                            echo '<i class="'.esc_attr( $new_value ).'"></i>';
                            echo '<span><i class="fa fa-angle-down"></i></span>';
                            echo '</div>';
                            echo '<ul class="np-repeater-icon-list np-clearfix">';
                            $news_portal_font_awesome_social_icon_array = news_portal_font_awesome_social_icon_array();
                            foreach ( $news_portal_font_awesome_social_icon_array as $news_portal_font_awesome_icon ) {
                                $icon_class = $new_value == $news_portal_font_awesome_icon ? 'icon-active' : '';
                                echo '<li class='. esc_attr( $icon_class ) .'><i class="'. esc_attr( $news_portal_font_awesome_icon ) .'"></i></li>';
                            }
                            echo '</ul>';
                            echo '<input data-default="'.esc_attr( $default ).'" type="hidden" value="'.esc_attr( $new_value ).'" data-name="'.esc_attr($key).'"/>';
                            break;

                        default:
                            break;
                    }
                ?>
                </div>
                <?php
                } ?>

                <div class="np-clearfix np-repeater-footer">
                    <div class="alignright">
                    <a class="np-repeater-field-remove" href="#remove"><?php esc_html_e( 'Delete', 'news-portal' ) ?></a> |
                    <a class="np-repeater-field-close" href="#close"><?php esc_html_e( 'Close', 'news-portal' ) ?></a>
                    </div>
                </div>
            </div>
            </li>
            <?php   
            }
            }
        }
    } // end News_Portal_Repeater_Controler

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Theme Info Content
     *
     * @since 1.1.0
     */
    class News_Portal_Info_Content extends WP_Customize_Control {
        public $type = 'mt-info';
        public function render_content() {
    ?>            
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="description customize-control-description"><?php echo wp_kses_post($this->description); ?></div>
    <?php
        }
    }// end News_Portal_Info_Content

} //end WP_Customize_Control

if( class_exists( 'WP_Customize_Section' ) ) {

/*-----------------------------------------------------------------------------------------------------------------------*/
    
    /**
     * Upsell customizer section.
     *
     * @since  1.0.6
     * @access public
     */
    class News_Portal_Customize_Section_Upsell extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'upsell';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="accordion-section-title">
                    {{ data.title }}

                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }// end News_Portal_Customize_Section_Upsell

} //end WP_Customize_Section