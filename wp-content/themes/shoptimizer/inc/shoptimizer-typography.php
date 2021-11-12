<?php
/**
 * Typography 2.0 preloaders and helpers.
 *
 * @package Shoptimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'shoptimizer_fonts2_generate_preload_fonts' ) ) {
	/**
	 * Generae font preload woffs
	 */
	function shoptimizer_fonts2_generate_preload_fonts( $return_array = false ) {
		$shoptimizer_fonts2_active_fonts = shoptimizer_fonts2_get_active_fonts();
		if ( $shoptimizer_fonts2_active_fonts ) {
			require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
			$font_css      = wptt_get_webfont_styles( $shoptimizer_fonts2_active_fonts );
			$font_rules    = explode( '/*', $font_css );
			$preload_woffs = array();
			foreach ( $font_rules as $font_rule ) {
				if ( false === strpos( $font_rule, 'latin */' ) ) {
					continue;
				}
				preg_match_all( '/url\(.*?\)/i', $font_rule, $preload_woff_url );
				// error_log( print_r( $preload_woff_url[0][0], true ) );
				$preload_woffs[] = rtrim( ltrim( $preload_woff_url[0][0], 'url(' ), ')' );
				// store array in option.
				update_option( 'shoptimizer_preload_woffs', $preload_woffs );
			}
			// return array if arg is true.
			if ( $return_array ) {
				return $preload_woffs;
			}
		}
	}
}

add_action( 'wp_head', 'shoptimizer_fonts2_preload_fonts' );
if ( ! function_exists( 'shoptimizer_fonts2_preload_fonts' ) ) {
	/**
	 * Display preloaded fonts.
	 */
	function shoptimizer_fonts2_preload_fonts() {
		$preload_woffs = get_option( 'shoptimizer_preload_woffs' );
		if ( $preload_woffs ) {
		} else {
			$preload_woffs = shoptimizer_fonts2_generate_preload_fonts( true );
		}
		$preload_woff_html = '';
		foreach ( $preload_woffs as $preload_woff ) {
			$preload_woff_html .= sprintf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>', $preload_woff );
		}
		echo $preload_woff_html;
	}
}

add_action( 'wp_enqueue_scripts', 'shoptimizer_fonts2_enqueue_google_fonts_css', 10 );
if ( ! function_exists( 'shoptimizer_fonts2_enqueue_google_fonts_css' ) ) {
	/**
	 * Enqueue full google fonts styles as inline css.
	 */
	function shoptimizer_fonts2_enqueue_google_fonts_css() {
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		$gfonts_api_url = shoptimizer_fonts2_get_active_fonts();
		// error_log( $gfonts_api_url );
		if ( $gfonts_api_url ) {
			// if customizer preview - load gfonts the old fashioned way.
			if ( is_customize_preview() ) {
				wp_enqueue_style( 'preview-gfonts', $gfonts_api_url, false );
			} else {
				// else inline with wptt.
				wp_add_inline_style(
					'shoptimizer-style',
					wptt_get_webfont_styles( $gfonts_api_url )
				);
			}
		}
	}
}

if ( ! function_exists( 'shoptimizer_fonts2_get_active_fonts' ) ) {
	/**
	 * Get active google fonts from options. (NOTE: all google fonts candidates should be prepended with typog2 to be plucked below).
	 */
	function shoptimizer_fonts2_get_active_fonts() {
		$base_url                          = 'https://fonts.googleapis.com/css';
		$fonts                             = array(
			'web_safe_fonts' => array(),
			'google_fonts'   => array(),
		);
		$shoptimizer_font2_default_options = shoptimizer_typography2_defaults();

		// error_log( print_r( $shoptimizer_font2_default_options, true ) );

		$shoptimizer_base_options = get_option( 'shoptimizer_settings', array() );
		// error_log( print_r( $shoptimizer_base_options, true ) );
		$shoptimizer_options = wp_parse_args(
			$shoptimizer_base_options,
			$shoptimizer_font2_default_options
		);
		$gfont_assoc         = array();
		$gffamily            = array();

		foreach ( $shoptimizer_options as $key => $value ) {
			if ( false === strpos( $key, 'typog2' ) ) {
				continue;
			}

			$font_array      = json_decode( $value, true );
			$gfont_font_name = $font_array['font'];
			$gfont_font_name = str_replace( ' ', '+', $gfont_font_name );
			$gfont_weights   = array();

			if ( ! empty( $font_array['regularweight'] ) ) {
				if ( ! in_array( $font_array['regularweight'], $gfont_weights ) ) {
					$gfont_weights[] = $font_array['regularweight'];
				}
			}
			if ( ! empty( $font_array['italicweight'] ) ) {
				if ( ! in_array( $font_array['italicweight'], $gfont_weights ) ) {
					$gfont_weights[] = $font_array['italicweight'];
				}
			}
			if ( ! empty( $font_array['boldweight'] ) ) {
				if ( ! in_array( $font_array['boldweight'], $gfont_weights ) ) {
					$gfont_weights[] = $font_array['boldweight'];
				}
			}

			$gfont_font_name = $font_array['font'];
			if ( ! array_key_exists( $gfont_font_name, $gfont_assoc ) ) {
				$gfont_assoc[ $gfont_font_name ] = $gfont_weights;
			} else {
				$gfont_assoc[ $gfont_font_name ] = array_merge( $gfont_assoc[ $gfont_font_name ], $gfont_weights );
				$gfont_assoc[ $gfont_font_name ] = array_unique( $gfont_assoc[ $gfont_font_name ] );
			}
		}

		// build gfonts url string.
		foreach ( $gfont_assoc as $key => $value ) {
			$gfweights  = implode( ',', $value );
			$gfname     = str_replace( ' ', '+', $key );
			$gffamily[] = $gfname . ':' . $gfweights;
		}

		if ( ! empty( $gffamily ) ) {
			$gffamily              = implode( '|', $gffamily );
			$gfont_args['family']  = $gffamily;
			$gfont_args['display'] = 'swap';
			$gfont_args['subset']  = 'latin';
			// error_log( add_query_arg( $gfont_args, $base_url ) );
			return add_query_arg( $gfont_args, $base_url );
		}
		return '';
	}
}
