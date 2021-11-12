<?php
/**
 *
 * Kirki general section
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */
function shoptimizer_kirki_section_general( $wp_customize ) {

	$wp_customize->add_section(
		'shoptimizer_section_general_logo', array(
			'title'    => esc_html__( 'Site Logo', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_general',
			'priority' => 10,
		)
	);

	$wp_customize->add_section(
		'shoptimizer_section_general_sticky_logo', array(
			'title'    => esc_html__( 'Sticky Logo', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_general',
			'priority' => 10,
		)
	);

	$wp_customize->add_section(
		'shoptimizer_section_general_speed_settings', array(
			'title'    => esc_html__( 'Speed Settings', 'shoptimizer' ),
			'panel'    => 'shoptimizer_panel_general',
			'priority' => 10,
		)
	);
}

add_action( 'customize_register', 'shoptimizer_kirki_section_general' );
