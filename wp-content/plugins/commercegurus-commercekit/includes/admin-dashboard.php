<?php
/**
 *
 * Admin Wishlist
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

?>
<div id="settings-content">
<div class="dashboard postbox content-box">
	<h2><span class="table-heading"><?php esc_html_e( 'Order Bump Statistics', 'commercegurus-commercekit' ); ?></span></h2>
	<div class="inside">
	<?php
	$order_bump_stats_views  = (int) get_option( 'commercekit_obp_views' );
	$order_bump_stats_clicks = (int) get_option( 'commercekit_obp_clicks' );
	$order_bump_stats_sales  = (int) get_option( 'commercekit_obp_sales' );
	$order_bump_stats_price  = (float) get_option( 'commercekit_obp_sales_revenue' );
	$order_bump_stats_rate1  = 0 !== $order_bump_stats_views ? number_format( ( $order_bump_stats_clicks / $order_bump_stats_views ) * 100, 0 ) : 0;
	$order_bump_stats_rate2  = 0 !== $order_bump_stats_clicks ? number_format( ( $order_bump_stats_sales / $order_bump_stats_clicks ) * 100, 0 ) : 0;
	?>
		<ul class="order-bump-statistics">
			<li>
				<div class="title"><?php esc_html_e( 'Impressions', 'commercegurus-commercekit' ); ?></div>
				<div class="text-large"><?php echo esc_attr( number_format( $order_bump_stats_views, 0 ) ); ?></div>
			</li>
			<li>
				<div class="title"><?php esc_html_e( 'Revenue', 'commercegurus-commercekit' ); ?></div>
				<div class="text-large"><?php echo esc_attr( get_woocommerce_currency_symbol() ); ?><?php echo esc_attr( number_format( $order_bump_stats_price, 2 ) ); ?></div>
			</li>
			<li>
				<div class="title"><?php esc_html_e( 'Additional Sales', 'commercegurus-commercekit' ); ?></div>
				<div class="text-large"><?php echo esc_attr( number_format( $order_bump_stats_sales, 0 ) ); ?></div>
			</li>
			<li>
				<div class="title" data-clicks="<?php echo esc_attr( $order_bump_stats_clicks ); ?>"><?php esc_html_e( 'Click Rate', 'commercegurus-commercekit' ); ?></div>
				<div class="text-small"><?php echo esc_attr( $order_bump_stats_rate1 ); ?>%</div>
				<div class="progress-bar"><span style="width: <?php echo esc_attr( $order_bump_stats_rate1 ); ?>%;"></span></div>
			</li>
			<li>
				<div class="title"><?php esc_html_e( 'Conversion Rate', 'commercegurus-commercekit' ); ?></div>
				<div class="text-small"><?php echo esc_attr( $order_bump_stats_rate2 ); ?>%</div>
				<div class="progress-bar"><span style="width: <?php echo esc_attr( $order_bump_stats_rate2 ); ?>%;"></span></div>
			</li>
		</ul>
	</div>
</div>

<div class="dashboard postbox content-box">
	<h2><span class="table-heading"><?php esc_html_e( 'CommerceKit Features', 'commercegurus-commercekit' ); ?></span><span class="table-heading" style="float:right;"><?php esc_html_e( 'Page Impact', 'commercegurus-commercekit' ); ?></span></h2>
	<div class="inside">
		<table class="form-table admin-dashboard" role="presentation">
			<tr <?php echo isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_ajax_search" class="toggle-switch"> <input name="commercekit[ajax_search]" type="checkbox" id="commercekit_ajax_search" value="1" <?php echo isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=ajax-search"><?php esc_html_e( 'Ajax Search', 'commercegurus-commercekit' ); ?></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'Instant search results helps users save time and find products faster.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( '9Kb of HTML', 'commercegurus-commercekit' ); ?></strong><br /><?php esc_html_e( 'Loads on all pages', 'commercegurus-commercekit' ); ?></td> </tr>
			<tr <?php echo isset( $commercekit_options['countdown_timer'] ) && 1 === (int) $commercekit_options['countdown_timer'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_countdown_timer" class="toggle-switch"> <input name="commercekit[countdown_timer]" type="checkbox" id="commercekit_countdown_timer" value="1" <?php echo isset( $commercekit_options['countdown_timer'] ) && 1 === (int) $commercekit_options['countdown_timer'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=countdown-timer"><?php esc_html_e( 'Countdown Timers', 'commercegurus-commercekit' ); ?></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'Allows you to run time-limited promotions to create urgency and drive more clicks.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( '7Kb of HTML', 'commercegurus-commercekit' ); ?></strong><br /><?php esc_html_e( 'Loads on product and checkout pages', 'commercegurus-commercekit' ); ?></td> </tr>
			<tr <?php echo isset( $commercekit_options['order_bump'] ) && 1 === (int) $commercekit_options['order_bump'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_order_bump" class="toggle-switch"> <input name="commercekit[order_bump]" type="checkbox" id="commercekit_order_bump" value="1" <?php echo isset( $commercekit_options['order_bump'] ) && 1 === (int) $commercekit_options['order_bump'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=order-bump"><?php esc_html_e( 'Order Bump', 'commercegurus-commercekit' ); ?></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'Enables a customer to add an additional item to the cart, before they complete an order.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( '3Kb of HTML', 'commercegurus-commercekit' ); ?></strong><br /><?php esc_html_e( 'Loads only on the checkout', 'commercegurus-commercekit' ); ?></td> </tr>
			<tr <?php echo isset( $commercekit_options['pdp_gallery'] ) && 1 === (int) $commercekit_options['pdp_gallery'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_pdp_gallery" class="toggle-switch"> <input name="commercekit[pdp_gallery]" type="checkbox" id="commercekit_pdp_gallery" value="1" <?php echo isset( $commercekit_options['pdp_gallery'] ) && 1 === (int) $commercekit_options['pdp_gallery'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=pdp-gallery"><?php esc_html_e( 'Product Gallery', 'commercegurus-commercekit' ); ?> <span class="beta-module">BETA</span></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'An improved product gallery built for performance.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( 'Over 80% lighter than the core product gallery', 'commercegurus-commercekit' ); ?></strong><br /><a href="https://www.commercegurus.com/woocommerce-product-gallery-speed/"><?php esc_html_e( 'Read our post', 'commercegurus-commercekit' ); ?></a> <?php esc_html_e( 'to find out more', 'commercegurus-commercekit' ); ?></td> </tr>
			<tr <?php echo isset( $commercekit_options['inventory_display'] ) && 1 === (int) $commercekit_options['inventory_display'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_inventory_display" class="toggle-switch"> <input name="commercekit[inventory_display]" type="checkbox" id="commercekit_inventory_display" value="1" <?php echo isset( $commercekit_options['inventory_display'] ) && 1 === (int) $commercekit_options['inventory_display'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=inventory-bar"><?php esc_html_e( 'Stock Meter', 'commercegurus-commercekit' ); ?></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'A visually effective way to alert customers when the stock is low on product pages.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( '2Kb of HTML', 'commercegurus-commercekit' ); ?></strong><br /><?php esc_html_e( 'Loads only on product pages', 'commercegurus-commercekit' ); ?></td> </tr>
			<tr style="display: none;" <?php echo isset( $commercekit_options['pdp_triggers'] ) && 1 === (int) $commercekit_options['pdp_triggers'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_pdp_triggers" class="toggle-switch"> <input name="commercekit[pdp_triggers]" type="checkbox" id="commercekit_pdp_triggers" value="1" <?php echo isset( $commercekit_options['pdp_triggers'] ) && 1 === (int) $commercekit_options['pdp_triggers'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=inventory-bar"><?php esc_html_e( 'Product Details Page Triggers', 'commercegurus-commercekit' ); ?></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'Various conversion triggers on the single product page.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( '1Kb of HTML', 'commercegurus-commercekit' ); ?></strong><br /><?php esc_html_e( 'Loads only on product pages', 'commercegurus-commercekit' ); ?></td> </tr>
			<tr <?php echo isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_waitlist" class="toggle-switch"> <input name="commercekit[waitlist]" type="checkbox" id="commercekit_waitlist" value="1" <?php echo isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=waitlist"><?php esc_html_e( 'Waitlist', 'commercegurus-commercekit' ); ?></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'Collects emails of interested shoppers when products are sold-out.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( '3Kb of HTML', 'commercegurus-commercekit' ); ?></strong><br /><?php esc_html_e( 'Loads only on product pages', 'commercegurus-commercekit' ); ?></td> </tr>
			<tr <?php echo isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ? 'class="active"' : ''; ?>> <th scope="row"><label for="commercekit_wishlist" class="toggle-switch"> <input name="commercekit[wishlist]" type="checkbox" id="commercekit_wishlist" value="1" <?php echo isset( $commercekit_options['wishlist'] ) && 1 === (int) $commercekit_options['wishlist'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label></th> <td> <h4><a href="?page=commercekit&tab=wishlist"><?php esc_html_e( 'Wishlist', 'commercegurus-commercekit' ); ?></a><span class="inactive"><?php esc_html_e( 'Inactive', 'commercegurus-commercekit' ); ?></span></h4><p><?php esc_html_e( 'Shoppers can create personalized collections of products they want to buy.', 'commercegurus-commercekit' ); ?></p></td><td class="right" align="right"><strong><?php esc_html_e( '9Kb of HTML', 'commercegurus-commercekit' ); ?></strong><br /><?php esc_html_e( 'Loads on WooCommerce pages', 'commercegurus-commercekit' ); ?></strong></td> </tr>
		</table>
		<input type="hidden" name="tab" value="dashboard" />
		<input type="hidden" name="action" value="commercekit_save_settings" />
	</div>
</div>
</div>

<div class="postbox" id="settings-note">
	<?php if ( ! $domain_connected ) { ?>
	<a href="https://www.commercegurus.com/product/shoptimizer/" target="_blank" style="text-decoration: none;">
		<p><img src="<?php echo esc_url( CKIT_URI ); ?>assets/images/shoptimizer_logo.png" /></p>
		<p><?php esc_html_e( 'Optimize your WooCommerce store for speed and conversions with Shoptimizer. Shoptimizer is a FAST WooCommerce theme that comes with a ton of features all designed to help you convert more users to customers.', 'commercegurus-commercekit' ); ?></p>
	</a>
	<?php } else { ?>
	<h4><?php esc_html_e( 'Documentation', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'Visit the documentation area for a more detailed overview on each of these features. If you still have questions, you can send us a private ticket by clicking the Support tab above.', 'commercegurus-commercekit' ); ?></p>
	<p><strong><a href=" https://www.commercegurus.com/docs/shoptimizer-theme/commercekit-setup/" target="_blank"><?php esc_html_e( 'View Documentation', 'commercegurus-commercekit' ); ?></a></strong></p>
	<?php } ?>

	<h4><?php esc_html_e( 'Connection status', 'commercegurus-commercekit' ); ?></h4>
	<?php if ( $domain_connected ) { ?>
		<div><p><span class="dashicons dashicons-yes-alt" style="color: #46b450;"></span> <?php esc_html_e( 'Your website is connected! One click updates for Shoptimizer will appear in Appearance &rarr; Themes.', 'commercegurus-commercekit' ); ?></p></div>
	<?php } else { ?>
		<div><p><span class="dashicons dashicons-dismiss" style="color: red;"></span><?php esc_html_e( 'You have not enabled one-click updates for Shoptimizer and CommerceKit. To do so, please connect your website to your Shoptimizer', 'commercegurus-commercekit' ); ?> <a href="https://www.commercegurus.com/my-account/" target="_blank"><?php esc_html_e( 'subscription in your account', 'commercegurus-commercekit' ); ?></a>. <a href="https://www.commercegurus.com/docs/shoptimizer-theme/updating-shoptimizer/" target="_blank"><?php esc_html_e( 'View the update guide', 'commercegurus-commercekit' ); ?></a> <?php esc_html_e( 'to find out more.', 'commercegurus-commercekit' ); ?></p></div>
	<?php } ?>
</div>
