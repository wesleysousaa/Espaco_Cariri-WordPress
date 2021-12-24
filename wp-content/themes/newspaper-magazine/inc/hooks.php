<?php
/**
 * Load Hooks
 *
 * @package Newspaper_Magazine
 */

/******
	Doctype hook of the theme
******/
if ( ! function_exists( 'newspaper_magazine_doctype_action' ) ) :
    /**
     * Doctype declaration of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_doctype_action() {
    ?>
    <!DOCTYPE html> 
    <html <?php language_attributes(); ?>>
    <?php
    }
endif;

add_action( 'newspaper_magazine_doctype', 'newspaper_magazine_doctype_action', 10 );

/******
	Head hook of the theme
******/
if ( ! function_exists( 'newspaper_magazine_head_action' ) ) :
    /**
     * Header hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_head_action() {
    ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    <?php
    }
endif;

add_action( 'newspaper_magazine_head', 'newspaper_magazine_head_action', 10 );

if( ! function_exists( 'newspaper_magazine_head_menu_action' ) ) :
    /**
     * Main Menu hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_head_menu_action() {
    ?>
        <div class="col-xs-12 col-sm-11">
            <div class="menu clearfix">
                <div class="nav-wrapper"> 
                    <!-- for toogle menu -->
                    <div class="visible-xs visible-sm  clearfix"><span id="showbutton" class="clearfix"><img class="img-responsive grow" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/button.png' ); ?>" alt=""/></span></div>
                    <div class=""></div>
                                          
                    <nav class="col-md-12 im-hiding">
                        <div class="clearfix">
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <?php 
                            $defaults = array(
                                'theme_location'  => 'primary',
                                'container'       => '',
                                'menu_class'      => 'main-nav',
                                'menu_id'         => '',
                                'echo'            => true,
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'depth'           => 8,
                                'walker'          => '',
                                'fallback_cb'     => 'wp_page_menu'
                            );
                            wp_nav_menu( $defaults );
                        ?>
                        <?php else : ?>
                            <ul id="menu-primary" class="main-nav">
                                <li class="menu-item">
                                <a href="<?php echo admin_url( 'nav-menus.php' ); ?> "> <?php _e('Add a menu','newspaper-magazine'); ?></a>
                            </li>
                        </ul>

                        <?php endif; ?>
                        </div>    
                    </nav><!-- / main nav -->
                </div>
            </div>
        </div>
    <?php    
    }
endif;

add_action( 'newspaper_magazine_main_menu', 'newspaper_magazine_head_menu_action', 10 );

if( ! function_exists( 'newspaper_magazine_head_search_action' ) ) :
    /**
     * Header search hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_head_search_action() {
    ?>
        <?php 
            $search_disable= get_theme_mod('enable_searchbutton','1');
            if($search_disable==1):
        ?>
            <div class="col-xs-12 col-sm-1 hidden-xs">
                <div class="expSearchBox">
                    <a id="button" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <div id="item">
                        <div class="search_page">
                            <div class="search-page-search-wrap">
                                <?php
                                    get_search_form();
                                ?>                                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            endif;
        ?>
    <?php
    }
endif;

add_action( 'newspaper_magazine_head_search', 'newspaper_magazine_head_search_action', 10 );

if( ! function_exists( 'newspaper_magazine_trending_news_action' ) ) :
    /**
     * Trending news hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_trending_news_action() {
        if( is_front_page() ) :
    ?>
        <?php 
            if ( get_theme_mod( 'news_disable','1' ) ) : 
        ?>
        <div class="treanding_news">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-sm-4 col-md-3 col-xs-offset-2 col-sm-offset-0 col-md-offset-0">
                        <div class="treanding_title">
                            <?php 
                                if ( get_theme_mod( 'breaking_news_title','Breaking News' ) ) : 
                            ?>
                                <h5><?php echo esc_html( get_theme_mod( 'breaking_news_title','Breaking News' ) )?></h5>
                            <?php
                                endif; 
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <div class="trending_news">
                            <div id="owl-demo" class="owl-demo owl-carousel owl-theme">
                                <?php
                                    $breaking_news_catId = get_theme_mod( 'breaking_news_category' );
                                    $breaking_news_link = get_category_link( $breaking_news_catId );
                                    $breaking_news_cat_name = get_category( $breaking_news_catId );
                                    $args = array(
                                        'post_type' => 'post',
                                        'post_status' => 'publish',
                                        'paged' => 1,
                                        'cat' => $breaking_news_catId,
                                        'orderby' => 'ID',
                                        'order' => 'DESC'
                                    );
                                    $loop = new WP_Query($args);
                                    if ( $loop->have_posts() ) :
                                        while ($loop->have_posts()) : $loop->the_post(); 
                                    ?>
                                        <div class="item">
                                            <a href="<?php the_permalink(); ?>" title="" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>
                                    <?php 
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                ?>           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            endif;
        ?>
    <?php
        endif;
    }
endif;

add_action( 'newspaper_magazine_trending_news', 'newspaper_magazine_trending_news_action', 10 );

if( ! function_exists( 'newspaper_magazine_top_menu_action' ) ) :
    /**
     * Top Menu hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_top_menu_action() {
    ?>
        <div class="col-xs-12 col-sm-8 col-md-9">
            <div class="header_link">
                <?php
                    if( has_nav_menu( 'top-menu' ) ) :
                        wp_nav_menu( array(
                          'theme_location' => 'top-menu',
                        ) );
                    endif;
                ?>
            </div>
        </div>
    <?php
    }
endif;
add_action( 'newspaper_magazine_top_menu', 'newspaper_magazine_top_menu_action', 10 );

if( ! function_exists( 'newspaper_magazine_top_social_action' ) ) :
    /**
     * Top Social hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_top_social_action() {
    ?>
        <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="top_sociallink pull-right">
                <ul>
                    <?php if ( get_theme_mod( 'profile_facebook','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_facebook','#' ) ); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'profile_twitter','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_twitter','#' ) ); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'profile_instagram','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_instagram','#' ) ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                        
                    <?php if( get_theme_mod( 'profile_youtube','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_youtube','#' ) ); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'profile_linkedin','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_linkedin','#' ) ); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'profile_tumblr','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_tumblr','#' ) ); ?>" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php
    }
endif;
add_action( 'newspaper_magazine_top_social', 'newspaper_magazine_top_social_action', 10 );

if( ! function_exists( 'newspaper_magazine_logo_action' ) ) :
    /**
     * Logo hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_logo_action() {
    ?>
        <div class="col-sm-4 col-sm-offset-0">
            <div class="logo">
                <?php 
                    if( has_custom_logo() ) :
                        the_custom_logo();
                    else :
                ?>
                              
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </h1>
                    <h5 class="site-description">
                        <?php echo get_bloginfo( 'description' ); ?>
                    </h5>
               
                <?php
                    endif;
                ?>
            </div>
        </div>
    <?php
    }
endif;
add_action( 'newspaper_magazine_logo', 'newspaper_magazine_logo_action' );

if( ! function_exists( 'newspaper_magazine_header_ad_action' ) ) :
    /**
     *Header Advertisement Widget hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_header_ad_action() {
    ?>
        <div class="col-xs-12 col-sm-8">
            <div class="top_add pull-right">
                <?php
                    if( is_active_sidebar( 'sidebar-6' ) ) :
                        dynamic_sidebar( 'sidebar-6' );
                    endif;
                ?>
            </div>
        </div>
    <?php
    }
endif;
add_action( 'newspaper_magazine_header_ad', 'newspaper_magazine_header_ad_action', 10 );

if( ! function_exists( 'newspaper_magazine_breadcrumb_action' ) ) :
    /**
     * Breadcrumb hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_breadcrumb_action() {
        $breadcrumb_args = array(
            'show_browse' => true,
            'separator' => '&nbsp;',
            'post_taxonomy' => array(
                    'post' => 'category'
                    ),
            'labels' => array(
                'browse' => esc_html__( 'You are here:', 'newspaper-magazine' ),
                )                               
            );
        breadcrumb_trail( $breadcrumb_args );
    }
endif;
add_action( 'newspaper_magazine_breadcrumb', 'newspaper_magazine_breadcrumb_action', 10 );



if( ! function_exists( 'newspaper_magazine_footer_widgets_action' ) ) :
    /**
     * Footer Widgets hook of the theme.
     *
     * @since 1.0.0
     */
        function newspaper_magazine_footer_widgets_action() {
            if( is_active_sidebar( 'footer-sidebar' ) ) :
        ?>
            <footer>
                <div class="container">
                    <div class="row">
                        <?php
                            dynamic_sidebar( 'footer-sidebar' );                            
                        ?>
                    </div>
                </div>
            </footer>
        <?php 
            endif;   
        }
endif;
add_action( 'newspaper_magazine_footer_widgets', 'newspaper_magazine_footer_widgets_action', 10 );

if( ! function_exists( 'newspaper_magazine_footer_copyright_action' ) ) :
    /**
     * Copyright hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_footer_copyright_action() {
    ?>
        <div class="col-xs-12 col-md-8">
            <?php
                if( get_theme_mod( 'copyright_textbox', 'Copyright &copy; 2017, Your Company Name.' ) ) :
            ?>
                <div class="copyright">
                    <p>
                        <?php 
                            echo esc_html( get_theme_mod( 'copyright_textbox', '' ) );
                        ?>
                    </p>
                </div>
            <?php
                endif;
            ?>
        </div>
    <?php
    }
endif;
add_action( 'newspaper_magazine_footer_copyright', 'newspaper_magazine_footer_copyright_action', 10 );

if( ! function_exists( 'newspaper_magazine_footer_social_action' ) ) :
    /**
     * Social links hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_footer_social_action() {
    ?>
        <div class="col-xs-12 col-md-4">
            <div class="top_sociallink bottom-solcialinks pull-right">
                <ul>
                    <?php if ( get_theme_mod( 'profile_facebook','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_facebook','' ) ); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'profile_twitter','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_twitter','' ) ); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'profile_instagram','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_instagram','' ) ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                        
                    <?php if( get_theme_mod( 'profile_youtube','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_youtube','' ) ); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'profile_linkedin','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_linkedin','' ) ); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'profile_tumblr','' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_theme_mod( 'profile_tumblr','' ) ); ?>" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php
    }
endif;
add_action( 'newspaper_magazine_footer_social', 'newspaper_magazine_footer_social_action', 10 );


if( ! function_exists( 'newspaper_magazine_footer_scrolltotop_action' ) ) :
    /**
     * Scroll To Top hook of the theme.
     *
     * @since 1.0.0
     */
    function newspaper_magazine_footer_scrolltotop_action() {
        $scrolltotop_disable = get_theme_mod('enable_scrolltotop','1');
        if($scrolltotop_disable == 1):
        ?>
            <p class="totop" id="top" > 
                <i class="fa fa-angle-up fa-2x" aria-hidden="true"></i>
            </p>
        <?php
        endif;
    }
endif;
add_action( 'newspaper_magazine_footer_scrolltotop', 'newspaper_magazine_footer_scrolltotop_action', 10 );
?>