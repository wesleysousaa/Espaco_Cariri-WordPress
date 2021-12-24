<?php
/**
 * Template Name: Home Widget Builder
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glob
 */
get_header(); ?>
<div class="hero_1_box hero_top">
	<div class="container">
		<?php if ( is_active_sidebar( 'hero-top' ) ) { ?>
		<div class="home-sidebar home-hero">
			<?php dynamic_sidebar( 'hero-top' ); ?>
		</div>
		<?php } ?>
	</div>
</div>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="featured-posts">
                <?php if ( is_active_sidebar( 'home-1' ) ) { ?>
					<div class="home-sidebar home-sidebar-1">
						<?php dynamic_sidebar( 'home-1' ); ?>
					</div>
				<?php } ?>
				<div class="widget-inner">
					<?php if ( is_active_sidebar( 'home-2' ) ) { ?>
						<div class="home-sidebar home-sidebar-2">
							<?php dynamic_sidebar( 'home-2' ); ?>
						</div>
					<?php } ?>
					<?php if ( is_active_sidebar( 'home-3' ) ) { ?>
						<div class="home-sidebar home-sidebar-3">
							<?php dynamic_sidebar( 'home-3' ); ?>
						</div>
					<?php } ?>
				</div>
				<?php if ( is_active_sidebar( 'home-4' ) ) { ?>
					<div class="home-sidebar home-sidebar-4">
						<?php dynamic_sidebar( 'home-4' ); ?>
					</div>
				<?php } ?>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
	<?php ?>
</div>
<?php
get_footer();
