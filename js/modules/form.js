
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



	} );





} );
