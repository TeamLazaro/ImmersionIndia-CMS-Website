
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



/*
 *
 * ----- Smooth-scroll to sections
 *
 */
$( document ).on( "click", "a[ href ]", function ( event ) {

	var $anchor = $( event.target ).closest( "a" );
	var domAnchor = $anchor.get( 0 );

	var urlParts = domAnchor.href.split( "#" );
	// If the url has more than one `#`es in it, we're not even going to try
	if ( urlParts.length !== 2 )
		return;

	var path = urlParts[ 0 ];
	var sectionId = urlParts[ 1 ];

	// If the path does not match that of the current page
	if ( path !== window.location.href )
		return;

	// If the section id is empty or a stub
	if ( ! sectionId.trim() || sectionId === "0" )
		return;

	// Prevent default behaviour
	event.preventDefault();
	event.stopPropagation();
	event.stopImmediatePropagation();

	// Close the navigation menu
	closeNavigationMenu();

	smoothScrollTo( sectionId );

	return false;

} );













} );
