<?php
/**
 * Shoptimizer functions.
 *
 * @package shoptimizer
 */

if ( ! function_exists( 'shoptimizer_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function shoptimizer_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

/**
 * Preload the icon font files.
 */
add_action('wp_head', 'shoptimizer_preload_icon_fonts');

	function shoptimizer_preload_icon_fonts() { 

	$shoptimizer_general_speed_rivolicons = '';
	$shoptimizer_general_speed_rivolicons = shoptimizer_get_option( 'shoptimizer_general_speed_rivolicons' );

	if ( 'yes' === $shoptimizer_general_speed_rivolicons ) { ?>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Rivolicons-Free.woff2?-uew922" as="font" type="font/woff2" crossorigin="anonymous">
	<?php }
	?>

<?php }


/**
 * Produces nice safe html for presentation.
 *
 * @param $input - accepts a string.
 * @return string
 */
function shoptimizer_safe_html( $input ) {

	$args = array(
		// formatting.
		'span'   => array(
			'class' => array(),
		),
		'h2'     => array(
			'class' => array(),
		),
		'del'    => array(),
		'ins'    => array(),
		'strong' => array(),
		'em'     => array(),
		'b'      => array(),
		'i'      => array(
			'class' => array(),
		),
		'img'    => array(
			'href'   => array(),
			'alt'    => array(),
			'class'  => array(),
			'scale'  => array(),
			'width'  => array(),
			'height' => array(),
			'src'    => array(),
			'srcset' => array(),
			'sizes'  => array(),
		),
		'p'      => array(),

		// links.
		'a'      => array(
			'href'  => array(),
			'class' => array(),
		),
	);

	return wp_kses( $input, $args );
}

/**
 * Returns a shortcode for the menu.
 */
function shoptimizer_menu_enable_shortcode( $menu, $args ) {
		return do_shortcode( $menu );
}

/**
 * Include the filter inside an action.
 */
if ( ! function_exists( 'shoptimizer_menu_load_shortcode' ) ) {
	function shoptimizer_menu_load_shortcode() {
		add_filter( 'wp_nav_menu', 'shoptimizer_menu_enable_shortcode', 20, 2 );
	}
}
add_action( 'shoptimizer_header', 'shoptimizer_menu_load_shortcode', 42 );


/**
 * Primary Menu Custom Walker - add a wrapper div.
 */
class submenuwrap extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<div class='sub-menu-wrapper'><div class='container'><ul class='sub-menu'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent</ul></div></div>\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$shoptimizer_menu_display_description = '';
		$shoptimizer_menu_display_description = shoptimizer_get_option( 'shoptimizer_menu_display_description' );

		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

		// Passed Classes
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '">';

		// If 'menu-item-product' exists in classes, don't add the HTML anchor tag.
		if ( in_array( 'menu-item-product', $classes ) ) {
			$item_output = apply_filters( 'the_title', $item->title, $item->ID );

		}
		else {

			// link attributes.
			$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
			$attributes .= ' class="cg-menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

			$description = ( ! empty ( $item->description ) and 1 == $depth )
            ? '<span class="sub">'.  $item->description . '</span>' : '';

            // Display menu descriptions
            if ( true === $shoptimizer_menu_display_description ) { 

			$item_output = sprintf(
				'%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$description,
				$args->link_after,
				$args->after
			);

			}

			// Do not display menu descriptions
			else {
				$item_output = sprintf(
				'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);

			}
		}

		// build html.
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}

/**
 * Enable the ability to have HTML in menu desc.
 */
remove_filter( 'nav_menu_description', 'strip_tags' );
function shoptimizer_nav_menu_item( $menu_item ) {
    if ( isset( $menu_item->post_type ) ) {
        if ( 'nav_menu_item' == $menu_item->post_type ) {
            $menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
        }
    }

    return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'shoptimizer_nav_menu_item' );

/**
 * Enables the display of menu descriptions.
 */
function shoptimizer_prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace($args->link_before.'</a>',
            '<div class="icon-wrapper">'.$item->description.'</div>'.$args->link_before.'</a>',
            $item_output
        );
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'shoptimizer_prefix_nav_description', 10, 4 );

/**
 * Adds a caret icon for the mobile menu.
 */
function shoptimizer_mobile_menu_plus( $output, $item, $depth, $args ) {

	if ( 'primary' == $args->theme_location ) {
		if ( in_array( 'menu-item-has-children', $item->classes ) ) {
			$output .= '<span class="caret"></span>';
		}
	}
	return $output;
}

add_filter( 'walker_nav_menu_start_el', 'shoptimizer_mobile_menu_plus', 10, 4 );


add_filter( 'woocommerce_show_page_title', '__return_false' );
add_action( 'woocommerce_before_main_content', 'shoptimizer_archives_title', 20 );

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.0.0
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */

function shoptimizer_do_shortcode( $tag, array $atts = array(), $content = null ) {
	global $shortcode_tags;

	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}

	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}