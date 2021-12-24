<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspaper_Magazine
 */

?>
<?php
    /**
    * Hook - newspaper_magazine_footer_widgets.
    *
    * @hooked newspaper_magazine_footer_widgets_action - 10
    */
    do_action( 'newspaper_magazine_footer_widgets' );
?>
	   

     <section class="bottom-footer">
        <div class="container">
          <div class="row">
              <?php
                /**
                * Hook - newspaper_magazine_footer_copyright.
                *
                * @hooked newspaper_magazine_footer_copyright_action - 10
                */
                do_action( 'newspaper_magazine_footer_copyright' );
              ?>

              <?php
                /**
                * Hook - newspaper_magazine_footer_social.
                *
                * @hooked newspaper_magazine_footer_social_action - 10
                */
                do_action( 'newspaper_magazine_footer_social' );
              ?>

            </div>
          </div>
        </div>
     </section>
    <?php
      /**
       * Hook - newspaper_magazine_footer_scrolltotop.
       *
       * @hooked newspaper_magazine_footer_scrolltotop_action - 10
       */
      do_action( 'newspaper_magazine_footer_scrolltotop' );
    ?>

<?php wp_footer(); ?>

</body>
</html>
