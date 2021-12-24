<?php
/**
 * List block part for displaying header content in page.php
 *
 * @package CoverNews
 */

?>
    <div class="header-layout-1">
        <?php
        if ((has_nav_menu('aft-top-nav')) || (has_nav_menu('aft-social-nav'))):
            ?>
            <div class="top-masthead">

                <div class="container">
                    <div class="row">
                        <?php
                        $show_date = covernews_get_option('show_date_section');

                        if (has_nav_menu('aft-top-nav') || ($show_date == true)): ?>
                            <div class="col-xs-12 col-sm-12 col-md-8 device-center">
                                <?php
                                if ($show_date == true): ?>
                                    <span class="topbar-date">
                                       <?php
                                       echo wp_kses_post(date_i18n(get_option('date_format')));
                                       ?>
                                    </span>

                                <?php endif; ?>

                                <?php if (has_nav_menu('aft-top-nav')) {

                                    wp_nav_menu(array(
                                        'theme_location' => 'aft-top-nav',
                                        'menu_id' => 'top-menu',
                                        'depth' => 1,
                                        'container' => 'div',
                                        'container_class' => 'top-navigation'
                                    ));
                                }

                                ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        $show_social_menu = covernews_get_option('show_social_menu_section');
                        if (has_nav_menu('aft-social-nav') && $show_social_menu == true): ?>
                            <div class="col-xs-12 col-sm-12 col-md-4 pull-right">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'aft-social-nav',
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'menu_id' => 'social-menu',
                                    'container' => 'div',
                                    'container_class' => 'social-navigation'
                                ));
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div> <!--    Topbar Ends-->
        <?php

        endif;


        ?>
        <header id="masthead" class="site-header">
            <?php
            $class = '';
            $background = '';
            if (has_header_image()) {
                $class = 'data-bg';
                $background = get_header_image();
            }

            ?>
            <div class="masthead-banner <?php echo esc_attr($class); ?>"
                 data-background="<?php echo esc_attr($background); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="site-branding">
                                <?php
                                the_custom_logo();
                                if (is_front_page() || is_home()) : ?>
                                    <h1 class="site-title font-family-1">
                                        <a href="<?php echo esc_url(home_url('/')); ?>"
                                           rel="home"><?php bloginfo('name'); ?></a>
                                    </h1>
                                <?php else : ?>
                                    <p class="site-title font-family-1">
                                        <a href="<?php echo esc_url(home_url('/')); ?>"
                                           rel="home"><?php bloginfo('name'); ?></a>
                                    </p>
                                <?php endif; ?>

                                <?php
                                $description = get_bloginfo('description', 'display');
                                if ($description || is_customize_preview()) : ?>
                                    <p class="site-description"><?php echo esc_html($description); ?></p>
                                <?php
                                endif; ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <?php
                            $advertisement_scope = covernews_get_option('banner_advertisement_scope');
                            if ($advertisement_scope == 'site-wide') {

                                do_action('covernews_action_banner_advertisement');
                            } else {

                                if (is_front_page() || is_home()) {
                                    do_action('covernews_action_banner_advertisement');
                                }


                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <nav id="site-navigation" class="main-navigation">
                <div class="container">
                    <div class="row">
                        <div class="kol-12">
                            <div class="navigation-container">



                                <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'covernews'); ?></span>
                                 <i class="ham"></i>
                        </span>
                                <span class="af-mobile-site-title-wrap">
                            <?php the_custom_logo(); ?>
                                    <p class="site-title font-family-1">
                                <a href="<?php echo esc_url(home_url('/')); ?>"
                                   rel="home"><?php bloginfo('name'); ?></a>
                            </p>
                        </span>
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'aft-primary-nav',
                                    'menu_id' => 'primary-menu',
                                    'container' => 'div',
                                    'container_class' => 'menu main-menu'
                                ));
                                ?>

                                <div class="cart-search">

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
            </nav>
        </header>
    </div>

<?php do_action('covernews_action_front_page_main_section');