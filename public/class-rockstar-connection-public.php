<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/public
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Rockstar_Connection_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( 'slick-styles', plugin_dir_url( __FILE__ ) . 'slick/slick.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'slick-theme-styles', plugin_dir_url( __FILE__ ) . 'slick/slick-theme.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rockstar-connection-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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
		wp_enqueue_script( 'slick-js-slider', plugin_dir_url( __FILE__ ) . 'slick/slick.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rockstar-connection-public.js', array( 'jquery','slick-js-slider' ), $this->version, true );

	}

}