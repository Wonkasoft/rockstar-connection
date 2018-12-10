<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/admin
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Rockstar_Connection_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $page ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rockstar_Connection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rockstar_Connection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$style = 'bootstrap';
			if( ! wp_style_is( $style, 'enqueued' ) &&  ! wp_style_is( $style, 'done' ) ) {
			// Check page to load bootstrapjs only on settings page
	    	// Enqueue bootstrap CSS
				wp_enqueue_style( $style, 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' , array(), '4.0.0', 'all');

			}
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rockstar-connection-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $page ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rockstar_Connection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rockstar_Connection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rockstar-connection-admin.js', array( 'jquery' ), $this->version, false );

	}

	function rockstar_connection_register_settings() {
		/**
		 * This file adds actions links for Rockstar Connection.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rockstar-connection-settings.php';
	}

}
