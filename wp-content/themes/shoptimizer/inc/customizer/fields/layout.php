<?php
/**
 *
 * Layout theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Layout fields.
$shoptimizer_default_options = shoptimizer_get_option_defaults();

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_general_heading_1',
		'section'  => 'shoptimizer_layout_section_general',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Wrapper', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_layout_wrapper',
		'label'    => esc_attr__( 'Contain the grid?', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_general',
		'default'  => 'no',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Wrapper width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_wrapper_width_nb',
		'label'       => esc_html__( 'Wraper container width', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust wrapper width in px.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_general',
		'default'     => 2170,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 992,
			'max'  => 3000,
			'step' => 1,
		),
		'active_callback'    => array(
			array(
				'setting'  => 'shoptimizer_layout_wrapper',
				'value'    => 'yes',
				'operator' => '==',
			),
		),
		'output'      => array(
			array(
				'element'  => '#page',
				'property' => 'max-width',
				'units'    => 'px',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_general_heading_2',
		'section'  => 'shoptimizer_layout_section_general',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Content container', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Content Container width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_container_width',
		'label'       => esc_html__( 'Content container width', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the width of your content container in pixels. Default is 1170px.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_general',
		'default'     => 1170,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 992,
			'max'  => 2000,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '.col-full, .single-product .site-content .shoptimizer-sticky-add-to-cart .col-full, body .woocommerce-message',
				'property' => 'max-width',
				'units'    => 'px',
			),
			array(
				'element'       => '
			.product-details-wrapper,
			.single-product .woocommerce-Tabs-panel,
			.single-product .archive-header .woocommerce-breadcrumb,
			.related.products,
			#sspotReviews,
			.upsells.products',
				'value_pattern' => 'calc($px + 5.2325em)',
				'property'      => 'max-width',
				'units'         => '',
			),
			array(
				'element'       => '.main-navigation ul li.menu-item-has-children.full-width .container',
				'property'      => 'max-width',
				'units'         => 'px',
			),
			array(
				'element'       => '.below-content .col-full, footer .col-full',
				'value_pattern' => 'calc($px + 40px)',
				'property'      => 'max-width',
				'units'         => '',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_general_heading_3',
		'section'  => 'shoptimizer_layout_section_general',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Breadcrumbs', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Display Breadcrumbs.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_breadcrumbs',
		'label'     => esc_html__( 'Display breadcrumbs', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_general',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Breadcrumbs type.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_layout_woocommerce_breadcrumbs_type',
		'label'    => esc_attr__( 'Breadcrumbs type', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_general',
		'default'  => $shoptimizer_default_options['shoptimizer_layout_woocommerce_breadcrumbs_type'],
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_layout_woocommerce_display_breadcrumbs',
				'value'    => true,
				'operator' => '==',
			),
		),
		'choices'  => array(
			'default' => esc_attr__( 'Default', 'shoptimizer' ),
			'rankmath'  => esc_attr__( 'Rank Math Breadcrumbs', 'shoptimizer' ),
			'seopress'  => esc_attr__( 'SEOPress Breadcrumbs', 'shoptimizer' ),
			'yoast'  => esc_attr__( 'Yoast Breadcrumbs', 'shoptimizer' ),
		),
		'priority' => 10,
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_1',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'General', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Enable sidebar cart drawer.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_enable_sidebar_cart',
		'label'     => esc_html__( 'Enable sidebar cart drawer', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Enable single product ajax add to cart.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_single_product_ajax',
		'label'     => esc_html__( 'Enable single product ajax', 'shoptimizer' ),
		'description' => esc_html__( 'Add directly to the cart on single products', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 0,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_2',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Shop', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Display Products Results Count.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_count',
		'label'     => esc_html__( 'Display product results count', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display Products Sorting.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_sorting',
		'label'     => esc_html__( 'Display product sorting', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display sale flash over image.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'toggle',
		'settings' => 'shoptimizer_layout_woocommerce_display_badge',
		'label'    => esc_html__( 'Display sale % discount', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => 1,
		'priority' => 10,
	)
);

// Display rating.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_rating',
		'label'     => esc_html__( 'Display rating', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display category.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_category',
		'label'     => esc_html__( 'Display category', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display image change on hover.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_flip_image',
		'label'     => esc_html__( 'Image change on hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 0,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Product card display.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_woocommerce_card_display',
		'label'     => esc_html__( 'Product card display', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_woocommerce_card_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'default'   => esc_html__( 'Default', 'shoptimizer' ),
			'slide' => esc_html__( 'Slide up', 'shoptimizer' ),
		),
	)
);

// CTA button display.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_woocommerce_cta_display',
		'label'     => esc_html__( 'Button display', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_woocommerce_cta_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'hover'   => esc_html__( 'On hover (desktop only)', 'shoptimizer' ),
			'static' => esc_html__( 'Static', 'shoptimizer' ),
			'no-cta' => esc_html__( 'Remove buttons', 'shoptimizer' ),
		),
	)
);

// Text alignment.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_woocommerce_text_alignment',
		'label'     => esc_html__( 'Product text alignment', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_woocommerce_text_alignment'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'product-align-left'   => esc_html__( 'Left', 'shoptimizer' ),
			'product-align-center' => esc_html__( 'Center', 'shoptimizer' ),
			'product-align-right'  => esc_html__( 'Right', 'shoptimizer' ),
		),
	)
);

// Masonry Layout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_masonry_layout',
		'label'     => esc_html__( 'Use masonry layout', 'shoptimizer' ),
		'description' => esc_html__( 'Only enable if you have irregular image sizes.', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_masonry_layout'],
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_3',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Product Categories', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Category description layout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_woocommerce_category_position',
		'label'     => esc_html__( 'Category description layout.', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_woocommerce_category_position'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'below-header'   => esc_html__( 'Below header', 'shoptimizer' ),
			'within-content' => esc_html__( 'Within content', 'shoptimizer' ),
		),
	)
);

// Category description display.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_category_description',
		'label'     => esc_html__( 'Display category description', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_layout_woocommerce_category_position',
				'value'    => 'within-content',
				'operator' => '==',
			),
		),
	)
);

// Category image display.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_category_image',
		'label'     => esc_html__( 'Display category image', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_layout_woocommerce_category_position',
				'value'    => 'within-content',
				'operator' => '==',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_4',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Single Product', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Single Product Gallery Position.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_gallery_position',
		'label'     => esc_html__( 'Product gallery thumbnails', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_gallery_position'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'horizontal'   => esc_html__( 'Horizontal', 'shoptimizer' ),
			'vertical' => esc_html__( 'Vertical', 'shoptimizer' ),
		),
	)
);


/*shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_hr_rule_0',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>',
		'priority' => 10,
	)
);*/


// Display sticky add to cart bar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_sticky_cart_display',
		'label'     => esc_html__( 'Display sticky add to cart bar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Sticky add to cart bar position.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_layout_woocommerce_sticky_cart_position',
		'label'    => esc_attr__( 'Sticky add to cart bar position', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => $shoptimizer_default_options['shoptimizer_layout_woocommerce_sticky_cart_position'],
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_layout_woocommerce_sticky_cart_display',
				'value'    => true,
				'operator' => '==',
			),
		),
		'choices'  => array(
			'top' => esc_attr__( 'Top', 'shoptimizer' ),
			'bottom'  => esc_attr__( 'Bottom', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

/*
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_hr_rule_1',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>',
		'priority' => 10,
	)
);*/

// Display product meta data.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_meta_display',
		'label'     => esc_html__( 'Display product meta data', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display previous/next products.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_prev_next_display',
		'label'     => esc_html__( 'Display previous/next', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => '1',
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

/*
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_hr_rule_2',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>',
		'priority' => 10,
	)
);
*/

// Display floating button.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'toggle',
		'settings' => 'shoptimizer_layout_floating_button_display',
		'label'    => esc_attr__( 'Display floating button', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'   => '1',
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Floating button text.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'text',
		'settings'  => 'shoptimizer_layout_floating_button_text',
		'label'     => esc_html__( 'Floating button title:', 'shoptimizer' ),
		'description' => esc_html__( 'Content is added within the widget: "Floating Button Modal Content"', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_floating_button_text'],
		'priority'  => 10,
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_layout_floating_button_display',
				'value'    => true,
				'operator' => '==',
			),
		),
		'js_vars'   => array(
			array(
				'element'  => '.call-back-feature',
				'function' => 'html',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_hr_rule_3',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>',
		'priority' => 10,
	)
);

// Display related.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_related_display',
		'label'     => esc_html__( 'Display related', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Number of related items.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'number',
		'settings' => 'shoptimizer_layout_related_amount',
		'label'    => esc_attr__( 'Number of related items to show', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'   => '4',
		'choices' => array(
		'min' => 0,
		'max' => 6,
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_hr_rule_4',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>',
		'priority' => 10,
	)
);

// Display upsells before related.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_upsells_first',
		'label'     => esc_html__( 'Display upsells before related', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 0,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Upsells title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'text',
		'settings'  => 'shoptimizer_upsells_title_text',
		'label'     => esc_html__( 'Upsells title', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_upsells_title_text'],
		'priority'  => 10,
		'transport' => 'auto',
		'js_vars'   => array(
			array(
				'element'  => '.upsells-title',
				'function' => 'html',
			),
		),
	)
);

// Number of upsells.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'number',
		'settings' => 'shoptimizer_layout_upsells_amount',
		'label'    => esc_attr__( 'Number of upsells to show', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'   => '4',
		'choices' => array(
		'min' => 1,
		'max' => 6,
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_5',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase; letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Cart and Checkout', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Display progress bar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'toggle',
		'settings' => 'shoptimizer_layout_progress_bar_display',
		'label'    => esc_attr__( 'Display progress bar', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => 1,
		'priority' => 10,
	)
);

// Cross sells position.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_layout_cross_sells_position',
		'label'    => esc_attr__( 'Cross sells position', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => 1,
		'transport' => 'refresh',
		'priority' => 10,
		'choices'   => array(
			'after-cart'   => esc_html__( 'After cart table', 'shoptimizer' ),
			'bottom' => esc_html__( 'Bottom of page', 'shoptimizer' ),
		),
	)
);

// Number of cross sells.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'number',
		'settings' => 'shoptimizer_layout_cross_sells_amount',
		'label'    => esc_attr__( 'Number of cross sells to show', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'   => '4',
		'choices' => array(
		'min' => 1,
		'max' => 6,
		),
	)
);

// Mobile Cart page layout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        	=> 'toggle',
		'settings'    	=> 'shoptimizer_layout_woocommerce_mobile_cart_page',
		'label'       	=> esc_attr__( 'Mobile cart page (experimental)', 'shoptimizer' ),
		'description' 	=> esc_attr__( 'Collapses the cart page table on mobile', 'shoptimizer' ),
		'section'     	=> 'shoptimizer_layout_section_woocommerce',
		'default'   	=> $shoptimizer_default_options['shoptimizer_layout_woocommerce_mobile_cart_page'],
		'priority'    	=> 10,
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_hr_rule_5',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>',
		'priority' => 10,
	)
);

// Distration free checkout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'toggle',
		'settings'    => 'shoptimizer_layout_woocommerce_simple_checkout',
		'label'       => esc_attr__( 'Distraction-free checkout', 'shoptimizer' ),
		'description' => esc_attr__( 'Simplifies the checkout experience for better conversions.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_woocommerce',
		'default'     => 1,
		'priority'    => 10,
	)
);

// Checkout coupon code position.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_checkout_coupon_position',
		'label'     => esc_html__( 'Checkout coupon code position', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_checkout_coupon_position'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'top'   => esc_html__( 'Top', 'shoptimizer' ),
			'bottom' => esc_html__( 'Bottom', 'shoptimizer' ),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_0',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'WooCommerce', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// WooCommerce Sidebar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_woocommerce_sidebar',
		'label'     => esc_html__( 'WooCommerce Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_woocommerce_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-woocommerce-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-woocommerce-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
			'no-woocommerce-sidebar'    => esc_html__( 'None', 'shoptimizer' ),
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_1',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Pages', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Pages Sidebar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_page_sidebar',
		'label'     => esc_html__( 'Page Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_page_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-page-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-page-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_2',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Blog Archives', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Blog Archives Sidebar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_archives_sidebar',
		'label'     => esc_html__( 'Blog Archives Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_archives_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-archives-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-archives-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
			'no-archives-sidebar'    => esc_html__( 'None', 'shoptimizer' ),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_3',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Single Post', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Posts Sidebar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_post_sidebar',
		'label'     => esc_html__( 'Post Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_post_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-post-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-post-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
			'no-post-sidebar'    => esc_html__( 'None', 'shoptimizer' ),
		),
	)
);

// Sidebar Width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_layout_sidebar_width',
		'label'       => esc_html__( 'Sidebar Width (%).', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the width of the sidebar.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_sidebars',
		'default'     => 22,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '#secondary',
				'property' => 'width',
				'units'    => '%',
			),
		),
	)
);

// Content Width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_layout_content_width',
		'label'       => esc_html__( 'Content Width (%).', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the width of the content.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_sidebars',
		'default'     => 72,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '.content-area',
				'property' => 'width',
				'units'    => '%',
			),
		),
	)
);


// Blog Layout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_blog',
		'label'     => esc_html__( 'Blog Layout', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_blog',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_blog'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'list'        => esc_html__( 'List', 'shoptimizer' ),
			'flow'        => esc_html__( 'Flow', 'shoptimizer' ),
			'grid grid-2' => esc_html__( 'Grid of 2', 'shoptimizer' ),
			'grid grid-3' => esc_html__( 'Grid of 3', 'shoptimizer' ),
		),
	)
);

// Display blog summary.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_blog_summary_display',
		'label'     => esc_html__( 'Display blog post summary', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_blog',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_blog_heading_0',
		'section'  => 'shoptimizer_layout_section_blog',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Single Posts', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Display blog author.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_blog_author',
		'label'     => esc_html__( 'Display blog author', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_blog',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display blog meta.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_blog_meta',
		'label'     => esc_html__( 'Display blog meta', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_blog',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display blog previous and next.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_blog_prev_next',
		'label'     => esc_html__( 'Display blog previous/next', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_blog',
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display single post featured image.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_post_featured_image',
		'label'     => esc_html__( 'Display featured image', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_blog',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);


// Single Post Layout.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_layout_singlepost',
		'label'       => esc_html__( 'Single Post Layout.', 'shoptimizer' ),
		'description' => esc_html__( 'Layout Two is full width and better for using with the Gutenberg editor.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_blog',
		'default'     => $shoptimizer_default_options['shoptimizer_layout_singlepost'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'singlepost-layout-one' => esc_html__( 'Layout One', 'shoptimizer' ),
			'singlepost-layout-two' => esc_html__( 'Layout Two', 'shoptimizer' ),
		),
	)
);


// Footer fields.
// Display Below Content Area.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_below_content_display',
		'label'     => esc_html__( 'Show Below Content?', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_below_content_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'show' => esc_html__( 'Show', 'shoptimizer' ),
			'hide' => esc_html__( 'Hide', 'shoptimizer' ),
		),
	)
);

// Display Footer.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_footer_display',
		'label'     => esc_html__( 'Show Footer?', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'show' => esc_html__( 'Show', 'shoptimizer' ),
			'hide' => esc_html__( 'Hide', 'shoptimizer' ),
		),
	)
);

// Display Copyright.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_copyright_display',
		'label'     => esc_html__( 'Show Copyright?', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_copyright_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'show' => esc_html__( 'Show', 'shoptimizer' ),
			'hide' => esc_html__( 'Hide', 'shoptimizer' ),
		),
	)
);

