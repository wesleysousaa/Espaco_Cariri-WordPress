<?php
/**
 * About page of News Portal Theme
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'News_Portal_About' ) ) :

class News_Portal_About {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'news_portal_admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'news_portal_hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'news_portal_admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'about_theme_styles' ) );
		add_filter( 'admin_footer_text', array( $this, 'news_portal_admin_footer_text' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function news_portal_admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'news-portal' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'news-portal' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'news-portal-welcome', array( $this, 'welcome_screen' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function about_theme_styles( $hook ) {
		if( 'appearance_page_news-portal-welcome' != $hook && 'themes.php' != $hook ) {
			return;
		}
		global $news_portal_version;

		wp_enqueue_style( 'mt-about-theme-style', get_template_directory_uri() . '/inc/about-theme/about.css', array(), $news_portal_version );
	}

	/**
	 * Add admin notice.
	 */
	public function news_portal_admin_notice() {
		global $news_portal_version, $pagenow;

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'news_portal_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'news_portal_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function news_portal_hide_notices() {
		if ( isset( $_GET['news-portal-hide-notice'] ) && isset( $_GET['_news_portal_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_news_portal_notice_nonce'], 'news_portal_hide_notices_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'news-portal' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Cheat in &#8217; huh?', 'news-portal' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['news-portal-hide-notice'] );
			update_option( 'news_portal_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		$theme = wp_get_theme( get_template() );

		$theme_name = $theme->get( 'Name' );
?>
		<div id="mt-theme-message" class="updated notice is-dismissible news-portal-message">
			<h2 class="welcome-title"><?php printf( esc_html__( 'Welcome to %s', 'news-portal' ), $theme_name ); ?></h2>
			<button type="button" class="news-portal-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'news-portal-hide-notice', 'welcome' ) ), 'news_portal_hide_notices_nonce', '_news_portal_notice_nonce' ) ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'news-portal' ); ?></button>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$s welcome page %3$s.', 'news-portal' ), esc_html( $theme_name ), '<a href="' . esc_url( admin_url( 'themes.php?page=news-portal-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=news-portal-welcome' ) ); ?>"><?php printf( esc_html__( 'Get started with %1$s', 'news-portal' ), esc_html( $theme_name ) ); ?></a>
			</p>
		</div><!-- #mt-theme-message -->
<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $news_portal_version;
		$theme = wp_get_theme( get_template() );

		$theme_name = $theme->get( 'Name' );
		$theme_description = $theme->get( 'Description' );
		$theme_uri = $theme->get( 'ThemeURI' );
		$author_uri = $theme->get( 'AuthorURI' );
		$author_name = $theme->get( 'Author' );

		// Drop minor version if 0
?>
		<div class="news-portal-theme-info">
			<h1> <?php echo esc_html( 'About ', 'news-portal' ).' '. esc_html( $theme_name ); ?> </h1>
			<div class="author-credit">
				<span class="theme-version"><?php printf( esc_html__( 'Version: %1$s', 'news-portal' ), $news_portal_version ); ?></span>
				<span class="author-link"><?php printf( wp_kses_post( 'By <a href="%1$s" target="_blank">%2$s</a>', 'news-portal' ), $author_uri, $author_name ); ?></span>
			</div>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo wp_kses_post( $theme_description ); ?></div>

				<div class="news-portal-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.jpg'; ?>" />
				</div>
			</div>
		</div><!-- .news-portal-theme-info -->

		<p class="news-portal-actions">
			<a href="<?php echo esc_url( $theme_uri ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'news-portal' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'news_portal_pro_theme_url', 'http://demo.mysterythemes.com/news-portal-landing/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'news-portal' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'news_portal_pro_theme_url', 'https://mysterythemes.com/wp-themes/news-portal-pro/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'news-portal' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'news_portal_pro_theme_url', 'https://wordpress.org/support/theme/news-portal/reviews/?filter=5' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'news-portal' ); ?></a>
		</p>

		<div class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'news-portal-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'news-portal-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo esc_html( $theme->display( 'Name' ) ); ?>
			</a>
			
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'news-portal-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'news-portal' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'more_themes' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'news-portal-welcome', 'tab' => 'more_themes' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'More Themes', 'news-portal' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'news-portal-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'news-portal' ); ?>
			</a>
		</div><!-- .nav-tab-wrapper -->
<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );

		$theme_name = $theme->get( 'Name' );
		$theme_description = $theme->get( 'Description' );
		$theme_uri = $theme->get( 'ThemeURI' );
?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="theme-features-wrap">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'news-portal' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'news-portal' ) ?></p>
						<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'news-portal' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'news-portal' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'news-portal' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://docs.mysterythemes.com/news-portal/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Documentation', 'news-portal' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'news-portal' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'news-portal' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://mysterythemes.com/support/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Support', 'news-portal' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'news-portal' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'news-portal' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://mysterythemes.com/wp-themes/news-portal-pro/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View PRO version', 'news-portal' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Have you need customization?', 'news-portal' ); ?></h3>
						<p><?php esc_html_e( 'Please send message with your requirement.', 'news-portal' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://mysterythemes.com/customization/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Customization', 'news-portal' ); ?></a></p>
					</div>

					<div class="col">
						<h3> <?php printf( esc_html__( 'Translate %1$s', 'news-portal' ), esc_html( $theme_name ) ); ?> </h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'news-portal' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/news-portal' ); ?>" class="button button-secondary" target="_blank"><?php printf( esc_html__( 'Translate %1$s', 'news-portal' ), esc_html( $theme_name ) ); ?></a>
						</p>
					</div>
				</div>
			</div><!-- .theme-features-wrap -->

			<div class="return-to-dashboard news-portal">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'news-portal' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'news-portal' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'news-portal' ) : esc_html_e( 'Go to Dashboard', 'news-portal' ); ?></a>
			</div><!-- .return-to-dashboard -->

		</div><!-- .about-wrap -->
<?php
	}

	/**
	 * Output the more themes screen
	 */
	public function more_themes_screen() {
?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="theme-browser rendered">
				<div class="themes wp-clearfix">
					<?php
						// Set the argument array with author name.
						$args = array(
							'author' => 'mysterythemes',
							'per_page' => 100
						);
						// Set the $request array.
						$request = array(
							'body' => array(
								'action'  => 'query_themes',
								'request' => serialize( (object)$args )
							)
						);
						$themes = $this->news_portal_get_themes( $request );
						$active_theme = wp_get_theme()->get( 'Name' );
						$counter = 1;

						// For currently active theme.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme == $theme->name ) {
					?>
								<div id="<?php echo esc_attr( $theme->slug ); ?>" class="theme active">
									<div class="theme-screenshot">
										<img src="<?php echo esc_url( $theme->screenshot_url ); ?>"/>
									</div>
									<h3 class="theme-name"><strong><?php esc_html_e( 'Active', 'news-portal' ); ?></strong>: <?php echo esc_html( $theme->name ); ?></h3>
									<div class="theme-actions">
										<a class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo esc_url( get_site_url(). '/wp-admin/customize.php' ); ?>"><?php esc_html_e( 'Customize', 'news-portal' ); ?></a>
									</div>
								</div><!-- .theme active -->
						<?php
							$counter++;
							break;
							}
						}

						// For all other themes.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme != $theme->name ) {
								// Set the argument array with author name.
								$args = array(
									'slug' => esc_attr( $theme->slug ),
								);
								// Set the $request array.
								$request = array(
									'body' => array(
										'action'  => 'theme_information',
										'request' => serialize( (object)$args )
									)
								);
								$theme_details = $this->news_portal_get_themes( $request );
								if( empty( $theme_details->template ) ) {
							?>
									<div id="<?php echo esc_attr( $theme->slug ); ?>" class="theme">
										<div class="theme-screenshot">
											<img src="<?php echo esc_url( $theme->screenshot_url ); ?>"/>
										</div>

										<h3 class="theme-name"><?php echo esc_html( $theme->name ); ?></h3>

										<div class="theme-actions">
											<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>											
												<!-- Activate Button -->
												<a  class="button button-secondary activate"
													href="<?php echo esc_url( wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . esc_attr( $theme->slug ) ) ); ?>" ><?php esc_html_e( 'Activate', 'news-portal' ) ?></a>
											<?php } else {
												// Set the install url for the theme.
												$install_url = add_query_arg( array(
														'action' => 'install-theme',
														'theme'  => esc_attr( $theme->slug ),
													), self_admin_url( 'update.php' ) );
											?>
												<!-- Install Button -->
												<a data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr( 'Downloaded ', 'news-portal' ). number_format( $theme_details->downloaded ).' '.esc_attr( 'times', 'news-portal' ); ?>" class="button button-secondary activate" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php esc_html_e( 'Install Now', 'news-portal' ); ?></a>
											<?php } ?>

											<a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo esc_url( $theme->preview_url ); ?>"><?php esc_html_e( 'Live Preview', 'news-portal' ); ?></a>
										</div>
									</div><!-- .theme -->
					<?php
								}
							}
						}
					?>
				</div>
			</div><!-- .mt-theme-holder -->
		</div><!-- .wrap.about-wrap -->
<?php
	}

	/** 
	 * Get all our themes by using API.
	 */
	private function news_portal_get_themes( $request ) {

		// Generate a cache key that would hold the response for this request:
		$key = 'news_portal_' . md5( serialize( $request ) );

		// Check transient. If it's there - use that, if not re fetch the theme
		if ( false === ( $themes = get_transient( $key ) ) ) {

			// Transient expired/does not exist. Send request to the API.
			$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

			// Check for the error.
			if ( !is_wp_error( $response ) ) {

				$themes = unserialize( wp_remote_retrieve_body( $response ) );

				if ( !is_object( $themes ) && !is_array( $themes ) ) {

					// Response body does not contain an object/array
					return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
				}

				// Set transient for next time... keep it for 24 hours should be good
				set_transient( $key, $themes, 60 * 60 * 24 );
			}
			else {
				// Error object returned
				return $response;
			}
		}
		return $themes;
	}
	
	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

	?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<h4><?php esc_html_e( 'View changelog below:', 'news-portal' ); ?></h4>

			<?php
				$changelog_file = apply_filters( 'news_portal_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
	<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<h4><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'news-portal' ); ?></h4>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'news-portal' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'News Portal', 'news-portal' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'News Portal Pro', 'news-portal' ); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e( 'Price', 'news-portal' ); ?></h3></td>
						<td><?php esc_html_e( 'Free', 'news-portal' ); ?></td>
						<td><?php esc_html_e( '$55', 'news-portal' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Import Demo Data', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Pre Loaders', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Header Layouts', 'news-portal' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'news-portal' ); ?></td>
						<td><?php esc_html_e( '3', 'news-portal' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Archive Pages Layouts', 'news-portal' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'news-portal' ); ?></td>
						<td><?php esc_html_e( '4', 'news-portal' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Single Page Layouts', 'news-portal' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'news-portal' ); ?></td>
						<td><?php esc_html_e( '4', 'news-portal' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Post Review', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Breadcrumbs', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Image Hover Features', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Fallback Image', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Google Fonts', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( '600+', 'news-portal' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Typography Options', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'WooCommerce Compatible', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'No. of Widgets', 'news-portal' ); ?></h3></td>
						<td><?php esc_html_e( '8', 'news-portal' ); ?></td>
						<td><?php esc_html_e( '12', 'news-portal' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Custom 404 Page', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Animation on Section', 'news-portal' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Bottom Footer Layouts', 'news-portal' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'news-portal' ); ?></td>
						<td><?php esc_html_e( '2', 'news-portal' ); ?></td>
					</tr>					
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'news_portal_pro_theme_url', 'https://mysterythemes.com/wp-themes/news-portal-pro/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Pro', 'news-portal' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div><!-- .about-wrap -->
<?php
	}

	/**
     * Display custom text on theme welcome page
     *
     * @param string $text
     */
    public function news_portal_admin_footer_text( $text ) {
        $screen = get_current_screen();

        if ( 'appearance_page_news-portal-welcome' == $screen->id ) {

        	$theme = wp_get_theme( get_template() );
			$theme_name = $theme->get( 'Name' );

            $text = sprintf( __( 'If you like <strong>%1$s</strong> please leave us a %2$s rating. A huge thank you from <strong>Mystery Themes</strong> in advance &#128515!', 'news-portal' ), esc_html( $theme_name ), '<a href="https://wordpress.org/support/theme/news-portal/reviews/?filter=5" class="theme-rating" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>' );

        }

        return $text;
    }
}

endif;

return new News_Portal_About();