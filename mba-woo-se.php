<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://madebyaris.com/
 * @since             1.0.0
 * @package           Mba_Woo_Se
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Search Elementor
 * Plugin URI:        https://github.com/madebyaris/woocommerce-search-elementor
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            M Aris Setiawan
 * Author URI:        https://madebyaris.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mba-woo-se
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MBA_WOO_SE_VERSION', '1.0.0' );

/**
 * View the full path directory.
 */
if ( ! defined( 'MBA_WOO_SE_DIR' ) ) {
	define( 'MBA_WOO_SE_DIR', plugin_dir_path( __FILE__ ) );
}
/**
 * View the url directory.
 */
if ( ! defined( 'MBA_WOO_SE_URL' ) ) {
	define( 'MBA_WOO_SE_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * View the name of the directory.
 */
if ( ! defined( 'MBA_WOO_SE_DIR_NAME' ) ) {
	define( 'MBA_WOO_SE_DIR_NAME', basename( __DIR__ ) );
}

/**
 * Get the plugin root file.
 */
if ( ! defined( 'MBA_WOO_SE_NAME_FILE' ) ) {
	define( 'MBA_WOO_SE_NAME_FILE', __FILE__ );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mba-woo-se-activator.php
 */
function activate_mba_woo_se() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mba-woo-se-activator.php';
	Mba_Woo_Se_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mba-woo-se-deactivator.php
 */
function deactivate_mba_woo_se() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mba-woo-se-deactivator.php';
	Mba_Woo_Se_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mba_woo_se' );
register_deactivation_hook( __FILE__, 'deactivate_mba_woo_se' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mba-woo-se.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mba_woo_se() {

	$plugin = new Mba_Woo_Se();
	$plugin->run();

}
run_mba_woo_se();
