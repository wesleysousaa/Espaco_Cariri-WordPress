<?php
/**
 * Info setup
 *
 * @package Newsphere
 */

if ( ! function_exists( 'newsphere_details_setup' ) ) :

    /**
     * Info setup.
     *
     * @since 1.0.0
     */
    function newsphere_details_setup() {

        $config = array(

            // Welcome content.
            'welcome-texts' => sprintf( esc_html__( 'Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use; Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'newsphere' ), get_bloginfo('name'), 'Newsphere' ),

            // Tabs.
            'tabs' => array(
                'getting-started' => esc_html__( 'Getting Started', 'newsphere' ),
                'support'         => esc_html__( 'Support', 'newsphere' ),
                'useful-plugins'  => esc_html__( 'Useful Plugins', 'newsphere' ),
                'demo-content'    => esc_html__( 'Demo Content', 'newsphere' ),
                'free-vs-pro'    => esc_html__( 'Free vs Pro', 'newsphere' ),
                'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'newsphere' ),
            ),

            // Quick links.
            'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'newsphere' ),
                    'url'  => 'https://afthemes.com/products/newsphere/',
                ),
                'demo_url' => array(
                    'text' => esc_html__( 'View Demo', 'newsphere' ),
                    'url'  => 'https://afthemes.com/newsphere-perfect-news-and-magazine-responsive-wordpress-theme/',
                ),
                'documentation_url' => array(
                    'text' => esc_html__( 'View Documentation', 'newsphere' ),
                    'url'  => 'https://docs.afthemes.com/newsphere/',
                ),
                'rating_url' => array(
                    'text' => esc_html__( 'Rate This Theme','newsphere' ),
                    'url'  => 'https://wordpress.org/support/theme/newsphere/reviews/#new-post',
                ),
            ),

            // Getting started.
            'getting_started' => array(
                'one' => array(
                    'title'       => esc_html__( 'Theme Documentation', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-format-aside',
                    'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'newsphere' ),
                    'button_text' => esc_html__( 'View Documentation', 'newsphere' ),
                    'button_url'  => 'https://docs.afthemes.com/newsphere/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'two' => array(
                    'title'       => esc_html__( 'Static Front Page', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-admin-generic',
                    'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'newsphere' ),
                    'button_text' => esc_html__( 'Static Front Page', 'newsphere' ),
                    'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
                    'button_type' => 'primary',
                ),
                'three' => array(
                    'title'       => esc_html__( 'Theme Options', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-admin-customizer',
                    'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'newsphere' ),
                    'button_text' => esc_html__( 'Customize', 'newsphere' ),
                    'button_url'  => wp_customize_url(),
                    'button_type' => 'primary',
                ),
                'four' => array(
                    'title'       => esc_html__( 'Widgets', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-welcome-widgets-menus',
                    'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'newsphere' ),
                    'button_text' => esc_html__( 'Widgets', 'newsphere' ),
                    'button_url'  => admin_url('widgets.php'),
                    'button_type' => 'primary',
                ),
                'five' => array(
                    'title'       => esc_html__( 'Demo Content', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-layout',
                    'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'newsphere' ), esc_html__( 'One Click Demo Import', 'newsphere' ) ),
                    'button_text' => esc_html__( 'Demo Content', 'newsphere' ),
                    'button_url'  => admin_url( 'themes.php?page=newsphere-details&tab=demo-content' ),
                    'button_type' => 'secondary',
                ),
                'six' => array(
                    'title'       => esc_html__( 'Theme Preview', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-welcome-view-site',
                    'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'newsphere' ),
                    'button_text' => esc_html__( 'View Demo', 'newsphere' ),
                    'button_url'  => 'https://afthemes.com/newsphere-perfect-news-and-magazine-responsive-wordpress-theme/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),

            // Support.
            'support' => array(
                'one' => array(
                    'title'       => esc_html__( 'Contact Support', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'newsphere' ),
                    'button_text' => esc_html__( 'Contact Support', 'newsphere' ),
                    'button_url'  => 'https://wordpress.org/support/theme/newsphere/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'two' => array(
                    'title'       => esc_html__( 'Theme Documentation', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-format-aside',
                    'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'newsphere' ),
                    'button_text' => esc_html__( 'View Documentation', 'newsphere' ),
                    'button_url'  => 'https://docs.afthemes.com/newsphere/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'three' => array(
                    'title'       => esc_html__( 'Child Theme', 'newsphere' ),
                    'icon'        => 'dashicons dashicons-admin-tools',
                    'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'newsphere' ),
                    'button_text' => esc_html__( 'Learn More', 'newsphere' ),
                    'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),

            //Useful plugins.
            'useful_plugins' => array(
                'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'newsphere' ),
            ),

            //Demo content.
            'demo_content' => array(
                'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'newsphere' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'newsphere' ) . '</a>' ),
            ),

            //Free vs Pro.
            'free_vs_pro' => array(

                'features' => array(
                    'Live editing in Customizer' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Typography style and colors' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Preloader Option' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Multiple Header Options' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Header Options' => array('Default', 'Default, Centered'),
                    'Banner Advertisements' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Sticky Header Toggle' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Home Icon Toggle' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Menu Border Toggle' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Language Switcher Shortcode Area' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Logo and title customization' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Popular Tags Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Exclusive News Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Multiple Frontpage Banner Options' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Frontpage Banner Options' => array('Default', 'Default', 'Default with Thumbs Section, Slider with Tabbed Section, Slider with Thumbs Section, Carousel with Tabbed Section, Carousel with Thumbs Section, None'),
                    'Banner Section Background Image' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Featured Posts on Banner Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Banner Featured Posts Controls' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Editors Picks on Banner Section' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Posts Categories Toggle' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Comments Count Toggle' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Minutes Read Toggle' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Date and Author Toggle' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Date format Options' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Features Image Toggle' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Featured Image View' => array('Default', 'Default, Full'),
                    'Category Color Options' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Number of Category Color Options' => array('3 Available', '7 Available'),
                    'Off Canvas Widget Area' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Banner Advertisements Widget Area' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Posts Section Advertisements Widget Area' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Above Main Banner Section Widget Area' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Below Main Banner Section Widget Area' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Custom Widgets' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Number of Custom Widgets' => array('8+ Available', '13+ Available'),
                    'Author Biography' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Carousel Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Double Column Double Categories Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Single Column Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Posts Slider Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Grid Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Express grid Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Posts List Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Express List Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Posts Tabbed Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Social Contacts Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Trending Posts Vertical Carousel Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'YouTube Video Slider Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Custom Widgets Controls' => array('Basic', 'Advanced'),
                    'Archive Layout' => array('List, List Alternate, List Right', 'List, List Alternate, List Right, Grid, Grid Alternate, Grid Alternate with List, Grid Alternate with Full, Full, Masonry'),
                    'Pagination' => array('Numeric', 'Numeric, Ajax Load More, Infinite Scroll'),
                    'Instagram Feeds' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Mailchimp Subscription Section' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Display Related Posts' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Footer Widgets Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Hide Theme Credit Link' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'WooCommerce Compatibility' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Responsive Layout' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Translations Ready' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'SEO' => array('Optimized', 'Optimized'),
                    'Support' => array('Yes', 'High Priority Dedicated Support')
                ),
            ),

            // Upgrade content.
            'upgrade_to_pro' => array(
                'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'newsphere' ),
                'button_text' => esc_html__( 'Upgrade Now', 'newsphere' ),
                'button_url'  => 'https://afthemes.com/products/newsphere-pro/',
                'button_type' => 'primary',
                'is_new_tab'  => true,
            ),
        );

        Newsphere_Info::init( $config );
    }

endif;

add_action( 'after_setup_theme', 'newsphere_details_setup' );