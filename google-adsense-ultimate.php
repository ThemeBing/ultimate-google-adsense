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
		add_action('admin_init', array($this, 'google_adsense_ultimate_setup'));
		add_action('admin_menu', array($this, 'admin_menu'));
	}

	// Text Domain
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'google-adsense-ultimate', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
	}

	// Plugin Setup
	public function google_adsense_ultimate_setup() {
		$args = array( 
		    'sanitize_callback' => array( $this, 'sanitize' ) // using a custom function to sanitize since the API doesn't allow array just yet
		);
		register_setting( 'google-adsense-ultimate-settings', 'easy_google_adsense_settings', $args );
		//register_setting( 'easygoogleadsensepage', 'easy_google_adsense_settings' );

		add_settings_section(
		        'easy_google_adsense_section', 
		        __('General Settings', 'easy-google-adsense'), 
		        array($this, 'easy_google_adsense_settings_section_callback'), 
		        'google-adsense-ultimate-settings'
		);

		add_settings_field( 
		        'publisher_id', 
		        __('Publisher ID', 'easy-google-adsense'), 
		        array($this, 'publisher_id_render'), 
		        'google-adsense-ultimate-settings', 
		        'easy_google_adsense_section' 
		);
	}

	// Create a Menu
	public function admin_menu() {
        if (is_admin()) {
        	// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
            add_menu_page(
	            __( 'Google Adsense Ultimate', 'google-adsense-ultimate' ),
	            __( 'Google Adsense Ultimate', 'google-adsense-ultimate' ),
	            'manage_options',
	            'google-adsense-ultimate-settings',
	            null,
	            plugin_dir_url( __FILE__ ) . 'assets/images/adsense-logo.png',
	            10,
	            array( $this, 'settings_page' )
	        );
        }
    }

    /**
     * Settings page display callback.
     */
    public function settings_page() {
        echo __( 'This is the page content', 'google-adsense-ultimate' );
    }

}

new GoogleAdsenseUltimate;

// add_action('admin_menu', 'my_menu_pages');
// function my_menu_pages(){
//     add_menu_page('My Page Title', 'My Menu Title', 'manage_options', 'my-menu', 'my_menu_output' );
//     add_submenu_page('my-menu', 'Submenu Page Title', 'Whatever You Want', 'manage_options', 'my-menu' );
//     add_submenu_page('my-menu', 'Submenu Page Title2', 'Whatever You Want2', 'manage_options', 'my-menu2' );
// }