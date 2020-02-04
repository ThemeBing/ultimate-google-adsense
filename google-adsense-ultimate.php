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
		add_action('admin_init', array($this, 'google_adsense_ultimate_init'));
		add_action('wp_head', array($this, 'add_adsense_code_to_header'));
	}

	// Text Domain
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'google-adsense-ultimate', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
	}

	// Create a Menu
	public function admin_menu() {
        if (is_admin()) {
            add_menu_page( __( 'Google Adsense Ultimate', 'google-adsense-ultimate' ),  __( 'Google Adsense Ultimate', 'google-adsense-ultimate' ), 'manage_options', 'google-adsense-ultimate', array( $this, 'settings_page_content' ), plugin_dir_url( __FILE__ ) . 'assets/images/adsense-logo.png', 10 );
        }
    }

    /**
     * Settings page display callback.
     */
    function settings_page_content() { ?>
	    <div class="wrap">               
        	<h1><?php echo esc_html__( 'Google AdSense Ultimate', 'google-adsense-ultimate' ) ?></h1>

			<div class="update-nag">
				<?php echo esc_html__('Please visit the', 'google-adsense-ultimate' ); ?>
				<a target="_blank" href="http://www.themebing.com/"><?php echo esc_html__('Google AdSense Ultimate', 'google-adsense-ultimate' ); ?></a>
				<?php echo esc_html__('documentation page for full setup instructions.', 'google-adsense-ultimate' ); ?>
			</div>

	        <form action='options.php' method='post'>
		        <?php
		        settings_fields('google_adsense_ultimate_group');
		        do_settings_sections('google_adsense_ultimate_settings');
		        submit_button();
		        ?>
	        </form>
        </div>
    <?php }



	// Plugin input fields init
	public function google_adsense_ultimate_init() {

		register_setting( 'google_adsense_ultimate_group', 'google_adsense_ultimate_option', array(
	        'type' => 'string',
	        'sanitize_callback' => 'sanitize_text_field',
	        'default' => NULL,
	    ) );

		add_settings_section( 'google_adsense_ultimate_section', __('General Settings', 'google-adsense-ultimate'), array($this, 'google_adsense_ultimate_section_callback'), 'google_adsense_ultimate_settings' );

		add_settings_field( 'google_adsense_ultimate_field', __('Publisher ID', 'google-adsense-ultimate'),  array($this, 'google_adsense_ultimate_setting_callback'), 'google_adsense_ultimate_settings', 'google_adsense_ultimate_section' );
	}

	// ------------------------------------------------------------------
	// callback function for google_adsense_ultimate_group
	// ------------------------------------------------------------------
	
	function google_adsense_ultimate_section_callback() {
	 	echo '<p>Please enter your Publisher ID </p>';
	}

	// ------------------------------------------------------------------
	// Callback function for google_adsense_ultimate_field
	// ------------------------------------------------------------------
	function google_adsense_ultimate_setting_callback() { ?>

            <input type='text' class="regular-text" name="google_adsense_ultimate_option" value="<?php echo get_option('google_adsense_ultimate_option') ?>">

            <p class="description">
            	<?php printf(__('Enter your Google AdSense Publisher ID (e.g %s).', 'easy-google-adsense'), 'pub-1234567890111213');?>
            </p>

        <?php
	}



	public function add_adsense_code_to_header(){

	}

}

new GoogleAdsenseUltimate;