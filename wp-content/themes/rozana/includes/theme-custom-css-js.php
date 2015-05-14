<?php

/*
 *	CSS For Custom Background Image at top in the page_for_posts
 * 	For  Pages and Portfolio
 */
function sama_custom_background () {
	global $post;
	$enable_custom_bg =  $bg_image_id = '';
	$page_id = sama_get_current_page_id();
	if( is_post_type_archive( 'post' ) || is_tag() || is_category() || is_author() || is_day() || is_month() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$page_id = $page_for_posts;
		}
	}
	if( $page_id == -1 ) {
		return;
	}
	$enable_custom_bg 	= get_post_meta( $page_id, '_sama_enable_custom_header', true );
	$bg_image_id 		= get_post_meta( $page_id, '_sama_page_bg', true );
	if( empty( $enable_custom_bg ) || empty ( $bg_image_id ) ) {
		return;
	}
	$bg_animation = get_post_meta( get_the_ID(), '_sama_bg_animation', true );
	$bg_image_id  = preg_replace( '/[^\d]/', '', $bg_image_id );
	$image 		  = wp_get_attachment_image_src($bg_image_id, 'full');
	$image_url    = esc_url( $image[0] );
	if( $bg_animation == 'movement' ) {
?>
<style type="text/css">
.fullwidth-banner { background:url('<?php echo esc_url( $image_url ); ?>') fixed left top; }
</style>
<?php
	} else {
?>
<style type="text/css">
.fullwidth-banner { background:url('<?php echo esc_url( $image_url ); ?>'); }
</style>
<?php
	}
}
add_action( 'wp_head', 'sama_custom_background' );

/*
 *	CSS For Top Slider
 * 	For  Pages only
 */
function sama_custom_background_slider () {
	
	$page_id 		= sama_get_current_page_id();
	$slider_type 	= get_post_meta( $page_id, '_sama_slider_type', true );
	$bg_image_ids 	= get_post_meta( $page_id, '_sama_slider_images', false );
	$image_url 		= '';
	if( $slider_type == 'no' || empty( $slider_type) ) {
		return;
	}
	foreach ( $bg_image_ids as $image ) {
		$image 		= preg_replace( '/[^\d]/', '', $image );
		$image 		= wp_get_attachment_image_src($image, 'full');
		if( ! empty( $image[0] )  ) {
			$image_url   = esc_url( $image[0] );
			break;
		}
	}
	if( $slider_type == 'fullscreenbg' || $slider_type == 'movementbg' ) {
?>
<style type="text/css">
.full-background { background-image:url('<?php echo esc_url( $image_url ); ?>'); }
</style>
<?php
	}

}
add_action( 'wp_head', 'sama_custom_background_slider' );

/*
 *	JQuery For Top Slider
 * 	For  Pages only
 *		- Zupersized jQuery Background Slider
 *		- Zooming	jQuery Background Slider
 */
function sama_custom_scripts () {
	$page_id 		= sama_get_current_page_id();
	$slider_type 	= get_post_meta( $page_id, '_sama_slider_type', true );
	$bg_image_ids 	= get_post_meta( $page_id, '_sama_slider_images', false );
	if( ( ! empty ( $slider_type ) || $slider_type != 'no' ) && ! empty( $bg_image_ids ) ) {
		$images = array();
		foreach ( $bg_image_ids as $image ) {
			$image = preg_replace( '/[^\d]/', '', $image );
			$image 		 = wp_get_attachment_image_src($image, 'full');
			$image_url   = esc_url( $image[0] );
			$images[] =  $image_url;
		}
		$js_images = '';
		if( $slider_type == 'supersized' ) {
			$i = 0;
			foreach ( $images as $image ) {
				$i++;
				if( $i == 1 ) {
					$js_images .= "{image : '". esc_url( $image ) ."'}";
				} else {
					$js_images .= ",{image : '". esc_url( $image ) ."'}";
				}
			}
			$js_images = '['. $js_images .']';
?>
<script type="text/javascript">
jQuery(function($){
$.supersized({
	slide_interval          :   3000,
	transition              :   1,
	transition_speed		:	700,
	slide_links				:	'blank',
	slides					:<?php echo $js_images; ?>,
});
});
</script>
<?php			
		} elseif ( $slider_type == 'zooming' ) {
			$i = 0;
			foreach ( $images as $image ) {
				$js_images .= '"'. esc_url( $image ) .'",';
			}
			$js_images = '['. $js_images .']';
?>
<script type="text/javascript">
jQuery(function($){
$.mbBgndGallery.buildGallery({
		containment:"body",
		timer:1000,
		effTimer:15000,
		controls:"#controls",
		grayScale:false,
		shuffle:true,
		preserveWidth:false,
		preserveTop: true,
		effect:"zoom",
		images:<?php echo $js_images; ?>,
		onStart:function(){},
		onPause:function(){},
		onPlay:function(opt){},
		onChange:function(opt,idx){},
		onNext:function(opt){},
		onPrev:function(opt){}
});
});
</script>	
<?php	
		} 
	}
}
add_action( 'wp_footer', 'sama_custom_scripts', 30 );

/*
 * Used to display Custom css in theme option
 */
function sama_header_custom_css() {
	global $sama_options;
	if( isset( $sama_options['custom_css'] ) && ! empty( $sama_options['custom_css'] ) ) { ?>
<style type="text/css">
<?php echo trim( $sama_options['custom_css'] ); ?>
</style>
<?php
	}
}
add_action( 'wp_head', 'sama_header_custom_css', 100 );

/*
 * Used to display Analytics code in footer
 */
function sama_footer_custom_scripts() {
	global $sama_options;
	if( isset( $sama_options['analyticscode'] ) && ! empty( $sama_options['analyticscode'] ) ) { ?>
<script type="text/javascript">
<?php echo $sama_options['analyticscode']; ?>
</script>
<?php
	}
}
add_action( 'wp_footer', 'sama_footer_custom_scripts', 100 );
?>