<?php
/**
 *
 * Kirki color section
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */
function shoptimizer_kirki_section_color( $wp_customize ) {

	// Colors.
	$wp_customize->add_section( 'shoptimizer_color_section_topbar', array(
		'title'			 => esc_html__( 'Top Bar', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_colors',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_color_section_header', array(
		'title'			 => esc_html__( 'Header', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_colors',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_color_section_below_header', array(
		'title'			 => esc_html__( 'Below Header', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_colors',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_color_section_navigation', array(
		'title'			 => esc_html__( 'Navigation', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_colors',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_color_section_general', array(
		'title'			 => esc_html__( 'General', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_colors',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_color_section_woocommerce', array(
		'title'			 => esc_html__( 'WooCommerce', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_colors',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_color_section_footer', array(
		'title'			 => esc_html__( 'Footer', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_colors',
		'priority'		 => 10,
	) );
}

add_action( 'customize_register', 'shoptimizer_kirki_section_color' );
