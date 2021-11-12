<?php
/**
 *
 * Admin Wishlist
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

?>
<div id="settings-content" class="postbox content-box">
	<h2><span><?php esc_html_e( 'Contact support', 'commercegurus-commercekit' ); ?></span></h2>
	<div class="inside">
		<?php if ( ! empty( $notice ) ) { ?>
		<div class="cg-notice-success"><p><?php echo esc_html( $notice ); ?></p></div>
		<?php } ?>
		<table class="form-table admin-support" role="presentation">
			<tr><td>
				<h4><?php esc_html_e( 'First name', 'commercegurus-commercekit' ); ?> <span class="star">*</span></h4>
				<p><?php esc_html_e( 'Enter your first name', 'commercegurus-commercekit' ); ?></p>
				<input type="text" class="input" name="first_name" id="first_name" value="" required />
			</td></tr>
			<tr><td>
				<h4><?php esc_html_e( 'Your email', 'commercegurus-commercekit' ); ?> <span class="star">*</span></h4>
				<p><?php esc_html_e( 'Replies will be sent to this address', 'commercegurus-commercekit' ); ?></p>
				<input type="email" class="input" name="email" id="email" value="" required />
			</td></tr>
			<tr><td>
				<h4><?php esc_html_e( 'URL', 'commercegurus-commercekit' ); ?> <span class="star">*</span></h4>
				<p><?php esc_html_e( 'A link where we can see the issue', 'commercegurus-commercekit' ); ?></p>
				<input type="url" class="input" name="url" id="url" value="" required />
			</td></tr>
			<tr><td>
				<h4><?php esc_html_e( 'Question title', 'commercegurus-commercekit' ); ?> <span class="star">*</span></h4>
				<p><?php esc_html_e( 'Summarize your question in a few words', 'commercegurus-commercekit' ); ?></p>
				<input type="text" class="input" name="title" id="title" value="" required />
			</td></tr>
			<tr><td>
				<h4><?php esc_html_e( 'Question', 'commercegurus-commercekit' ); ?> <span class="star">*</span></h4>
				<p><?php esc_html_e( 'Ensure that you have carefully looked through the ', 'commercegurus-commercekit' ); ?><a href="https://www.commercegurus.com/docs/shoptimizer-theme/" target="_blank"><?php esc_html_e( 'documentation area', 'commercegurus-commercekit' ); ?></a> <?php esc_html_e( 'first.', 'commercegurus-commercekit' ); ?></p>
				<textarea class="input" name="question" id="question" required ></textarea>
				<p><?php esc_html_e( 'If you are including screenshots, try using: ', 'commercegurus-commercekit' ); ?><a href="https://pasteboard.co/" target="_blank">https://pasteboard.co</a>. <?php esc_html_e( 'If you are including code, please use: ', 'commercegurus-commercekit' ); ?><a href="https://paste.ofcode.org/" target="_blank">https://paste.ofcode.org</a></p>
			</td></tr>
			<tr><td>
				<button type="submit" class="button button-primary"><?php esc_html_e( 'Submit ticket', 'commercegurus-commercekit' ); ?></button>
			</td></tr>
		</table>
		<input type="hidden" name="screen_width" id="screen_width" value="0" />
		<input type="hidden" name="screen_height" id="screen_height" value="0" />
		<input type="hidden" name="tab" value="support" />
		<input type="hidden" name="action" value="commercekit_save_settings" />
	</div>
</div>

<div class="postbox" id="settings-note">
	<?php
		global $wp_version, $woocommerce;
		$theme      = wp_get_theme();
		$template   = $theme->get_template();
		$theme_data = wp_get_theme( 'shoptimizer' );
	?>
	<h4><?php esc_html_e( 'Diagnostics', 'commercegurus-commercekit' ); ?></h4>
	<p><strong><?php esc_html_e( 'Shoptimizer version', 'commercegurus-commercekit' ); ?></strong><br /><?php echo isset( $theme_data['Version'] ) && false !== stripos( $theme_data['Name'], 'shoptimizer' ) ? esc_html( $theme_data['Version'] ) : esc_html__( 'Shoptimizer is not active', 'commercegurus-commercekit' ); ?></p>
	<p><strong><?php esc_html_e( 'WordPress version', 'commercegurus-commercekit' ); ?></strong><br /><?php echo esc_html( $wp_version ); ?></p>
	<p><strong><?php esc_html_e( 'WooCommerce version', 'commercegurus-commercekit' ); ?></strong><br /><?php echo isset( $woocommerce->version ) ? esc_html( $woocommerce->version ) : ''; ?></p>
	<p><strong><?php esc_html_e( 'Using a child theme?', 'commercegurus-commercekit' ); ?></strong><br /><?php echo isset( $template ) && false !== stripos( $template, '-child' ) ? esc_html__( 'Yes', 'commercegurus-commercekit' ) : esc_html__( 'No', 'commercegurus-commercekit' ) . '<br /><span class="child-message">' . esc_html__( 'If you make customizations it&rsquo;s a good idea to use a', 'commercegurus-commercekit' ) . ' <a href="https://www.commercegurus.com/docs/shoptimizer-theme/should-i-use-a-child-theme/" target="_blank">' . esc_html__( 'child theme', 'commercegurus-commercekit' ) . '</a>.</span>'; ?></p>
</div>
