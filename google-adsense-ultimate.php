<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ThemeBing.com
 * @since             1.0.0
 * @package           Google Adsense Ultimate
 *
 * @wordpress-plugin
 * Plugin Name:       Google Adsense Ultimate
 * Plugin URI:        https://ThemeBing.com/google-adsense-ultimate
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ThemeBing
 * Author URI:        https://ThemeBing.com
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
		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('admin_init', array($this, 'google_adsense_ultimate_field'));
	}

	// Text Domain
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'google-adsense-ultimate', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
	}

	// Create a Menu
	public function admin_menu() {
        if (is_admin()) {
            add_menu_page( __( 'Google Adsense Ultimate', 'google-adsense-ultimate' ),  __( 'Google Adsense Ultimate', 'google-adsense-ultimate' ), 'manage_options', 'google-adsense-ultimate-settings', array( $this, 'settings_page' ), plugin_dir_url( __FILE__ ) . 'assets/images/adsense-logo.png', 10 );
        }
    }

    /**
     * Settings page display callback.
     */
    function settings_page() { ?>
	    <div class="wrap">               
        	<h1><?php echo esc_html__( 'Google AdSense Ultimate', 'google-adsense-ultimate' ) ?></h1>

	        <form action='options.php' method='post'>
		        <?php
		        settings_fields('google_adsense_ultimate_group');
		        do_settings_sections('google-adsense-ultimate-settings');
		        submit_button();
		        ?>
	        </form>
        </div>
    <?php }









	// Plugin input field
	public function google_adsense_ultimate_field() {

		add_settings_section( 'google_adsense_ultimate_section', __('General Settings', 'google-adsense-ultimate'), array($this, 'google_adsense_ultimate_section_callback'), 'google-adsense-ultimate-settings' );

	    register_setting( 'google_adsense_ultimate_group', 'google_adsense_ultimate_name', array(
	        'type' => 'string',
	        'sanitize_callback' => 'sanitize_text_field',
	        'default' => NULL,
	    ) );

	    add_settings_field( 'google_adsense_ultimate_field', __('Publisher ID', 'google-adsense-ultimate'),  array($this, 'google_adsense_ultimate_setting_callback'), 'google-adsense-ultimate-settings', 'google_adsense_ultimate_section' );
	}

	// ------------------------------------------------------------------
	// Google adsense ultimate callback function
	// ------------------------------------------------------------------
	//
	// This function is needed if we added a new section. This function 
	// will be run at the start of our section
	//
	 
	 function google_adsense_ultimate_section_callback() {
	 	echo '<p>Intro text for our settings section</p>';
	 }

	// ------------------------------------------------------------------
	// Callback function for our example setting
	// ------------------------------------------------------------------
	//
	// creates a checkbox true/false option. Other types are surely possible
	//
	 
	 function google_adsense_ultimate_setting_callback() {
	 	echo '<input name="eg_setting_name" id="eg_setting_name" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'eg_setting_name' ), false ) . ' /> Explanation text';
	 }
	 


    

}

new GoogleAdsenseUltimate;