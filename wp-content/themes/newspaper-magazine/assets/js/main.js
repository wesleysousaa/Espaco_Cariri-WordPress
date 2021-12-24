( function( $ ) {
  jQuery(window).load(function() {

    var allFXs = ['scroll', 'crossfade', 'cover', 'uncover'];
    function setRandomFX(jQueryelem) {
        var newFX = Math.floor(Math.random() * allFXs.length);
        jQueryelem.trigger('configuration', {
            auto: {
                fx: allFXs[ newFX ]
            }
        });
    }


    //Primary Nav in both scene

    var windowWidth = jQuery(window).width();
    var nav = ".main-nav";
    //    for sub menu arrow

    //    for sub menu arrow
    jQuery('.main-nav >li:has("ul")>a').each(function() {
        jQuery(this).addClass('below');
    });
    jQuery('ul:not(.main-nav)>li:has("ul")>a').each(function() {
        jQuery(this).addClass('side');
    });
    if (windowWidth > 991) {

        jQuery('#showbutton').off('click');
        jQuery('.im-hiding').css('display', 'block');
        jQuery(nav).off('mouseenter', 'li');
        jQuery(nav).off('mouseleave', 'li');
        jQuery(nav).off('click', 'li');
        jQuery(nav).off('click', 'a');
        jQuery(nav).on('mouseenter', 'li', function() {
            jQuery(this).children('ul').stop().hide();
            jQuery(this).children('ul').slideDown(400);
        });
        jQuery(nav).on('mouseleave', 'li', function() {
            jQuery(this).children('ul').stop().slideUp(350);
        });
    } else {

        jQuery('#showbutton').off('click');
        jQuery('.im-hiding').css('display', 'none');
        jQuery(nav).off('mouseenter', 'li');
        jQuery(nav).off('mouseleave', 'li');
        jQuery(nav).off('click', 'li');
        jQuery(nav).off('click', 'a');
        jQuery(nav).on('click', 'a', function(e) {
            jQuery(this).next('ul').attr('style=""');
            jQuery(this).next('ul').slideToggle();
            if (jQuery(this).next('ul').length !== 0) {
                e.preventDefault();
            }
        });
        // for hide menu
        jQuery('#showbutton').on('click', function() {

            jQuery('.im-hiding').slideToggle();
        });
    }
    jQuery(window).resize(function() {
        windowWidth = jQuery(window).width();
        jQuery(nav + ' ul').each(function() {
            jQuery(this).attr('style', '" "');
        });
        if (windowWidth > 991) {
            jQuery('#showbutton').off('click');
            jQuery('.im-hiding').css('display', 'block');
            jQuery(nav).off('mouseenter', 'li');
            jQuery(nav).off('mouseleave', 'li');
            jQuery(nav).off('click', 'li');
            jQuery(nav).off('click', 'a');
            jQuery(nav).on('mouseenter', 'li', function() {
                jQuery(this).children('ul').stop().hide();
                jQuery(this).children('ul').slideDown(400);
            });
            jQuery(nav).on('mouseleave', 'li', function() {
                jQuery(this).children('ul').stop().slideUp(350);
            });
        } else {
            jQuery('#showbutton').off('click');
            jQuery('.im-hiding').css('display', 'none');
            jQuery(nav).off('mouseenter', 'li');
            jQuery(nav).off('mouseleave', 'li');
            jQuery(nav).off('click', 'li');
            jQuery(nav).off('click', 'a');
            jQuery(nav).on('click', 'a', function(e) {
                jQuery(this).next('ul').attr('style=""');
                jQuery(this).next('ul').slideToggle();
                if (jQuery(this).next('ul').length !== 0) {
                    e.preventDefault();
                }
            });
            // for hide menu
            jQuery('#showbutton').on('click', function() {

                jQuery('.im-hiding').slideToggle();
            });
        }
    });
  /*
    jQuery(".main-nav li").on('mouseenter mouseleave', function (e) {
      var elm = jQuery(this).children('ul:first');
      var off = elm .offset();
      var l = off.left;
      var w = elm.outerWidth();
      var docW = jQuery(window).width();

      var isEntirelyVisible = (l+ w < docW);

      if ( ! isEntirelyVisible ) {

          jQuery(this).children('ul').css("left",-w+"px");
          var nwidth = jQuery(this).children('ul').outerWidth();
          jQuery(this).children('ul').css("left",-nwidth+"px");
      }
    });
*/

    var owl = $("#owl-demo");
 /*  Start thumble slider jquery */
    var sync1 = $("#sync1");
  var sync2 = $("#sync2");

  sync1.owlCarousel({
    autoPlay:true,
    singleItem : true,
    slideSpeed : 1000,
    navigation: false,
    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200,
  });

  sync2.owlCarousel({
    items : 15,
    itemsDesktop      : [1199,10],
    itemsDesktopSmall     : [979,10],
    itemsTablet       : [768,8],
    itemsMobile       : [479,4],
    pagination:false,
    responsiveRefreshRate : 100,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });

  function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }

  $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });

  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }

    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }

  }
  /*  end thumble slider jquery */
  /*$( document ).ready(function() {
      var s1 = $('.breakingnews_left').height();
      var s2 = $('.breakingnews_right').height();


        $('.breakingnews_right').css('height', s1 + "px");
    }); */



    $(document).ready(function(){
      var my_posts = $("[rel=tooltip]");

      var size = $(window).width();
      for(i=0;i<my_posts.length;i++){
        the_post = $(my_posts[i]);

        if(the_post.hasClass('invert') && size >=767 ){
          the_post.tooltip({ placement: 'left'});
          the_post.css("cursor","pointer");
        }else{
          the_post.tooltip({ placement: 'rigth'});
          the_post.css("cursor","pointer");
        }
      }
    });

  $(".owl-demo").owlCarousel({
        slideSpeed: 300,
        autoPlay: true,
        paginationSpeed: 400,
        singleItem: true,
        navigation: false,
        navigationText: ["<",">"],
        pagination: false
    })
  $(".owl-demo1").owlCarousel({

      autoPlay:true,
       slideSpeed : 300,
      itemsCustom : [
        [0, 1],
        [450, 1],
        [600, 2],
        [700, 2],
        [1000, 3],
        [1200, 4],
        [1400, 4],
        [1600, 4]
      ],
      navigation : false,
      pagination : false

  });
  $(".owl-demo2").owlCarousel({

      autoPlay:true,
       slideSpeed : 300,
      itemsCustom : [
        [0, 1],
        [450, 1],
        [600, 2],
        [700, 3],
        [1000, 3],
        [1200, 3],
        [1400, 3],
        [1600, 3]
      ],
      navigation : true,
      navigationText: ["<",">"],
      pagination : false

  });
  $(".owl-demo3").owlCarousel({

      autoPlay:true,
       slideSpeed : 300,
      itemsCustom : [
        [0, 1],
        [450, 1],
        [600, 2],
        [700, 3],
        [1000, 3],
        [1200, 4],
        [1400, 4],
        [1600, 4]
      ],
      navigation : false,
      pagination : false

  });
  $(".owl-demo4").owlCarousel({
        slideSpeed: 300,
        autoPlay: true,
        paginationSpeed: 400,
        singleItem: true,
        navigation: false,
        navigationText: ["<",">"],
        pagination: false
    })


  $( window ).resize(function() {
  $( "#log" ).append( "<div>Handler for .resize() called.</div>" );
});

 $(document).ready(function() {
    $('#owl-demo1').show();
    });
    $(document).ready(function() {
    $('#owl-demo').show();
    });
     $(document).ready(function() {
    $('.breakingnews_right').show();
    });

     jQuery(document).ready(function() {
      $('.breaking_news .breakingnews_left .view img').css('height', $('.breaking_news .breakingnews_right').height());

    });
    jQuery(window).resize(function() {
          $('.breaking_news .breakingnews_left .view img').css('height', $('.breaking_news .breakingnews_right').height());
      });

    $(function () {
        $(".timeline li").slice(0, 4).show();
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".timeline li:hidden").slice(0, 4).slideDown();
            if ($(".timeline li:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().top
            }, 1500);
        });
    });
    $('#top').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 600);
    return false;
});

  $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
          $('.totop ').fadeIn();
      } else {
          $('.totop').fadeOut();
      }
    });

  $( "#button" ).click(function() {
      $( "#item" ).toggle();
  });

  new WOW().init();

  $( '.grid' ).masonry({
    itemSelector: '.grid-item',
  });


});

equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).load(function() {
  equalheight('.horizental_cat_news');
});


$(window).resize(function(){
  equalheight('.horizental_cat_news');
});
$(window).load(function() {
  equalheight('.grid-item');
});


$(window).resize(function(){
  equalheight('.grid-item');
});


}) ( jQuery );