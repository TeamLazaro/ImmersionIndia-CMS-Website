
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
 * If the URL has a hash value,
 * 	smooth-scroll to that section
 *	and restore the hash to the URL
 *
 */
// The hash was removed but cached in this variable
if ( window.__BFS.scrollTo ) {
	if ( window.scrollY < 1 )
		smoothScrollTo( window.__BFS.scrollTo );
	var fullURL = location.origin + location.pathname + location.search + window.__BFS.scrollTo;
	window.history.replaceState( { }, "", fullURL )
}



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



/*
 *
 * When scrolling through the page, communicate with GTM if the user is viewing a section for longer than a threshold amount of time
 *
 */
var intervalToCheckForEngagement = 250;
var thresholdTimeForEngagement = 2000;
var timeSpentOnASection = 0;
window.__BFS.engagementIntervalCheck = null;	// this is set later

var thingsToDoOnEveryInterval = function () {

	var $window = $( window );
	var currentScrollTop;
	var previousScrollTop;
	var $currentSection;
	var currentSectionName;
		var currentSectionId;
		var currentSectionDOMId;
	var previousSectionName;
	var sectionScrollTop;
	var $currentNavItem;
	var lastRecordedSection;

	// Get all the sections in the reverse order
	var $sections = Array.prototype.slice.call( $( "[ data-section-slug ]" ) )
					.filter( function ( domSection ) {
						return ! $( domSection ).hasClass( "hidden" );
					} )
					.reverse()
					.map( function ( el ) { return $( el ) } );

	return function thingsToDoOnEveryInterval () {

		var viewportHeight = $window.height();
		currentScrollTop = window.scrollY || document.body.scrollTop;
		$currentSection = null;
		currentSectionName = null;

		// Determine the section being viewed
		var _i
		for ( _i = 0; _i < $sections.length; _i += 1 ) {
			$currentSection = $sections[ _i ];
			sectionScrollTop = $currentSection.position().top;
			if (
				( currentScrollTop >= sectionScrollTop - viewportHeight / 2 )
				&&
				( currentScrollTop <= sectionScrollTop + $currentSection.height() + viewportHeight / 2 )
			) {
				currentSectionName = $currentSection.data( "section-title" );
				currentSectionId = $currentSection.data( "section-slug" );
				break;
			}
		}

		/*
		 * If the previous and the current section are the same, then add time
		 * Else, reset the "time spent on a section" counter
		 */
		if ( currentSectionId && currentSectionName == previousSectionName ) {
			timeSpentOnASection += intervalToCheckForEngagement
			if ( timeSpentOnASection >= thresholdTimeForEngagement ) {
				if ( currentSectionName != lastRecordedSection ) {
					window.__BFS.gtmPushToDataLayer( {
						event: "section-view",
						currentSectionId: currentSectionId,
						currentSectionName: currentSectionName
					} );
					lastRecordedSection = currentSectionName;
				}
			}
		}
		else {
			timeSpentOnASection = 0
		}

		previousScrollTop = currentScrollTop;
		previousSectionName = currentSectionName;

	};

}();


window.__BFS.engagementIntervalCheck = executeEvery(
	intervalToCheckForEngagement / 1000,
	thingsToDoOnEveryInterval
);
window.__BFS.engagementIntervalCheck.start();











} );
