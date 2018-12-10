<?php 
/**
 * Displaying the pmpro_levels shortcode.
 * 
 */

if ( function_exists( 'pmpro_wp' ) ) {
	add_action( 'wp', 'fix_pmpro_page_shortcode', 999 );
}
function fix_pmpro_page_shortcode() {
	remove_shortcode('pmpro_levels', 'pmpro_pages_shortcode' );
	add_shortcode('pmpro_levels', 'pmpro_shortcode_account_customized', 100 );
}

function custom_pmpro_getLevelCost( &$level, $tags = true, $short = false ) {
	// initial payment
	if ( ! $short ) {
		$r = sprintf( __( 'The price for membership is <strong>%s</strong> now', 'paid-memberships-pro' ), pmpro_formatPrice( $level->initial_payment ) );
	} else {
		$r = sprintf( __( '<span class="current-price">%s</span>', 'paid-memberships-pro' ), substr( pmpro_formatPrice( $level->initial_payment ), 0, strpos( pmpro_formatPrice( $level->initial_payment ), '.' ) ) );
	}

	// recurring part
	if ( $level->billing_amount != '0.00' ) {
		if ( $level->billing_limit > 1 ) {
			if ( $level->cycle_number == '1' ) {
				$r .= sprintf( __( ' and then <strong>%1$s per %2$s for %3$d more %4$s</strong>.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->billing_amount ), pmpro_translate_billing_period( $level->cycle_period ), $level->billing_limit, pmpro_translate_billing_period( $level->cycle_period, $level->billing_limit ) );
			} else {
				$r .= sprintf( __( ' and then <strong>%1$s every %2$d %3$s for %4$d more payments</strong>.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->billing_amount ), $level->cycle_number, pmpro_translate_billing_period( $level->cycle_period, $level->cycle_number ), $level->billing_limit );
			}
		} elseif ( $level->billing_limit == 1 ) {
			$r .= sprintf( __( ' and then <strong>%1$s after %2$d %3$s</strong>.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->billing_amount ), $level->cycle_number, pmpro_translate_billing_period( $level->cycle_period, $level->cycle_number ) );
		} else {
			if ( $level->billing_amount === $level->initial_payment ) {
				if ( $level->cycle_number == '1' ) {
					if ( ! $short ) {
						$r = sprintf( __( 'The price for membership is <strong>%1$s per %2$s</strong>.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->initial_payment ), pmpro_translate_billing_period( $level->cycle_period ) );
					} else {
						$r = sprintf( __( '<span class="current-price">%1$s</span>', 'paid-memberships-pro' ), substr( pmpro_formatPrice( $level->initial_payment ), 0, strpos( pmpro_formatPrice( $level->initial_payment ), '.' ) ) );
					}
				} else {
					if ( ! $short ) {
						$r = sprintf( __( 'The price for membership is <strong>%1$s every %2$d %3$s</strong>.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->initial_payment ), $level->cycle_number, pmpro_translate_billing_period( $level->cycle_period, $level->cycle_number ) );
					} else {
						$r = sprintf( __( '<strong>%1$s every %2$d %3$s</strong>.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->initial_payment ), $level->cycle_number, pmpro_translate_billing_period( $level->cycle_period, $level->cycle_number ) );
					}
				}
			} else {
				if ( $level->cycle_number == '1' ) {
					// removed this 'and then <strong>%1$s per %2$s</strong>.' from print below.
					$r .= sprintf( __( '', 'paid-memberships-pro' ), pmpro_formatPrice( $level->billing_amount ), pmpro_translate_billing_period( $level->cycle_period ) );
				} else {
					$r .= sprintf( __( ' and then <strong>%1$s every %2$d %3$s</strong>.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->billing_amount ), $level->cycle_number, pmpro_translate_billing_period( $level->cycle_period, $level->cycle_number ) );
				}
			}
		}
	} else {
		$r .= '.';
	}

	// add a space
	$r .= ' ';

	// trial part
	// if ( $level->trial_limit ) {
	// 	if ( $level->trial_amount == '0.00' ) {
	// 		if ( $level->trial_limit == '1' ) {
	// 			$r .= ' ' . __( 'After your initial payment, your first payment is Free.', 'paid-memberships-pro' );
	// 		} else {
	// 			$r .= ' ' . sprintf( __( 'After your initial payment, your first %d payments are Free.', 'paid-memberships-pro' ), $level->trial_limit );
	// 		}
	// 	} else {
	// 		if ( $level->trial_limit == '1' ) {
	// 			$r .= ' ' . sprintf( __( 'After your initial payment, your first payment will cost %s.', 'paid-memberships-pro' ), pmpro_formatPrice( $level->trial_amount ) );
	// 		} else {
	// 			$r .= ' ' . sprintf( __( 'After your initial payment, your first %1$d payments will cost %2$s.', 'paid-memberships-pro' ), $level->trial_limit, pmpro_formatPrice( $level->trial_amount ) );
	// 		}
	// 	}
	// }

	// taxes part
	$tax_state = pmpro_getOption( 'tax_state' );
	$tax_rate = pmpro_getOption( 'tax_rate' );

	if ( $tax_state && $tax_rate && ! pmpro_isLevelFree( $level ) ) {
		$r .= sprintf( __( 'Customers in %1$s will be charged %2$s%% tax.', 'paid-memberships-pro' ), $tax_state, round( $tax_rate * 100, 2 ) );
	}

	if ( ! $tags ) {
		$r = strip_tags( $r );
	}

	$r = apply_filters( 'pmpro_level_cost_text', $r, $level, $tags, $short ); // passing $tags and $short since v1.8
	return $r;
}

function pmpro_shortcode_account_customized() {	
	global $wpdb, $pmpro_msg, $pmpro_msgt, $current_user;

	$pmpro_levels = pmpro_getAllLevels(false, true);
	$pmpro_level_order = pmpro_getOption('level_order');

	if(!empty($pmpro_level_order))
	{
		$order = explode(',',$pmpro_level_order);

		//reorder array
		$reordered_levels = array();
		foreach($order as $level_id) {
			foreach($pmpro_levels as $key=>$level) {
				if($level_id == $level->id)
					$reordered_levels[] = $pmpro_levels[$key];
			}
		}

		$pmpro_levels = $reordered_levels;
	}

	$pmpro_levels = apply_filters("pmpro_levels_array", $pmpro_levels);

	if($pmpro_msg)
	{
	?>
	<div class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
	<?php
	}
	?>
	<section class="container">
		<div class="row module-section-row">
			<div class="col-12">
				<div class="row module-row">
					<?php	
					$count = 0;
					foreach($pmpro_levels as $level) :
					  if(isset($current_user->membership_level->ID))
						  $current_level = ($current_user->membership_level->ID == $level->id);
					  else
						  $current_level = false;
					?>
						<div class="col-12 col-md-6 module-col">
							<div class="membership-module<?php if($count++ % 2 == 0) { ?> odd<?php } ?><?php if($current_level == $level) { ?> active<?php } ?>">
								<div class="level-title">
									<h4><?php echo $current_level ? "<strong>{$level->name}</strong>" : $level->name ?></h4>
								<span class="separator-angle-in" style="height: 25px;" aria-hidden="true">
								  <svg class="angle-top-in" style="fill: currentColor;" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
								  	<polygon points="0,100 50,100 0,0"></polygon>
								  	<polygon points="50,100 100,100 100,0"></polygon>
								  </svg>
								</span>
								</div> <!-- evel-title -->
								<div class="level-price">
									
									<?php 
										if(pmpro_isLevelFree($level))
											$cost_text = __( '<span class="current-price">$0</span>', 'paid-memberships-pro' );
										else
											$cost_text = custom_pmpro_getLevelCost($level, true, true); 
											$expiration_text = pmpro_getLevelExpiration($level);
										if(!empty($cost_text) && !empty($expiration_text))
											echo $cost_text . "<br />" . $expiration_text;
										elseif(!empty($cost_text))
											echo $cost_text;
										elseif(!empty($expiration_text))
											echo $expiration_text;
									?>	
									
								</div> <!-- level-price -->
								<div class="level-plan-package-description">
									<p>
										<?php echo $level->description; ?>
									</p>
								</div> <!-- level-plan-package-items -->
								<div class="level-plan-button">
									<?php if(empty($current_user->membership_level->ID)) { ?>
										<a class="pmpro_btn pmpro_btn-select" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Select', 'paid-memberships-pro' );?></a>
									<?php } elseif ( !$current_level ) { ?>                	
										<a class="pmpro_btn pmpro_btn-select" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Select', 'paid-memberships-pro' );?></a>
									<?php } elseif($current_level) { ?>      
										
										<?php
											//if it's a one-time-payment level, offer a link to renew				
											if( pmpro_isLevelExpiringSoon( $current_user->membership_level) && $current_user->membership_level->allow_signups ) {
												?>
													<a class="pmpro_btn pmpro_btn-select" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Renew', 'paid-memberships-pro' );?></a>
												<?php
											} else {
												?>
													<a class="pmpro_btn disabled" href="<?php echo pmpro_url("account")?>"><?php _e('Your&nbsp;Level', 'paid-memberships-pro' );?></a>
												<?php
											}
										?>
										
									<?php } ?>
								</div> <!-- level-plan-button -->
							</div> <!-- membership-module -->
						</div> <!-- module-col -->
					<?php endforeach; ?>			
				</div> <!-- module-row -->
			</div> <!-- col-12 -->
		</div> <!-- module-section -->
	</section> <!-- container -->
	<nav id="nav-below" class="navigation" role="navigation">
		<div class="nav-previous alignleft">
			<?php if(!empty($current_user->membership_level->ID)) { ?>
				<a href="<?php echo pmpro_url("account")?>" id="pmpro_levels-return-account"><?php _e('&larr; Return to Your Account', 'paid-memberships-pro' );?></a>
			<?php } else { ?>
				<a href="<?php echo home_url()?>" id="pmpro_levels-return-home"><?php _e('&larr; Return to Home', 'paid-memberships-pro' );?></a>
			<?php } ?>
		</div>
	</nav>
<?php
}