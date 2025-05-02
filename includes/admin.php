<?php

// create admin menus
add_action( 'admin_menu', 'no_speakout2sendy_create_menus' );

function no_speakout2sendy_create_menus() {
	// load sidebar menus
	$petitions = array(
		'page_title' => __( 'SpeakOut!2Sendy', 'no_speakout2sendy' ),
		'menu_title' => __( 'SpeakOut!2Sendy', 'no_speakout2sendy' ),
		'capability' => 'manage_options',
		'menu_slug'  => 'no_speakout2sendy_top',
		'function'   => 'no_speakout2sendy_syncjobs_page',
		'icon_url'   => 'dashicons-megaphone'
	);
	$petitions_page = add_menu_page( $petitions['page_title'], $petitions['menu_title'], $petitions['capability'], $petitions['menu_slug'], $petitions['function'], $petitions['icon_url'] );

	$syncjobs = array(
	    'parent_slug' => 'no_speakout2sendy_top',
		'page_title' => __( 'SpeakOut!2Sendy', 'no_speakout2sendy' ),
		'menu_title' => __( 'Sync Jobs', 'no_speakout2sendy' ),
		'capability' => 'manage_options',
		'menu_slug'  => 'no_speakout2sendy_top',
		'function'   => 'no_speakout2sendy_syncjobs_page',
		'position'  => 1
	);
	$petition_page = add_submenu_page( $syncjobs['parent_slug'], $syncjobs['page_title'], $syncjobs['menu_title'], $syncjobs['capability'], $syncjobs['menu_slug'], $syncjobs['function'] );

	$addnewsyncjob = array(
		'parent_slug' => 'no_speakout2sendy_top',
		'page_title'  => 'New Syncjob',
		'menu_title'  => 'New Syncjob',
		'capability'  => 'manage_options',
		'menu_slug'   => 'no_speakout2sendy_addnewsyncjob',
		'function'    => 'no_speakout2sendy_addnewsyncjob_page',
		'position'  => 2
	);
	$addnewsyncjob_page = add_submenu_page( $addnewsyncjob['parent_slug'], $addnewsyncjob['page_title'], $addnewsyncjob['menu_title'], $addnewsyncjob['capability'], $addnewsyncjob['menu_slug'], $addnewsyncjob['function'] );

	$sendylists = array(
		'parent_slug' => 'no_speakout2sendy_top',
		'page_title'  => __( 'Sendy Lists', 'no_speakout2sendy' ),
		'menu_title'  => __( 'Sendy Lists', 'no_speakout2sendy' ),
		'capability'  => 'manage_options',
		'menu_slug'   => 'no_speakout2sendy_sendylists',
		'function'    => 'no_speakout2sendy_sendylists_page',
		'position'  => 3
	);
	$sendylists_page = add_submenu_page( $sendylists['parent_slug'], $sendylists['page_title'], $sendylists['menu_title'], $sendylists['capability'], $sendylists['menu_slug'], $sendylists['function']);

	$addnewsendylist = array(
		'parent_slug' => 'no_speakout2sendy_top',
		'page_title'  => __( 'New Sendy List', 'no_speakout2sendy' ),
		'menu_title'  => __( 'New Sendy List', 'no_speakout2sendy' ),
		'capability'  => 'manage_options',
		'menu_slug'   => 'no_speakout2sendy_addnewsendylist',
		'function'    => 'no_speakout2sendy_addnewsendylist_page',
		'position'  => 3
	);
	$addnewsendylist_page = add_submenu_page( $addnewsendylist['parent_slug'], $addnewsendylist['page_title'], $addnewsendylist['menu_title'], $addnewsendylist['capability'], $addnewsendylist['menu_slug'], $addnewsendylist['function']);

	// load contextual help tabs for newer WordPress installs (requires 3.3.1)
	if ( version_compare( get_bloginfo( 'version' ), '3.3', '>' ) == 1 ) {
//		add_action( 'load-' . $addnewsyncjob_page, 'no_speakout2sendy_help_addnew' );
//		add_action( 'load-' . $addnewsendylist_page, 'no_speakout2sendy_help_settings' );
	}
}

// display custom menu icon

add_action( 'admin_head', 'no_speakout2sendy_menu_icon' );

function no_speakout2sendy_menu_icon() {
	echo '
		<style type="text/css">
			#toplevel_page_no_speakout2sendy .wp-menu-image {
				background: url(' . plugins_url( "speakout2sendy/images/icon-speakout2sendy-16.png" ) . ') no-repeat 6px 7px !important;
			}
			body.admin-color-classic #toplevel_page_no_speakout2sendy .wp-menu-image {
				background: url(' . plugins_url( "speakout2sendy/images/icon-speakout2sendy-16.png" ) . ') no-repeat 6px -41px !important;
			}
			#toplevel_page_no_speakout2sendy:hover .wp-menu-image, #toplevel_page_no_speakout2sendy.wp-has-current-submenu .wp-menu-image {
				background-position: 6px -17px !important;
			}
			body.admin-color-classic #toplevel_page_no_speakout2sendy:hover .wp-menu-image, body.admin-color-classic #toplevel_page_no_speakout2sendy.wp-has-current-submenu .wp-menu-image {
				background-position: 6px -17px !important;
			}
		</style>
	';
}

// load JavaScript for use on admin pages
add_action( 'admin_print_scripts', 'no_speakout2sendy_admin_js' );

function no_speakout2sendy_admin_js() {
	global $parent_file, $no_speakout2sendy_version;

	if ( $parent_file == 'no_speakout2sendy_top' ) {
		wp_enqueue_script( 'no_speakout2sendy_admin_js', plugins_url( 'speakout2sendy/js/admin.js' ), array( 'jquery' ) , $no_speakout2sendy_version );
	}
}

// load CSS for use on admin pages
add_action( 'admin_print_styles', 'no_speakout2sendy_admin_css' );

function no_speakout2sendy_admin_css() {
	global $parent_file, $no_speakout2sendy_version ;

	if ( $parent_file == 'no_speakout2sendy_top' ) {
		wp_enqueue_style( 'no_speakout2sendy_admin_css', plugins_url( 'speakout2sendy/css/admin.css' ) ,"", $no_speakout2sendy_version );
	}
}
?>