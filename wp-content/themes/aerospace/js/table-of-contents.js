(function($) {
	// Create Table of Contents
	var counter = 0;
	$(".toc-link").each(function() {
		var text = $(this).text();
		var ID = $(this).attr('id');
		var hash;

		if(ID) {
			hash = ID;
		}
		else {
			hash = "toc-"+counter;
			//Add ID to element
			$(this).attr('id', hash);
		}

		var linkClass = '';
		if(counter == 0) {
			linkClass = ' class="isActive"';
		}

		// Add to Table of Contents
		var listItem = '<li><a href="#'+hash+'" id="link-'+hash+'"'+linkClass+'>'+text+'</a></li>';
		$(".toc-list").append(listItem);

		// Increase Counter
		counter++;
	});

	// Active Table of Contents Link on click
	$(".toc-list").on("click", "li a", function() {
		$(".toc-list a.isActive").removeClass("isActive");
		$(this).addClass("isActive currentScroll");
	})

	// Active Table of Contents Link on scroll
	var $sections = $('.toc-link');

	$(window).scroll(function(){
		var currentScroll = $(this).scrollTop();
		var currentSection = 'toc-0';

		$sections.each(function(){   
			var headingPosition = $(this).offset().top;
			var headerHeight = parseInt($(".site-header").css("top"));
      		var sectionHeading = headingPosition - headerHeight;
		  
		  	// Switch active table of content link based on which section the user is in. However, don't run this if the user clicked on a link to prevent the scroll classes from overriding the clicked classes
			if( sectionHeading - 1 < currentScroll && !$(".toc-list a").hasClass('currentScroll') ){
		    	currentSection = $(this).attr('id');

				$('.toc-list a').not('#link-'+currentSection).removeClass('isActive');
				$("#link-"+currentSection).addClass('isActive');
			}
		});
	});
	
	// Toggle TOC
	$(".toc-menu-link").on('click', function() {
		if ( $(".share-container").hasClass("is-active") ) {
			$(".share-container").removeClass('is-active');
		}
		$(this).toggleClass('isExpanded');
		$(this).siblings('.toc-list').toggleClass('isActive');
	})

	// Close menu if user clicks outside of the menu container element and the menu is open
	$(document).click(function(event) { 
	  if(!$(event.target).closest('.toc-menu-link').length) {
	      if($('.toc-menu-link').hasClass('isExpanded')) {
	        // Close Jump to Menu
			$(".toc-menu-link").removeClass("isExpanded");
			$(".toc-menu-link").siblings('.toc-list').removeClass('isActive');
	      }
	  }        
	});

})(jQuery);