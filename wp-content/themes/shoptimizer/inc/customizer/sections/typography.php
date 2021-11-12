<?php
/**
 *
 * Kirki typography section
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */
function shoptimizer_kirki_section_typography( $wp_customize ) {

	// Presets.
	$wp_customize->add_section(
		'shoptimizer_typography_section_presets', array(
			'title'    => esc_html__( 'Presets', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Typography.
	$wp_customize->add_section(
		'shoptimizer_typography_section_mainbody', array(
			'title'    => esc_html__( 'Main Body', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Navigation.
	$wp_customize->add_section(
		'shoptimizer_typography_section_navigation', array(
			'title'    => esc_html__( 'Navigation', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Paragraphs.
	$wp_customize->add_section(
		'shoptimizer_typography_section_p', array(
			'title'    => esc_html__( 'Paragraphs', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Heading One.
	$wp_customize->add_section(
		'shoptimizer_typography_section_headings_h1', array(
			'title'    => esc_html__( 'Heading One', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Heading Two.
	$wp_customize->add_section(
		'shoptimizer_typography_section_headings_h2', array(
			'title'    => esc_html__( 'Heading Two', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Heading Three.
	$wp_customize->add_section(
		'shoptimizer_typography_section_headings_h3', array(
			'title'    => esc_html__( 'Heading Three', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Heading Four.
	$wp_customize->add_section(
		'shoptimizer_typography_section_headings_h4', array(
			'title'    => esc_html__( 'Heading Four', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Heading Five.
	$wp_customize->add_section(
		'shoptimizer_typography_section_headings_h5', array(
			'title'    => esc_html__( 'Heading Five', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Blockquote.
	$wp_customize->add_section(
		'shoptimizer_typography_section_blockquote', array(
			'title'    => esc_html__( 'Blockquotes', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Widget Title.
	$wp_customize->add_section(
		'shoptimizer_typography_section_headings_widget_title', array(
			'title'    => esc_html__( 'Widget Titles', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// Blog.
	$wp_customize->add_section(
		'shoptimizer_typography_section_blog', array(
			'title'    => esc_html__( 'Blog', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

	// WooCommerce.
	$wp_customize->add_section(
		'shoptimizer_typography_section_woocommerce', array(
			'title'    => esc_html__( 'WooCommerce', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_typography',
			'priority' => 10,
		)
	);

}

add_action( 'customize_register', 'shoptimizer_kirki_section_typography' );
