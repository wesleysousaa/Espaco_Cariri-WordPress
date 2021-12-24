<?php
class Glob_Message_Control extends WP_Customize_Control {
    public $settings = 'blogname';
    public $description = '';
    public $label = '';
    public $group = '';
    public $type = '';
    public $list = array();
    public $button = array();
    /**
     * Render the description and title for the sections
     */
    public function render_content() {
        switch ( $this->type ) {
            default:
            case 'heading':
                echo '<h4 class="customizer-mc-heading">' . $this->label . '</h4>';
                if ( $this->description != '' ) {
                    echo '<p class="customizer-mc-subheading">' . $this->description . '</p>';
                }
                break;
            case 'message':
                echo '<h4 class="customizer-mc-message">' . $this->label . '</h4>';
                if ( $this->description != '' ) {
                    echo '<p class="customizer-mc-message">' . $this->description . '</p>';
                }
                break;
            case 'list':
                echo '<div class="customizer-mc-list">';
                if ( $this->label ) {
                    echo '<h4 class="customizer-mc-message">' . $this->label . '</h4>';
                }
                if ( $this->description != '' ) {
                    echo '<p class="customizer-mc-message">' . $this->description . '</p>';
                }
                if ( is_array( $this->list ) && ! empty( $this->list ) ) {
                    echo '<ul class="customizer-mc-ul">';
                    foreach ( $this->list as $l ) {
                        echo '<li>' . wp_kses_post( $l ) . '</li>';
                    }
                    echo '</ul>';
                }
                if ( !empty( $this->button ) ) {
                    echo '<a href="'.esc_url( $this->button['link'] ).'" target="_blank" class="customizer-mc-btn">'.esc_html( $this->button['label'] ).'</a>';
                }
                echo '</div>';
                break;
            case 'hr' :
                echo '<hr />';
                break;
        }
    }
}

