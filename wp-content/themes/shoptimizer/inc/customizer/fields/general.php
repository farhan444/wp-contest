<?php
/**
 *
 * General theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// General fields.
$shoptimizer_default_options = shoptimizer_get_option_defaults();

// Header Logo Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_logo_height',
		'label'       => esc_html__( 'Logo height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the height of your logo in pixels. You can upload your logo image within the "Site Identity" panel.', 'shoptimizer' ),
		'section'     => 'shoptimizer_section_general_logo',
		'default'     => 38,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		),
		'active_callback'  => [
			[
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			],
		],	
		'output'      => array(
			array(
				'element'  => '.site-header .custom-logo-link img',
				'property' => 'height',
				'units'    => 'px',
			),
		),
	)
);

// Header 4 (One row) Logo Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_logo_height_header4',
		'label'       => esc_html__( 'Logo height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the height of your logo in pixels. You can upload your logo image within the "Site Identity" panel.', 'shoptimizer' ),
		'section'     => 'shoptimizer_section_general_logo',
		'default'     => 30,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		),
		'active_callback'  => [
			[
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '==',
			],
		],	
		'output'      => array(
			array(
				'element'  => '.header-4 .site-header .custom-logo-link img',
				'property' => 'height',
				'units'    => 'px',
			),
		),
	)
);

// Display tagline under logo.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'toggle',
		'settings' => 'shoptimizer_tagline_display',
		'label'    => esc_attr__( 'Display tagline under logo', 'shoptimizer' ),
		'description'    => esc_attr__( 'This is set within Settings > General', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_logo',
		'default'  => $shoptimizer_default_options['shoptimizer_tagline_display'],
		'priority'  => 10,
		'transport' => 'refresh',
	)
);


// Sticky Logo Image.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'image',
		'settings' => 'shoptimizer_logo_mark_image',
		'label'    => esc_html__( 'Sticky logo', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_sticky_logo',
		'default'  => $shoptimizer_default_options['shoptimizer_logo_mark_image'],
		'priority' => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			),
		),
	)
);


// Sticky Logo Image Width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'slider',
		'settings' => 'shoptimizer_sticky_logo_width',
		'label'    => esc_html__( 'Sticky logo width', 'shoptimizer' ),
		'description'    => esc_attr__( 'Suggested width of at least 60', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_sticky_logo',
		'default'  => 60,
		'priority' => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			),
		),
		'choices'  => array(
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		),
		'output'   => array(
			array(
				'element'  => '.is_stuck .logo-mark',
				'property' => 'width',
				'units'    => 'px',
			),
			array(
				'element'  => '.is_stuck .primary-navigation.with-logo .menu-primary-menu-container',
				'property' => 'margin-left',
				'units'    => 'px',
			),
		),
	)
);

// Mobile Header Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_mobile_header_height',
		'label'       => esc_html__( 'Mobile header height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust height of your mobile header (px)', 'shoptimizer' ),
		'section'     => 'shoptimizer_section_general_mobile_header',
		'default'     => 70,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => '.main-header, .site-branding',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'       => '.main-header .site-header-cart',
				'value_pattern' => 'calc(-14px + $px / 2)',
				'property'      => 'top',
				'units'         => '',
				'media_query'   => '@media (max-width: 992px)',
			),

		),
	)
);

// Mobile Logo Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_mobile_logo_height',
		'label'       => esc_html__( 'Mobile logo height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust height of your mobile logo (px)', 'shoptimizer' ),
		'section'     => 'shoptimizer_section_general_mobile_header',
		'default'     => 22,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => 'body.theme-shoptimizer .site-header .custom-logo-link img,
				body.wp-custom-logo .site-header .custom-logo-link img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);

// Mobile Sticky Header.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_sticky_mobile_header',
		'label'    => esc_attr__( 'Mobile sticky header', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_mobile_header',
		'default'  => $shoptimizer_default_options['shoptimizer_sticky_mobile_header'],
		'choices'  => array(
			'enable' => esc_attr__( 'Enable', 'shoptimizer' ),
			'disable'  => esc_attr__( 'Disable', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Display Search on Mobile.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_search_mobile',
		'label'     => esc_html__( 'Show search on mobile', 'shoptimizer' ),
		'section'   => 'shoptimizer_section_general_mobile_header',
		'default'  => $shoptimizer_default_options['shoptimizer_search_mobile'],
		'choices'  => array(
			'enable' => esc_attr__( 'Enable', 'shoptimizer' ),
			'disable'  => esc_attr__( 'Disable', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Mobile Search Position.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_search_mobile_position',
		'label'     => esc_html__( 'Mobile search position', 'shoptimizer' ),
		'section'   => 'shoptimizer_section_general_mobile_header',
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_search_mobile',
				'value'    => 'enable',
				'operator' => '==',
			),
		),
		'choices'  => array(
			'within-navigation' => esc_attr__( 'Within navigation', 'shoptimizer' ),
			'below-header'  => esc_attr__( 'Below header bar', 'shoptimizer' ),
			'toggle'  => esc_attr__( 'Header icon and toggle', 'shoptimizer' ),
		),
		'priority' => 10,
	)
);

// Display My Account on Mobile.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_mobile_myaccount',
		'label'     => esc_html__( 'Show my account on mobile', 'shoptimizer' ),
		'section'   => 'shoptimizer_section_general_mobile_header',
		'default'  => $shoptimizer_default_options['shoptimizer_mobile_myaccount'],
		'choices'  => array(
			'enable' => esc_attr__( 'Enable', 'shoptimizer' ),
			'disable'  => esc_attr__( 'Disable', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Display Mobile Menu label.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_mobile_menu_text_display',
		'label'    => esc_attr__( 'Display mobile menu label', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_mobile_header',
		'default'  => $shoptimizer_default_options['shoptimizer_mobile_menu_text_display'],
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Mobile Menu label text.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'text',
		'settings'  => 'shoptimizer_mobile_menu_text',
		'label'     => esc_html__( 'Mobile menu label text', 'shoptimizer' ),
		'section'   => 'shoptimizer_section_general_mobile_header',
		'default'   => $shoptimizer_default_options['shoptimizer_mobile_menu_text'],
		'priority'  => 10,
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_mobile_menu_text_display',
				'value'    => 'yes',
				'operator' => '==',
			),
		),
		'js_vars'   => array(
			array(
				'element'  => '.bar-text',
				'function' => 'html',
			),
		),
	)
);

// Critical CSS Settings.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_general_speed_heading_1',
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Critical CSS', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Critical CSS.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_general_speed_critical_css',
		'label'    => esc_attr__( 'Enable critical CSS?', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => 'no',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);


// Minification Settings.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_general_speed_heading_2',
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Minification Settings', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Main CSS Minified.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_general_speed_minify_main_css',
		'label'    => esc_attr__( 'Load minified CSS files?', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => 'yes',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),
		),
		'priority' => 10,
	)
);

// Icon Font.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_general_speed_heading_3',
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Icon Font', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Rivolicons.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_general_speed_rivolicons',
		'label'    => esc_attr__( 'Load Rivolicons icon font?', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => 'no',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),
		),
		'priority' => 10,
	)
);

