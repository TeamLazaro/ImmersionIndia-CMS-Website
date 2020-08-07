
/*
 *
 * ----- Posts (Articles)
 *
 */

$( function () {

	/*
	 * ----- Set the default message for post filter status
	 */
	var $filterStatusMessage = $( ".js_post_filter_status_message" );
	$filterStatusMessage.html( $filterStatusMessage.data( "text-initial" ) );

	/*
	 * ----- Filter the posts on interacting with the filter
	 */
	var $allPosts = $( ".js_post" );
	var domFilters = Array.prototype.slice.call( $( ".js_post_filter" ) );
	$( document ).on( "change", ".js_post_filter", function ( event ) {

		var filterStatusMessage;

		// Get the selected filters
			// If _none_ are selected, then treat that as if **all were selected**
		var selectedDOMFilters = domFilters.filter( function ( domFilter ) { return domFilter.checked } )

		// Set the filter status message
		if ( selectedDOMFilters.length === 0 ) {
			filterStatusMessage = $filterStatusMessage.data( "text-initial" );
			$filterStatusMessage.html( filterStatusMessage );
		}
		else {
			filterStatusMessage = selectedDOMFilters
						.map( function ( domFilter ) { return domFilter.value } )
						.map( function ( filterName ) { return filterName[ 0 ].toUpperCase() + filterName.slice( 1 ) } )
						.join( ", " )
			$filterStatusMessage.html( "Filtered by: <b>" + filterStatusMessage + "</b>" );
		}


		if ( selectedDOMFilters.length === 0 )
			selectedDOMFilters = domFilters;

		var selectedFilters = selectedDOMFilters.map( function ( domFilter ) { return domFilter.value } );

		var filterSelector = selectedFilters
			.map( function ( filter ) {
				return "[ data-category = '" + filter + "' ]"
			} )
			.join( ", " )

		// Hide all the posts, then show the one that match the filter
		$allPosts.hide();
		$allPosts.filter( filterSelector ).show();

	} );

} );
