jQuery( document ).ready( function( $ ) {
	'use strict';

	// auto-focus the title field on add/edit petitions form if empty
	if ( $( '#no-speakout2sendy input#name' ).val() === '' ) {
		$( '#no-speakout2sendy input#name' ).focus();
	}

	/* Add New Sendylist page
	------------------------------------------------------------------- */
	// validate form values before submitting
	$( '#no_speakout2sendy_sendylist_submit' ).click( function() {

		$( '.no-speakout2sendy-error' ).removeClass( 'no-speakout2sendy-error' );

		var errors     = 0,
			name      = $( '#no-speakout2sendy-edit-sendylist #name' ).val(),
			apikey    = $( '#no-speakout2sendy-edit-sendylist #apikey' ).val(),
			list    = $( '#no-speakout2sendy-edit-sendylist #list' ).val();

		// must include name
		if ( name === '') { 	
			$( '#no-speakout2sendy-edit-sendylist #name' ).addClass( 'no-speakout2sendy-error' );
			errors ++;
		}

		// must include apikey
		if ( apikey === '') { 	
			$( '#no-speakout2sendy-edit-sendylist #apikey' ).addClass( 'no-speakout2sendy-error' );
			errors ++;
		}

		// must include list
		if ( list === '') { 	
			$( '#no-speakout2sendy-edit-sendylist #list' ).addClass( 'no-speakout2sendy-error' );
			errors ++;
		}

		// if no errors found, submit the form
		if ( errors === 0 ) {

			$( 'form#no-speakout2sendy-edit-sendylist' ).submit();
		}
		else {
			$( '.no-speakout2sendy-error-msg' ).fadeIn();
		}

		return false;

	});

	// validate form values before submitting
	$( '#no_speakout2sendy_syncjob_submit' ).click( function() {
		$( '.no-speakout2sendy-error' ).removeClass( 'no-speakout2sendy-error' );
		
		var errors     = 0,
			name      = $( '#no-speakout2sendy-edit-syncjob #name' ).val();

		console.log("Name: " + name);
	
		console.log("wp_speakout_petitions_id: " + $( '#no-speakout2sendy-edit-syncjob #wp_speakout_petitions_id' ).val());
		console.log("sendylist_id: " + $( '#no-speakout2sendy-edit-syncjob #sendylist_id' ).val());
		console.log("use_opt_in: " + $( '#no-speakout2sendy-edit-syncjob #use_opt_in' ).val());
		
		
		// must include name
		if ( name === '') { 	
			$( '#no-speakout2sendy-edit-syncjob #name' ).addClass( 'no-speakout2sendy-error' );
			errors ++;
		}

		// if no errors found, submit the form
		if ( errors === 0 ) {

			$( 'form#no-speakout2sendy-edit-syncjob' ).submit();
		}
		else {
			$( '.no-speakout2sendy-error-msg' ).fadeIn();
		}

		return false;

	});

});
