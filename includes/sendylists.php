<?php

/**
 * Displays the Sepakout2sendy sendylist page
 */
function no_speakout2sendy_sendylists_page() {
	// check security: ensure user has authority
	if ( ! current_user_can( 'publish_posts' ) ) wp_die( 'Insufficient privileges: You need to be an editor to do that.' );

	include_once( 'class.sendylist.php' );
	$the_sendylists = new no_speakout2sendy_sendylist();
	$action        = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
	$id            = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';

	// link URL for "Add New" button in header
	$addnew_url = esc_url( site_url() . '/wp-admin/admin.php?page=no_speakout2sendy_addnewsendylist' );

	switch ( $action ) {

		case 'delete' :
			// security: ensure user has intention
			check_admin_referer( 'no_speakout2sendy-delete_sendylist' . $id );

			// delete the petition and its signatures
			$the_sendylists->delete( $id );

			// get petitions
			$sendylists = $the_sendylists->all();

			// set up page display variables
			$page_title     = 'Sendy lists';
			$count          = $the_sendylists->count();
			$message_update = 'Sendylist deleted.';

			break;

		default :
			// get petitions
			$sendylists = $the_sendylists->all();

			// set up page display variables
			$page_title     = 'Sendy lists';
			$count          = $the_sendylists->count();
			$message_update = '';
	}

	// display the Sendylist table
	include_once( 'sendylists.view.php' );
}

?>