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
  
  if( !empty( $user_id ) ) {
    $level = pmpro_getMembershipLevelForUser( $user_id );
  }

  if( !empty( $level ) ) {
    $level_id = $level->id;
  } else {
    $level_id = 0;  //non-member user
  }
    
  $pmpro_bp_options = pmpro_bp_get_level_options( $level_id );

  if( $pmpro_bp_options['pmpro_bp_restrictions'] == -1 ) {
    pmpro_bp_redirect_to_access_required_page();
  }
endif;

if ( is_user_logged_in() ) : get_header( 'connected' ); else: get_header(); endif; ?>
?>
  <div id="primary" class="content-area">
    <i class="fa fa-volume-up" aria-hidden="true"> Mute</i>
    <main id="main" class="container-fluid site-main">
      <div class="row">
        <iframe src="/wp-content/uploads/2019/01/WelcomeToRockStar.mp3" allow="autoplay" id="audio" style="display:none"></iframe>
        
        <audio id="player1" autoplay>
          <source src="/wp-content/uploads/2019/01/WelcomeToRockStar.mp3" type="audio/mp3">
        </audio>
        <?php echo do_shortcode( '[ipanorama slug="virtual-networking-room"]'); ?>
      </div> <!-- /row -->
    </main><!-- #main -->
  </div><!-- #primary -->

  <script>
 
    (function($) {
     
        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
          if(!isChrome){
            $('#player1').remove();
          }
        else{
           $('#audio').remove(); //just to make sure that it will not have 2x audio in the background 
        }

        setTimeout(function() { 
          $( "#player1" ).attr('src', '/wp-content/uploads/2019/01/vroombackgroundmusic.mp3' ).attr('loop','loop');
        }, 8500 );

        $( ".fa-volume-up" ).click(function() {
          if ( $( "#player1" ).attr('src') == '' ) {
            $( "#player1" ).attr('src', '/wp-content/uploads/2019/01/vroombackgroundmusic.mp3' );
            $( ".fa-volume-off" ).addClass( "fa-volume-up" ).delay(1000);
            $( ".fa-volume-up" ).removeClass( "fa-volume-off" ).text('Mute');
          } else {
            $( "#player1" ).attr('src', '');
            $( ".fa-volume-up" ).addClass( "fa-volume-off" ).delay(1000);
            $( ".fa-volume-off" ).removeClass( "fa-volume-up" ).text('Un-mute');
          }
        });

    })( jQuery );

  </script>

<?php
get_footer();
