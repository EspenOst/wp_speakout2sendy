<?php
/*
Plugin Name: SpeakOut!2Sendy
Plugin URI: N/A
Description: Plugin to sync email adresses from SpeakOut petitions to Sendy newsletter system.
Version: 1.0.0.1
Author: Espen Østrem
License: GPLv2 or later
Text Domain: no_speakout2sendy
*/

global $wpdb, $db_petitions, $db_syncjobs, $db_sendylists, $no_speakout2sendy_version;
$db_petitions  = $wpdb->prefix . 'dk_speakout_petitions';
$db_signatures = $wpdb->prefix . 'dk_speakout_signatures';
$db_syncjobs   = $wpdb->prefix . 'no_speakout2sendy_syncjobs';
$db_sendylists = $wpdb->prefix . 'no_speakout2sendy_sendylists';
$no_speakout2sendy_version = '1.0.0.1';

// load admin functions only on admin pages
if (is_admin()) {
	include_once( dirname( __FILE__ ) . '/includes/install.php' );
	include_once(dirname(__FILE__) . '/includes/admin.php');
	include_once(dirname(__FILE__) . '/includes/syncjobs.php');
	include_once(dirname(__FILE__) . '/includes/addnewsyncjob.php');
	include_once(dirname(__FILE__) . '/includes/sendylists.php');
	include_once( dirname( __FILE__ ) . '/includes/addnewsendylist.php' );

	// enable plugin activation
	register_activation_hook(__FILE__, 'no_speakout2sendy_install');
}
// public pages
else {
	// add public pages here
}

// load the widget (admin and public)
include_once(dirname(__FILE__) . '/includes/widget.php');

// add Support and Donate links to the Plugins page
add_filter('plugin_row_meta', 'no_speakout2sendy_meta_links', 10, 2);
function no_speakout2sendy_meta_links($links, $file)
{
	$plugin = plugin_basename(__FILE__);

	// create link
	if ($file == $plugin) {
		return array_merge(
			$links,
			array(
				sprintf('<a href="https://wordpress.org/support/plugin/speakout2sendy/">%s</a>', 'Support'),
				sprintf('<a href="https://www.paypal.com/donate?hosted_button_id=E5KGPP8CDHK6U">%s</a>', 'Please donate if this plugin is useful.')
			)
		);
	}

	return $links;
}
