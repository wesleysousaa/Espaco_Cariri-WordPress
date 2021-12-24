<?php
/**
 * Magazinely Theme Customizer
 *
 * @package sp_magazinely
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sp_magazinely_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control( 'header_textcolor'  )->section   = 'customize_navigation';
	$wp_customize->get_section('title_tagline')->title = __( 'Navigation & Header Settings', 'magazinely' );
	$wp_customize->get_section('background_image')->title = __( 'Post & Page Settings', 'magazinely' );
	$wp_customize->get_section( 'background_image' )->priority  = 20;

 
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'sp_magazinely_customize_partial_blogname',
			) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'sp_magazinely_customize_partial_blogdescription',
			) );
	}


	/* Customize Navigation */
	
	$wp_customize->add_setting( 'display_navigation_tagline', array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'display_navigation_tagline', array(
		'label'    => __( 'Show Site Tagline', 'magazinely' ),
		'section'  => 'title_tagline',
		'priority' => 30,
		'settings' => 'display_navigation_tagline',
		'type'     => 'checkbox',
		) );


	/* Featured Posts Header Section Settings */
	$wp_customize->add_section( 'featured_posts_header', array(
		'title'      => __('Featured Posts Settings','magazinely'),
		'description'      => __('To make the featured posts section show up on your blog feed, you will have to add Sticky Posts, they will automatically be shown.','magazinely'),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
		) );

	$wp_customize->add_setting('featured_posts_toggle', 
		array(
			'sanitize_callback' => 'sanitize_text_field', 
			'default' => 'gridone'
			));
	$wp_customize->add_control( 'featured_posts_toggle', array(
		'section'               => 'featured_posts_header',
		'label'                 => __( 'Show Featured Posts On', 'magazinely' ),
		'type'                  => 'radio',
		'priority'              => 1,
		'choices'               => array(
			'gridone'           => __('Grid 1 (4 Featured Posts)', 'magazinely'),
			'gridtwo'            => __('Grid 2 (5 Featured Posts)', 'magazinely'),
			),
		));

	$wp_customize->add_setting( 'featured_posts_categories_hide', array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'featured_posts_categories_hide', array(
		'label'    => __( 'Hide Categories', 'magazinely' ),
		'section'  => 'featured_posts_header',
		'priority' => 9999,
		'settings' => 'featured_posts_categories_hide',
		'type'     => 'checkbox',
		) );



	/* Posts And Pages Settings */
	$wp_customize->add_setting( 'hide_featured_image', array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'hide_featured_image', array(
		'label'    => __( 'Hide Featured Image', 'magazinely' ),
		'description'    => __( 'This will hide featured images from all single posts. It will not effect the blog feed.', 'magazinely' ),
		'section'  => 'background_image',
		'priority' => 1,
		'settings' => 'hide_featured_image',
		'type'     => 'checkbox',
		) );

	$wp_customize->add_setting( 'hide_about_the_author_section', array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'hide_about_the_author_section', array(
		'label'    => __( 'Hide About The Author Section', 'magazinely' ),
		'description'    => __( 'Enabling this will hide the About The Author section on all blog posts.', 'magazinely' ),
		'section'  => 'background_image',
		'priority' => 1,
		'settings' => 'hide_about_the_author_section',
		'type'     => 'checkbox',
		) );

}
add_action( 'customize_register', 'sp_magazinely_customize_register' );



if(! function_exists('sp_magazinely_customize_register_output' ) ):
	function sp_magazinely_customize_register_output(){
		?>

		<style type="text/css">
		/* Navigation */
		.main-navigation a, #site-navigation span.dashicons.dashicons-menu:before, .iot-menu-left-ul a { color: <?php echo esc_attr(get_theme_mod( 'navigation_link_color')); ?>; }
		.navigation-wrapper{ background: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
		.main-navigation ul ul, #iot-menu-left, .navigation-outer-wrapper { background: <?php echo esc_attr(get_theme_mod( 'bottom_navigation_background_color')); ?>; }
		<?php if ( get_theme_mod( 'hide_navigation' ) == '1' ) : ?>
		.navigation-outer-wrapper {display: none;}
		<?php endif; ?>
		<?php if ( get_theme_mod( 'display_navigation_tagline' ) == '1' ) : ?>
		.site-description {display:block;}
		<?php endif; ?>


	/* Featured Image Header */
		<?php if ( get_theme_mod( 'featured_posts_categories_hide' ) == '1' ) : ?>
		.categories-featured-posts {display:none;}
		<?php endif; ?>



		/* Global */
		.single .content-area a, .page .content-area a { color: <?php echo esc_attr(get_theme_mod( 'global_link')); ?>; }
		.page .content-area a.button, .single .page .content-area a.button {color:#fff;}
		a.button,a.button:hover,a.button:active,a.button:focus, button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo esc_attr(get_theme_mod( 'global_link')); ?>; }
		.tags-links a, .cat-links a{ border-color: <?php echo esc_attr(get_theme_mod( 'global_link')); ?>; }
		.single main article .entry-meta *, .single main article .entry-meta, .archive main article .entry-meta *, .comments-area .comment-metadata time{ color: <?php echo esc_attr(get_theme_mod( 'global_byline')); ?>; }
		.single .content-area h1, .single .content-area h2, .single .content-area h3, .single .content-area h4, .single .content-area h5, .single .content-area h6, .page .content-area h1, .page .content-area h2, .page .content-area h3, .page .content-area h4, .page .content-area h5, .page .content-area h6, .page .content-area th, .single .content-area th, .blog.related-posts main article h4 a, .single b.fn, .page b.fn, .error404 h1, .search-results h1.page-title, .search-no-results h1.page-title, .archive h1.page-title{ color: <?php echo esc_attr(get_theme_mod( 'global_headline')); ?>; }
		.comment-respond p.comment-notes, .comment-respond label, .page .site-content .entry-content cite, .comment-content *, .about-the-author, .page code, .page kbd, .page tt, .page var, .page .site-content .entry-content, .page .site-content .entry-content p, .page .site-content .entry-content li, .page .site-content .entry-content div, .comment-respond p.comment-notes, .comment-respond label, .single .site-content .entry-content cite, .comment-content *, .about-the-author, .single code, .single kbd, .single tt, .single var, .single .site-content .entry-content, .single .site-content .entry-content p, .single .site-content .entry-content li, .single .site-content .entry-content div, .error404 p, .search-no-results p { color: <?php echo esc_attr(get_theme_mod( 'global_content')); ?>; }
		.page .entry-content blockquote, .single .entry-content blockquote, .comment-content blockquote { border-color: <?php echo esc_attr(get_theme_mod( 'global_content')); ?>; }
		.error-404 input.search-field, .about-the-author, .comments-title, .related-posts h3, .comment-reply-title{ border-color: <?php echo esc_attr(get_theme_mod( 'global_borders')); ?>; }

		<?php if ( get_theme_mod( 'fullwidth_pages' ) == '1' ) : ?>
		.page #primary.content-area { width: 100%; max-width: 100%;}
		.page aside#secondary { display: none; }
		<?php endif; ?>

		<?php if ( get_theme_mod( 'fullwidth_posts' ) == '1' ) : ?>
		.single div#primary.content-area { width: 100%; max-width: 100%; }
		.single aside#secondary { display: none; }
		<?php endif; ?>


		<?php if ( get_theme_mod( 'hide_about_the_author_section' ) == '1' ) : ?>
		.about-the-author {
			display: none;
		}
		<?php endif; ?>



		/* Sidebar */
		#secondary h4, #secondary h1, #secondary h2, #secondary h3, #secondary h5, #secondary h6, #secondary h4 a{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_headline')); ?>; }
		#secondary span.rpwwt-post-title{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_headline')); ?> !important; }
		#secondary select, #secondary h4, .blog #secondary input.search-field, .blog #secondary input.search-field, .search-results #secondary input.search-field, .archive #secondary input.search-field { border-color: <?php echo esc_attr(get_theme_mod( 'sidebar_border')); ?>; }
		#secondary * { color: <?php echo esc_attr(get_theme_mod( 'sidebar_text')); ?>; }
		#secondary .rpwwt-post-date{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_text')); ?> !important; }
		#secondary a { color: <?php echo esc_attr(get_theme_mod( 'sidebar_link')); ?>; }
		#secondary .search-form input.search-submit, .search-form input.search-submit, input.search-submit { background: <?php echo esc_attr(get_theme_mod( 'sidebar_link')); ?>; }

		/* Blog Feed */
		body.custom-background.blog, body.blog, body.custom-background.archive, body.archive, body.custom-background.search-results, body.search-results{ background-color: <?php echo esc_attr(get_theme_mod( 'blog_site_background')); ?>; }
		.blog main article, .search-results main article, .archive main article{ background-color: <?php echo esc_attr(get_theme_mod( 'blog_post_background')); ?>; }
		.blog main article h2 a, .search-results main article h2 a, .archive main article h2 a{ color: <?php echo esc_attr(get_theme_mod( 'blog_post_headline')); ?>; }
		.blog main article .entry-meta, .archive main article .entry-meta, .search-results main article .entry-meta{ color: <?php echo esc_attr(get_theme_mod( 'blog_post_byline')); ?>; }
		.blog main article p, .search-results main article p, .archive main article p { color: <?php echo esc_attr(get_theme_mod( 'blog_post_excerpt')); ?>; }
		.nav-links span, .nav-links a, .pagination .current, .nav-links span:hover, .nav-links a:hover, .pagination .current:hover { background: <?php echo esc_attr(get_theme_mod( 'blog_post_navigation_bg')); ?>; }
		.nav-links span, .nav-links a, .pagination .current, .nav-links span:hover, .nav-links a:hover, .pagination .current:hover{ color: <?php echo esc_attr(get_theme_mod( 'blog_post_navigation_link')); ?>; }

		<?php if ( get_theme_mod( 'blog_feed_fullwidth' ) == '1' ) : ?>
		.fp-blog-grid {
			width: 100% !important;
			max-width: 100% !important;
		}
		.blog #secondary,
		.archive #secondary,
		.search-results #secondary {
			display:none;
		}
		.blog main article, .search-results main article, .archive main article {
			flex: 0 0 32%;
			max-width: 32%;
		}
		.blog main, .search-results main, .archive main {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}
		@media screen and (max-width: 900px) {
			.blog main article, .search-results main article, .archive main article {
				flex: 0 0 48%;
				max-width: 48%;
			}
		}
		@media screen and (max-width: 700px) {
			.blog main article, .search-results main article, .archive main article {
				flex: 0 0 100%;
				max-width: 100%;
			}
			.blog main article, .search-results main article, .archive main article {
				display: inline-block;
				flex-wrap: none;
				float: left;
				width: 100%;
				justify-content: none;
			}
		}
		<?php endif; ?>


		</style>
		<?php }
		add_action( 'wp_head', 'sp_magazinely_customize_register_output' );
		endif;


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sp_magazinely_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sp_magazinely_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sp_magazinely_customize_preview_js() {
	wp_enqueue_script( 'magazinely-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1', true );
}
add_action( 'customize_preview_init', 'sp_magazinely_customize_preview_js' );
