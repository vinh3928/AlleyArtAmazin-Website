<?php
	global $sama_options;
	$page_id = $sama_options['current_page_id'];
	$remove_top_bottom_footer 	= array();
	$remove_top_footer			= array();
	$remove_bottom_footer		= array();
	if( isset( $sama_options['remove_top_bottom_footer'] ) && ! empty( $sama_options['remove_top_bottom_footer'] ) ) {
		$remove_top_bottom_footer = $sama_options['remove_top_bottom_footer'];
	}
	if( isset( $sama_options['remove_top_footer'] ) && ! empty( $sama_options['remove_top_footer'] ) ) {
		$remove_top_footer = $sama_options['remove_top_footer'];
	}
	if( isset( $sama_options['remove_bottom_footer'] ) && ! empty( $sama_options['remove_bottom_footer'] ) ) {
		$remove_bottom_footer = $sama_options['remove_bottom_footer'];
	}
	
	if( isset( $sama_options['display_top_bottom_footer'] ) && $sama_options['display_top_bottom_footer'] ) {
		if( ! in_array( $page_id, $remove_top_bottom_footer) ) {
?>        
			<!-- # Start Footer #  -->
			<footer id="footer">
				
				<?php 
					if( isset( $sama_options['display_widegt_footer'] ) && $sama_options['display_widegt_footer'] ) {
						if( ! in_array( $page_id, $remove_top_footer) ) {
				?>
								<!-- # Top Footer # -->
								<div class="top-footer">
									<div class="container">
										<div class="row">
											<?php if( isset( $sama_options['footer_widegt_type'] ) && $sama_options['footer_widegt_type'] == '3columnsbigleft' ) { ?>
												<div class="col-md-6  col-sm-12 col-xs-12">
													<?php dynamic_sidebar('footer'); ?>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-6">
													<?php dynamic_sidebar('footer-2'); ?>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-6">
													<?php dynamic_sidebar('footer-3'); ?>
												</div>
											<?php } elseif( isset( $sama_options['footer_widegt_type'] ) && $sama_options['footer_widegt_type'] == '3columns' ) { ?>
												<div class="col-md-4 col-sm-4">
													<?php dynamic_sidebar('footer'); ?>
												</div>
												<div class="col-md-4  col-sm-4">
													<?php dynamic_sidebar('footer-2'); ?>
												</div>
												<div class="col-md-4  col-sm-4">
													<?php dynamic_sidebar('footer-3'); ?>
												</div>
											<?php } else { //4columns?>
												<div class="col-md-3  col-sm-6 col-xs-6">
													<?php dynamic_sidebar('footer'); ?>
												</div>
												<div class="col-md-3  col-sm-6 col-xs-6">
													<?php dynamic_sidebar('footer-2'); ?>
												</div>
												<div class="col-md-3  col-sm-6 col-xs-6">
													<?php dynamic_sidebar('footer-3'); ?>
												</div>
												<div class="col-md-3  col-sm-6 col-xs-6">
													<?php dynamic_sidebar('footer-4'); ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
				<?php   } ?>				
			<?php   }  ?>
				<!--  End # Top Footer # -->
			
			<?php
				if( isset( $sama_options['display_bottom_footer'] ) && $sama_options['display_bottom_footer'] ) {
					if( ! in_array( $page_id, $remove_bottom_footer) ) {
			?>
							<!-- # Bottom Footer # -->
							<?php
								$bottom_fo_bg 	= 'bottom-footer';
								$bottom_fo_pad	= 'pad-top-bottom-20';
								if( isset( $sama_options['footer_bottom_bg'] ) && ! empty( $sama_options['footer_bottom_bg'] ) ) {
									$bottom_fo_bg 	= esc_attr( $sama_options['footer_bottom_bg'] );
								}
								if( isset( $sama_options['footer_bottom_pad'] ) && ! empty( $sama_options['footer_bottom_pad'] ) ) {
									$bottom_fo_pad 	= esc_attr( $sama_options['footer_bottom_pad'] );
								}
								$bootom_footer_css = $bottom_fo_bg .' '. $bottom_fo_pad ;
							?>
							<div class="<?php echo esc_attr( $bootom_footer_css ); ?>">
								<div class="container">
									<div class="row">
										<?php 
											if( isset( $sama_options['footer_share_icon'] ) && ! $sama_options['footer_share_icon'] ) {
										?>
												<div class="container">
													<div class="row">
														<div class="col-md-12 text-center">
															<?php echo wp_kses_post( $sama_options['bt_footer_content'] ); ?>
														</div>
													</div>
												</div>
										<?php } else { ?>
												<div class="col-md-6 text-left">
													<?php echo wp_kses_post( $sama_options['bt_footer_content'] ); ?>
												</div>
												<div class="col-md-6">
													<ul class="social-network-footer_2">
														<?php if( isset( $sama_options['facebook'] ) && ! empty ( $sama_options['facebook'] ) ) { ?>
															<li><a href="<?php echo esc_url( $sama_options['facebook'] ); ?>"><i class="fa fa-facebook"></i></a></li>
														<?php } ?>
														<?php if( isset( $sama_options['twitter'] ) && ! empty ( $sama_options['twitter'] ) ) { ?>
															<li><a href="<?php echo esc_url( $sama_options['twitter'] ); ?>"><i class="fa fa-twitter"></i></a></li>
														<?php } ?>
														<?php if( isset( $sama_options['dribbble'] ) && ! empty ( $sama_options['dribbble'] ) ) { ?>
															<li><a href="<?php echo esc_url( $sama_options['dribbble'] ); ?>"><i class="fa fa-dribbble"></i></a></li>
														<?php } ?>
														<?php if( isset( $sama_options['linkedin'] ) && ! empty ( $sama_options['linkedin'] ) ) { ?>
															<li><a href="<?php echo esc_url( $sama_options['linkedin'] ); ?>"><i class="fa fa-linkedin"></i></a></li>
														<?php } ?>
														<?php if( isset( $sama_options['gplus'] ) && ! empty ( $sama_options['gplus'] ) ) { ?>
															<li><a href="<?php echo esc_url( $sama_options['gplus'] ); ?>"><i class="fa fa-google-plus"></i></a></li>
														<?php } ?>
														<?php if( isset( $sama_options['youtube'] ) && ! empty ( $sama_options['youtube'] ) ) { ?>
															<li><a href="<?php echo esc_url( $sama_options['youtube'] ); ?>"><i class="fa fa-youtube"></i></a></li>
														<?php } ?>
														<?php if( isset( $sama_options['rss'] ) && ! empty ( $sama_options['rss'] ) ) { ?>
															<li><a href="<?php echo esc_url( $sama_options['rss'] ); ?>"><i class="fa fa-rss"></i></a></li>
														<?php } ?>
													</ul>
												</div>
										<?php } ?>
									</div>
								</div>
							</div>
			<?php   
					}
				}
			?>	
			</footer>
<?php 
		}
	}
	do_action('sama_after_footer_end');
?>   
    </section>
    
    <!-- * Start / Scroll to top *  -->
    <div id="back-top">
        <a href="#top"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- * End / Scroll to top*  -->


<?php wp_footer(); ?>
</body>
</html>