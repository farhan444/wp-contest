<?php
/**
 * Getting started template
 *
 * @package CommerceGurus
 * @subpackage Shoptimizer
 */

$customizer_url = admin_url() . 'customize.php';
?>

<div id="usefulplugins" class="ccfw-tab-pane">

	<div class="ccfw-tab-pane-center">

		<h1 class="ccfw-welcome-title"><?php esc_html_e( 'Useful Plugins', 'shoptimizer' ); ?></h1>
		<h2><?php esc_html_e( 'Enhance your store with these useful optional plugin suggestions for Shoptimizer. Just search the "Plugins" section of WordPress for the name, then install and activate. You will need to consult the plugin documentation of each for setup instructions.', 'shoptimizer' ); ?></h2>
		<br/>
		<table class="useful-table">

			<tbody>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Autoptimize', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Optimizes your website, concatenating the CSS and JavaScript code, and compressing it.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/autoptimize/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Jetpack', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'The popular plugin from Automattic has some useful features worth enabling, including lazy load and  photon for quicker page loading times. We are also using the related posts module on our demo site.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/jetpack/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Loco Translate', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Loco Translate provides in-browser editing of WordPress translation files. It is the easiest way to change your store language to something else.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/loco-translate/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'MailChimp for WordPress', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Allows visitors to subscribe to your newsletters easily. Requires a free MailChimp account.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/mailchimp-for-wp/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Optin Forms', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Create optin forms without the need to know any HTML or CSS. Works with a number of different email solutions including MailChimp and ConvertKit.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/optin-forms/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Real-Time Find and Replace', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'This plugin allows you to dynamically replace text with alternative copy of your choosing before a page is delivered to a user’s browser.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/real-time-find-and-replace/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Smart WooCommerce Search', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Provides instant search results for your WooCommerce website when a user types some characters.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/smart-woocommerce-search/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Woo Advanced Product Size Chart', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Add product size charts with default template or custom size chart to any of your WooCommerce products.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/woo-advanced-product-size-chart/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'WooCommerce Product Tabs', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Helps you add your own custom tabs to the product page in WooCommerce.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce-product-tabs/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Variation Swatches for WooCommerce', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'A much nicer way to display variations of variable products. This plugin will help you select a style for each attribute as a color, image or label.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/variation-swatches-for-woocommerce/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'Weglot', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'The best and easiest translation solution to translate your Shoptimizer store and go multilingual. You can be setup in minutes. Need more languages?', 'shoptimizer' ); ?> <a target="_blank" href="<?php echo esc_url( 'https://commercegurus.com/go/weglot' ); ?>"><?php esc_html_e( 'See the premium version', 'shoptimizer' ); ?></a></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/weglot/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td>
						<h3><?php esc_html_e( 'WPForms', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'WPForms allows you to create contact forms, and any other kind of form on your site in minutes.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/wpforms-lite/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>

				</tbody>

				</table>

	</div>

	<div class="ccfw-clear"></div>

</div>
