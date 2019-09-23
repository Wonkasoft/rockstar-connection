<?php
/**
 * This is the single template for the post type rsc_vroom.
 *
 * You can override this template by making a copy in your theme folder.
 * your-theme/rockstar-connection/vroom-rsc-vroom.php
 *
 * @since 1.0.0
 * @package rockstar-connection
 */

/**
 * This is for is pmpro_buddypress is installed and being used to lock down buddypress.
 */
if ( function_exists( 'pmpro_bp_lockdown_all_bp' ) ) :
	global $current_user;
	$user_id = $current_user->ID;

	if ( ! empty( $user_id ) ) {
		$level = pmpro_getMembershipLevelForUser( $user_id );
	}

	if ( ! empty( $level ) ) {
		$level_id = $level->id;
	} else {
		$level_id = 0;  // non-member user
	}

	$pmpro_bp_options = pmpro_bp_get_level_options( $level_id );

	if ( $pmpro_bp_options['pmpro_bp_restrictions'] == -1 ) {
		pmpro_bp_redirect_to_access_required_page();
	}
endif;

if ( is_user_logged_in() ) :
	get_header( 'connected' );
else :
	get_header();
endif; ?>

  <div id="primary" class="content-area">
	<main id="main" class="container-fluid site-main">
	  <div class="row">
		<?php echo do_shortcode( '[ipano id="1"]' ); ?>
	  </div> <!-- /row -->
	</main><!-- #main -->
  </div><!-- #primary -->


<?php
get_footer();
