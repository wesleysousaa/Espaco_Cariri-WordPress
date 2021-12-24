<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

    /**
     * The footer widget area is triggered if any of the areas
     * have widgets. So let's check that first.
     *
     * If none of the sidebars have widgets, then let's bail early.
     */

    $news_portal_footer_widget_option = get_theme_mod( 'news_portal_footer_widget_option', 'show' );

    if( $news_portal_footer_widget_option == 'hide' ) {
        return;
    }

    if( !is_active_sidebar( 'news_portal_footer_sidebar' ) && !is_active_sidebar( 'news_portal_footer_sidebar-2' ) && !is_active_sidebar( 'news_portal_footer_sidebar-3' ) && !is_active_sidebar( 'news_portal_footer_sidebar-4' ) ) {
           return;
    }
    
    $news_portal_footer_layout = get_theme_mod( 'footer_widget_layout', 'column_three' );
?>

<div id="top-footer" class="footer-widgets-wrapper footer_<?php echo esc_attr( $news_portal_footer_layout ); ?> np-clearfix">
    <div class="mt-container">
        <div class="footer-widgets-area np-clearfix">
            <div class="np-footer-widget-wrapper np-column-wrapper np-clearfix">
                <div class="np-footer-widget wow fadeInLeft" data-wow-duration="0.5s">
                    <?php dynamic_sidebar( 'news_portal_footer_sidebar' ); ?>
                </div>
                <?php if( $news_portal_footer_layout != 'column_one' ){ ?>
                <div class="np-footer-widget wow fadeInLeft" data-woww-duration="1s">
                    <?php dynamic_sidebar( 'news_portal_footer_sidebar-2' ); ?>
                </div>
                <?php } ?>
                <?php if( $news_portal_footer_layout == 'column_three' || $news_portal_footer_layout == 'column_four' ){ ?>
                <div class="np-footer-widget wow fadeInLeft" data-wow-duration="1.5s">
                    <?php dynamic_sidebar( 'news_portal_footer_sidebar-3' ); ?>
                </div>
                <?php } ?>
                <?php if( $news_portal_footer_layout == 'column_four' ){ ?>
                <div class="np-footer-widget wow fadeInLeft" data-wow-duration="2s">
                    <?php dynamic_sidebar( 'news_portal_footer_sidebar-4' ); ?>
                </div>
                <?php } ?>
            </div><!-- .np-footer-widget-wrapper -->
        </div><!-- .footer-widgets-area -->
    </div><!-- .mt-container -->
</div><!-- .footer-widgets-wrapper -->