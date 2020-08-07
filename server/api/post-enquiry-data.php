<?php

/* ------------------------------- \
 * Script Bootstrapping
 \-------------------------------- */
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
# * - Request Permissions
header( 'Access-Control-Allow-Origin: *' );
# * - Date and Timezone
date_default_timezone_set( 'Asia/Kolkata' );
# * - Prevent Script Cancellation by Client
ignore_user_abort( true );
# * - Script Timeout
set_time_limit( 0 );



/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );



/* ------------------------------- \
 * Request Parsing
 \-------------------------------- */
# Get JSON as a string
$json = file_get_contents( 'php://input' );
# Convert the JSON string to an object
$error = null;
try {
	$input = json_decode( $json, true );
	if ( empty( $input ) )
		throw new \Exception( "No data provided." );

	$input = $input[ 'data' ];
}
catch ( \Exception $e ) {
	$error = $e->getMessage();
}
if ( ! empty( $error ) ) {
	echo json_encode( [
		'code' => 400,
		'message' => 'Data not provided'
	] );
	exit;
}



/* ------------------------------------- \
 * Data Validation
 \-------------------------------------- */
if ( empty( $input[ 'name' ] ) or empty( $input[ 'emailAddress' ] ) ) {
	echo json_encode( [
		'code' => 400,
		'message' => 'Data not provided'
	] );
	exit;
}



// /* ------------------------------------- \
//  * Pull in the dependencies
//  \-------------------------------------- */
// require_once __DIR__ . '/../../inc/datetime.php';
require_once __DIR__ . '/../google-forms.php';




/* ------------------------------------- \
 * Interpret the data
 \-------------------------------------- */
// $when = CFD\DateTime::getSpreadsheetDateFromISO8601( $input[ 'when' ] );
$nameOfPerson = $input[ 'name' ];
$emailAddress = $input[ 'emailAddress' ];
$phoneNumber = $input[ 'phoneNumber' ] ?? '';
$institution = $input[ 'institution' ] ?? '';
$program = $input[ 'program' ] ?? '';
$date = $input[ 'date' ] ?? '';



/* ------------------------------------- \
 * Ingest the data onto the Spreadsheet
 \-------------------------------------- */
$data = [
	// 'when' => $when,
	'name' => $nameOfPerson,
	'emailAddress' => $emailAddress,
	'phoneNumber' => $phoneNumber,
	'institution' => $institution,
	'program' => $program,
	'date' => $date
];

// Submit data to the spreadsheet
GoogleForms\submitEnquiry( $data );



/* ------------------------------- \
 * Respond back to the client
 \-------------------------------- */
echo json_encode( [
	'code' => 200,
	'message' => 'Enquiry processed successfully.'
] );
