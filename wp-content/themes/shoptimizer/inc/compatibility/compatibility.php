<?php

function shoptimizer_compatability_styles() {

	$compatibility_uri = get_template_directory_uri() . '/inc/compatibility';

	if ( class_exists( 'WeDevs_Dokan' ) ) {
		wp_enqueue_style( 'shoptimizer-dokan-style', $compatibility_uri . '/dokan/dokan.css' );
	}
	if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
		wp_enqueue_style( 'shoptimizer-yith-wishlist-style', $compatibility_uri . '/yith-wishlist/yith-wishlist.css' );
	}
	if ( class_exists( 'Addify_Request_For_Quote' ) ) {
		wp_enqueue_style( 'shoptimizer-wc-quote-style', $compatibility_uri . '/wc-quote/wc-quote.css' );
	}
	if ( class_exists( 'WC_Quick_View' ) ) {
		wp_enqueue_style( 'shoptimizer-wc-quickview-style', $compatibility_uri . '/wc-quick-view/wc-quick-view.css' );
	}

}
add_action( 'wp_enqueue_scripts', 'shoptimizer_compatability_styles', 90 );

// Dokan support.
if ( class_exists( 'WeDevs_Dokan' ) ) {
	require get_template_directory() . '/inc/compatibility/dokan/dokan.php';
}

// YITH Wishlist support.
if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
	require get_template_directory() . '/inc/compatibility/yith-wishlist/yith-wishlist.php';
}

// WC Quick View support.
if ( class_exists( 'WC_Quick_View' ) ) {
	require get_template_directory() . '/inc/compatibility/wc-quick-view/wc-quick-view.php';
}