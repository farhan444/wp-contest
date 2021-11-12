<?php
/**
 *
 * Admin PDP Triggers
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

?>
<div id="settings-content" class="postbox content-box">
	<h2><span><?php esc_html_e( 'Product Details Page Sales Triggers', 'commercegurus-commercekit' ); ?></span></h2>

	<div class="inside">
		<table class="form-table" role="presentation">
			<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_pdp_triggers" class="toggle-switch"> <input name="commercekit[pdp_triggers]" type="checkbox" id="commercekit_pdp_triggers" value="1" <?php echo isset( $commercekit_options['pdp_triggers'] ) && 1 === (int) $commercekit_options['pdp_triggers'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Product Details Page Sales Triggers', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'Minimum number of reviews', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_pdp_min_reviews"> <input name="commercekit[pdp_min_reviews]" type="number" min="1" max="99" id="commercekit_inventory_text" value="<?php echo isset( $commercekit_options['pdp_min_reviews'] ) && ! empty( $commercekit_options['pdp_min_reviews'] ) ? esc_attr( (int) $commercekit_options['pdp_min_reviews'] ) : 5; ?>" size="70" /></label><br /><small><em><?php esc_html_e( 'Minimum number of reviews required before it is displayed. The average rating needs to be 70% or greater.', 'commercegurus-commercekit' ); ?></em></small></td> </tr>
			<?php /* translators: %s: review percentage. */ ?>
			<tr> <th scope="row"><?php esc_html_e( 'Trigger text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_pdp_review_text"> <input name="commercekit[pdp_review_text]" type="text" id="commercekit_pdp_review_text" value="<?php echo isset( $commercekit_options['pdp_review_text'] ) && ! empty( $commercekit_options['pdp_review_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['pdp_review_text'] ) ) : esc_html__( 'Good choice! %s of buyers were satisfied with this.', 'commercegurus-commercekit' ); ?>" size="70" /></label><br /><small><em>
			<?php /* translators: %s: review percentage. */ ?>
			<?php esc_html_e( 'Add &ldquo;%s&rdquo; to replace the percentage, ', 'commercegurus-commercekit' ); ?>
			<?php /* translators: %s: review percentage. */ ?>
			<?php esc_html_e( 'e.g. Good choice! %s of buyers were satisfied with this.', 'commercegurus-commercekit' ); ?>
			</em></small></td> </tr></tr>
		</table>
		<input type="hidden" name="tab" value="pdp-triggers" />
		<input type="hidden" name="action" value="commercekit_save_settings" />
	</div>
</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'PDP Sales Triggers', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'This feature allows you to show conversion triggers on the single product page. It displays a percentage satisfaction rating based on the number of reviews and the average rating.', 'commercegurus-commercekit' ); ?></p>
</div>
