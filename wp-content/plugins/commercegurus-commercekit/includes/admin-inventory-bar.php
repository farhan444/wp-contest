<?php
/**
 *
 * Admin Inventory Bar
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

?>
<div id="settings-content" class="postbox content-box">
	<h2><span><?php esc_html_e( 'Stock Meter', 'commercegurus-commercekit' ); ?></span></h2>

	<div class="inside">
		<table class="form-table" role="presentation">
			<tr> <th scope="row"><?php esc_html_e( 'Enable stock meter', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_inventory_display" class="toggle-switch"> <input name="commercekit[inventory_display]" type="checkbox" id="commercekit_inventory_display" value="1" <?php echo isset( $commercekit_options['inventory_display'] ) && 1 === (int) $commercekit_options['inventory_display'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Show stock meter on the single product page', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<?php /* translators: %s: stock counter. */ ?>
			<tr> <th scope="row"><?php esc_html_e( 'Low stock text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_inventory_text"> <input name="commercekit[inventory_text]" type="text" id="commercekit_inventory_text" value="<?php echo isset( $commercekit_options['inventory_text'] ) && ! empty( $commercekit_options['inventory_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['inventory_text'] ) ) : esc_html__( 'Only %s items left in stock!', 'commercegurus-commercekit' ); ?>" size="70" /></label><br /><small><em>
			<?php /* translators: %s: stock counter. */ ?>
			<?php esc_html_e( 'Add &ldquo;%s&rdquo; to replace the stock number, ', 'commercegurus-commercekit' ); ?>
			<?php /* translators: %s: stock counter. */ ?>
			<?php esc_html_e( 'e.g. Only %s items left in stock!', 'commercegurus-commercekit' ); ?>
			</em></small></td> </tr>
			<?php /* translators: %s: stock counter. */ ?>
			<tr> <th scope="row"><?php esc_html_e( 'Regular stock text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_inventory_text_31"> <input name="commercekit[inventory_text_31]" type="text" id="commercekit_inventory_text_31" value="<?php echo isset( $commercekit_options['inventory_text_31'] ) && ! empty( $commercekit_options['inventory_text_31'] ) ? esc_attr( stripslashes_deep( $commercekit_options['inventory_text_31'] ) ) : esc_html__( 'Less than %s items left!', 'commercegurus-commercekit' ); ?>" size="70" /></label><br /><small><em>
			<?php /* translators: %s: stock counter. */ ?>
			<?php esc_html_e( 'Add &ldquo;%s&rdquo; to replace the stock number, ', 'commercegurus-commercekit' ); ?>
			<?php /* translators: %s: stock counter. */ ?>
			<?php esc_html_e( 'e.g. Less than %s items left!', 'commercegurus-commercekit' ); ?></em></small></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'When stock > 100', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_inventory_text_100"> <input name="commercekit[inventory_text_100]" type="text" id="commercekit_inventory_text_100" value="<?php echo isset( $commercekit_options['inventory_text_100'] ) && ! empty( $commercekit_options['inventory_text_100'] ) ? esc_attr( stripslashes_deep( $commercekit_options['inventory_text_100'] ) ) : esc_html__( 'This item is selling fast!', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
		</table>
		<input type="hidden" name="tab" value="inventory-bar" />
		<input type="hidden" name="action" value="commercekit_save_settings" />
	</div>
</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Stock Meter', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'This feature allows you to show a stock meter counter on the single product page. It&lsquo;s a more visually effective way to alert customers when the stock level is low.', 'commercegurus-commercekit' ); ?></p>
</div>
