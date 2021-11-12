<?php
/**
 * CommerceGurus Commercekit
 *
 * @link              https://www.commercegurus.com
 * @since             1.0.0
 * @package           CommerceGurus_Commercekit
 *
 * @wordpress-plugin
 * Plugin Name:       CommerceGurus Commercekit
 * Plugin URI:        https://www.commercegurus.com
 * Description:       A companion plugin for the Shoptimizer WooCommerce theme with additional conversion focused features.
 * Version:           1.3.0
 * Author:            CommerceGurus
 * Author URI:        https://www.commercegurus.com
 * Requires at least: 5.2
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       commercegurus-commercekit
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly....
}

/**
 * Required minimums and constants
 */
define( 'CGKIT_MIN_WC_VER', '4.0' );
define( 'CGKIT_CSS_JS_VER', '1.2.8' );
define( 'CGKIT_BASE_PATH', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'CKIT_URI' ) ) {
	define( 'CKIT_URI', plugin_dir_url( __FILE__ ) );
}
global $commercekit_db_version;
$commercekit_db_version = '1.2.9';

require_once dirname( __FILE__ ) . '/includes/class-commercegurus-commercekit.php';
require_once dirname( __FILE__ ) . '/includes/admin-settings.php';
require_once dirname( __FILE__ ) . '/includes/modules.php';

/**
 * Add site CSS and JS scripts
 */
function commercekit_scripts() {
	global $post;
	$commercekit_options = get_option( 'commercekit', array() );
	if ( isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ) {
		wp_enqueue_style( 'commercekit-wishlist-css', plugins_url( 'assets/css/wishlist.css', __FILE__ ), array(), CGKIT_CSS_JS_VER );
		wp_enqueue_script( 'commercekit-wishlist', plugins_url( 'assets/js/wishlist.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );
	}

	if ( isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ) {
		wp_enqueue_style( 'commercekit-ajax-search-css', plugins_url( 'assets/css/ajax-search.css', __FILE__ ), array(), CGKIT_CSS_JS_VER );
		wp_enqueue_script( 'commercekit-ajax-search', plugins_url( 'assets/js/ajax-search.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );
	}
}

add_action( 'wp_enqueue_scripts', 'commercekit_scripts' );


/**
 * Commercekit js variables
 */
function commercekit_js_variables() {
	$options         = get_option( 'commercekit', array() );
	$commercekit_ajs = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
	if ( function_exists( 'commercekit_ajs_options' ) ) {
		$commercekit_ajs = commercekit_ajs_options();
	}
	$commercekit_pdp                   = array();
	$commercekit_pdp['pdp_thumbnails'] = 4;
	$commercekit_pdp['pdp_lightbox']   = ( ( isset( $options['pdp_lightbox'] ) && 1 === (int) $options['pdp_lightbox'] ) || ! isset( $options['pdp_lightbox'] ) ) ? 1 : 0;
	?>
	<script type="text/javascript">
		var commercekit_ajs = <?php echo wp_json_encode( $commercekit_ajs ); ?>
	</script>
	<script type="text/javascript">
		var commercekit_pdp = <?php echo wp_json_encode( $commercekit_pdp ); ?>
	</script>
	<?php
}
add_action( 'wp_head', 'commercekit_js_variables' );

/**
 * Add admin CSS and JS scripts
 */
function commercekit_admin_scripts() {
	$screen = get_current_screen();
	if ( 'toplevel_page_commercekit' === $screen->base ) {
		wp_enqueue_style( 'commercekit-select2-style', plugins_url( 'assets/css/select2.css', __FILE__ ), array(), CGKIT_CSS_JS_VER );
		wp_enqueue_style( 'commercekit-admin-style', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), CGKIT_CSS_JS_VER );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'commercekit-select2-script', plugins_url( 'assets/js/select2.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );
		wp_enqueue_script( 'commercekit-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array(), CGKIT_CSS_JS_VER, true );
	}
}

add_action( 'admin_enqueue_scripts', 'commercekit_admin_scripts' );

/**
 * Commercekit create plugin tables
 */
function commercekit_create_plugin_tables() {
	global $wpdb, $commercekit_db_version;
	$installed_version = (string) get_option( 'commercekit_db_version' );
	if ( $installed_version === $commercekit_db_version ) {
		return;
	}

	$table_name = 'commercekit_waitlist';
	$cgw_table  = $wpdb->prefix . $table_name;
	$get_table  = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $cgw_table ) ); // db call ok; no-cache ok.
	if ( $cgw_table !== $get_table ) {
		$sql  = 'CREATE TABLE IF NOT EXISTS `' . $cgw_table . '` ( ';
		$sql .= '`id` INT(11) NOT NULL AUTO_INCREMENT, ';
		$sql .= '`email` VARCHAR(255) NOT NULL, ';
		$sql .= '`product_id` BIGINT(20) NOT NULL, ';
		$sql .= '`mail_sent` TINYINT(1) NOT NULL DEFAULT \'0\', ';
		$sql .= '`created` BIGINT(20) NOT NULL, ';
		$sql .= 'PRIMARY KEY (`id`) ';
		$sql .= '); ';
		require_once ABSPATH . '/wp-admin/includes/upgrade.php';
		dbDelta( $sql ); // db call ok; no-cache ok.
	} else {
		$field_cols = $wpdb->get_col( 'SHOW COLUMNS FROM `' . $cgw_table . '`' ); // phpcs:ignore
		if ( ! in_array( 'mail_sent', $field_cols, true ) ) {
			$sql = 'ALTER TABLE `' . $cgw_table . '` ADD `mail_sent` TINYINT(1) NOT NULL DEFAULT \'0\' AFTER `product_id`';
			$wpdb->query( $sql ); // phpcs:ignore
		}

		$field_rows = $wpdb->get_results( 'SHOW COLUMNS FROM `' . $cgw_table . '`' ); // phpcs:ignore
		if ( count( $field_rows ) ) {
			foreach ( $field_rows as $field_row ) {
				if ( 'product_id' === $field_row->Field && 'int(11)' === strtolower( $field_row->Type ) ) { // phpcs:ignore
					$sql = 'ALTER TABLE `' . $cgw_table . '` MODIFY `product_id` BIGINT(20) NOT NULL';
					$wpdb->query( $sql ); // phpcs:ignore
				}
			}
		}
	}

	$table_name = 'commercekit_wishlist';
	$cgw_table  = $wpdb->prefix . $table_name;
	$get_table  = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $cgw_table ) ); // db call ok; no-cache ok.
	if ( $cgw_table !== $get_table ) {
		$sql  = 'CREATE TABLE IF NOT EXISTS `' . $cgw_table . '` ( ';
		$sql .= '`id` INT(11) NOT NULL AUTO_INCREMENT, ';
		$sql .= '`session_key` VARCHAR(100) NOT NULL, ';
		$sql .= 'PRIMARY KEY (`id`) ';
		$sql .= '); ';
		require_once ABSPATH . '/wp-admin/includes/upgrade.php';
		dbDelta( $sql ); // db call ok; no-cache ok.
	}

	$table_name = 'commercekit_wishlist_items';
	$cgw_table  = $wpdb->prefix . $table_name;
	$get_table  = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $cgw_table ) ); // db call ok; no-cache ok.
	if ( $cgw_table !== $get_table ) {
		$sql  = 'CREATE TABLE IF NOT EXISTS `' . $cgw_table . '` ( ';
		$sql .= '`id` INT(11) NOT NULL AUTO_INCREMENT, ';
		$sql .= '`user_id` INT(11) NOT NULL, ';
		$sql .= '`list_id` INT(11) NOT NULL, ';
		$sql .= '`product_id` BIGINT(20) NOT NULL, ';
		$sql .= '`created` BIGINT(20) NOT NULL, ';
		$sql .= 'PRIMARY KEY (`id`) ';
		$sql .= '); ';
		require_once ABSPATH . '/wp-admin/includes/upgrade.php';
		dbDelta( $sql ); // db call ok; no-cache ok.
	} else {
		$field_rows = $wpdb->get_results( 'SHOW COLUMNS FROM `' . $cgw_table . '`' ); // phpcs:ignore
		if ( count( $field_rows ) ) {
			foreach ( $field_rows as $field_row ) {
				if ( 'product_id' === $field_row->Field && 'int(11)' === strtolower( $field_row->Type ) ) { // phpcs:ignore
					$sql = 'ALTER TABLE `' . $cgw_table . '` MODIFY `product_id` BIGINT(20) NOT NULL';
					$wpdb->query( $sql ); // phpcs:ignore
				}
			}
		}
	}

	$table_name = 'commercekit_searches';
	$cgw_table  = $wpdb->prefix . $table_name;
	$get_table  = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $cgw_table ) ); // db call ok; no-cache ok.
	if ( $cgw_table !== $get_table ) {
		$sql  = 'CREATE TABLE IF NOT EXISTS `' . $cgw_table . '` ( ';
		$sql .= '`id` INT(11) NOT NULL AUTO_INCREMENT, ';
		$sql .= '`search_term` VARCHAR(100) NOT NULL, ';
		$sql .= '`search_count` INT(11) NOT NULL DEFAULT \'0\', ';
		$sql .= '`click_count` INT(11) NOT NULL DEFAULT \'0\', ';
		$sql .= '`no_result_count` INT(11) NOT NULL DEFAULT \'0\', ';
		$sql .= 'PRIMARY KEY (`id`) ';
		$sql .= '); ';
		require_once ABSPATH . '/wp-admin/includes/upgrade.php';
		dbDelta( $sql ); // db call ok; no-cache ok.
	}

	$options = get_option( 'commercekit', array() );
	$db_keys = array(
		'at'   => 'active',
		'ato'  => 'activeo',
		'tt'   => 'title',
		'd'    => 'days',
		'h'    => 'hours',
		'm'    => 'minutes',
		's'    => 'seconds',
		'dl'   => 'days_label',
		'hl'   => 'hours_label',
		'ml'   => 'minutes_label',
		'sl'   => 'seconds_label',
		'tp'   => 'type',
		'cnd'  => 'condition',
		'pids' => 'pids',
	);
	foreach ( $db_keys as $old_key => $new_key ) {
		if ( isset( $options['ctd']['pdt'][ $old_key ] ) ) {
			$options['countdown']['product'][ $new_key ] = $options['ctd']['pdt'][ $old_key ];
			unset( $options['ctd']['pdt'][ $old_key ] );
		}
	}
	$db_keys = array(
		'at' => 'active',
		'tt' => 'title',
		'em' => 'expiry_message',
		'm'  => 'minutes',
		's'  => 'seconds',
	);
	foreach ( $db_keys as $old_key => $new_key ) {
		if ( isset( $options['ctd']['ckt'][ $old_key ] ) ) {
			$options['countdown']['checkout'][ $new_key ] = $options['ctd']['ckt'][ $old_key ];
			unset( $options['ctd']['ckt'][ $old_key ] );
		}
	}
	if ( isset( $options['ctd'] ) ) {
		unset( $options['ctd'] );
	}

	$db_keys = array(
		'at'   => 'active',
		'ato'  => 'activeo',
		'id'   => 'id',
		'tt'   => 'title',
		'bt'   => 'button_text',
		'ba'   => 'button_added',
		'cnd'  => 'condition',
		'pids' => 'pids',
	);
	foreach ( $db_keys as $old_key => $new_key ) {
		if ( isset( $options['obp']['pdt'][ $old_key ] ) ) {
			$options['order_bump_product']['product'][ $new_key ] = $options['obp']['pdt'][ $old_key ];
			unset( $options['obp']['pdt'][ $old_key ] );
		}
	}
	if ( isset( $options['obp'] ) ) {
		unset( $options['obp'] );
	}
	if ( isset( $options['ajs_success_text'] ) ) {
		$options['wtl_success_text'] = $options['ajs_success_text'];
		unset( $options['ajs_success_text'] );
	}

	update_option( 'commercekit', $options );
	update_option( 'commercekit_db_version', $commercekit_db_version );
}
register_activation_hook( __FILE__, 'commercekit_create_plugin_tables' );

/**
 * Commercekit update db check
 */
function commercekit_update_db_check() {
	global $commercekit_db_version;
	if ( (string) get_option( 'commercekit_db_version' ) !== $commercekit_db_version ) {
		commercekit_create_plugin_tables();
	}
}
add_action( 'plugins_loaded', 'commercekit_update_db_check' );

/**
 * Commercekit admin notices
 */
function commercekit_admin_notices() {
	global $commerce_gurus_commercekit;
	$commerce_gurus_commercekit->check_environment();
	$commerce_gurus_commercekit->admin_notices();
}
add_action( 'admin_notices', 'commercekit_admin_notices' );

$commercekit_options = get_option( 'commercekit', array() );
$enable_pdp_gallery  = isset( $commercekit_options['pdp_gallery'] ) && 1 === (int) $commercekit_options['pdp_gallery'] ? 1 : 0;
if ( $enable_pdp_gallery ) {
	require_once dirname( __FILE__ ) . '/class-commercegurus-gallery.php';
}
