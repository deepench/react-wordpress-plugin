<?php

namespace DeependraPortfolio;


defined( 'ABSPATH' ) || exit;


/**
 * Main plugin class.
 *
 * @since 1.0.0
 */
final class DeependraPortfolio {

	/**
	 * The single instance of the class.
	 *
	 * @since 1.0.0
	 * @var object
	 */
	protected static $instance;

	/**
	 * Prevent cloning.
	 *
	 * @since 1.0.0
	 */
	private function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cloning is forbidden.', 'wpretail' ), '1.0.0' );
	}

	/**
	 * Prevent unserializing.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Unserializing instances of this class is forbidden.', 'wpretail' ), '1.0.0' );
	}

	/**
	 * Main WPRetail Instance.
	 *
	 * Ensures only one instance of WPRetail is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @static
	 * @see   DeependraPortfolio()
	 * @return WPRetail - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * WPRetail Constructor.
	 */
	public function __construct() {
		do_action( 'deependraportfolio_loaded' );
		$this->init_hooks();
	}

	/**
	 * Init hooks.
	 *
	 * @version 1.0.0
	 * @since void
	 */
	public function init_hooks(){
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

	}


	/**
	 * Load Localization files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/deependra-portfolio/deependra-portfolio-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/deependra-portfolio-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'deependra-portfolio' );

		load_textdomain( 'deependra-portfolio', WP_LANG_DIR . '/deependra-portfolio/deependra-portfolio-' . $locale . '.mo' );
		load_plugin_textdomain( 'deependra-portfolio', false, plugin_basename( dirname( EVF_CONVERSATIONAL_FORMS_PLUGIN_FILE ) ) . '/languages' );
	}



}
