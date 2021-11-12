<?php
/**
 *
 * Main menu theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Main Menu.
$shoptimizer_default_options = shoptimizer_get_option_defaults();

// Display top bar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_layout_top_bar_display',
		'label'       => esc_html__( 'Display top bar?', 'shoptimizer' ),
		'description' => esc_html__( 'Enable or disable the top bar', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_top_bar',
		'default'     => $shoptimizer_default_options['shoptimizer_layout_top_bar_display'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'enable'  => esc_html__( 'Enable', 'shoptimizer' ),
			'disable' => esc_html__( 'Disable', 'shoptimizer' ),
		),
	)
);

// Show or hide top bar on mobile.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_layout_top_bar_mobile',
		'label'       => esc_html__( 'Hide top bar on mobile?', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_top_bar',
		'default'     => $shoptimizer_default_options['shoptimizer_layout_top_bar_mobile'],
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_layout_top_bar_display',
				'value'    => 'enable',
				'operator' => '==',
			),
		),
		'transport'   => 'refresh',
		'choices'     => array(
			'show'  => esc_html__( 'Show', 'shoptimizer' ),
			'hide' => esc_html__( 'Hide', 'shoptimizer' ),
		),
	)
);


// Header Layout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_header_layout',
		'label'       => esc_html__( 'Header Layout', 'shoptimizer' ),
		'description' => esc_html__( 'Change the header layout', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => $shoptimizer_default_options['shoptimizer_header_layout'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'default'  => esc_html__( 'Logo / Search / Secondary', 'shoptimizer' ),
			'header-5' => esc_html__( 'Logo / Search / Secondary / Cart', 'shoptimizer' ),
			'header-2' => esc_html__( 'Search / Logo / Secondary', 'shoptimizer' ),
			'header-3' => esc_html__( 'Secondary / Logo / Search', 'shoptimizer' ),
			'header-4' => esc_html__( 'Logo / Navigation / Cart', 'shoptimizer' ),			
		),
	)
);

// Header Layout Contained or Full Width
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_header_layout_container',
		'label'       => esc_html__( 'Header Container', 'shoptimizer' ),
		'description' => esc_html__( 'Change the header container', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => $shoptimizer_default_options['shoptimizer_header_layout_container'],
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '==',
			),
		),
		'transport'   => 'refresh',
		'choices'     => array(
			'contained'  => esc_html__( 'Contained', 'shoptimizer' ),
			'full-width-header' => esc_html__( 'Full width', 'shoptimizer' ),
		),
	)
);


// Header Padding Top.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_header_top_padding',
		'label'       => esc_html__( 'Header Top Padding', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the header top padding', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => 30,
		'priority'    => 1,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			),
		),
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => '.col-full.main-header',
				'property'    => 'padding-top',
				'units'       => 'px',
				'media_query' => '@media (min-width: 993px)',
			),

		),
	)
);

// Header Padding Bottom.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_header_bottom_padding',
		'label'       => esc_html__( 'Header Bottom Padding', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the header bottom padding', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => 30,
		'priority'    => 1,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			),
		),
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => '.col-full.main-header',
				'property'    => 'padding-bottom',
				'units'       => 'px',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Header Height - Only for header-4 layout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_header_height',
		'label'       => esc_html__( 'Header Height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the header height', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => 90,
		'priority'    => 1,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '==',
			),
		),
		'choices'     => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => '.header-4 .header-4-container',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (min-width: 993px)',
			),
			array(
				'element'     => '.header-4 .menu-primary-menu-container > ul > li > a, .header-4 .search-trigger',
				'property'    => 'line-height',
				'units'       => 'px',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Display the search.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_layout_search_display',
		'label'       => esc_html__( 'Display the search?', 'shoptimizer' ),
		'description' => esc_html__( 'Enable or disable the search', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => $shoptimizer_default_options['shoptimizer_layout_search_display'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'enable'  => esc_html__( 'Product Search', 'shoptimizer' ),
			'ajax-search-wc'  => esc_html__( 'Ajax Search for WooCommerce Plugin', 'shoptimizer' ),
			'regular'  => esc_html__( 'Regular Search', 'shoptimizer' ),
			'disable' => esc_html__( 'Disable', 'shoptimizer' ),
		),
	)
);

// Search title. Only if header-4 is selected.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'text',
		'settings'  => 'shoptimizer_layout_search_title',
		'label'     => esc_html__( 'Search modal title', 'shoptimizer' ),
		'description' => esc_html__( 'Default: Recently added', 'shoptimizer' ),
		'section'   => 'shoptimizer_header_section_layout',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_search_title'],
		'priority'  => 10,
		'transport' => 'auto',
		'active_callback'  => [
			[
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '==',
			],
		],	
		'js_vars'   => array(
			array(
				'element'  => '.search-modal-heading',
				'function' => 'html',
			),
		),
	)
);


// Navigation Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_navigation_height',
		'label'       => esc_html__( 'Navigation Height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the navigation height', 'shoptimizer' ),
		'section'     => 'shoptimizer_navigation_section_layout',
		'default'     => 60,
		'priority'    => 1,
		'active_callback'  => [
			[
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			],
		],	
		'choices'     => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a, .site-header-cart, .logo-mark',
				'property' => 'line-height',
				'units'    => 'px',
				'media_query' => '@media (min-width: 993px)',
			),
			array(
				'element'  => '.site-header-cart, .menu-primary-menu-container > ul > li.menu-button',
				'property' => 'height',
				'units'    => 'px',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Display menu descriptions
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_menu_display_description',
		'label'     => esc_html__( 'Display menu descriptions', 'shoptimizer' ),
		'section'   => 'shoptimizer_navigation_section_layout',
		'default'   => 0,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);


// Sticky Navigation.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_sticky_header',
		'label'       => esc_html__( 'Sticky Navigation', 'shoptimizer' ),
		'description' => esc_html__( 'Stick the navigation on scroll', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => $shoptimizer_default_options['shoptimizer_sticky_header'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'enable'  => esc_html__( 'Enable', 'shoptimizer' ),
			'disable' => esc_html__( 'Disable', 'shoptimizer' ),
		),
	)
);

// Mobile Sticky Header
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_sticky_mobile_header',
		'label'    => esc_attr__( 'Mobile Sticky Header', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_mobile_header',
		'default'  => $shoptimizer_default_options['shoptimizer_sticky_mobile_header'],
		'choices'  => array(
			'enable' => esc_attr__( 'Enable', 'shoptimizer' ),
			'disable'  => esc_attr__( 'Disable', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);


// Main Navigation Links Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_color',
		'label'     => esc_html__( 'Navigation links', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_color'],
		'priority'  => 10,
		'active_callback'  => [
			[
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			],
		],	
		'output'    => array(
			array(
				'element'     => '.menu-primary-menu-container > ul > li > a',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
			array(
				'element'     => '.main-navigation ul.menu > li.menu-item-has-children > a::after',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.menu-primary-menu-container > ul > li > a',
				'function'    => 'css',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
			array(
				'element'     => '.main-navigation ul.menu > li.menu-item-has-children > a::after',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Header 4 (One row) Navigation Links Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_color_header_4',
		'label'     => esc_html__( 'Navigation links', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_color_header_4'],
		'priority'  => 10,
		'active_callback'  => [
			[
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '==',
			],
		],	
		'output'    => array(
			array(
				'element'     => '.header-4 .menu-primary-menu-container > ul > li > a, .header-4 .site-header-cart .cart-contents .amount, .header-4 .search-trigger, .header-4 .search-trigger:hover',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
			array(
				'element'     => '.main-navigation ul.menu > li.menu-item-has-children > a::after, .main-navigation ul.menu > li.page_item_has_children > a::after, .main-navigation ul.nav-menu > li.menu-item-has-children > a::after, .main-navigation ul.nav-menu > li.page_item_has_children > a::after',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.header-4 .menu-primary-menu-container > ul > li > a, .header-4 .site-header-cart .cart-contents .amount, .header-4 .search-trigger, .header-4 .search-trigger:hover',
				'function'    => 'css',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
			array(
				'element'     => '.main-navigation ul.menu > li.menu-item-has-children > a::after, .main-navigation ul.menu > li.page_item_has_children > a::after, .main-navigation ul.nav-menu > li.menu-item-has-children > a::after, .main-navigation ul.nav-menu > li.page_item_has_children > a::after',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Main Navigation Links Hover/Selected Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_color_hover',
		'label'     => esc_html__( 'Navigation links hover/selected', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_color_hover'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a span:before',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a span:before',
				'property' => 'border-color',
			),
		),
	)
);

// Fade out other menu items on hover.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_navigation_color_other_hover',
		'label'       => esc_html__( 'Fade out other links on hover', 'shoptimizer' ),
		'description' => esc_html__( 'Opacity (%).', 'shoptimizer' ),
		'section'     => 'shoptimizer_color_section_navigation',
		'default'     => 0.65,
		'priority'    => 1,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			),
		),
		'choices'     => array(
			'min'  => 0,
			'max'  => 1,
			'step' => 0.01,
		),
		'output'      => array(
			array(
				'element'  => '.menu-primary-menu-container > ul.menu:hover > li > a',
				'property' => 'opacity',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_colors_navigation_heading_1',
		'section'  => 'shoptimizer_color_section_navigation',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Dropdowns', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Navigation Dropdown Background Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_dropdown_background',
		'label'     => esc_html__( 'Navigation dropdown background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_dropdown_background'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'     => '.main-navigation ul.menu ul.sub-menu',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.main-navigation ul.menu ul.sub-menu',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Navigation Dropdown Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_dropdown_color',
		'label'     => esc_html__( 'Navigation dropdown text', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_dropdown_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'     => '.main-navigation ul.menu ul li a, .main-navigation ul.nav-menu ul li a',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.main-navigation ul.menu ul li a, .main-navigation ul.nav-menu ul li a',
				'function'    => 'css',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Main Navigation Dropdown Hover Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_dropdown_hover_color',
		'label'     => esc_html__( 'Navigation dropdown hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_dropdown_hover_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'     => '.main-navigation ul.menu ul a:hover',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.main-navigation ul.menu ul a:hover',
				'function'    => 'css',
				'property'    => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_colors_navigation_heading_2',
		'section'  => 'shoptimizer_color_section_navigation',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Secondary Navigation', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Secondary Navigation Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_secondary_navigation_color',
		'label'     => esc_html__( 'Secondary navigation color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_secondary_navigation_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.secondary-navigation .menu a, .ri.menu-item:before, .fa.menu-item:before',
				'property' => 'color',
			),
			array(
				'element'  => '.secondary-navigation .icon-wrapper svg',
				'property' => 'stroke',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.secondary-navigation .menu a, .ri.menu-item:before, .fa.menu-item:before',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '.secondary-navigation .icon-wrapper svg',
				'property' => 'stroke',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_colors_navigation_heading_3',
		'section'  => 'shoptimizer_color_section_navigation',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Cart', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Navigation Cart Icon Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_cart_icon_color',
		'label'     => esc_html__( 'Cart icon', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_cart_icon_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.site-header-cart a.cart-contents .count, .site-header-cart a.cart-contents .count:after',
				'property' => 'border-color',
			),
			array(
				'element'  => '.site-header-cart a.cart-contents .count, .shoptimizer-cart-icon i',
				'property' => 'color',
			),
			array(
				'element'  => '.site-header-cart a.cart-contents:hover .count, .site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
			),
			array(
				'element'  => '.shoptimizer-cart-icon svg',
				'property' => 'stroke',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-header-cart a.cart-contents .count, .site-header-cart a.cart-contents .count:after',
				'function' => 'css',
				'property' => 'border-color',
			),
			array(
				'element'  => '.site-header-cart a.cart-contents .count, .shoptimizer-cart-icon i',
				'property' => 'color',
			),
			array(
				'element'  => '.site-header-cart a.cart-contents:hover .count, .site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
			),
			array(
				'element'  => '.shoptimizer-cart-icon svg',
				'property' => 'stroke',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Navigation Cart Text Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_cart_color',
		'label'     => esc_html__( 'Cart text', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_cart_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.site-header-cart .cart-contents',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-header-cart .cart-contents',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Navigation Cart Hover Text Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_cart_hover_color',
		'label'     => esc_html__( 'Cart text hover color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_cart_hover_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.site-header-cart a.cart-contents:hover .count',
				'property' => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-header-cart a.cart-contents:hover .count',
				'function' => 'css',
				'property' => 'color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Display Cart in Menu.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_cart',
		'label'     => esc_html__( 'Display cart', 'shoptimizer' ),
		'section'   => 'shoptimizer_cart_section_layout',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Cart Icon.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_layout_woocommerce_cart_icon',
		'label'       => esc_html__( 'Cart icon', 'shoptimizer' ),
		'description' => esc_html__( 'After switching, test in an incognito window. The previous selection will be likely cached as a fragment.', 'shoptimizer' ),
		'section'     => 'shoptimizer_cart_section_layout',
		'default'     => $shoptimizer_default_options['shoptimizer_layout_woocommerce_cart_icon'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'basket'  => esc_html__( 'Basket (Default)', 'shoptimizer' ),
			'cart' => esc_html__( 'Cart icon', 'shoptimizer' ),
			'bag' => esc_html__( 'Bag icon', 'shoptimizer' ),
		),
	)
);

// Cart sidebar Title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'text',
		'settings'  => 'shoptimizer_cart_title',
		'label'     => esc_html__( 'Cart sidebar title', 'shoptimizer' ),
		'section'   => 'shoptimizer_cart_section_layout',
		'default'   => $shoptimizer_default_options['shoptimizer_cart_title'],
		'priority'  => 10,
		'transport' => 'auto',
		'js_vars'   => array(
			array(
				'element'  => '.cart-drawer-heading',
				'function' => 'html',
			),
		),
	)
);

// Cart sidebar below text.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'textarea',
		'settings'  => 'shoptimizer_cart_below_text',
		'label'     => esc_html__( 'Cart sidebar below text', 'shoptimizer' ),
		'section'   => 'shoptimizer_cart_section_layout',
		'default'   => $shoptimizer_default_options['shoptimizer_cart_below_text'],
		'priority'  => 10,
		'transport' => 'auto',
		'js_vars'   => array(
			array(
				'element'  => '.cart-drawer-below',
				'function' => 'html',
			),
		),
	)
);

