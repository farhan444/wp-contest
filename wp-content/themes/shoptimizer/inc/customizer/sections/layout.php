<?php
/**
 *
 * Kirki layout section
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */
function shoptimizer_kirki_section_layout( $wp_customize ) {

	$wp_customize->add_section( 'shoptimizer_layout_section_general', array(
		'title'			 => esc_html__( 'General', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_layout',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_layout_section_sidebars', array(
		'title'			 => esc_html__( 'Sidebars', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_layout',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_layout_section_blog', array(
		'title'			 => esc_html__( 'Blog', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_layout',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_layout_section_woocommerce', array(
		'title'			 => esc_html__( 'WooCommerce', 'shoptimizer' ),
		'description'	 => esc_html__( 'Publish and refresh to see the changes.', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_layout',
		'priority'		 => 10,
	) );

	$wp_customize->add_section( 'shoptimizer_layout_section_footer', array(
		'title'			 => esc_html__( 'Footer', 'shoptimizer' ),
		'panel'			 => 'shoptimizer_panel_layout',
		'priority'		 => 10,
	) );
}

add_action( 'customize_register', 'shoptimizer_kirki_section_layout' );
