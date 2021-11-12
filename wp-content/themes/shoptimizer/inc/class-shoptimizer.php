<?php
/**
 * Shoptimizer Class
 *
 * @author   CommerceGurus
 * @since    1.0.0
 * @package  shoptimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'shoptimizer' ) ) :

	/**
	 * The main Shoptimizer class
	 */
	class shoptimizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );
			add_action( 'wp_enqueue_scripts', array( $this, 'child_scripts' ), 30 ); // After WooCommerce.
			add_filter( 'body_class', array( $this, 'body_classes' ) );
			add_filter( 'wp_page_menu_args', array( $this, 'page_menu_args' ) );
			add_filter( 'wp_get_attachment_image_attributes', array( $this, 'commercegurus_custom_img_sizes' ), 10, 3 );
		}

		/**
		 * Custom sizes attribute for PDP images.
		 *
		 * @since 2.4.2
		 *
		 * @param array        $attr       Array of attribute values for the image markup, keyed by attribute name.
		 *                                 See wp_get_attachment_image().
		 * @param WP_Post      $attachment Image attachment post.
		 * @param string|array $size       Requested size. Image size or array of width and height values
		 *                                 (in that order). Default 'thumbnail'.
		 *
		 * @return array
		 */
		public function commercegurus_custom_img_sizes( $attr, $attachment, $size ) {

			// some images might be missing a sizes attribute so let's check for it so we don't trigger notices.
			if ( ! isset( $attr['sizes'] ) ) {
				$attr['sizes'] = '';
			}

			if ( 'woocommerce_single' === $size ) {
				$attr['sizes'] = '(max-width: 360px) 330px, ' . $attr['sizes'];
			} elseif ( 'woocommerce_gallery_thumbnail' === $size ) {
				$attr['sizes'] = '(max-width: 360px) 75px, ' . $attr['sizes'];
			} elseif ( 'woocommerce_thumbnail' ) {
				$attr['sizes'] = '(max-width: 360px) 147px, ' . $attr['sizes'];
			}
			return $attr;
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {
			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			load_theme_textdomain( 'shoptimizer', trailingslashit( WP_LANG_DIR ) . 'themes/' );
			load_theme_textdomain( 'shoptimizer', get_stylesheet_directory() . '/languages' );
			load_theme_textdomain( 'shoptimizer', get_template_directory() . '/languages' );

			/**
			 * Add default posts and comments RSS feed links to head.
			 */
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			/**
			 * Enable support for site logo
			 */
			add_theme_support(
				'custom-logo',
				apply_filters(
					'shoptimizer_custom_logo_args',
					array(
						'height'      => 110,
						'width'       => 470,
						'flex-height' => true,
						'flex-width'  => true,
					)
				)
			);

			// This theme uses wp_nav_menu() in two locations.
			register_nav_menus(
				apply_filters(
					'shoptimizer_register_nav_menus',
					array(
						'primary'   => __( 'Primary Menu', 'shoptimizer' ),
						'secondary' => __( 'Secondary Menu', 'shoptimizer' ),
					)
				)
			);

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				apply_filters(
					'shoptimizer_html5_args',
					array(
						'search-form',
						'comment-form',
						'comment-list',
						'gallery',
						'caption',
						'widgets',
					)
				)
			);

			/**
			 *  Add support for the Site Logo plugin and the site logo functionality in JetPack
			 *  https://github.com/automattic/site-logo
			 *  http://jetpack.me/
			 */
			add_theme_support(
				'site-logo',
				apply_filters(
					'shoptimizer_site_logo_args',
					array(
						'size' => 'full',
					)
				)
			);

			// Declare WooCommerce support.
			add_theme_support(
				'woocommerce',
				apply_filters(
					'shoptimizer_woocommerce_args',
					array(

						'product_grid' => array(
							'default_columns' => 3,
							'default_rows'    => 4,
							'min_columns'     => 1,
							'max_columns'     => 6,
							'min_rows'        => 1,
						),
					)
				)
			);

			add_filter(
				'woocommerce_get_image_size_gallery_thumbnail',
				function( $size ) {
					return array(
						'width'  => 150,
						'height' => 9999,
						'crop'   => 0,
					);
				}
			);

			// update_option( 'woocommerce_thumbnail_cropping', 'uncropped' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Declare support for title theme feature.
			add_theme_support( 'title-tag' );

			// Declare support for selective refreshing of widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Declare Gutenberg wide images support.
			add_theme_support( 'align-wide' );

			// Custom thumb for PDP. - Specifically targetted at Moto G4 - PDP images max. out at 330px and the G4 has a devicepixelratio of 3 - therefore 990px is optimal for passing PSI mobile audits.
			add_image_size( 'commercegurus-pdp-large', 990, 9999 );
			add_image_size( 'commercegurus-plp-mobile', 441, 9999 );

		}

		/**
		 * Register widget area.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_init() {
			$sidebar_args['sidebar'] = array(
				'name'        => __( 'Sidebar', 'shoptimizer' ),
				'id'          => 'sidebar-1',
				'description' => 'The WooCommerce archives sidebar.',
			);

			$sidebar_args['sidebar-posts'] = array(
				'name'        => __( 'Sidebar Posts', 'shoptimizer' ),
				'id'          => 'sidebar-posts',
				'description' => __( 'The posts sidebar.', 'shoptimizer' ),
			);

			$sidebar_args['sidebar-pages'] = array(
				'name'        => __( 'Sidebar Pages', 'shoptimizer' ),
				'id'          => 'sidebar-pages',
				'description' => __( 'The pages sidebar.', 'shoptimizer' ),
			);

			$sidebar_args['header'] = array(
				'name'        => __( 'Below Header', 'shoptimizer' ),
				'id'          => 'header-1',
				'description' => __( 'Widgets added to this region will appear beneath the header and above the main content.', 'shoptimizer' ),
			);

			$sidebar_args['top-bar-left'] = array(
				'name'          => __( 'Top Bar Left', 'shoptimizer' ),
				'id'            => 'top-bar-left',
				'description'   => __( 'A widget added to this region will appear at the very top of the site to the left.', 'shoptimizer' ),
				'before_widget' => '<div class="top-bar-left  %2$s">',
				'after_widget'  => '</div>',
			);

			$sidebar_args['top-bar'] = array(
				'name'          => __( 'Top Bar Center', 'shoptimizer' ),
				'id'            => 'top-bar',
				'description'   => __( 'A widget added to this region will appear at the very top of the site in the center.', 'shoptimizer' ),
				'before_widget' => '<div class="top-bar-center  %2$s">',
				'after_widget'  => '</div>',
			);

			$sidebar_args['top-bar-right'] = array(
				'name'          => __( 'Top Bar Right', 'shoptimizer' ),
				'id'            => 'top-bar-right',
				'description'   => __( 'A widget added to this region will appear at the very top of the site to the right.', 'shoptimizer' ),
				'before_widget' => '<div class="top-bar-right  %2$s">',
				'after_widget'  => '</div>',
			);

			$sidebar_args['single-product-field'] = array(
				'name'        => __( 'Single Product Custom Area', 'shoptimizer' ),
				'id'          => 'single-product-field',
				'description' => __( 'A widget added to this region will appear below the "Add to cart" button on a product page.', 'shoptimizer' ),
			);

			$sidebar_args['floating-button-content'] = array(
				'name'        => __( 'Floating Button Modal Content', 'shoptimizer' ),
				'id'          => 'floating-button-content',
				'description' => __( 'A widget added to this region will appear within a modal window on a single product page. It is intended for a form shortcode, e.g. Contact Form 7 - but you can add any content you wish.', 'shoptimizer' ),
			);

			$sidebar_args['cart-summary'] = array(
				'name'        => __( 'Below Cart Summary', 'shoptimizer' ),
				'id'          => 'cart-summary',
				'description' => __( 'A widget added to this region will appear below the cart summary.', 'shoptimizer' ),
			);

			$sidebar_args['cart-field'] = array(
				'name'        => __( 'Cart Custom Area', 'shoptimizer' ),
				'id'          => 'cart-field',
				'description' => __( 'A widget added to this region will appear below the "Proceed to checkout" button on the Cart page.', 'shoptimizer' ),
			);

			$sidebar_args['checkout-field'] = array(
				'name'        => __( 'Checkout Custom Area', 'shoptimizer' ),
				'id'          => 'checkout-field',
				'description' => __( 'A widget added to this region will appear below the "Place order" button on the Checkout page.', 'shoptimizer' ),
			);

			$sidebar_args['thankyou-field'] = array(
				'name'        => __( 'Thank You Custom Area', 'shoptimizer' ),
				'id'          => 'thankyou-field',
				'description' => __( 'A widget added to this region will appear at the bottom of the thank you page after an order has been placed.', 'shoptimizer' ),
			);

			$sidebar_args['below-content'] = array(
				'name'        => __( 'Below Content', 'shoptimizer' ),
				'id'          => 'below-content',
				'description' => __( 'A widget added to this region will appear below the main content area.', 'shoptimizer' ),
			);

			$sidebar_args['footer'] = array(
				'name'        => __( 'Footer', 'shoptimizer' ),
				'id'          => 'footer',
				'description' => __( 'A widget added to this region will appear within the footer area.', 'shoptimizer' ),
			);

			$sidebar_args['copyright'] = array(
				'name'        => __( 'Copyright', 'shoptimizer' ),
				'id'          => 'copyright',
				'description' => __( 'A widget added to this region will appear within the copyright area.', 'shoptimizer' ),
			);

			$sidebar_args['mobile-extra'] = array(
				'name'        => __( 'Mobile Extra', 'shoptimizer' ),
				'id'          => 'mobile-extra',
				'description' => __( 'A widget added to this region will appear below the mobile navigation area.', 'shoptimizer' ),
			);

			$sidebar_args = apply_filters( 'shoptimizer_sidebar_args', $sidebar_args );

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<span class="gamma widget-title">',
					'after_title'   => '</span>',
				);

				$filter_hook = sprintf( 'shoptimizer_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}
		}

		/**
		 * Enqueue scripts and styles.
		 *
		 * @since  1.0.0
		 */
		public function scripts() {
			global $shoptimizer_version;

			$shoptimizer_general_speed_rivolicons = '';
			$shoptimizer_general_speed_rivolicons = shoptimizer_get_option( 'shoptimizer_general_speed_rivolicons' );

			/**
			 * Styles
			 */
			if ( 'yes' === $shoptimizer_general_speed_rivolicons ) {
				wp_enqueue_style( 'shoptimizer-rivolicons', get_template_directory_uri() . '/assets/css/base/rivolicons.css', '', $shoptimizer_version );
			}

			/**
			 * Scripts
			 */
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * primary css and the separate WooCommerce css.
		 *
		 * @since  1.0.0
		 */
		public function child_scripts() {
			if ( is_child_theme() ) {
				$child_theme = wp_get_theme( get_stylesheet() );
				wp_enqueue_style( 'shoptimizer-child-style', get_stylesheet_uri(), array(), $child_theme->get( 'Version' ) );
			}
		}

		/**
		 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
		 *
		 * @param array $args Configuration arguments.
		 * @return array
		 */
		public function page_menu_args( $args ) {
			$args['show_home'] = true;
			return $args;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_classes( $classes ) {

			// Adds a class if breadcrumbs are turned off.
			$shoptimizer_layout_woocommerce_display_breadcrumbs = '';
			$shoptimizer_layout_woocommerce_display_breadcrumbs = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_display_breadcrumbs' );

			if ( false === $shoptimizer_layout_woocommerce_display_breadcrumbs ) {
				$classes[] = 'no-breadcrumbs';
			}

			// If the main sidebar doesn't contain widgets, adjust the layout to be full-width.
			if ( ! is_active_sidebar( 'sidebar-1' ) ) {
				$classes[] = 'shoptimizer-full-width-content';
			}

			$shoptimizer_layout_singlepost = '';
			$shoptimizer_layout_singlepost = shoptimizer_get_option( 'shoptimizer_layout_singlepost' );

			$shoptimizer_header_layout = '';
			$shoptimizer_header_layout = shoptimizer_get_option( 'shoptimizer_header_layout' );

			if ( isset( $_GET['header'] ) ) {
				$shoptimizer_header_layout = $_GET['header'];
			}

			$shoptimizer_layout_woocommerce_sticky_cart_position = '';
			$shoptimizer_layout_woocommerce_sticky_cart_position = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_sticky_cart_position' );

			$shoptimizer_sticky_mobile_header = '';
			$shoptimizer_sticky_mobile_header = shoptimizer_get_option( 'shoptimizer_sticky_mobile_header' );

			$shoptimizer_sticky_header = '';
			$shoptimizer_sticky_header = shoptimizer_get_option( 'shoptimizer_sticky_header' );

			$shoptimizer_header_layout_container = '';
			$shoptimizer_header_layout_container = shoptimizer_get_option( 'shoptimizer_header_layout_container' );

			if ( isset( $_GET['headercontainer'] ) ) {
				$shoptimizer_header_layout_container = $_GET['headercontainer'];
			}

			$shoptimizer_layout_gallery_position = '';
			$shoptimizer_layout_gallery_position = shoptimizer_get_option( 'shoptimizer_layout_gallery_position' );

			$shoptimizer_layout_woocommerce_cta_display = '';
			$shoptimizer_layout_woocommerce_cta_display = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_cta_display' );

			$shoptimizer_layout_woocommerce_card_display = '';
			$shoptimizer_layout_woocommerce_card_display = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_card_display' );

			$shoptimizer_search_mobile_position = '';
			$shoptimizer_search_mobile_position = shoptimizer_get_option( 'shoptimizer_search_mobile_position' );

			$shoptimizer_layout_woocommerce_single_product_ajax = '';
			$shoptimizer_layout_woocommerce_single_product_ajax = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_single_product_ajax' );

			$shoptimizer_layout_woocommerce_sticky_cart_display = '';
			$shoptimizer_layout_woocommerce_sticky_cart_display = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_sticky_cart_display' );

			if ( isset( $_GET['productcard'] ) ) {
				$shoptimizer_layout_woocommerce_card_display = $_GET['productcard'];
			}

			if ( 'slide' === $shoptimizer_layout_woocommerce_card_display ) {
				$classes[] = 'product-card__slide';
			}

			if ( true === $shoptimizer_layout_woocommerce_single_product_ajax ) {
				$classes[] = 'pdp-ajax';
			}

			if ( 'static' === $shoptimizer_layout_woocommerce_cta_display ) {
				$classes[] = 'static-cta-buttons';
			}

			if ( 'no-cta' === $shoptimizer_layout_woocommerce_cta_display ) {
				$classes[] = 'no-cta-buttons';
			}

			if ( 'enable' === $shoptimizer_sticky_mobile_header ) {
				$classes[] = 'sticky-m';
			}

			if ( 'enable' === $shoptimizer_sticky_header ) {
				$classes[] = 'sticky-d';
			}

			if ( 'below-header' === $shoptimizer_search_mobile_position ) {
				$classes[] = 'm-search-bh';
			}

			// Add a body class if alternative header layouts are selected.
			if ( 'header-2' === $shoptimizer_header_layout ) {
				$classes[] = 'header-2';
			}
			if ( 'header-3' === $shoptimizer_header_layout ) {
				$classes[] = 'header-3';
			}
			if ( 'header-4' === $shoptimizer_header_layout ) {
				$classes[] = 'header-4';
			}
			if ( 'header-5' === $shoptimizer_header_layout ) {
				$classes[] = 'header-5';
			}
			if ( 'full-width-header' === $shoptimizer_header_layout_container ) {
				$classes[] = 'full-width-header';
			}

			// Add a body class if sticky bar bottom position is selected.
			if ( true === $shoptimizer_layout_woocommerce_sticky_cart_display ) {
				if ( 'bottom' === $shoptimizer_layout_woocommerce_sticky_cart_position ) {
					$classes[] = 'sticky-b';
				}
			}

			// Add a body class if sticky bar top position is selected.
			if ( true === $shoptimizer_layout_woocommerce_sticky_cart_display ) {
				if ( 'top' === $shoptimizer_layout_woocommerce_sticky_cart_position ) {
					$classes[] = 'sticky-t';
				}
			}

			// Add a class if the blog layout 2 is selected.
			if ( 'singlepost-layout-two' === $shoptimizer_layout_singlepost ) {
				$classes[] = 'post-l2';
			}

			// Add a class if the vertical single product gallery is selected.
			if ( 'vertical' === $shoptimizer_layout_gallery_position ) {
				$classes[] = 'v-gallery';
			}

			return $classes;
		}

		/**
		 * Custom navigation markup template hooked into `navigation_markup_template` filter hook.
		 */
		public function navigation_markup_template() {
			$template  = '<nav id="post-navigation" class="navigation %1$s" aria-label="' . esc_html__( 'Post Navigation', 'shoptimizer' ) . '">';
			$template .= '<span class="screen-reader-text">%2$s</span>';
			$template .= '<div class="nav-links">%3$s</div>';
			$template .= '</nav>';

			return apply_filters( 'shoptimizer_navigation_markup_template', $template );
		}

	}
endif;

return new shoptimizer();
