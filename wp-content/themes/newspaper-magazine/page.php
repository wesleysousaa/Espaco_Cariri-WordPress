<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newspaper_Magazine
 */

get_header(); ?>

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
						<!-- Start inner page News left Section -->
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
						<div class="<?php echo $class; ?>">
							<h3 class="header_title">
		                        <a href="">
		                           	<i class="fa fa-list" aria-hidden="true"></i> 
		                           	<span><?php the_title();?></span>
		                        </a>
		                    </h3>
							<div class="innerpage_left single-page-content">
								<div class="single_cat_news">
								<?php
									while ( have_posts() ) : the_post();

										get_template_part( 'template-parts/content', 'page' );

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
