<?php
/**
 *
 * Kirki options panels
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */
function shoptimizer_kirki_panels( $wp_customize ) {

	$wp_customize->add_panel( 'shoptimizer_panel_general', array(
		'priority'		 => 10,
		'title'			 => esc_html__( 'General', 'shoptimizer' ),
		'description'	 => esc_html__( 'Manage general theme settings', 'shoptimizer' ),
	) );
	$wp_customize->add_panel( 'shoptimizer_panel_colors', array(
		'priority'		 => 10,
		'title'			 => esc_html__( 'Colors', 'shoptimizer' ),
		'description'	 => esc_html__( 'Manage theme colors', 'shoptimizer' ),
	) );
	$wp_customize->add_panel( 'shoptimizer_panel_mainmenu', array(
		'priority'		 => 10,
		'title'			 => esc_html__( 'Header and Navigation', 'shoptimizer' ),
		'description'	 => esc_html__( 'Manage the header and navigation', 'shoptimizer' ),
	) );
	$wp_customize->add_panel( 'shoptimizer_panel_heading', array(
		'priority'		 => 10,
		'title'			 => esc_html__( 'Page Heading', 'shoptimizer' ),
		'description'	 => esc_html__( 'Manage the page heading', 'shoptimizer' ),
	) );
	$wp_customize->add_panel( 'shoptimizer_panel_typography', array(
		'priority'		 => 10,
		'title'			 => esc_html__( 'Typography', 'shoptimizer' ),
		'description'	 => esc_html__( 'Manage theme typography', 'shoptimizer' ),
	) );
	$wp_customize->add_panel( 'shoptimizer_panel_layout', array(
		'priority'		 => 10,
		'title'			 => esc_html__( 'Layout', 'shoptimizer' ),
		'description'	 => esc_html__( 'Manage theme header, footer and more', 'shoptimizer' ),
	) );
	$wp_customize->add_panel( 'shoptimizer_panel_blog', array(
		'priority'		 => 10,
		'title'			 => esc_html__( 'Blog', 'shoptimizer' ),
		'description'	 => esc_html__( 'Manage blog settings', 'shoptimizer' ),
	) );
}

add_action( 'customize_register', 'shoptimizer_kirki_panels' );
