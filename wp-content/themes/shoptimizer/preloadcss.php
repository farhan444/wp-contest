<?php
/**
 * Enqueue assets required by the theme.
 */
function pwcc_register_assets() {
	// Enqueue Stylesheet
	wp_enqueue_style(
		'pwcc-style',
		get_stylesheet_uri(),
		array(),
		'1.0',
		'all'
	);
	wp_style_add_data( 'pwcc-style', 'pwcc_critical', true );

	// Register Load CSS for later enqueueing if needed.
	wp_register_script(
		'pwcc-load-css',
		get_stylesheet_directory_uri() . '/loadcss.js',
		array( 'jquery' ),
		'1.2.0',
		true
	);
}
add_action( 'wp', 'pwcc_register_assets' );

/**
 * Detect if using the HTTP/2 Prootocol.
 *
 * This detects if the user's sesion is running over HTTP/2
 *
 * @return boolean Returns true if running HTTP/2
 */
function pwcc_is_http2() {
	if ( ! isset( $_SERVER['SERVER_PROTOCOL'] ) ) {
		return false;
	}

	switch ( strtolower( wp_unslash( $_SERVER['SERVER_PROTOCOL'] ) ) ) {
		case 'h2': // Falls through
		case 'http/2.0':
			return true;

		default:
			return false;
	}
}

/**
 * Set a cookied to indicate an asset is likely cached by the browser.
 *
 * @param string $handle The handle by which the asset is known to WordPress.
 * @param string $version The asset's version.
 * @return boolean Whether the cookie was able to be set.
 */
function pwcc_set_asset_cached( $handle, $version ) {
	$handle  = base_convert( sha1( $handle ), 16, 36 );
	$version = base_convert( sha1( $version ), 16, 36 );

	$handle  = substr( $handle, 0, 5 );
	$version = substr( $version, 0, 5 );

	return setcookie( 'pwcc_' . $handle, $version, 0, '/' );
}

/**
 * Check for coookie indicating asset is likely cached by the browser.
 *
 * @param string $handle The handle by which the asset is known to WordPress.
 * @param string $version The asset's version.
 * @return boolean Whether the file is likely to be cached.
 */
function pwcc_is_asset_cached( $handle, $version ) {
	$handle  = base_convert( sha1( $handle ), 16, 36 );
	$version = base_convert( sha1( $version ), 16, 36 );

	$handle  = substr( $handle, 0, 5 );
	$version = substr( $version, 0, 5 );

	if ( $version === $_COOKIE[ 'pwcc_' . $handle ] ) {
		return true;
	}
	return false;
}

/**
 * Set cookied indicating stylesheet is likely cached by the browser.
 *
 * @param string $handle The handle by which the stylesheet is known to WordPress.
 * @return boolean Whether the cookie was able to be set.
 */
function pwcc_set_style_cached( $handle ) {
	global $wp_styles;

	if ( ! isset( $wp_styles->registered[ $handle ] ) ) {
		return false;
	}

	$handle .= '-css';

	$version = $wp_styles->registered[ $handle ]->ver;
	$version = $version ? $version : 'unknown';

	return pwcc_set_asset_cached( $handle, $version );
}

/**
 * Check for coookie indicating stylesheet is likely cached by the browser.
 *
 * @param string $handle The handle by which the stylesheet is known to WordPress.
 * @return boolean Whether the file is likely to be cached.
 */
function pwcc_is_style_cached( $handle ) {
	global $wp_styles;

	if ( ! isset( $wp_styles->registered[ $handle ] ) ) {
		return false;
	}

	$handle .= '-css';

	$version = $wp_styles->registered[ $handle ]->ver;
	$version = $version ? $version : 'unknown';

	return pwcc_is_asset_cached( $handle, $version );
}

/**
 * Output HTTP Preload header for registed WordPress stylesheet.
 *
 * @param string  $handle Registered name of the Stylesheet.
 * @param boolean $push   If the server should attempt to push the asset. Default true.
 * @return boolean true on success, false on failure.
 */
function pwcc_preload_style( $handle, $push = true ) {
	global $wp_styles;

	// Only preload if enqueued.
	if ( ! wp_style_is( $handle ) ) {
		return false;
	}

	$style = $wp_styles->registered[ $handle ];

	$nopush = '';
	if ( ! $push ) {
		$nopush = '; nopush';
	}

	$source = add_query_arg(
		'ver',
		$style->ver,
		$style->src
	);

	header( 'Link: <' . esc_url_raw( $source ) . '>; rel=preload; as=style' . $nopush );

	return true;
}

/**
 * Print the contents of a CSS file inline.
 *
 * If the file is printed inline, sets up data for the file to be preloaded and for loadCSS to be enqueued.
 *
 * @param  string $handle  Registered name of the Stylesheet.
 * @return boolean true on success, false on failure.
 */
function pwcc_print_style_inline( $handle ) {
	global $wp_styles;

	if ( ! isset( $wp_styles->registered[ $handle ] ) ) {
		return false;
	}
	$style = $wp_styles->registered[ $handle ];

	$path_to_file = pwcc_wp_url_to_path( $style->src );

	if ( false === $path_to_file ) {
		// Could not find file.
		return false;
	}

	$inline_css = file_get_contents( $path_to_file );

	wp_add_inline_style( $handle, $inline_css );
	wp_style_add_data( $handle, 'pwcc_rel_preload', true );

	return true;
}

/**
 * Convert an assets URL to a path.
 *
 * Makes a best guess as to the path of an asset.
 *
 * @param string $url  The URL to the asset.
 * @return string|boolean The path to the asset. False of failure.
 */
function pwcc_wp_url_to_path( $url ) {

	$url = remove_query_arg( 'ver', $url );

	$path = str_replace(
		array( trailingslashit( content_url() ), trailingslashit( includes_url() ) ),
		array( trailingslashit( WP_CONTENT_DIR ), trailingslashit( ABSPATH . WPINC ) ),
		$url
	);

	if ( ! file_exists( $path ) ) {
		return false;
	}

	return $path;
}

/**
 * Add HTTP Link headers required by server push.
 */
function pwcc_preload_http_headers() {
	global $wp_styles;

	foreach ( $wp_styles->registered as $style ) {
		if ( isset( $style->extra['pwcc_critical'] ) && $style->extra['pwcc_critical'] ) {
			if ( pwcc_is_style_cached( $style->handle ) ) {
				pwcc_preload_style( $style->handle, false );
			} else {
				// Server push (if available).
				pwcc_preload_style( $style->handle );
			}

			if ( ! pwcc_is_style_cached( $style->handle ) && ! pwcc_is_http2() ) {
				pwcc_print_style_inline( $style->handle );
				wp_enqueue_script( 'pwcc-load-css' );
			}

			pwcc_set_style_cached( $style->handle );
		}
	}
}
add_action( 'wp', 'pwcc_preload_http_headers', 20 );

/**
 * Replaces a stylesheet link tag with a preload tag.
 *
 * @param string $tag     The link tag as generated by WordPress.
 * @param string $handle  The handle by which the stylesheet is known to WordPress.
 * @param string $href    The URL to the stylesheet, including version number.
 * @param string $media   The media attribute of the stylesheet.
 * @return string The original tag wrapped in a noscript element, followed by the preload tag.
 */
function pwcc_filter_style_loader_tag( $tag, $handle, $href, $media ) {
	global $wp_styles;

	if ( ! isset( $wp_styles->registered[ $handle ] ) ) {
		return false;
	}
	$style = $wp_styles->registered[ $handle ];

	if ( ! isset( $style->extra['pwcc_rel_preload'] ) || ! $style->extra['pwcc_rel_preload'] ) {
		return $tag;
	}

	$rel = isset( $obj->extra['alt'] ) && $obj->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';

	$tag  = sprintf( '<noscript>%s</noscript>', $tag );
	$tag .= sprintf(
		'<link rel="preload" as="style" onload="%s" id="%s-css" href="%s" type="text/css" media="%s" />',
		"this.rel='" . esc_js( $rel ) . "'",
		esc_attr( $handle . ':preload' ),
		esc_url_raw( $href ),
		esc_attr( $media )
	);

	return $tag;
}
add_filter( 'style_loader_tag', 'pwcc_filter_style_loader_tag', 10, 4 );
