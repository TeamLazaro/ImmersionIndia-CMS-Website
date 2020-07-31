
$( function () {

	var $allPrograms = $( ".js_program" );
	$( document ).on( "change", ".js_program_filter", function ( event ) {
		var programType = $( event.target ).val()
		$allPrograms.filter( ":not( [ data-program-type = '" + programType + "' ] )" ).hide()
		$allPrograms.filter( "[ data-program-type = '" + programType + "' ]" ).show()
	} );

} );
