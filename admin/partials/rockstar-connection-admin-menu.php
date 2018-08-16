<?php

/**
 * The file that builds the plugin menu
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Rockstar_Connection
 * @subpackage rockstar_connection/includes
 */

add_action( 'admin_menu', 'rockstar_connection_build_menu', 10 );

function rockstar_connection_build_menu() {
	/**
	* This will check for Wonkasoft Tools Menu, if not found it will make it.
	*/
	if ( empty ( $GLOBALS['admin_page_hooks']['wonkasoft_menu'] ) ) {

	global $rockstar_connection_page;
	$rockstar_connection_page = 'wonkasoft_menu';
	add_menu_page(
	'Wonkasoft',
	'Wonkasoft Tools',
	'manage_options',
	'wonkasoft_menu',
	'rockstar_connection_settings_display',
	ROCKSTAR_CONNECTION_IMG_PATH . "/wonka-logo-2.svg",
	100
	);

	add_submenu_page(
	'wonkasoft_menu',
	'Rockstar Connection',
	'Rockstar Connection',
	'manage_options',
	'wonkasoft_menu',
	'rockstar_connection_settings_display'
	);

	} else {

	/**
	* This creates option page in the settings tab of admin menu
	*/
	global $rockstar_connection_page;
	$rockstar_connection_page = 'rockstar_connection_settings_display';
	add_submenu_page(
	'wonkasoft_menu',
	'Rockstar Connection',
	'Rockstar Connection',
	'manage_options',
	'rockstar_connection_settings_display',
	'rockstar_connection_settings_display'
	);

	}
}