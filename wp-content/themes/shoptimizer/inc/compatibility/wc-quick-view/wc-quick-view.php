<?php

/**
 * WC Quick View
 *
 * @package Shoptimizer
 * @since Shoptimizer 2.4.5
 */

/**
 * Adds support for WooCommerce Quick View plugin
 *
 * @since   2.4.5
 * @return  void
 */

/**
 * Enqueue product styling css throughout site.
 */
function shoptimizer_wc_quick_view_styles() {
	wp_enqueue_style( 'shoptimizer-product-min', get_template_directory_uri() . '/assets/css/main/product.min.css' );
	wp_enqueue_script( 'shoptimizer-quantity', get_template_directory_uri() . '/assets/js/quantity.min.js', array(), '1.1.3', true );
}
add_action( 'wp_enqueue_scripts', 'shoptimizer_wc_quick_view_styles' );