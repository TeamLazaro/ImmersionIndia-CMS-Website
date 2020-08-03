
$( function () {









/*
 *
 * ----- Navigation Toggle
 *
 */
// Opening
$( document ).on( "click", ".js_nav_open", function ( event ) {
	$( document.body ).addClass( "open-navigation" );
} );
// Closing
$( document ).on( "click", ".js_nav_close", function ( event ) {
	$( document.body ).removeClass( "open-navigation" );
} );









} );
