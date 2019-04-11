<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/includes
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Rockstar_Connection_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		set_transient( 'rsc_ep_flush', 1, 60 );
	}

}
