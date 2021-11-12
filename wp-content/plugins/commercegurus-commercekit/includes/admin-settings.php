<?php
/**
 *
 * Admin Settings
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Adding admin settings page
 */
function commercekit_admin_page() {
	add_menu_page(
		'CommerceKit Settings',
		'CommerceKit',
		'manage_options',
		'commercekit',
		'commercekit_admin_page_html',
		'dashicons-superhero'
	);
}
add_action( 'admin_menu', 'commercekit_admin_page' );

/**
 * Adding admin setting page update
 */
function commercekit_admin_page_update() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}

	$commercekit_nonce = isset( $_POST['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['commercekit_nonce'] ) ) : '';
	if ( ! $commercekit_nonce || ! wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' ) ) {
		return false;
	}

	$tab     = isset( $_REQUEST['tab'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['tab'] ) ) : 'dashboard';
	$section = isset( $_REQUEST['section'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['section'] ) ) : 'list';
	if ( isset( $_POST['commercekit'] ) ) {
		$commercekit_options = get_option( 'commercekit', array() );
		if ( 'dashboard' === $tab ) {
			if ( ! isset( $_POST['commercekit']['countdown_timer'] ) ) {
				$_POST['commercekit']['countdown_timer'] = 0;

				$countdown = isset( $commercekit_options['countdown'] ) ? $commercekit_options['countdown'] : array();

				$_POST['commercekit']['countdown'] = $countdown;
				if ( isset( $countdown['product']['active'] ) && count( $countdown['product']['active'] ) > 0 ) {
					foreach ( $countdown['product']['active'] as $k => $v ) {
						$_POST['commercekit']['countdown']['product']['active'][ $k ] = 0;
					}
				}
				$_POST['commercekit']['countdown']['checkout']['active'] = 0;
			} else {
				$countdown = isset( $commercekit_options['countdown'] ) ? $commercekit_options['countdown'] : array();

				$_POST['commercekit']['countdown'] = $countdown;
				if ( isset( $countdown['product']['active'] ) && count( $countdown['product']['active'] ) > 0 ) {
					foreach ( $countdown['product']['active'] as $k => $v ) {
						$_POST['commercekit']['countdown']['product']['active'][ $k ] = isset( $countdown['product']['activeo'][ $k ] ) ? $countdown['product']['activeo'][ $k ] : 0;
					}
				}
				$_POST['commercekit']['countdown']['checkout']['active'] = 1;
			}
			if ( ! isset( $_POST['commercekit']['inventory_display'] ) ) {
				$_POST['commercekit']['inventory_display'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['pdp_triggers'] ) ) {
				$_POST['commercekit']['pdp_triggers'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['order_bump'] ) ) {
				$_POST['commercekit']['order_bump'] = 0;

				$order_bump_product = isset( $commercekit_options['order_bump_product'] ) ? $commercekit_options['order_bump_product'] : array();

				$_POST['commercekit']['order_bump_product'] = $order_bump_product;
				if ( isset( $order_bump_product['product']['active'] ) && count( $order_bump_product['product']['active'] ) > 0 ) {
					foreach ( $order_bump_product['product']['active'] as $k => $v ) {
						$_POST['commercekit']['order_bump_product']['product']['active'][ $k ] = 0;
					}
				}
			} else {
				$order_bump_product = isset( $commercekit_options['order_bump_product'] ) ? $commercekit_options['order_bump_product'] : array();

				$_POST['commercekit']['order_bump_product'] = $order_bump_product;
				if ( isset( $order_bump_product['product']['active'] ) && count( $order_bump_product['product']['active'] ) > 0 ) {
					foreach ( $order_bump_product['product']['active'] as $k => $v ) {
						$_POST['commercekit']['order_bump_product']['product']['active'][ $k ] = isset( $order_bump_product['product']['activeo'][ $k ] ) ? $order_bump_product['product']['activeo'][ $k ] : 0;
					}
				}
			}
			if ( ! isset( $_POST['commercekit']['pdp_gallery'] ) ) {
				$_POST['commercekit']['pdp_gallery'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['ajax_search'] ) ) {
				$_POST['commercekit']['ajax_search'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['wishlist'] ) ) {
				$_POST['commercekit']['wishlist'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['waitlist'] ) ) {
				$_POST['commercekit']['waitlist'] = 0;
			}
		}
		if ( 'inventory-bar' === $tab ) {
			if ( ! isset( $_POST['commercekit']['inventory_display'] ) ) {
				$_POST['commercekit']['inventory_display'] = 0;
			}
		}
		if ( 'pdp-triggers' === $tab ) {
			if ( ! isset( $_POST['commercekit']['pdp_triggers'] ) ) {
				$_POST['commercekit']['pdp_triggers'] = 0;
			}
		}
		if ( 'countdown-timer' === $tab ) {
			if ( ! isset( $_POST['commercekit']['countdown']['checkout']['active'] ) ) {
				$_POST['commercekit']['countdown']['checkout']['active'] = 0;
			}
		}
		if ( 'order-bump' === $tab ) {
			if ( ! isset( $_POST['commercekit']['order_bump_product'] ) ) {
				$_POST['commercekit']['order_bump_product'] = array();
			}
		}
		if ( 'pdp-gallery' === $tab ) {
			if ( ! isset( $_POST['commercekit']['pdp_gallery'] ) ) {
				$_POST['commercekit']['pdp_gallery'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['pdp_lightbox'] ) ) {
				$_POST['commercekit']['pdp_lightbox'] = 0;
			}
			$pdp_thumbnails = isset( $_POST['commercekit']['pdp_thumbnails'] ) ? sanitize_text_field( wp_unslash( (int) $_POST['commercekit']['pdp_thumbnails'] ) ) : 4;
			if ( $pdp_thumbnails < 3 || $pdp_thumbnails > 8 ) {
				$_POST['commercekit']['pdp_thumbnails'] = 4;
			}
		}
		if ( 'ajax-search' === $tab ) {
			if ( ! isset( $_POST['commercekit']['ajax_search'] ) ) {
				$_POST['commercekit']['ajax_search'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['ajs_tabbed'] ) ) {
				$_POST['commercekit']['ajs_tabbed'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['ajs_pre_tab'] ) ) {
				$_POST['commercekit']['ajs_pre_tab'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['ajs_hidevar'] ) ) {
				$_POST['commercekit']['ajs_hidevar'] = 0;
			}
		}
		if ( 'waitlist' === $tab ) {
			$bulk_action = isset( $_POST['bulk_action'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_action'] ) ) : '';
			$bulk_apply  = isset( $_POST['bulk_apply'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_apply'] ) ) : 0;
			if ( 1 === (int) $bulk_apply ) {
				return commercekit_admin_waitlist_bulk_action( $bulk_action );
			}
			if ( 'settings' === $section ) {
				if ( ! isset( $_POST['commercekit']['waitlist'] ) ) {
					$_POST['commercekit']['waitlist'] = 0;
				}
			} elseif ( 'emails' === $section ) {
				if ( ! isset( $_POST['commercekit']['waitlist_auto_mail'] ) ) {
					$_POST['commercekit']['waitlist_auto_mail'] = 0;
				}
				if ( ! isset( $_POST['commercekit']['waitlist_admin_mail'] ) ) {
					$_POST['commercekit']['waitlist_admin_mail'] = 0;
				}
				if ( ! isset( $_POST['commercekit']['waitlist_user_mail'] ) ) {
					$_POST['commercekit']['waitlist_user_mail'] = 0;
				}
			} else {
				return false;
			}
		}
		if ( 'wishlist' === $tab ) {
			if ( ! isset( $_POST['commercekit']['wishlist'] ) ) {
				$_POST['commercekit']['wishlist'] = 0;
			}
		}
		if ( 'support' === $tab ) {
			$fname    = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
			$email    = isset( $_POST['email'] ) ? sanitize_text_field( wp_unslash( $_POST['email'] ) ) : '';
			$url      = isset( $_POST['url'] ) ? sanitize_text_field( wp_unslash( $_POST['url'] ) ) : '';
			$title    = isset( $_POST['title'] ) ? sanitize_text_field( wp_unslash( $_POST['title'] ) ) : '';
			$question = isset( $_POST['question'] ) ? sanitize_textarea_field( wp_unslash( $_POST['question'] ) ) : '';
			$width    = isset( $_POST['screen_width'] ) ? sanitize_text_field( wp_unslash( $_POST['screen_width'] ) ) : '';
			$height   = isset( $_POST['screen_height'] ) ? sanitize_text_field( wp_unslash( $_POST['screen_height'] ) ) : '';
			$to_mail  = 'support@commercegurus.com';
			if ( ! empty( $email ) && ! empty( $url ) && ! empty( $title ) && ! empty( $question ) ) {
				global $wp_version, $woocommerce;
				$version       = explode( '.', phpversion() );
				$theme         = wp_get_theme();
				$template      = $theme->get_template();
				$theme_data    = wp_get_theme( 'shoptimizer' );
				$email_headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $email, 'Reply-To: ' . $email );
				$email_subject = $title;
				$email_body    = '
<p>' . nl2br( $question ) . '</p>
<p>&nbsp;</p>
<hr/>
<p>First name: <br />' . $fname . '</p>
<p>URL: <br />' . $url . '</p>
<p>Subscription number: <br />#' . commercekit_get_subscription_number() . '</p>
<p>Commercekit version: <br />' . CGKIT_CSS_JS_VER . '</p>
<p>Shoptimizer version: <br />' . ( isset( $theme_data['Version'] ) && false !== stripos( $theme_data['Name'], 'shoptimizer' ) ? esc_html( $theme_data['Version'] ) : 'Shoptimizer is not active' ) . '</p>
<p>WordPress version: <br />' . esc_html( $wp_version ) . '</p>
<p>WooCommerce version: <br />' . ( isset( $woocommerce->version ) ? esc_html( $woocommerce->version ) : '' ) . '</p>
<p>Using a child theme?<br />' . ( isset( $template ) && false !== stripos( $template, '-child' ) ? 'Yes' : 'No' ) . '</p>
<p>PHP version: <br />' . $version[0] . '.' . $version[1] . '.' . $version[2] . '</p>
<p>OS Platform: <br />' . commercekit_admin_get_os() . '</p>
<p>Browser: <br />' . commercekit_admin_get_browser() . '</p>
<p>Screen Width: <br />' . $width . '</p>
<p>Screen Height: <br />' . $height . '</p>
<p>Site URL: <br />' . home_url( '/' ) . '</p>';

				$success = wp_mail( $to_mail, $email_subject, $email_body, $email_headers );
				if ( $success ) {
					return esc_html__( 'Your email has been sent to our support team.', 'commercegurus-commercekit' );
				} else {
					return esc_html__( 'Error on sending email to support team.', 'commercegurus-commercekit' );
				}
			} else {
				return false;
			}
		}

		$commercekit = map_deep( wp_unslash( $_POST['commercekit'] ), 'sanitize_textarea_field' );
		foreach ( $commercekit as $key => $value ) {
			$commercekit_options[ $key ] = $value;
		}
		$editor_keys  = array( 'wtl_auto_content', 'wtl_admin_content', 'wtl_user_content', 'wtl_intro', 'wtl_consent_text', 'wtl_success_text' );
		$allowed_html = commercekit_editor_allowed_html();
		foreach ( $editor_keys as $ekey ) {
			if ( isset( $_POST['commercekit'][ $ekey ] ) ) {
				$commercekit_options[ $ekey ] = wp_kses( wp_unslash( $_POST['commercekit'][ $ekey ] ), $allowed_html );
			}
		}

		update_option( 'commercekit', $commercekit_options );
	}

	return true;
}

/**
 * Adding admin setting page HTML
 */
function commercekit_admin_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	global $commerce_gurus_commercekit;

	$success = commercekit_admin_page_update();

	$commercekit_nonce = isset( $_POST['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['commercekit_nonce'] ) ) : '';
	$verify_nonce      = wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' );
	$notice            = '';
	$tab               = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'dashboard';
	$section           = isset( $_GET['section'] ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : 'list';
	if ( true === $success ) {
		$notice = esc_html__( 'CommerceKit Settings has been saved.', 'commercegurus-commercekit' );
	} elseif ( false !== $success ) {
		$notice = $success;
	} else {
		$notice = '';
	}
	$commercekit_options = get_option( 'commercekit', array() );
	$domain_connected    = commercekit_is_domain_connected();
	$environment_warning = $commerce_gurus_commercekit->get_environment_warning();
	?>
	<div class="wrap">
		<?php if ( ! empty( $notice ) && 'support' !== $tab ) { ?>
		<div class="notice notice-success is-dismissible"><p><?php echo esc_html( $notice ); ?></p></div>
		<?php } ?>
		<?php if ( ! $environment_warning ) { ?>
		<form action="" method="post" id="commercekit-form" enctype="multipart/form-data" class="form-horizontal">
		<div id="ajax-loading-mask"><div class="ajax-loading"></div></div>
		<h1 style="display: none;">&nbsp;</h1>
		<div class="setting-page-title"><?php echo esc_html( get_admin_page_title() ); ?></div>
		<p class="intro"><?php esc_html_e( 'Conversion-boosting, performance-focused eCommerce features which work together seamlessly. From', 'commercegurus-commercekit' ); ?> <a href="https://www.commercegurus.com/" target="_blank"><?php esc_html_e( 'CommerceGurus', 'commercegurus-commercekit' ); ?></a>.</p>
		<nav class="nav-tab-wrapper" id="settings-tabs">
			<a href="?page=commercekit" data-tab="dashboard" class="nav-tab <?php echo 'dashboard' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Dashboard', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=ajax-search" data-tab="ajax-search" class="nav-tab <?php echo 'ajax-search' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Ajax Search', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=countdown-timer" data-tab="countdown-timer" class="nav-tab <?php echo 'countdown-timer' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Countdowns', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=order-bump" data-tab="order-bump" class="nav-tab <?php echo 'order-bump' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Order Bump', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=pdp-gallery" data-tab="pdp-gallery" class="nav-tab <?php echo 'pdp-gallery' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Product Gallery', 'commercegurus-commercekit' ); ?><sup style="margin-left: 3px; font-size: 9px;">BETA</sup></a>
			<a href="?page=commercekit&tab=inventory-bar" data-tab="inventory-bar" class="nav-tab <?php echo 'inventory-bar' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Stock Meter', 'commercegurus-commercekit' ); ?></a>
			<a style="display: none;" href="?page=commercekit&tab=pdp-triggers" data-tab="pdp-triggers" class="nav-tab <?php echo 'pdp-triggers' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'PDP Triggers', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=waitlist" data-tab="waitlist" class="nav-tab <?php echo 'waitlist' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Waitlist', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=wishlist" data-tab="wishlist" class="nav-tab <?php echo 'wishlist' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Wishlist', 'commercegurus-commercekit' ); ?></a>
			<?php if ( $domain_connected ) { ?>
				<a href="?page=commercekit&tab=support" data-tab="waitlist" class="nav-tab <?php echo 'support' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Support', 'commercegurus-commercekit' ); ?></a>
			<?php } ?>
		</nav>

		<div class="tab-content">
			<?php
			switch ( $tab ) {
				case 'dashboard':
					require_once dirname( __FILE__ ) . '/admin-dashboard.php';
					break;
				case 'countdown-timer':
					require_once dirname( __FILE__ ) . '/admin-countdown-timer.php';
					break;
				case 'inventory-bar':
					require_once dirname( __FILE__ ) . '/admin-inventory-bar.php';
					break;
				case 'pdp-triggers':
					require_once dirname( __FILE__ ) . '/admin-pdp-triggers.php';
					break;
				case 'order-bump':
					require_once dirname( __FILE__ ) . '/admin-order-bump.php';
					break;
				case 'pdp-gallery':
					require_once dirname( __FILE__ ) . '/admin-pdp-gallery.php';
					break;
				case 'ajax-search':
					require_once dirname( __FILE__ ) . '/admin-ajax-search.php';
					break;
				case 'wishlist':
					require_once dirname( __FILE__ ) . '/admin-wishlist.php';
					break;
				case 'waitlist':
					require_once dirname( __FILE__ ) . '/admin-waitlist.php';
					break;
				case 'support':
					if ( $domain_connected ) {
						require_once dirname( __FILE__ ) . '/admin-support.php';
					}
					break;
			}
			?>
		</div>
		<div class="submit-button">
			<input type="hidden" name="commercekit[settings]" value="1" />
			<?php wp_nonce_field( 'commercekit_settings', 'commercekit_nonce' ); ?>
			<?php if ( 'dashboard' !== $tab && 'support' !== $tab && ! ( 'waitlist' === $tab && 'list' === $section ) && ! ( 'ajax-search' === $tab && 'reports' === $section ) ) { ?>
				<input type="submit" name="btn-submit" id="btn-submit" class="button button-primary" value="Save Changes">
			<?php } ?>
		</div>
		</form>
		<?php } ?>
	</div>
	<?php
}

/**
 * Get products or categories IDs
 */
function commercekit_get_pcids() {
	global $cgkit_asku_search;
	$return            = array();
	$commercekit_nonce = isset( $_POST['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['commercekit_nonce'] ) ) : '';
	$verify_nonce      = wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' );
	$type              = isset( $_GET['type'] ) ? sanitize_text_field( wp_unslash( $_GET['type'] ) ) : 'products';
	$tab               = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';
	$mode              = isset( $_GET['mode'] ) ? sanitize_text_field( wp_unslash( $_GET['mode'] ) ) : '';
	$cgkit_asku_search = false;

	if ( 'products' === $type ) {
		if ( 'order-bump' === $tab && 'full' === $mode ) {
			$post_types        = array( 'product', 'product_variation' );
			$cgkit_asku_search = true;
		} else {
			$post_types = array( 'product' );
		}
		$query = ! empty( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
		$args  = array(
			's'              => $query,
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'post_type'      => $post_types,
		);
		if ( is_numeric( $query ) ) {
			unset( $args['s'] );
			$args['post__in'] = array( $query );
		}

		$search_results = new WP_Query( $args );

		if ( $search_results->have_posts() ) {
			while ( $search_results->have_posts() ) {
				$search_results->the_post();
				if ( 'product' === $search_results->post->post_type ) {
					$product = wc_get_product( $search_results->post->ID );
					if ( ! $product || ( ! $product->is_type( 'simple' ) && ! $product->is_type( 'variable' ) ) ) {
						continue;
					}
				}
				$title    = commercekit_limit_title( $search_results->post->post_title );
				$title    = '#' . $search_results->post->ID . ' - ' . $title;
				$return[] = array( $search_results->post->ID, $title );
			}
		}
	} elseif ( 'pages' === $type ) {
		$query = ! empty( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
		$args  = array(
			's'              => $query,
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'post_type'      => 'page',
		);
		if ( is_numeric( $query ) ) {
			unset( $args['s'] );
			$args['post__in'] = array( $query );
		}

		$search_results = new WP_Query( $args );

		if ( $search_results->have_posts() ) {
			while ( $search_results->have_posts() ) {
				$search_results->the_post();
				$title    = ( mb_strlen( $search_results->post->post_title ) > 80 ) ? mb_substr( $search_results->post->post_title, 0, 79 ) . '...' : $search_results->post->post_title;
				$title    = '#' . $search_results->post->ID . ' - ' . $title;
				$return[] = array( $search_results->post->ID, $title );
			}
		}
	} else {
		$query = ! empty( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
		$args  = array(
			'name__like' => $query,
			'hide_empty' => true,
			'number'     => 20,
		);
		if ( is_numeric( $query ) ) {
			$terms = array( get_term( $query, 'product_cat' ) );
		} else {
			$terms = get_terms( 'product_cat', $args );
		}
		if ( is_array( $terms ) && count( $terms ) > 0 ) {
			foreach ( $terms as $term ) {
				if ( isset( $term->name ) ) {
					$term->name = '#' . $term->term_id . ' - ' . $term->name;
					$return[]   = array( $term->term_id, $term->name );
				}
			}
		}
	}

	echo wp_json_encode( $return );
	exit();
}

add_action( 'wp_ajax_commercekit_get_pcids', 'commercekit_get_pcids' );

/**
 * Admin ajax save settings
 */
function commercekit_ajax_save_settings() {
	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on saving settings.', 'commercegurus-commercekit' );

	$return = commercekit_admin_page_update();
	if ( $return ) {
		$ajax['status']  = 1;
		$ajax['message'] = esc_html__( 'Settings has been saved.', 'commercegurus-commercekit' );
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_save_settings', 'commercekit_ajax_save_settings' );

/**
 * Admin waitlist bulk action
 *
 * @param  string $bulk_action of waitlist.
 * @return string
 */
function commercekit_admin_waitlist_bulk_action( $bulk_action ) {
	global $wpdb;
	if ( 'export' === $bulk_action ) {
		$rows = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'commercekit_waitlist ORDER BY created', ARRAY_A ); // db call ok; no-cache ok.
		if ( is_array( $rows ) && count( $rows ) ) {
			return false;
		} else {
			return esc_html__( 'There are no waitlist for export.', 'commercegurus-commercekit' );
		}
	} elseif ( 'delete' === $bulk_action ) {
		$nonce   = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
		$wtl_ids = isset( $_POST['wtl_ids'] ) ? map_deep( wp_unslash( $_POST['wtl_ids'] ), 'sanitize_text_field' ) : array();
		if ( is_array( $wtl_ids ) && count( $wtl_ids ) ) {
			foreach ( $wtl_ids as $wtl_id ) {
				$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'commercekit_waitlist WHERE id IN (%s)', $wtl_id ) ); // db call ok; no-cache ok.
			}
			return esc_html__( 'Selected waitlist has been deleted.', 'commercegurus-commercekit' );
		} else {
			return esc_html__( 'Please select at least one waitlist for delete.', 'commercegurus-commercekit' );
		}
	}

	return false;
}

/**
 *  Admin waitlist bulk export
 */
function commercekit_admin_waitlist_export() {
	global $wpdb;
	$nonce       = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$tab         = isset( $_POST['tab'] ) ? sanitize_text_field( wp_unslash( $_POST['tab'] ) ) : '';
	$bulk_action = isset( $_POST['bulk_action'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_action'] ) ) : '';
	$bulk_apply  = isset( $_POST['bulk_apply'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_apply'] ) ) : 0;
	if ( 'waitlist' === $tab && 'export' === $bulk_action && 1 === (int) $bulk_apply ) {
		$rows = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'commercekit_waitlist ORDER BY created', ARRAY_A ); // db call ok; no-cache ok.
		if ( is_array( $rows ) && count( $rows ) ) {
			$output = fopen( 'php://output', 'w' );
			header( 'Content-Type: text/csv; charset=UTF-8' );
			header( 'Content-Transfer-Encoding: Binary' );
			header( 'Content-Disposition: attachment; filename="Waitlist.csv"' );
			$headers = array( 'Email', 'Product', 'Date added' );
			fputcsv( $output, $headers );
			if ( count( $rows ) ) {
				foreach ( $rows as $row ) {
					$tmp   = array();
					$tmp[] = $row['email'];
					$tmp[] = get_the_title( $row['product_id'] );
					$tmp[] = gmdate( 'j F Y', $row['created'] );
					fputcsv( $output, $tmp );
				}
			}
			fclose( $output ); // phpcs:ignore
			exit();
		}
	}
}
add_action( 'admin_init', 'commercekit_admin_waitlist_export' );

/**
 *  Get browser OS
 */
function commercekit_admin_get_os() {
	$user_agent  = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
	$os_platform = 'Unknown OS Platform';

	$os_array = array(
		'/windows nt 10/i'      => 'Windows 10',
		'/windows nt 6.3/i'     => 'Windows 8.1',
		'/windows nt 6.2/i'     => 'Windows 8',
		'/windows nt 6.1/i'     => 'Windows 7',
		'/windows nt 6.0/i'     => 'Windows Vista',
		'/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     => 'Windows XP',
		'/windows xp/i'         => 'Windows XP',
		'/windows nt 5.0/i'     => 'Windows 2000',
		'/windows me/i'         => 'Windows ME',
		'/win98/i'              => 'Windows 98',
		'/win95/i'              => 'Windows 95',
		'/win16/i'              => 'Windows 3.11',
		'/macintosh|mac os x/i' => 'Mac OS X',
		'/mac_powerpc/i'        => 'Mac OS 9',
		'/linux/i'              => 'Linux',
		'/ubuntu/i'             => 'Ubuntu',
		'/iphone/i'             => 'iPhone',
		'/ipod/i'               => 'iPod',
		'/ipad/i'               => 'iPad',
		'/android/i'            => 'Android',
		'/blackberry/i'         => 'BlackBerry',
		'/webos/i'              => 'Mobile',
	);

	foreach ( $os_array as $index => $value ) {
		if ( preg_match( $index, $user_agent ) ) {
			$os_platform = $value;
		}
	}
	return $os_platform;
}

/**
 *  Get browser name
 */
function commercekit_admin_get_browser() {
	$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
	$browser    = 'Unknown Browser';

	$browsers = array(
		'/msie/i'      => 'Internet Explorer',
		'/firefox/i'   => 'Firefox',
		'/safari/i'    => 'Safari',
		'/chrome/i'    => 'Chrome',
		'/edge/i'      => 'Edge',
		'/opera/i'     => 'Opera',
		'/netscape/i'  => 'Netscape',
		'/maxthon/i'   => 'Maxthon',
		'/konqueror/i' => 'Konqueror',
		'/mobile/i'    => 'Handheld Browser',
	);

	foreach ( $browsers as $index => $value ) {
		if ( preg_match( $index, $user_agent ) ) {
			$browser = $value;
		}
	}

	return $browser;
}

/**
 *  Get domain connected status
 */
function commercekit_is_domain_connected() {
	if ( ! class_exists( 'CG_Helper' ) ) {
		return false;
	}

	$whitelisted = CG_Helper::maybe_whitelisted();
	if ( isset( $whitelisted['domain_auth'] ) && '1' === $whitelisted['domain_auth'] ) {
		return true;
	}

	if ( ! isset( $subscriptions ) ) {
		$subscriptions = CG_Helper::get_subscriptions();
	}

	if ( empty( $subscriptions ) ) {
		return false;
	}

	$theme    = wp_get_theme();
	$template = $theme->get_template();
	if ( false === stripos( $template, 'shoptimizer' ) ) {
		return false;
	}

	$theme  = wp_get_theme( 'shoptimizer' );
	$header = $theme->get( 'CGMeta' );

	if ( empty( $header ) ) {
		return false;
	}

	list( $product_id, $file_id ) = explode( ':', $header );
	if ( empty( $product_id ) || empty( $file_id ) ) {
		return false;
	}

	foreach ( $subscriptions as $subscription ) {
		if ( (string) $subscription['product_id'] !== (string) $product_id ) {
			continue;
		}

		if ( 'active' === $subscription['sub_status'] || 'pending-cancel' === $subscription['sub_status'] ) {
			return true;
		}
	}

	return false;
}

/**
 *  Get subscription number
 */
function commercekit_get_subscription_number() {
	if ( ! class_exists( 'CG_Helper' ) ) {
		return 0;
	}

	if ( ! isset( $subscriptions ) ) {
		$subscriptions = CG_Helper::get_subscriptions();
	}

	if ( empty( $subscriptions ) ) {
		return 0;
	}

	$theme    = wp_get_theme();
	$template = $theme->get_template();
	if ( false === stripos( $template, 'shoptimizer' ) ) {
		return 0;
	}

	$theme  = wp_get_theme( 'shoptimizer' );
	$header = $theme->get( 'CGMeta' );

	if ( empty( $header ) ) {
		return 0;
	}

	list( $product_id, $file_id ) = explode( ':', $header );
	if ( empty( $product_id ) || empty( $file_id ) ) {
		return 0;
	}

	foreach ( $subscriptions as $subscription ) {
		if ( (string) $subscription['product_id'] !== (string) $product_id ) {
			continue;
		}

		if ( 'active' === $subscription['sub_status'] || 'pending-cancel' === $subscription['sub_status'] ) {
			return $subscription['sub_id'];
		}
	}

	return 0;
}

/**
 * Get limit title
 *
 * @param  string $title_text of limit output.
 *
 * @return  string
 */
function commercekit_limit_title( $title_text ) {
	$title_text = ( mb_strlen( $title_text ) > 80 ) ? mb_substr( $title_text, 0, 79 ) . '...' : $title_text;
	return $title_text;
}

/**
 *  Make multilingual strings
 */
function commercekit_make_multilingual_strings() {
	$options = get_option( 'commercekit', array() );
	$keys    = array( 'ajs_placeholder', 'ajs_other_text', 'ajs_no_text', 'ajs_all_text', 'inventory_text', 'inventory_text_31', 'inventory_text_100', 'wtl_intro', 'wtl_email_text', 'wtl_button_text', 'wtl_consent_text', 'wtl_success_text', 'wsl_adtext', 'wsl_pdtext', 'wsl_brtext' );
	if ( function_exists( 'pll_register_string' ) ) {
		foreach ( $keys as $key ) {
			if ( isset( $options[ $key ] ) && ! empty( $options[ $key ] ) ) {
				$pll_slug = str_replace( '_', '-', $key );
				pll_register_string( $pll_slug, $options[ $key ], 'commercegurus-commercekit' );
			}
		}
		if ( isset( $options['countdown']['product']['title'] ) ) {
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['title'], 'countdown-product-title', 'polylang' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['days_label'], 'countdown-product-days-label', 'polylang' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['hours_label'], 'countdown-product-hours-label', 'polylang' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['minutes_label'], 'countdown-product-minutes-label', 'polylang' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['seconds_label'], 'countdown-product-seconds-label', 'polylang' );
		}
		if ( isset( $options['countdown']['checkout']['title'] ) ) {
			commercekit_make_array_multilingual_strings( $options['countdown']['checkout']['title'], 'countdown-checkout-title', 'polylang' );
			commercekit_make_array_multilingual_strings( $options['countdown']['checkout']['expiry_message'], 'countdown-checkout-expiry-message', 'polylang' );
		}
		if ( isset( $options['order_bump_product']['product']['title'] ) ) {
			commercekit_make_array_multilingual_strings( $options['order_bump_product']['product']['title'], 'order-bump-product-title', 'polylang' );
			commercekit_make_array_multilingual_strings( $options['order_bump_product']['product']['button_text'], 'order-bump-product-button-text', 'polylang' );
			commercekit_make_array_multilingual_strings( $options['order_bump_product']['product']['button_added'], 'order-bump-product-button-added', 'polylang' );
		}
	} elseif ( function_exists( 'icl_register_string' ) ) {
		foreach ( $keys as $key ) {
			if ( isset( $options[ $key ] ) && ! empty( $options[ $key ] ) ) {
				icl_register_string( 'commercegurus-commercekit', $options[ $key ], $options[ $key ] );
			}
		}
		if ( isset( $options['countdown']['product']['title'] ) ) {
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['title'], 'countdown-product-title', 'wpml' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['days_label'], 'countdown-product-days-label', 'wpml' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['hours_label'], 'countdown-product-hours-label', 'wpml' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['minutes_label'], 'countdown-product-minutes-label', 'wpml' );
			commercekit_make_array_multilingual_strings( $options['countdown']['product']['seconds_label'], 'countdown-product-seconds-label', 'wpml' );
		}
		if ( isset( $options['countdown']['checkout']['title'] ) ) {
			commercekit_make_array_multilingual_strings( $options['countdown']['checkout']['title'], 'countdown-checkout-title', 'wpml' );
			commercekit_make_array_multilingual_strings( $options['countdown']['checkout']['expiry_message'], 'countdown-checkout-expiry-message', 'wpml' );
		}
		if ( isset( $options['order_bump_product']['product']['title'] ) ) {
			commercekit_make_array_multilingual_strings( $options['order_bump_product']['product']['title'], 'order-bump-product-title', 'wpml' );
			commercekit_make_array_multilingual_strings( $options['order_bump_product']['product']['button_text'], 'order-bump-product-button-text', 'wpml' );
			commercekit_make_array_multilingual_strings( $options['order_bump_product']['product']['button_added'], 'order-bump-product-button-added', 'wpml' );
		}
	}
}
add_action( 'init', 'commercekit_make_multilingual_strings' );

/**
 *  Make array of multilingual strings
 *
 * @param mixed  $array of multilingual array.
 * @param string $key of multilingual key.
 * @param string $type of multilingual type.
 */
function commercekit_make_array_multilingual_strings( $array, $key, $type ) {
	if ( is_array( $array ) ) {
		foreach ( $array as $k => $v ) {
			if ( 'polylang' === $type ) {
				pll_register_string( $key . '-' . $k, $v, 'commercegurus-commercekit' );
			} else {
				icl_register_string( 'commercegurus-commercekit', $v, $v );
			}
		}
	} else {
		if ( 'polylang' === $type ) {
			pll_register_string( $key, $array, 'commercegurus-commercekit' );
		} else {
			icl_register_string( 'commercegurus-commercekit', $array, $array );
		}
	}
}

/**
 *  Get multilingual string
 *
 * @param string $text of multilingual string.
 */
function commercekit_get_multilingual_string( $text ) {
	if ( function_exists( 'pll__' ) ) {
		$text = pll__( $text );
	} elseif ( function_exists( 'icl_translate' ) ) {
		$text = icl_translate( 'commercegurus-commercekit', $text );
	}
	return $text;
}

/**
 *  Get editor allowed html
 *
 * @return $allowed_html mixed allowed html.
 */
function commercekit_editor_allowed_html() {
	$allowed_html = array(
		'p'      => array(
			'class' => array(),
			'style' => array(),
		),
		'span'   => array(
			'class' => array(),
			'style' => array(),
		),
		'a'      => array(
			'href' => array(),
		),
		'br'     => array(),
		'strong' => array(),
		'em'     => array(),
		'u'      => array(),
		'ul'     => array(),
		'ol'     => array(),
		'li'     => array(),
		'del'    => array(),
	);

	return $allowed_html;
}

/**
 * Custom admin SKU search query
 *
 * @param  string $query of search.
 */
function commercekit_admin_sku_pre_get_posts( $query ) {
	global $cgkit_asku_search;
	if ( isset( $cgkit_asku_search ) && $cgkit_asku_search ) {
		add_filter( 'posts_join', 'commercekit_admin_sku_search_join', 99, 1 );
		add_filter( 'posts_where', 'commercekit_admin_sku_search_where', 99, 1 );
		add_filter( 'posts_groupby', 'commercekit_admin_sku_search_groupby', 99, 1 );
	}
}
add_action( 'pre_get_posts', 'commercekit_admin_sku_pre_get_posts', 99, 1 );

/**
 * Custom admin SKU search join
 *
 * @param  string $join of join.
 */
function commercekit_admin_sku_search_join( $join ) {
	global $wpdb;
	$join .= " LEFT JOIN $wpdb->postmeta sku_meta ON ( " . $wpdb->posts . ".ID = sku_meta.post_id AND sku_meta.meta_key='_sku' ) LEFT JOIN {$wpdb->posts} parents ON ( " . $wpdb->posts . '.post_parent = parents.ID AND ' . $wpdb->posts . ".post_parent != '0' )";

	return $join;
}

/**
 * Custom admin SKU search where
 *
 * @param  string $where of where.
 */
function commercekit_admin_sku_search_where( $where ) {
	global $wpdb;
	$where = preg_replace(
		"/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
		"({$wpdb->posts}.post_title LIKE $1) OR (sku_meta.meta_value LIKE $1)",
		$where
	);

	return $where . ' AND ( ' . $wpdb->posts . ".post_parent = '0' OR parents.post_status = 'publish' ) ";
}

/**
 * Custom admin SKU search groupby
 *
 * @param  string $groupby of groupby.
 */
function commercekit_admin_sku_search_groupby( $groupby ) {
	global $wpdb;
	$mygroupby = "{$wpdb->posts}.ID";
	if ( preg_match( "/$mygroupby/", $groupby ) ) {
		return $groupby;
	}
	if ( ! strlen( trim( $groupby ) ) ) {
		return $mygroupby;
	}

	return $groupby . ', ' . $mygroupby;
}
