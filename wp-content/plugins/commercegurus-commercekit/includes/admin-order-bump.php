<?php
/**
 *
 * Admin Order Bump
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

$order_bump_product = isset( $commercekit_options['order_bump_product'] ) ? $commercekit_options['order_bump_product'] : array();
?>
<div id="settings-content" class="postbox content-box">
	<h2><span><?php esc_html_e( 'Order Bump', 'commercegurus-commercekit' ); ?></span></h2>

	<div class="inside meta-box-sortables" id="product-orderbump">

		<div class="postbox no-change closed" id="first-row" style="display:none;">
			<button type="button" class="handlediv" aria-expanded="true"><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="gray"><span><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?></span></h2>
			<div class="inside">
				<table class="form-table admin-order-bump" role="presentation">
					<tr> 
						<th width="20%"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?>: </th>
						<td> <label class="toggle-switch"><input name="commercekit_obp_pdt_at[]" type="checkbox" class="check pdt-active" value="1"><span class="toggle-slider"></span><input type="hidden" name="commercekit[order_bump_product][product][active][]" class="pdt-active-val" value="0" /><input type="hidden" name="commercekit[order_bump_product][product][activeo][]" class="pdt-active-val" value="0" /></label>&nbsp;&nbsp;<?php esc_html_e( 'Enable order bump on checkout', 'commercegurus-commercekit' ); ?></td> 
					</tr>
					<tr>
						<th><?php esc_html_e( 'Select', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><select name="commercekit[order_bump_product][product][id][]" class="select2 order-bump-product required" data-type="products" data-tab="order-bump" data-mode="full" data-placeholder="Select a product to offer..." style="width:100%;"></select></label><br /><small><em><?php esc_html_e( 'This is the order bump product which will appear on the checkout page. Simple and variable products only.', 'commercegurus-commercekit' ); ?></em></small></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[order_bump_product][product][title][]" type="text" class="title pdt-title text required" value="" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Button text', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[order_bump_product][product][button_text][]" type="text" class="title text btext required" value="<?php esc_html_e( 'Click to add', 'commercegurus-commercekit' ); ?>" /></label></td> 
					</tr>
					<tr> 
						<th>Button added: <span class="star">*</span></th>
						<td> <label><input name="commercekit[order_bump_product][product][button_added][]" type="text" class="title text badded required" value="<?php esc_html_e( 'Added!', 'commercegurus-commercekit' ); ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Conditions', 'commercegurus-commercekit' ); ?>: </th>
						<td> 
							<select name="commercekit[order_bump_product][product][condition][]" class="conditions">
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
						<td> <label><select name="commercekit_obp_pdt_pids[]" class="select2" data-type="all" data-tab="order-bump" data-mode="full" multiple="multiple" style="width:100%;"></select><input type="hidden" name="commercekit[order_bump_product][product][pids][]" class="select3 text" value="" /></label></td> 
					</tr>
					<tr><td colspan="2" align="right"><!--DELETE--></td></tr>
				</table>
			</div>
		</div>
		<?php
		if ( isset( $order_bump_product['product']['title'] ) && count( $order_bump_product['product']['title'] ) > 0 ) {
			foreach ( $order_bump_product['product']['title'] as $k => $product_title ) {
				if ( empty( $product_title ) ) {
					continue;
				}
				?>
		<div class="postbox no-change closed">
			<button type="button" class="handlediv" aria-expanded="true"><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="gray"><span>
				<?php
				echo isset( $order_bump_product['product']['title'][ $k ] ) && ! empty( $order_bump_product['product']['title'][ $k ] ) ? esc_html( $order_bump_product['product']['title'][ $k ] ) : esc_html__( 'Title', 'commercegurus-commercekit' );
				?>
			</span></h2>
			<div class="inside">
				<table class="form-table admin-order-bump" role="presentation">
					<tr> 
						<th width="20%"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?>: </th>
						<td> <label class="toggle-switch"><input name="commercekit_obp_pdt_at[]" type="checkbox" class="check pdt-active" value="1" <?php echo isset( $order_bump_product['product']['active'][ $k ] ) && 1 === (int) $order_bump_product['product']['active'][ $k ] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span><input type="hidden" name="commercekit[order_bump_product][product][active][]" class="pdt-active-val" value="<?php echo isset( $order_bump_product['product']['active'][ $k ] ) ? esc_attr( $order_bump_product['product']['active'][ $k ] ) : '0'; ?>" /><input type="hidden" name="commercekit[order_bump_product][product][activeo][]" class="pdt-active-val" value="<?php echo isset( $order_bump_product['product']['activeo'][ $k ] ) ? esc_attr( $order_bump_product['product']['activeo'][ $k ] ) : '0'; ?>" /></label>&nbsp;&nbsp;<?php esc_html_e( 'Enable order bump on checkout', 'commercegurus-commercekit' ); ?></td> 
					</tr>
					<tr>
						<th><?php esc_html_e( 'Select', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><select name="commercekit[order_bump_product][product][id][]" class="select2 order-bump-product required" data-type="products" data-tab="order-bump" data-mode="full" data-placeholder="Select a product to offer..." style="width:100%;">
						<?php
						$pid = isset( $order_bump_product['product']['id'][ $k ] ) ? (int) $order_bump_product['product']['id'][ $k ] : 0;
						if ( $pid ) {
							echo '<option value="' . esc_attr( $pid ) . '" selected="selected">#' . esc_attr( $pid ) . ' - ' . esc_html( commercekit_limit_title( get_the_title( $pid ) ) ) . '</option>';
						}
						?>
						</select></label><br /><small><em><?php esc_html_e( 'This is the order bump product which will appear on the checkout page. Simple and variable products only.', 'commercegurus-commercekit' ); ?></em></small></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[order_bump_product][product][title][]" type="text" class="title pdt-title text required" value="<?php echo isset( $order_bump_product['product']['title'][ $k ] ) ? esc_attr( stripslashes_deep( $order_bump_product['product']['title'][ $k ] ) ) : ''; ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Button text', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[order_bump_product][product][button_text][]" type="text" class="title text btext required" value="<?php echo isset( $order_bump_product['product']['button_text'][ $k ] ) ? esc_attr( stripslashes_deep( $order_bump_product['product']['button_text'][ $k ] ) ) : 'Click to add'; ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Button added', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[order_bump_product][product][button_added][]" type="text" class="title text badded required" value="<?php echo isset( $order_bump_product['product']['button_added'][ $k ] ) ? esc_attr( stripslashes_deep( $order_bump_product['product']['button_added'][ $k ] ) ) : 'Added!'; ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Conditions', 'commercegurus-commercekit' ); ?>: </th>
						<td> 
							<?php
							$ctype = 'all';
							if ( isset( $order_bump_product['product']['condition'][ $k ] ) && in_array( $order_bump_product['product']['condition'][ $k ], array( 'products', 'non-products' ), true ) ) {
								$ctype = 'products';
							}
							if ( isset( $order_bump_product['product']['condition'][ $k ] ) && in_array( $order_bump_product['product']['condition'][ $k ], array( 'categories', 'non-categories' ), true ) ) {
								$ctype = 'categories';
							}
							?>
							<select name="commercekit[order_bump_product][product][condition][]" class="conditions">
								<option value="all" <?php echo isset( $order_bump_product['product']['condition'][ $k ] ) && 'all' === $order_bump_product['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'All products', 'commercegurus-commercekit' ); ?></option>
								<option value="products" <?php echo isset( $order_bump_product['product']['condition'][ $k ] ) && 'products' === $order_bump_product['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Specific products', 'commercegurus-commercekit' ); ?></option>
								<option value="non-products" <?php echo isset( $order_bump_product['product']['condition'][ $k ] ) && 'non-products' === $order_bump_product['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'All products apart from', 'commercegurus-commercekit' ); ?></option>
								<option value="categories" <?php echo isset( $order_bump_product['product']['condition'][ $k ] ) && 'categories' === $order_bump_product['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Specific categories', 'commercegurus-commercekit' ); ?></option>
								<option value="non-categories" <?php echo isset( $order_bump_product['product']['condition'][ $k ] ) && 'non-categories' === $order_bump_product['product']['condition'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'All categories apart from', 'commercegurus-commercekit' ); ?></option>
							</select>
						</td> 
					</tr>
					<tr class="product-ids" <?php echo 'all' === $ctype ? 'style="display:none;"' : ''; ?>>
						<th class="options">
						<?php
						echo 'all' === $ctype || 'products' === $ctype ? esc_attr( 'Specific products:' ) : '';
						echo 'categories' === $ctype ? esc_html__( 'Specific categories:', 'commercegurus-commercekit' ) : '';
						?>
						</th>
						<td> <label><select name="commercekit_obp_pdt_pids[]" class="select2" data-type="<?php echo esc_attr( $ctype ); ?>" data-tab="order-bump" data-mode="full" multiple="multiple" style="width:100%;">
						<?php
						$pids = isset( $order_bump_product['product']['pids'][ $k ] ) ? explode( ',', $order_bump_product['product']['pids'][ $k ] ) : array();
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
						</select><input type="hidden" name="commercekit[order_bump_product][product][pids][]" class="select3 text" value="<?php echo esc_html( implode( ',', $pids ) ); ?>" /></label></td> 
					</tr>
					<tr><td colspan="2" align="right"><a href="javascript:;" class="delete-orderbump" onclick="delete_product_orderbump(this);"><?php esc_html_e( 'Delete order bump', 'commercegurus-commercekit' ); ?></a></td></tr>
				</table>
			</div>
		</div>
				<?php
			}
		}
		?>
	</div>
	<script> 
	var global_delete_orderbump = '<?php esc_html_e( 'Delete order bump', 'commercegurus-commercekit' ); ?>';
	var global_delete_orderbump_confirm = '<?php esc_html_e( 'Are you sure you want to delete this product order bump?', 'commercegurus-commercekit' ); ?>';
	var global_required_text = '<?php esc_html_e( 'This field is required', 'commercegurus-commercekit' ); ?>';
	</script>

	<div class="inside add-new-order-bump"><button type="button" class="button button-secondary" onclick="add_new_order_bump();"><span class="dashicons dashicons-plus"></span> <?php esc_html_e( 'Add new order bump', 'commercegurus-commercekit' ); ?></button></div>

</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Order Bump', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'An order bump allows a user to add an additional item to the cart, before they complete an order.', 'commercegurus-commercekit' ); ?></p>
	<p><?php esc_html_e( 'This captures the excitement of making a purchase, and can increase the average order value.', 'commercegurus-commercekit' ); ?></p>
	<p><?php esc_html_e( 'Only one order bump is displayed at a time on the checkout page.', 'commercegurus-commercekit' ); ?></p>
</div>
