<?php
/**
 * News Portal Mag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mystery Themes
 * @subpackage News Portal Mag
 * @since 1.0.0
 */

 /**
 * Set the theme version
 *
 * @global int $news_portal_mag_version
 * @since 1.0.0
 */
function news_portal_mag_theme_version() {
	$news_portal_mag_theme_info = wp_get_theme();
	$GLOBALS['news_portal_mag_version'] = $news_portal_mag_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'news_portal_mag_theme_version', 0 );


function news_portal_mag_customize_register( $wp_customize ){
    $wp_customize->remove_control('news_portal_theme_color');
    $wp_customize->remove_control('news_portal_site_title_color');
    
    $wp_customize->add_setting(
        'news_portal_mag_theme_color',
        array(
            'default'     => '#ba0108',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'news_portal_mag_theme_color',
            array(
                'label'      => __( 'Theme Color', 'news-portal-mag' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );

    /**
     * Title Color
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'news_portal_mag_site_title_color',
        array(
            'default'     => '#212121',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'news_portal_mag_site_title_color',
            array(
                'label'      => __( 'Header Text Color', 'news-portal-mag' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );
}
add_action( 'customize_register', 'news_portal_mag_customize_register', 99 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for News Portal.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_mag_fonts_url' ) ) :
    function news_portal_mag_fonts_url() {
        $fonts_url = '';
        $font_families = array();
        
        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Taviraj font: on or off', 'news-portal-mag' ) ) {
            $font_families[] = 'Taviraj:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
        }     

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function news_portal_mag_scripts() {
    global $news_portal_mag_version;

    wp_dequeue_style( 'news-portal-style' );
    wp_dequeue_style( 'news-portal-responsive-style' );

    wp_enqueue_style( 'news-portal-mag-fonts', news_portal_mag_fonts_url(), array(), null );
    wp_enqueue_style( 'news-portal-mag-parent-style', get_template_directory_uri().'/style.css', array(), esc_attr( $news_portal_mag_version ) );
    wp_enqueue_style( 'news-portal-mag-parent-responsive-style', get_template_directory_uri().'/assets/css/np-responsive.css', array(), esc_attr( $news_portal_mag_version ) );

    wp_enqueue_style( 'news-portal-mag-style', get_stylesheet_uri(), array(), esc_attr( $news_portal_mag_version ) );
}
add_action( 'wp_enqueue_scripts', 'news_portal_mag_scripts' );

add_action( 'wp_enqueue_scripts', 'news_portal_mag_dynamic_styles' );

if( ! function_exists( 'news_portal_mag_dynamic_styles' ) ) :
    function news_portal_mag_dynamic_styles() {

        $get_categories = get_categories( array( 'hide_empty' => 1 ) );
        $news_portal_mag_theme_color = get_theme_mod( 'news_portal_mag_theme_color', '#ba0108' );
        $news_portal_theme_hover_color = news_portal_hover_color( $news_portal_mag_theme_color, '-50' );

        $news_portal_site_title_option = get_theme_mod( 'news_portal_site_title_option', 'true' );        
        $news_portal_mag_site_title_color = get_theme_mod( 'news_portal_mag_site_title_color', '#212121' );

        $output_css = '';

        foreach( $get_categories as $category ){

            $cat_color = get_theme_mod( 'news_portal_category_color_'.strtolower( $category->slug ), '#00a9e0' );

            $cat_hover_color = news_portal_hover_color( $cat_color, '-50' );
            $cat_id = $category->term_id;
            
            if( !empty( $cat_color ) ) {
                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a { background: ". esc_attr( $cat_color ) ."}\n";

                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a:hover { background: ". esc_attr( $cat_hover_color ) ."}\n";

                $output_css .= ".np-block-title .np-cat-". esc_attr( $cat_id ) ." { color: ". esc_attr( $cat_color ) ."}\n";
            }
        }

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.widget_search .search-submit,.edit-link .post-edit-link,.reply .comment-reply-link,.np-top-header-wrap,.np-header-menu-wrapper,#site-navigation ul.sub-menu, #site-navigation ul.children,.np-header-menu-wrapper::before, .np-header-menu-wrapper::after,.np-header-search-wrapper .search-form-main .search-submit,.news_portal_slider .lSAction > a:hover,.news_portal_default_tabbed ul.widget-tabs li,.np-full-width-title-nav-wrap .carousel-nav-action .carousel-controls:hover,.news_portal_social_media .social-link a,.np-archive-more .np-button:hover,.error404 .page-title,#np-scrollup,.news_portal_featured_slider .slider-posts .lSAction > a:hover,div.wpforms-container-full .wpforms-form input[type='submit'], div.wpforms-container-full .wpforms-form button[type='submit'],div.wpforms-container-full .wpforms-form .wpforms-page-button,div.wpforms-container-full .wpforms-form input[type='submit']:hover, div.wpforms-container-full .wpforms-form button[type='submit']:hover,div.wpforms-container-full .wpforms-form .wpforms-page-button:hover { background: ". esc_attr( $news_portal_mag_theme_color ) ."}\n";

        $output_css .= ".home .np-home-icon a, .np-home-icon a:hover,#site-navigation ul li:hover > a, #site-navigation ul li.current-menu-item > a,#site-navigation ul li.current_page_item > a,#site-navigation ul li.current-menu-ancestor > a,.news_portal_default_tabbed ul.widget-tabs li.ui-tabs-active, .news_portal_default_tabbed ul.widget-tabs li:hover, .np-block-title-nav-wrap .carousel-nav-action .carousel-controls:hover { background: ". esc_attr( $news_portal_theme_hover_color ) ."}\n";

        $output_css .= ".np-header-menu-block-wrap::before, .np-header-menu-block-wrap::after { border-right-color: ". esc_attr( $news_portal_theme_hover_color ) ."}\n";

        $output_css .= "a,a:hover,a:focus,a:active,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.np-slide-content-wrap .post-title a:hover,#top-footer .widget a:hover,#top-footer .widget a:hover:before,#top-footer .widget li:hover:before,.news_portal_featured_posts .np-single-post .np-post-content .np-post-title a:hover,.news_portal_fullwidth_posts .np-single-post .np-post-title a:hover,.news_portal_block_posts .layout3 .np-primary-block-wrap .np-single-post .np-post-title a:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-title a:hover,.np-block-title,.widget-title,.page-header .page-title,.np-related-title,.np-post-meta span:hover,.np-post-meta span a:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span a:hover,.np-post-title.small-size a:hover,#footer-navigation ul li a:hover,.entry-title a:hover,.entry-meta span a:hover,.entry-meta span:hover,.np-post-meta span:hover, .np-post-meta span a:hover, .news_portal_featured_posts .np-single-post-wrap .np-post-content .np-post-meta span:hover, .news_portal_featured_posts .np-single-post-wrap .np-post-content .np-post-meta span a:hover,.news_portal_featured_slider .featured-posts .np-single-post .np-post-content .np-post-title a:hover, .news_portal_mag_fullwidth_posts .np-single-post .np-post-content .np-post-title a:hover, .news_portal_carousel .np-single-post .np-post-title a:hover, #site-navigation ul li a span{ color: ". esc_attr( $news_portal_mag_theme_color ) ."}\n";

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.np-archive-more .np-button:hover { border-color: ". esc_attr( $news_portal_mag_theme_color ) ."}\n";

        $output_css .= ".comment-list .comment-body,.np-header-search-wrapper .search-form-main { border-top-color: ". esc_attr( $news_portal_mag_theme_color ) ."}\n";
        
        $output_css .= ".np-header-search-wrapper .search-form-main:before { border-bottom-color: ". esc_attr( $news_portal_mag_theme_color ) ."}\n";

        $output_css .= "@media (max-width: 768px) { #site-navigation,.main-small-navigation li.current-menu-item > .sub-toggle i { background: ". esc_attr( $news_portal_mag_theme_color ) ." !important } }\n";

        if ( $news_portal_site_title_option == 'false' ) {
                $output_css .=".site-title, .site-description {
                            position: absolute;
                            clip: rect(1px, 1px, 1px, 1px);
                        }\n";
            } else {
                $output_css .=".site-title a, .site-description {
                            color:". esc_attr( $news_portal_mag_site_title_color ) .";
                        }\n";
            }

        $refine_output_css = news_portal_css_strip_whitespace( $output_css );

        wp_add_inline_style( 'news-portal-mag-style', $refine_output_css );
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * FullWidth Second Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_mag_fullwidth_section' ) ) :
    function news_portal_mag_fullwidth_section( $block_args, $np_block_column, $cats_list_option ) {      
        $block_query = new WP_Query( $block_args );
        if( $block_query->have_posts() ) {
            echo '<div class="np-clearfix np-fullwidth-grid-wrapper col-'. absint( $np_block_column ) .'">';
            while( $block_query->have_posts() ) {
                $block_query->the_post();
    ?>
                    <div class="np-single-posts-wrapper">
                        <div class="np-single-post">
                            <div class="np-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <figure><?php the_post_thumbnail( 'news-portal-slider-medium' ); ?></figure>
                                </a>
                            </div><!-- .np-post-thumb -->
                            <div class="np-post-content">
                                <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="np-post-meta">
                                    <?php news_portal_posted_on(); ?>
                                </div>
                                <div class="np-post-excerpt"><?php the_excerpt(); ?></div>
                            </div><!-- .np-post-content -->
                        </div><!-- .np-single-post -->
                    </div><!-- .np-single-posts-wrapper -->
    <?php
            }
            echo '</div><!-- .np-fullwidth-grid-wrapper -->';
        }
        wp_reset_postdata();
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register widgets
 *
 * @since 1.1.8
 */

add_action( 'widgets_init', 'news_portal_mag_register_widgets' );

function news_portal_mag_register_widgets() {
	
	// Fullwidth Posts Widget
	register_widget( 'News_Portal_Mag_FullWidth_Posts' );

}
/**
 * Load widgets files
 */
require get_stylesheet_directory() . '/widgets/fullwidth-posts.php';   // Default Tabbed widget