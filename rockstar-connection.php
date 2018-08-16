<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wonkasoft.com
 * @since             1.0.0
 * @package           Rockstar_Connection
 *
 * @wordpress-plugin
 * Plugin Name:       RockStar Connection
 * Plugin URI:        https://wonkasoft.com/rockstar-connection
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Wonkasoft
 * Author URI:        https://wonkasoft.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rockstar-connection
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
define( 'ROCKSTAR_CONNECTION_PATH', plugin_dir_path( __FILE__ ) );
define( 'ROCKSTAR_CONNECTION_NAME', plugin_basename( dirname( __FILE__ ) ) );
define( 'ROCKSTAR_CONNECTION_BASENAME', plugin_basename( __FILE__ ) );
define( 'ROCKSTAR_CONNECTION_IMG_PATH', plugins_url( ROCKSTAR_CONNECTION_NAME . '/admin/img' ) );
define( 'ROCKSTAR_CONNECTION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rockstar-connection-activator.php
 */
function activate_rockstar_connection() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rockstar-connection-activator.php';
	Rockstar_Connection_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rockstar-connection-deactivator.php
 */
function deactivate_rockstar_connection() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rockstar-connection-deactivator.php';
	Rockstar_Connection_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rockstar_connection' );
register_deactivation_hook( __FILE__, 'deactivate_rockstar_connection' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rockstar-connection.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rockstar_connection() {

	$plugin = new Rockstar_Connection();
	$plugin->run();

}
run_rockstar_connection();
