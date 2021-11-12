<?php

/**
 * YITH Wishlist
 *
 * @package Shoptimizer
 * @since Shoptimizer 1.0.0
 */

/**
 * After WooCommerce Shop Loop
 * Adds support for YITH Wishlist functionality
 *
 * @since   1.0.0
 * @return  void
 */
function shoptimizer_display_yith_wishlist_loop() {
	if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'shoptimizer_display_yith_wishlist_loop', 97 );