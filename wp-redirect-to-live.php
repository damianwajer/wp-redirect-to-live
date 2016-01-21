<?php
/**
 * Plugin Name: WP Redirect to Live
 * Version: 1.2.0
 * Author: Damian Wajer
 * Description: Redirect not logged in users to live instance of the website or show them the message.
 * License: GPL2
 */

defined( 'ABSPATH' ) or die( "Access denied!" );

if ( function_exists( 'wp_redirect_to_live' ) ) {
	return;
}

function wp_redirect_to_live() {
	
	// Array with allowed IP addresses
	$allow_access = array(
		'127.0.0.1', // localhost
	);

	if ( ! defined( 'WP_REDIRECT_TO_LIVE' )
	     || in_array( $_SERVER['REMOTE_ADDR'], $allow_access )
	     || is_admin()
	     || $GLOBALS['pagenow'] == 'wp-login.php'
	     || is_user_logged_in()
	     || defined( 'DOING_CRON' )
	) {
		return;
	}

	if ( WP_REDIRECT_TO_LIVE == '404' ) {
		header( 'HTTP/1.0 404 Not Found' );
		echo 'You have to be logged in to see this page.';
		exit;
	} elseif ( WP_REDIRECT_TO_LIVE == 'noindex' ) {
		// disallow indexing of the site
		add_action( 'pre_option_blog_public', '__return_zero' );
	} elseif ( WP_REDIRECT_TO_LIVE != false ) {
		nocache_headers();
		wp_redirect( esc_url_raw( untrailingslashit( WP_REDIRECT_TO_LIVE ) . $_SERVER['REQUEST_URI'] ), 301 );
		exit;
	}

}

add_action( 'template_redirect', 'wp_redirect_to_live' );
