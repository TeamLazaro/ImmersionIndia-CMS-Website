
$( function () {









/*
 *
 * ----- Helper references and functions
 *
 */
var $navigationMenuOpenTriggerRegion = $( ".js_nav_open_trigger" );
function stickNavigationMenuOpenButton () {
	$navigationMenuOpenTriggerRegion.addClass( "fixed" );
}
function unstickNavigationMenuOpenButton () {
	$navigationMenuOpenTriggerRegion.removeClass( "fixed" );
}
function openNavigationMenu () {
	$( document.body ).addClass( "open-navigation" );
}
function closeNavigationMenu () {
	$( document.body ).removeClass( "open-navigation" );
}

var $stickyMarker = $( ".js_sticky_marker" );





/*
 *
 * ----- Navigation Toggle
 *
 */
// Opening
$( document ).on( "click", ".js_nav_open", function ( event ) {
	openNavigationMenu();
} );
// Closing
$( document ).on( "click", ".js_nav_close", function ( event ) {
	closeNavigationMenu();
} );



/*
 *
 * ----- Navigation Menu Open Button (Un-)Sticking
 *
 */
function showOrHideNavigationMenuButton () {
	if ( this.currentScrollY > $stickyMarker.height() )
		stickNavigationMenuOpenButton();
	else
		unstickNavigationMenuOpenButton();
}
onScroll( showOrHideNavigationMenuButton );













} );
