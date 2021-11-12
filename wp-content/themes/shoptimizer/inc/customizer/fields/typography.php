<?php
/**
 *
 * Typography theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'        => 'radio-image',
		'settings'    => 'shoptimizer_typography_presets',
		'label'       => esc_attr__( 'Select a Typography Preset', 'shoptimizer' ),
		'description' => esc_attr__( 'Change your font style with one click.', 'shoptimizer' ),
		'section'     => 'shoptimizer_typography_section_presets',
		'default'     => 'default-fonts',
		'choices'     => array(
			'default-fonts' => get_template_directory_uri() . '/inc/customizer/images/shoptimizer-classic.png',
			'inter-fonts'   => get_template_directory_uri() . '/inc/customizer/images/shoptimizer-inter.png',
			'web-safe'      => get_template_directory_uri() . '/inc/customizer/images/shoptimizer-websafe.png',
		),
		'preset'      => array(
			'default-fonts' => array(
				'settings' => array(
					'shoptimizer_typography_mainbody_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_mainmenu_level1_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_mainmenu_level2_family'   => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_mainmenu_heading_family'  => array(
						'font-family' => 'IBM Plex Sans',
						'variant'     => '600',
						'font-size'   => '16px',
						'color'       => '#111',
					),
					'shoptimizer_typography_p_fontfamily'  => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_h1_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_h2_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
						'variant'     => 'regular',
					),
					'shoptimizer_typography_h3_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_h4_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_h5_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_blockquote_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_widget_title_fontfamily' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_blog_post_title' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_woocommerce_archives_description' => array(
						'font-family' => 'IBM Plex Sans',
					),
					'shoptimizer_typography_woocommerce_listings_title' => array(
						'font-family' => 'IBM Plex Sans',
						'variant'     => '600',
					),
					'shoptimizer_typography_woocommerce_single_title' => array(
						'font-family' => 'IBM Plex Sans',
						'variant'     => '600',
					),
					'shoptimizer_typography_woocommerce_primary_button' => array(
						'font-family'    => 'IBM Plex Sans',
						'variant'        => '600',
						'text-transform' => 'none',
						'letter-spacing' => '-0.3px',
					),
				),
			),
			'inter-fonts'   => array(
				'settings' => array(
					'shoptimizer_typography_mainbody_fontfamily' => array(
						'font-family' => 'Inter',
						'font-size'   => '16px',
						'color'       => '#444',
					),
					'shoptimizer_mainmenu_level1_fontfamily' => array(
						'font-family'    => 'Inter',
						'variant'        => '500',
						'font-size'      => '15px',
						'letter-spacing' => '-0.1px',
					),
					'shoptimizer_mainmenu_level2_family'   => array(
						'font-family' => 'Inter',
						'font-size'   => '14px',
					),
					'shoptimizer_mainmenu_heading_family'  => array(
						'font-family'    => 'Inter',
						'variant'        => '600',
						'font-size'      => '12px',
						'letter-spacing' => '0.5px',
						'text-transform' => 'uppercase',
					),
					'shoptimizer_typography_p_fontfamily'  => array(
						'font-family' => 'Inter',
						'color'       => '#444',
						'font-size'   => '16px',
						'line-height' => '1.6',
					),
					'shoptimizer_typography_h1_fontfamily' => array(
						'font-family'    => 'Inter',
						'variant'        => '600',
						'font-size'      => '40px',
						'line-height'    => '1.3',
						'letter-spacing' => '-0.5px',
						'color'          => '#222',
					),
					'shoptimizer_typography_h2_fontfamily' => array(
						'font-family' => 'Inter',
						'variant'     => '600',
						'font-size'   => '28px',
						'line-height' => '1.4',
					),
					'shoptimizer_typography_h3_fontfamily' => array(
						'font-family' => 'Inter',
						'variant'     => '600',
						'font-size'   => '24px',
						'line-height' => '1.45',
					),
					'shoptimizer_typography_h4_fontfamily' => array(
						'font-family' => 'Inter',
						'variant'     => '600',
						'font-size'   => '20px',
						'line-height' => '1.6',
					),
					'shoptimizer_typography_h5_fontfamily' => array(
						'font-family' => 'Inter',
						'font-size'   => '18px',
						'line-height' => '1.6',
					),
					'shoptimizer_typography_blockquote_fontfamily' => array(
						'font-family' => 'Inter',
						'font-size'   => '20px',
						'line-height' => '1.45',
					),
					'shoptimizer_typography_widget_title_fontfamily' => array(
						'font-family'    => 'Inter',
						'font-size'      => '13px',
						'variant'        => '600',
						'letter-spacing' => '0.3px',
						'text-transform' => 'uppercase',
					),
					'shoptimizer_typography_blog_post_title' => array(
						'font-family'    => 'Inter',
						'variant'        => '600',
						'font-size'      => '36px',
						'line-height'    => '1.24',
						'letter-spacing' => '-0.6px',
					),
					'shoptimizer_typography_woocommerce_archives_description' => array(
						'font-family' => 'Inter',
						'font-size'   => '17px',
					),
					'shoptimizer_typography_woocommerce_listings_title' => array(
						'font-family' => 'Inter',
						'font-size'   => '15px',
						'font-weight' => '500',
					),
					'shoptimizer_typography_woocommerce_single_title' => array(
						'font-family'    => 'Inter',
						'variant'        => '600',
						'font-size'      => '32px',
						'letter-spacing' => '-0.5px',
					),
					'shoptimizer_typography_woocommerce_primary_button' => array(
						'font-family'    => 'Inter',
						'variant'        => '600',
						'text-transform' => 'none',
						'letter-spacing' => '-0.3px',
					),
				),
			),
			'web-safe'      => array(
				'settings' => array(
					'shoptimizer_typography_mainbody_fontfamily' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_mainmenu_level1_fontfamily' => array(
						'font-family'    => 'sans-serif',
						'font-size'      => '15px',
						'letter-spacing' => '0px',
					),
					'shoptimizer_mainmenu_level2_family'   => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_mainmenu_heading_family'  => array(
						'font-family'    => 'sans-serif',
						'letter-spacing' => '0px',
						'variant'        => '600',
						'font-size'      => '15px',
						'color'          => '#111',
					),
					'shoptimizer_typography_p_fontfamily'  => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_h1_fontfamily' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_h2_fontfamily' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_h3_fontfamily' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_h4_fontfamily' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_h5_fontfamily' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_blockquote_fontfamily' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_widget_title_fontfamily' => array(
						'font-family' => 'sans-serif',
						'font-size'   => '15px',
						'font-weight' => '600',
					),
					'shoptimizer_typography_blog_post_title' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_woocommerce_archives_description' => array(
						'font-family' => 'sans-serif',
					),
					'shoptimizer_typography_woocommerce_listings_title' => array(
						'font-family' => 'sans-serif',
						'font-size'   => '15px',
						'font-weight' => '600',
					),
					'shoptimizer_typography_woocommerce_single_title' => array(
						'font-family' => 'sans-serif',
						'font-weight' => '600',
					),
					'shoptimizer_typography_woocommerce_primary_button' => array(
						'font-family'    => 'sans-serif',
						'font-weight'    => '600',
						'text-transform' => 'none',
						'letter-spacing' => '-0.3px',
					),

				),
			),
		),
	)
);

// Main body fields.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_mainbody_fontfamily',
		'label'    => esc_html__( 'Font settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_mainbody',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#444',
		),
		'priority' => 10,
		'output'   => array(
			array(
				'element'  => 'body, button, input, select, option, textarea, h6',
				'property' => 'font-family',
			),
			array(
				'element'  => '.wp-block-button__link, figcaption, .wp-block-table, .wp-block-pullquote__citation',
				'property' => 'font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

// Main Navigation Level 1 Menu Font.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_mainmenu_level1_fontfamily',
		'label'    => esc_html__( 'Primary Navigation Font', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_navigation',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'letter-spacing' => '-0.3px',
		),
		'priority' => 60,
		'output'   => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a, .site-header-cart .cart-contents',
				'property' => 'font-family',
			),
		),
	)
);

// Main Navigation Level 2 Menu Font.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_mainmenu_level2_family',
		'label'    => esc_html__( 'Navigation Dropdown Font', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_navigation',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '15px',
			'text-transform' => 'none',
		),
		'priority' => 60,
		'output'   => array(
			array(
				'element'  => '.main-navigation ul.menu ul li > a, .main-navigation ul.nav-menu ul li > a',
				'property' => 'font-family',
			),
		),
	)
);

// Main Navigation Heading Font within Megamenus.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_mainmenu_heading_family',
		'label'    => esc_html__( 'Mega Menu Heading Font', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_navigation',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'letter-spacing' => '-0.1px',
			'color'          => '#111',
		),
		'priority' => 60,
		'output'   => array(
			array(
				'element'  => '.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.menu-item-has-children > a, .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.heading > a',
				'property' => 'font-family',
			),
		),
	)
);

// Paragraph.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_p_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_p',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '17px',
			'line-height'    => '1.6',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#444',
			'text-transform' => 'none',
		),
		'priority' => 20,
		'output'   => array(
			array(
				'element'  => '.entry-content',
				'property' => 'font-family',
			),
			array(
				'element'  => '.edit-post-visual-editor.editor-styles-wrapper',
				'property' => 'font-family',
				'context'  => array( 'editor' ),
			),
		),
	)
);

// h1.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h1_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h1',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '40px',
			'line-height'    => '1.3',
			'letter-spacing' => '-0.5px',
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 20,
		'output'   => array(
			array(
				'element'  => 'h1',
				'property' => 'font-family',
			),
			array(
				'element'  => '.editor-post-title__input',
				'property' => 'font-family',
				'context'  => array( 'editor' ),
			),
		),
	)
);

// h2.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h2_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h2',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '28px',
			'line-height'    => '1.4',
			'letter-spacing' => '-0.5px',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 30,
		'output'   => array(
			array(
				'element'  => 'h2',
				'property' => 'font-family',
			),
			array(
				'element'  => '.wp-block-heading h2',
				'property' => 'font-family',
				'context'  => array( 'editor' ),
			),
		),
	)
);


// h3.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h3_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h3',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '24px',
			'line-height'    => '1.45',
			'letter-spacing' => '-0.3px',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 40,
		'output'   => array(
			array(
				'element'  => 'h3',
				'property' => 'font-family',
			),
			array(
				'element'  => '.wp-block-heading h3',
				'property' => 'font-family',
				'context'  => array( 'editor' ),
			),
		),
	)
);


// h4.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h4_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h4',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '20px',
			'line-height'    => '1.6',
			'letter-spacing' => '0px',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 50,
		'output'   => array(
			array(
				'element'  => 'h4',
				'property' => 'font-family',
			),
			array(
				'element'  => '.wp-block-heading h4',
				'property' => 'font-family',
				'context'  => array( 'editor' ),
			),
		),
	)
);


// h5.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h5_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h5',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '18px',
			'line-height'    => '1.6',
			'letter-spacing' => '0px',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 60,
		'output'   => array(
			array(
				'element'  => 'h5',
				'property' => 'font-family',
			),
		),
	)
);

// Blockquote.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_blockquote_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_blockquote',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '20px',
			'line-height'    => '1.45',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => 'blockquote p',
				'property' => 'font-family',
			),
			array(
				'element'  => '.edit-post-visual-editor.editor-styles-wrapper .wp-block-quote p, .edit-post-visual-editor.editor-styles-wrapper .wp-block-quote',
				'property' => 'font-family',
				'context'  => array( 'editor' ),
			),
		),
	)
);

// Widget Titles.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_widget_title_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_widget_title',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '15px',
			'line-height'    => '1.5',
			'letter-spacing' => '0px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => '.widget .widget-title, .widget .widgettitle',
				'property' => 'font-family',
			),
		),
	)
);


// Blog Post Title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_blog_post_title',
		'label'    => esc_html__( 'Blog Post Title', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_blog',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '36px',
			'line-height'    => '1.24',
			'letter-spacing' => '-0.6px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => 'body.single-post h1',
				'property' => 'font-family',
			),
		),
	)
);

// WooCommerce.
// Archives Category Description.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_archives_description',
		'label'    => esc_html__( 'Archives Category Description', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '17px',
			'letter-spacing' => '-0.1px',
			'line-height'    => '25px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => '.term-description, .shoptimizer-category-banner .taxonomy-description',
				'property' => 'font-family',
			),
		),
	)
);

// Archives Product Title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_listings_title',
		'label'    => esc_html__( 'Archives Product Title', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '15px',
			'letter-spacing' => '0px',
			'line-height'    => '20px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => '.content-area ul.products li.product .woocommerce-loop-product__title, .content-area ul.products li.product h2,
			ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-product__title,
			.main-navigation ul.menu ul li.product .woocommerce-loop-product__title a',
				'property' => 'font-family',
			),
		),
	)
);


// Single Product Title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_single_title',
		'label'    => esc_html__( 'Single Product Title', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '32px',
			'letter-spacing' => '-0.5px',
			'line-height'    => '38px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'     => '.summary h1',
				'property'    => 'font-family',
				'media_query' => '@media (min-width: 770px)',
			),
		),
	)
);

// Primary Buttons.
shoptimizer_Kirki::add_field(
	'shoptimizer_config',
	array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_primary_button',
		'label'    => esc_html__( 'Primary Buttons', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '18px',
			'letter-spacing' => '0px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => 'body .woocommerce #respond input#submit.alt, 
			body .woocommerce a.button.alt, 
			body .woocommerce button.button.alt, 
			body .woocommerce input.button.alt,
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.widget_shopping_cart a.button.checkout',
				'property' => 'font-family',
			),
		),
	)
);
