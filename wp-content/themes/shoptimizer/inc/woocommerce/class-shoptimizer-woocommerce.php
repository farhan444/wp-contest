<?php
/**
 * Shoptimizer WooCommerce Class
 *
 * @package  Shoptimizer
 * @author   CommerceGurus
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Shoptimizer_WooCommerce' ) ) :

	/**
	 * The Shoptimizer WooCommerce Integration class
	 */
	class Shoptimizer_WooCommerce {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'body_class',                               array( $this, 'woocommerce_body_class' ) );
			add_action( 'wp_enqueue_scripts',                       array( $this, 'woocommerce_scripts' ),	20 );
			add_filter( 'woocommerce_enqueue_styles',               '__return_empty_array' );
			add_filter( 'woocommerce_breadcrumb_defaults',          array( $this, 'change_breadcrumb_delimiter' ) );
		}

		/**
		 * Remove the breadcrumb delimiter
		 *
		 * @param  array $defaults The breadcrumb defaults
		 * @return array The breadcrumb defaults
		 * @since 1.0.0
		 */
		public function change_breadcrumb_delimiter( $defaults ) {
			$defaults['delimiter'] = '<span class="breadcrumb-separator"> / </span>';
			return $defaults;
		}

		/**
		 * Add 'woocommerce-active' class to the body tag
		 *
		 * @param  array $classes css classes applied to the body tag.
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			if ( shoptimizer_is_woocommerce_activated() ) {
				$classes[] = 'wc-active';
			}

			return $classes;
		}

		/**
		 * WooCommerce specific scripts and stylesheets
		 *
		 * @since 1.0.0
		 */
		public function woocommerce_scripts() {
			global $shoptimizer_version;

			$shoptimizer_general_speed_minify_main_css = '';
			$shoptimizer_general_speed_minify_main_css = shoptimizer_get_option( 'shoptimizer_general_speed_minify_main_css' );

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			if ( 'yes' === $shoptimizer_general_speed_minify_main_css ) {
				wp_enqueue_style( 'shoptimizer-woocommerce-min', get_template_directory_uri() . '/assets/css/main/woocommerce.min.css', array(), $shoptimizer_version );
			} else {
				wp_enqueue_style( 'shoptimizer-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.css', array(), $shoptimizer_version );
			}
		}

	}

endif;

return new Shoptimizer_WooCommerce();
