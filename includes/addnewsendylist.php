<?php

// page used for creating new petitions
// and for editing existing petitions
function no_speakout2sendy_addnewsendylist_page() {
	// check security: ensure user has authority
	if ( ! current_user_can( 'publish_posts' ) ) wp_die( 'Insufficient privileges: You need to be an editor to do that.' );

	include_once( 'class.sendylist.php' );
	$sendylist     = new no_speakout2sendy_sendylist();
	$action       = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
	$sendylist->id = isset( $_REQUEST['id'] ) ? absint( $_REQUEST['id'] ) : '';

	$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
	
	switch( $action ) {
		// add a new sendylist to database
		// then display form for editing the new sendylist
		case 'create' :
			// security: ensure user has intention
			check_admin_referer( 'no_speakout2sendy-create_sendylist' );

			$sendylist->populate_from_post();
			$sendylist->create();

			// set up page display variables
			$page_title  = 'Edit Sendylist';
			$nonce       = 'no_speakout2sendy-update_sendylist' . $sendylist->id;
			$action      = 'update';
			$button_text = 'Update Sendylist';

			// construct update message box content 
		
			$message_update = 'Sendylist created. Name: ' . $sendylist->name;

			break;

		// 'edit' is only called from text links on the Email Petitions page
		// displays existing petition for alteration and submits with 'update' action
		case 'edit' :
			// security: ensure user has intention
			check_admin_referer( 'no_speakout2sendy-edit_sendylist' . $sendylist->id );

			$sendylist->retrieve( $sendylist->id );

			// set up page display variables
			$page_title     = 'Edit Sendylist';
			$nonce          = 'no_speakout2sendy-update_sendylist' . $sendylist->id;
			$action         = 'update';
			$button_text    = 'Update Sendylist';
			$message_update = '';

			break;

		// alter an existing petition
		case 'update' :
			// security: ensure user has intention
			check_admin_referer( 'no_speakout2sendy-update_sendylist' . $sendylist->id );

			$sendylist->populate_from_post();
			$sendylist->update( $sendylist->id );

			// set up page display variables
			$page_title     = 'Edit New Sendylist';
			$nonce          = 'no_speakout2sendy-update_sendylist' . $sendylist->id;
			$action         = 'update';
			$button_text    = 'Update Sendylist';
			$message_update = 'Sendylist '. $sendylist->id . ' updated.';

			break;

		// show blank form for adding a new petition
		default :
			// set up page display variables
			$page_title     = 'Add New Sendylist';
			$nonce          = 'no_speakout2sendy-create_sendylist';
			$action         = 'create';
			$button_text    = 'Create Sendylist';
			$message_update = '';
	}

	// display the form
	include_once( 'addnewsendylist.view.php' );
}

?>