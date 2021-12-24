<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CoverNews
 */

?>


</div>

<?php do_action('covernews_action_full_width_upper_footer_section'); ?>

<footer class="site-footer">
    <?php $covernews_footer_widgets_number = covernews_get_option('number_of_footer_widget');
        if (1 == $covernews_footer_widgets_number) {
            $col = 'col-md-12';
        } elseif (2 == $covernews_footer_widgets_number) {
            $col = 'col-md-6';
        } elseif (3 == $covernews_footer_widgets_number) {
            $col = 'col-md-4';
        } else {
            $col = 'col-md-4';
        } ?>
    <?php if (is_active_sidebar( 'footer-first-widgets-section') || is_active_sidebar( 'footer-second-widgets-section') || is_active_sidebar( 'footer-third-widgets-section') || is_active_sidebar( 'footer-fourth-widgets-section')) : ?>
    <div class="primary-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                            <?php if (is_active_sidebar( 'footer-first-widgets-section') ) : ?>
                                <div class="primary-footer-area footer-first-widgets-section <?php echo esc_attr($col); ?> col-sm-12">
                                    <section class="widget-area">
                                            <?php dynamic_sidebar('footer-first-widgets-section'); ?>
                                    </section>
                                </div>
                            <?php endif; ?>

                        <?php if (is_active_sidebar( 'footer-second-widgets-section') ) : ?>
                            <div class="primary-footer-area footer-second-widgets-section <?php echo esc_attr($col); ?>  col-sm-12">
                                <section class="widget-area">
                                    <?php dynamic_sidebar('footer-second-widgets-section'); ?>
                                </section>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar( 'footer-third-widgets-section') ) : ?>
                            <div class="primary-footer-area footer-third-widgets-section <?php echo esc_attr($col); ?>  col-sm-12">
                                <section class="widget-area">
                                    <?php dynamic_sidebar('footer-third-widgets-section'); ?>
                                </section>
                            </div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar( 'footer-fourth-widgets-section') ) : ?>
                            <div class="primary-footer-area footer-fourth-widgets-section <?php echo esc_attr($col); ?>  col-sm-12">
                                <section class="widget-area">
                                    <?php dynamic_sidebar('footer-fourth-widgets-section'); ?>
                                </section>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(1 != covernews_get_option('hide_footer_menu_section')): ?>
    <?php if (has_nav_menu( 'aft-footer-nav' ) || has_nav_menu( 'aft-social-nav' )):
        $class = 'col-sm-12';
        if (has_nav_menu( 'aft-footer-nav' ) && has_nav_menu( 'aft-social-nav' )){
            $class = 'col-sm-6';
        }

        ?>
    <div class="secondary-footer">
        <div class="container">
            <div class="row">
                <?php if (has_nav_menu( 'aft-footer-nav' )): ?>
                    <div class="<?php echo esc_attr($class); ?>">
                        <div class="footer-nav-wrapper">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'aft-footer-nav',
                            'menu_id' => 'footer-menu',
                            'depth' => 1,
                            'container' => 'div',
                            'container_class' => 'footer-navigation'
                        )); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php if (has_nav_menu( 'aft-social-nav' )): ?>
                    <div class="<?php echo esc_attr($class); ?>">
                        <div class="footer-social-wrapper">
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
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    <div class="site-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php $covernews_copy_right = covernews_get_option('footer_copyright_text'); ?>
                    <?php if (!empty($covernews_copy_right)): ?>
                        <?php echo esc_html($covernews_copy_right); ?>
                    <?php endif; ?>
                    <?php $covernews_theme_credits = covernews_get_option('hide_footer_copyright_credits'); ?>
                    <?php if ($covernews_theme_credits != 1): ?>
                        <span class="sep"> | </span>
                        <?php
                        /* translators: 1: Theme name, 2: Theme author. */
                        printf(esc_html__('%1$s by %2$s.', 'covernews'), '<a href="https://afthemes.com/products/covernews/">CoverNews</a>', 'AF themes');
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<a id="scroll-up" class="secondary-color">
    <i class="fa fa-angle-up"></i>
</a>
<?php wp_footer(); ?>

</body>
</html>
