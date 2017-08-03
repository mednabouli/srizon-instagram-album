<?php
/*
Plugin Name: Srizon Instagram Album
Plugin URI: https://www.srizon.com/srizon-instagram-album
Description: This Plugin is designed to show your Instagram photos into your WordPress site. You can also show public photos from other instagram users.
Text Domain: srizon-instagram-album
Domain Path: /languages
Version: 1.0
Author: Afzal
Author URI: https://www.srizon.com/contact
*/

function srizon_instagram_album_load_textdomain() {
	load_plugin_textdomain( 'srizon-instagram-album', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'srizon_instagram_album_load_textdomain' );

require_once 'lib/SrizonInstaDB.php';
require_once 'api/index.php';
// backend files
if ( is_admin() ) {
	require_once 'admin/index.php';
}
else{
	require_once 'site/index.php';
}

register_activation_hook( __FILE__, 'srizon_instagram_activate' );


function srizon_instagram_activate($network_wide) {
	global $wpdb;
	if ( is_multisite() && $network_wide ) {
		$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
		foreach ( $blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			SrizonInstaDB::CreateDBTables();
			restore_current_blog();
		}
	} else {
		SrizonInstaDB::CreateDBTables();
	}
}

function srizon_instagram_get_resource_url( $relativePath ) {
	return plugins_url( $relativePath, plugin_basename( __FILE__ ) );
}


