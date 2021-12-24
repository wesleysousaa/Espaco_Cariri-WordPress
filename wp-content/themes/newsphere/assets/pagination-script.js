(function ($) {
    "use strict";
    var n = window.AFTHRAMPES_JS || {};
    var fScrollPos = 0;

    /*Used for ajax loading posts*/
    var loadType, loadButtonContainer, loadBtn, loader, pageNo, loading, morePost, scrollHandling;
    /**/

    /* --------------- Background Image ---------------*/
    n.dataBackground = function () {
        $('.read-bg-img').each(function () {
            var src = $(this).find('img').attr('src');
            if (src) {
                $(this).css('background-image', 'url(' + src + ')').find('img').hide();
            }
        });
    },
        n.setLoadPostDefaults = function () {
            if ($('.newsphere-load-more-posts').length > 0) {
                loadButtonContainer = $('.newsphere-load-more-posts');
                loadBtn = $('.newsphere-load-more-posts .load-btn');
                loader = $('.newsphere-load-more-posts .ajax-loader');
                loadType = loadButtonContainer.attr('data-load-type');
                pageNo = 2;
                loading = false;
                morePost = true;
                scrollHandling = {
                    allow: true,
                    reallow: function () {
                        scrollHandling.allow = true;
                    },
                    delay: 400
                };
            }
        },
        n.getPostsOnScroll = function () {
            if ($('.newsphere-load-more-posts').length > 0 && 'scroll' === loadType) {
                var container = $('.newsphere-load-more-posts').closest('#primary');
                var fCurScrollPos = $(window).scrollTop();
                if (fCurScrollPos > fScrollPos) {
                    if (!loading && scrollHandling.allow && morePost) {
                        scrollHandling.allow = false;
                        setTimeout(scrollHandling.reallow, scrollHandling.delay);
                        var offset = $(loadButtonContainer).offset().top - $(window).scrollTop();
                        if (2000 > offset) {
                            loading = true;
                            n.renderPostsAjax();
                        }
                    }
                }
                fScrollPos = fCurScrollPos;
            }
        },
        n.getPostsOnClick = function () {
            if ($('.newsphere-load-more-posts').length > 0 && 'click' === loadType) {
                $('.newsphere-load-more-posts a').on('click', function (e) {
                    e.preventDefault();
                    var container = $(this).closest('#primary');
                    //alert(AFurl.cat);
                    n.renderPostsAjax();
                    //n.renderPostsAjax();

                });

            }
        },
        n.renderPostsAjax = function () {
            $.ajax({
                type: 'GET',
                url: AFurl.ajaxurl,
                data: {
                    action: 'newsphere_load_more',
                    nonce: AFurl.nonce,
                    page: pageNo,
                    post_type: AFurl.post_type,
                    search: AFurl.search,
                    cat: AFurl.cat,
                    taxonomy: AFurl.taxonomy,
                    author: AFurl.author,
                    year: AFurl.year,
                    month: AFurl.month,
                    day: AFurl.day
                },
                dataType: 'json',
                beforeSend: function () {
                    loadBtn.hide();
                    loader.addClass('ajax-loader-enabled');
                },
                success: function (res) {
                    if (res.success) {
                        var $content_join = res.data.content.join('');
                        var $content = $($content_join);
                        $content.hide();
                        if( $('.aft-masonry-archive-posts').length > 0 ){

                            var $grid = $('.aft-masonry-archive-posts');
                            $grid.append( $content );
                            $grid.imagesLoaded(function () {
                                $content.fadeIn();
                                $grid.masonry('appended', $content);
                                loader.removeClass('ajax-loader-enabled');
                            });
                        }else {
                            $('.aft-archive-wrapper').append($content);

                            $content.fadeIn();
                            loader.removeClass('ajax-loader-enabled');

                            /*Set Bg Image if any*/
                            if ($content_join.indexOf("read-bg-img") >= 0) {
                                n.dataBackground();
                            }
                            /**/
                            $content.fadeIn();
                            loader.removeClass('ajax-loader-enabled');
                        }


                        pageNo++;
                        loading = false;
                        if (res.data.more_post) {
                            morePost = true;
                            loadBtn.fadeIn();
                        } else {
                            morePost = false;
                        }
                        loader.removeClass('ajax-loader-enabled');
                    } else {
                        loader.removeClass('ajax-loader-enabled');
                    }
                }
            });
        },

        $(document).ready(function () {
            n.setLoadPostDefaults();
            n.getPostsOnClick();
        });

    $(window).scroll(function () {
        n.getPostsOnScroll();
    });

})(jQuery);