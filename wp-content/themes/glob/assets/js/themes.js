/**
 * File skip link focus.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
    var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
        isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
        isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;
    if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
        window.addEventListener( 'hashchange', function() {
            var id = location.hash.substring( 1 ),
                element;
            if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                return;
            }
            element = document.getElementById( id );
            if ( element ) {
                if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                    element.tabIndex = -1;
                }
                element.focus();
            }
        }, false );
    }
})();
jQuery( document).ready( function( $ ){
    "use strict";
    $(".block-slider").slick({
        autoplay: true,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: true,
        dots : true,
        arrows : true,
        prevArrow: "<span class=\'carousel-prev\'><i class=\'fa fa-angle-left\'></i></span>",
        nextArrow: "<span class=\'carousel-next\'><i class=\'fa fa-angle-right\'></i></span>",
    });
    $(".breaking_slider").slick({
        autoplay: true,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: false,
        dots : false,
        arrows : true,
        prevArrow: "<span class=\'carousel-prev\'><i class=\'fa fa-angle-left\'></i></span>",
        nextArrow: "<span class=\'carousel-next\'><i class=\'fa fa-angle-right\'></i></span>",
    });
    $('.site-content img, .site-footer img').on('inview', function(event, isInView) {
        if (isInView) {
            // element is now visible in the viewport
            $( this).addClass( 'inview' );
        } else {
            // element has gone out of viewport
        }
    });
    // Customizer Selective Refresh
    if ( 'undefined' !== typeof wp && wp.customize && wp.customize.selectiveRefresh ) {
        wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
            if ( placement.partial.id == 'section-gallery' ) {
                // Trigger resize to make other sections work.
                //$( window ).resize();
            }
        } );
    }
    $( '.search-icon' ).on( 'mouseenter', function() {
        $( '.dropdown-search .search-field' ).focus();
    });
} );
