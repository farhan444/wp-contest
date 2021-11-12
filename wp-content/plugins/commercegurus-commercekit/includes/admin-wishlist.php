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
	<h2><span><?php esc_html_e( 'Wishlist', 'commercegurus-commercekit' ); ?></span></h2>
	<div class="inside">
			<div class="cg-notice-success"><p><?php esc_html_e( 'Note: You will need to create a wishlist page and include this shortcode on it - [commercegurus_wishlist]', 'commercegurus-commercekit' ); ?></p></div>
			<table class="form-table admin-wishlist" role="presentation">
				<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wishlist" class="toggle-switch"> <input name="commercekit[wishlist]" type="checkbox" id="commercekit_wishlist" value="1" <?php echo isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable wishlist functionality', 'commercegurus-commercekit' ); ?></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( '&ldquo;Add to wishlist&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wsl_adtext"> <input name="commercekit[wsl_adtext]" type="text" id="commercekit_wsl_adtext" value="<?php echo isset( $commercekit_options['wsl_adtext'] ) && ! empty( $commercekit_options['wsl_adtext'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wsl_adtext'] ) ) : esc_html__( 'Add to wishlist', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( '&ldquo;Product added&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wsl_pdtext"> <input name="commercekit[wsl_pdtext]" type="text" id="commercekit_wsl_pdtext" value="<?php echo isset( $commercekit_options['wsl_pdtext'] ) && ! empty( $commercekit_options['wsl_pdtext'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wsl_pdtext'] ) ) : esc_html__( 'Product added', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( '&ldquo;Browse wishlist&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wsl_brtext"> <input name="commercekit[wsl_brtext]" type="text" id="commercekit_wsl_brtext" value="<?php echo isset( $commercekit_options['wsl_brtext'] ) && ! empty( $commercekit_options['wsl_brtext'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wsl_brtext'] ) ) : esc_html__( 'Browse wishlist', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Wishlist page', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wsl_page">
				<?php $selected = isset( $commercekit_options['wsl_page'] ) ? esc_attr( $commercekit_options['wsl_page'] ) : 0; ?>
				<select name="commercekit[wsl_page]" id="commercekit_wsl_page" class="select2" data-type="pages" data-placeholder="Select wishlist page">
				<?php
				$pid = isset( $commercekit_options['wsl_page'] ) ? esc_attr( $commercekit_options['wsl_page'] ) : 0;
				if ( $pid ) {
					echo '<option value="' . esc_attr( $pid ) . '" selected="selected">#' . esc_attr( $pid ) . ' - ' . esc_html( get_the_title( $pid ) ) . '</option>';
				}
				?>
				</select>
				</label><br /><small><em><?php esc_html_e( 'Choose your wishlist page and set it to be full width. Ensure that it is excluded from any caching solutions.', 'commercegurus-commercekit' ); ?></em></small></td> </tr>
			</table>
			<input type="hidden" name="tab" value="wishlist" />
			<input type="hidden" name="action" value="commercekit_save_settings" />
		</div>
</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Wishlist', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'A wishlist allows shoppers to create personalized collections of products they want to buy and save them for future reference.', 'commercegurus-commercekit' ); ?></p>
</div>
