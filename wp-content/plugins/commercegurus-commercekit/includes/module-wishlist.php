<?php
/**
 *
 * Wishlist module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Ajax save wishlist
 */
function commercekit_ajax_save_wishlist() {
	global $wpdb;
	$commercekit_options = get_option( 'commercekit', array() );

	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on submitting for wishlist list.', 'commercegurus-commercekit' );
	$ajax['html']    = '';

	$table = $wpdb->prefix . 'commercekit_wishlist';
	$nonce = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$pid   = isset( $_POST['product_id'] ) ? sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : 0;
	$type  = isset( $_POST['type'] ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : 'page';
	$uid   = get_current_user_id();
	$key   = isset( $_COOKIE['commercekit_wishlist'] ) && ! empty( $_COOKIE['commercekit_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['commercekit_wishlist'] ) ) : md5( microtime( true ) );
	$sid   = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist WHERE session_key = %s', $key ) ); // db call ok; no-cache ok.
	if ( ! $uid && ! $sid ) {
		$table  = $wpdb->prefix . 'commercekit_wishlist';
		$data   = array(
			'session_key' => $key,
		);
		$format = array( '%s' );
		$wpdb->insert( $table, $data, $format ); // db call ok; no-cache ok.
		$sid = $wpdb->insert_id;
		setcookie( 'commercekit_wishlist', $key, time() + ( 365 * 24 * 3600 ), '/' );
	} elseif ( $uid && $sid ) {
		$table  = $wpdb->prefix . 'commercekit_wishlist_items';
		$data   = array(
			'user_id' => $uid,
			'list_id' => 0,
		);
		$where  = array(
			'list_id' => $sid,
		);
		$format = array( '%d', '%d' );
		$wpdb->update( $table, $data, $where, $format ); // db call ok; no-cache ok.

		$table  = $wpdb->prefix . 'commercekit_wishlist';
		$data   = array(
			'id' => $sid,
		);
		$format = array( '%d' );
		$wpdb->delete( $table, $data, $format ); // db call ok; no-cache ok.
		setcookie( 'commercekit_wishlist', $key, time() - ( 365 * 24 * 3600 ), '/' );
	}

	if ( $pid ) {
		$table  = $wpdb->prefix . 'commercekit_wishlist_items';
		$data   = array(
			'user_id'    => $uid,
			'list_id'    => $sid,
			'product_id' => $pid,
			'created'    => time(),
		);
		$format = array( '%d', '%d', '%d', '%d' );
		$wpdb->insert( $table, $data, $format ); // db call ok; no-cache ok.

		$wsl_adtext     = isset( $commercekit_options['wsl_adtext'] ) && ! empty( $commercekit_options['wsl_adtext'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wsl_adtext'] ) ) : esc_html__( 'Add to wishlist', 'commercegurus-commercekit' );
		$wsl_brtext     = isset( $commercekit_options['wsl_brtext'] ) && ! empty( $commercekit_options['wsl_brtext'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wsl_brtext'] ) ) : esc_html__( 'Browse wishlist', 'commercegurus-commercekit' );
		$wsl_pdtext     = isset( $commercekit_options['wsl_pdtext'] ) && ! empty( $commercekit_options['wsl_pdtext'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wsl_pdtext'] ) ) : esc_html__( 'Product added', 'commercegurus-commercekit' );
		$wsl_page       = isset( $commercekit_options['wsl_page'] ) ? esc_attr( $commercekit_options['wsl_page'] ) : 0;
		$wsl_page_link  = get_permalink( $wsl_page );
		$ajax['status'] = 1;
		if ( 'page' === $type ) {
			$ajax['html'] = '<a href="' . $wsl_page_link . '" class="commercekit-browse-wishlist" aria-label="' . esc_html__( 'Wishlist', 'commercegurus-commercekit' ) . '"><i class="cg-wishlist-t"></i><span>' . $wsl_brtext . '</span></a>';
		} else {
			$ajax['html'] = '<a href="' . $wsl_page_link . '" class="commercekit-browse-wishlist" aria-label="' . esc_html__( 'Wishlist', 'commercegurus-commercekit' ) . '"><i class="cg-wishlist-t"></i><span></span></a>';
		}
		$ajax['message'] = $wsl_pdtext . '';
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_save_wishlist', 'commercekit_ajax_save_wishlist' );
add_action( 'wp_ajax_nopriv_commercekit_save_wishlist', 'commercekit_ajax_save_wishlist' );

/**
 * Convert saved wishlist
 *
 * @param  string $login of user.
 */
function commercekit_convert_saved_wishlist( $login ) {
	global $wpdb;
	$table = $wpdb->prefix . 'commercekit_wishlist';
	$nonce = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$user  = get_user_by( 'login', $login );
	$uid   = $user->ID;
	$key   = isset( $_COOKIE['commercekit_wishlist'] ) && ! empty( $_COOKIE['commercekit_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['commercekit_wishlist'] ) ) : '';
	$sid   = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist WHERE session_key = %s', $key ) ); // db call ok; no-cache ok.
	if ( $uid && $sid ) {
		$table  = $wpdb->prefix . 'commercekit_wishlist_items';
		$data   = array(
			'user_id' => $uid,
			'list_id' => 0,
		);
		$where  = array(
			'list_id' => $sid,
		);
		$format = array( '%d', '%d' );
		$wpdb->update( $table, $data, $where, $format ); // db call ok; no-cache ok.

		$table  = $wpdb->prefix . 'commercekit_wishlist';
		$data   = array(
			'id' => $sid,
		);
		$format = array( '%d' );
		$wpdb->delete( $table, $data, $format ); // db call ok; no-cache ok.
		setcookie( 'commercekit_wishlist', $key, time() - ( 365 * 24 * 3600 ), '/' );
	}
}
add_action( 'wp_login', 'commercekit_convert_saved_wishlist', 99 );

/**
 * Ajax remove wishlist
 */
function commercekit_ajax_remove_wishlist() {
	global $wpdb;
	$commercekit_options = get_option( 'commercekit', array() );

	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on submitting for wishlist list.', 'commercegurus-commercekit' );
	$ajax['html']    = '';

	$table  = $wpdb->prefix . 'commercekit_wishlist';
	$nonce  = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$pid    = isset( $_POST['product_id'] ) ? sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : 0;
	$wpage  = isset( $_POST['wpage'] ) ? sanitize_text_field( wp_unslash( $_POST['wpage'] ) ) : 1;
	$reload = isset( $_POST['reload'] ) ? sanitize_text_field( wp_unslash( $_POST['reload'] ) ) : 0;
	$uid    = get_current_user_id();
	$key    = isset( $_COOKIE['commercekit_wishlist'] ) && ! empty( $_COOKIE['commercekit_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['commercekit_wishlist'] ) ) : md5( microtime( true ) );
	$sid    = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist WHERE session_key = %s', $key ) ); // db call ok; no-cache ok.

	if ( $pid && $uid ) {
		$table  = $wpdb->prefix . 'commercekit_wishlist_items';
		$data   = array(
			'user_id'    => $uid,
			'product_id' => $pid,
		);
		$format = array( '%d', '%d' );
		$wpdb->delete( $table, $data, $format ); // db call ok; no-cache ok.
	}
	if ( $pid && $sid ) {
		$table  = $wpdb->prefix . 'commercekit_wishlist_items';
		$data   = array(
			'list_id'    => $sid,
			'product_id' => $pid,
		);
		$format = array( '%d', '%d' );
		$wpdb->delete( $table, $data, $format ); // db call ok; no-cache ok.
	}

	$ajax['status'] = 1;
	$ajax['html']   = '<a href="#wishlists" class="commercekit-save-wishlist" data-product-id="' . $pid . '" data-type="list" aria-label="' . esc_html__( 'Wishlist', 'commercegurus-commercekit' ) . '"><i class="cg-wishlist"></i><span></span></a>';

	$ajax['message'] = esc_html__( 'Product removed', 'commercegurus-commercekit' );
	if ( $reload ) {
		$_REQUEST['wpage']  = $wpage;
		$_REQUEST['reload'] = 1;
		$ajax['html']       = do_shortcode( '[commercegurus_wishlist]' );
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_remove_wishlist', 'commercekit_ajax_remove_wishlist' );
add_action( 'wp_ajax_nopriv_commercekit_remove_wishlist', 'commercekit_ajax_remove_wishlist' );

/**
 * Single Product Page - Display wishlist
 */
function commercekit_single_product_wishlist() {
	global $wpdb;
	global $product;
	$commercekit_wishlist = false;
	$commercekit_options  = get_option( 'commercekit', array() );
	if ( isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ) {
		$commercekit_wishlist = true;
	}
	if ( $commercekit_wishlist ) {
		$pid = $product->get_id();
		$uid = get_current_user_id();
		$key = isset( $_COOKIE['commercekit_wishlist'] ) && ! empty( $_COOKIE['commercekit_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['commercekit_wishlist'] ) ) : '';
		$wid = 0;
		if ( $uid ) {
			$wid = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist_items WHERE user_id = %d AND product_id = %d', $uid, $pid ) ); // db call ok; no-cache ok.
		} elseif ( $key ) {
			$sid = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist WHERE session_key = %s', $key ) ); // db call ok; no-cache ok.
			if ( $sid ) {
				$wid = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist_items WHERE list_id = %d AND product_id = %d', $sid, $pid ) ); // db call ok; no-cache ok.
			}
		}

		if ( $wid ) {
			$wsl_brtext    = isset( $commercekit_options['wsl_brtext'] ) && ! empty( $commercekit_options['wsl_brtext'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wsl_brtext'] ) ) : esc_html__( 'Browse wishlist', 'commercegurus-commercekit' );
			$wsl_page      = isset( $commercekit_options['wsl_page'] ) ? esc_attr( $commercekit_options['wsl_page'] ) : 0;
			$wsl_page_link = get_permalink( $wsl_page );
			$html          = '<div class="commercekit-wishlist"><a href="' . $wsl_page_link . '" class="commercekit-browse-wishlist" aria-label="' . esc_html__( 'Wishlist', 'commercegurus-commercekit' ) . '"><i class="cg-wishlist"></i><span>' . $wsl_brtext . '</span></a></div>';
		} else {
			$wsl_adtext = isset( $commercekit_options['wsl_adtext'] ) && ! empty( $commercekit_options['wsl_adtext'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wsl_adtext'] ) ) : esc_html__( 'Add to wishlist', 'commercegurus-commercekit' );
			$html       = '<div class="commercekit-wishlist"><a href="#" class="commercekit-save-wishlist" data-product-id="' . $pid . '" data-type="page" aria-label="' . esc_html__( 'Wishlist', 'commercegurus-commercekit' ) . '"><i class="cg-wishlist"></i><span>' . $wsl_adtext . '</span></a></div>';
		}

		commercekit_module_output( $html );
	}
}

add_action( 'woocommerce_single_product_summary', 'commercekit_single_product_wishlist', 38 );

/**
 * Shop Page - Display wishlist
 */
function commercekit_after_shop_loop_item_wishlist() {
	global $wpdb;
	global $product;
	$commercekit_wishlist = false;
	$commercekit_options  = get_option( 'commercekit', array() );
	if ( isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ) {
		$commercekit_wishlist = true;
	}
	if ( $commercekit_wishlist ) {
		$pid = $product->get_id();
		$uid = get_current_user_id();
		$key = isset( $_COOKIE['commercekit_wishlist'] ) && ! empty( $_COOKIE['commercekit_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['commercekit_wishlist'] ) ) : '';
		$wid = 0;
		if ( $uid ) {
			$wid = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist_items WHERE user_id = %d AND product_id = %d', $uid, $pid ) ); // db call ok; no-cache ok.
		} elseif ( $key ) {
			$sid = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist WHERE session_key = %s', $key ) ); // db call ok; no-cache ok.
			if ( $sid ) {
				$wid = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist_items WHERE list_id = %d AND product_id = %d', $sid, $pid ) ); // db call ok; no-cache ok.
			}
		}
		$wsl_page      = isset( $commercekit_options['wsl_page'] ) ? esc_attr( $commercekit_options['wsl_page'] ) : 0;
		$wsl_page_link = get_permalink( $wsl_page );

		if ( $wid ) {
			$html = '<div class="commercekit-wishlist mini"><a href="' . $wsl_page_link . '" class="commercekit-browse-wishlist" aria-label="' . esc_html__( 'Wishlist', 'commercegurus-commercekit' ) . '"><i class="cg-wishlist-t"></i><span></span></a></div>';
		} else {
			$html = '<div class="commercekit-wishlist mini"><a href="#" class="commercekit-save-wishlist" data-product-id="' . $pid . '" data-type="list" aria-label="' . esc_html__( 'Wishlist', 'commercegurus-commercekit' ) . '"><i class="cg-wishlist"></i><span></span></a></div>';
		}

		commercekit_module_output( $html );
	}
}

add_action( 'woocommerce_before_shop_loop_item', 'commercekit_after_shop_loop_item_wishlist', 15 );

/**
 * Commercegurus wishlist shortcode
 */
function commercekit_shortcode_wishlist() {
	global $wpdb;
	$commercekit_wishlist = false;
	$commercekit_options  = get_option( 'commercekit', array() );
	if ( isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ) {
		$commercekit_wishlist = true;
	}
	if ( ! $commercekit_wishlist ) {
		return;
	}
	$uid = get_current_user_id();
	$key = isset( $_COOKIE['commercekit_wishlist'] ) && ! empty( $_COOKIE['commercekit_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['commercekit_wishlist'] ) ) : '';
	$sid = -1;
	if ( ! $uid && $key ) {
		$sid = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . $wpdb->prefix . 'commercekit_wishlist WHERE session_key = %s', $key ) ); // db call ok; no-cache ok.
		if ( $sid ) {
			$uid = -1;
		}
	}
	if ( ! $uid ) {
		$uid = -1;
	}
	if ( ! $sid ) {
		$sid = -1;
	}
	$pg_url = get_permalink();
	$total  = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'commercekit_wishlist_items WHERE user_id = %d OR list_id = %d', $uid, $sid ) ); // db call ok; no-cache ok.
	$offset = 0;
	$limit  = 100;
	$nonce  = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$wpage  = isset( $_REQUEST['wpage'] ) ? sanitize_text_field( (int) $_REQUEST['wpage'] ) : 1;
	$reload = isset( $_REQUEST['reload'] ) ? sanitize_text_field( (int) $_REQUEST['reload'] ) : 0;
	$wpage  = $wpage ? $wpage : 1;
	$wpages = ceil( $total / $limit );
	if ( $wpages && $wpage > $wpages ) {
		$wpage = $wpages;
	}
	$offset = ( $wpage - 1 ) * $limit;
	$rows   = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'commercekit_wishlist_items WHERE user_id = %d OR list_id = %d ORDER BY created DESC LIMIT %d, %d', $uid, $sid, $offset, $limit ), ARRAY_A ); // db call ok; no-cache ok.
	$flink  = '';
	$plink  = '';
	$nlink  = '';
	$llink  = '';
	if ( $wpage > 1 ) {
		$flink = $pg_url . '?wpage=1';
		$plink = $pg_url . '?wpage=' . ( $wpage - 1 );
	}
	if ( $wpages > 1 && $wpage < $wpages ) {
		$nlink = $pg_url . '?wpage=' . ( $wpage + 1 );
		$llink = $pg_url . '?wpage=' . $wpages;
	}
	ob_start();
	?>
	<?php if ( ! $reload ) { ?>
	<div id="commercekit-wishlist-shortcode">
	<?php } ?>

	<div class="commercekit-wishlist"></div>
	<table class="commercekit-wishlist-table" width="100%">
		<thead>
			<tr>
				<th id="cb">&nbsp;</th>
				<th id="product" colspan="2"><?php esc_html_e( 'Product', 'commercegurus-commercekit' ); ?></th>
				<th id="price"><?php esc_html_e( 'Price', 'commercegurus-commercekit' ); ?></th>
				<th id="stock"><?php esc_html_e( 'Stock Status', 'commercegurus-commercekit' ); ?></th>
				<th id="cart">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ( is_array( $rows ) && count( $rows ) ) {
				foreach ( $rows as $row ) {
					$product = wc_get_product( $row['product_id'] );
					if ( ! $product ) {
						continue;
					}
					$product_link = get_permalink( $row['product_id'] );
					$in_stock     = true;
					if ( ( $product->managing_stock() && 0 === (int) $product->get_stock_quantity() ) || 'outofstock' === $product->get_stock_status() ) {
						$in_stock = false;
					}
					?>
			<tr id="product-<?php echo esc_attr( $row['product_id'] ); ?>">
				<td class="remove">
					<a href="#wishlists" class="commercekit-remove-wishlist2" data-product-id="<?php echo esc_html( $row['product_id'] ); ?>" data-wpage="<?php echo esc_html( $wpage ); ?>" aria-label="<?php esc_html_e( 'Wishlist', 'commercegurus-commercekit' ); ?>">×</a>
				</td>
				<td class="image">
					<a href="<?php echo esc_url( $product_link ); ?>">
					<?php
					if ( has_post_thumbnail( $row['product_id'] ) ) {
						echo get_the_post_thumbnail( $row['product_id'], 'thumbnail', array( 'class' => 'wishlist-thumbnail' ) );
					}
					?>
					</a>					
				</td>
				<td class="name">					
					<a href="<?php echo esc_url( $product_link ); ?>">
					<?php
						commercekit_module_output( $product->get_title() );
					?>
					</a>					
				</td>
				<td class="price">
					<?php commercekit_module_output( $product->get_price_html() ); ?>
				</td>
				<td class="stock">
					<?php echo true === $in_stock ? '<span class="instock">' . esc_html__( 'In Stock', 'commercegurus-commercekit' ) . '</span>' : '<span class="outofstock">' . esc_html__( 'Out of Stock', 'commercegurus-commercekit' ) . '</span>'; ?>
				</td>
				<td class="cart">
					<?php if ( $in_stock && ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) ) { ?>
						<?php if ( $product->is_type( 'simple' ) ) { ?>
							<button type="button" class="commercekit-wishlist-cart" data-product-id="<?php echo esc_attr( $row['product_id'] ); ?>" aria-label="<?php esc_html_e( 'Wishlist', 'commercegurus-commercekit' ); ?>"> <?php esc_html_e( 'Add to Cart', 'commercegurus-commercekit' ); ?> </button>
						<?php } else { ?>
							<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><button type="button"> <?php esc_html_e( 'Select Options', 'commercegurus-commercekit' ); ?> </button></a>
						<?php } ?>
					<?php } else { ?>
						<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><button type="button"> <?php esc_html_e( 'View Product', 'commercegurus-commercekit' ); ?> </button></a>
					<?php } ?>
				</td>
			</tr>
					<?php
				}
			} else {
				?>
			<tr>
				<td colspan="5" class="center"><?php esc_html_e( 'No products in your wishlist', 'commercegurus-commercekit' ); ?></td>
			</tr>
				<?php
			}
			?>
		</tbody>
	</table> 
	<?php if ( ! $reload ) { ?>
	</div>
	<?php } ?>
	<?php
	$html = ob_get_contents();
	ob_clean();

	return $html;
}

add_shortcode( 'commercegurus_wishlist', 'commercekit_shortcode_wishlist' );

/**
 * Ajax wishlist add to cart.
 */
function commercekit_ajax_wishlist_addtocart() {
	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on adding to cart.', 'commercegurus-commercekit' );

	$nonce        = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$product_id   = isset( $_POST['product_id'] ) ? (int) sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : 0;
	$variation_id = 0;
	$product      = wc_get_product( $product_id );

	if ( $product && $product->has_child() ) {
		$children_ids = $product->get_children();
		$variation_id = reset( $children_ids );
	}

	if ( WC()->cart->add_to_cart( $product_id, 1, $variation_id ) ) {
		$ajax['status']  = 1;
		$ajax['message'] = esc_html__( 'Sucessfully added to cart.', 'commercegurus-commercekit' );
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_wishlist_addtocart', 'commercekit_ajax_wishlist_addtocart' );
add_action( 'wp_ajax_nopriv_commercekit_wishlist_addtocart', 'commercekit_ajax_wishlist_addtocart' );

/**
 * Add wishlist endpoint.
 */
function commercekit_add_wishlist_endpoint() {
	add_rewrite_endpoint( 'cgkit-wishlist', EP_ROOT | EP_PAGES );
	$is_flushed = (int) get_option( 'commercekit_cgkit_wishlist' );
	if ( 1 !== $is_flushed ) {
		flush_rewrite_rules( false );
		update_option( 'commercekit_cgkit_wishlist', 1 );
	}
}

add_action( 'init', 'commercekit_add_wishlist_endpoint' );

/**
 * Wishlist query vars.
 *
 * @param string $vars of query vars.
 */
function commercekit_cgkit_wishlist_query_vars( $vars ) {
	$vars[] = 'cgkit-wishlist';
	return $vars;
}

add_filter( 'query_vars', 'commercekit_cgkit_wishlist_query_vars', 0 );

/**
 * Add wishlist my account link.
 *
 * @param string $items of menus.
 */
function commercekit_add_cgkit_wishlist_link_my_account( $items ) {
	$new_item = array( 'cgkit-wishlist' => esc_html__( 'My wishlist', 'commercegurus-commercekit' ) );
	if ( isset( $items['customer-logout'] ) ) {
		$old_item = array( 'customer-logout' => $items['customer-logout'] );
		unset( $items['customer-logout'] );
		$items = $items + $new_item + $old_item;
	} else {
		$items = $items + $new_item;
	}
	return $items;
}

add_filter( 'woocommerce_account_menu_items', 'commercekit_add_cgkit_wishlist_link_my_account' );

/**
 * Add wishlist my account link.
 */
function commercekit_cgkit_wishlist_content() {
	echo '<h2>' . esc_html__( 'My wishlist', 'commercegurus-commercekit' ) . '</h1>';
	echo do_shortcode( '[commercegurus_wishlist]' );
}

add_action( 'woocommerce_account_cgkit-wishlist_endpoint', 'commercekit_cgkit_wishlist_content' );
