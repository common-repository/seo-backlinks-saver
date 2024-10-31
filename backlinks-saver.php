<?php
/*
Plugin Name: Seo Backlinks Saver
Plugin URI: 
Description: This Plugin is used to all non-existent pages of your site by redirect them to 301 with home page automatically.
Version: 1.0
Author: Infolio
Author URI: http://www.infolio.com.au/
License: GPL2 
*/

// Add action hook:
add_action('wp', 'seo_backlinks_saver', 100);

// Simple function
function seo_backlinks_saver() {
	
	global $wp_query;
	
	if ( $wp_query->is_404 ) {
		
		$root_dir = '/';
		if ( preg_match( '#^http://[^/]+(/.+)$#', get_option( 'siteurl' ), $matches ) ) {
			$root_dir = $matches[1];
		} 
		
		// Make sure it ends with slash
		if ( $root_dir[ strlen($root_dir) - 1 ] != '/' ) {
			$root_dir .= '/';
		}
		
		// Check if request is not for GWT verification file
		if ( strpos( $_SERVER['REQUEST_URI'], $root_dir.'noexist_' ) !== 0 ) {
			wp_redirect( get_bloginfo( 'siteurl' ) , 301 );
			exit();
		}
	}
}

?>