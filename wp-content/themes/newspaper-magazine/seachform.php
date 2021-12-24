<form method="get" class="td-search-form-widget" action="<?php echo esc_url( home_url( '/' ) ); ?>" accept-charset="utf-8">
	<div role="search">
		<input class="td-widget-search-input" type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s">
		<input class="wpb_button wpb_btn-inverse btn" type="submit" id="searchsubmit" value="<?php echo esc_attr( 'Search', 'newspaper-magazine' ); ?>">
	</div>
</form>