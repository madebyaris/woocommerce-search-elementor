<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://madebyaris.com/
 * @since      1.0.0
 *
 * @package    Mba_Woo_Se
 * @subpackage Mba_Woo_Se/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mba_Woo_Se
 * @subpackage Mba_Woo_Se/includes
 * @author     M Aris Setiawan <arissetia.m@gmail.com>
 */
class Mba_Woo_Se_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mba-woo-se',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
