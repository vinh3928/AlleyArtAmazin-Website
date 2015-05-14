<?php 
global $sama_options;
$menu_used 			= 'top-menu';
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
?>
<!-- * Start / Navigation*  -->
<section id="main_navigation" class="fixed-logo main_nav">
	<div class="container">
		<div class="row">
			<div class="logoleft text-left fixed-image">
				<?php
					if( isset( $sama_options['logo_url'] ) && ! empty( $sama_options['logo_url'] ) ) {
						$logo_url = $sama_options['logo_url']['url'];
					} else {
						$logo_url = get_template_directory_uri() .'/img/logo/logo.png';
					}
				?>
				<a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo('name'); ?>">
				</a>
			</div>
			<nav id="navigation">
				<?php
					if ( function_exists( 'has_nav_menu' ) ) {
						wp_nav_menu( array( 'theme_location' => $menu_used, 'depth' => 3, 'container' => 'ul', 'menu_class' => 'main_menu', 'menu_id' => 'main-menu','fallback_cb' => 'sama_fallbacktopmenu', 'walker' => new Rozana_walker_nav_menu) );
					}
				?>
			</nav>
		</div>
	</div>
</section>

<div id="slidemenu" class="menu">
	<!-- # Menu Content #  -->
	<div class="slidemeu-content">
		
		<!-- # Logo #  -->
		<div class="logo">
			<?php
				if( isset( $sama_options['logo_url_inside_menu'] ) && ! empty( $sama_options['logo_url_inside_menu'] ) ) {
					$logo_url_inside_menu = $sama_options['logo_url_inside_menu']['url'];
				} else {
					$logo_url_inside_menu = get_template_directory_uri() .'/img/logo/logo.png';
				}
			?>
			<a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>">
				<img src="<?php echo esc_url( $logo_url_inside_menu ); ?>" alt="<?php bloginfo('name'); ?>">
			</a>
		</div>
		<!-- # End Logo #  -->
		
		 <!-- # Links #  -->
		<nav id="top-menu" class="links">
			<?php 
				if ( function_exists( 'has_nav_menu' ) ) {
					wp_nav_menu( array( 'theme_location' => $menu_used, 'depth' => 3, 'container' => 'ul', 'menu_class' => '', 'fallback_cb' => 'sama_fallbacktopmenu', 'walker' => new Rozana_walker_nav_menu ) );
				} 
			?>
		</nav>
		<!-- # End Links #  -->
		
		 <!-- # Logo #  -->
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
		<!-- # End Logo #  -->
		
	</div>
	<!-- # End Menu Content #  -->
	
	<!-- # Menu Overflow #  -->
	<div id="overflow-icon"></div>
</div>
<!-- * End / Navigation*  -->

<!-- Fixed Header -->
<header class="fixed-logo mobileheader">
	<p class="text-right fixed-image">
		<?php
			if( isset( $sama_options['logo_url'] ) && ! empty( $sama_options['logo_url'] ) ) {
				$logo_url = $sama_options['logo_url']['url'];
			} else {
				$logo_url = get_template_directory_uri() .'/img/logo/logo.png';
			}
		?>
		<a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>">
			<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo('name'); ?>">
		</a>
	</p>
</header>
<!-- End# Fixed Header -->