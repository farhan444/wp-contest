<?php
/**
 *
 * Admin Countdown Timer
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

$countdown = isset( $commercekit_options['countdown'] ) ? $commercekit_options['countdown'] : array();
?>
<div id="settings-content">
<div class="postbox content-box">
	<h2><span><?php esc_html_e( 'Product Countdown', 'commercegurus-commercekit' ); ?></span><span id="ctd-order-notice" style="display:none;"><?php esc_html_e( 'The order of the countdowns is important. Drag a countdown to the top to take precedence.', 'commercegurus-commercekit' ); ?></span></h2>

	<div class="inside meta-box-sortables" id="product-countdown">

		<div class="postbox no-change closed" id="first-row" style="display:none;">
			<button type="button" class="handlediv" aria-expanded="true"><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="gray"><span><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?></span></h2>
			<div class="inside">
				<table class="form-table countdown-timer" role="presentation">
					<tr> 
						<th width="20%"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?>: </th>
						<td> <label class="toggle-switch"><input name="commercekit_ctd_pdt_at[]" type="checkbox" class="check pdt-active" value="1"><span class="toggle-slider"></span><input type="hidden" name="commercekit[countdown][product][active][]" class="pdt-active-val" value="0" /><input type="hidden" name="commercekit[countdown][product][activeo][]" class="pdt-active-val" value="0" /></label>&nbsp;&nbsp;<?php esc_html_e( 'Enable countdown timer on product page', 'commercegurus-commercekit' ); ?></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[countdown][product][title][]" type="text" class="title pdt-title text required" value="" /></label><br /><small><em><?php esc_html_e( 'e.g. Hurry! This sale ends in', 'commercegurus-commercekit' ); ?></em></small></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Ends', 'commercegurus-commercekit' ); ?>: </th>
						<td class="ends-wrap"> 
							<label><input name="commercekit[countdown][product][days][]" type="number" min="0" class="ends text" value="0" /><br /><span class="ends-label"><?php esc_html_e( 'DAYS', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][hours][]" type="number" min="0" max="23" class="ends text" value="0" /><br /><span class="ends-label"><?php esc_html_e( 'HOURS', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][minutes][]" type="number" min="0" max="59" class="ends text" value="0" /><br /><span class="ends-label"><?php esc_html_e( 'MINUTES', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][seconds][]" type="number" min="0" max="59" class="ends text" value="0" /><br /><span class="ends-label"><?php esc_html_e( 'SECONDS', 'commercegurus-commercekit' ); ?></span></label>
						</td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Labels', 'commercegurus-commercekit' ); ?>: </th>
						<td class="ends-wrap"> 
							<label><input name="commercekit[countdown][product][days_label][]" type="text" min="0" class="ends text days" value="<?php esc_html_e( 'Days', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label">DAYS</span></label>
							<label><input name="commercekit[countdown][product][hours_label][]" type="text" min="0" max="23" class="ends text hours" value="<?php esc_html_e( 'Hours', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label"><?php esc_html_e( 'HOURS', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][minutes_label][]" type="text" min="0" max="59" class="ends text minutes" value="<?php esc_html_e( 'Mins', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label"><?php esc_html_e( 'MINUTES', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][seconds_label][]" type="text" min="0" max="59" class="ends text seconds" value="<?php esc_html_e( 'Secs', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label"><?php esc_html_e( 'SECONDS', 'commercegurus-commercekit' ); ?></span></label>
						</td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Type', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php esc_html_e( 'Evergreen sets a dynamic countdown timer for each visitor', 'commercegurus-commercekit' ); ?>"></span></span></th>
						<td> <label><input type="radio" value="0" class="pdt-type radio-0" name="radio-0" checked="checked" />&nbsp;<?php esc_html_e( 'One-time', 'commercegurus-commercekit' ); ?></label> <span class="radio-space">&nbsp;</span><label><input type="radio" value="1" class="pdt-type radio-1" name="radio-0" />&nbsp;<?php esc_html_e( 'Evergreen', 'commercegurus-commercekit' ); ?></label><input type="hidden" name="commercekit[countdown][product][type][]" class="pdt-type-val" value="0" /></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Conditions', 'commercegurus-commercekit' ); ?>: </th>
						<td> 
							<select name="commercekit[countdown][product][condition][]" class="conditions">
								<option value="all" selected="selected"><?php esc_html_e( 'All products', 'commercegurus-commercekit' ); ?></option>
								<option value="products"><?php esc_html_e( 'Specific products', 'commercegurus-commercekit' ); ?></option>
								<option value="non-products"><?php esc_html_e( 'All products apart from', 'commercegurus-commercekit' ); ?></option>
								<option value="categories"><?php esc_html_e( 'Specific categories', 'commercegurus-commercekit' ); ?></option>
								<option value="non-categories"><?php esc_html_e( 'All categories apart from', 'commercegurus-commercekit' ); ?></option>
							</select>
						</td> 
					</tr>
					<tr class="product-ids" style="display:none;">
						<th class="options">
						<?php esc_html_e( 'Specific products:', 'commercegurus-commercekit' ); ?>
						</th>
						<td> <label><select name="commercekit_ctd_pdt_pids[]" class="select2" data-type="all" multiple="multiple" style="width:100%;"></select><input type="hidden" name="commercekit[countdown][product][pids][]" class="select3 text" value="" /></label></td> 
					</tr>
					<tr><td colspan="2" align="right"><!--DELETE--></td></tr>
				</table>
			</div>
		</div>
		<?php
		$radio_count = 0;
		if ( isset( $countdown['product']['title'] ) && count( $countdown['product']['title'] ) > 0 ) {
			foreach ( $countdown['product']['title'] as $k => $product_title ) {
				if ( empty( $product_title ) ) {
					continue;
				}
				$radio_count = $k;
				?>
		<div class="postbox no-change closed">
			<button type="button" class="handlediv" aria-expanded="true"><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="gray"><span>
				<?php
				echo isset( $countdown['product']['title'][ $k ] ) && ! empty( $countdown['product']['title'][ $k ] ) ? esc_attr( $countdown['product']['title'][ $k ] ) : esc_html__( 'Title', 'commercegurus-commercekit' );
				?>
			</span></h2>
			<div class="inside">
				<table class="form-table countdown-timer" role="presentation">
					<tr> 
						<th width="20%"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?>: </th>
						<td> <label class="toggle-switch"><input name="commercekit_ctd_pdt_at[]" type="checkbox" class="check pdt-active" value="1" <?php echo isset( $countdown['product']['active'][ $k ] ) && 1 === (int) $countdown['product']['active'][ $k ] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span><input type="hidden" name="commercekit[countdown][product][active][]" class="pdt-active-val" value="<?php echo isset( $countdown['product']['active'][ $k ] ) ? esc_attr( $countdown['product']['active'][ $k ] ) : '0'; ?>" /><input type="hidden" name="commercekit[countdown][product][activeo][]" class="pdt-active-val" value="<?php echo isset( $countdown['product']['activeo'][ $k ] ) ? esc_attr( $countdown['product']['activeo'][ $k ] ) : '0'; ?>" /></label>&nbsp;&nbsp;<?php esc_html_e( 'Enable countdown timer on product page', 'commercegurus-commercekit' ); ?></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[countdown][product][title][]" type="text" class="title pdt-title text required" value="<?php echo isset( $countdown['product']['title'][ $k ] ) ? esc_attr( stripslashes_deep( $countdown['product']['title'][ $k ] ) ) : ''; ?>" /></label><br /><small><em><?php esc_html_e( 'e.g. Hurry! This sale ends in', 'commercegurus-commercekit' ); ?></em></small></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Ends', 'commercegurus-commercekit' ); ?>: </th>
						<td class="ends-wrap"> 
							<label><input name="commercekit[countdown][product][days][]" type="number" min="0" class="ends text" value="<?php echo isset( $countdown['product']['days'][ $k ] ) ? esc_attr( $countdown['product']['days'][ $k ] ) : '0'; ?>" /><br /><span class="ends-label"><?php esc_html_e( 'DAYS', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][hours][]" type="number" min="0" max="23" class="ends text" value="<?php echo isset( $countdown['product']['hours'][ $k ] ) ? esc_attr( $countdown['product']['hours'][ $k ] ) : '0'; ?>" /><br /><span class="ends-label"><?php esc_html_e( 'HOURS', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][minutes][]" type="number" min="0" max="59" class="ends text" value="<?php echo isset( $countdown['product']['minutes'][ $k ] ) ? esc_attr( $countdown['product']['minutes'][ $k ] ) : '0'; ?>" /><br /><span class="ends-label"><?php esc_html_e( 'MINUTES', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][seconds][]" type="number" min="0" max="59" class="ends text" value="<?php echo isset( $countdown['product']['seconds'][ $k ] ) ? esc_attr( $countdown['product']['seconds'][ $k ] ) : '0'; ?>" /><br /><span class="ends-label"><?php esc_html_e( 'SECONDS', 'commercegurus-commercekit' ); ?></span></label>
						</td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Labels', 'commercegurus-commercekit' ); ?>: </th>
						<td class="ends-wrap"> 
							<label><input name="commercekit[countdown][product][days_label][]" type="text" min="0" class="ends text days" value="<?php echo isset( $countdown['product']['days_label'][ $k ] ) && ! empty( $countdown['product']['days_label'][ $k ] ) ? esc_attr( $countdown['product']['days_label'][ $k ] ) : esc_html__( 'Days', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label"><?php esc_html_e( 'DAYS', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][hours_label][]" type="text" min="0" max="23" class="ends text hours" value="<?php echo isset( $countdown['product']['hours_label'][ $k ] ) && ! empty( $countdown['product']['hours_label'][ $k ] ) ? esc_attr( $countdown['product']['hours_label'][ $k ] ) : esc_html__( 'Hours', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label"><?php esc_html_e( 'HOURS', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][minutes_label][]" type="text" min="0" max="59" class="ends text minutes" value="<?php echo isset( $countdown['product']['minutes_label'][ $k ] ) && ! empty( $countdown['product']['minutes_label'][ $k ] ) ? esc_attr( $countdown['product']['minutes_label'][ $k ] ) : esc_html__( 'Mins', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label"><?php esc_html_e( 'MINUTES', 'commercegurus-commercekit' ); ?></span></label>
							<label><input name="commercekit[countdown][product][seconds_label][]" type="text" min="0" max="59" class="ends text seconds" value="<?php echo isset( $countdown['product']['seconds_label'][ $k ] ) && ! empty( $countdown['product']['seconds_label'][ $k ] ) ? esc_attr( $countdown['product']['seconds_label'][ $k ] ) : esc_html__( 'Secs', 'commercegurus-commercekit' ); ?>" /><br /><span class="ends-label"><?php esc_html_e( 'SECONDS', 'commercegurus-commercekit' ); ?></span></label>
						</td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Type', 'commercegurus-commercekit' ); ?>:  <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php esc_html_e( 'Evergreen sets a dynamic countdown timer for each visitor', 'commercegurus-commercekit' ); ?>"></span></span></th>
						<td> <label><input type="radio" value="0" class="pdt-type radio-0" name="radio-<?php echo esc_attr( $k ); ?>" <?php echo ( isset( $countdown['product']['type'][ $k ] ) && 0 === (int) $countdown['product']['type'][ $k ] ) || ! isset( $countdown['product']['type'][ $k ] ) ? 'checked="checked"' : ''; ?> />&nbsp;<?php esc_html_e( 'One-time', 'commercegurus-commercekit' ); ?></label> <span class="radio-space">&nbsp;</span><label><input type="radio" value="1" class="pdt-type radio-1" name="radio-<?php echo esc_attr( $k ); ?>" <?php echo isset( $countdown['product']['type'][ $k ] ) && 1 === (int) $countdown['product']['type'][ $k ] ? 'checked="checked"' : ''; ?> />&nbsp;<?php esc_html_e( 'Evergreen', 'commercegurus-commercekit' ); ?></label><input type="hidden" name="commercekit[countdown][product][type][]" class="pdt-type-val" value="<?php echo isset( $countdown['product']['type'][ $k ] ) ? esc_attr( $countdown['product']['type'][ $k ] ) : '0'; ?>" /></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Conditions', 'commercegurus-commercekit' ); ?>: </th>
						<td> 
							<?php
							$ctype = 'all';
							if ( isset( $countdown['product']['condition'][ $k ] ) && in_array( $countdown['product']['condition'][ $k ], array( 'products', 'non-products' ), true ) ) {
								$ctype = 'products';
							}
							if ( isset( $countdown['product']['condition'][ $k ] ) && in_array( $countdown['product']['condition'][ $k ], array( 'categories', 'non-categories' ), true ) ) {
								$ctype = 'categories';
							}
							?>
							<select name="commercekit[countdown][product][condition][]" class="conditions">
								<option value="all" <?php echo isset( $countdown['product']['condition'][ $k ] ) && 'all' === $countdown['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'All products', 'commercegurus-commercekit' ); ?></option>
								<option value="products" <?php echo isset( $countdown['product']['condition'][ $k ] ) && 'products' === $countdown['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Specific products', 'commercegurus-commercekit' ); ?></option>
								<option value="non-products" <?php echo isset( $countdown['product']['condition'][ $k ] ) && 'non-products' === $countdown['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'All products apart from', 'commercegurus-commercekit' ); ?></option>
								<option value="categories" <?php echo isset( $countdown['product']['condition'][ $k ] ) && 'categories' === $countdown['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Specific categories', 'commercegurus-commercekit' ); ?></option>
								<option value="non-categories" <?php echo isset( $countdown['product']['condition'][ $k ] ) && 'non-categories' === $countdown['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'All categories apart from', 'commercegurus-commercekit' ); ?></option>
							</select>
						</td> 
					</tr>
					<tr class="product-ids" <?php echo 'all' === $ctype ? 'style="display:none;"' : ''; ?>>
						<th class="options">
						<?php
						echo 'all' === $ctype || 'products' === $ctype ? 'Specific products:' : '';
						echo 'categories' === $ctype ? esc_html__( 'Specific categories:', 'commercegurus-commercekit' ) : '';
						?>
						</th>
						<td> <label><select name="commercekit_ctd_pdt_pids[]" class="select2" data-type="<?php echo esc_attr( $ctype ); ?>" multiple="multiple" style="width:100%;">
						<?php
						$pids = isset( $countdown['product']['pids'][ $k ] ) ? explode( ',', $countdown['product']['pids'][ $k ] ) : array();
						if ( 'all' !== $ctype && count( $pids ) ) {
							foreach ( $pids as $pid ) {
								if ( empty( $pid ) ) {
									continue;
								}
								if ( 'products' === $ctype ) {
									echo '<option value="' . esc_attr( $pid ) . '" selected="selected">#' . esc_attr( $pid ) . ' - ' . esc_html( commercekit_limit_title( get_the_title( $pid ) ) ) . '</option>';
								}
								if ( 'categories' === $ctype ) {
									$nterm       = get_term_by( 'id', $pid, 'product_cat' );
									$nterm->name = isset( $nterm->name ) ? $nterm->name : '';
									echo '<option value="' . esc_attr( $pid ) . '" selected="selected">#' . esc_attr( $pid ) . ' - ' . esc_html( $nterm->name ) . '</option>';
								}
							}
						}
						?>
						</select><input type="hidden" name="commercekit[countdown][product][pids][]" class="select3 text" value="<?php echo esc_html( implode( ',', $pids ) ); ?>" /></label></td> 
					</tr>
					<tr><td colspan="2" align="right"><a href="javascript:;" class="delete-countdown" onclick="delete_product_countdown(this);"><?php esc_html_e( 'Delete Countdown', 'commercegurus-commercekit' ); ?></a></td></tr>
				</table>
			</div>
		</div>

				<?php
			}
		}
		?>
	</div>
	<script> 
	var global_radio_count = <?php echo (int) $radio_count; ?>;
	var global_delete_countdown = '<?php esc_html_e( 'Delete Countdown', 'commercegurus-commercekit' ); ?>';
	var global_delete_countdown_confirm = '<?php esc_html_e( 'Are you sure you want to delete this product countdown?', 'commercegurus-commercekit' ); ?>';
	var global_required_text = '<?php esc_html_e( 'This field is required', 'commercegurus-commercekit' ); ?>';
	</script>

	<div class="inside add-new-countdown"><button type="button" class="button button-secondary" onclick="add_new_product_countdown();"><span class="dashicons dashicons-plus"></span> <?php esc_html_e( 'Add new product countdown', 'commercegurus-commercekit' ); ?></button></div>

</div>
<div class="postbox content-box" id="checkout-countdown">
	<h2><span><?php esc_html_e( 'Checkout Countdown', 'commercegurus-commercekit' ); ?></span></h2>

	<div class="inside">
		<table class="form-table" role="presentation">
			<tr> 
				<th width="20%"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?>: </th>
				<td> <label class="toggle-switch"><input name="commercekit[countdown][checkout][active]" type="checkbox" class="check" value="1" <?php echo isset( $countdown['checkout']['active'] ) && 1 === (int) $countdown['checkout']['active'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label>&nbsp;&nbsp;<?php esc_html_e( 'Enable countdown timer on checkout page', 'commercegurus-commercekit' ); ?></td> 
			</tr>
			<tr> 
				<th><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?>: </th>
				<td> <label><input name="commercekit[countdown][checkout][title]" type="text" class="title ckt-title text" value="<?php echo isset( $countdown['checkout']['title'] ) ? esc_attr( stripslashes_deep( $countdown['checkout']['title'] ) ) : ''; ?>" /></label><br /><small><em><?php esc_html_e( 'e.g. Your order is reserved for:', 'commercegurus-commercekit' ); ?></em></small></td> 
			</tr>
			<tr> 
				<th><?php esc_html_e( 'Expiry Message', 'commercegurus-commercekit' ); ?>: </th>
				<td> <label><input name="commercekit[countdown][checkout][expiry_message]" type="text" class="title ckt-title text" value="<?php echo isset( $countdown['checkout']['expiry_message'] ) ? esc_attr( stripslashes_deep( $countdown['checkout']['expiry_message'] ) ) : ''; ?>" /></label><br /><small><em><?php esc_html_e( 'e.g. Times up! But good news! We&rsquo;ve extended your checkout time :)', 'commercegurus-commercekit' ); ?></em></small></td> 
			</tr>
			<tr> 
				<th><?php esc_html_e( 'Ends', 'commercegurus-commercekit' ); ?>: </th>
				<td class="ends-wrap"> 
					<label><input name="commercekit[countdown][checkout][minutes]" type="number" min="0" max="59" class="ends text" value="<?php echo isset( $countdown['checkout']['minutes'] ) ? esc_attr( $countdown['checkout']['minutes'] ) : ''; ?>" /><br /><span class="ends-label"><?php esc_html_e( 'MINUTES', 'commercegurus-commercekit' ); ?></span></label>
					<label><input name="commercekit[countdown][checkout][seconds]" type="number" min="0" max="59" class="ends text" value="<?php echo isset( $countdown['checkout']['seconds'] ) ? esc_attr( $countdown['checkout']['seconds'] ) : ''; ?>" /><br /><span class="ends-label"><?php esc_html_e( 'SECONDS', 'commercegurus-commercekit' ); ?></span></label>
				</td> 
			</tr>
		</table>
	</div>

</div>
</div>
<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Countdown Timer', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'This feature allows you to run time-limited promotions to create urgency and drive more clicks from your single product pages to create more sales. You can also add one to the checkout page to encourage faster completion.', 'commercegurus-commercekit' ); ?></p>
</div>
