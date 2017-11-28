/**
 * Adds class to header on scroll & toggles search
 */

(function($) {

    // Add class to header on scroll
    $(window).scroll(function() {
        var currentScroll = $(this).scrollTop();


        var sBrowser, sUsrAg = navigator.userAgent;
        if (currentScroll > 0) {
            $(".site-header").addClass("is-minimal");
            $(".site-content").addClass("is-minimal");

        } else {
            $(".site-header").removeClass("is-minimal");
            $(".site-content").removeClass("is-minimal");
        }

    });

    // Toggle class on search.
    $(".header-search-form .search-label").on("click", function() {
        var parent = $(this).parents(".header-search-form");
        $(parent).children(".search-field").toggleClass("is-hidden");
        $(parent).find(".search-label").toggleClass("is-hidden");
        $(parent).toggleClass("is-active");
        $(".main-navigation .apply").toggleClass("is-shifted");
        $("body").toggleClass("toggled");

        // Focus
        // $(parent).children(".search-field").focus();
        setTimeout(function(){
            $(parent).children(".search-field").focus();
        });
    });

    $(".menu-toggle").on("click", function() {
        if ($(".header-search-form").hasClass("is-active")) {
            $(".header-search-form").removeClass("is-active");
            $(".header-search-form .search-field").addClass("is-hidden");
            $(".main-navigation .apply").removeClass("is-shifted");
        }
    });






})(jQuery);