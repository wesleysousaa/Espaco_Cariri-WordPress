<?php
if ( ! function_exists( 'newsphere_front_page_widgets_section' ) ) :
    /**
     *
     * @since Newsphere 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function newsphere_front_page_widgets_section() {
        ?>
        <!-- Main Content section -->
        <?php

                $frontpage_layout = newsphere_get_option('frontpage_content_alignment');

        ?>
        <?php if ( is_active_sidebar( 'home-content-widgets') || is_active_sidebar( 'home-sidebar-widgets') ) {  ?>
            <section class="section-block-upper">


                    
                <div id="primary" class="content-area">

                    <main id="main" class="site-main">
                        <?php dynamic_sidebar('home-content-widgets'); ?>
                    </main>
                </div>

                <?php if (is_active_sidebar( 'home-sidebar-widgets') && $frontpage_layout != 'full-width-content' ) { ?>
                <?php 
                        $sticky_sidebar_class = '';
                        $sticky_sidebar = newsphere_get_option('frontpage_sticky_sidebar');
                        if($sticky_sidebar){
                         $sticky_sidebar_class = 'aft-sticky-sidebar';   
                        }
                    ?>
                <div id="secondary" class="sidebar-area <?php echo esc_attr($sticky_sidebar_class); ?>">
                    <div class="theiaStickySidebar">
                        <aside class="widget-area color-pad">
                        
                            <?php dynamic_sidebar('home-sidebar-widgets'); ?>
                        </aside>
                    </div>
                </div>
                <?php } ?>
                
            </section>
        <?php }
    }
endif;
add_action( 'newsphere_front_page_section', 'newsphere_front_page_widgets_section', 50 );