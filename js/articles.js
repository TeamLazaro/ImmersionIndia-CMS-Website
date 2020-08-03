
/*
 *
 * ----- Posts (Articles)
 *
 */

$( function () {

	/*
	 * ----- Filter the posts on interacting with the filter
	 */
	var $allPosts = $( ".js_post" );
	var domFilters = Array.prototype.slice.call( $( ".js_post_filter" ) );
	$( document ).on( "change", ".js_post_filter", function ( event ) {

		// Get the selected filters
			// If _none_ are selected, then treat that as if **all were selected**
		var selectedDOMFilters = domFilters.filter( function ( domFilter ) { return domFilter.checked } )
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
