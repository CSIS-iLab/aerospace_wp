/**
 * Adds class to header on scroll & toggles search
 */

(function($) {

    // Add class to header on scroll
    $(window).scroll(function() {
        var currentScroll = $(this).scrollTop();


        var sBrowser, sUsrAg = navigator.userAgent;
        var headerChange = parseInt($(".header-top").css('height'));
        console.log(headerChange);
        if (currentScroll > headerChange) {
           // $(".site-header").addClass("is-minimal");
           // $(".site-content").addClass("is-minimal");
            $(".header-bottom-container").addClass("is-sticky");
        } else {
           // $(".site-header").removeClass("is-minimal");
            //$(".site-content").removeClass("is-minimal");
            $(".header-bottom-container").removeClass("is-sticky");

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