<?php
/**
 *
 * Color theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Color fields.
$shoptimizer_default_options = shoptimizer_get_option_defaults();

// General colors.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'color',
		'settings'    => 'shoptimizer_color_general_swatch',
		'label'       => esc_html__( 'Primary swatch color', 'shoptimizer' ),
		'description' => esc_html__( 'Select the primary color of your brand.', 'shoptimizer' ),
		'section'     => 'shoptimizer_color_section_general',
		'default'     => $shoptimizer_default_options['shoptimizer_color_general_swatch'],
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '.price ins, .summary .yith-wcwl-add-to-wishlist a:before, 
				.commercekit-wishlist a i:before,
				.commercekit-wishlist-table .price, .commercekit-wishlist-table .price ins,
				.commercekit-ajs-product-price, .commercekit-ajs-product-price ins,
				.widget-area .widget.widget_categories a:hover, #secondary .widget ul li a:hover,
			#secondary.widget-area .widget li.chosen a, .widget-area .widget a:hover, #secondary .widget_recent_comments ul li a:hover,
			.woocommerce-pagination .page-numbers li .page-numbers.current, div.product p.price,
			body:not(.mobile-toggled) .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a,
			body:not(.mobile-toggled) .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a:hover,
			#secondary .widget ins span.amount, #secondary .widget ins span.amount span, .search-results article h2 a:hover',
				'property' => 'color',
			),
			array(
				'element'  => '.spinner > div, .widget_price_filter .ui-slider .ui-slider-range, .widget_price_filter .ui-slider .ui-slider-handle, #page .woocommerce-tabs ul.tabs li span,
			#secondary.widget-area .widget .tagcloud a:hover, .widget-area .widget.widget_product_tag_cloud a:hover,
			footer .mc4wp-form input[type="submit"], 
			#payment .payment_methods li.woocommerce-PaymentMethod > input[type=radio]:first-child:checked + label:before, 
			#payment .payment_methods li.wc_payment_method > input[type=radio]:first-child:checked + label:before,
			#shipping_method > li > input[type=radio]:first-child:checked + label:before, ul#shipping_method li:only-child label:before, .image-border .elementor-image:after,
			ul.products li.product .yith-wcwl-wishlistexistsbrowse a:before,
			ul.products li.product .yith-wcwl-wishlistaddedbrowse a:before,
			ul.products li.product .yith-wcwl-add-button a:before,
			.summary .yith-wcwl-add-to-wishlist a:before,
			.commercekit-wishlist a i.cg-wishlist-t:before,
			.commercekit-wishlist a i.cg-wishlist:before,
			.summary .commercekit-wishlist a i.cg-wishlist-t:before,
			#page .woocommerce-tabs ul.tabs li a span, .main-navigation ul li a span strong, .widget_layered_nav ul.woocommerce-widget-layered-nav-list li.chosen:before',
				'property' => 'background-color',
			),

		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.price ins, .summary .yith-wcwl-add-to-wishlist a:before, 
				ul.products li.product .yith-wcwl-wishlistexistsbrowse a:before,
				ul.products li.product .yith-wcwl-wishlistaddedbrowse a:before,
				ul.products li.product .yith-wcwl-add-button a:before,
				.commercekit-wishlist a i:before,
				.commercekit-wishlist-table .price, .commercekit-wishlist-table .price ins,
				.commercekit-ajs-product-price, .commercekit-ajs-product-price ins,
				.widget-area .widget.widget_categories a:hover, #secondary .widget ul li a:hover,
			#secondary.widget-area .widget li.chosen a, .widget-area .widget a:hover, #secondary .widget_recent_comments ul li a:hover,
			.woocommerce-pagination .page-numbers li .page-numbers.current, div.product p.price,
			body:not(.mobile-toggled) .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a,
			body:not(.mobile-toggled) .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a:hover,
			#secondary .widget ins span.amount, #secondary .widget ins span.amount span, .search-results article h2 a:hover',
				'property' => 'color',
			),
			array(
				'element'  => '.spinner > div, .widget_price_filter .ui-slider .ui-slider-range, body .widget_price_filter .ui-slider .ui-slider-handle,
			#secondary.widget-area .widget .tagcloud a:hover, .widget-area .widget.widget_product_tag_cloud a:hover,
			footer .mc4wp-form input[type="submit"], #page .woocommerce-tabs ul.tabs li span,
			#payment .payment_methods li.woocommerce-PaymentMethod > input[type=radio]:first-child:checked + label:before, 
			#payment .payment_methods li.wc_payment_method > input[type=radio]:first-child:checked + label:before,
			#shipping_method > li > input[type=radio]:first-child:checked + label:before, ul#shipping_method li:only-child label:before, .image-border .elementor-image:after,
			ul.products li.product .yith-wcwl-wishlistexistsbrowse a:before,
			ul.products li.product .yith-wcwl-wishlistaddedbrowse a:before,
			ul.products li.product .yith-wcwl-add-button a:before,
			.summary .yith-wcwl-add-to-wishlist a:before,
			.commercekit-wishlist a i.cg-wishlist-t:before,
			.commercekit-wishlist a i.cg-wishlist:before,
			.summary .commercekit-wishlist a i.cg-wishlist-t:before,
			#page .woocommerce-tabs ul.tabs li a span, .main-navigation ul li a span strong, .widget_layered_nav ul.woocommerce-widget-layered-nav-list li.chosen:before',
				'property' => 'background-color',
			),

		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_color_general_links',
		'label'     => esc_html__( 'General links', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_general',
		'default'   => $shoptimizer_default_options['shoptimizer_color_general_links'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// General links hover.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_color_general_links_hover',
		'label'     => esc_html__( 'General links hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_general',
		'default'   => $shoptimizer_default_options['shoptimizer_color_general_links_hover'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'a:hover',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Body background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'color',
		'settings'    => 'shoptimizer_color_body_bg',
		'label'       => esc_html__( 'Body background color', 'shoptimizer' ),
		'description' => esc_html__( 'Visible if the grid is contained.', 'shoptimizer' ),
		'section'     => 'shoptimizer_color_section_general',
		'default'     => $shoptimizer_default_options['shoptimizer_color_body_bg'],
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => 'body',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'body',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Top Bar background.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_layout_top_bar_background',
		'label'     => esc_html__( 'Top bar background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_topbar',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_top_bar_background'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Top Bar text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_layout_top_bar_text',
		'label'     => esc_html__( 'Top Bar text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_topbar',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_top_bar_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.top-bar, .top-bar a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.top-bar, .top-bar a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Top Bar border.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_layout_top_bar_border',
		'label'     => esc_html__( 'Top bar border', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_topbar',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_top_bar_border'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'property' => 'border-bottom-color',
			),
		),
		'transport' => 'postMessage',
		'choices'   => array(
			'alpha' => true,
		),
		'js_vars'   => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'function' => 'css',
				'property' => 'border-bottom-color',
			),
		),
	)
);

// Header Background Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_header_bg_color',
		'label'     => esc_html__( 'Header background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_header_bg_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'body:not(.header-4) .site-header, .header-4-container',
				'property' => 'background-color',
			),
			array(
				'element'     => '.m-search-bh .site-search, .m-search-toggled .site-search, .site-branding button.menu-toggle, .site-branding button.menu-toggle:hover',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'body:not(.header-4) .site-header, .header-4-container',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'     => '.m-search-bh .site-search, .m-search-toggled .site-search, .site-branding button.menu-toggle, .site-branding button.menu-toggle:hover',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);

// Header Border Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_header_border_color',
		'label'     => esc_html__( 'Header border color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_header_border_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.fa.menu-item, .ri.menu-item',
				'property' => 'border-left-color',
			),
			array(
				'element'  => '.header-4 .search-trigger span',
				'property' => 'border-right-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.fa.menu-item, .ri.menu-item',
				'function' => 'css',
				'property' => 'border-left-color',
			),
			array(
				'element'  => '.header-4 .search-trigger span',
				'property' => 'border-right-color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_header_divider',
		'section'  => 'shoptimizer_color_section_header',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Mobile', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Mobile Header - Hamburger icon color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_mobile_hamburger',
		'label'     => esc_html__( 'Navigation icon', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_mobile_hamburger'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.menu-toggle .bar,
				.site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.menu-toggle .bar-text, .menu-toggle:hover .bar-text, .site-header-cart a.cart-contents .count',
				'property' => 'color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.mobile-search-toggle svg, .mobile-myaccount svg',
				'property' => 'stroke',
				'media_query' => '@media (max-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.menu-toggle .bar,
				.site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.menu-toggle .bar-text, .menu-toggle:hover .bar-text, .site-header-cart a.cart-contents .count',
				'property' => 'color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.mobile-search-toggle svg, .mobile-myaccount svg',
				'property' => 'stroke',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);

// Mobile Header - Cart icon color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_mobile_cart_color',
		'label'     => esc_html__( 'Cart icon', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_mobile_cart_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '
				.site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.site-header-cart a.cart-contents:not(:hover) .count',
				'property' => 'color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.shoptimizer-cart-icon svg',
				'property' => 'stroke',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.site-header .site-header-cart a.cart-contents .count,
				.site-header-cart a.cart-contents .count:after',
				'property' => 'border-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '
				.site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.shoptimizer-cart-icon svg',
				'property' => 'stroke',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.site-header-cart a.cart-contents .count',
				'property' => 'color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'  => '.site-header-cart a.cart-contents .count,
				.site-header-cart a.cart-contents .count:after',
				'property' => 'border-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);


// Mobile Menu Background Color
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_mobile_bg',
		'label'     => esc_html__( 'Mobile navigation background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_mobile_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'     => '.col-full-nav',
				'property'    => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.col-full-nav',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);


// Mobile Header - Text Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_mobile_color',
		'label'     => esc_html__( 'Mobile navigation text', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_mobile_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'     => '.main-navigation ul li a, body .main-navigation ul.menu > li.menu-item-has-children > span.caret::after, .main-navigation .woocommerce-loop-product__title, .main-navigation ul.menu li.product, body .main-navigation ul.menu li.menu-item-has-children.full-width>.sub-menu-wrapper li h6 a, body .main-navigation ul.menu li.menu-item-has-children.full-width>.sub-menu-wrapper li h6 a:hover, .main-navigation ul.products li.product .price,
				body .main-navigation ul.menu li.menu-item-has-children li.menu-item-has-children span.caret,
				body.mobile-toggled .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li p.product__categories a, body.mobile-toggled ul.products li.product p.product__categories a, body li.menu-item-product p.product__categories,
				body .main-navigation .price ins, .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.menu-item-has-children > a, .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.heading > a, .mobile-extra, .mobile-extra h4, .mobile-extra a',
				'property'    => 'color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'     => '.main-navigation ul.menu li.menu-item-has-children span.caret::after',
				'property'    => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.main-navigation ul li a, body .main-navigation ul.menu > li.menu-item-has-children > span.caret::after, .main-navigation .woocommerce-loop-product__title, .main-navigation ul.menu li.product, body .main-navigation ul.menu li.menu-item-has-children.full-width>.sub-menu-wrapper li h6 a, body .main-navigation ul.menu li.menu-item-has-children.full-width>.sub-menu-wrapper li h6 a:hover, .main-navigation ul.products li.product .price,
				body .main-navigation ul.menu li.menu-item-has-children li.menu-item-has-children span.caret,
				body.mobile-toggled .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li p.product__categories a,
				body .main-navigation .price ins, .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.menu-item-has-children > a, .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li.heading > a, .mobile-extra, .mobile-extra h4, .mobile-extra a',
				'function'    => 'css',
				'property'    => 'color',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'     => '.main-navigation ul.menu li.menu-item-has-children span.caret::after',
				'property'    => 'background-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);

// Mobile Header - Navigation divider line color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_mobile_divider_line',
		'label'     => esc_html__( 'Mobile navigation divider', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_mobile_divider_line'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.main-navigation ul.menu > li.menu-item-has-children.dropdown-open > .sub-menu-wrapper',
				'property' => 'border-bottom-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.main-navigation ul.menu > li.menu-item-has-children.dropdown-open > .sub-menu-wrapper',
				'function' => 'css',
				'property' => 'border-bottom-color',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);



// Navigation Background Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_bg_color',
		'label'     => esc_html__( 'Navigation background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_bg_color'],
		'priority'  => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'shoptimizer_header_layout',
				'value'    => 'header-4',
				'operator' => '!=',
			),
		),
		'output'    => array(
			array(
				'element'     => '.col-full-nav',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.col-full-nav',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 993px)',
			),
		),
	)
);

// Below header background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_below_header_bg',
		'label'     => esc_html__( 'Below header background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_below_header',
		'default'   => $shoptimizer_default_options['shoptimizer_below_header_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.header-widget-region',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.header-widget-region',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Below header text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_below_header_text',
		'label'     => esc_html__( 'Below header text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_below_header',
		'default'   => $shoptimizer_default_options['shoptimizer_below_header_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.header-widget-region, .header-widget-region a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.header-widget-region, .header-widget-region a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);



shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_1',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Primary Button', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// WooCommerce primary button text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_woocommerce_button_text',
		'label'     => esc_html__( 'Primary button text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_woocommerce_button_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '
			button,
			.button,
			.button:hover,
			input[type=submit],
			ul.products li.product .button,
			ul.products li.product .added_to_cart,
			.site .widget_shopping_cart a.button.checkout,
			.woocommerce #respond input#submit.alt, 
			.main-navigation ul.menu ul li a.button,
			.main-navigation ul.menu ul li a.button:hover,
			body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.button:hover,
			.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li:hover a.added_to_cart,
			div.wpforms-container-full .wpforms-form button[type=submit],
			.product .cart .single_add_to_cart_button,
			.woocommerce-cart p.return-to-shop a,
			.elementor-row .feature p a, .image-feature figcaption span',
				'property' => 'color',
			),
			array(
				'element'  => '.single-product div.product form.cart .button.added::before',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '
			button,
			.button,
			.button:hover,
			input[type=submit],
			ul.products li.product .button,
			ul.products li.product .added_to_cart,
			.site .widget_shopping_cart a.button.checkout,
			.woocommerce #respond input#submit.alt, 
			.main-navigation ul.menu ul li a.button,
			.main-navigation ul.menu ul li a.button:hover,
			body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.button:hover,
			.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li:hover a.added_to_cart,
			div.wpforms-container-full .wpforms-form button[type=submit],
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart, 
			ul.products li.product .added_to_cart,
			.woocommerce-cart p.return-to-shop a,
			.elementor-row .feature p a, .image-feature figcaption span',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '.single-product div.product form.cart .button.added::before',
				'property' => 'background-color',
			),
		),
	)
);

// WooCommerce primary button background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_woocommerce_button_bg',
		'label'     => esc_html__( 'Primary button background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_woocommerce_button_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '
			button,
			.button,
			input[type=submit],
			ul.products li.product .button,
			.woocommerce #respond input#submit.alt, 
			.product .cart .single_add_to_cart_button,
			.widget_shopping_cart a.button.checkout,
			.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart,
			div.wpforms-container-full .wpforms-form button[type=submit],
			ul.products li.product .added_to_cart,
			.woocommerce-cart p.return-to-shop a,
			.elementor-row .feature a, .image-feature figcaption span',
				'property' => 'background-color',
			),
			array(
				'element'  => '
			.widget_shopping_cart a.button.checkout',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '
			button,
			.button,
			input[type=submit],
			ul.products li.product .button,
			.woocommerce #respond input#submit.alt, 
			.product .cart .single_add_to_cart_button,
			.widget_shopping_cart a.button.checkout,
			.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart,
			div.wpforms-container-full .wpforms-form button[type=submit],
			ul.products li.product .added_to_cart,
			.woocommerce-cart p.return-to-shop a,
			.elementor-row .feature a, 
			.image-feature figcaption span',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '.widget_shopping_cart a.button.checkout',
				'function' => 'css',
				'property' => 'border-color',
			),
		),
	)
);

// WooCommerce primary button background hover color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_woocommerce_button_hover_bg',
		'label'     => esc_html__( 'Primary button background hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_woocommerce_button_hover_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '
			button:hover,
			.button:hover,
			[type="submit"]:hover,
			ul.products li.product .button:hover,
			#place_order[type="submit"]:hover,
			body .woocommerce #respond input#submit.alt:hover, 
			.product .cart .single_add_to_cart_button:hover,
			.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart:hover,
			div.wpforms-container-full .wpforms-form button[type=submit]:hover,
			div.wpforms-container-full .wpforms-form button[type=submit]:focus,
			ul.products li.product .added_to_cart:hover,
			.widget_shopping_cart a.button.checkout:hover,
			.woocommerce-cart p.return-to-shop a:hover',
				'property' => 'background-color',
			),
			array(
				'element'  => '
			.widget_shopping_cart a.button.checkout:hover',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '
			button:hover,
			.button:hover,
			[type="submit"]:hover,
			ul.products li.product .button:hover,
			#place_order[type="submit"]:hover,
			body .woocommerce #respond input#submit.alt:hover, 
			.product .cart .single_add_to_cart_button:hover,
			.main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart:hover,
			div.wpforms-container-full .wpforms-form button[type=submit]:hover,
			div.wpforms-container-full .wpforms-form button[type=submit]:focus,
			ul.products li.product .added_to_cart:hover,
			.widget_shopping_cart a.button.checkout:hover,
			.woocommerce-cart p.return-to-shop a:hover',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '.widget_shopping_cart a.button.checkout:hover',
				'function' => 'css',
				'property' => 'border-color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_2',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Sale Flash', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Sale flash background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_sale_flash_bg',
		'label'     => esc_html__( 'Sale flash background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_sale_flash_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.onsale, .product-label',
				'property' => 'background-color',
			),
			array(
				'element'  => '.content-area .summary .onsale',
				'property' => 'color',
			),
			array(
				'element'  => '.summary .product-label:before, .product-details-wrapper .product-label:before',
				'property' => 'border-right-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.onsale, .product-label',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '.content-area .summary .onsale',
				'property' => 'color',
			),
			array(
				'element'  => '.summary .product-label:before, .product-details-wrapper .product-label:before',
				'property' => 'border-right-color',
			),
		),
	)
);


// Sale flash text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_sale_flash_text',
		'label'     => esc_html__( 'Sale flash text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_sale_flash_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.onsale, .product-label',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.onsale, .product-label',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_4',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( ' Ratings', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Ratings color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_ratings_color',
		'label'     => esc_html__( 'Star ratings color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_ratings_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.entry-content .testimonial-entry-title:after, 
				.cart-summary .widget li strong::before, 
				p.stars.selected a.active::before,
				p.stars:hover a::before,
				p.stars.selected a:not(.active)::before',
				'property' => 'color',
			),
			array(
				'element'  => '.star-rating > span:before',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.entry-content .testimonial-entry-title:after,
				.cart-summary .widget li strong::before,
				p.stars.selected a.active::before,
				p.stars:hover a::before,
				p.stars.selected a:not(.active)::before',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '.star-rating > span:before',
				'property' => 'background-color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_5',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( ' Product Archives', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Archive description background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_archives_description_bg',
		'label'     => esc_html__( 'Archive description background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_archives_description_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'header.woocommerce-products-header, .shoptimizer-category-banner',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'header.woocommerce-products-header, .shoptimizer-category-banner',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Archive description text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_archives_text_bg',
		'label'     => esc_html__( 'Archive description text', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_archives_description_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.term-description p, .term-description a, .term-description a:hover, .shoptimizer-category-banner h1, .shoptimizer-category-banner .taxonomy-description p',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.term-description p, .term-description a, .term-description a:hover, .shoptimizer-category-banner h1, .shoptimizer-category-banner .taxonomy-description p',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_6',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( ' Single Product', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Product background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_product_bg',
		'label'     => esc_html__( 'Product container background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_product_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.single-product .site-content .col-full',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.single-product .site-content .col-full',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Floating button background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_floating_button_bg',
		'label'     => esc_html__( 'Floating button background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_floating_button_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.call-back-feature a',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.call-back-feature a',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);


// Floating button text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_floating_button_text',
		'label'     => esc_html__( 'Floating button text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_floating_button_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.call-back-feature a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.call-back-feature a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_7',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( ' Cart and Checkout', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Progress bar color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_progress_bar_color',
		'label'     => esc_html__( 'Progress bar color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_progress_bar_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'ul.checkout-bar:before, .woocommerce-checkout .checkout-bar li.active:after, ul.checkout-bar li.visited:after',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'ul.checkout-bar:before, .woocommerce-checkout .checkout-bar li.active:after, ul.checkout-bar li.visited:after',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Below content icons color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_below_content_icons',
		'label'     => esc_html__( 'Below content icons', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_below_content_icons'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.below-content .widget .ri',
				'property' => 'color',
			),
			array(
				'element'  => '.below-content .widget svg',
				'property' => 'stroke',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.below-content .widget .ri',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => '.below-content .widget svg',
				'property' => 'stroke',
			),
		),
	)
);

// Footer background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_bg',
		'label'     => esc_html__( 'Footer background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);


// Footer heading color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_heading_color',
		'label'     => esc_html__( 'Footer headings color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_heading_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer .widget .widget-title',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer .widget .widget-title',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Footer text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_color',
		'label'     => esc_html__( 'Footer text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);


// Footer links color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_links_color',
		'label'     => esc_html__( 'Footer links', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_links_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer a:not(.button)',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer a:not(.button)',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);


// Footer links hover color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_links_hover_color',
		'label'     => esc_html__( 'Footer links hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_links_hover_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer a:not(.button):hover',
				'property' => 'color',
			),
			array(
				'element'  => 'footer li a:after',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer a:not(.button):hover',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => 'footer li a:after',
				'property' => 'border-color',
			),
		),
	)
);
