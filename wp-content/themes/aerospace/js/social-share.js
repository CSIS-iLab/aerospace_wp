/**
 * Social Share Component
 * If a component is embedded into a page and has a share functionality, use JS to show the icons on the user's click.
 */

( function( $ ) {
	if($(".share-icon").length) {
		$('.share-icon').on('click', function() {
			$('.share-container').addClass('is-active');
		})
		$('.share-container .icon-close').on('click', function() {
			$('.share-container').removeClass('is-active');
		})
	}

} )( jQuery );
