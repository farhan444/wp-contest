<?php
/**
 *
 * Admin Waitlist
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

global $wpdb;
$nonce      = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
$product_id = isset( $_REQUEST['product_id'] ) ? sanitize_text_field( (int) $_REQUEST['product_id'] ) : 0;
$mail_sent  = isset( $_REQUEST['mail_sent'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['mail_sent'] ) ) : 'all';

$wtl_filters = array();
$pg_url_ext  = '';
if ( $product_id ) {
	$wtl_filters[] = 'product_id = ' . $product_id;
	$pg_url_ext   .= '&product_id=' . $product_id;
}
if ( 'all' !== $mail_sent ) {
	if ( 'yes' === $mail_sent ) {
		$wtl_filters[] = 'mail_sent = 1';
	} else {
		$wtl_filters[] = 'mail_sent = 0';
	}
	$pg_url_ext .= '&mail_sent=' . $mail_sent;
}
$wtl_where = '';
if ( count( $wtl_filters ) ) {
	$wtl_where = ' WHERE ' . implode( ' AND ', $wtl_filters );
}

$pg_url = admin_url( 'admin.php' ) . '?page=commercekit&tab=waitlist';
$ttlsql = 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'commercekit_waitlist' . $wtl_where;
$total  = (int) $wpdb->get_var( $ttlsql ); // phpcs:ignore
$offset = 0;
$limit  = 10;
$wpage  = isset( $_REQUEST['paged'] ) ? sanitize_text_field( (int) $_REQUEST['paged'] ) : 1;

$wpage  = $wpage > 0 ? $wpage : 1;
$wpages = ceil( $total / $limit );
if ( $wpages && $wpage > $wpages ) {
	$wpage = $wpages;
}
$offset = ( $wpage - 1 ) * $limit;
$wtlsql = 'SELECT * FROM ' . $wpdb->prefix . 'commercekit_waitlist ' . $wtl_where . ' ORDER BY created DESC LIMIT ' . $offset . ', ' . $limit;
$rows   = $wpdb->get_results( $wtlsql, ARRAY_A ); // phpcs:ignore
$flink  = '';
$plink  = '';
$nlink  = '';
$llink  = '';
if ( $wpage > 1 ) {
	$flink = $pg_url . '&paged=1' . $pg_url_ext;
	$plink = $pg_url . '&paged=' . ( $wpage - 1 ) . $pg_url_ext;
}
if ( $wpages > 1 && $wpage < $wpages ) {
	$nlink = $pg_url . '&paged=' . ( $wpage + 1 ) . $pg_url_ext;
	$llink = $pg_url . '&paged=' . $wpages . $pg_url_ext;
}
?>
<ul class="subtabs">
	<li><a href="?page=commercekit&tab=waitlist" class="<?php echo ( 'list' === $section || '' === $section ) ? 'active' : ''; ?>"><?php esc_html_e( 'List', 'commercegurus-commercekit' ); ?></a> | </li>
	<li><a href="?page=commercekit&tab=waitlist&section=settings" class="<?php echo 'settings' === $section ? 'active' : ''; ?>"><?php esc_html_e( 'Settings', 'commercegurus-commercekit' ); ?></a> | </li>
	<li><a href="?page=commercekit&tab=waitlist&section=emails" class="<?php echo 'emails' === $section ? 'active' : ''; ?>"><?php esc_html_e( 'Emails', 'commercegurus-commercekit' ); ?></a></li>
</ul>
<div id="settings-content">
	<?php if ( 'list' === $section || '' === $section ) { ?>
	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<select name="bulk_action" id="bulk-action-selector-top" onchange="jQuery('#bulk-apply').val(0);">
				<option value=""><?php esc_html_e( 'Bulk Actions', 'commercegurus-commercekit' ); ?></option>
				<option value="delete"><?php esc_html_e( 'Delete', 'commercegurus-commercekit' ); ?></option>
				<option value="export"><?php esc_html_e( 'Export', 'commercegurus-commercekit' ); ?></option>
			</select>
			<input type="button" id="waitlist-doaction" class="button action" value="Apply" onclick="jQuery('#bulk-apply').val(1);jQuery('#commercekit-form').submit();jQuery('#bulk-apply').val(0);"><input type="hidden" id="bulk-apply" name="bulk_apply" value="0" /><input type="hidden" name="tab" value="waitlist" />&nbsp;
			<?php esc_html_e( 'Filter by Mail sent:', 'commercegurus-commercekit' ); ?>
			<select name="mail_sent" id="mail_sent" onchange="jQuery('#current-page-selector').val(1); jQuery('#commercekit-form').submit();" style="float: none; width: 70px;">
				<option value="all"><?php esc_html_e( 'All', 'commercegurus-commercekit' ); ?></option>
				<option value="yes" <?php echo 'yes' === $mail_sent ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Yes', 'commercegurus-commercekit' ); ?></option>
				<option value="no" <?php echo 'no' === $mail_sent ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'No', 'commercegurus-commercekit' ); ?></option>
			</select>&nbsp;
			<?php esc_html_e( 'by Product ID:', 'commercegurus-commercekit' ); ?>
			<input id="product_id" name="product_id" type="text" value="<?php echo 0 !== (int) $product_id ? esc_html( $product_id ) : ''; ?>" size="7" placeholder="Product ID" onchange="jQuery('#current-page-selector').val(1); jQuery('#commercekit-form').submit();" style="float: none;" />
		</div>
		<?php if ( $total ) { ?>
		<div class="tablenav-pages">
			<span class="displaying-num"><?php echo esc_html( $total ); ?> <?php esc_html_e( 'items', 'commercegurus-commercekit' ); ?></span>
			<span class="pagination-links">
			<?php if ( '' !== $flink || '' !== $plink ) { ?>
			<a class="first-page button" href="<?php echo esc_url( $flink ); ?>">
				<span aria-hidden="true">«</span>
			</a>
			<a class="first-page button" href="<?php echo esc_url( $plink ); ?>">
				<span aria-hidden="true">‹</span>
			</a>
			<?php } else { ?>
				<span class="tablenav-pages-navspan button disabled">«</span>
				<span class="tablenav-pages-navspan button disabled">‹</span>
			<?php } ?>
			</span>
			<span class="paging-input">
				<input class="current-page" id="current-page-selector" type="text" name="paged" value="<?php echo esc_html( $wpage ); ?>" size="2" />
				<span class="tablenav-paging-text"> <?php esc_html_e( 'of', 'commercegurus-commercekit' ); ?> <span class="total-pages"><?php echo esc_html( $wpages ); ?></span></span>
			</span>

			<?php if ( '' !== $nlink || '' !== $llink ) { ?>
			<a class="next-page button" href="<?php echo esc_url( $nlink ); ?>">
				<span aria-hidden="true">›</span>
			</a>
			<a class="last-page button" href="<?php echo esc_url( $llink ); ?>">
				<span aria-hidden="true">»</span>
			</a>
			<?php } else { ?>
			<span class="tablenav-pages-navspan button disabled">›</span>
			<span class="tablenav-pages-navspan button disabled">»</span>
			<?php } ?>
		</div>
		<?php } ?>
		<br class="clear">
	</div>
	<table class="wp-list-table widefat fixed striped">
		<thead>
			<tr>
				<td id="cb" class="manage-column column-cb check-column"><input id="cb-select-all" type="checkbox"></td>
				<th scope="col" id="email" width="40%"><?php esc_html_e( 'Email', 'commercegurus-commercekit' ); ?></th>
				<th scope="col" id="product" width="30%"><?php esc_html_e( 'Product', 'commercegurus-commercekit' ); ?></th>
				<th scope="col" id="created"><?php esc_html_e( 'Date added', 'commercegurus-commercekit' ); ?></th>
				<th scope="col" id="mail_sent"><?php esc_html_e( 'Mail sent', 'commercegurus-commercekit' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ( is_array( $rows ) && count( $rows ) ) {
				foreach ( $rows as $row ) {
					?>
			<tr>
				<th id="cb" class="manage-column column-cb check-column"><input id="cb-select-all-<?php echo esc_html( $row['id'] ); ?>" name="wtl_ids[]" value="<?php echo esc_html( $row['id'] ); ?>" type="checkbox"></th>
				<td scope="col" id="email"><?php echo esc_html( $row['email'] ); ?></td>
				<td scope="col" id="product"><?php commercekit_module_output( get_the_title( $row['product_id'] ) ); ?> (<?php esc_html_e( 'ID', 'commercegurus-commercekit' ); ?>: <?php echo esc_html( $row['product_id'] ); ?>)</td>
				<td scope="col" id="created"><?php echo esc_html( gmdate( 'j F Y', $row['created'] ) ); ?></td>
				<td scope="col" id="mail_sent"><?php echo isset( $row['mail_sent'] ) && 1 === (int) $row['mail_sent'] ? esc_html__( 'Yes', 'commercegurus-commercekit' ) : esc_html__( 'No', 'commercegurus-commercekit' ); ?></td>
			</tr>
					<?php
				}
			} else {
				?>
			<tr>
				<td scope="col" colspan="4" align="center"><?php esc_html_e( 'No Items', 'commercegurus-commercekit' ); ?></td>
			</tr>
				<?php
			}
			?>
		</tbody>
	</table><br /><br />

	<?php } ?>

	<?php if ( 'settings' === $section ) { ?>
	<div class="postbox content-box">
		<h2><span><?php esc_html_e( 'Waitlist', 'commercegurus-commercekit' ); ?></span></h2>
		<div class="inside">
			<table class="form-table" role="presentation">
				<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_waitlist" class="toggle-switch"> <input name="commercekit[waitlist]" type="checkbox" id="commercekit_waitlist" value="1" <?php echo isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable waitlist for out of stock products', 'commercegurus-commercekit' ); ?></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Introduction', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_intro"> <input name="commercekit[wtl_intro]" type="text" id="commercekit_wtl_intro" value="<?php echo isset( $commercekit_options['wtl_intro'] ) && ! empty( $commercekit_options['wtl_intro'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_intro'] ) ) : esc_html__( 'Notify me when the item is back in stock.', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email placeholder', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_email_text"> <input name="commercekit[wtl_email_text]" type="text" id="commercekit_wtl_email_text" value="<?php echo isset( $commercekit_options['wtl_email_text'] ) && ! empty( $commercekit_options['wtl_email_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_email_text'] ) ) : esc_html__( 'Enter your email address...', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Button label', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_button_text"> <input name="commercekit[wtl_button_text]" type="text" id="commercekit_wtl_button_text" value="<?php echo isset( $commercekit_options['wtl_button_text'] ) && ! empty( $commercekit_options['wtl_button_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_button_text'] ) ) : esc_html__( 'Join waiting list', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Consent label', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_consent_text"> <input name="commercekit[wtl_consent_text]" type="text" id="commercekit_wtl_consent_text" value="<?php echo isset( $commercekit_options['wtl_consent_text'] ) && ! empty( $commercekit_options['wtl_consent_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_consent_text'] ) ) : esc_html__( 'I consent to being contacted by the store owner', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Success message', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_success_text"> <input name="commercekit[wtl_success_text]" type="text" id="commercekit_wtl_success_text" value="<?php echo isset( $commercekit_options['wtl_success_text'] ) && ! empty( $commercekit_options['wtl_success_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_success_text'] ) ) : esc_html__( 'You have been added to the waiting list for this product!', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Read more label', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_readmore_text"> <input name="commercekit[wtl_readmore_text]" type="text" id="commercekit_wtl_readmore_text" value="<?php echo isset( $commercekit_options['wtl_readmore_text'] ) && ! empty( $commercekit_options['wtl_readmore_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_readmore_text'] ) ) : esc_html__( 'Get notified', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			</table>
			<input type="hidden" name="tab" value="waitlist" />
			<input type="hidden" name="action" value="commercekit_save_settings" />
			<input type="hidden" name="section" value="settings" />
		</div>
	</div>
	<?php } ?>

	<?php if ( 'emails' === $section ) { ?>
		<?php
		$placeholders = __( 'Available placeholders: {site_name}, {site_url}, {product_title}, {product_sku}, {product_link}', 'commercegurus-commercekit' );
		if ( ! isset( $commercekit_options['waitlist_auto_mail'] ) ) {
			$commercekit_options['waitlist_auto_mail'] = 1;
		}
		if ( ! isset( $commercekit_options['waitlist_admin_mail'] ) ) {
			$commercekit_options['waitlist_admin_mail'] = 1;
		}
		if ( ! isset( $commercekit_options['waitlist_user_mail'] ) ) {
			$commercekit_options['waitlist_user_mail'] = 1;
		}
		?>
	<div class="postbox content-box">
		<h2><span><?php esc_html_e( 'Emails', 'commercegurus-commercekit' ); ?></span></h2>
		<div class="inside">
			<table class="form-table" role="presentation">
				<tr> <th scope="row"><?php esc_html_e( 'From Email', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php esc_html_e( 'Please add a valid from email that ends with your domain to prevent spam mails.', 'commercegurus-commercekit' ); ?>"></span></span></th> <td> <label for="commercekit_wtl_from_email"> <input name="commercekit[wtl_from_email]" type="text" id="commercekit_from_email" value="<?php echo isset( $commercekit_options['wtl_from_email'] ) && ! empty( $commercekit_options['wtl_from_email'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_from_email'] ) ) : esc_attr( get_option( 'admin_email' ) ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row" style="vertical-align:top;"><?php esc_html_e( 'From Name', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php esc_html_e( 'Please add a valid from name to prevent spam mails.', 'commercegurus-commercekit' ); ?>"></span></span></th> <td> <label for="commercekit_wtl_from_name"> <input name="commercekit[wtl_from_name]" type="text" id="commercekit_from_name" value="<?php echo isset( $commercekit_options['wtl_from_name'] ) && ! empty( $commercekit_options['wtl_from_name'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_from_name'] ) ) : esc_attr( get_option( 'blogname' ) ); ?>" size="70" /></label><p><br /><?php esc_html_e( 'To improve the deliverability of these mails', 'commercegurus-commercekit' ); ?> <?php esc_html_e( 'we recommend you install the', 'commercegurus-commercekit' ); ?> <a href="https://wordpress.org/plugins/wp-mail-smtp/" target="_blank" style="white-space:nowrap;"><?php esc_html_e( 'WP Mail SMTP', 'commercegurus-commercekit' ); ?></a> <?php esc_html_e( 'plugin.', 'commercegurus-commercekit' ); ?></p></td> </tr>

				<tr> <td colspan="2"><hr /></td> </tr>

				<tr> <th scope="row" style="vertical-align:top;"><?php esc_html_e( 'Notification recipient', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php esc_html_e( 'Please add a valid recipient email for admin notification.', 'commercegurus-commercekit' ); ?>"></span></span></th> <td> <label for="commercekit_wtl_recipient"> <input name="commercekit[wtl_recipient]" type="text" id="commercekit_wtl_recipient" value="<?php echo isset( $commercekit_options['wtl_recipient'] ) && ! empty( $commercekit_options['wtl_recipient'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_recipient'] ) ) : esc_attr( get_option( 'admin_email' ) ); ?>" size="70" /></label><p><br /><?php esc_html_e( 'Enter recipient that will receive admin notification. Site Administration Email is default value.', 'commercegurus-commercekit' ); ?></p></td> </tr>

				<tr> <td colspan="2"><hr /></td> </tr>

				<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_waitlist_auto_mail" class="toggle-switch"> <input name="commercekit[waitlist_auto_mail]" type="checkbox" id="commercekit_waitlist_auto_mail" value="1" <?php echo isset( $commercekit_options['waitlist_auto_mail'] ) && 1 === (int) $commercekit_options['waitlist_auto_mail'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable automatic emails when the item is back in stock', 'commercegurus-commercekit' ); ?></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email Subject', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php echo esc_html( $placeholders ); ?>"></span></span></th> <td> <label for="commercekit_wtl_auto_subject"> <input name="commercekit[wtl_auto_subject]" type="text" id="commercekit_wtl_auto_subject" value="<?php echo isset( $commercekit_options['wtl_auto_subject'] ) && ! empty( $commercekit_options['wtl_auto_subject'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_auto_subject'] ) ) : esc_html__( 'A product you are waiting for is back in stock!', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email Content', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php echo esc_html( $placeholders ); ?>"></span></span></th> <td>
		<?php
		$wtl_auto_content = isset( $commercekit_options['wtl_auto_content'] ) && ! empty( $commercekit_options['wtl_auto_content'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_auto_content'] ) ) : esc_html__( 'Hi, {product_title} is now back in stock on {site_name}. You have been sent this email because your email address was registered in a waiting list for this product. If you would like to purchase {product_title}, please visit the following link: {product_link}', 'commercegurus-commercekit' );
		wp_editor(
			html_entity_decode( $wtl_auto_content ),
			'commercekit_wtl_auto_content',
			array(
				'wpautop'       => true,
				'media_buttons' => false,
				'textarea_name' => 'commercekit[wtl_auto_content]',
				'textarea_rows' => 10,
				'teeny'         => true,
			)
		);
		?>
	</td> </tr>

				<tr> <td colspan="2"><hr /></td> </tr>

				<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_waitlist_admin_mail" class="toggle-switch"> <input name="commercekit[waitlist_admin_mail]" type="checkbox" id="commercekit_waitlist_admin_mail" value="1" <?php echo isset( $commercekit_options['waitlist_admin_mail'] ) && 1 === (int) $commercekit_options['waitlist_admin_mail'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable mails to the store owner when a customer signs up to the waitlist', 'commercegurus-commercekit' ); ?></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email Subject', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php echo esc_html( $placeholders ); ?>"></span></span></th> <td> <label for="commercekit_wtl_admin_subject"> <input name="commercekit[wtl_admin_subject]" type="text" id="commercekit_wtl_admin_subject" value="<?php echo isset( $commercekit_options['wtl_admin_subject'] ) && ! empty( $commercekit_options['wtl_admin_subject'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_admin_subject'] ) ) : esc_html__( 'You have a new waiting list request', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email Content', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php echo esc_html( $placeholders ); ?>"></span></span></th> <td>
		<?php
		$wtl_admin_content = isset( $commercekit_options['wtl_admin_content'] ) && ! empty( $commercekit_options['wtl_admin_content'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_admin_content'] ) ) : esc_html__( 'Hi, You got a waiting list request from {site_name} for the following: Product Name: {product_title}, SKU: {product_sku}, Product link: {product_link}', 'commercegurus-commercekit' );
		wp_editor(
			html_entity_decode( $wtl_admin_content ),
			'commercekit_wtl_admin_content',
			array(
				'wpautop'       => true,
				'media_buttons' => false,
				'textarea_name' => 'commercekit[wtl_admin_content]',
				'textarea_rows' => 10,
				'teeny'         => true,
			)
		);
		?>
	</td> </tr>

				<tr> <td colspan="2"><hr /></td> </tr>

				<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_waitlist_user_mail" class="toggle-switch"> <input name="commercekit[waitlist_user_mail]" type="checkbox" id="commercekit_waitlist_user_mail" value="1" <?php echo isset( $commercekit_options['waitlist_user_mail'] ) && 1 === (int) $commercekit_options['waitlist_user_mail'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable mail to the customer when they sign up to a waitlist', 'commercegurus-commercekit' ); ?></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email Subject', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php echo esc_html( $placeholders ); ?>"></span></span></th> <td> <label for="commercekit_wtl_user_subject"> <input name="commercekit[wtl_user_subject]" type="text" id="commercekit_wtl_user_subject" value="<?php echo isset( $commercekit_options['wtl_user_subject'] ) && ! empty( $commercekit_options['wtl_user_subject'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_user_subject'] ) ) : esc_html__( 'We have received your waiting list request', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email Content', 'commercegurus-commercekit' ); ?>: <span class="dashicons dashicons-info"><span class="tooltip" data-text="<?php echo esc_html( $placeholders ); ?>"></span></span></th> <td>
		<?php
		$wtl_user_content = isset( $commercekit_options['wtl_user_content'] ) && ! empty( $commercekit_options['wtl_user_content'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_user_content'] ) ) : esc_html__( 'Hi, We have received your waiting list request from {site_name} for the following: Product Name: {product_title}, SKU: {product_sku}, Product link: {product_link}', 'commercegurus-commercekit' );
		wp_editor(
			html_entity_decode( $wtl_user_content ),
			'commercekit_wtl_user_content',
			array(
				'wpautop'       => true,
				'media_buttons' => false,
				'textarea_name' => 'commercekit[wtl_user_content]',
				'textarea_rows' => 10,
				'teeny'         => true,
			)
		);
		?>
	</td> </tr>

			</table>
			<input type="hidden" name="tab" value="waitlist" />
			<input type="hidden" name="action" value="commercekit_save_settings" />
		</div>
	</div>
	<?php } ?>

</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Waitlist', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'Product waitlists are used to notify interested shoppers when sold-out products are back in stock. This module collects data on customers who sign up.', 'commercegurus-commercekit' ); ?></p>
</div>
