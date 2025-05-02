<?php

// plugin installation routine

function no_speakout2sendy_install() {

global $wpdb, $db_petitions, $db_syncjobs, $db_sendylists, $no_speakout2sendy_version;

	$sql_create_tables = "
		CREATE TABLE `$db_syncjobs` (
			`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(200) CHARACTER SET utf8 NOT NULL,
			`wp_speakout_petitions_id` BIGINT(20) NOT NULL,
			`sendylist_id` BIGINT(20) NOT NULL,
			`use_opt_in` CHAR(1) BINARY NOT NULL DEFAULT '0',
			`last_sync` DATETIME DEFAULT NULL, 
			`created_date` DATETIME NOT NULL,
			UNIQUE KEY (`id`)
		);

		CREATE TABLE `$db_sendylists` (
			`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`apikey` VARCHAR(200) CHARACTER SET utf8 NOT NULL,
			`name` VARCHAR(200) CHARACTER SET utf8 NOT NULL,
			`list` VARCHAR(200) CHARACTER SET utf8 NOT NULL,
			`created_date` DATETIME NOT NULL,
			UNIQUE KEY (`id`)
		);";

	// create database tables

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	dbDelta( $sql_create_tables );

	// add plugin options to wp_options table
	add_option( 'no_speakout2sendy_version', $no_speakout2sendy_version );
}

// initial install
if( !get_option('no_speakout2sendy_version')) {
	no_speakout2sendy_install();
}
	
// run plugin update script if needed
add_action( 'plugins_loaded', 'no_speakout2sendy_update' );

function no_speakout2sendy_update() {

	global $wpdb, $db_syncjobs, $db_sendylists, $no_speakout2sendy_version;
	$installed_version = get_option( 'no_speakout2sendy_version' );
	$options           = get_option( 'no_speakout2sendy_options' );

    ///////////////////////////////////////////////
    //   update previous installs
    ////////////////////////////////////////////////
    
}

?>