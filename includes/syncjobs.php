<?php

function no_speakout2sendy_syncjobs_page() {
	// check security: ensure user has authority
	if ( ! current_user_can( 'publish_posts' ) ) wp_die( 'Insufficient privileges: You need to be an editor to do that.' );

	include_once('class.syncjob.php');
	include_once('class.signature.php');
	include_once('class.sendylist.php');
	include_once('sendToSendy.php');
	$the_syncjobs  = new no_speakout2sendy_syncjob();
	$the_signature = new no_speakout2sendy_signature();
	$the_sendylist = new no_speakout2sendy_sendylist();
	$sendyToSendy = new no_speakout2sendy_sendToSendy();

	$action        = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
	$id            = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';

	// link URL for "Add New" button in header
	$addnew_url = esc_url( site_url() . '/wp-admin/admin.php?page=no_speakout2sendy_addnewsyncjob' );

	switch ( $action ) {

		case 'delete' :
			// security: ensure user has intention
			check_admin_referer( 'no_speakout2sendy-delete_syncjob' . $id );

			// delete the syncjob and its signatures
			$the_syncjobs->delete( $id );

			// get syncjobs
			$syncjobs = $the_syncjobs->all();

			// set up page display variables
			$page_title     = 'Syncjobs';
			$count          = $the_syncjobs->count();
			$message_update = 'Syncjob deleted.';

		break;

		case 'run':
			// run the syncjob
			check_admin_referer( 'no_speakout2sendy-run_syncjob' . $id );

			// get current time
			$current_time = current_time( 'mysql', 0 );

			// get the syncjob
			$syncjob = $the_syncjobs->get($id);

			// get the sendylist
			$sendylist = $the_sendylist->get($syncjob->sendylist_id);

			// get signatures from petition
			$signatures = $the_signature->getList($syncjob->wp_speakout_petitions_id, $syncjob->last_sync, $syncjob->use_opt_in);

			foreach($signatures as $signature)
			{
				$sendyToSendy->send($sendylist, $signature);
			}

			// set last_sync
			$the_syncjobs->setLastSync($id, $current_time);

			// get syncjobs
			$syncjobs = $the_syncjobs->all();

			// set up page display variables
			$page_title     = 'Executed Syncjobs';
			$count          = $the_syncjobs->count();
			$message_update = 'Syncjob executed. ' . count($signatures) . ' signatures sendt to ' . $syncjob->name;

		break;

		default :
			// get syncjobs
			$syncjobs = $the_syncjobs->all();

			// set up page display variables
			$page_title     = 'Syncjobs';
			$count          = $the_syncjobs->count();
			$message_update = '';
	}

	// display the syncjobs table
	include_once( 'syncjobs.view.php' );

}

?>