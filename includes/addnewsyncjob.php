<?php

// page used for creating new syncjobs
// and for editing existing syncjobs
function no_speakout2sendy_addnewsyncjob_page() {
	// check security: ensure user has authority
	if ( ! current_user_can( 'publish_posts' ) ) wp_die( 'Insufficient privileges: You need to be an editor to do that.' );

	include_once('class.syncjob.php');
	include_once('class.petition.php');
	include_once('class.sendylist.php');
	$syncjob     = new no_speakout2sendy_syncjob();
	$sendylist   = new no_speakout2sendy_sendylist();
	$petition    = new no_speakout2sendy_Petition();

	$action       = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
	$syncjob->id = isset( $_REQUEST['id'] ) ? absint( $_REQUEST['id'] ) : '';

	$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
	
	switch( $action ) {
		// add a new syncjob to database
		// then display form for editing the new syncjob
		case 'create' :
			// security: ensure user has intention
			check_admin_referer( 'no_speakout2sendy-create_syncjob' );

			$syncjob->populate_from_post();
			$syncjob->create();

			// set up page display variables
			$page_title  = 'Edit Syncjob';
			$nonce       = 'no_speakout2sendy-update_syncjob' . $syncjob->id;
			$action      = 'update';
			$button_text = 'Update Syncjob';

			// construct update message box content 
		
			$message_update = 'Syncjob created. Name: ' . $syncjob->name;

			break;

		// 'edit' is only called from text links on the Syncjob page
		// displays existing syncjob for alteration and submits with 'update' action
		case 'edit' :
			// security: ensure user has intention
			check_admin_referer( '	' . $syncjob->id );

			$syncjob->retrieve( $syncjob->id );

			// set up page display variables
			$page_title     = 'Edit Syncjob';
			$nonce          = 'no_speakout2sendy-update_syncjob' . $syncjob->id;
			$action         = 'update';
			$button_text    = 'Update Syncjob';
			$message_update = '';

			break;

		// alter an existing syncjob
		case 'update' :
			// security: ensure user has intention
			check_admin_referer( 'no_speakout2sendy-update_syncjob' . $syncjob->id );

			$syncjob->populate_from_post();
			$syncjob->update( $syncjob->id );

			// set up page display variables
			$page_title     = 'Edit New Syncjob';
			$nonce          = 'no_speakout2sendy-update_syncjob' . $syncjob->id;
			$action         = 'update';
			$button_text    = 'Update Syncjob';
			$message_update = 'Syncjob  '. $syncjob->id . ' updated.';

			break;

		// show blank form for adding a new petition
		default :
			// set up page display variables
			$page_title     = 'Add New Syncjob';
			$nonce          = 'no_speakout2sendy-create_syncjob';
			$action         = 'create';
			$button_text    = 'Create Syncjob';
			$message_update = '';
	}

	// get list of petitions to populate select box navigation
	$petitions_list = $petition->quicklist(); 
	$sendylist_list = $sendylist->quicklist();

	// display the form
	include_once( 'addnewsyncjob.view.php' );
}

?>