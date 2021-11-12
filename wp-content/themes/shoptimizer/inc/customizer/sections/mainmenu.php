<?php
/**
 *
 * Kirki menu section
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */
function shoptimizer_kirki_section_mainmenu( $wp_customize ) {

	// Top Bar.
	$wp_customize->add_section( 'shoptimizer_header_section_top_bar', array(
		'title'			 => esc_html__( 'Top Bar', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_mainmenu',
		'priority'		 => 10,
	) );

	// Header Layout.
	$wp_customize->add_section( 'shoptimizer_header_section_layout', array(
		'title'			 => esc_html__( 'Header', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_mainmenu',
		'priority'		 => 10,
	) );

	// Mobile Header
	$wp_customize->add_section(
	'shoptimizer_section_general_mobile_header', array(
		'title'    => esc_html__( 'Mobile Header', 'shoptimizer' ),
		'panel'    => 'shoptimizer_panel_mainmenu',
		'priority' => 10,
	)
	);

	// Navigation.
	$wp_customize->add_section( 'shoptimizer_navigation_section_layout', array(
		'title'			 => esc_html__( 'Navigation', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_mainmenu',
		'priority'		 => 10,
	) );

	// Cart.
	$wp_customize->add_section( 'shoptimizer_cart_section_layout', array(
		'title'			 => esc_html__( 'Cart', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_mainmenu',
		'priority'		 => 10,
	) );

	// Responsive Breakpoint.
	$wp_customize->add_section( 'shoptimizer_mainmenu_section_responsive_breakpoint', array(
		'title'			 => esc_html__( 'Responsive Breakpoint', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_mainmenu',
		'priority'		 => 10,
	) );
}

add_action( 'customize_register', 'shoptimizer_kirki_section_mainmenu' );
