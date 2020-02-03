<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ThemeBeyond.com
 * @since             1.0.0
 * @package           Google Adsense Element
 *
 * @wordpress-plugin
 * Plugin Name:       Google Adsense Element
 * Plugin URI:        https://ThemeBeyond.com/google-adsense-ultimate
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ThemeBeyond
 * Author URI:        https://ThemeBeyond.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       google-adsense-ultimate
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class GoogleAdsenseUltimate {

	// Initialized
	function __construct() {
		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
		add_action('admin_init', array($this, 'google_adsense_ultimate_setup'));
	}

	// Text Domain
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'google-adsense-ultimate', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
	}

	// Plugin Setup
	public function google_adsense_ultimate_setup() {

	}

}
new GoogleAdsenseUltimate();