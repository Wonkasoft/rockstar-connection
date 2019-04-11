<?php
/**
 * This is the archive template for the post type rsc_videos.
 *
 * You can override this template by making a copy in your theme folder.
 * your-theme/rockstar-connection/archive-rsc_videos.php
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
	
	if( !empty( $user_id ) ) {
		$level = pmpro_getMembershipLevelForUser( $user_id );
	}

	if( !empty( $level ) ) {
		$level_id = $level->id;
	} else {
		$level_id = 0;	//non-member user
	}
		
	$pmpro_bp_options = pmpro_bp_get_level_options( $level_id );

	if( $pmpro_bp_options['pmpro_bp_restrictions'] == -1 ) {
		pmpro_bp_redirect_to_access_required_page();
	}
endif;

$wp_query->query_vars['posts_per_page'] = 6;
if ( is_user_logged_in() ) : get_header( 'connected' ); else: get_header(); endif; ?>

<div class="wrap">

	<div id="primary" class="container-fluid content-area">
		<main id="main" class="site-main" role="main">
			<div class="spacer"></div>         
			<?php
			if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					$post_id = get_the_ID();
					global $wp_embed;
					$current_link = ( get_post_meta( $post_id, 'link-' . $post_id, true ) ) ? get_post_meta( $post_id, 'link-' . $post_id, true ): ''; ?>
						<div class="post-slide">
							<?php if ( ! empty ( $current_link ) ) : ?>
								<?php echo $wp_embed->run_shortcode( '[embed width="350" height="175"]' . $current_link . '[/embed]' ); ?>
							<?php endif; ?>
						</div> <!-- /post-slide -->
				<?php endwhile; 
			endif; ?>
			<div class="left-sidebar">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'rsc_videos_menu',
					'menu_id'        => 'rsc-videos-menu',
					'class'        => 'video-menu',
					'before'        => '<i class="fa"></i>',
				) );
				?>
			</div>
			<div class="main-entry-archive">
			<?php		
			echo do_shortcode( '[yotuwp type="channel" id="UCLjWtv5lBDc8ZUqNVOpS_Ng" ]', false );
		?>

			</div> <!-- main-entry -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();