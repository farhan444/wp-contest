<?php
/**
 * CommerceGurus Gallery
 *
 * @author   CommerceGurus
 * @package  CommerceGurus_Gallery
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly....
}

/**
 * Required minimums and constants
 */
require_once CGKIT_BASE_PATH . 'includes/commercegurus-gallery-functions.php';

/**
 * Main CommerceGurus_Gallery Class
 *
 * @class CommerceGurus_Gallery
 * @version 1.0.0
 * @since 1.0.0
 * @package CommerceGurus_Gallery
 */

if ( ! class_exists( 'CommerceGurus_Gallery' ) ) {

	/**
	 * Main class.
	 */
	class CommerceGurus_Gallery {

		/**
		 * Plugin version.
		 *
		 * @var string
		 */
		const VERSION = '1.0.2';

		/**
		 * Notices (array)
		 *
		 * @var array
		 */
		public $notices = array();

		/**
		 * Main constructor.
		 */
		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'init' ) );
		}

		/**
		 * Init the plugin after plugins_loaded so environment variables are set.
		 */
		public function init() {
			/**
			 * Init all the things.
			 */
			add_action( 'wp', array( $this, 'commercegurus_init_gallery' ) );
			add_action( 'woocommerce_before_single_product', array( $this, 'commercegurus_unhook_core_gallery' ) );
			add_action( 'woocommerce_before_single_product_summary', array( $this, 'commercegurus_load_pdp_gallery' ), 20 );
			add_action( 'wp_enqueue_scripts', array( $this, 'commercegurus_gallery_assets' ) );
		}

		/**
		 * Frontend: Load all scripts and styles.
		 */
		public function commercegurus_gallery_assets() {
			$options      = get_option( 'commercekit', array() );
			$pdp_lightbox = ( ( isset( $options['pdp_lightbox'] ) && 1 === (int) $options['pdp_lightbox'] ) || ! isset( $options['pdp_lightbox'] ) ) ? true : false;

			if ( function_exists( 'is_product' ) && is_product() ) {
				wp_enqueue_script( 'commercegurus-swiperjs', plugins_url( 'assets/js/swiper-bundle.min.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );

				if ( $pdp_lightbox ) {
					wp_enqueue_script( 'commercegurus-photoswipe', plugins_url( 'assets/js/photoswipe.min.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );
					wp_enqueue_script( 'commercegurus-photoswipe-ui-default', plugins_url( 'assets/js/photoswipe-ui-default.min.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );
				}

				wp_enqueue_script( 'commercegurus-gallery', plugins_url( 'assets/js/commercegurus-gallery.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );
				wp_enqueue_style( 'commercegurus-swiperjscss', plugins_url( 'assets/css/swiper-bundle.min.css', __FILE__ ), array(), CGKIT_CSS_JS_VER );

				if ( $pdp_lightbox ) {
					wp_enqueue_style( 'commercegurus-photoswipe', plugins_url( 'assets/css/photoswipe.min.css', __FILE__ ), array(), CGKIT_CSS_JS_VER );
					wp_enqueue_style( 'commercegurus-photoswipe-skin', plugins_url( 'assets/css/default-skin.min.css', __FILE__ ), array(), CGKIT_CSS_JS_VER );
				}
			}
		}

		/**
		 * Frontend: Remove core wc gallery.
		 */
		public function commercegurus_unhook_core_gallery() {
			remove_action( 'woocommerce_after_single_product', 'shoptimizer_pdp_gallery_modal_fix' );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 10 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		}

		/**
		 * Frontend: Load CommerceGurus Gallery.
		 */
		public function commercegurus_load_pdp_gallery() {
			global $product;
			if ( empty( $product ) ) {
				return;
			}
			require_once CGKIT_BASE_PATH . 'includes/pdp-gallery-swiper.php';
		}

		/**
		 * Useful function for doing global tweaks (like removing core lazy filters.
		 */
		public function commercegurus_init_gallery() {
			global $post;
			remove_theme_support( 'wc-product-gallery-lightbox' );
			remove_theme_support( 'wc-product-gallery-zoom' );
			remove_theme_support( 'wc-product-gallery-slider' );
		}
	}

	$commercegurus_gallery = new CommerceGurus_Gallery();
}
