
( function( api , $ ) {
    wp.customize.bind( 'ready', function() {
        $( 'body').on( 'change glob_init', 'select[data-customize-setting-link="footer_layout"]', function(){
            var v = $( this).val();
            $( '#customize-control-footer_4_columns, #customize-control-footer_3_columns, #customize-control-footer_2_columns').hide();
            $( '#customize-control-footer_'+v+'_columns').show();
        } );
        $( '#customize-control-footer_layout select').trigger( 'glob_init' );
    } );
} )(  wp.customize, jQuery );
