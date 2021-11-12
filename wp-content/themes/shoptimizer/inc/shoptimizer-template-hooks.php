<?php
/**
 * Shoptimizer hooks
 *
 * @package shoptimizer
 */

/**
 * General
 *
 * @see  shoptimizer_header_widget_region()
 * @see  shoptimizer_get_sidebar()
 */
add_action( 'shoptimizer_before', 'shoptimizer_mobile_menu_close', 10 );
add_action( 'shoptimizer_before_content', 'shoptimizer_mobile_overlay', 0 );
add_action( 'shoptimizer_before_content', 'shoptimizer_sticky_header_display', 5 );
add_action( 'shoptimizer_before_content', 'shoptimizer_header_widget_region', 10 );
add_action( 'shoptimizer_sidebar', 'shoptimizer_get_sidebar', 10 );

/**
 * Topbar
 *
 * @see  shoptimizer_skip_links()
 * @see  shoptimizer_top_bar()
 */
add_action( 'shoptimizer_before_site', 'shoptimizer_skip_links', 0 );
add_action( 'shoptimizer_topbar', 'shoptimizer_top_bar', 10 );

/**
 * Header
 *
 * @see  shoptimizer_skip_links()
 * @see  shoptimizer_secondary_navigation()
 * @see  shoptimizer_site_branding()
 * @see  shoptimizer_primary_navigation()
 * @see  shoptimizer_mobile_menu_close()
 */

// Header-4 open wrapper
add_action( 'shoptimizer_topbar', 'shoptimizer_header_wrapper_open', 90 );


add_action( 'shoptimizer_header', 'shoptimizer_site_branding', 20 );
add_action( 'shoptimizer_header', 'shoptimizer_mobile_myaccount', 22 );
add_action( 'shoptimizer_header', 'shoptimizer_mobile_search_toggle', 25 );
add_action( 'shoptimizer_header', 'shoptimizer_secondary_navigation', 30 );
add_action( 'shoptimizer_header', 'shoptimizer_sticky_js_trigger', 90 );

/**
 * Navigation
 *
 * @see  shoptimizer_primary_navigation_wrapper()
 * @see  shoptimizer_primary_navigation()
 * @see  shoptimizer_primary_navigation_wrapper_close()
 */
add_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper', 42 );

$shoptimizer_search_mobile = '';
$shoptimizer_search_mobile = shoptimizer_get_option( 'shoptimizer_search_mobile' );

add_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation', 50 );

add_action( 'shoptimizer_navigation', 'shoptimizer_mobile_extra_field', 53 );

add_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper_close', 68 );

// Header-4 close wrapper
add_action( 'shoptimizer_before_content', 'shoptimizer_header_wrapper_close', 0 );

$shoptimizer_header_layout = '';
$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

if ( isset( $_GET['header'] ) ) {
	$shoptimizer_header_layout = $_GET['header'];
}

if ( 'header-4' === $shoptimizer_header_layout ) {
	remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper', 42 );
	remove_action( 'shoptimizer_navigation', 'shoptimizer_primary_navigation_wrapper_close', 68 );
	add_action( 'shoptimizer_navigation', 'shoptimizer_search_modal', 50 );
}

/**
 * Footer
 *
 * @see  shoptimizer_footer_widgets()
 * @see  shoptimizer_footer_copyright()
 */
add_action( 'shoptimizer_before_footer', 'shoptimizer_below_content', 10 );
add_action( 'shoptimizer_footer', 'shoptimizer_footer_widgets', 20 );
add_action( 'shoptimizer_footer', 'shoptimizer_footer_copyright', 30 );


/**
 * Posts
 *
 * @see  shoptimizer_post_header()
 * @see  shoptimizer_post_meta()
 * @see  shoptimizer_post_content()
 * @see  shoptimizer_paging_nav()
 * @see  shoptimizer_single_post_header()
 * @see  shoptimizer_post_nav()
 * @see  shoptimizer_display_comments()
 */
add_action( 'shoptimizer_loop_post', 'shoptimizer_post_thumbnail', 5 );
add_action( 'shoptimizer_loop_post', 'shoptimizer_post_header', 10 );
remove_action( 'shoptimizer_loop_post', 'shoptimizer_post_content', 30 );

$shoptimizer_layout_blog_summary_display = '';
$shoptimizer_layout_blog_summary_display = shoptimizer_get_option( 'shoptimizer_layout_blog_summary_display' );

if ( true === $shoptimizer_layout_blog_summary_display ) {
	add_action( 'shoptimizer_loop_post', 'shoptimizer_archive_post_content', 30 );
}

add_action( 'shoptimizer_loop_after', 'shoptimizer_paging_nav', 10 );
add_action( 'shoptimizer_single_post', 'shoptimizer_post_thumbnail_no_link', 5 );
add_action( 'shoptimizer_single_post', 'shoptimizer_post_header', 10 );
add_action( 'shoptimizer_single_post', 'shoptimizer_post_content', 30 );
add_action( 'shoptimizer_single_post', 'shoptimizer_post_meta', 40 );
add_action( 'shoptimizer_single_post_bottom', 'shoptimizer_display_comments', 20 );



/**
 * Pages
 *
 * @see  shoptimizer_page_header()
 * @see  shoptimizer_page_content()
 * @see  shoptimizer_display_comments()
 */

add_action( 'shoptimizer_page_start', 'shoptimizer_page_header', 10 );
add_action( 'shoptimizer_page', 'shoptimizer_page_content', 20 );
add_action( 'shoptimizer_page_after', 'shoptimizer_display_comments', 10 );
add_action( 'shoptimizer_homepage', 'shoptimizer_page_content', 20 );
add_action( 'shoptimizer_page_sidebar', 'shoptimizer_pages_sidebar', 10 );


/**
 * 404 Page.
 */
add_action( 'shoptimizer_404_template', 'shoptimizer_entry_content_404_page_template');