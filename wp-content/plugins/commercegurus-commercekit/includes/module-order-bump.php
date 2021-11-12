<?php
/**
 *
 * Order Bump module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Checkout order bump.
 */
function commercekit_checkout_order_bump() {
	$product_ids = array();
	$categories  = array();
	foreach ( WC()->cart->get_cart() as $item ) {
		if ( isset( $item['product_id'] ) && (int) $item['product_id'] ) {
			$product_ids[] = (int) $item['product_id'];
		}
		if ( isset( $item['variation_id'] ) && (int) $item['variation_id'] ) {
			$product_ids[] = (int) $item['variation_id'];
		}
		$terms = get_the_terms( $item['data']->get_id(), 'product_cat' );
		if ( is_array( $terms ) && count( $terms ) ) {
			foreach ( $terms as $term ) {
				$categories[] = $term->term_id;
			}
		}
	}

	$options = get_option( 'commercekit', array() );

	$order_bump_product = isset( $options['order_bump_product'] ) ? $options['order_bump_product'] : array();

	$product_title = '';
	$button_text   = esc_html__( 'Click to add', 'commercegurus-commercekit' );
	$button_added  = esc_html__( 'Added!', 'commercegurus-commercekit' );
	$pid           = 0;

	$enable_order_bump = isset( $options['order_bump'] ) && 1 === (int) $options['order_bump'] ? 1 : 0;
	if ( ! $enable_order_bump ) {
		return;
	}

	if ( isset( $order_bump_product['product']['title'] ) && count( $order_bump_product['product']['title'] ) > 0 ) {
		foreach ( $order_bump_product['product']['title'] as $k => $product_title ) {
			if ( empty( $product_title ) ) {
				continue;
			}
			if ( isset( $order_bump_product['product']['active'][ $k ] ) && 1 === (int) $order_bump_product['product']['active'][ $k ] ) {
				$can_display  = false;
				$condition    = isset( $order_bump_product['product']['condition'][ $k ] ) ? $order_bump_product['product']['condition'][ $k ] : 'all';
				$pids         = isset( $order_bump_product['product']['pids'][ $k ] ) ? explode( ',', $order_bump_product['product']['pids'][ $k ] ) : array();
				$pid          = isset( $order_bump_product['product']['id'][ $k ] ) ? (int) $order_bump_product['product']['id'][ $k ] : 0;
				$button_text  = isset( $order_bump_product['product']['button_text'][ $k ] ) ? commercekit_get_multilingual_string( $order_bump_product['product']['button_text'][ $k ] ) : esc_html__( 'Click to add', 'commercegurus-commercekit' );
				$button_added = isset( $order_bump_product['product']['button_added'][ $k ] ) ? commercekit_get_multilingual_string( $order_bump_product['product']['button_added'][ $k ] ) : esc_html__( 'Added!', 'commercegurus-commercekit' );

				if ( 'all' === $condition ) {
					$can_display = true;
				} elseif ( 'products' === $condition ) {
					if ( count( array_intersect( $product_ids, $pids ) ) ) {
						$can_display = true;
					}
				} elseif ( 'non-products' === $condition ) {
					if ( ! count( array_intersect( $product_ids, $pids ) ) ) {
						$can_display = true;
					}
				} elseif ( 'categories' === $condition ) {
					if ( count( array_intersect( $categories, $pids ) ) ) {
						$can_display = true;
					}
				} elseif ( 'non-categories' === $condition ) {
					if ( ! count( array_intersect( $categories, $pids ) ) ) {
						$can_display = true;
					}
				}

				if ( $can_display && $pid && ! in_array( $pid, $product_ids, true ) ) {
					$product_title = commercekit_get_multilingual_string( $product_title );
					$product_id    = $pid;
					$product       = wc_get_product( $pid );
					if ( $product && $product->is_in_stock() ) {
						$image = '';
						if ( has_post_thumbnail( $product_id ) ) {
							$image = get_the_post_thumbnail( $product_id, 'thumbnail' );
						} elseif ( $product->is_type( 'variation' ) ) {
							$parent_id = $product->get_parent_id();
							if ( has_post_thumbnail( $parent_id ) ) {
								$image = get_the_post_thumbnail( $parent_id, 'thumbnail' );
							}
						}
						if ( $product->has_child() ) {
							$children_ids = $product->get_children();
							$product_id   = reset( $children_ids );
							if ( in_array( (int) $product_id, $product_ids, true ) ) {
								return;
							}
						}

						$product_id = (int) $product_id;
						$view_ids   = isset( $_COOKIE['commercekit_obp_view_ids'] ) && ! empty( $_COOKIE['commercekit_obp_view_ids'] ) ? explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['commercekit_obp_view_ids'] ) ) ) : array();
						$view_ids   = array_map( 'intval', $view_ids );
						if ( ! in_array( $product_id, $view_ids, true ) ) {
							$order_bump_stats_views = (int) get_option( 'commercekit_obp_views' );
							$order_bump_stats_views++;
							update_option( 'commercekit_obp_views', $order_bump_stats_views );

							$view_ids[] = $product_id;
							setcookie( 'commercekit_obp_view_ids', implode( ',', $view_ids ), time() + ( 24 * 3600 ), '/' );
						}
						?>
<div class="commercekit-order-bump-wrap">
<div class="commercekit-order-bump">
	<div class="ckobp-title"><?php echo esc_html( $product_title ); ?></div>
	<div class="ckobp-wrapper">
	<div class="ckobp-item">
	<div class="ckobp-image"><?php commercekit_module_output( $image ); ?></div>
	<div class="ckobp-product">
		<div class="ckobp-name"><?php commercekit_module_output( get_the_title( $product_id ) ); ?></div>
		<div class="ckobp-price"><?php commercekit_module_output( $product->get_price_html() ); ?></div>
	</div>
	</div>
	<div class="ckobp-actions">
		<div class="ckobp-button"><button type="button" onclick="commercekitOrderBumpAdd(<?php echo esc_html( $product_id ); ?>, this);"><?php echo esc_html( $button_text ); ?></button></div>
		<div class="ckobp-added" style="display:none;"><button type="button"><?php echo esc_html( $button_added ); ?></button></div>
	</div>
	</div>
</div>
<style>
.commercekit-order-bump { border: 1px solid #e2e2e2; box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.06); padding: 20px; margin: 25px 0; border-radius: 4px; }
.commercekit-order-bump .ckobp-title { width: 100%; padding-bottom: 15px; font-weight: 600; font-size: 16px; line-height: 1.4; color: #111; }
.commercekit-order-bump .ckobp-wrapper { display: flex; justify-content: space-between; }
.commercekit-order-bump .ckobp-item { display: flex; }
.commercekit-order-bump .ckobp-actions { display: flex; flex-shrink: 0; }
.commercekit-order-bump .ckobp-image { width: 50px; flex-shrink: 0; }
.commercekit-order-bump .ckobp-image img:nth-child(2n) { display: none; }
.commercekit-order-bump .ckobp-product { margin: 0 15px; }
.commercekit-order-bump .ckobp-name { color: #111; font-size: 15px; line-height: 1.4; }
.commercekit-order-bump .ckobp-price { font-size: 14px; }
.commercekit-order-bump .ckobp-price, .commercekit-order-bump .ckobp-price ins { color: #DE9915; }
.commercekit-order-bump .ckobp-price del { margin-right: 5px; color: #999; font-weight: normal; }
.commercekit-order-bump .ckobp-actions button { padding: 6px 12px; font-size: 14px; font-weight: 600; color: #111; border: 1px solid #e2e2e2; background: linear-gradient(180deg, white, #eee 130%) no-repeat; border-radius: 4px; transition: 0.2s all; }
.commercekit-order-bump .ckobp-actions button:hover { border-color: #ccc; }
@media (max-width: 500px) {
	.commercekit-order-bump .ckobp-wrapper { display: block; }
	.commercekit-order-bump .ckobp-actions { display: block; width: 100%; margin-top: 10px; }
	.commercekit-order-bump .ckobp-actions button { width: 100%; }
	.commercekit-order-bump .ckobp-name, .commercekit-order-bump .ckobp-title, .commercekit-order-bump .ckobp-actions button { font-size: 13px; }
}
</style>
<script>
function commercekitOrderBumpAdd(product_id, obj){
	obj.setAttribute('disabled', 'disabled');
	var formData = new FormData();
	formData.append('product_id', product_id);
	fetch( commercekit_ajs.ajax_url + '?action=commercekit_order_bump_add', {
		method: 'POST',
		body: formData,
	}).then(response => response.json()).then( json => {
		obj.removeAttribute('disabled');
		var ppp = document.querySelector('.paypalplus-paywall');
		if( ppp ) {
			window.location.reload();
		} else {
			var ucheckout = new Event('update_checkout');
			document.body.dispatchEvent(ucheckout);
		}
	});
}
</script>
</div>
						<?php

						break;
					}
				}
			}
		}
	}
}

add_action( 'woocommerce_review_order_before_submit', 'commercekit_checkout_order_bump', 99 );

/**
 * Ajax order bump add.
 */
function commercekit_ajax_order_bump_add() {
	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on adding to cart.', 'commercegurus-commercekit' );

	$nonce       = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$product_id  = isset( $_POST['product_id'] ) ? (int) sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : 0;
	$product_ids = array();
	foreach ( WC()->cart->get_cart() as $item ) {
		if ( isset( $item['product_id'] ) && (int) $item['product_id'] ) {
			$product_ids[] = (int) $item['product_id'];
		}
		if ( isset( $item['variation_id'] ) && (int) $item['variation_id'] ) {
			$product_ids[] = (int) $item['variation_id'];
		}
	}
	if ( ! in_array( $product_id, $product_ids, true ) ) {
		$variation_id = 0;
		if ( 'product_variation' === get_post_type( $product_id ) ) {
			$variation_id = $product_id;
			$product_id   = wp_get_post_parent_id( $variation_id );
		}
		if ( WC()->cart->add_to_cart( $product_id, 1, $variation_id ) ) {
			$ajax['status']  = 1;
			$ajax['message'] = esc_html__( 'Sucessfully added to cart.', 'commercegurus-commercekit' );

			WC()->session->set( 'cgkit_order_bump_added', true );
			$product_id = 0 !== (int) $variation_id ? (int) $variation_id : (int) $product_id;
			$click_ids  = isset( $_COOKIE['commercekit_obp_click_ids'] ) && ! empty( $_COOKIE['commercekit_obp_click_ids'] ) ? explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['commercekit_obp_click_ids'] ) ) ) : array();
			$click_ids  = array_map( 'intval', $click_ids );
			if ( ! in_array( $product_id, $click_ids, true ) ) {
				$order_bump_stats_clicks = (int) get_option( 'commercekit_obp_clicks' );
				$order_bump_stats_clicks++;
				update_option( 'commercekit_obp_clicks', $order_bump_stats_clicks );

				$click_ids[] = $product_id;
				setcookie( 'commercekit_obp_click_ids', implode( ',', $click_ids ), time() + ( 24 * 3600 ), '/' );
			}
		}
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_order_bump_add', 'commercekit_ajax_order_bump_add' );
add_action( 'wp_ajax_nopriv_commercekit_order_bump_add', 'commercekit_ajax_order_bump_add' );

/**
 * Order bump record sales
 *
 * @param  string $order_id of order.
 */
function commercekit_order_bump_record_sales( $order_id ) {
	$order       = wc_get_order( $order_id );
	$product_ids = array();
	$quantities  = array();
	$click_ids   = isset( $_COOKIE['commercekit_obp_click_ids'] ) && ! empty( $_COOKIE['commercekit_obp_click_ids'] ) ? explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['commercekit_obp_click_ids'] ) ) ) : array();
	if ( count( $click_ids ) ) {
		foreach ( $order->get_items() as $item_id => $item ) {
			if ( $item['variation_id'] > 0 ) {
				$product_id = $item['variation_id'];
			} else {
				$product_id = $item['product_id'];
			}
			$product_ids[] = $product_id;

			$quantities[ $product_id ] = (int) $item['quantity'];
		}
	} else {
		return;
	}
	if ( count( $product_ids ) ) {
		$matched_ids = array_intersect( $click_ids, $product_ids );
		if ( count( $matched_ids ) ) {
			$order_bump_stats_sales = (int) get_option( 'commercekit_obp_sales' );
			$order_bump_stats_price = (float) get_option( 'commercekit_obp_sales_revenue' );
			foreach ( $matched_ids as $matched_id ) {
				$product = wc_get_product( $matched_id );
				if ( $product ) {
					$order_bump_stats_sales++;
					$order_bump_stats_price += $quantities[ $matched_id ] * (float) $product->get_price();
				}
			}
			update_option( 'commercekit_obp_sales', $order_bump_stats_sales );
			update_option( 'commercekit_obp_sales_revenue', number_format( $order_bump_stats_price, 2, '.', '' ) );
		}
	}
	setcookie( 'commercekit_obp_click_ids', '', time() - ( 24 * 3600 ), '/' );
	setcookie( 'commercekit_obp_view_ids', '', time() - ( 24 * 3600 ), '/' );
}

add_action( 'woocommerce_thankyou', 'commercekit_order_bump_record_sales' );

/**
 * Order bump order review fragments
 *
 * @param  string $fragments of order.
 */
function commercekit_order_bump_order_review_fragments( $fragments ) {
	$cgkit_order_bump_added = WC()->session->get( 'cgkit_order_bump_added' );
	if ( true === $cgkit_order_bump_added ) {
		if ( isset( $fragments['.woocommerce-checkout-payment'] ) ) {
			unset( $fragments['.woocommerce-checkout-payment'] );
			if ( isset( $fragments['.woocommerce-checkout-review-order-table'] ) ) {
				$fragments['.woocommerce-checkout-review-order-table'] .= '<script> document.querySelectorAll(\'.woocommerce-checkout-payment .blockUI\').forEach(function(div){ div.style.display = \'none\'; }); </script>';
			}
		}
		ob_start();
		commercekit_checkout_order_bump();
		$fragments['.commercekit-order-bump-wrap'] = ob_get_clean();
		WC()->session->set( 'cgkit_order_bump_added', false );
	}

	return $fragments;
}

add_filter( 'woocommerce_update_order_review_fragments', 'commercekit_order_bump_order_review_fragments', 99, 1 );
