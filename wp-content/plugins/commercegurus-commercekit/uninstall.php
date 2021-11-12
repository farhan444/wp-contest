<?php
/**
 * Uninstall plugin
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
global $wpdb;

/*
 * Only remove ALL data if CGKIT_REMOVE_ALL_DATA constant is set to true in user's
 * wp-config.php. This is to prevent data loss when deleting the plugin from the backend
 * and to ensure only the site owner can perform this action.
 */
if ( defined( 'CGKIT_REMOVE_ALL_DATA' ) && true === CGKIT_REMOVE_ALL_DATA ) {
	$table_waitlist       = 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'commercekit_waitlist';
	$table_wishlist       = 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'commercekit_wishlist';
	$table_wishlist_items = 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'commercekit_wishlist_items';

	$wpdb->query( $table_waitlist ); // phpcs:ignore
	$wpdb->query( $table_wishlist ); // phpcs:ignore
	$wpdb->query( $table_wishlist_items ); // phpcs:ignore

	delete_option( 'commercekit' );
	delete_option( 'commercekit_db_version' );
	delete_option( 'commercekit_obp_views' );
	delete_option( 'commercekit_obp_clicks' );
	delete_option( 'commercekit_obp_sales' );
	delete_option( 'commercekit_obp_sales_revenue' );
}
