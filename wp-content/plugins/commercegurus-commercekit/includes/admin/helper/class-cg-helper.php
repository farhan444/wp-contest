<?php
/**
 *
 * Admin Helper
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CG_Helper Class
 *
 * The main entry-point for all things related to the Helper.
 */
class CG_Helper {

	/**
	 * Loads the helper class, runs on init.
	 */
	public static function load() {
		self::includes();
	}

	/**
	 * Include supporting helper classes.
	 */
	protected static function includes() {
		include_once dirname( __FILE__ ) . '/class-cg-commercekit-api.php';
		include_once dirname( __FILE__ ) . '/class-cg-helper-updater.php';
	}

	/**
	 * Get locally installed CommerceGurus themes.
	 */
	public static function get_local_commercegurus_themes() {
		$themes    = wp_get_themes();
		$cg_themes = array();

		foreach ( $themes as $theme ) {

			$header = $theme->get( 'CGMeta' );

			if ( empty( $header ) ) {
				continue;
			}

			list( $product_id, $file_id ) = explode( ':', $header );
			if ( empty( $product_id ) || empty( $file_id ) ) {
				continue;
			}

			$data = array(
				'Name'        => $theme->get( 'Name' ),
				'Version'     => $theme->get( 'Version' ),
				'CGMeta'      => $header,

				'_filename'   => $theme->get_stylesheet() . '/style.css',
				'_stylesheet' => $theme->get_stylesheet(),
				'_product_id' => absint( $product_id ),
				'_file_id'    => $file_id,
				'_type'       => 'theme',
			);

			$cg_themes[ $data['_filename'] ] = $data;
		}

		return $cg_themes;
	}

	/**
	 * Get the connected user's subscriptions.
	 *
	 * @return array
	 */
	public static function get_subscriptions() {
		$cache_key = '_commercegurus_commercekit_subscriptions';
		$data      = get_transient( $cache_key );
		if ( false !== $data ) {
			return $data;
		}

		$request = CG_Commercekit_API::post(
			'subscriptions',
			array(
				'body' => array( 'domain' => self::get_home_url() ),
			)
		);

		if ( wp_remote_retrieve_response_code( $request ) !== 200 ) {
			set_transient( $cache_key, array(), 15 * MINUTE_IN_SECONDS );
			return array();
		}

		$data = json_decode( wp_remote_retrieve_body( $request ), true );
		if ( empty( $data ) || ! is_array( $data ) ) {
			$data = array();
		}

		set_transient( $cache_key, $data, 1 * HOUR_IN_SECONDS );
		return $data;
	}

	/**
	 * Check for whitelisted local/dev/staging domain.
	 *
	 * @return bool True if active subscription found.
	 */
	public static function maybe_whitelisted() {
		$cache_key = '_commercegurus_commercekit_domainauth';
		$data      = get_transient( $cache_key );
		if ( false !== $data ) {
			return $data;
		}
		$request = CG_Commercekit_API::post(
			'domainauth',
			array(
				'body' => array( 'domain' => self::get_home_url() ),
			)
		);

		if ( wp_remote_retrieve_response_code( $request ) !== 200 ) {
			set_transient( $cache_key, array(), 15 * MINUTE_IN_SECONDS );
			return array();
		}

		$data = json_decode( wp_remote_retrieve_body( $request ), true );
		if ( empty( $data ) || ! is_array( $data ) ) {
			$data = array();
		}

		set_transient( $cache_key, $data, 1 * HOUR_IN_SECONDS );
		return $data;
	}

	/**
	 * Returns the home url with the following modifications:
	 *
	 * In case of a multisite setup we return the network_home_url.
	 * In case of no multisite setup we return the home_url while overriding the WPML filter.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string The home url.
	 */
	public static function get_home_url() {

		$url = home_url();

		// If the plugin is network activated, use the network home URL.
		if ( self::is_plugin_network_active() ) {
			$url = network_home_url();
		}

		return $url;
	}

	/**
	 * Determines whether the plugin is active for the entire network.
	 *
	 * @return bool Whether or not the plugin is network-active.
	 */
	public static function is_plugin_network_active() {
		static $network_active = null;

		if ( ! is_multisite() ) {
			return false;
		}

		// If a cached result is available, bail early.
		if ( null !== $network_active ) {
			return $network_active;
		}

		// Makes sure the plugin is defined before trying to use it.
		if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}

		if ( is_plugin_active_for_network( 'commercegurus-commercekit/commercegurus-commercekit.php' ) ) {
			$network_active = true;
		} else {
			$network_active = false;
		}

		return $network_active;
	}


}

CG_Helper::load();
