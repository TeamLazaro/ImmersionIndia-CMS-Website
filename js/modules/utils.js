
/*
 *
 * Wait for the specified number of seconds.
 * This facilitates a Promise or syncrhonous (i.e., using async/await ) style
 * 	of programming
 *
 */
function waitFor ( seconds ) {
	return new Promise( function ( resolve, reject ) {
		setTimeout( function () {
			resolve();
		}, seconds * 1000 );
	} );
}



/*
 *
 * Smooth scroll to a section
 *
 */
function smoothScrollTo ( locationHash ) {

	if ( ! locationHash )
		return;

	var locationId = locationHash.replace( "#", "" );
	var domLocation = document.getElementById( locationId );
	if ( ! domLocation )
		return;

	window.scrollTo( { top: domLocation.offsetTop, behavior: "smooth" } );

}



/*
 *
 * Managerial Hub for "scroll" event handlers
 *
 */
function onScroll ( fn ) {
	// Add the provided function to the queue
	window.__BFS = window.__BFS || { };
	var scrollHandlers = window.__BFS.scrollHandlers = window.__BFS.scrollHandlers || [ ];
	scrollHandlers.push( fn );

	// Set up the scroll event handling mechanism
	if ( scrollHandlers.length === 1 ) {
		var previousScrollY = 0;
		window.addEventListener( "scroll", function ( event ) {
			currentScrollY = window.scrollY || document.body.scrollTop;

			// Call all the registered scroll handlers one after the other, providing useful data
			var _i;
			for ( _i = 0; _i < scrollHandlers.length; _i += 1 )
				scrollHandlers[ _i ].call( {
					currentScrollY: currentScrollY,
					previousScrollY: previousScrollY
				} );

			previousScrollY = currentScrollY;
		}, true );
	}

}
