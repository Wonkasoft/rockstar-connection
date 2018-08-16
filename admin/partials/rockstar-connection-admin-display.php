<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/admin/partials
 */
is_admin() && current_user_can( 'manage_options' ) || exit;
?>

<div class="page-wrap">
	<form method="post" action="options.php">
		<?php settings_fields( 'rockstar_connection_setting_group' ); ?>
		<?php do_settings_sections( 'rockstar_connection_admin_display' ); ?>
		<?php submit_button(); ?>
	</form>
</div>