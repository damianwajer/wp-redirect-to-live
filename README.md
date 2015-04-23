WP Redirect to Live
====================

WP Redirect to Live is simple plugin to redirect not logged in users to another URL.   
For example you can disable access to beta instance and redirect all not logged in users to live site or you can just use it when you migrate with your website to another domain.

## Installation
You can install WP Redirect to Live using the built in WordPress plugin installer or from this repository.

## Usage
This version of the plugin is very simple implementation of the idea and it's meant to be used by developers.   
To use it, you have to define constant `WP_REDIRECT_TO_LIVE` in your `wp-config.php` file.

Example:
```
/**
 * Redirect not logged in users to live instance of the website
 *
 * Options:
 * URL (string) - redirect not logged in users to specific URL
 * 404 (string) - return 404 Not Found page
 * false (boolean) - disable the plugin
 */
define( 'WP_REDIRECT_TO_LIVE', 'http://www.example.com' );
```