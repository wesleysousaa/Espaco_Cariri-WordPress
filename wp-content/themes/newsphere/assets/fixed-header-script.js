jQuery(document).ready(function($){

    // Here You can type your custom JavaScript...

window.onscroll = function() {myFunction()};

var header = document.getElementById("main-navigation-bar");
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
var navbarHeight = $('#main-navigation-bar').outerHeight();

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
        $('#main-navigation-bar').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#main-navigation-bar').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

});