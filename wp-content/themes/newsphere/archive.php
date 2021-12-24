<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newsphere
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

			<?php
			if ( have_posts() ) : ?>

                <header class="header-title-wrapper1">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
                </header><!-- .header-title-wrapper -->
				<?php
				//div wrap start
				do_action('newsphere_archive_layout_before_loop');


					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */

						get_template_part( 'template-parts/content', get_post_format() );


					endwhile;

				//div wrap end
                do_action('newsphere_archive_layout_after_loop');


			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

            <div class="col col-ten">
                <div class="newsphere-pagination">
					<?php newsphere_numeric_pagination(); ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
?>
<?php
get_footer();
