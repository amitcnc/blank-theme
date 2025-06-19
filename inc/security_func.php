<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'no_generator' ) ) {
	/**
	 * Removes the generator tag with WP version numbers. Hackers will use this to find weak and old WP installs
	 *
	 * @return string
	 */
	function no_generator() {
		return '';
	}
} // endif function_exists( 'no_generator' ).
add_filter( 'the_generator', 'no_generator' );

/*
Clean up wp_head() from unused or unsecure stuff
*/
add_action( 'init', 'wptheme_cleanup' );
function wptheme_cleanup() {
	// Other head tags
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10);

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
	// REST & oEmbed
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	// Emoji support
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	// Comment cookies
	remove_action('set_comment_cookies', 'wp_set_comment_cookies');
}
if ( ! function_exists( 'show_less_login_info' ) ) {
	/**
	 * Show less info to users on failed login for security.
	 * (Will not let a valid username be known.)
	 *
	 * @return string
	 */
	function show_less_login_info() {
		return '<strong>ERROR</strong>: Stop guessing!';
	}
} // endif function_exists( 'show_less_login_info' ).
add_filter( 'login_errors', 'show_less_login_info' );