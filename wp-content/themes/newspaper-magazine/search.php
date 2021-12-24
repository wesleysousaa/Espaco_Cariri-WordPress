<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
			<!-- End inner page title -->
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
						<h3 class="header_title">
		                    <a href="">
		                       	<?php 
								/* translators: used search keyword */
								printf( esc_html__( 'Search Results for: %s', 'newspaper-magazine' ), '<span>' . get_search_query() . '</span>' ); 
								?>
		                    </a>
		                </h3>
						<div class="innerpage_left">
							<?php
							if ( have_posts() ) : ?>
								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

								endwhile;

								get_template_part( 'template-parts/content', 'pagination' );

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif; ?>
						</div>
					</div>
					<!-- Start inner page News left Section -->

					<!-- Right Sidebar -->
				    <?php 
				        if ($sidebar == 'right' && is_active_sidebar( 'sidebar-7' ) ){ 
				            get_sidebar('right'); 
				        } 
				    ?> 
					<!-- End inner page News right Section -->
				</div>
			</div>
			<!-- End inner page News Section -->
		</div>
	</div>
</section>
<!-- inner page End -->
<?php
get_footer();
