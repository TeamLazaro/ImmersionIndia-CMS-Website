
$( function () {





/*
 * ----- the Form class
 */
function BFSForm ( className ) {

	/*
	 * ----- Get a reference to the form
	 */
	if ( ! className )
		throw new Error( "Form class name not provided." );
	var domForms = document.getElementsByClassName( className );
	if ( ! domForms.length )
		throw new Error( "Form could not be found." );
	this.domForm = domForms[ 0 ];

	this.fields = { };

}
BFSForm.getErrorResponse = function getErrorResponse () {
	var code = -1;
	var message;
	if ( jqXHR.responseJSON ) {
		code = jqXHR.responseJSON.code || jqXHR.responseJSON.statusCode;
		message = jqXHR.responseJSON.message;
	}
	else if ( typeof e == "object" ) {
		message = e.stack;
	}
	else {
		message = jqXHR.responseText;
	}
	var error = new Error( message );
	error.code = code;
	return error;
}
BFSForm.prototype.disable = function disable ( fn ) {
	$( this.domForm ).find( "input, select, button" ).prop( "disabled", true );
	if ( Object.prototype.toString.call( fn ).toLowerCase() === "[object function]" )
		fn.call( this );
};
BFSForm.prototype.enable = function enable ( fn ) {
	$( this.domForm ).find( "input, select, button" ).prop( "disabled", false );
	if ( Object.prototype.toString.call( fn ).toLowerCase() === "[object function]" )
		fn.call( this );
};
BFSForm.prototype.giveFeedback = function giveFeedback ( message ) {
	$( this.domForm ).find( "[ type = 'submit' ]" ).text( message );
}

BFSForm.prototype.getFieldValue = function getFieldValue ( domField ) {
	// var elementTag = domField.nodeName.toLowerCase();
	// var inputType;
	// if ( elementTag === "input" )
	// 	inputType = domField.getAttribute( "type" );
	return domField.value;
}

BFSForm.prototype.addField = function addField ( name, isRequired, domFields, fn ) {
	if ( ! Array.isArray( domFields ) )
		domFields = [ domFields ];
	this.fields[ name ] = {
		domFields: domFields,
		validateAndAssemble: fn,
		isRequired: isRequired
	};
};

BFSForm.prototype.getData = function getData () {
	this.data = { };
	var _key;
	for ( _key in this.fields ) {
		var field = this.fields[ _key ];
		var valueParts = field.domFields.map( this.getFieldValue );
		var value = field.validateAndAssemble( valueParts, field.isRequired || false );
		this.data[ _key ] = value;
	}
	return this.data;
};





/*
 * ----- Set up the enquiry form
 */
var enquiryForm = new BFSForm( "js_enquiry_form" );
	var domInputName = document.getElementById( "js_form_input_name" );
	var domInputEmail = document.getElementById( "js_form_input_email" );
	var domInputPhoneNumber = document.getElementById( "js_form_input_phone" );
	var domInputInstitution = document.getElementById( "js_form_input_institution" );
	var domInputProgram = document.getElementById( "js_form_input_program" );
	var domInputDate = document.getElementById( "js_form_input_date" );

// Set up the enquiry form's input fields, data validators and data assemblers
	// Name
enquiryForm.addField( "name", true, domInputName, function ( values, isRequired ) {
	var name = values[ 0 ].trim();

	if ( isRequired )
		if ( name === "" )
			throw new Error( "Please provide your name." );

	if ( name.match( /\d/ ) )
		throw new Error( "Please provide a valid name." );

	return name;
} );

	// Email address
enquiryForm.addField( "emailAddress", true, domInputEmail, function ( values, isRequired ) {
	var emailAddress = values[ 0 ].trim();

	if ( isRequired )
		if ( emailAddress === "" )
			throw new Error( "Please provide your email address." );

	if ( emailAddress.indexOf( "@" ) === -1 )
		throw new Error( "Please provide a valid email address." );

	return emailAddress;
} );

	// Phone number
enquiryForm.addField( "phoneNumber", false, domInputPhoneNumber, function ( values ) {
	var phoneNumber = values[ 0 ].trim();

	if ( phoneNumber.length > 1 )
		if ( ! (
			phoneNumber.match( /^\+?\d[\d\-]+\d$/ )	// this is not a perfect regex, but it's close
			&& phoneNumber.replace( /\D/g, "" ).length > 3
		) )
			throw new Error( "Please provide a valid phone number." );

	return phoneNumber;
} );

	// College / University
enquiryForm.addField( "institution", false, domInputInstitution, function ( values ) {
	var institution = values[ 0 ].trim();

	if ( institution.length > 1 )
		if ( institution.replace( /[\d\s]/g ).length < 2 )
			throw new Error( "Please provide a college or university." );

	return institution;
} );

	// Study Program
enquiryForm.addField( "program", false, domInputProgram, function ( values ) {
	var program = values[ 0 ].trim();
	return program;
} );

	// Date
enquiryForm.addField( "date", false, domInputDate, function ( values ) {
	var date = values[ 0 ].trim();
	return date;
} );

enquiryForm.submit = function submit () {

	// var apiEndpoint = __.settings.cupidApiEndpoint;
	var url = "/server/api/post-enquiry-data.php";

	var ajaxRequest = $.ajax( {
		url: url,
		method: "POST",
		data: JSON.stringify( { data: this.data } ),
		contentType: "application/json",
		dataType: "json",
		// xhrFields: {
		// 	withCredentials: true
		// }
	} );

	return new Promise( function ( resolve, reject ) {
		ajaxRequest.done( function ( response ) {
			resolve( response );
		} );
		ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
			var errorResponse = BFSForm.getErrorResponse( jqXHR, textStatus, e );
			reject( errorResponse );
		} );
	} );

}




/*
 * ----- Enquiry Form submission handler
 */
$( document ).on( "submit", ".js_enquiry_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	enquiryForm.disable();

	/*
	 * ----- Provide feedback to the user
	 */
	enquiryForm.giveFeedback( "Sending..." );

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = enquiryForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		return;
	}

	/*
	 * ----- Submit data
	 */
	enquiryForm.submit( data )
		.then( function ( response ) {
			console.log( response )

			/*
			 * ----- Provide further feedback to the user
			 */
			enquiryForm.giveFeedback( "We'll get in touch shortly" );

		} )

} );





} );
