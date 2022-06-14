/**
 * Data Repository: Controls dataTables plugin and other functionality for switching layouts
 */

( function( $ ) {
	var table = $('#dataRepo').DataTable({
		"info": false,
		"lengthChange": false,
		"order": [[ 2, "desc" ]],
		"paging": true,
		"pageLength": 10,
		"pagingType": "simple_numbers",
		"language": {
			"paginate": {
				"previous": '<i class="icon-arrow-left"></i>',
				"next": '<i class="icon-arrow-right"></i>'
			}
		},
		"initComplete": function(settings, json) {
		    $("article, #dataRepo, .archive-pages-bottom .archives-meta-right").toggleClass("is-hidden");
		  }
	});

	// Sort
	$(".tableSort").click(function() {
		var col = $(this).attr("data-sortCol");

		if ( col == 2 ) {
			var direction = 'desc';
		} else {
			var direction = 'asc';
		}

		table.order([col, direction]).draw();
		$(".tableSort").not(this).removeClass("active");
		$(this).addClass("active");
	});

	// Filter by Category & Tag
	$(".search-categories").on( 'change', function () {
		var val = $.fn.dataTable.util.escapeRegex(
			$(this).val()
		);
		table
			.column(3)
			.search( val ? val : '', true, false )
			.draw();
	} );

	$(".search-tags").on( 'change', function () {
		var val = $.fn.dataTable.util.escapeRegex(
			$(this).val()
		);
		table
			.column(4)
			.search( val ? val : '', true, false )
			.draw();
	} );

	// Search
	$('#dataSearch').on( 'keyup click', function () {
			table.search(
				$('#dataSearch').val()
		).draw();
	} );

} )( jQuery );
