<?php
/**
 * Getting started template
 */

?>
<?php $theme = wp_get_theme(); ?>

<div id="getting_started" class="newspaperss-tab-pane active">

	<div class="newspaperss-tab-pane-center">

		<h1 class="newspaperss-welcome-title"><?php printf( esc_html__( 'Welcome to %s!', 'newspaperss' ), $theme->get( 'Name' ) ); ?></h1>
	<p><?php  esc_html__( 'We want to make sure you have the best experience using newspaperss and that is why we gathered here all the necessary informations for you. We hope you will enjoy using newspaperss, as much as we enjoy creating great products.', 'newspaperss' ) ; ?>

	</div>

	<hr />
<div class="newspaperss-tab-pane-half">
	<h1><?php esc_html_e( 'Need more details?', 'newspaperss' ); ?></h1>

	<p><?php printf( esc_html__( 'Please check our full documentation for detailed information on how to use %s.','newspaperss'), 'newspaperss' ); ?></p>

	<p>
		<a target="_blank" href="<?php echo esc_url( 'newspaperss-demos.imonthemes.com/documentation-usage/' ); ?>" class="button button-primary"><?php printf( esc_html__( '%s documentation', 'newspaperss' ), 'Newspaperss' ); ?></a>
	</p>
</div>

<div class="newspaperss-tab-pane-half">
	<h1><?php esc_html_e( 'Go to the Customizer', 'newspaperss' ); ?></h1>

	<p><?php echo esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'newspaperss' ); ?></p>

	<p>
		<a href="<?php echo esc_url( wp_customize_url() );?>" class="button button-primary"><?php printf( esc_html__( 'Start Customizing %s', 'newspaperss' ), 'Newspaperss' ); ?></a>
	</p>
</div>



	<div class="newspaperss-clear"></div>

</div>
