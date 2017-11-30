/**
 * JavaScript for Posts
 */

(function($) {

    var highlights = $(".entry-highlights");
    if ( highlights.length ) {
        highlights.on("click", function() {
            $(".entry-highlights-content").slideToggle();
            $(".entry-highlights i").toggleClass('rotated');
        })
    }
    
})(jQuery);