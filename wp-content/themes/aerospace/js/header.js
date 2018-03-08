/**
 * Adds class to header on scroll & toggles search
 */

(function($) {
    var sBrowser, sUsrAg = navigator.userAgent;
    var headerChange = parseInt($(".header-top").css('height'));

    if ( $('body').hasClass('admin-bar') ) {
        var adminBar = 32;
        headerChange = headerChange + adminBar;
    }

    if ( $( '.entry-content' ).length ) {
        var entryContentTop = $( '.entry-content' ).offset().top;
    }

    // Add class to header on scroll
    var previousScroll = 0;
    $(window).scroll(function() {
        var currentScroll = $(this).scrollTop();

        if ( ! $('body').hasClass('post-template-single-longform') ) {
            if (currentScroll > headerChange ) {
                $(".site-header").addClass("is-small");
                $(".header-bottom-container").addClass("is-sticky");
            } else {
                $(".site-header").removeClass("is-small");
                $(".header-bottom-container").removeClass("is-sticky");
            }
        }

        // If we're on a single post page, we need to swap out the menu bar for the header-post-bar once we reach the entry content, but go back to the navigation when we scroll up.
        if ( $('body').hasClass('single') ) {
            if ( currentScroll > entryContentTop ) {
                $( '.header-post-header' ).addClass('is-active');
                $( '.header-bottom .nav-container, .header-bottom .search-container' ).addClass('is-hidden');
            } else {
                $( '.header-post-header' ).removeClass('is-active');
                $( '.header-bottom .nav-container, .header-bottom .search-container' ).removeClass('is-hidden');
            }

            if ( currentScroll < previousScroll ) {
                $( '.header-post-header' ).removeClass('is-active');
                $( '.header-bottom .nav-container, .header-bottom .search-container' ).removeClass('is-hidden');
            }

            previousScroll = currentScroll;
        }

    });

    // Toggle class on search.
    $(".header-search-form .search-label").on("click", function() {
        var parent = $(this).parents(".header-search-form");
        $(parent).children(".search-field").toggleClass("is-hidden");
        $(parent).children(".search-overlay").toggleClass("is-hidden");
        $(parent).find(".search-label").toggleClass("is-hidden");
        $(parent).toggleClass("is-active");
        $('.header-bottom').toggleClass("search-active");


        // Focus
        // $(parent).children(".search-field").focus();
        setTimeout(function() {
            $(parent).children(".search-field").focus();
        });
    });
})(jQuery);