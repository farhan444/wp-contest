<?php
/**
 * Theme onboarding and help.
 *
 * @package CommerceGurus
 * @subpackage Shoptimizer
 */
class Shoptimizer_Help {

	/**
	 * Constructor
	 * Sets up the welcome screen
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'shoptimizer_help_register_menu' ) );
		add_action( 'load-themes.php', array( $this, 'shoptimizer_help_activation_admin_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'shoptimizer_help_assets' ) );

		add_action( 'shoptimizer_help', array( $this, 'shoptimizer_help_intro' ), 10 );
		add_action( 'shoptimizer_help', array( $this, 'shoptimizer_help_usefulplugins' ), 20 );
	}

	// End constructor.
	/**
	 * Redirect to Onboarding page upon theme switch/activation
	 */
	public function shoptimizer_help_activation_admin_init() {
		global $pagenow;

		if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) ) { // input var okay.
			add_action( 'admin_notices', array( $this, 'shoptimizer_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 *
	 * @since 1.0.3
	 */
	public function shoptimizer_welcome_admin_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'Thanks for choosing Shoptimizer! You can read hints and tips on how get the most out of your new theme in the %1$sHelp section%2$s.', 'shoptimizer' ), '<a href="' . esc_url( admin_url( 'themes.php?page=ccfw-help' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=ccfw-help' ) ); ?>" class="button" style="text-decoration: none;"><?php esc_html_e( 'Get started with Shoptimizer', 'shoptimizer' ); ?></a></p>
		</div>
		<?php
	}

	// Help assets.
	public function shoptimizer_help_assets( $hook_suffix ) {
		global $shoptimizer_version;

		if ( 'appearance_page_ccfw-help' === $hook_suffix ) {
			wp_enqueue_style( 'ccfw-help', get_template_directory_uri() . '/inc/setup/help.css', $shoptimizer_version );
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_script( 'ccfw-help', get_template_directory_uri() . '/inc/setup/help.js', array( 'jquery' ), '1.0.0', true );
		}
	}

	// Quick Start menu.
	public function shoptimizer_help_register_menu() {
		add_theme_page(
		__( 'Shoptimizer Help', 'shoptimizer' ), __( 'Shoptimizer Help', 'shoptimizer' ), 'activate_plugins', 'ccfw-help', array( $this, 'shoptimizer_help_screen' ) );
	}

	/**
	 * The welcome screen
	 *
	 * @since 1.0.0
	 */
	public function shoptimizer_help_screen() {
		?>
		<div class="ccfw-help container">

			<h1 class="ccfw-help-title"><?php esc_html_e( 'Shoptimizer Help', 'shoptimizer' ); ?></h1>
			<h2 class="ccfw-help-desc"><?php esc_html_e( 'Everything you need to know to get the most out of Shoptimizer.', 'shoptimizer' ); ?></h2>
			<ul class="ccfw-nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#intro" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting Started', 'shoptimizer' ); ?></a></li>
				<li role="presentation"><a href="#usefulplugins" aria-controls="usefulplugins" role="tab" data-toggle="tab"><?php esc_html_e( 'Useful Plugins', 'shoptimizer' ); ?></a></li>
			</ul>

			<div class="ccfw-tab-content">
		<?php
		/**
		 * @hooked shoptimizer_welcome_intro - 10
		 */
		do_action( 'shoptimizer_help' );
		?>


			</div>
		</div>
		<?php
	}

	/**
	 * Help - plugin list.
	 */
	public function shoptimizer_help_intro() {
		require_once( get_template_directory() . '/inc/setup/sections/intro.php' );
	}

	/**
	 * Help - plugin list.
	 */
	public function shoptimizer_help_usefulplugins() {
		require_once( get_template_directory() . '/inc/setup/sections/usefulplugins.php' );
	}

}

$GLOBALS['shoptimizer_help'] = new Shoptimizer_Help();
