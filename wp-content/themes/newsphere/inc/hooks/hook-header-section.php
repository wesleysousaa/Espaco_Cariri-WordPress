<?php
if (!function_exists('newsphere_header_section')) :
    /**
     * Banner Slider
     *
     * @since Newsphere 1.0.0
     *
     */
    function newsphere_header_section()
    {

        $header_layout = newsphere_get_option('header_layout');
        ?>

        <header id="masthead" class="header-style1 <?php echo esc_attr($header_layout); ?>">

            <?php

                newsphere_get_block('layout-1', 'header');

            ?>


            <div class="header-menu-part">
                <div id="main-navigation-bar" class="bottom-bar">
                    <div class="navigation-section-wrapper">
                        <div class="container-wrapper">
                            <div class="header-middle-part">
                                <div class="navigation-container">
                                    <nav class="main-navigation clearfix">
                                        <?php
                                        $global_show_home_menu = newsphere_get_option('global_show_home_menu');
                                        if($global_show_home_menu == 'yes'):
                                        ?>
                                        <span class="aft-home-icon">
                                        <?php $home_url = get_home_url(); ?>
                                            <a href="<?php echo esc_url($home_url); ?>">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                        <?php endif; ?>
                                        <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                        <span class="screen-reader-text">
                                            <?php esc_html_e('Primary Menu', 'newsphere'); ?>
                                        </span>
                                        <i class="ham"></i>
                                    </span>


                                        <?php
                                        $global_show_home_menu = newsphere_get_option('global_show_home_menu_border');

                                        wp_nav_menu(array(
                                            'theme_location' => 'aft-primary-nav',
                                            'menu_id' => 'primary-menu',
                                            'container' => 'div',
                                            'container_class' => 'menu main-menu menu-desktop '.$global_show_home_menu,
                                        ));
                                        ?>
                                    </nav>
                                </div>
                            </div>
                            <div class="header-right-part">

                                <?php
                                $aft_language_switcher = newsphere_get_option('aft_language_switcher');
                                if(!empty($aft_language_switcher)):
                                ?>
                                <div class="language-icon">
                                    <?php echo do_shortcode($aft_language_switcher); ?>
                                </div>
                                <?php endif; ?>
                                <div class="af-search-wrap">
                                    <div class="search-overlay">
                                        <a href="#" title="Search" class="search-icon">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <div class="af-search-form">
                                            <?php get_search_form(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('newsphere_action_header_section', 'newsphere_header_section', 40);