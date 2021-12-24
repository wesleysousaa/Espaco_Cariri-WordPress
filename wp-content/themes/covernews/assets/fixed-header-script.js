jQuery(document).ready(function($){

    // Here You can type your custom JavaScript...

window.onscroll = function() {myFunction()};

var header = document.getElementById("site-navigation");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("aft-sticky-navigation");
  } else {
    header.classList.remove("aft-sticky-navigation");
  }
}

});

jQuery(document).ready(function($){

var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('#site-navigation').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('#site-navigation').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#site-navigation').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

});