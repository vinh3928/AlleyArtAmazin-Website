<?php global $sama_options; ?>
<!-- * Start / Navigation*  -->
<?php
	$remove_top_header      = array();
	$css_vertical 			= ' vertical';
	if( isset( $sama_options['remove_top_header'] ) && ! empty( $sama_options['remove_top_header'] ) ) {
		$remove_top_header = $sama_options['remove_top_header'];
	}
	
	if( in_array( $sama_options['current_page_id'], $remove_top_header)  ) {
		$css_vertical = '';
	}
?>
<div id="slidemenu" class="menu<?php echo esc_attr( $css_vertical ); ?>">
	<!-- # Menu Content #  -->
	<div class="slidemeu-content">
		<?php
			if( ! in_array( $sama_options['current_page_id'], $remove_top_header)  ) {
		?>
		<!-- # Logo Rotate #  -->
		<div class="outside-logo">
			<?php
				if( isset( $sama_options['vertical_logo_outside'] ) && ! empty( $sama_options['vertical_logo_outside'] ) ) {
					$logo_url = $sama_options['vertical_logo_outside']['url'];
				} else {
					$logo_url = get_template_directory_uri() .'/img/logo/logo_rotate.png';
				}
			?>
			<a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>">
				<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo('name'); ?>">
			</a>
		</div>
		<!-- # End Logo #  -->
		<?php } ?>
		<div class="content-inside">
			
			 <!-- # Logo #  -->
			<div class="logo">
				<?php
					if( isset( $sama_options['vertical_logo_inside'] ) && ! empty( $sama_options['vertical_logo_inside'] ) ) {
						$logo_url = $sama_options['logo_url_inside_menu']['url'];
					} else {
						$logo_url = get_template_directory_uri() .'/img/logo/logo@2x.png';
					}
				?>
				<a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url( $logo_url ); ?>" width="127" height="27" alt="<?php bloginfo('name'); ?>">
				</a>
			</div>
            <!-- # End Logo #  -->
			
			<!-- # Links #  -->
			<nav id="top-menu" class="links">
				<?php 
					if ( function_exists( 'has_nav_menu' ) ) {
						$menu_used = 'top-menu';
						$land_page_menu 	= array();
						$one_page_menu 		= array();
						if( isset( $sama_options['landing_menu'] ) && ! empty( $sama_options['landing_menu'] ) ) {
							$land_page_menu = $sama_options['landing_menu'];
						}
						if( isset( $sama_options['one_page_menu'] ) && ! empty( $sama_options['one_page_menu'] ) ) {
							$one_page_menu = $sama_options['one_page_menu'];
						}
						if( in_array( $sama_options['current_page_id'], $land_page_menu)  ) {
							$menu_used = 'landing-page-menu';
						}
						if( in_array( $sama_options['current_page_id'], $one_page_menu)  ) {
							$menu_used = 'one-page-menu';
						}
						
						wp_nav_menu( array( 'theme_location' => $menu_used, 'depth' => 4, 'container' => 'ul', 'menu_class' => '', 'fallback_cb' => 'sama_fallbacktopmenu', 'walker' => new Rozana_walker_nav_menu ) );
					} 
				?>
			</nav>
			<!-- # End Links #  -->
			<?php
				$remove_phone = array();
				if( isset( $sama_options['remove_phone_menu'] ) && ! empty( $sama_options['remove_phone_menu'] ) ) {
					$remove_phone = $sama_options['remove_phone_menu'];
				}
				if( ! in_array( $sama_options['current_page_id'], $remove_phone)  ) {
			?>
					<div class="menu-info">
						<?php if( isset( $sama_options['menu_phone_1'] ) && ! empty( $sama_options['menu_phone_1'] ) ) { ?>
							<div>
								<i class="fa fa-phone"></i>
								<span><?php echo esc_attr( $sama_options['menu_phone_1'] ); ?></span>
							</div>
						<?php } ?>
						<?php if( isset( $sama_options['menu_phone_2'] ) && ! empty( $sama_options['menu_phone_2'] ) ) { ?>
							<div>
								<i class="fa fa-envelope-o"></i>
								<span><?php echo esc_attr( $sama_options['menu_phone_2'] ); ?></span>
							</div>
						<?php } ?>
					</div>
			<?php } ?>
		</div>
		
	</div>
	<!-- # End Menu Content #  -->
	
	<!-- # Menu Overflow #  -->
	<div id="overflow-icon"></div>
</div>
<!-- * End / Navigation*  -->