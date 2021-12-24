<?php
/*
*	Template Name: FrontPage
*
*/	
	get_header();
?>
      <?php
          if( is_active_sidebar( 'sidebar-2' ) ) :
              dynamic_sidebar( 'sidebar-2' );
          endif;  
      ?>
      <!-- Start Main Body Section -->

        <section class="mainbody clearfix">
          <div class="container">
            <div class="row">
            <?php
              $sidebar = get_theme_mod( 'theme_sidebar_position', 'right' );
              $class = 'col-md-12';
              if ( !empty ( $sidebar) && $sidebar != 'none') {
                $class = 'col-md-8';
              }
            ?>
            <!-- Left Sidebar -->
            <?php 
              if ($sidebar == 'left') { 
                  get_sidebar('right'); 
                } 
            ?>
              <!-- Start Left News Section -->
                <div class="<?php echo $class; ?>">
                  <div class="left_news">
                    <?php 
                      if( is_active_sidebar( 'sidebar-5' ) ):
                        dynamic_sidebar( 'sidebar-5' );
                      endif;
                    ?>
                  </div>
                </div>
              <!-- End Left News Section -->

              <!-- Right Sidebar -->
              <?php 
                if ($sidebar == 'right'){ 
                  get_sidebar('right'); 
                } 
              ?>
              

            </div>
          </div>
        </section>

      <!-- End Main Body Section -->

      <?php
        if( is_active_sidebar( 'sidebar-8' ) ) :
          dynamic_sidebar( 'sidebar-8' );
        endif;
      ?>
<?php
	get_footer();
?>