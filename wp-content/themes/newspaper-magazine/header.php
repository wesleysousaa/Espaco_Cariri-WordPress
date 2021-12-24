<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspaper_Magazine
 */

?>
<?php
  /**
   * Hook - newspaper_magazine_doctype.
   *
   * @hooked newspaper_magazine_doctype_action - 10
   */
  do_action( 'newspaper_magazine_doctype' );
?>
<head>
<?php
  /**
   * Hook - newspaper_magazine_head.
   *
   * @hooked newspaper_magazine_head_action - 10
   */
  do_action( 'newspaper_magazine_head' );
?>
</head>
<body <?php body_class(); ?>>
	<!-- Start  Header Section -->
        <?php
          if( has_header_image() ) :
        ?>
        <header style="background-image: url(<?php header_image(); ?>)">
        <?php
          else:
        ?>
        <header>
        <?php
          endif;
        ?>
           <!-- Start Top Header Section -->
          <div class="top_header headerbackground clearfix">   <!-- class headerbackground is used for Background for top header and menu -->
            <div class="container">
              <div class="row">
                <?php
                  /**
                   * Hook - newspaper_magazine_top_menu.
                   *
                   * @hooked newspaper_magazine_top_menu_action - 10
                   */
                  do_action( 'newspaper_magazine_top_menu' );
                ?>
                <?php
                  /**
                   * Hook - newspaper_magazine_top_social.
                   *
                   * @hooked newspaper_magazine_top_social_action - 10
                   */
                  do_action( 'newspaper_magazine_top_social' );
                ?>              
              </div>
            </div>
          </div>
          <!-- End Top Header Section -->
          <!-- Start Middle Header Section -->
          <div class="middle_header">
              <div class="container">
                  <div class="row clearfix">
                    <?php
                      /**
                       * Hook - newspaper_magazine_logo.
                       *
                       * @hooked newspaper_magazine_logo_action - 10
                      */
                      do_action( 'newspaper_magazine_logo' );
                    ?>

                    <?php
                      /**
                       * Hook - newspaper_magazine_header_ad.
                       *
                       * @hooked newspaper_magazine_header_ad_action - 10
                      */
                      do_action( 'newspaper_magazine_header_ad' );
                    ?>
                    
                  </div>
              </div>
          </div>
          <!-- End Middle Header Section -->

          <!-- Start Menu Section -->

              <div class="menu_search headerbackground">
                <div class="container">
                  <div class="row">
                    <?php
                      /**
                       * Hook - newspaper_magazine_main_menu.
                       *
                       * @hooked newspaper_magazine_main_menu_action - 10
                       */
                      do_action( 'newspaper_magazine_main_menu' );
                    ?>
                    <?php
                      /**
                       * Hook - newspaper_magazine_head_search.
                       *
                       * @hooked newspaper_magazine_head_search_action - 10
                       */
                      do_action( 'newspaper_magazine_head_search' );
                    ?>
                    
                  </div>
                </div>
              </div>

          <!-- End Menu Section -->
          <!-- Start Treanding  News Section -->
          <?php if(is_front_page() ) : ?>
            <?php
              /**
               * Hook - newspaper_magazine_trending_news.
               *
               * @hooked newspaper_magazine_trending_news_action - 10
              */
              do_action( 'newspaper_magazine_trending_news' );
            ?>
          <?php endif; ?>

          <!-- End Treanding News Section -->

          
          
        </header>

      <!-- End  Header Section -->
