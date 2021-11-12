<?php
/**
 * Customizer extensions for Shoptimizer
 *
 * @package Shoptimizer
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Shoptimizer_Initialise_Extended_Customizer_Settings {

	/**
	 * Default values
	 */
	private $defaults;

	/**
	 * Constructor
	 */
	public function __construct() {

		// Get our Customizer defaults.
		$this->defaults = shoptimizer_typography2_defaults();

		// Register panels.
		add_action( 'customize_register', array( $this, 'shoptimizer_add_extended_panels' ) );

		// Register sections.
		add_action( 'customize_register', array( $this, 'shoptimizer_add_extended_sections' ) );

		// Register controls.
		add_action( 'customize_register', array( $this, 'shoptimizer_register_extended_controls' ) );

	}

	/**
	 * Register customizer panels
	 */
	public function shoptimizer_add_extended_panels( $wp_customize ) {

		/**
		 * Add our Header & Navigation Panel
		 */
		$wp_customize->add_panel(
			'shoptimizer_typography2_panel',
			array(
				'priority'    => 10,
				'title'       => esc_html__( 'Typography 2.0', 'shoptimizer' ),
				'description' => esc_html__( 'Manage theme typography', 'shoptimizer' ),
			)
		);

	}

	/**
	 * Register customizer sections
	 */
	public function shoptimizer_add_extended_sections( $wp_customize ) {

		// Presets.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_presets',
			array(
				'title'    => esc_html__( 'Presets', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Typography.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_main_body',
			array(
				'title'    => esc_html__( 'Main Body', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Navigation.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_navigation',
			array(
				'title'    => esc_html__( 'Navigation', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Paragraphs.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_p',
			array(
				'title'    => esc_html__( 'Paragraphs', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Heading One.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_headings_h1',
			array(
				'title'    => esc_html__( 'Heading One', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Heading Two.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_headings_h2',
			array(
				'title'    => esc_html__( 'Heading Two', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Heading Three.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_headings_h3',
			array(
				'title'    => esc_html__( 'Heading Three', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Heading Four.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_headings_h4',
			array(
				'title'    => esc_html__( 'Heading Four', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Heading Five.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_headings_h5',
			array(
				'title'    => esc_html__( 'Heading Five', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Blockquote.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_blockquote',
			array(
				'title'    => esc_html__( 'Blockquotes', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Widget Title.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_widget_title',
			array(
				'title'    => esc_html__( 'Widget Titles', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// Blog.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_blog',
			array(
				'title'    => esc_html__( 'Blog', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

		// WooCommerce.
		$wp_customize->add_section(
			'shoptimizer_typography2_section_woocommerce',
			array(
				'title'    => esc_html__( 'WooCommerce', 'shoptimizer' ),
				'panel'    => 'shoptimizer_typography2_panel',
				'priority' => 10,
			)
		);

	}

	/**
	 * Register extended settings
	 */
	public function shoptimizer_register_extended_controls( $wp_customize ) {

		// Main body.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_main_body_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_main_body_fontfamily'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_main_body_fontfamily]',
				array(
					'label'       => __( 'Font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_main_body',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'popular',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_main_body_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_main_body_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_main_body_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_main_body',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_main_body_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_main_body_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_main_body_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_main_body',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_main_body_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_main_body_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_main_body_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_main_body',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Main navigation level 1 Menu.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_mainmenu_level1_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_mainmenu_level1_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_mainmenu_level1_fontfamily]',
				array(
					'label'       => __( 'Primary navigation settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_level1_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_level1_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_mainmenu_level1_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_level1_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_level1_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_mainmenu_level1_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_level1_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_level1_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_mainmenu_level1_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_navigation',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);

		// Navigation dropdown.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_mainmenu_level2_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_mainmenu_level2_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_mainmenu_level2_fontfamily]',
				array(
					'label'       => __( 'Navigation dropdown settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_level2_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_level2_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_mainmenu_level2_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_typography2_mainmenu_level2_text_transform',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_level2_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_typography2_mainmenu_level2_text_transform',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_navigation',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);

		// Main Navigation Heading Font within Megamenus.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_mainmenu_heading_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_mainmenu_heading_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_mainmenu_heading_fontfamily]',
				array(
					'label'       => __( 'Mega menu heading font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_heading_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_heading_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_navigation',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_heading_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_navigation',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_mainmenu_heading_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_mainmenu_heading_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_navigation',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Paragraph.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_p_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_p_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_p_fontfamily]',
				array(
					'label'       => __( 'Paragraph font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_p',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_p_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_p_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_p_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_p',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_p_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_p_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_p_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_p',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_p_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_p_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_p_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_p',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_p_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_p_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_p_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_p',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Heading 1.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_h1_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_h1_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_h1_fontfamily]',
				array(
					'label'       => __( 'H1 font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h1',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h1_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h1_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h1_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h1',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h1_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h1_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h1_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h1',
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h1_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h1_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h1_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_headings_h1',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h1_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h1_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h1_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h1',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h1_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h1_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_h1_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_headings_h1',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Heading 2.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_h2_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_h2_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_h2_fontfamily]',
				array(
					'label'       => __( 'H2 font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h2',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h2_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h2_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h2_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h2',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h2_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h2_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h2_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h2',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h2_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h2_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h2_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_headings_h2',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h2_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h2_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h2_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h2',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h2_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h2_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_h2_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_headings_h2',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Heading 3.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_h3_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_h3_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_h3_fontfamily]',
				array(
					'label'       => __( 'H3 font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h3',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h3_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h3_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h3_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h3',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h3_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h3_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h3_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h3',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h3_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h3_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h3_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_headings_h3',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h3_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h3_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h3_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h3',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h3_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h3_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_h3_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_headings_h3',
				'priority'   => 10, // Optional. Order priority to load the control. Default: 10
				'type'       => 'color',
				'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
			)
		);

		// Heading 4.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_h4_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_h4_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_h4_fontfamily]',
				array(
					'label'       => __( 'H4 font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h4',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h4_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h4_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h4_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h4',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h4_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h4_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h4_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h4',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h4_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h4_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h4_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_headings_h4',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h4_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h4_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h4_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h4',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h4_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h4_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_h4_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_headings_h4',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Heading 5.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_h5_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_h5_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_h5_fontfamily]',
				array(
					'label'       => __( 'H5 font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h5',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h5_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h5_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h5_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h5',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h5_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h5_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h5_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h5',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h5_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h5_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h5_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_headings_h5',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h5_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h5_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_h5_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_headings_h5',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_h5_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_h5_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_h5_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_headings_h5',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Blockquote.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_blockquote_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_blockquote_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_blockquote_fontfamily]',
				array(
					'label'       => __( 'H5 font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blockquote',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blockquote_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blockquote_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blockquote_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blockquote',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blockquote_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blockquote_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blockquote_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blockquote',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blockquote_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blockquote_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blockquote_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_blockquote',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blockquote_font_tline_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blockquote_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blockquote_font_tline_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blockquote',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blockquote_font_tcolor]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blockquote_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_blockquote_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_blockquote',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Widget titles.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_widget_title_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_widget_title_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_widget_title_fontfamily]',
				array(
					'label'       => __( 'Widget title font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_widget_title',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_widget_title_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_widget_title_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_widget_title_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_widget_title',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_widget_title_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_widget_title_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_widget_title_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_widget_title',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_widget_title_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_widget_title_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_widget_title_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_widget_title',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_widget_title_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_widget_title_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_widget_title_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_widget_title',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_widget_title_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_widget_title_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_widget_title_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_widget_title',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Blog post.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_blog_post_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_blog_post_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_blog_post_fontfamily]',
				array(
					'label'       => __( 'Blog post font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blog',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blog_post_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blog_post_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blog_post_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blog',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blog_post_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blog_post_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blog_post_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blog',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blog_post_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blog_post_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blog_post_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_blog',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blog_post_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blog_post_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_blog_post_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_blog',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_blog_post_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_blog_post_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_blog_post_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_blog',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// WooCommerce.
		// Archives Category Description.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_archives_description_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_woocommerce_archives_description_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_archives_description_fontfamily]',
				array(
					'label'       => __( 'WooCommerce Archives description font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_archives_description_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_archives_description_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_archives_description_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_woocommerce',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_archives_description_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_archives_description_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_archives_description_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_woocommerce',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Archives Product Title.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_listings_title_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_woocommerce_listings_title_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_listings_title_fontfamily]',
				array(
					'label'       => __( 'WooCommerce product listings font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_listings_title_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_listings_title_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_listings_title_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_woocommerce',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_listings_title_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_listings_title_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_listings_title_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_woocommerce',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Single Product Title.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_single_title_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_woocommerce_single_title_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_single_title_fontfamily]',
				array(
					'label'       => __( 'WooCommerce single product page font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_single_title_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_single_title_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_single_title_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_woocommerce',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_line_height]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_single_title_font_line_height'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_line_height]',
				array(
					'label'       => __( 'Line height', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_single_title_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_single_title_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_woocommerce',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

		// Primary Buttons.
		$wp_customize->add_setting(
			'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_primary_button_fontfamily]',
			array(
				'default'           => $this->defaults['typog2_shoptimizer_typography2_woocommerce_primary_button_fontfamily'],
				'sanitize_callback' => 'shoptimizer_google_font_sanitization',
				'type'              => 'option',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Google_Font_Select_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[typog2_shoptimizer_typography2_woocommerce_primary_button_fontfamily]',
				array(
					'label'       => __( 'WooCommerce primary button font settings', 'shoptimizer' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_size]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_primary_button_font_size'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_size]',
				array(
					'label'       => __( 'Font size (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_letter_spacing]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_primary_button_font_letter_spacing'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_sanitize_decimal_int',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Slider_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_letter_spacing]',
				array(
					'label'       => __( 'Letter spacing (px)', 'shoptimizer' ),
					'section'     => 'shoptimizer_typography2_section_woocommerce',
					'input_attrs' => array(
						'min'  => -10,
						'max'  => 20,
						'step' => 0.1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_text_transform]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_primary_button_font_text_transform'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'shoptimizer_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Shoptimizer_Dropdown_Select2_Custom_Control(
				$wp_customize,
				'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_text_transform]',
				array(
					'label'   => __( 'Text transform', 'shoptimizer' ),
					'section' => 'shoptimizer_typography2_section_woocommerce',
					'choices' => array(
						'none'       => 'None',
						'capitalize' => 'Capitalize',
						'uppercase'  => 'Uppercase',
						'lowercase'  => 'Lowercase',
						'initial'    => 'Initial',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_color]',
			array(
				'default'           => $this->defaults['shoptimizer_typography2_woocommerce_primary_button_font_color'],
				'transport'         => 'refresh',
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'shoptimizer_settings[shoptimizer_typography2_woocommerce_primary_button_font_color]',
			array(
				'label'      => __( 'Font color' ),
				'section'    => 'shoptimizer_typography2_section_woocommerce',
				'priority'   => 10,
				'type'       => 'color',
				'capability' => 'edit_theme_options',
			)
		);

	}
}

/**
 * Load custom controls
 */
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/custom-controls.php';

/**
 * Initialise settings
 */
$shoptimizer_extended_settings = new Shoptimizer_Initialise_Extended_Customizer_Settings();
