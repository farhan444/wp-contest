<?php
/**
 * Generates Shoptimizer dynamic css.
 *
 * @package Shoptimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'shoptimizer_get_font_property' ) ) {
	/**
	 * Helper to access font properties.
	 *
	 * @since 0.1
	 */
	function shoptimizer_get_font_property( $json, $property ) {
		$shoptimizer_font_property = json_decode( $json );
		if ( 'regularweight' === $property ) {
			if ( 'regular' === $shoptimizer_font_property->$property ) {
				$shoptimizer_font_property->$property = '400';
			}
		}
		if ( 'regularweight' === $property ) {

			if ( strpos( $shoptimizer_font_property->$property, 'italic' ) !== false ) {
				$shoptimizer_font_property->$property = str_replace( 'italic', '', $shoptimizer_font_property->$property );
			}

			if ( '' === $shoptimizer_font_property->$property ) {
				$shoptimizer_font_property->$property = '400';
			}
		}

		return $shoptimizer_font_property->$property;
	}
}

if ( ! function_exists( 'shoptimizer_get_font_family_css' ) ) {
	/**
	 * Helper to access font properties.
	 *
	 * @since 0.1
	 */
	function shoptimizer_get_font_family_css( $font ) {
		$shoptimizer_font2_defaults = shoptimizer_typography2_defaults();
		$shoptimizer_options        = get_option( 'shoptimizer_settings', array() );
		$shoptimizer_font_settings  = wp_parse_args(
			$shoptimizer_options,
			$shoptimizer_font2_defaults
		);

		$typog2_shoptimizer_typography2_fontfamily   = shoptimizer_get_font_property( $shoptimizer_font_settings[ $font ], 'font' );
		$typog2_shoptimizer_typography2_fontcategory = shoptimizer_get_font_property( $shoptimizer_font_settings[ $font ], 'category' );

		$string_start = '"';
		$string_end   = '", ';

		$font_family_css = $string_start . $typog2_shoptimizer_typography2_fontfamily . $string_end . $typog2_shoptimizer_typography2_fontcategory;
		return $font_family_css;
	}
}

if ( ! function_exists( 'shoptimizer_maybe_font_italic_style' ) ) {
	/**
	 * Helper to check if we have italics.
	 *
	 * @since 0.1
	 */
	function shoptimizer_maybe_font_italic_style( $json, $property ) {
		$shoptimizer_font_property = json_decode( $json );

		if ( 'regularweight' === $property ) {
			if ( strpos( $shoptimizer_font_property->$property, 'italic' ) !== false ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'shoptimizer_typography2_css' ) ) {
	/**
	 * Main function to generate typography css.
	 *
	 * @since 0.1
	 */
	function shoptimizer_typography2_css() {

		$shoptimizer_font2_defaults = shoptimizer_typography2_defaults();
		$shoptimizer_options        = get_option( 'shoptimizer_settings', array() );

		$shoptimizer_font_settings = wp_parse_args(
			$shoptimizer_options,
			$shoptimizer_font2_defaults
		);

		$css = new CommerceGurus\Shoptimizer_CSS();

		// Main body.
		$css->set_selector( 'body, button, input, select, textarea, h6' );
		$typog2_shoptimizer_typography2_main_body_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_main_body_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_main_body_font_family_css );
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_main_body_font_size'], '', 'px' );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_main_body_fontfamily'], 'regularweight' ) );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_main_body_font_color'], '' );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_main_body_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_main_body_font_letter_spacing'], '', 'px' );
		$css->set_selector( '.wp-block-button__link, figcaption, .wp-block-table, .wp-block-pullquote__citation' );
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_main_body_font_size'], '', 'px' );

		// Main Navigation Level 1 Menu Font.
		$css->set_selector( '.menu-primary-menu-container > ul > li > a, .site-header-cart .cart-contents' );
		$typog2_shoptimizer_typography2_mainmenu_level1_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_mainmenu_level1_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_mainmenu_level1_font_family_css );
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_level1_font_size'], '', 'px' );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_mainmenu_level1_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_mainmenu_level1_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_level1_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_level1_text_transform'], '', '' );

		// Main Navigation Level 2 Menu Font.
		$css->set_selector( '.main-navigation ul.menu ul li > a, .main-navigation ul.nav-menu ul li > a' );
		$typog2_shoptimizer_typography2_mainmenu_level2_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_mainmenu_level2_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_mainmenu_level2_font_family_css );
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_level2_font_size'], '', 'px' );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_mainmenu_level2_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_mainmenu_level2_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_level2_text_transform'], '', '' );

		// Mega menu heading Font.
		$css->set_selector( '.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.menu-item-has-children > a, .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.heading > a' );
		$typog2_shoptimizer_typography2_mainmenu_heading_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_mainmenu_heading_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_mainmenu_heading_font_family_css );
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_heading_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_heading_font_letter_spacing'], '', 'px' );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_mainmenu_heading_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_mainmenu_heading_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_heading_font_text_transform'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_mainmenu_heading_font_color'], '' );

		// Paragraph Font.
		$css->set_selector( '.entry-content' );
		$typog2_shoptimizer_typography2_p_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_p_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_p_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_p_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_p_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_p_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_p_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_p_font_text_transform'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_p_font_color'], '' );

		// H1 Font.
		$css->set_selector( 'h1' );
		$typog2_shoptimizer_typography2_h1_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_h1_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_h1_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h1_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h1_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_h1_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_h1_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_h1_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_h1_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_h1_font_color'], '' );

		// H2 Font.
		$css->set_selector( 'h2, .wp-block-heading h2' );
		$typog2_shoptimizer_typography2_h2_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_h2_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_h2_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h2_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h2_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_h2_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_h2_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_h2_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_h2_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_h2_font_color'], '' );

		// H3 Font.
		$css->set_selector( 'h3, .wp-block-heading h3' );
		$typog2_shoptimizer_typography2_h3_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_h3_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_h3_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h3_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h3_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_h3_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_h3_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_h3_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_h3_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_h3_font_color'], '' );

		// H4 Font.
		$css->set_selector( 'h4, .wp-block-heading h4' );
		$typog2_shoptimizer_typography2_h4_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_h4_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_h4_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h4_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h4_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_h4_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_h4_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_h4_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_h4_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_h4_font_color'], '' );

		// H5 Font.
		$css->set_selector( 'h5, .wp-block-heading h5' );
		$typog2_shoptimizer_typography2_h5_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_h5_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_h5_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h5_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_h5_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_h5_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_h5_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_h5_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_h5_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_h5_font_color'], '' );

		// Blockquote Font.
		$css->set_selector( 'blockquote p, .edit-post-visual-editor.editor-styles-wrapper .wp-block-quote p, .edit-post-visual-editor.editor-styles-wrapper .wp-block-quote' );
		$typog2_shoptimizer_typography2_blockquote_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_blockquote_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_blockquote_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_blockquote_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_blockquote_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_blockquote_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_blockquote_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_blockquote_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_blockquote_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_blockquote_font_color'], '' );

		// Widget Title Font.
		$css->set_selector( '.widget .widget-title, .widget .widgettitle' );
		$typog2_shoptimizer_typography2_widget_title_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_widget_title_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_widget_title_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_widget_title_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_widget_title_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_widget_title_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_widget_title_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_widget_title_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_widget_title_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_widget_title_font_color'], '' );

		// Blog Post Font.
		$css->set_selector( 'body.single-post h1' );
		$typog2_shoptimizer_typography2_blog_post_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_blog_post_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_widget_title_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_blog_post_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_blog_post_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_blog_post_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_blog_post_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_blog_post_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_blog_post_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_blog_post_font_color'], '' );

		// Archives Category Description.
		$css->set_selector( '.term-description, .shoptimizer-category-banner .taxonomy-description' );
		$typog2_shoptimizer_typography2_woocommerce_archives_description_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_woocommerce_archives_description_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_woocommerce_archives_description_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_archives_description_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_archives_description_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_archives_description_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_archives_description_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_archives_description_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_archives_description_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_archives_description_font_color'], '' );

		// Archives Product Title.
		$css->set_selector(
			'.content-area ul.products li.product .woocommerce-loop-product__title, .content-area ul.products li.product h2,
			ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-product__title,
			.main-navigation ul.menu ul li.product .woocommerce-loop-product__title a'
		);
		$typog2_shoptimizer_typography2_woocommerce_listings_title_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_woocommerce_listings_title_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_woocommerce_listings_title_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_listings_title_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_listings_title_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_listings_title_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_listings_title_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_listings_title_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_listings_title_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_listings_title_font_color'], '' );

		// Single Product Title.
		$css->start_media_query( '(min-width:770px)' );
		$css->set_selector( '.single-product h1' );
		$typog2_shoptimizer_typography2_woocommerce_single_title_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_woocommerce_single_title_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_woocommerce_single_title_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_single_title_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_single_title_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_single_title_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_single_title_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_single_title_font_text_transform'], '', '' );
		$css->add_property( 'line-height', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_single_title_font_line_height'], '', '' );
		$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_single_title_font_color'], '' );
		$css->stop_media_query();

		// Primary Buttons.
		$css->set_selector(
			'body .woocommerce #respond input#submit.alt, 
			body .woocommerce a.button.alt, 
			body .woocommerce button.button.alt, 
			body .woocommerce input.button.alt,
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.widget_shopping_cart a.button.checkout'
		);
		$typog2_shoptimizer_typography2_woocommerce_primary_button_font_family_css = shoptimizer_get_font_family_css( 'typog2_shoptimizer_typography2_woocommerce_primary_button_fontfamily' );
		$css->add_property( 'font-family', $typog2_shoptimizer_typography2_woocommerce_primary_button_font_family_css );
		$css->add_property( 'font-weight', shoptimizer_get_font_property( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_primary_button_fontfamily'], 'regularweight' ) );
		if ( shoptimizer_maybe_font_italic_style( $shoptimizer_font_settings['typog2_shoptimizer_typography2_woocommerce_primary_button_fontfamily'], 'regularweight' ) ) {
			$css->add_property( 'font-style', 'italic', '' );
		}
		$css->add_property( 'font-size', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_primary_button_font_size'], '', 'px' );
		$css->add_property( 'letter-spacing', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_primary_button_font_letter_spacing'], '', 'px' );
		$css->add_property( 'text-transform', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_primary_button_font_text_transform'], '', '' );
		//$css->add_property( 'color', $shoptimizer_font_settings['shoptimizer_typography2_woocommerce_primary_button_font_color'], '' );

		do_action( 'shoptimizer_typography2_css', $css );

		return apply_filters( 'shoptimizer_typography2_css_output', $css->css_output() );
	}
}

/**
 * Helper function to get the dynamic css.
 */
function shoptimizer_get_dynamic_css() {
	$css = shoptimizer_typography2_css();
	return apply_filters( 'shoptimizer_dynamic_css', $css );
}

add_action( 'wp_enqueue_scripts', 'shoptimizer_enqueue_dynamic_css', 50 );
/**
 * Enqueue our dynamic CSS.
 */
function shoptimizer_enqueue_dynamic_css() {
	if ( ! get_option( 'shoptimizer_dynamic_css_output', false ) || is_customize_preview() ) {
		$css = shoptimizer_get_dynamic_css();
	} else {
		$css = get_option( 'shoptimizer_dynamic_css_output' );
	}
	if ( is_customize_preview() ) {
		wp_add_inline_style( 'preview-gfonts', wp_strip_all_tags( $css ) );
	} else {
		wp_add_inline_style( 'shoptimizer-style', wp_strip_all_tags( $css ) );
	}

}

add_action( 'init', 'shoptimizer_set_dynamic_css_cache' );
/**
 * Generate the dynamic css and store it as an option.
 */
function shoptimizer_set_dynamic_css_cache() {
	$cached_css     = get_option( 'shoptimizer_dynamic_css_output', false );
	$cached_version = get_option( 'shoptimizer_dynamic_css_cached_version', '' );

	if ( ! $cached_css || SHOPTIMIZER_VERSION !== $cached_version ) {
		$css = shoptimizer_typography2_css();
		update_option( 'shoptimizer_dynamic_css_output', wp_strip_all_tags( $css ) );
		update_option( 'shoptimizer_dynamic_css_cached_version', esc_html( SHOPTIMIZER_VERSION ) );
	}
}

add_action( 'customize_save_after', 'shoptimizer_update_dynamic_css_cache' );
/**
 * Refresh css cache when saving customizer.
 */
function shoptimizer_update_dynamic_css_cache() {
	$css = shoptimizer_typography2_css();
	update_option( 'shoptimizer_dynamic_css_output', wp_strip_all_tags( $css ) );
	shoptimizer_fonts2_generate_preload_fonts();
}
