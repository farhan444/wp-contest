<?php
/**
 * Shoptimizer default options - extended.
 *
 * @package Shoptimizer
 */

if ( ! function_exists( 'shoptimizer_typography2_defaults' ) ) {
	/**
	 * Typography 2.0 defaults.
	 */
	function shoptimizer_typography2_defaults() {
		$customizer_defaults = array(
			'typog2_shoptimizer_typography2_main_body_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),
			'shoptimizer_typography2_main_body_font_size'  => '16',
			'shoptimizer_typography2_main_body_font_letter_spacing' => '0',
			'shoptimizer_typography2_main_body_font_color' => '#444',

			'typog2_shoptimizer_typography2_mainmenu_level1_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),
			'shoptimizer_typography2_mainmenu_level1_font_size' => '16',
			'shoptimizer_typography2_mainmenu_level1_font_letter_spacing' => '-0.3',
			'shoptimizer_typography2_mainmenu_level1_text_transform' => 'none',

			'typog2_shoptimizer_typography2_mainmenu_level2_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),
			'shoptimizer_typography2_mainmenu_level2_font_size' => '15',
			'shoptimizer_typography2_mainmenu_level2_text_transform' => 'none',

			'typog2_shoptimizer_typography2_mainmenu_heading_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),
			'shoptimizer_typography2_mainmenu_heading_font_size' => '12',
			'shoptimizer_typography2_mainmenu_heading_font_letter_spacing' => '0.5',
			'shoptimizer_typography2_mainmenu_heading_font_text_transform' => 'uppercase',
			'shoptimizer_typography2_mainmenu_heading_font_color' => '#111',

			'typog2_shoptimizer_typography2_p_fontfamily'  => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_p_font_size'          => '17',
			'shoptimizer_typography2_p_font_letter_spacing' => '0',
			'shoptimizer_typography2_p_font_text_transform' => 'none',
			'shoptimizer_typography2_p_font_color'         => '#444',

			'typog2_shoptimizer_typography2_h1_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_h1_font_size'         => '40',
			'shoptimizer_typography2_h1_font_letter_spacing' => '-0.5',
			'shoptimizer_typography2_h1_font_text_transform' => 'none',
			'shoptimizer_typography2_h1_font_line_height'  => '1.3',
			'shoptimizer_typography2_h1_font_color'        => '#222',

			'typog2_shoptimizer_typography2_h2_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_h2_font_size'         => '28',
			'shoptimizer_typography2_h2_font_letter_spacing' => '-0.5',
			'shoptimizer_typography2_h2_font_text_transform' => 'none',
			'shoptimizer_typography2_h2_font_line_height'  => '1.4',
			'shoptimizer_typography2_h2_font_color'        => '#222',

			'typog2_shoptimizer_typography2_h3_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_h3_font_size'         => '24',
			'shoptimizer_typography2_h3_font_letter_spacing' => '-0.4',
			'shoptimizer_typography2_h3_font_text_transform' => 'none',
			'shoptimizer_typography2_h3_font_line_height'  => '1.55',
			'shoptimizer_typography2_h3_font_color'        => '#222',

			'typog2_shoptimizer_typography2_h4_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_h4_font_size'         => '20',
			'shoptimizer_typography2_h4_font_letter_spacing' => '0',
			'shoptimizer_typography2_h4_font_text_transform' => 'none',
			'shoptimizer_typography2_h4_font_line_height'  => '1.6',
			'shoptimizer_typography2_h4_font_color'        => '#222',

			'typog2_shoptimizer_typography2_h5_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_h5_font_size'         => '18',
			'shoptimizer_typography2_h5_font_letter_spacing' => '0',
			'shoptimizer_typography2_h5_font_text_transform' => 'none',
			'shoptimizer_typography2_h5_font_line_height'  => '1.6',
			'shoptimizer_typography2_h5_font_color'        => '#222',

			'typog2_shoptimizer_typography2_blockquote_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_blockquote_font_size' => '20',
			'shoptimizer_typography2_blockquote_font_letter_spacing' => '0',
			'shoptimizer_typography2_blockquote_font_text_transform' => 'none',
			'shoptimizer_typography2_blockquote_font_line_height' => '1.45',
			'shoptimizer_typography2_blockquote_font_color' => '#222',

			'typog2_shoptimizer_typography2_widget_title_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_widget_title_font_size' => '15',
			'shoptimizer_typography2_widget_title_font_letter_spacing' => '0',
			'shoptimizer_typography2_widget_title_font_text_transform' => 'none',
			'shoptimizer_typography2_widget_title_font_line_height' => '1.5',
			'shoptimizer_typography2_widget_title_font_color' => '#222',

			'typog2_shoptimizer_typography2_blog_post_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_blog_post_font_size'  => '36',
			'shoptimizer_typography2_blog_post_font_letter_spacing' => '-0.6',
			'shoptimizer_typography2_blog_post_font_text_transform' => 'none',
			'shoptimizer_typography2_blog_post_font_line_height' => '1.24',
			'shoptimizer_typography2_blog_post_font_color' => '#222',

			'typog2_shoptimizer_typography2_woocommerce_archives_description_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_woocommerce_archives_description_font_size' => '17',
			'shoptimizer_typography2_woocommerce_archives_description_font_letter_spacing' => '-0.1',
			'shoptimizer_typography2_woocommerce_archives_description_font_text_transform' => 'none',
			'shoptimizer_typography2_woocommerce_archives_description_font_line_height' => '1.5',
			'shoptimizer_typography2_woocommerce_archives_description_font_color' => '#222',

			'typog2_shoptimizer_typography2_woocommerce_listings_title_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_woocommerce_listings_title_font_size' => '15',
			'shoptimizer_typography2_woocommerce_listings_title_font_letter_spacing' => '0',
			'shoptimizer_typography2_woocommerce_listings_title_font_text_transform' => 'none',
			'shoptimizer_typography2_woocommerce_listings_title_font_line_height' => '1.3',
			'shoptimizer_typography2_woocommerce_listings_title_font_color' => '#222',

			'typog2_shoptimizer_typography2_woocommerce_single_title_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_woocommerce_single_title_font_size' => '34',
			'shoptimizer_typography2_woocommerce_single_title_font_letter_spacing' => '-0.5',
			'shoptimizer_typography2_woocommerce_single_title_font_text_transform' => 'none',
			'shoptimizer_typography2_woocommerce_single_title_font_line_height' => '1.3',
			'shoptimizer_typography2_woocommerce_single_title_font_color' => '#222',

			'typog2_shoptimizer_typography2_woocommerce_primary_button_fontfamily' => json_encode(
				array(
					'font'          => 'IBM Plex Sans',
					'regularweight' => '600',
					'category'      => 'sans-serif',
				)
			),

			'shoptimizer_typography2_woocommerce_primary_button_font_size' => '18',
			'shoptimizer_typography2_woocommerce_primary_button_font_letter_spacing' => '0',
			'shoptimizer_typography2_woocommerce_primary_button_font_text_transform' => 'none',
			'shoptimizer_typography2_woocommerce_primary_button_font_color' => '#222',
		);

		return apply_filters( 'shoptimizer_typography2_defaults', $customizer_defaults );
	}
}
