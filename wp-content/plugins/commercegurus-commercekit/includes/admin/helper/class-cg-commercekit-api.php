<?php
/**
 *
 * Admin Helper API
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CG_Commercekit_API Class
 *
 * Provides a communication interface with the commercegurus.com API.
 */
class CG_Commercekit_API {

	/**
	 * Api_base.
	 *
	 * @var $api_base.
	 */
	public static $api_base;

	/**
	 * Load
	 *
	 * Allow devs to point the API base to a local API development or staging server.
	 * Note that sslverify will be turned off for the woocommerce.dev + WP_DEBUG combination.
	 * The URL can be changed on plugins_loaded before priority 10.
	 */
	public static function load() {
		self::$api_base = apply_filters( 'commercegurus_commercekit_api_base', 'https://www.commercegurus.com/wp-json/cgsubs/v2' );
	}

	/**
	 * Perform an HTTP request to the Helper API.
	 *
	 * @param string $endpoint The endpoint to request.
	 * @param array  $args Additional data for the request. Set authenticated to a truthy value to enable auth.
	 *
	 * @return array|WP_Error The response from wp_safe_remote_request()
	 */
	public static function request( $endpoint, $args = array() ) {
		$url = self::url( $endpoint );

		/**
		 * Allow developers to filter the request args passed to wp_safe_remote_request().
		 * Useful to remove sslverify when working on a local api dev environment.
		 */
		$args = apply_filters( 'commercegurus_commercekit_api_request_args', $args, $endpoint );

		// error_log( print_r( $url, true ) );
		// error_log( 'request args is....' );
		// error_log( print_r( $args, true ) );
		// TODO: Check response signatures on certain endpoints.
		return wp_safe_remote_request( $url, $args );
	}

	/**
	 * Wrapper for self::request().
	 *
	 * @param string $endpoint The helper API endpoint to request.
	 * @param array  $args Arguments passed to wp_remote_request().
	 *
	 * @return array The response object from wp_safe_remote_request().
	 */
	public static function get( $endpoint, $args = array() ) {
		$args['method'] = 'GET';
		return self::request( $endpoint, $args );
	}

	/**
	 * Wrapper for self::request().
	 *
	 * @param string $endpoint The helper API endpoint to request.
	 * @param array  $args Arguments passed to wp_remote_request().
	 *
	 * @return array The response object from wp_safe_remote_request().
	 */
	public static function post( $endpoint, $args = array() ) {
		$args['method'] = 'POST';
		return self::request( $endpoint, $args );
	}

	/**
	 * Using the API base, form a request URL from a given endpoint.
	 *
	 * @param string $endpoint The endpoint to request.
	 *
	 * @return string The absolute endpoint URL.
	 */
	public static function url( $endpoint ) {
		$endpoint = ltrim( $endpoint, '/' );
		$endpoint = sprintf( '%s/%s', self::$api_base, $endpoint );
		$endpoint = esc_url_raw( $endpoint );
		return $endpoint;
	}


}

CG_Commercekit_API::load();
