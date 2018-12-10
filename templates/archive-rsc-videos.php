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
get_header(); ?>

<div class="wrap">

	<div id="primary" class="container-fluid content-area">
		<main id="main" class="site-main" role="main">
			<div class="spacer"></div>
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
					$terms = get_terms();
				if ( ! empty ( $terms ) ) : ?>
				<div class="row">
					<div class="col video-filter">
						<select class="video-filter-select" name="video-select">
							<?php
							foreach ($terms as $term ) : 
								if ( $term->taxonomy == 'category' ) :
								?>
								<option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
									
							<?php 
						endif;
						endforeach;
							?>
						</select>
					</div> <!-- video-filter -->
				</div> <!-- row -->
			<?php endif; ?>

				<div class="row">
		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				$post_id = get_the_ID();
				global $wp_embed;
				$current_link = ( get_post_meta( $post_id, 'link-' . $post_id, true ) ) ? get_post_meta( $post_id, 'link-' . $post_id, true ): ''; ?>
				<div class="col-12 col-md-4">
					<div class="post-module">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php if ( ! empty ( $current_link ) ) : ?>
								<div class="featured-image">
									<?php echo $wp_embed->run_shortcode( '[embed width="350" height="175"]' . $current_link . '[/embed]' ); ?>
								</div> <!-- featured-image -->
							<?php endif; ?>
							</header><!-- .entry-header -->


					<div class="entry-content">
						<?php the_title( '<a href="' . get_the_permalink() . '" class="post-title-link"><h1 class="entry-title">', '</h1></a>' ); ?>
						<hr />
						<?php
						the_excerpt();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rockstar-connection' ),
							'after'  => '</div>',
						) );
						?>
					</div><!-- .entry-content -->
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
			</div>  <!-- .post-module -->
			</div>  <!-- .columns -->

			<?php endwhile; ?>
				</div> <!-- /.row -->

		<?php the_posts_pagination( );

		else : ?>
			<section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'rockstar-connection' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<?php
					if ( is_home() && current_user_can( 'publish_posts' ) ) :

						printf(
							'<p>' . wp_kses(
								/* translators: 1: link to WP admin new post page. */
								__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rockstar-connection' ),
								array(
									'a' => array(
										'href' => array(),
									),
								)
							) . '</p>',
							esc_url( admin_url( 'post-new.php' ) )
						);

					elseif ( is_search() ) :
						?>

						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rockstar-connection' ); ?></p>
						<?php
						get_search_form();

					else :
						?>

						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rockstar-connection' ); ?></p>
						<?php
						get_search_form();

					endif;
					?>
				</div><!-- .page-content -->
			</section><!-- .no-results -->

		<?php endif; ?>

			</div> <!-- main-entry -->
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();