<?php
/**
* The admin-specific functionality of the plugin.
* This is used to build settings.
*
* @link       https://wonkasoft.com
* @since      1.0.0
*
* @package    Rockstar_Connection
* @subpackage rockstar-connection/admin/partials
*/

/**
 * This creates settings area that is displayed on options page
**/
add_settings_section( 
	'rockstar_connection_api_collection', 
	'Enter API Key for Integrations', 
	null,
	'rockstar_connection_admin_display'
);

/**
 * This creates settings field that is displayed on options page
 */
add_settings_field(
	'blank_api_key_field',
	'Enter Blank api Key',
	'blank_api_key',
	'rockstar_connection_admin_display',
	'rockstar_connection_api_collection'
);

/**
 * This registers the setting group.
 */
register_setting( 
	'rockstar_connection_setting_group', 
	'blank_api_key_field',
	array( 
		'type'				=>	'string',
		'description'		=>	'This is an API Key for Blank',
		'sanitize_callback'	=>	'rockstar_connection_blank_api_key',
		'show_in_rest'		=>	true,
		'default'			=> null,
	)
);

function blank_api_key( $args ) {
	var_dump($args);
	var_dump(get_option('blank_api_key_field'));
	$blank_api_key = ( get_option( 'blank_api_key_field' ) ) ? esc_attr( get_option( 'blank_api_key_field' ) ): '';

	$output = '';

	$output .= '<input type="text" name="blank_api_key_field" size="35" value="' . $blank_api_key . '" />';

	echo $output;
}