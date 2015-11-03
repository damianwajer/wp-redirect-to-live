<?php
/**
 * Plugin Name: WP Redirect to Live
 * Version: 1.1.0
 * Author: Damian Wajer
 * Description: Redirect not logged in users to live instance of the website or show them the message.
 * License: GPL2
 */

defined( 'ABSPATH' ) or die( "Access denied!" );

function wp_redirect_to_live() {

	if ( defined( 'WP_REDIRECT_TO_LIVE' )
	     && ! is_admin()
	     && $GLOBALS['pagenow'] != 'wp-login.php'
	     && ! is_user_logged_in()
	     && ! defined( 'DOING_CRON' )
	) {

		if ( WP_REDIRECT_TO_LIVE == '404' ) {
			header( 'HTTP/1.0 404 Not Found' );
			echo 'You have to be logged in to see this page.';
			exit;
		} elseif ( WP_REDIRECT_TO_LIVE == 'noindex' ) {
			// disallow indexing of the site
			add_action('pre_option_blog_public', '__return_zero');
		} elseif ( WP_REDIRECT_TO_LIVE != false ) {
			header( 'Cache-Control: no-cache, no-store, must-revalidate' ); // HTTP 1.1.
			header( 'Pragma: no-cache' ); // HTTP 1.0.
			header( 'Expires: 0' ); // Proxies.

			header( 'Location: ' . esc_url( untrailingslashit( WP_REDIRECT_TO_LIVE ) . $_SERVER['REQUEST_URI'] ), true, 301 );
			exit;
		}

	}

}

add_action( 'template_redirect', 'wp_redirect_to_live' );
