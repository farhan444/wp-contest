<?php
/**
 *
 * Waitlist module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Ajax save waitlist
 */
function commercekit_ajax_save_waitlist() {
	global $wpdb;
	$commercekit_options = get_option( 'commercekit', array() );

	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on submitting for waiting list.', 'commercegurus-commercekit' );

	$table  = $wpdb->prefix . 'commercekit_waitlist';
	$nonce  = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$email  = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$pid    = isset( $_POST['product_id'] ) ? sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : 0;
	$data   = array(
		'email'      => $email,
		'product_id' => $pid,
		'created'    => time(),
	);
	$format = array( '%s', '%d', '%d' );
	if ( $email && $pid ) {
		$wpdb->insert( $table, $data, $format ); // db call ok; no-cache ok.
		$ajax['status']  = 1;
		$ajax['message'] = isset( $commercekit_options['wtl_success_text'] ) && ! empty( $commercekit_options['wtl_success_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wtl_success_text'] ) ) : esc_html__( 'You have been added to the waiting list for this product!', 'commercegurus-commercekit' );

		$product = wc_get_product( $pid );
		if ( $product ) {
			$finds   = array( '{site_name}', '{site_url}', '{product_title}', '{product_sku}', '{product_link}' );
			$replace = array( get_option( 'blogname' ), home_url( '/' ), $product->get_title(), $product->get_sku(), $product->get_permalink() );

			$enabled_admin_mail = ( ! isset( $commercekit_options['waitlist_admin_mail'] ) || 1 === (int) $commercekit_options['waitlist_admin_mail'] ) ? true : false;
			if ( $enabled_admin_mail ) {
				$to_mail       = isset( $commercekit_options['wtl_recipient'] ) && ! empty( $commercekit_options['wtl_recipient'] ) ? stripslashes_deep( $commercekit_options['wtl_recipient'] ) : get_option( 'admin_email' );
				$email_headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $email, 'Reply-To: ' . $email );
				$email_subject = isset( $commercekit_options['wtl_admin_subject'] ) && ! empty( $commercekit_options['wtl_admin_subject'] ) ? stripslashes_deep( $commercekit_options['wtl_admin_subject'] ) : esc_html__( 'You have a new waiting list request.', 'commercegurus-commercekit' );
				$email_body    = isset( $commercekit_options['wtl_admin_content'] ) && ! empty( $commercekit_options['wtl_admin_content'] ) ? stripslashes_deep( $commercekit_options['wtl_admin_content'] ) : esc_html__( 'Hi, You got a waiting list request from {site_name} for the following: Product Name: {product_title}, SKU: {product_sku}, Product link: {product_link}', 'commercegurus-commercekit' );
				$email_subject = str_replace( $finds, $replace, $email_subject );
				$email_body    = str_replace( $finds, $replace, $email_body );
				$email_body    = html_entity_decode( $email_body );
				$email_body    = str_replace( "\r\n", '<br />', $email_body );

				$success = wp_mail( $to_mail, $email_subject, $email_body, $email_headers );
			}

			$enabled_user_mail = ( ! isset( $commercekit_options['waitlist_user_mail'] ) || 1 === (int) $commercekit_options['waitlist_user_mail'] ) ? true : false;
			if ( $enabled_user_mail ) {
				$to_mail       = $email;
				$email         = get_option( 'admin_email' );
				$email_headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $email, 'Reply-To: ' . $email );
				$email_subject = isset( $commercekit_options['wtl_user_subject'] ) && ! empty( $commercekit_options['wtl_user_subject'] ) ? stripslashes_deep( $commercekit_options['wtl_user_subject'] ) : esc_html__( 'We have received your waiting list request.', 'commercegurus-commercekit' );
				$email_body    = isset( $commercekit_options['wtl_user_content'] ) && ! empty( $commercekit_options['wtl_user_content'] ) ? stripslashes_deep( $commercekit_options['wtl_user_content'] ) : esc_html__( 'Hi, We have received your waiting list request from {site_name} for the following: Product Name: {product_title}, SKU: {product_sku}, Product link: {product_link}', 'commercegurus-commercekit' );
				$email_subject = str_replace( $finds, $replace, $email_subject );
				$email_body    = str_replace( $finds, $replace, $email_body );
				$email_body    = html_entity_decode( $email_body );
				$email_body    = str_replace( "\r\n", '<br />', $email_body );

				$success = wp_mail( $to_mail, $email_subject, $email_body, $email_headers );
			}
		}
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_save_waitlist', 'commercekit_ajax_save_waitlist' );
add_action( 'wp_ajax_nopriv_commercekit_save_waitlist', 'commercekit_ajax_save_waitlist' );

/**
 * Waitlist form
 */
function commercekit_waitlist_form() {
	global $post;
	$commercekit_options = get_option( 'commercekit', array() );
	$enable_waitlist     = isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 1 : 0;
	if ( ! $enable_waitlist ) {
		return;
	}
	if ( 'product' === get_post_type( $post->ID ) && is_product() ) {
		$product = wc_get_product( $post->ID );
		if ( ! $product ) {
			return;
		}
		if ( $product->is_type( 'composite' ) ) {
			return;
		}
		add_filter( 'woocommerce_get_stock_html', 'commercekit_waitlist_output_form', 30, 2 );
	}
}
add_action( 'woocommerce_before_single_product', 'commercekit_waitlist_form' );
add_action( 'woocommerce_after_single_product', 'commercekit_waitlist_output_form_script' );

/**
 * Waitlist ajax form
 *
 * @param string $html of output.
 * @param object $product of output.
 */
function commercekit_waitlist_ajax_form( $html, $product ) {
	global $wp_query;
	$action = $wp_query->get( 'wc-ajax' );
	if ( 'get_variation' !== $action ) {
		return $html;
	}
	$commercekit_options = get_option( 'commercekit', array() );
	$enable_waitlist     = isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 1 : 0;
	if ( ! $enable_waitlist ) {
		return $html;
	}
	if ( ! $product ) {
		return $html;
	}
	if ( $product->is_type( 'variation' ) ) {
		return commercekit_waitlist_output_form( $html, $product );
	}
}
add_filter( 'woocommerce_get_stock_html', 'commercekit_waitlist_ajax_form', 30, 2 );

/**
 * Waitlist output form
 *
 * @param string $html of output.
 * @param object $product of output.
 */
function commercekit_waitlist_output_form( $html, $product ) {
	global $can_show_waitlist_form;
	$commercekit_options = get_option( 'commercekit', array() );

	$intro   = isset( $commercekit_options['wtl_intro'] ) && ! empty( $commercekit_options['wtl_intro'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wtl_intro'] ) ) : esc_html__( 'Notify me when the item is back in stock.', 'commercegurus-commercekit' );
	$pholder = isset( $commercekit_options['wtl_email_text'] ) && ! empty( $commercekit_options['wtl_email_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wtl_email_text'] ) ) : esc_html__( 'Enter your email address...', 'commercegurus-commercekit' );
	$blabel  = isset( $commercekit_options['wtl_button_text'] ) && ! empty( $commercekit_options['wtl_button_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wtl_button_text'] ) ) : esc_html__( 'Join waiting list', 'commercegurus-commercekit' );
	$alabel  = isset( $commercekit_options['wtl_consent_text'] ) && ! empty( $commercekit_options['wtl_consent_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $commercekit_options['wtl_consent_text'] ) ) : esc_html__( 'I consent to being contacted by the store owner', 'commercegurus-commercekit' );

	if ( ( $product->managing_stock() && 0 === (int) $product->get_stock_quantity() && 'no' === $product->get_backorders() ) || 'outofstock' === $product->get_stock_status() ) {
		$can_show_waitlist_form = true;

		$whtml = '
<div class="commercekit-waitlist">
	<p>' . $intro . '</p>
	<input type="email" id="ckwtl-email" name="ckwtl_email" placeholder="' . $pholder . '" />
	<label><input type="checkbox" id="ckwtl-consent" name="ckwtl_consent" value="1" />&nbsp;&nbsp;' . $alabel . '</label>
	<input type="button" id="ckwtl-button" name="ckwtl_button" value="' . $blabel . '" disabled="disabled" onclick="submitCKITWaitlist();" />
	<input type="hidden" id="ckwtl-pid" name="ckwtl_pid" value="' . $product->get_id() . '" />
</div>';

		$html .= $whtml;
	}

	return $html;
}

/**
 * Waitlist output form script
 */
function commercekit_waitlist_output_form_script() {
	global $can_show_waitlist_form;
	if ( isset( $can_show_waitlist_form ) && true === $can_show_waitlist_form ) {
		?>
<style>
.commercekit-waitlist { margin: 30px 0px; padding: 25px; background-color: #fff; border: 1px solid #eee; box-shadow: 0 3px 15px -5px rgba(0, 0, 0, 0.08); }
.commercekit-waitlist p { font-weight: 600; margin-bottom: 10px; width: 100%; font-size: 16px; }
.commercekit-waitlist p.error { color: #F00; margin-bottom: 0; }
.commercekit-waitlist p.success { color: #009245; margin-bottom: 0; }
.commercekit-waitlist #ckwtl-email { width: 100%; background: #fff; margin-bottom: 10px; }
.commercekit-waitlist #ckwtl-email.error { border: 1px solid #F00; }
.commercekit-waitlist label { width: 100%; margin-bottom: 10px; font-size: 14px; display: block; }
.commercekit-waitlist label.error { color: #F00; }
.commercekit-waitlist label input { transform: scale(1.1); top: 2px; }
.commercekit-waitlist #ckwtl-button { width: 100%; margin-top: 5px; text-align: center; border-radius: 3px; transition: 0.2s all; }
.commercekit-waitlist #ckwtl-button { width: 100%; text-align: center; }
</style>
<script>
function validateCKITWaitlistForm(){
	var email = document.querySelector('#ckwtl-email');
	var consent = document.querySelector('#ckwtl-consent');
	var button = document.querySelector('#ckwtl-button');
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var error = false;
	if( !regex.test(email.value) ){
		email.classList.add('error');
		error = true;
	} else {
		email.classList.remove('error');
	}
	if( !consent.checked ){
		consent.parentNode.classList.add('error');
		error = true;
	} else {
		consent.parentNode.classList.remove('error');
	}
	if( !error ){
		button.removeAttribute('disabled');
	} else {
		button.setAttribute('disabled', 'disabled');
	}
}
function submitCKITWaitlist(){
	var pid = document.querySelector('#ckwtl-pid').value;
	var email = document.querySelector('#ckwtl-email').value;
	var button = document.querySelector('#ckwtl-button');
	var container = document.querySelector('.commercekit-waitlist');
	button.setAttribute('disabled', 'disabled');
	var formData = new FormData();
	formData.append('product_id', pid);
	formData.append('email', email);
	fetch( commercekit_ajs.ajax_url + '?action=commercekit_save_waitlist', {
		method: 'POST',
		body: formData,
	}).then(response => response.json()).then( json => {
		if( json.status == 1 ){
			container.innerHTML = '<p class="success">'+json.message+'</p>';
		} else {
			container.innerHTML = '<p class="error">'+json.message+'</p>';
		}
	});
}
document.addEventListener('change', function(e){
	if( e.target && ( e.target.id == 'ckwtl-email' || e.target.id == 'ckwtl-consent' ) ){
		validateCKITWaitlistForm();
	}
});
document.addEventListener('keyup', function(e){
	if( e.target && ( e.target.id == 'ckwtl-email' || e.target.id == 'ckwtl-consent' ) ){
		validateCKITWaitlistForm();
	}
});
</script>
		<?php
	}
}

/**
 * Waitlist automail on stock status
 *
 * @param string $product_id Product ID.
 * @param string $stockstatus Stock status.
 * @param string $product Product Object.
 */
function commercekit_waitlist_automail_on_stock_status( $product_id, $stockstatus, $product ) {
	global $wpdb;
	if ( 'instock' === $stockstatus ) {
		$commercekit_options = get_option( 'commercekit', array() );
		$enabled_auto_mail   = ( ! isset( $commercekit_options['waitlist_auto_mail'] ) || 1 === (int) $commercekit_options['waitlist_auto_mail'] ) ? true : false;
		if ( $enabled_auto_mail ) {
			$limit = 99999;
			if ( 0 < (int) $product->get_stock_quantity() ) {
				$limit = (int) $product->get_stock_quantity();
			}
			$rows    = $wpdb->get_results( $wpdb->prepare( 'SELECT DISTINCT email, product_id FROM ' . $wpdb->prefix . 'commercekit_waitlist WHERE product_id = %d AND mail_sent = %d ORDER BY created ASC LIMIT %d, %d', $product_id, 0, 0, $limit ), ARRAY_A ); // db call ok; no-cache ok.
			$finds   = array( '{site_name}', '{site_url}', '{product_title}', '{product_sku}', '{product_link}' );
			$replace = array( get_option( 'blogname' ), home_url( '/' ), $product->get_title(), $product->get_sku(), $product->get_permalink() );

			$email         = get_option( 'admin_email' );
			$email_headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $email, 'Reply-To: ' . $email );
			$email_subject = isset( $commercekit_options['wtl_auto_subject'] ) && ! empty( $commercekit_options['wtl_auto_subject'] ) ? stripslashes_deep( $commercekit_options['wtl_auto_subject'] ) : esc_html__( 'A product your waiting for is back in stock.', 'commercegurus-commercekit' );
			$email_body    = isset( $commercekit_options['wtl_auto_content'] ) && ! empty( $commercekit_options['wtl_auto_content'] ) ? stripslashes_deep( $commercekit_options['wtl_auto_content'] ) : esc_html__( 'Hi, {product_title} is now back in stock on {site_name}. You have been sent this email because your email address was registered in a waiting list for this product. If you would like to purchase {product_title}, please visit the following link: {product_link}', 'commercegurus-commercekit' );
			$email_subject = str_replace( $finds, $replace, $email_subject );
			$email_body    = str_replace( $finds, $replace, $email_body );
			$email_body    = html_entity_decode( $email_body );
			$email_body    = str_replace( "\r\n", '<br />', $email_body );

			if ( is_array( $rows ) && count( $rows ) ) {
				foreach ( $rows as $row ) {
					$success = wp_mail( $row['email'], $email_subject, $email_body, $email_headers );
					$table   = $wpdb->prefix . 'commercekit_waitlist';
					$data    = array(
						'mail_sent' => 1,
					);
					$where   = array(
						'email'      => $row['email'],
						'product_id' => $row['product_id'],
					);

					$data_format  = array( '%d' );
					$where_format = array( '%s', '%d' );
					$wpdb->update( $table, $data, $where, $data_format, $where_format ); // db call ok; no-cache ok.
				}
			}
		}
	}
}

add_action( 'woocommerce_product_set_stock_status', 'commercekit_waitlist_automail_on_stock_status', 99, 3 );
add_action( 'woocommerce_variation_set_stock_status', 'commercekit_waitlist_automail_on_stock_status', 99, 3 );

/**
 * Email from name
 *
 * @param  string $from_name from name.
 * @return string $from_name from name.
 */
function commercekit_email_from_name( $from_name ) {
	$options   = get_option( 'commercekit', array() );
	$from_name = isset( $options['wtl_from_name'] ) && ! empty( $options['wtl_from_name'] ) ? stripslashes_deep( $options['wtl_from_name'] ) : get_option( 'blogname' );
	return $from_name;
}
add_filter( 'wp_mail_from_name', 'commercekit_email_from_name', 9, 1 );

/**
 * Email from email
 *
 * @param  string $from_email from email.
 * @return string $from_email from name.
 */
function commercekit_email_from_email( $from_email ) {
	$options  = get_option( 'commercekit', array() );
	$sitename = wp_parse_url( network_home_url(), PHP_URL_HOST );
	if ( 'www.' === substr( $sitename, 0, 4 ) ) {
		$sitename = substr( $sitename, 4 );
	}
	$from_email = isset( $options['wtl_from_email'] ) && ! empty( $options['wtl_from_email'] ) ? stripslashes_deep( $options['wtl_from_email'] ) : 'wordpress@' . $sitename;
	return $from_email;
}
add_filter( 'wp_mail_from', 'commercekit_email_from_email', 9, 1 );

/**
 * Waitlist add to cart text
 *
 * @param  string $text add to cart text.
 * @param  string $product product object.
 * @return string $text add to cart text.
 */
function commercekit_waitlist_add_to_cart_text( $text, $product ) {
	$options         = get_option( 'commercekit', array() );
	$enable_waitlist = isset( $options['waitlist'] ) && 1 === (int) $options['waitlist'] ? 1 : 0;
	$readmore_label  = isset( $options['wtl_readmore_text'] ) && ! empty( $options['wtl_readmore_text'] ) ? commercekit_get_multilingual_string( stripslashes_deep( $options['wtl_readmore_text'] ) ) : esc_html__( 'Get notified', 'commercegurus-commercekit' );
	if ( ! $enable_waitlist ) {
		return $text;
	}
	if ( $product && ( ( $product->managing_stock() && 0 === (int) $product->get_stock_quantity() && 'no' === $product->get_backorders() ) || 'outofstock' === $product->get_stock_status() ) ) {
		return $readmore_label;
	}

	return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'commercekit_waitlist_add_to_cart_text', 10, 2 );
