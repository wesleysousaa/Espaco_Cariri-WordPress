<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sp_magazinely
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="navigation-wrapper">
		
		<div class="site grid-container">
			<header id="masthead" class="site-header grid-x grid-padding-x">
				<div class="large-12 medium-12 small-12 cell">
					<div class="top-header-wrapper">
						<div class="site-branding header-left-logo">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) :
								?>
							<div class="logo-container">
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
								else :
									?>
								<div class="logo-container">
									<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
									<?php
									endif;
									$sp_magazinely_description = get_bloginfo( 'description', 'display' );
									if ( $sp_magazinely_description || is_customize_preview() ) :
										?>
									<p class="site-description"><?php echo $sp_magazinely_description; /* WPCS: xss ok. */ ?></p>
								<?php endif; ?>
							</div>	
						</div>

						<div class="header-right-widget-area">
							<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
							<?php dynamic_sidebar( 'header-widget' ); ?>				
						<?php endif; ?>
					</div>
				</div>
			</div>


		</header><!-- #masthead -->
	</div>
</div>

<div class="navigation-outer-wrapper">
	<div class="grid-container">
		<nav id="site-navigation" class="main-navigation large-12 medium-12 small-12 cell">

			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				) );
				?>
			</nav>
		</div>
	</div>



	<?php if ( get_header_image() ) : ?>
	<?php if ( is_front_page() ) : ?>

	<div class="content-wrap">
		<div class="bottom-header-wrapper">
			<img src="<?php echo esc_url(( get_header_image()) ); ?>" alt="<?php echo esc_attr(( get_bloginfo( 'title' )) ); ?>" />
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>


<div id="page" class="site grid-container start-container-head">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'magazinely' ); ?></a>
	<div id="content" class="site-content grid-x grid-padding-x">