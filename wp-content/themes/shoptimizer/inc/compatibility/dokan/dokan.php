<?php

/**
 * Dokan
 *
 * @package Shoptimizer
 * @since Shoptimizer 1.0.0
 */

function shoptimizer_remove_dokan_sidebar() { 
   $classes = get_body_class();
	if (in_array('dokan-store', $classes)) {
    remove_action( 'woocommerce_after_main_content', 'shoptimizer_after_content', 10 );
   }
}
add_action( 'template_redirect', 'shoptimizer_remove_dokan_sidebar', 99 );