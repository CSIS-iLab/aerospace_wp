/**
 * JavaScript for Aerospace101 Archive
 */

(function($) {
	var seeMore = $(".filter-sidebar-list-showmore");
	if ( seeMore.length ) {
        seeMore.on("click", function() {
        	$(this).children("span").toggleClass("is-hidden");
        	$(".filter-sidebar-list .below-display-limit").toggleClass('is-hidden');
        })
    }
})(jQuery);