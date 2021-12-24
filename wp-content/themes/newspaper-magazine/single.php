<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Newspaper_Magazine
 */

get_header(); ?>
	<!-- inner page start -->
	<section class="innerpage">
		<div class="container">
			<div class="row">
				<!-- Start inner page title -->
				<div class="col-md-12 hidden-xs">
					<div class="innerpagetitle">
						<?php
							/**
							* Hook - newspaper_magazine_breadcrumb.
							*
							* @hooked newspaper_magazine_breadcrumb _action- 10
							*/
							do_action( 'newspaper_magazine_breadcrumb' );		
						?>	
					</div>
				</div>
				<!-- Start inner page News Section -->
				<div class="col-md-12">
					<div class="row innerpagenews">
						<?php
				            $sidebar = get_theme_mod( 'theme_sidebar_position', 'right' );
				            $class = 'col-md-12';
				            if ( $sidebar != 'none' && is_active_sidebar( 'sidebar-7' ) ) {
				       		    $class = 'col-md-8';
				            }
				        ?>
				        <!-- Left Sidebar -->
				        <?php 
				            if ($sidebar == 'left' && is_active_sidebar( 'sidebar-7' ) ) { 
				                get_sidebar('right'); 
				            } 
				        ?>
						<!-- Start inner page News left Section -->
						<div class="<?php echo $class; ?>">
							<div class="innerpage_left">
								<div class="single_cat_news single_post_detail">
								<?php
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/content', 'single' );

									the_post_navigation();

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop.
								?>
								</div>
							</div>
						</div>
						<!-- Right Sidebar -->
				        <?php 
				            if ($sidebar == 'right' && is_active_sidebar( 'sidebar-7' ) ){ 
				                get_sidebar('right'); 
				            } 
				        ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php
get_footer();
