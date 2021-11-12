<?php
/**
 *
 * Some wrappers for theme mods/options and their defaults
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Set sensible defaults.
require_once get_template_directory() . '/inc/customizer/defaults.php';

$shoptmizer_typography2_enabled = shoptimizer_typography2_enabled();
if ( $shoptmizer_typography2_enabled ) {
	require_once get_template_directory() . '/inc/customizer/defaults-extended.php';
}

if ( ! function_exists( 'shoptimizer_get_option' ) ) {
	/**
	 * Main function used to call them options
	 *
	 * @param int $key The theme option argument.
	 */
	function shoptimizer_get_option( $key ) {
		$shoptimizer_options = shoptimizer_get_options();
		$shoptimizer_option  = get_theme_mod( $key, $shoptimizer_options[ $key ] );
		return $shoptimizer_option;
	}
}

if ( ! function_exists( 'shoptimizer_get_options' ) ) {

	/**
	 * Get theme option defaults
	 */
	function shoptimizer_get_options() {
		return wp_parse_args(
			get_theme_mods(),
			shoptimizer_get_option_defaults()
		);
	}
}
