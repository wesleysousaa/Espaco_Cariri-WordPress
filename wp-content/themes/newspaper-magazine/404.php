<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Newspaper_Magazine
 */

get_header(); ?>

	<!-- inner page start -->
	<section class="innerpage">
		<div class="container">
			<div class="row">
				<!-- Start inner page title -->
				<div class="col-md-12">
					<div class="innerpagetitle">
						<!-- Start BreadCrumb Section -->
						<?php
							/**
							* Hook - newspaper_magazine_breadcrumb.
							*
							* @hooked newspaper_magazine_breadcrumb _action- 10
							*/
							do_action( 'newspaper_magazine_breadcrumb' );		
						?>	
						<!-- End BreadCrumb Section -->
					</div>
				</div>
				<!-- End inner page title -->
				
				<!-- Start inner page News Section -->
				<div class="col-md-12">
					<div class="row innerpagenews">
						<!-- Start inner page News left Section -->
						<div class="col-xs-12 col-sm-12">
							<div class="innerpage_left">
								<div class="single_cat_news errorpage">
									<article class="error-404 not-found">
										<h4>
											<?php esc_html_e( 'Ooops... Error 404', 'newspaper-magazine' ); ?>
										</h4>
										<div class="page-content">
											<p>
												<?php esc_html_e( 'Sorry, but the page you are looking for doesn&rsquo;t exist.', 'newspaper-magazine' ); ?>
											</p>
											<p>
												<?php esc_html_e('You can go to', 'newspaper-magazine'); ?>
												<a href="<?php echo esc_url( home_url() ); ?>">
													<?php
														echo esc_html__( 'Home Page', 'newspaper-magazine' );
													?>
												</a>
											</p>
										</div><!-- .page-content -->
									</article><!-- .error-404 -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();
