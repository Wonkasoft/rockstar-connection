<?php
/**
 * This is the single template for the post type rsc_videos.
 *
 * You can override this template by making a copy in your theme folder.
 * your-theme/rockstar-connection/single-rsc_videos.php
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

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="container-fluid site-main">
			<div class="row">

		<?php
		while ( have_posts() ) : the_post();
			$post_id = get_the_ID();
			global $wp_embed;
			$current_link = ( get_post_meta( $post_id, 'link-' . $post_id, true ) ) ? get_post_meta( $post_id, 'link-' . $post_id, true ): ''; ?>

				<div class="col-12 content-panel text-center">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->


				<div class="entry-content">
					<div class="col rsc-video-single-display">
						<?php echo $wp_embed->run_shortcode( '[embed width="560" height="315"]' . $current_link . '[/embed]' ); ?>
					</div>
					<div class="rsc-excerpt-description">
						<?php the_excerpt(); ?>
					</div>
					<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rockstar-connection' ),
						'after'  => '</div>',
					) );
					?>
				</div><!-- .entry-content -->
				</div>  <!-- .col-lg-6 text-center -->
				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'rockstar-connection' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-<?php the_ID(); ?> -->


		<?php endwhile; // End of the loop.
		?>
			</div> <!-- /.row -->
			<?php
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
