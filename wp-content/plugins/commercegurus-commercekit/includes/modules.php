<?php
/**
 *
 * Frontend modules
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Display module output
 *
 * @param  string $display_text of module output.
 */
function commercekit_module_output( $display_text ) {
	$args = array(
		'span'     => array(
			'data-product-id' => array(),
			'data-type'       => array(),
			'data-wpage'      => array(),
			'class'           => array(),
			'aria-label'      => array(),
		),
		'h2'       => array(
			'class' => array(),
		),
		'del'      => array(),
		'ins'      => array(),
		'strong'   => array(),
		'em'       => array(),
		'b'        => array(),
		'i'        => array(
			'class' => array(),
		),
		'img'      => array(
			'href'        => array(),
			'alt'         => array(),
			'class'       => array(),
			'scale'       => array(),
			'width'       => array(),
			'height'      => array(),
			'src'         => array(),
			'srcset'      => array(),
			'sizes'       => array(),
			'data-src'    => array(),
			'data-srcset' => array(),
		),
		'br'       => array(),
		'p'        => array(),
		'a'        => array(
			'href'            => array(),
			'data-product-id' => array(),
			'data-type'       => array(),
			'data-wpage'      => array(),
			'class'           => array(),
			'aria-label'      => array(),
			'target'          => array(),
		),
		'div'      => array(
			'data-product-id' => array(),
			'data-type'       => array(),
			'data-wpage'      => array(),
			'class'           => array(),
			'aria-label'      => array(),
		),
		'noscript' => array(),
	);

	echo wp_kses( $display_text, $args );
}

/**
 * Kses allowed protocols
 *
 * @param  string $protocols protocols.
 */
function commercekit_kses_allowed_protocols( $protocols ) {
	$protocols[] = 'data';
	return $protocols;
}
add_filter( 'kses_allowed_protocols', 'commercekit_kses_allowed_protocols' );

$commercekit_options    = get_option( 'commercekit', array() );
$enable_inventory_bar   = isset( $commercekit_options['inventory_display'] ) && 1 === (int) $commercekit_options['inventory_display'] ? 1 : 0;
$enable_countdown_timer = isset( $commercekit_options['countdown_timer'] ) && 1 === (int) $commercekit_options['countdown_timer'] ? 1 : 0;
$enable_ajax_search     = isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 1 : 0;
$enable_waitlist        = isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 1 : 0;
$enable_order_bump      = isset( $commercekit_options['order_bump'] ) && 1 === (int) $commercekit_options['order_bump'] ? 1 : 0;
$enable_wishlist        = isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ? 1 : 0;
$enable_pdp_triggers    = isset( $commercekit_options['pdp_triggers'] ) && 1 === (int) $commercekit_options['pdp_triggers'] ? 1 : 0;

if ( $enable_inventory_bar ) {
	require_once dirname( __FILE__ ) . '/module-inventory-bar.php';
}
if ( $enable_countdown_timer ) {
	require_once dirname( __FILE__ ) . '/module-countdown-timer.php';
}
if ( $enable_ajax_search ) {
	require_once dirname( __FILE__ ) . '/module-ajax-search.php';
}
if ( $enable_waitlist ) {
	require_once dirname( __FILE__ ) . '/module-waitlist.php';
}
if ( $enable_order_bump ) {
	require_once dirname( __FILE__ ) . '/module-order-bump.php';
}
if ( $enable_wishlist ) {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
		global $commerce_gurus_commercekit, $pagenow;
		include_once ABSPATH . 'wp-includes/pluggable.php';
		$nonce = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
		$cpage = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
		if ( 'admin.php' === $pagenow && 'commercekit' === $cpage ) {
			$commerce_gurus_commercekit->add_admin_notice( 'bad_wishlist', 'error', esc_html__( 'You will need to first disable the YITH Wishlist plugin in order to use the CommerceKit Wishlist feature.', 'commercegurus-commercekit' ) );
		}
	} else {
		require_once dirname( __FILE__ ) . '/module-wishlist.php';
	}
}
if ( $enable_pdp_triggers ) {
	require_once dirname( __FILE__ ) . '/module-pdp-triggers.php';
}
