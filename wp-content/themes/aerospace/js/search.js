/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function () {
	var form = document.querySelector(".filter-search-container form");
	if (form.addEventListener) {
	    form.addEventListener("submit", function(evt) {
	        evt.preventDefault();
	        updateURL();
	    }, true);
	}
	else {
	    form.attachEvent('onsubmit', function(evt){
	        evt.preventDefault();
	        updateURL();
	    });
	}

	var dropdown = document.getElementById('search-categories');
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			updateURL();
		}
	}
	dropdown.onchange = onCatChange;

	var checkboxes = document.querySelectorAll(".filter-post-types input[name=post_type]");
	var selected_post_types = [];
	checkboxes.forEach(function(checkbox) {
		if ( checkbox.checked ) {
			selected_post_types.push(checkbox.value);
		}

		checkbox.addEventListener( 'change', function() {
		    if(this.checked) {
		        selected_post_types.push(this.value);
		    } else {
		        var index = selected_post_types.indexOf(this.value);
		        if ( index > - 1) {
		        	selected_post_types.splice(index, 1);
		        }
		    }
		    updateURL();
		});
	});

	function updateURL() {
		var search_term = document.querySelector(".filter-search-container input[name='s']").value;
		search_term = '?s=' + search_term;
		
		var category = dropdown.options[dropdown.selectedIndex].value;
		if ( category > 0 ) {
			category = '&cat=' + category;
		} else {
			category = '';
		}

		var post_types = selected_post_types;
		var post_types_url = '';
		post_types.forEach(function(type) {
			post_types_url += '&post_type[]=' + type;
		})

		location.href = search_vars.home_url + search_term + category + post_types_url;
	}

} )();