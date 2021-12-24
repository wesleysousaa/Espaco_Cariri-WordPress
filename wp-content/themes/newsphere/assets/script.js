(function (e) {
    "use strict";
    var n = window.AFTHRAMPES_JS || {};
    $ = jQuery;

    n.mobileMenu = {
        init: function () {
            this.toggleMenu(), this.menuMobile(), this.menuArrow()
        },
        toggleMenu: function () {
            e('#masthead').on('click', '.toggle-menu', function (event) {
                var ethis = e('.main-navigation .menu .menu-mobile');
                if (ethis.css('display') == 'block') {
                    ethis.slideUp('300');
                } else {
                    ethis.slideDown('300');
                }
                e('.ham').toggleClass('exit');
            });


            e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                event.preventDefault();
                var ethis = e(this),
                    eparent = ethis.closest('li');

                if (eparent.find('> .children').length) {
                    var esub_menu = eparent.find('> .children');
                } else {
                    var esub_menu = eparent.find('> .sub-menu');
                }


                if (esub_menu.css('display') == 'none') {
                    esub_menu.slideDown('300');
                    ethis.addClass('active');
                } else {
                    esub_menu.slideUp('300');
                    ethis.removeClass('active');
                }
                return false;
            });
        },
        menuMobile: function () {
            if (e('.main-navigation .menu > ul').length) {
                var ethis = e('.main-navigation .menu > ul'),
                    eparent = ethis.closest('.main-navigation'),
                    pointbreak = eparent.data('epointbreak'),
                    window_width = window.innerWidth;
                if (typeof pointbreak == 'undefined') {
                    pointbreak = 991;
                }
                if (pointbreak >= window_width) {
                    ethis.addClass('menu-mobile').removeClass('menu-desktop');
                    e('.main-navigation .toggle-menu').css('display', 'block');
                } else {
                    ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                    e('.main-navigation .toggle-menu').css('display', '');
                }
            }
        },
        menuArrow: function () {
            if (e('#masthead .main-navigation div.menu > ul').length) {
                e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="">');
                e('#masthead .main-navigation div.menu > ul .children').parent('li').find('> a').append('<i class="">');
            }
        }
    },


        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.setInstaHeight = function () {
            e('.insta-slider-block').each(function () {
                var img_width = e(this).find('.insta-item .af-insta-height').eq(0).innerWidth();
                e(this).find('.insta-item .af-insta-height').css('height', img_width);
            });
        },

        n.setHeaderHeight = function () {
            if (e('#main-navigation-bar').length > 0) {
                var menuHeight = e('#main-navigation-bar').height();
                e('.header-menu-part').height(menuHeight);
            }
        },

        n.Preloader = function () {
            e(window).load(function () {
                e('#loader-wrapper').fadeOut();
                e('#af-preloader').delay(500).fadeOut('slow');

            });
        },

        n.Search = function () {
            e(window).load(function () {
                e(".af-search-click").on('click', function () {
                    e("#af-search-wrap").toggleClass("af-search-toggle");
                });
            });
        },

        n.Offcanvas = function () {
            e('.offcanvas-nav').sidr({
                side: 'left'
            });

            e('.sidr-class-sidr-button-close').click(function () {
                e.sidr('close', 'sidr');
            });
        },

        // SHOW/HIDE SCROLL UP //
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },


        n.MagnificPopup = function () {

            e('.gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });

            e('.wp-block-gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });
        },

        n.searchReveal = function () {
            jQuery('.search-overlay .search-icon').on('click', function () {
                jQuery(this).parent().toggleClass('reveal-search');
                return false;
            });
        },

        n.em_sticky = function () {
            jQuery('.home #secondary.aft-sticky-sidebar').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },

        n.jQueryMarquee = function () {
            e('.marquee.aft-flash-slide').marquee({
                //duration in milliseconds of the marquee
                speed: 80000,
                //gap in pixels between the tickers
                gap: 0,
                //time in milliseconds before the marquee will start animating
                delayBeforeStart: 0,
                //'left' or 'right'
                // direction: 'right',
                //true or false - should the marquee be duplicated to show an effect of continues flow
                duplicated: true,
                pauseOnHover: true,
                startVisible: true
            });
        },

        n.SwiperSlider = function () {

            var MainBannerCarouselDefault = new Swiper('.banner-carousel-default', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });

            if (jQuery('.banner-carousel-default').length > 0) {
                $(".banner-carousel-default").hover(function () {
                    MainBannerCarouselDefault.autoplay.stop();
                }, function () {
                    MainBannerCarouselDefault.autoplay.start();
                });
            }

            var MainBannerCarousel = new Swiper('.banner-carousel-slider', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 2,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 1,
                    }
                }
            });

            if (jQuery('.banner-carousel-slider').length > 0) {
                $(".banner-carousel-slider").hover(function () {
                    MainBannerCarousel.autoplay.stop();
                }, function () {
                    MainBannerCarousel.autoplay.start();
                });
            }

            var MainBannerSliderSingle = new Swiper('.banner-main-slider', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });

            if (jQuery('.banner-main-slider').length > 0) {
                $(".banner-main-slider").hover(function () {
                    MainBannerSliderSingle.autoplay.stop();
                }, function () {
                    MainBannerSliderSingle.autoplay.start();
                });
            }

            var MainBannerCarouselSingle = new Swiper('.banner-single-slider', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });

            if (jQuery('.banner-single-slider').length > 0) {
                $(".banner-single-slider").hover(function () {
                    MainBannerCarouselSingle.autoplay.stop();
                }, function () {
                    MainBannerCarouselSingle.autoplay.start();
                });
            }


            var WidgetContentCarousel = new Swiper('.posts-carousel', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 3,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 3,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 1,
                    }
                }
            });

            if (jQuery('.posts-carousel').length > 0) {
                $(".posts-carousel").hover(function () {
                    WidgetContentCarousel.autoplay.stop();
                }, function () {
                    WidgetContentCarousel.autoplay.start();
                });
            }

            var WidgetSidebarCarousel = new Swiper('#secondary .posts-carousel', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });
            if (jQuery('#secondary .posts-carousel').length > 0) {
                $("#secondary .posts-carousel").hover(function () {
                    WidgetSidebarCarousel.autoplay.stop();
                }, function () {
                    WidgetSidebarCarousel.autoplay.start();
                });
            }


            var WidgetFooterCarousel = new Swiper('.site-footer .posts-carousel', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });

            if (jQuery('.site-footer .posts-carousel').length > 0) {
                $(".site-footer .posts-carousel").hover(function () {
                    WidgetFooterCarousel.autoplay.stop();
                }, function () {
                    WidgetFooterCarousel.autoplay.start();
                });
            }

            var WidgetSidrCarousel = new Swiper('#sidr .posts-carousel', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });

            if (jQuery('#sidr .posts-carousel').length > 0) {
                $("#sidr .posts-carousel").hover(function () {
                    WidgetSidrCarousel.autoplay.stop();
                }, function () {
                    WidgetSidrCarousel.autoplay.start();
                });
            }

            var InstaCarousel = new Swiper('.instagram-carousel', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 6,
                spaceBetween: 0,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    480: {
                        slidesPerView: 1,
                    }
                }
            });

            if (jQuery('.instagram-carousel').length > 0) {
                $(".instagram-carousel").hover(function () {
                    InstaCarousel.autoplay.stop();
                }, function () {
                    InstaCarousel.autoplay.start();
                });
            }

            var WidgetSlider = new Swiper('.posts-slider', {
                direction: 'horizontal',
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                spaceBetween: 0,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }
            });
            if (jQuery('.posts-slider').length > 0) {
                $(".posts-slider").hover(function () {
                    WidgetSlider.autoplay.stop();
                }, function () {
                    WidgetSlider.autoplay.start();
                });
            }


            var VerticalSlider = new Swiper('.vertical-slider', {
                direction: 'vertical',
                loop: true,
                slidesPerView: 5,
                spaceBetween: 10,
                autoplay: true,
                breakpoints: {
                    // when window width is <= 320px
                    768: {
                        allowTouchMove: 0,

                    },
                }
            });

            if (jQuery('.vertical-slider').length > 0) {
                $(".vertical-slider").hover(function () {
                    VerticalSlider.autoplay.stop();
                }, function () {
                    VerticalSlider.autoplay.start();
                });
            }

            var VerticalPostsSlider = new Swiper('.trending-posts-vertical', {
                direction: 'vertical',
                loop: true,
                slidesPerView: 5,
                spaceBetween: 10,
                autoplay: true,
                breakpoints: {
                    // when window width is <= 320px
                    768: {
                        allowTouchMove: 0,

                    },
                }
            });

            if (jQuery('.trending-posts-vertical').length > 0) {
                $(".trending-posts-vertical").hover(function () {
                    VerticalPostsSlider.autoplay.stop();
                }, function () {
                    VerticalPostsSlider.autoplay.start();
                });
            }


            // Video slider part starts

            var part1 = '<div class=swiper-pagination></div>';
            $('#swiper-press').append(part1);


            /* change active class when click */
            $(".swiper-container-videos .swiper-wrapper .swiper-slide a").click(function () {
                $(this).closest(".swiper-slide").addClass("selected").siblings().removeClass("selected");
                YoutubeVideoSlider.slideTo(YoutubeVideoSlider.clickedIndex);
            });

            $(".swiper-container-videos .swiper-slide").first().addClass("selected");

                var YoutubeVideoSlider = new Swiper(".swiper-container-videos", {
                // If loop true set photoswipe - counterEl: false
                loop: false,
                slidesPerView: 4,
                spaceBetween: 10,
                centeredSlides: false,
                // If we need pagination
                navigation: {
                    nextEl: '.swiper-custom-next.swiper-button-next',
                    prevEl: '.swiper-custom-prev.swiper-button-prev'
                },
                keyboard: {
                    enabled: true,
                    onlyInViewport: true
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    480: {
                        slidesPerView: 2,
                    }
                }
            });

        },
        n.MasonryBlog = function () {
            if (e('.aft-masonry-archive-posts').length > 0) {
                jQuery('.aft-masonry-archive-posts').masonry();
            }
        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.DataBackground(), n.setInstaHeight(), n.em_sticky(), n.MagnificPopup(), n.jQueryMarquee(), n.MasonryBlog(), n.Preloader(), n.setHeaderHeight(), n.Search(), n.Offcanvas(), n.searchReveal(), n.SwiperSlider(), n.scroll_up();
        }), e(window).scroll(function () {
        n.show_hide_scroll_top();
    }), e(window).resize(function () {
        n.mobileMenu.menuMobile();
    })
})(jQuery);