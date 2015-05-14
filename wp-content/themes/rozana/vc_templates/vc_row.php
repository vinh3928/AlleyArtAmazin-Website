<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $fullwidth = $slider = '';
extract(shortcode_atts(array(
    'el_class'        	=> '',
    'bg_image'        	=> '',
    'bg_color'        	=> '',
    'bg_image_repeat' 	=> '',
    'font_color'      	=> '',
    'padding'         	=> '',
    'margin_bottom'   	=> '',
    'css'			 	=> '',
	'sid' 			 	=> '',
	'box_padding'		=> 'pad-top-bottom',
	'theme_color'		=> 'theme-color',
	'transparent_bg'	=> 'transparent-bg-8',
	'extra_css'			=> '',
	'progress_img'		=> '',
	'parallax'			=> '',
	'bgtype'			=> 'image',
	'bgfixed'			=> '',
	'bgrepeat'			=> '',
	'bgposition'		=> '',
	'bgposition_x'		=> '',
	'bgposition_y'		=> '',
	'bgvideo'			=> '',
	'webm'				=> '',
	'mp4'				=> '',
	'ogv'				=> '',
	'fullwidth'			=> '',
), $atts));

$css_style = $data_stellar = $custom_theme_css = '';

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ''. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class = str_replace('vc_row-fluid', '', $css_class);
$css_class = str_replace('vc_row-fluid', '', $css_class);
$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

if( $theme_color == 'darkness' || $theme_color == 'grey-bg' ) {
	$custom_theme_css = 'full-witdh '. $theme_color;
} else {
	$custom_theme_css = 'full-witdh '. $theme_color;
}
if( $parallax == 'yes' && $bgtype == 'video' ) {
	$custom_theme_css .= ' video-bg';
}

if( ! empty( $extra_css ) ) {
	$custom_theme_css .= ' '. esc_attr( $extra_css );
}
/* Parralex Background */
$css_style = $data_stellar = '';
if( $parallax == 'yes' && $bgtype == 'image' ) {
	$custom_theme_css .= ' parallax_bg';
	$background_attachment = '';
	$background_repeat = '';
	$background_position = '';
	if ( $bgfixed == 'yes' ) {
		$background_attachment = "background-attachment:fixed;";
	}
	if ( ! empty( $bgrepeat ) ) {
		$background_repeat = "background-repeat:$bgrepeat;";
	}
	if ( ! empty( $bgposition ) ) {
		if( $bgposition != 'custom' ) {
			$background_position = "background-position:$bgposition;";
		} elseif( $bgposition == 'custom' ) {
			$x = ( ! empty( $bgposition_x ) ) ? $bgposition_x : 0;
			$y = ( ! empty( $bgposition_y ) ) ? $bgposition_y : 0;
			$background_position = "background-position:$x $y;";
		}
	}
	if( ! empty( $background_attachment ) || ! empty( $background_repeat ) || ! empty( $background_position ) ) {
		$css_style = ' style="$background_attachment $background_repeat $background_position ;"';
	}
	$data_stellar = ' data-stellar-background-ratio="0.5"';
}

if( $fullwidth == 'yes' ) {
	$custom_theme_css = $custom_theme_css. ' full-width-block '. esc_attr( $box_padding );
}



$sid_html = '';
if( ! empty ($sid) ) {
	$sid_html = 'id="'. esc_attr($sid) .'" ';
}
// main div 
$output = '<div '. $sid_html .'class="'. $custom_theme_css .' '. esc_attr( $css_class ) . $style.'"'. $css_style . $data_stellar .'>';

if( $parallax == 'yes' && $bgtype == 'video' ) {
	
	$img_id = preg_replace( '/[^\d]/', '', $bgvideo );
	$img_url = wp_get_attachment_image_src($img_id, 'full');
	$webm = esc_url( $webm );
	$mp4 = esc_url( $mp4 );
	$ogv = esc_url( $ogv );
	// div video wraper
	$output .= '<div class="video-wrapper" data-vide-bg="mp4: '. esc_url( $mp4 ) .',webm: '. esc_url( $webm ) .',ogv: '. esc_url( $ogv ) .',poster: '. esc_url( $img_url[0] ) .'">';
}

if( $theme_color == 'darkness' ) {
	if( ! empty ( $transparent_bg ) ) {
		$output .= '<div class="transparent-bg '. esc_attr( $transparent_bg ) .'">';
	} else {
		$output .= '<div class="transparent-bg">';
	}
}

if( $progress_img == 'yes' ) {
		$output .= '<div class="process-bg">';
}

if ( empty( $fullwidth ) ) {
	if( $box_padding != '' ) {
		$output .= '<div class="container '. esc_attr( $box_padding ) .'">';
	} else {
		$output .= '<div class="container">';
	}
}


$output .= '<div class="row">';	

$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');
if ( empty( $fullwidth ) ) {
	$output .= '</div>'.$this->endBlockComment('container');
}
if( $progress_img == 'yes' ) {
		$output .= '</div>'.$this->endBlockComment('progress_img');
}
if( $theme_color == 'darkness' ) {
	$output .= '</div>';
}
if( $parallax == 'yes' && $bgtype == 'video' ) {
	$output .= '</div>'.$this->endBlockComment('video_wraper');
}

$output .= '</div>'.$this->endBlockComment('main_div');
echo $output;