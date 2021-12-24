/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function($){
	var windowWidth = $(window).width();
	if( windowWidth > 600 ) {
		var wpAdminBar = $('#wpadminbar');
		if (wpAdminBar.length) {
			$("#np-menu-wrap").sticky({topSpacing:wpAdminBar.height()});
		} else {
			$("#np-menu-wrap").sticky({topSpacing:0});
		}
	}
});