/**
 * JavaScript for Posts
 */

(function($) {
	var breakpoint;

    function highlightsClick() {
    	var highlights = $(".entry-highlights");
    	if ( highlights.length ) {
	        highlights.on("click", function() {
	        	if ( breakpoint == "xsmall" || breakpoint == "small" ) {
	            	$(".entry-highlights-content").slideToggle();
	            	$(".entry-highlights i").toggleClass('rotated');
	            }
	        })
	    }
    }

    highlightsClick();

    $(window).resize(function () {
		breakpoint = getComputedStyle(document.body).getPropertyValue("--breakpoint").replace(/\"/g, '');
	}).resize();
    
})(jQuery);