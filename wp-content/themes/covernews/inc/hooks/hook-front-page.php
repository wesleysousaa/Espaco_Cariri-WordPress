<?php
if ( ! function_exists( 'covernews_front_page_widgets_section' ) ) :
    /**
     *
     * @since CoverNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function covernews_front_page_widgets_section() {
        ?>
        <!-- Main Content section -->
        <?php

                $frontpage_layout = covernews_get_option('frontpage_content_alignment');

        ?>
        <?php if ( is_active_sidebar( 'home-content-widgets') || is_active_sidebar( 'home-sidebar-widgets') ) {  ?>
            <section class="section-block-upper">

                <div class="row">

                    
                <div id="primary" class="content-area">

                    <main id="main" class="site-main">
                        <?php dynamic_sidebar('home-content-widgets'); ?>
                    </main>
                </div>

                <?php if (is_active_sidebar( 'home-sidebar-widgets') && $frontpage_layout != 'full-width-content' ) { ?>
                    <?php 
                        $sticky_sidebar_class = '';
                        $sticky_sidebar = covernews_get_option('frontpage_sticky_sidebar');
                        if($sticky_sidebar){
                         $sticky_sidebar_class = 'aft-sticky-sidebar';   
                        }
                    ?>
                <div id="secondary" class="sidebar-area <?php echo esc_attr($sticky_sidebar_class); ?>">
                    <aside class="widget-area">
                        <div class="theiaStickySidebar">
                            <?php dynamic_sidebar('home-sidebar-widgets'); ?>
                        </div>
                    </aside>
                </div>
                <?php } ?>
                
                </div>
            </section>
        <?php }
    }
endif;
add_action( 'covernews_front_page_section', 'covernews_front_page_widgets_section', 50 );