<?php
/**
 *
 * Admin Ajax Search
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

?>
<?php
global $wpdb;
if ( isset( $section ) && ! in_array( $section, array( 'settings', 'reports' ), true ) ) {
	$section = 'settings';
} elseif ( ! isset( $section ) ) {
	$section = 'settings';
}
if ( 'reports' === $section ) {
	$reports = get_transient( 'commercekit_search_reports' );
	if ( ! $reports ) {
		$table        = $wpdb->prefix . 'commercekit_searches';
		$sql1         = 'SELECT SUM(search_count) FROM ' . $table;
		$search_count = (int) $wpdb->get_var( $sql1 ); // phpcs:ignore
		$sql2         = 'SELECT SUM(click_count) FROM ' . $table;
		$click_count  = (int) $wpdb->get_var( $sql2 ); // phpcs:ignore
		$sql3         = 'SELECT SUM(no_result_count) FROM ' . $table;
		$no_res_count = (int) $wpdb->get_var( $sql3 ); // phpcs:ignore
		$sql4         = 'SELECT search_term, search_count FROM ' . $table . ' ORDER BY search_count DESC LIMIT 0, 20';
		$most_results = $wpdb->get_results( $sql4, ARRAY_A ); // phpcs:ignore
		$sql5         = 'SELECT search_term, no_result_count FROM ' . $table . ' WHERE no_result_count > 0 ORDER BY no_result_count DESC LIMIT 0, 20';
		$no_results   = $wpdb->get_results( $sql5, ARRAY_A ); // phpcs:ignore

		$reports                  = array();
		$reports['search_count']  = number_format( $search_count, 0 );
		$reports['click_percent'] = $search_count > 0 ? number_format( ( $click_count / $search_count ) * 100, 1 ) : 0;
		$reports['nores_percent'] = $search_count > 0 ? number_format( ( $no_res_count / $search_count ) * 100, 1 ) : 0;
		$reports['most_results']  = $most_results;
		$reports['no_results']    = $no_results;

		set_transient( 'commercekit_search_reports', $reports, DAY_IN_SECONDS );
	}
}
?>
<ul class="subtabs">
	<li><a href="?page=commercekit&tab=ajax-search" class="<?php echo ( 'settings' === $section || '' === $section ) ? 'active' : ''; ?>"><?php esc_html_e( 'Settings', 'commercegurus-commercekit' ); ?></a> | </li>
	<li><a href="?page=commercekit&tab=ajax-search&section=reports" class="<?php echo 'reports' === $section ? 'active' : ''; ?>"><?php esc_html_e( 'Reports', 'commercegurus-commercekit' ); ?></a> </li>
</ul>
<div id="settings-content" class="postbox content-box">
	<h2><span><?php esc_html_e( 'Ajax Search', 'commercegurus-commercekit' ); ?></span></h2>
	<?php if ( 'settings' === $section || '' === $section ) { ?>
	<div class="inside">
		<table class="form-table" role="presentation">
			<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajax_search" class="toggle-switch"> <input name="commercekit[ajax_search]" type="checkbox" id="commercekit_ajax_search" value="1" <?php echo isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable ajax search in the main search bar', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'Placeholder', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_placeholder"> <input name="commercekit[ajs_placeholder]" type="text" id="commercekit_ajs_placeholder" value="<?php echo isset( $commercekit_options['ajs_placeholder'] ) && ! empty( $commercekit_options['ajs_placeholder'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_placeholder'] ) ) : esc_html__( 'Search products...', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'Display', 'commercegurus-commercekit' ); ?></th> <td> <label><input type="radio" value="all" name="commercekit[ajs_display]" <?php echo ( isset( $commercekit_options['ajs_display'] ) && 'all' === $commercekit_options['ajs_display'] ) || ! isset( $commercekit_options['ajs_display'] ) ? 'checked="checked"' : ''; ?> onchange="if(jQuery(this).prop('checked')){jQuery('#ajs_tabbed_wrap').show();jQuery('#ajs_tabbed_wrap2').show();}else{jQuery('#ajs_tabbed_wrap').hide();jQuery('#ajs_tabbed_wrap2').hide();}"/>&nbsp;<?php esc_html_e( 'All contents', 'commercegurus-commercekit' ); ?></label> <span class="radio-space">&nbsp;</span><label><input type="radio" value="products" name="commercekit[ajs_display]" <?php echo isset( $commercekit_options['ajs_display'] ) && 'products' === $commercekit_options['ajs_display'] ? 'checked="checked"' : ''; ?> onchange="if(jQuery(this).prop('checked')){jQuery('#ajs_tabbed_wrap').hide();jQuery('#ajs_tabbed_wrap2').hide();}else{jQuery('#ajs_tabbed_wrap').show();jQuery('#ajs_tabbed_wrap2').show();}"/>&nbsp;<?php esc_html_e( 'Just products', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<tr id="ajs_tabbed_wrap" <?php echo isset( $commercekit_options['ajs_display'] ) && 'products' === $commercekit_options['ajs_display'] ? 'style="display:none;"' : ''; ?>> <th scope="row"><?php esc_html_e( 'Tabbed search results', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_tabbed" class="toggle-switch"> <input name="commercekit[ajs_tabbed]" type="checkbox" id="commercekit_ajs_tabbed" value="1" <?php echo isset( $commercekit_options['ajs_tabbed'] ) && 1 === (int) $commercekit_options['ajs_tabbed'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable search results tabs', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<tr id="ajs_tabbed_wrap2" <?php echo isset( $commercekit_options['ajs_display'] ) && 'products' === $commercekit_options['ajs_display'] ? 'style="display:none;"' : ''; ?>> <th scope="row"><?php esc_html_e( 'Preserve selected tab', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_pre_tab" class="toggle-switch"> <input name="commercekit[ajs_pre_tab]" type="checkbox" id="commercekit_ajs_pre_tab" value="1" <?php echo isset( $commercekit_options['ajs_pre_tab'] ) && 1 === (int) $commercekit_options['ajs_pre_tab'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable preserve selected tab on next visit', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( '&ldquo;Other results&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_other_text"> <input name="commercekit[ajs_other_text]" type="text" id="commercekit_ajs_other_text" value="<?php echo isset( $commercekit_options['ajs_other_text'] ) && ! empty( $commercekit_options['ajs_other_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_other_text'] ) ) : esc_html__( 'Other results', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( '&ldquo;No results&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_no_text"> <input name="commercekit[ajs_no_text]" type="text" id="commercekit_ajs_no_text" value="<?php echo isset( $commercekit_options['ajs_no_text'] ) && ! empty( $commercekit_options['ajs_no_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_no_text'] ) ) : esc_html__( 'No results', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( '&ldquo;View all&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_all_text"> <input name="commercekit[ajs_all_text]" type="text" id="commercekit_ajs_all_text" value="<?php echo isset( $commercekit_options['ajs_all_text'] ) && ! empty( $commercekit_options['ajs_all_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_all_text'] ) ) : esc_html__( 'View all results', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'Out of stock products', 'commercegurus-commercekit' ); ?></th> <td> <label><input type="radio" value="0" name="commercekit[ajs_outofstock]" <?php echo ( isset( $commercekit_options['ajs_outofstock'] ) && 0 === (int) $commercekit_options['ajs_outofstock'] ) || ! isset( $commercekit_options['ajs_outofstock'] ) ? 'checked="checked"' : ''; ?>/>&nbsp;<?php esc_html_e( 'Include', 'commercegurus-commercekit' ); ?></label> <span class="radio-space">&nbsp;</span><label><input type="radio" value="1" name="commercekit[ajs_outofstock]" <?php echo isset( $commercekit_options['ajs_outofstock'] ) && 1 === (int) $commercekit_options['ajs_outofstock'] ? 'checked="checked"' : ''; ?>/>&nbsp;<?php esc_html_e( 'Exclude', 'commercegurus-commercekit' ); ?></label></td></tr> 
			<tr> <th scope="row"><?php esc_html_e( 'Exclude', 'commercegurus-commercekit' ); ?></th>  <td> <label for="commercekit_ajs_excludes"> <input name="commercekit[ajs_excludes]" type="text" id="commercekit_ajs_excludes" value="<?php echo isset( $commercekit_options['ajs_excludes'] ) && ! empty( $commercekit_options['ajs_excludes'] ) ? esc_attr( $commercekit_options['ajs_excludes'] ) : ''; ?>" size="70" /></label><br /><small><em><?php esc_html_e( 'Enter Product/Page/Post ID&rsquo;s to be excluded, separated by a comma.', 'commercegurus-commercekit' ); ?></em></small></td></tr>  
			<tr> <th scope="row"><?php esc_html_e( 'Hide variations', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_hidevar" class="toggle-switch"> <input name="commercekit[ajs_hidevar]" type="checkbox" id="commercekit_ajs_hidevar" value="1" <?php echo isset( $commercekit_options['ajs_hidevar'] ) && 1 === (int) $commercekit_options['ajs_hidevar'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Hide variations from search suggestions', 'commercegurus-commercekit' ); ?></label></td> </tr>
		</table>
		<input type="hidden" name="tab" value="ajax-search" />
		<input type="hidden" name="action" value="commercekit_save_settings" />
	</div>
	<?php } ?>

	<?php if ( 'reports' === $section ) { ?>
	<div class="inside ajax-search-reports">
		<div class="ajax-search-reports-boxes">
			<div class="ajax-search-reports-box">
				<h2><?php esc_html_e( 'Total searches', 'commercegurus-commercekit' ); ?></h2>
				<h3><?php echo isset( $reports['search_count'] ) ? esc_attr( $reports['search_count'] ) : 0; ?></h3>
				<p><?php esc_html_e( 'How many searches have been performed.', 'commercegurus-commercekit' ); ?></p>
			</div>
			<div class="ajax-search-reports-box">
				<h2><?php esc_html_e( 'Clickthrough rate', 'commercegurus-commercekit' ); ?></h2>
				<h3><?php echo isset( $reports['click_percent'] ) ? esc_attr( $reports['click_percent'] ) : 0; ?>%</h3>
				<p><?php esc_html_e( 'The % of searches that resulted in a click.', 'commercegurus-commercekit' ); ?></p>
			</div>
			<div class="ajax-search-reports-box">
				<h2><?php esc_html_e( 'No result rate', 'commercegurus-commercekit' ); ?></h2>
				<h3><?php echo isset( $reports['nores_percent'] ) ? esc_attr( $reports['nores_percent'] ) : 0; ?>%</h3>
				<p><?php esc_html_e( 'The % of searches that returned no results.', 'commercegurus-commercekit' ); ?></p>
			</div>
		</div>

		<h2><?php esc_html_e( 'Most frequent searches', 'commercegurus-commercekit' ); ?></h2>
		<p><?php esc_html_e( 'Discover what your users are searching for most.', 'commercegurus-commercekit' ); ?></p>
		<table class="ajax-search-reports-list">
			<tr><th align="left"><?php esc_html_e( 'Term', 'commercegurus-commercekit' ); ?></th><th align="right"><?php esc_html_e( 'Count', 'commercegurus-commercekit' ); ?></th></tr>
			<?php if ( isset( $reports['most_results'] ) && count( $reports['most_results'] ) ) { ?>
				<?php foreach ( $reports['most_results'] as $index => $row ) { ?>
					<tr><td align="left"><span><?php echo esc_attr( str_pad( $index + 1, 2, '0', STR_PAD_LEFT ) ); ?></span> <?php echo isset( $row['search_term'] ) ? esc_attr( $row['search_term'] ) : ''; ?></td><td align="right"><?php echo isset( $row['search_count'] ) ? esc_attr( number_format( $row['search_count'], 0 ) ) : 0; ?></td></tr>
				<?php } ?>
			<?php } else { ?>
				<tr><td align="center" colspan="2"><?php esc_html_e( 'No terms', 'commercegurus-commercekit' ); ?></td></tr>
			<?php } ?>
		</table>

		<h2><?php esc_html_e( 'Most frequent searches returning 0 results', 'commercegurus-commercekit' ); ?></h2>
		<p><?php esc_html_e( 'Users are searching for these queries and encounter no results.', 'commercegurus-commercekit' ); ?></p>
		<table class="ajax-search-reports-list">
			<tr><th align="left"><?php esc_html_e( 'Term', 'commercegurus-commercekit' ); ?></th><th align="right"><?php esc_html_e( 'Count', 'commercegurus-commercekit' ); ?></th></tr>
			<?php if ( isset( $reports['no_results'] ) && count( $reports['no_results'] ) ) { ?>
				<?php foreach ( $reports['no_results'] as $index => $row ) { ?>
					<tr><td align="left"><span><?php echo esc_attr( str_pad( $index + 1, 2, '0', STR_PAD_LEFT ) ); ?></span> <?php echo isset( $row['search_term'] ) ? esc_attr( $row['search_term'] ) : ''; ?></td><td align="right"><?php echo isset( $row['no_result_count'] ) ? esc_attr( number_format( $row['no_result_count'], 0 ) ) : 0; ?></td></tr>
				<?php } ?>
			<?php } else { ?>
				<tr><td align="center" colspan="2"><?php esc_html_e( 'No terms', 'commercegurus-commercekit' ); ?></td></tr>
			<?php } ?>
		</table><br /><br />
		<p class="report-note"><?php esc_html_e( 'NOTE: Report data is updated every 24 hours.', 'commercegurus-commercekit' ); ?></p>
	</div>
	<?php } ?>
</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Ajax Search', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'Research has shown that instant search results are an important feature on eCommerce sites. It helps users save time and find products faster.', 'commercegurus-commercekit' ); ?></p>
</div>
