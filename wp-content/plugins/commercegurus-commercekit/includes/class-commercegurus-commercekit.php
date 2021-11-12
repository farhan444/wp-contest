<?php
/**
 *
 * CommerceGurus Commercekit
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly....
}

if ( ! class_exists( 'CommerceGurus_Commercekit' ) ) {

	/**
	 * Main CommerceGurus_Commercekit Class
	 *
	 * @class CommerceGurus_Commercekit
	 * @version 1.0.0
	 * @since 1.0.0
	 * @package CommerceGurus_Commercekit
	 */
	class CommerceGurus_Commercekit {

		/**
		 * Plugin version.
		 *
		 * @var string
		 */
		const VERSION = '1.0.0';

		/**
		 * Notices (array)
		 *
		 * @var array
		 */
		public $notices = array();

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->includes();
			add_action( 'extra_theme_headers', array( $this, 'cg_extra_theme_headers' ) );
		}

		/**
		 * Init the plugin after plugins_loaded so environment variables are set.
		 */
		public function includes() {

			if ( is_admin() ) {
				include_once CGKIT_BASE_PATH . 'includes/admin/class-cg-admin.php';
			}
		}

		/**
		 * Extra theme headers.
		 *
		 * @param int $headers for theme.
		 */
		public function cg_extra_theme_headers( $headers ) {
			$headers[] = 'CGMeta';
			return $headers;
		}

		/**
		 * Init the plugin after plugins_loaded so environment variables are set.
		 */
		public function init() {
			// Don't hook anything else in the plugin if we're in an incompatible environment.
			if ( self::get_environment_warning() ) {
				return;
			}

		}

		/**
		 * The backup sanity check, in case the plugin is activated in a weird way,
		 * or the environment changes after activation.
		 */
		public function check_environment() {
			$environment_warning = self::get_environment_warning();

			if ( $environment_warning ) {
				$this->add_admin_notice( 'bad_environment', 'error', $environment_warning );
			}
		}

		/**
		 * Checks the environment for compatibility problems.  Returns a string with the first incompatibility
		 * found or false if the environment has no problems.
		 */
		public static function get_environment_warning() {
			if ( ! defined( 'WC_VERSION' ) ) {
				return __( 'CommerceGurus CommerceKit requires WooCommerce 4.0+ to be activated to work.', 'commercegurus-commercekit' );
			}

			if ( version_compare( WC_VERSION, CGKIT_MIN_WC_VER, '<' ) ) {
				/* translators: %s: version numbers. */
				$message = __( 'CommerceGurus CommerceKit - The minimum WooCommerce version required for this plugin is %1$s. You are running %2$s.', 'commercegurus-commercekit' );

				return sprintf( $message, CGKIT_MIN_WC_VER, WC_VERSION );
			}

			return false;
		}

		/**
		 * Display any notices we've collected thus far.
		 */
		public function admin_notices() {
			foreach ( (array) $this->notices as $notice_key => $notice ) {
				echo "<div class='" . esc_attr( $notice['class'] ) . "'><p>";
				echo wp_kses( $notice['message'], array( 'a' => array( 'href' => array() ) ) );
				echo '</p></div>';
			}
		}

		/**
		 * Allow this class and other classes to add slug keyed notices (to avoid duplication)
		 *
		 * @param int $slug of theme.
		 * @param int $class of theme.
		 * @param int $message of theme.
		 */
		public function add_admin_notice( $slug, $class, $message ) {
			$this->notices[ $slug ] = array(
				'class'   => $class,
				'message' => $message,
			);
		}

		/**
		 * Get search args.
		 */
		public function cg_subs_get_search_args() {
			$args      = array();
			$args['d'] = array(
				'description' => esc_html__( 'The domain name to check.', 'commercegurus-commercekit' ),
				'type'        => 'string',
			);

			return $args;
		}

	}

	$commerce_gurus_commercekit = new CommerceGurus_Commercekit();
}
