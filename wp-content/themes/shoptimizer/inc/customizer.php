<?php
/**
 * Shoptimizer Theme Customizer
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Set config scope.
shoptimizer_Kirki::add_config(
	'shoptimizer_config',
	array(
		'option_type'       => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'gutenberg_support' => true,
	)
);

function shoptimizer_kirki_styling( $config ) {
	return wp_parse_args(
		array(
			'disable_loader' => 'true',
		),
		$config
	);
}
add_filter( 'kirki_config', 'shoptimizer_kirki_styling' );

function my_custom_fallback_fonts() {
    $backup_fonts = array(
        'sans-serif'  => 'Helvetica, Arial, sans-serif',
        'serif'       => 'Georgia, serif',
        'display'     => '"Comic Sans MS", cursive, sans-serif',
        'handwriting' => '"Comic Sans MS", cursive, sans-serif',
        'monospace'   => '"Lucida Console", Monaco, monospace',
    );
    return $backup_fonts;
}
add_filter( 'kirki/fonts/backup_fonts', 'my_custom_fallback_fonts' );


add_action(
	'customize_controls_print_styles',
	function() {
		?>
	<style>
		.customize-control-kirki-radio-image input:checked + label img,
		.customize-control-kirki-radio-image img {
			margin-top: 10px;
			border-width: 2px;
			border-radius: 6px;
			-webkit-box-shadow: none;
			box-shadow: none;
			border: 2px solid transparent;
			opacity: 0.8;
		}
		.customize-control-kirki-radio-image input:checked + label img {
			border-color: #3498DB;
			opacity: 1;
		}

		.accordion-section.control-section h3 {
			display: flex;
			align-items: center;
		}

		#customize-theme-controls h3.accordion-section-title:before {
			width: 2em;
			height: 2em;
			margin-right: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			background-color: #8dd3fd;
			color: #fff;
			border-radius: 50%;
			font-family: 'Dashicons';
			font-size: 16px;
			-webkit-font-smoothing: antialiased;
		}

		#accordion-panel-shoptimizer_panel_general h3:before {
			content: "\f107";
		}

		#accordion-panel-shoptimizer_panel_colors h3:before {
			content: "\f100";
		}

		#accordion-panel-shoptimizer_panel_mainmenu h3:before {
			content: "\f134";
		}

		#accordion-panel-shoptimizer_panel_typography h3:before {
			content: "\f205";
		}

		#accordion-panel-shoptimizer_panel_layout h3:before {
			content: "\f154";
		}

		#accordion-panel-nav_menus h3:before {
			content: "\f333";
		}

		#accordion-panel-widgets h3:before {
			content: "\f109";
		}

		#accordion-panel-woocommerce h3:before {
			content: "\f230";
		}

		#accordion-section-custom_css h3:before {
			content: "\f475";
		}

		#accordion-section-wpseo_breadcrumbs_customizer_section h3:before {
			content: "\f238";
		}

	</style>
		<?php
	}
);


// Init options and set sane defaults.
require_once get_template_directory() . '/inc/customizer/options.php';

// Get Panels.
require get_template_directory() . '/inc/customizer/panels/panels.php';

// Get Sections.
require get_template_directory() . '/inc/customizer/sections/general.php';
require get_template_directory() . '/inc/customizer/sections/color.php';
require get_template_directory() . '/inc/customizer/sections/mainmenu.php';
require get_template_directory() . '/inc/customizer/sections/typography.php';
require get_template_directory() . '/inc/customizer/sections/layout.php';

// Get Fields.
require get_template_directory() . '/inc/customizer/fields/general.php';
require get_template_directory() . '/inc/customizer/fields/color.php';
require get_template_directory() . '/inc/customizer/fields/mainmenu.php';
require get_template_directory() . '/inc/customizer/fields/layout.php';

// Shoptimizer Typography.
$shoptimizer_typography2_enabled = shoptimizer_typography2_enabled();

if ( $shoptimizer_typography2_enabled ) {
	// Shoptimizer customizer extensions.
	require_once get_template_directory() . '/inc/customizer/shoptimizer-customizer-extensions.php';
} else {
	require get_template_directory() . '/inc/customizer/fields/typography.php';
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shoptimizer_customize_register( $wp_customize ) {

	// Remove sections not required - all in our main customizer options.
	$wp_customize->remove_section( 'colors' );

	// Reassign default sections to panels.
	$wp_customize->get_section( 'title_tagline' )->panel     = 'shoptimizer_panel_general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'shoptimizer_panel_general';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}

add_action( 'customize_register', 'shoptimizer_customize_register' );
