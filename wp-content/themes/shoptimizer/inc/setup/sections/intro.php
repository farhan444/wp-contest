<?php
/**
 * Getting started template
 *
 * @package CommerceGurus
 * @subpackage Shoptimizer
 */

$customizer_url = admin_url() . 'customize.php';
?>

<div id="intro" class="ccfw-tab-pane active">

	<div class="primary-left">

	<div class="ccfw-tab-pane-center">

		<h1 class="ccfw-welcome-title"><?php esc_html_e( 'Welcome to Shoptimizer!', 'shoptimizer' ); ?></h1>

		<h2>We built Shoptimizer using best practices. We wanted a theme that was fast &mdash; really fast. We did a lot of research on eCommerce best practices and incorporated some advanced functionality not seen in any other theme with the primary goal of <strong>better conversions</strong>.</h2>

		<hr />

		<h2 class="larger"><?php esc_html_e( 'Shoptimizer Theme Documentation', 'shoptimizer' ); ?></h2>
		<p><?php esc_html_e( 'We provide lots of theme documentation articles including a detailed installation and setup guide on our website. We have over 30 detailed articles which explain the most common queries with screenshots.', 'shoptimizer' ); ?></p>
		<p><a target="_blank" href="<?php echo esc_url( 'https://www.commercegurus.com/docs/shoptimizer-theme/' ); ?>" class="button button-primary"><?php esc_html_e( 'View Shoptimizer Documentation', 'shoptimizer' ); ?></a></p>

		<hr />

		<h2 class="larger"><?php esc_html_e( 'Theme Options', 'shoptimizer' ); ?></h2>
		<p><?php esc_html_e( 'The Shoptimizer Theme Customizer enables you to customize many elements of the theme directly without any coding skills. This includes options such as uploading your logo, changing the primary color, and much more.', 'shoptimizer' ); ?></p>
		<ul>
		<li><?php esc_html_e( 'To access the Customizer, go to', 'shoptimizer' ); ?> <strong><?php esc_html_e( 'Appearance → Customize', 'shoptimizer' ); ?></strong> <?php esc_html_e( 'in the WordPress admin menu.', 'shoptimizer' ); ?></li>
		<li><?php esc_html_e( 'When you are finished making changes, click', 'shoptimizer' ); ?> <strong><?php esc_html_e( 'Save & Publish', 'shoptimizer' ); ?></strong> <?php esc_html_e( 'to save the settings. Check out your site to confirm your changes.', 'shoptimizer' ); ?></li>
		<li><?php esc_html_e( 'You will need to have the', 'shoptimizer' ); ?> <strong><?php esc_html_e( 'Kirki', 'shoptimizer' ); ?></strong> <?php esc_html_e( 'plugin active to see the full list of theme options. You can see if it is enabled via Appearance → Install Plugins.', 'shoptimizer' ); ?></li>
		</ul>

		<p><a target="_blank" href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Launch the Customizer', 'shoptimizer' ); ?></a></p>


	</div>

	</div><!--/primary-left -->

	<div class="primary-right">

	<div class="theme-club-intro">
	<img src="<?php echo get_template_directory_uri() . '/inc/setup/images/screenshot.jpg'; ?>" alt="Screenshot" />
		<div class="theme-club-copy">
			<h2><?php esc_html_e( 'Shoptimizer WooCommerce Theme', 'shoptimizer' ); ?></h2>
			<p><?php esc_html_e( 'More information about Shoptimizer including FAQs, guides and tutorials on optimizing your WooCommerce store.', 'shoptimizer' ); ?></p>

		<a target="_blank" class="button-primary" href="<?php echo esc_url( 'https://www.commercegurus.com/product/shoptimizer/' ); ?>"><?php esc_html_e( 'Shoptimizer Information', 'shoptimizer' ); ?></a>
		</div>
	</div>

	<div class="ccfw-review">
		<h2><?php esc_html_e( 'Support', 'shoptimizer' ); ?></h2>
		<p><?php esc_html_e( 'Have any questions or need help? Get in touch with our support desk for assistance. You will need to include your order number, a link to your site and a screenshot of the issue.', 'shoptimizer' ); ?></p>

		<a target="_blank" class="button-primary" href="https://commercegurus.freshdesk.com/helpdesk/tickets/new/"><?php esc_html_e( 'Submit a Ticket', 'shoptimizer' ); ?></a>
		<i class="dashicons dashicons-groups"></i>
	</div>

	</div><!--/primary-right -->

	<div class="ccfw-clear"></div>

</div>
