<?php
/**
* The admin-specific functionality of the plugin.
*
* @link       https://wonkasoft.com
* @since      1.0.0
*
* @package    rockstar_connection
* @subpackage rockstar-connection/admin/partials
*/
/**
* The admin-specific functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*
* @package    rockstar_connection
* @subpackage rockstar-connection/admin/partials
* @author     Wonkasoft <info@wonkasoft.com>
*/
/**
 * add_filter for action links
 * @since  1.0.0 [<init>]
 */
add_filter( 'plugin_action_links_'. ROCKSTAR_CONNECTION_BASENAME, 'rockstar_connection_add_settings_link_filter' , 10, 1);

/**
 * [rockstar_connection_add_settings_link_filter description]
 * @param [array] $links [description]
 */
function rockstar_connection_add_settings_link_filter( $links ) { 
	global $rockstar_connection_page;
 $link_addon = '<a href="' . menu_page_url( $rockstar_connection_page, 0 ) . '" target="_self">Settings</a>';
 array_unshift( $links, $link_addon ); 
 $links[] = '<a href="https://paypal.me/Wonkasoft" target="_blank"><img src="' . plugin_dir_url( "rockstar-connection" ) . "rockstar-connection/admin/img/wonka-logo.svg" . '" style="width: 30px; height: 20px; display: inline-block; vertical-align: text-top; float: none;" /></a>';
 return $links; 
}

/**
 * 
 */
add_filter( 'plugin_row_meta', 'rockstar_connection_add_description_link_filter', 10, 2);

/**
 * [rockstar_connection_add_description_link_filter description]
 * @param  [array] $links [description]
 * @param  [type] $file  [description]
 * @return [type]        [description]
 */
function rockstar_connection_add_description_link_filter( $links, $file ) {
	global $rockstar_connection_page;
  if ( strpos($file, 'rockstar-connection.php') !== false ) {
    $links[] = '<a href="' . menu_page_url( $rockstar_connection_page, 0 ) . '" target="_self">Settings</a>';
    $links[] = '<a href="https://paypal.me/Wonkasoft" target="_blank">Donate <img src="' . plugin_dir_url( "rockstar-connection" ) . "rockstar-connection/admin/img/wonka-logo.svg" . '" style="width: 30px; height: 20px; display: inline-block; vertical-align: text-top;" /></a>';
  }
  return $links; 
}