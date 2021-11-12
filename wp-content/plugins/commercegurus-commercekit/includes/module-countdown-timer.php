<?php
/**
 *
 * Countdown Timer module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Display Countdown timer template
 *
 * @param  string $title of countdown timer.
 * @param  string $timer hours, minutes and seconds.
 * @param  string $mode of countdown timer.
 * @param  string $restart of countdown timer when complete.
 * @param  string $session of countdown timer for restart.
 * @param  string $location of countdown timer, either product page or checkout page.
 * @param  string $message of countdown timer for display after complete.
 */
function commercekit_countdown_timer_template( $title, $timer, $mode, $restart, $session, $location, $message ) {
	$class         = 'product';
	$days_label    = esc_html__( 'DAYS', 'commercegurus-commercekit' );
	$hours_label   = esc_html__( 'HRS', 'commercegurus-commercekit' );
	$minutes_label = esc_html__( 'MINS', 'commercegurus-commercekit' );
	$seconds_label = esc_html__( 'SECS', 'commercegurus-commercekit' );
	if ( 'product' !== $location ) {
		$class         = 'non-product ' . $location;
		$days_label    = esc_html__( 'days', 'commercegurus-commercekit' );
		$hours_label   = esc_html__( 'hours', 'commercegurus-commercekit' );
		$minutes_label = esc_html__( 'minutes', 'commercegurus-commercekit' );
		$seconds_label = esc_html__( 'seconds', 'commercegurus-commercekit' );
	}

	if ( isset( $timer['days_label'] ) && ! empty( $timer['days_label'] ) ) {
		$days_label = $timer['days_label'];
	}
	if ( isset( $timer['hours_label'] ) && ! empty( $timer['hours_label'] ) ) {
		$hours_label = $timer['hours_label'];
	}
	if ( isset( $timer['minutes_label'] ) && ! empty( $timer['minutes_label'] ) ) {
		$minutes_label = $timer['minutes_label'];
	}
	if ( isset( $timer['seconds_label'] ) && ! empty( $timer['seconds_label'] ) ) {
		$seconds_label = $timer['seconds_label'];
	}
	?>
<div id="commercekit-timer" class="<?php echo esc_html( $class ); ?>" data-timer="<?php echo esc_html( $timer['total'] ); ?>" data-mode="<?php echo esc_html( $mode ); ?>" data-restart="<?php echo esc_html( $restart ); ?>" data-key="<?php echo esc_html( $session ); ?>" data-location="<?php echo esc_html( $location ); ?>" style="visibility: hidden;">
	<div class="commercekit-timer-title"><?php echo esc_html( stripslashes_deep( $title ) ); ?></div>
	<div class="commercekit-timer-blocks">
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="days"><?php echo esc_html( $timer['days'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $days_label ); ?></div>
		</div>
		<div class="commercekit-timer-sep">:</div>
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="hours"><?php echo esc_html( $timer['hours'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $hours_label ); ?></div>
		</div>
		<div class="commercekit-timer-sep">:</div>
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="minutes"><?php echo esc_html( $timer['minutes'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $minutes_label ); ?></div>
		</div>
		<div class="commercekit-timer-sep">:</div>
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="seconds"><?php echo esc_html( $timer['seconds'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $seconds_label ); ?></div>
		</div>
	</div>
</div>
<div id="commercekit-timer-message" class="<?php echo esc_html( $class ); ?>" style="display:none;"><?php echo esc_html( stripslashes_deep( $message ) ); ?></div>
<style>
#commercekit-timer.product { width: 50%; float: left; margin-right: 3%; margin-bottom: 10px;}
#commercekit-timer.product.has-cg-inventory { border-right: 1px solid #e2e2e2; }
#commercekit-timer.product .commercekit-timer-title { width: 100%; font-size: 15px; margin-bottom: 2px; }
#commercekit-timer.product .commercekit-timer-blocks { display: flex; white-space: nowrap; }
#commercekit-timer.product .commercekit-timer-block, #commercekit-timer.product .commercekit-timer-sep { display: inline-block; vertical-align: top; text-align: center; }
#commercekit-timer.product .commercekit-timer-digit, #commercekit-timer.product .commercekit-timer-sep { font-size: 22px; line-height: 26px; margin: 0px 2px; }
#commercekit-timer.product .commercekit-timer-label { font-size: 13px; color: #999; margin-bottom: -5px;}
#commercekit-timer-message.product { width: 50%; float: left; }
#commercekit-timer.non-product, #commercekit-timer-message.non-product { width: 100%; padding: 10px; background: #f8f6db; border: 1px solid #dfda9e; border-radius: 4px; text-align: center; font-size: 14px; color: #111; font-weight: 600; clear: both; margin-top: 20px; }
#commercekit-timer.non-product .commercekit-timer-title, #commercekit-timer.non-product .commercekit-timer-blocks, #commercekit-timer.non-product .commercekit-timer-block, #commercekit-timer.non-product .commercekit-timer-sep, #commercekit-timer.non-product .commercekit-timer-digit, #commercekit-timer.non-product .commercekit-timer-label { display: inline-flex; }
#commercekit-timer.non-product { display: flex; justify-content: center; }
#commercekit-timer.non-product .commercekit-timer-sep { display: none; }
#commercekit-timer.non-product .commercekit-timer-digit { margin-left: 5px; }
#commercekit-timer.non-product .commercekit-timer-label { margin-left: 3px; }
@media (max-width: 500px) { 
	#commercekit-timer.product { display: block; width: 100%; float: none; } #commercekit-timer.product.has-cg-inventory { 
border: none;}
#commercekit-timer.non-product { display: block; justify-content: center; }
}
</style>
<script>
function setCKITCookie(cname, cvalue, exdays){
	var d = new Date();
	d.setTime( d.getTime() + ( exdays * 24 * 60 * 60 * 1000 ) );
	var expires = "expires=" + d.toGMTString() + "; ";
	if( ! exdays ) expires = "";
	document.cookie = cname + "=" + cvalue + "; " + expires + "path=/";
} 
function getCKITCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
	return "";
}
if( document.querySelector('#commercekit-timer') ){
	$this =  document.querySelector('#commercekit-timer');
	var timer = $this.getAttribute('data-timer');
	var mode = $this.getAttribute('data-mode');
	var restart = $this.getAttribute('data-restart');
	var key = $this.getAttribute('data-key');
	var $location = $this.getAttribute('data-location');

	var otimer = timer;
	var ntimer = getCKITCookie(key);
	if( ntimer != '' ) timer = ntimer;

	var time = new Date().getTime();
	var countDownDate = time + ( timer * 1000 );

	var x = setInterval(function() {
		var now = new Date().getTime();
		var distance = countDownDate - now;

		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		if( days <= 0 ) days = 0;
		if( hours <= 0 ) hours = 0;
		if( minutes <= 0 ) minutes = 0;
		if( seconds <= 0 ) seconds = 0;

		if( $location != 'product' ){
			if( days <= 0 ) 
				document.querySelector('#days').parentNode.style.display = 'none';
			else
				document.querySelector('#days').parentNode.style.display = 'inline-flex';
			if( hours <= 0 ) 
				document.querySelector('#hours').parentNode.style.display = 'none';
			else
				document.querySelector('#hours').parentNode.style.display = 'inline-flex';
			if( minutes <= 0 )
				document.querySelector('#minutes').parentNode.style.display = 'none';
			else
				document.querySelector('#minutes').parentNode.style.display = 'inline-flex';
		}

		var ctimer = days * 60 * 60 * 24;
		ctimer = ctimer + ( hours * 60 * 60 );
		ctimer = ctimer + ( minutes * 60 );
		ctimer = ctimer + seconds;
		if( $location != 'product' ){
			setCKITCookie(key, ctimer, 0);
		} else {
			setCKITCookie(key, ctimer, 30);
		}

		days = ("00"+days).slice(-2);
		hours = ("00"+hours).slice(-2);
		if( $location == 'product' ){
			minutes = ("00"+minutes).slice(-2);
		}
		seconds = ("00"+seconds).slice(-2);

		document.querySelector('#days').innerHTML = days;
		document.querySelector('#hours').innerHTML = hours;
		document.querySelector('#minutes').innerHTML = minutes;
		document.querySelector('#seconds').innerHTML = seconds;

		document.querySelector('#commercekit-timer').style.visibility = 'visible';

		if (ctimer <= 0) {
			if( mode == 'regular' || ( mode != 'regular' && restart == 'none' ) ){
				clearInterval(x);
				if( $location != 'product' ){
					document.querySelector('#commercekit-timer').style.display = 'none';
					document.querySelector('#commercekit-timer-message').style.display = 'inline-block';
				}
			} else {
				if( restart == 'immediate' ){
					var ntime = new Date().getTime();
					countDownDate = ntime + ( otimer * 1000 );
				} else {
					clearInterval(x);
					if( $location != 'product' ){
						document.querySelector('#commercekit-timer').style.display = 'none';
						document.querySelector('#commercekit-timer-message').style.display = 'inline-block';
						setCKITCookie(key, otimer, 0);
					} else {
						setCKITCookie(key, otimer, 30);
					}
				}
			}
		}
	}, 1000);
}
var vinput = document.querySelector('input.variation_id');
if( vinput ){
	document.addEventListener('change', function(e){
		setTimeout(function(){
			var cinput_val = vinput.value;
			if( vinput_val != cinput_val ){
				updateCountDownTimerDisplay(cinput_val);
			}
		}, 300);
	});
	document.addEventListener('click', function(e){
		var input = e.target;
		if( input.classList.contains('reset_variations') ){
			setTimeout(function(){
				var cinput_val = vinput.value;
				if( vinput_val != cinput_val ){
					updateCountDownTimerDisplay(cinput_val);
				}
			}, 300);
		}
	});
	setTimeout(function(){
		var cinput_val = vinput.value;
		if( vinput_val != cinput_val ){
			updateCountDownTimerDisplay(cinput_val);
		}
	}, 300);
}
var vinput_val = '0';
function updateCountDownTimerDisplay(cinput_val){
	var timer = document.querySelector('#commercekit-timer');
	var btn_disabled = document.querySelector('.single_add_to_cart_button.disabled');
	if( cinput_val == '' || cinput_val == '0' ){
		timer.style.display = 'block';
	} else if( btn_disabled ) {
		timer.style.display = 'none';
	} else {
		timer.style.display = 'block';
	}
	vinput_val = cinput_val;
}
</script>
	<?php
}

/**
 * Get timer by location
 *
 * @param  string $location of countdown timer for display.
 * @return string
 */
function commercekit_countdown_timer_by_location( $location ) {

	if ( 'product' === $location ) {
		global $product;
		if ( $product->is_type( 'simple' ) || $product->is_type( 'bundle' ) ) {
			if ( ! $product->backorders_allowed() && ( ( $product->managing_stock() && 0 === (int) $product->get_stock_quantity() ) || 'outofstock' === $product->get_stock_status() ) ) {
				return;
			}
		}
		if ( $product->is_type( 'variable' ) ) {
			$outofstocks = 0;
			$variations  = $product->get_available_variations();
			if ( is_array( $variations ) && count( $variations ) ) {
				foreach ( $variations as $variation ) {
					if ( isset( $variation['backorders_allowed'] ) && 1 === (int) $variation['backorders_allowed'] ) {
						continue;
					}
					if ( ! isset( $variation['is_in_stock'] ) || 1 !== (int) $variation['is_in_stock'] ) {
						$outofstocks++;
					}
				}
				if ( count( $variations ) === $outofstocks ) {
					return;
				}
			} else {
				return;
			}
		}

		$categories = array();
		$terms      = get_the_terms( $product->get_id(), 'product_cat' );
		if ( is_array( $terms ) && count( $terms ) ) {
			foreach ( $terms as $term ) {
				$categories[] = $term->term_id;
			}
		}
	}

	$commercekit_options = get_option( 'commercekit', array() );
	$countdown           = isset( $commercekit_options['countdown'] ) ? $commercekit_options['countdown'] : array();
	$enable_ctd_timer    = isset( $commercekit_options['countdown_timer'] ) && 1 === (int) $commercekit_options['countdown_timer'] ? 1 : 0;
	if ( ! $enable_ctd_timer ) {
		return;
	}

	$title          = '';
	$timer          = array();
	$timer['total'] = 0;
	$mode           = 'regular';
	$restart        = 'none';
	$message        = '';

	if ( 'checkout' === $location ) {
		if ( isset( $countdown['checkout']['active'] ) && 1 === (int) $countdown['checkout']['active'] ) {
			$title            = isset( $countdown['checkout']['title'] ) ? commercekit_get_multilingual_string( $countdown['checkout']['title'] ) : '';
			$message          = isset( $countdown['checkout']['expiry_message'] ) ? commercekit_get_multilingual_string( $countdown['checkout']['expiry_message'] ) : '';
			$timer['total']   = isset( $countdown['checkout']['minutes'] ) ? ( (int) $countdown['checkout']['minutes'] ) * 60 : 0;
			$timer['total']  += isset( $countdown['checkout']['seconds'] ) ? (int) $countdown['checkout']['seconds'] : 0;
			$timer['days']    = 0;
			$timer['hours']   = 0;
			$timer['minutes'] = isset( $countdown['checkout']['minutes'] ) ? (int) $countdown['checkout']['minutes'] : 0;
			$timer['seconds'] = isset( $countdown['checkout']['seconds'] ) ? (int) $countdown['checkout']['seconds'] : 0;
		} else {
			return;
		}
	}

	if ( 'product' === $location ) {
		if ( isset( $countdown['product']['title'] ) && count( $countdown['product']['title'] ) > 0 ) {
			foreach ( $countdown['product']['title'] as $k => $title ) {
				if ( empty( $title ) ) {
					continue;
				}
				if ( isset( $countdown['product']['active'][ $k ] ) && 1 === (int) $countdown['product']['active'][ $k ] ) {
					$can_display = false;
					$condition   = isset( $countdown['product']['condition'][ $k ] ) ? $countdown['product']['condition'][ $k ] : 'all';
					$pids        = isset( $countdown['product']['pids'][ $k ] ) ? explode( ',', $countdown['product']['pids'][ $k ] ) : array();
					$product_id  = (string) $product->get_id();
					if ( 'all' === $condition ) {
						$can_display = true;
					} elseif ( 'products' === $condition ) {
						if ( in_array( $product_id, $pids, true ) ) {
							$can_display = true;
						}
					} elseif ( 'non-products' === $condition ) {
						if ( ! in_array( $product_id, $pids, true ) ) {
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

					if ( $can_display ) {
						$title   = commercekit_get_multilingual_string( $title );
						$restart = 'none';
						$mode    = 1 === (int) $countdown['product']['type'][ $k ] ? 'evergreen' : 'regular';
						if ( 'evergreen' === $mode ) {
							$restart = 'nextvisit';
						}
						$timer['total']   = ( (int) $countdown['product']['days'][ $k ] ) * 60 * 60 * 24;
						$timer['total']  += ( (int) $countdown['product']['hours'][ $k ] ) * 60 * 60;
						$timer['total']  += ( (int) $countdown['product']['minutes'][ $k ] ) * 60;
						$timer['total']  += (int) $countdown['product']['seconds'][ $k ];
						$timer['days']    = (int) $countdown['product']['days'][ $k ];
						$timer['hours']   = (int) $countdown['product']['hours'][ $k ];
						$timer['minutes'] = (int) $countdown['product']['minutes'][ $k ];
						$timer['seconds'] = (int) $countdown['product']['seconds'][ $k ];

						$timer['days_label']    = commercekit_get_multilingual_string( $countdown['product']['days_label'][ $k ] );
						$timer['hours_label']   = commercekit_get_multilingual_string( $countdown['product']['hours_label'][ $k ] );
						$timer['minutes_label'] = commercekit_get_multilingual_string( $countdown['product']['minutes_label'][ $k ] );
						$timer['seconds_label'] = commercekit_get_multilingual_string( $countdown['product']['seconds_label'][ $k ] );

						break;
					}
				}
			}
		}
	}

	if ( $timer['total'] ) {
		$session = 'ckit_' . md5( $timer['total'] . '-' . $mode );
		if ( 'product' === $location ) {
			if ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) || $product->is_type( 'bundle' ) ) {
				commercekit_countdown_timer_template( $title, $timer, $mode, $restart, $session, $location, $message );
			}
		} else {
			commercekit_countdown_timer_template( $title, $timer, $mode, $restart, $session, $location, $message );
		}
	}
}

/**
 * Single Product Page - Display Countdown timer
 */
function commercekit_product_countdown_timer() {
	commercekit_countdown_timer_by_location( 'product' );
}

add_action( 'woocommerce_single_product_summary', 'commercekit_product_countdown_timer', 39 );

/**
 * Checkout Page - Display Countdown timer
 */
function commercekit_checkout_countdown_timer() {
	commercekit_countdown_timer_by_location( 'checkout' );
}

add_action( 'woocommerce_before_checkout_form', 'commercekit_checkout_countdown_timer', 1 );

/**
 * Reset checkout countdown timer
 */
function commercekit_reset_checkout_countdown_timer() {
	if ( WC()->cart->is_empty() ) {
		$options   = get_option( 'commercekit', array() );
		$countdown = isset( $options['countdown'] ) ? $options['countdown'] : array();
		if ( isset( $countdown['checkout']['active'] ) && 1 === (int) $countdown['checkout']['active'] ) {
			$total  = 0;
			$mode   = 'regular';
			$total  = isset( $countdown['checkout']['minutes'] ) ? ( (int) $countdown['checkout']['minutes'] ) * 60 : 0;
			$total += isset( $countdown['checkout']['seconds'] ) ? (int) $countdown['checkout']['seconds'] : 0;
			if ( $total ) {
				$session = 'ckit_' . md5( $total . '-' . $mode );
				setcookie( $session, $total, time() - ( 24 * 3600 ), '/' );
			}
		}
	}
}

add_action( 'woocommerce_cart_item_removed', 'commercekit_reset_checkout_countdown_timer', 10, 0 );
