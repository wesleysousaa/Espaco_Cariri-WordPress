<?php
/**
 * Custom hooks functions are define about header section.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Top header start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_top_header_start' ) ) :
	function news_portal_top_header_start() {
		echo '<div class="np-top-header-wrap">';
		echo '<div class="mt-container">';
	}
endif;

/**
 * Top header left section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_top_left_section' ) ) :
	function news_portal_top_left_section() {
		$news_portal_date_option = get_theme_mod( 'news_portal_top_date_option', 'show' );
?>
		<div class="np-top-left-section-wrapper">
			<?php
				if( $news_portal_date_option == 'show' ) {
					echo '<div class="date-section">'. esc_html( date_i18n('l, F d, Y') ) .'</div>';
				}
			?>

			<?php if ( has_nav_menu( 'news_portal_top_menu' ) ) { ?>
				<nav id="top-navigation" class="top-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'news_portal_top_menu', 'fallback_cb' => false, 'menu_id' => 'top-menu' ) );
					?>
				</nav><!-- #site-navigation -->
			<?php } ?>
		</div><!-- .np-top-left-section-wrapper -->
<?php
	}
endif;

/**
 * Top header right section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_top_right_section' ) ) :
	function news_portal_top_right_section() {
?>
		<div class="np-top-right-section-wrapper">
			<?php
				$news_portal_top_social_option = get_theme_mod( 'news_portal_top_social_option', 'show' );
				if( $news_portal_top_social_option == 'show' ) {
					news_portal_social_media();
				}
			?>
		</div><!-- .np-top-right-section-wrapper -->
<?php
	}
endif;

/**
 * Top header end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_top_header_end' ) ) :
	function news_portal_top_header_end() {
		echo '</div><!-- .mt-container -->';
		echo '</div><!-- .np-top-header-wrap -->';
	}
endif;

/**
 * Managed functions for top header hook
 *
 * @since 1.0.0
 */
add_action( 'news_portal_top_header', 'news_portal_top_header_start', 5 );
add_action( 'news_portal_top_header', 'news_portal_top_left_section', 10 );
add_action( 'news_portal_top_header', 'news_portal_top_right_section', 15 );
add_action( 'news_portal_top_header', 'news_portal_top_header_end', 20 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * header section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_header_section_start' ) ) :
	function news_portal_header_section_start() {
		echo '<header id="masthead" class="site-header" role="banner">';
	}
endif;

/**
 * header logo and ads section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_header_logo_ads_section_start' ) ) :
	function news_portal_header_logo_ads_section_start() {
		echo '<div class="np-logo-section-wrapper">';
		echo '<div class="mt-container">';
	}
endif;

/**
 * site branding section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_site_branding_section' ) ) :
	function news_portal_site_branding_section() {
?>
		<div class="site-branding">

			<?php if ( the_custom_logo() ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div><!-- .site-logo -->
			<?php } ?>

			<?php
			if ( is_front_page() || is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			
		</div><!-- .site-branding -->
<?php
	}
endif;

/**
 * header ads area
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_header_ads_section' ) ) :
	function news_portal_header_ads_section() {
?>
		<div class="np-header-ads-area">
			<?php
				if ( is_active_sidebar( 'news_portal_header_ads_area' ) ) {
					dynamic_sidebar( 'news_portal_header_ads_area' );
				}
			?>
		</div><!-- .np-header-ads-area -->
<?php
	}
endif;

/**
 * header logo and ads section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_header_logo_ads_section_end' ) ) :
	function news_portal_header_logo_ads_section_end() {
		echo '</div><!-- .mt-container -->';
		echo '</div><!-- .np-logo-section-wrapper -->';
	}
endif;

/**
 * header primary menu section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_primary_menu_section' ) ) :
	function news_portal_primary_menu_section() {
?>
		<div id="np-menu-wrap" class="np-header-menu-wrapper">
			<div class="np-header-menu-block-wrap">
				<div class="mt-container">
					<?php
						$news_portal_home_icon_option = get_theme_mod( 'news_portal_home_icon_option', 'show' );
						if( $news_portal_home_icon_option == 'show' ) {
					?>
							<div class="np-home-icon">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <i class="fa fa-home"> </i> </a>
							</div><!-- .np-home-icon -->
					<?php } ?>
                    <a href="javascript:void(0)" class="menu-toggle hide"> <i class="fa fa-navicon"> </i> </a>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'news_portal_primary_menu', 'menu_id' => 'primary-menu' ) );
						?>
					</nav><!-- #site-navigation -->

					<?php
						$news_portal_search_icon_option = get_theme_mod( 'news_portal_search_icon_option', 'show' );
						if( $news_portal_search_icon_option == 'show' ) {
					?>
						<div class="np-header-search-wrapper">                    
			                <span class="search-main"><i class="fa fa-search"></i></span>
			                <div class="search-form-main np-clearfix">
				                <?php get_search_form(); ?>
				            </div>
						</div><!-- .np-header-search-wrapper -->
					<?php } ?>
				</div>
			</div>
		</div><!-- .np-header-menu-wrapper -->
<?php
	}
endif;

/**
 * header section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_header_section_end' ) ) :
	function news_portal_header_section_end() {
		echo '</header><!-- .site-header -->';
	}
endif;

/**
 * Managed functions for ticker section
 *
 * @since 1.0.0
 */
add_action( 'news_portal_header_section', 'news_portal_header_section_start', 5 );
add_action( 'news_portal_header_section', 'news_portal_header_logo_ads_section_start', 10 );
add_action( 'news_portal_header_section', 'news_portal_site_branding_section', 15 );
add_action( 'news_portal_header_section', 'news_portal_header_ads_section', 20 );
add_action( 'news_portal_header_section', 'news_portal_header_logo_ads_section_end', 25 );
add_action( 'news_portal_header_section', 'news_portal_primary_menu_section', 30 );
add_action( 'news_portal_header_section', 'news_portal_header_section_end', 35 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Ticker section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_ticker_section_start' ) ) :
	function news_portal_ticker_section_start() {
		echo '<div class="np-ticker-wrapper">';
		echo '<div class="mt-container">';
		echo '<div class="np-ticker-block np-clearfix">';
	}
endif;

/**
 * Ticker content area
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_ticker_content' ) ) :
	function news_portal_ticker_content() {
		$news_portal_ticker_caption = get_theme_mod( 'news_portal_ticker_caption', __( 'Breaking News', 'news-portal' ) );
?>
		<span class="ticker-caption"><?php echo esc_html( $news_portal_ticker_caption ); ?></span>
		<div class="ticker-content-wrapper">
			<?php
				$news_portal_ticker_cat_id = apply_filters( 'news_portal_ticker_cat_id', null );
				$ticker_args = array(
						'cat' => $news_portal_ticker_cat_id,
						'posts_per_page' => '5'
					);
				$ticker_query = new WP_Query( $ticker_args );
				if( $ticker_query->have_posts() ) {
					echo '<ul id="newsTicker" class="cS-hidden">';
					while( $ticker_query->have_posts() ) {
						$ticker_query->the_post();
			?>			
						<li><div class="news-ticker-title"><?php news_portal_post_categories_list(); ?> <a href="<?php the_permalink(); ?>"><?php the_title();?></a></div></li>
			<?php
					}
					echo '</ul>';
				}
			?>
		</div><!-- .ticker-content-wrapper -->
<?php
	}
endif;

/**
 * Ticker section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'news_portal_ticker_section_end' ) ) :
	function news_portal_ticker_section_end() {
		echo '</div><!-- .np-ticker-block -->';
		echo '</div><!-- .mt-container -->';
		echo '</div><!-- .np-ticker-wrapper -->';
	}
endif;

/**
 * Managed functions for ticker section
 *
 * @since 1.0.0
 */
add_action( 'news_portal_ticker_section', 'news_portal_ticker_section_start', 5 );
add_action( 'news_portal_ticker_section', 'news_portal_ticker_content', 10 );
add_action( 'news_portal_ticker_section', 'news_portal_ticker_section_end', 15 );