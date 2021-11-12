<?php
/**
 *
 * Inventory Bar module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Get round stock quantity
 *
 * @param  string $commercekit_stock_quantity of inventory bar.
 * @return string $commercekit_stock_quantity of inventory bar.
 */
function commercekit_get_round_stock_quantity( $commercekit_stock_quantity ) {
	if ( $commercekit_stock_quantity > 30 && $commercekit_stock_quantity <= 40 ) {
		$commercekit_stock_quantity = 40;
	} elseif ( $commercekit_stock_quantity > 40 && $commercekit_stock_quantity <= 50 ) {
		$commercekit_stock_quantity = 50;
	} elseif ( $commercekit_stock_quantity > 50 && $commercekit_stock_quantity <= 60 ) {
		$commercekit_stock_quantity = 60;
	} elseif ( $commercekit_stock_quantity > 60 && $commercekit_stock_quantity <= 70 ) {
		$commercekit_stock_quantity = 70;
	} elseif ( $commercekit_stock_quantity > 70 && $commercekit_stock_quantity <= 80 ) {
		$commercekit_stock_quantity = 80;
	} elseif ( $commercekit_stock_quantity > 80 && $commercekit_stock_quantity <= 90 ) {
		$commercekit_stock_quantity = 90;
	} elseif ( $commercekit_stock_quantity > 90 && $commercekit_stock_quantity <= 100 ) {
		$commercekit_stock_quantity = 100;
	}
	return $commercekit_stock_quantity;
}

/**
 * Get percent stock quantity
 *
 * @param  string $commercekit_stock_quantity of inventory bar.
 * @return string $commercekit_stock_quantity of inventory bar.
 */
function commercekit_get_percent_stock_quantity( $commercekit_stock_quantity ) {
	if ( $commercekit_stock_quantity < 5 ) {
		$commercekit_stock_quantity = 5;
	} elseif ( $commercekit_stock_quantity > 70 ) {
		$commercekit_stock_quantity = 70;
	}
	return $commercekit_stock_quantity;
}
/**
 * Single Product Page - Inventory Bar creation
 *
 * @param  string $display_text of inventory bar.
 * @param  string $display_text_31 of inventory bar.
 * @param  string $display_text_100 of inventory bar.
 */
function commercekit_inventory_number( $display_text, $display_text_31, $display_text_100 ) {
	global $post, $product;
	$commercekit_stock_quantity = $product->get_stock_quantity();
	if ( $product->is_type( 'simple' ) && 0 >= $commercekit_stock_quantity ) {
		return;
	}

	$stock_quantities            = array();
	$low_stock_amounts           = array();
	$stock_quantities['default'] = $commercekit_stock_quantity;
	if ( $product->is_type( 'variable' ) ) {
		$outofstocks = 0;
		$variations  = $product->get_available_variations();
		if ( is_array( $variations ) && count( $variations ) ) {
			foreach ( $variations as $variation ) {
				if ( ! isset( $variation['is_in_stock'] ) || 1 !== (int) $variation['is_in_stock'] ) {
					$outofstocks++;
				} else {
					$vproduct = wc_get_product( $variation['variation_id'] );
					if ( $vproduct ) {
						$stock_quantities[ $variation['variation_id'] ]  = $vproduct->get_stock_quantity();
						$low_stock_amounts[ $variation['variation_id'] ] = (int) $vproduct->get_low_stock_amount();
					}
				}
			}
			if ( count( $variations ) === $outofstocks && 0 >= $commercekit_stock_quantity ) {
				return;
			}
		} else {
			return;
		}
	}

	$can_show_script = false;
	if ( $product->is_type( 'simple' ) && $commercekit_stock_quantity ) {
		$commercekit_stock_percent = commercekit_get_percent_stock_quantity( $commercekit_stock_quantity );
		$final_display_text        = $display_text;
		if ( $commercekit_stock_quantity > 30 && $commercekit_stock_quantity <= 100 ) {
			$final_display_text = $display_text_31;
		}
		if ( $commercekit_stock_quantity > 100 ) {
			$final_display_text = $display_text_100;
		}
		$low_stock_class  = '';
		$low_stock_amount = (int) $product->get_low_stock_amount();
		if ( $low_stock_amount && $commercekit_stock_quantity <= $low_stock_amount ) {
			$low_stock_class    = 'low-stock';
			$final_display_text = $display_text;
		} elseif ( ! $low_stock_amount && $commercekit_stock_quantity < 20 ) {
			$low_stock_class = 'low-stock';
		}
		?>
<div class="commercekit-inventory">
	<span class="title <?php echo esc_html( $low_stock_class ); ?>"><?php echo esc_html( sprintf( $final_display_text, $commercekit_stock_quantity ) ); ?></span>
	<div class="progress-bar full-bar active"><span style="width: <?php echo esc_html( $commercekit_stock_percent ); ?>%;"></span></div>
</div>
		<?php
		$can_show_script = true;
	}

	if ( $product->is_type( 'variable' ) && count( $stock_quantities ) ) {
		?>
		<div class="commercekit-inventory">
		<?php
		foreach ( $stock_quantities as $stock_key => $stock_value ) {
			if ( 0 >= $stock_value ) {
				continue;
			}
			$stock_percent = commercekit_get_percent_stock_quantity( $stock_value );
			if ( ! $stock_value ) {
				continue;
			}
			$final_display_text = $display_text;
			if ( $stock_value > 30 && $stock_value <= 100 ) {
				$final_display_text = $display_text_31;
			}
			if ( $stock_value > 100 ) {
				$final_display_text = $display_text_100;
			}
			$low_stock_class  = '';
			$low_stock_amount = isset( $low_stock_amounts[ $stock_key ] ) ? $low_stock_amounts[ $stock_key ] : 0;
			if ( $low_stock_amount && $stock_value <= $low_stock_amount ) {
				$low_stock_class    = 'low-stock';
				$final_display_text = $display_text;
			} elseif ( ! $low_stock_amount && $stock_value < 20 ) {
				$low_stock_class = 'low-stock';
			}
			?>
			<?php if ( 'default' === $stock_key ) { ?>
			<div class="cki-variation cki-variation-<?php echo esc_html( $stock_key ); ?>">
			<?php } else { ?>
			<div class="cki-variation cki-variation-<?php echo esc_html( $stock_key ); ?>" style="display: none;">
			<?php } ?>
			<span class="title <?php echo esc_html( $low_stock_class ); ?>"><?php echo esc_html( sprintf( $final_display_text, $stock_value ) ); ?></span>
			<div class="progress-bar full-bar <?php echo 'default' === $stock_key ? 'active' : ''; ?>"><span style="width: <?php echo esc_html( $stock_percent ); ?>%;"></span></div>
		</div>
			<?php
			$can_show_script = true;
		}
		?>
		</div>
		<?php
	}

	if ( $can_show_script ) {
		?>
<style>
.commercekit-inventory { display: inline-block; width: 45%; margin-bottom: 15px; vertical-align: top; line-height: 1.25; position: relative; }
.commercekit-inventory span { font-size: 15px; }
.commercekit-inventory .progress-bar { float: none; position: relative; width: 100%; height: 10px; margin-top: 10px; padding: 0; border-radius: 5px; background-color: #e2e2e2; transition: all 0.4s ease; }
.commercekit-inventory .progress-bar span { position: absolute; top: 0; left: auto; width: 28%; height: 100%; border-radius: inherit; background: #f5b64c; transition: width 3s ease; }
.commercekit-inventory .progress-bar.full-bar span { width: 100% !important; }
.commercekit-inventory .cki-variation { width: 100%; }
@media (max-width: 500px) { .commercekit-inventory { display: block; margin-top: 20px; width: 100%; border: none; } 
.commercekit-inventory .cki-variation { position: relative; } }
</style>
<script>
function isInCKITViewport(element){
	var rect = element.getBoundingClientRect();
	return (
		rect.top >= 0 &&
		rect.left >= 0 &&
		rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
		rect.right <= (window.innerWidth || document.documentElement.clientWidth)
	);
}
function animateInventoryBar(){
	var bar = document.querySelector('.commercekit-inventory .progress-bar.active');
	if( bar ) {
		if( isInCKITViewport(bar) ){
			var y = setTimeout(function() {
				bar.classList.remove('full-bar');
			}, 100);
		}
	}
}
function animateInventoryHandler(entries, observer) {
	for( entry of entries ){
		if( entry.isIntersecting && entry.target.classList.contains('progress-bar') ){
			var bar = document.querySelector('.commercekit-inventory .progress-bar.active');
			if( bar )
				bar.classList.remove('full-bar');
		}
	}
}
var cgi_observer = new IntersectionObserver(animateInventoryHandler);
if( document.querySelector('.commercekit-inventory') ){
	var $cgkit_cdt = document.querySelector('#commercekit-timer');
	if( $cgkit_cdt ){
		$cgkit_cdt.classList.add('has-cg-inventory');
	}
	animateInventoryBar();
	window.onresize = animateInventoryBar;
	cgi_observer.observe(document.querySelector('.commercekit-inventory .progress-bar'));
	var vinput2 = document.querySelector('input.variation_id');
	if( vinput2 ){
		document.addEventListener('change', function(e){
			setTimeout(function(){
				var cinput_val2 = vinput2.value;
				if( vinput_val2 != cinput_val2 && cinput_val2 != '' ){
					updateStockInventoryDisplay(cinput_val2);
				}
			}, 300);
		});
		document.addEventListener('click', function(e){
			var input = e.target;
			var inputp = input.closest('.swatch');
			if( input.classList.contains('reset_variations') || input.classList.contains('swatch') || inputp ){
				var clear_var = false;
				if( input.classList.contains('reset_variations') ){
					clear_var = true;
				}
				setTimeout(function(){
					if( inputp ){
						input = inputp;
					}
					if( !input.classList.contains('selected') ){
						clear_var = true;
					}
					var cinput_val2 = vinput2.value;
					if( vinput_val2 != cinput_val2 && ( cinput_val2 != '' || clear_var ) ){
						updateStockInventoryDisplay(cinput_val2);
					}
				}, 300);
			}
		});
		setTimeout(function(){
			var cinput_val2 = vinput2.value;
			if( vinput_val2 != cinput_val2 && cinput_val2 != '' ){
				updateStockInventoryDisplay(cinput_val2);
			}
		}, 300);
	}
}
var vinput_val2 = '0';
function updateStockInventoryDisplay(cinput_val2){
	var btn_disabled = document.querySelector('.single_add_to_cart_button.disabled');
	var display_class = '.cki-variation-'+cinput_val2;
	if( cinput_val2 == '' || cinput_val2 == '0' ){
		display_class = '.cki-variation-default';
	} else if( btn_disabled ) {
		display_class = '';
	} else {
		display_class = '.cki-variation-'+cinput_val2;
	}
	var cki_vars = document.querySelectorAll('.cki-variation');
	cki_vars.forEach(function(cki_var){
		cki_var.style.display = 'none';
		var bar = cki_var.querySelector('.progress-bar');
		if( bar ){
			bar.classList.remove('active');
			bar.classList.add('full-bar');
		}
	});
	if( display_class != '' ){
		var cki_var = document.querySelector(display_class);
		if( cki_var ){
			cki_var.style.display = 'block';
			var bar = cki_var.querySelector('.progress-bar');
			if( bar ){
				bar.classList.add('active');
			}
		}
	}
	vinput_val2 = cinput_val2;
	var bar = document.querySelector('.commercekit-inventory .progress-bar.active');
	if( bar )
		cgi_observer.observe(bar);
}
</script>
		<?php
	}
}

/**
 * Single Product Page - Display Inventory Bar
 */
function commercekit_display_inventory_counter() {
	global $product;
	$commercekit_inventory_display = false;
	$commercekit_stock_quantity    = $product->get_stock_quantity();
	$commercekit_options           = get_option( 'commercekit', array() );
	if ( isset( $commercekit_options['inventory_display'] ) && 1 === (int) $commercekit_options['inventory_display'] ) {
		$commercekit_inventory_display = true;
	}
	/* translators: %s: stock counter. */
	$display_text = isset( $commercekit_options['inventory_text'] ) && ! empty( $commercekit_options['inventory_text'] ) ? commercekit_get_multilingual_string( $commercekit_options['inventory_text'] ) : esc_html__( 'Only %s items left in stock!', 'commercegurus-commercekit' );

	/* translators: %s: stock counter. */
	$display_text_31 = isset( $commercekit_options['inventory_text_31'] ) && ! empty( $commercekit_options['inventory_text_31'] ) ? commercekit_get_multilingual_string( $commercekit_options['inventory_text_31'] ) : esc_html__( 'Less than %s items left!', 'commercegurus-commercekit' );

	$display_text_100 = isset( $commercekit_options['inventory_text_100'] ) && ! empty( $commercekit_options['inventory_text_100'] ) ? commercekit_get_multilingual_string( $commercekit_options['inventory_text_100'] ) : esc_html__( 'This item is selling fast!', 'commercegurus-commercekit' );

	if ( true === $commercekit_inventory_display ) {
		if ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) {
			commercekit_inventory_number( $display_text, $display_text_31, $display_text_100 );
		}
	}
}

add_action( 'woocommerce_single_product_summary', 'commercekit_display_inventory_counter', 40 );
