<?php
/**
 * Elementor Compatibility File.
 *
 * @package Shoptimizer
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport;

use Elementor\TemplateLibrary\Source_Local;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Shoptimizer Elementor Compatibility
 */
if ( ! class_exists( 'Shoptimizer_Elementor_Pro' ) ) :

	/**
	 * Shoptimizer Elementor Compatibility
	 *
	 * @since 1.8.0
	 */
	class Shoptimizer_Elementor_Pro {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.8.0
		 * @return object Class object.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.8.0
		 */
		public function __construct() {

			// Add locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

			// Override theme templates.
			add_action( 'shoptimizer_single_post', array( $this, 'do_template_parts' ), 0 );
			add_action( 'shoptimizer_page_start', array( $this, 'do_template_parts' ), 0 );
			add_action( 'shoptimizer_page', array( $this, 'do_template_parts' ), 0 );
			add_action( 'shoptimizer_page_after', array( $this, 'do_template_parts' ), 0 );

			add_action( 'shoptimizer_404_template', array( $this, 'do_template_part_404' ), 0 );

			// Header
			add_action( 'shoptimizer_topbar', array( $this, 'do_header' ), 0 );
			add_action( 'shoptimizer_header', array( $this, 'do_header' ), 0 );

			// Footer
			add_action( 'shoptimizer_before_footer', array( $this, 'do_footer' ), 0 );
			add_action( 'shoptimizer_footer', array( $this, 'do_footer' ), 0 );

		}

		/**
		 * Register Locations
		 *
		 * @since 1.8.0
		 * @param object $manager Location manager.
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();
		}

		/**
		 * Template Parts Support
		 *
		 * @since 1.9.8
		 * @return void
		 */
		function do_template_parts() {
			// Is a single post or page?
			$did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
			if ( $did_location ) {
				remove_action( 'shoptimizer_single_post', 'shoptimizer_post_thumbnail_no_link', 5 );
				remove_action( 'shoptimizer_single_post', 'shoptimizer_post_header', 10 );
				remove_action( 'shoptimizer_single_post', 'shoptimizer_post_content', 30 );
				remove_action( 'shoptimizer_single_post', 'shoptimizer_post_meta', 40 );
				remove_action( 'shoptimizer_single_post_bottom', 'shoptimizer_display_comments', 20 );
				remove_action( 'shoptimizer_page_start', 'shoptimizer_page_header', 10 );
				remove_action( 'shoptimizer_page', 'shoptimizer_page_content', 20 );
				remove_action( 'shoptimizer_page_after', 'shoptimizer_display_comments', 10 );
			}
		}

		/**
		 * Header Support
		 *
		 * @since 1.8.0
		 * @return void
		 */
		public function do_header() {

			$shoptimizer_header_layout = '';
			$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

			$did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $did_location ) {
				remove_action( 'shoptimizer_topbar', 'shoptimizer_top_bar', 10 );
				remove_action( 'shoptimizer_header', 'shoptimizer_site_branding', 20 );
				remove_action( 'shoptimizer_header', 'shoptimizer_product_search', 25 );
				remove_action( 'shoptimizer_header', 'shoptimizer_secondary_navigation', 30 );
				remove_action( 'shoptimizer_header', 'shoptimizer_header_cart', 50 );
				remove_action( 'shoptimizer_header', 'shoptimizer_sticky_js_trigger', 90 );

				remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper', 42 );
				remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation', 50 );
				remove_action( 'shoptimizer_navigation', 'shoptimizer_header_cart', 60 );
				remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper_close', 68 );
				remove_action( 'shoptimizer_navigation', 'shoptimizer_header_wrapper_close', 75 );

				if ( 'header-4' === $shoptimizer_header_layout ) {
					remove_action( 'shoptimizer_header', 'shoptimizer_header_wrapper_open', 10 );
					remove_action( 'shoptimizer_header', 'shoptimizer_header_cart', 50 );
					remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper', 42 );
					remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation', 50 );
					remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper_close', 68 );
					remove_action( 'shoptimizer_navigation', 'shoptimizer_header_wrapper_close', 75 );
					remove_action( 'shoptimizer_navigation', 'shoptimizer_search_modal', 50 );
					remove_action( 'shoptimizer_navigation', 'shoptimizer_header_cart', 60 );
				}

				add_action( 'shoptimizer_header', 'shoptimizer_elementor_pro_styling', 40 );

				//Solves issues when replacing menu with Elementor Pro's.
				remove_action( 'shoptimizer_header', 'shoptimizer_menu_load_shortcode', 42 );

			}
		}

		/**
		 * Override 404 page
		 *
		 * @since 2.3.6
		 * @return void
		 */
		public function do_template_part_404() {
			if ( is_404() ) {

				// Is Single?
				$did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
				if ( $did_location ) {
					remove_action( 'shoptimizer_404_template', 'shoptimizer_entry_content_404_page_template');
				}
			}
		}

		/**
		 * Footer Support
		 *
		 * @since 1.8.0
		 * @return void
		 */
		public function do_footer() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
			if ( $did_location ) {
				remove_action( 'shoptimizer_before_footer', 'shoptimizer_below_content', 10 );
 				remove_action( 'shoptimizer_footer', 'shoptimizer_footer_widgets', 20 );
				remove_action( 'shoptimizer_footer', 'shoptimizer_footer_copyright', 30 );
			}
		}


		}

	Shoptimizer_Elementor_Pro::get_instance();

endif;
