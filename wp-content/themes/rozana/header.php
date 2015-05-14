<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php global $sama_options; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- == Favicons == -->
	<?php if( isset( $sama_options['favicon'] ) && ! empty( $sama_options['favicon'] ) ) { ?>
		<link rel="shortcut icon" href="<?php echo esc_url( $sama_options['favicon']['url'] ); ?>">
	<?php } ?>
	
	<?php if( isset( $sama_options['apple_touch_icon_57'] ) && ! empty( $sama_options['apple_touch_icon_57'] ) ) { ?>
		<link rel="apple-touch-icon" href="<?php echo esc_url( $sama_options['apple_touch_icon_57']['url'] ); ?>"><!-- Apple Touch Icon 57x57 -->
	<?php } ?>
	
	<?php if( isset( $sama_options['apple_touch_icon_72'] ) && ! empty( $sama_options['apple_touch_icon_72'] ) ) { ?>
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $sama_options['apple_touch_icon_72']['url'] ); ?>"><!-- Apple Touch Icon 72x72 -->
	<?php } ?>
	
	<?php if( isset( $sama_options['apple_touch_icon_114'] ) && ! empty( $sama_options['apple_touch_icon_114'] ) ) { ?>
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $sama_options['apple_touch_icon_114']['url'] ); ?>"><!-- Apple Touch Icon 72x72 -->
	<?php } ?>	
	<!--[if lte IE 8]>
		<script src="<?php echo esc_url( get_template_directory_uri(). '/js/respond.min.min.js' );?>"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri(). '/js/html5shiv.js' );?>"></script>
	<![endif]-->
	<!--[if lt IE 10]>
		<script src="<?php echo esc_url( get_template_directory_uri(). '/js/jquery.placeholder.min.js' );?>"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<?php
	$page_id = $sama_options['current_page_id'] = sama_get_current_page_id();
	$css_menu 				 = '';
	$remove_menu_and_header  = array();
	$remove_top_header       = array();
	$display_vertical_menu   = array();
	$display_horizental_menu = array();
	$display_default_menu    = array();
	
	if( isset( $sama_options['remove_menu_and_header'] ) && ! empty( $sama_options['remove_menu_and_header'] ) ) {
		$remove_menu_and_header = $sama_options['remove_menu_and_header'];
	}
	if( isset( $sama_options['remove_top_header'] ) && ! empty( $sama_options['remove_top_header'] ) ) {
		$remove_top_header = $sama_options['remove_top_header'];
	}
	
	if( isset( $sama_options['main_menu'] ) && $sama_options['main_menu'] == 'vertical' ) {
		$css_menu = 'vertical';
		if( in_array( $page_id, $remove_menu_and_header)  ) {
			$css_menu = '';
		}
	}
	
	if( isset( $sama_options['main_menu'] ) && $sama_options['main_menu'] == 'defaultmenu' ) {
		$css_menu = 'default-menu';
	}
	
	// Pages to display default menu
	if( isset( $sama_options['display_default_menu'] ) && ! empty( $sama_options['display_default_menu'] ) ) {
		$display_default_menu = $sama_options['display_default_menu'];
		if( in_array( $page_id, $display_default_menu)  ) {
			$css_menu = 'default-menu';
		}
	}
	
	// Pages to Display horizental menu
	if( isset( $sama_options['display_horizental_menu'] ) && ! empty( $sama_options['display_horizental_menu'] ) ) {
		$display_horizental_menu = $sama_options['display_horizental_menu'];
		if( in_array( $page_id, $display_horizental_menu)  ) {
			$css_menu = '';
		}
	}
	
	// Pages to display vertical menu
	if( isset( $sama_options['display_vertical_menu'] ) && ! empty( $sama_options['display_vertical_menu'] ) ) {
		$display_vertical_menu = $sama_options['display_vertical_menu'];
		if( in_array( $page_id, $display_vertical_menu)  ) {
			$css_menu = 'vertical';
		}
	}
	
	if( in_array( $page_id, $remove_menu_and_header) || in_array( $page_id, $remove_top_header) ) {
		$css_menu = 'page-no-margin-top';
	}
	$css_menu = apply_filters('rozana_css_body', $css_menu);
?>
<body <?php body_class( $css_menu ); ?>>
	<?php if( ( isset( $sama_options['display_load_img'] ) && $sama_options['display_load_img'] == true ) || ! isset( $sama_options['display_load_img'] ) ) { ?>
		<!-- * Start / Loader*  -->
		<div id="loading">
			<?php
				if( $sama_options['themestyle'] == 'dark' ) {
					$img_loader = 'loader2.gif';
				} else {
					$img_loader = 'loader.gif';
				}
			?>
			<img src="<?php echo esc_url( get_template_directory_uri().'/img/'.$img_loader ) ; ?>" alt="<?php _e('Just Wait...', 'samathemes'); ?>">
		</div>
		<!-- * End / Loader*  -->
	<?php } ?>
    <?php
		$menu_is_display = false;
		if( ! in_array( $page_id, $remove_menu_and_header)  ) {
			if( ! empty( $display_vertical_menu ) || ! empty( $display_horizental_menu ) || ! empty( $display_default_menu ) ) {
				if( in_array( $page_id, $display_vertical_menu)  ) {
					$menu_is_display = true;
					get_template_part('menu/menu-vertical');
				} elseif ( in_array( $page_id, $display_horizental_menu ) ) {
					$menu_is_display = true;
					get_template_part('menu/menu-horizental');
				} elseif ( in_array( $page_id, $display_default_menu ) ) {
					$menu_is_display = true;
					get_template_part('menu/default-menu');
				}
			} 
			if( ! $menu_is_display ) {
				if( $sama_options['main_menu'] == 'vertical' ) {
					get_template_part('menu/menu-vertical');
				} elseif( $sama_options['main_menu'] == 'horizental' ) {
					get_template_part('menu/menu-horizental');
				} else {
					get_template_part('menu/default-menu');
				}
			}
		}
		do_action('sama_after_top_menu')
    ?>
	<section id="full-page" class="slide_animate">