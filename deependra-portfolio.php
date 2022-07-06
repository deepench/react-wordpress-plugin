<?php
/**
 * Plugin Name: Deependra Portfolio
 * Plugin URI: https://wpretails.com
 * Description: This Plugin gives the portfolio of deependra.
 * Version: 1.0.0
 * Author: Deependra Portfolio
 * Author URI: https://wpretails.com
 * Text Domain: wpretail
 * Domain Path: /languages/
 * Requires at least: 5.4
 * Requires PHP: 5.6.20
 *
 * @package DeependraPortfolio
 */

// Exit if access directly.
defined( 'ABSPATH' ) || exit;

use DeependraPortfolio\DeependraPortfolio;

// WPRetail version.
if ( ! defined( 'DeependraPortfolio_VERSION' ) ) {
	define( 'DeependraPortfolio_VERSION', '1.0.0' );
}

// DeependraPortfolio root file.
if ( ! defined( 'DeependraPortfolio_PLUGIN_FILE' ) ) {
	define( 'DeependraPortfolio_PLUGIN_FILE', __FILE__ );
}

/**
 * Autoload packages.
 *
 * We want to fail gracefully if `composer install` has not been executed yet, so we are checking for the autoloader.
 * If the autoloader is not present, let's log the failure and display a nice admin notice.
 */
$autoloader = __DIR__ . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	include $autoloader;
} else {
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		error_log( // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			sprintf(
			/* translators: 1: composer command. 2: plugin directory */
				esc_html__( 'Your installation of the DeependraPortfolio plugin is incomplete. Please run %1$s within the %2$s directory.', 'deependra-portfolio' ),
				'`composer install`',
				'`' . esc_html( str_replace( ABSPATH, '', __DIR__ ) ) . '`'
			)
		);
	}

	/**
	 * Outputs an admin notice if composer install has not been ran.
	 *
	 * @since 1.0.0
	 */
	add_action(
		'admin_notices',
		function () {
			printf(
				'<div class="notice notice-error"><p>%s</p></div>',
				sprintf(
					/* translators: 1: composer command. 2: plugin directory */
					esc_html__( 'Your installation of the DeependraPortfolio plugin is incomplete. Please run %1$s within the %2$s directory.', 'deependra-portfolio' ),
					'<code>composer install</code>',
					'<code>' . esc_html( str_replace( ABSPATH, '', __DIR__ ) ) . '</code>'
				)
			);
		}
	);
	return;
}


/**
 * Main instance of DeependraPortfolio.
 *
 * Returns the main instance of EVF to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return DeependraPortfolio
 */
function deependra_portfolio() {
	return DeependraPortfolio::instance();
}

deependra_portfolio();
