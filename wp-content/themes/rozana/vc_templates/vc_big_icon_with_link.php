<?php
$output = $title = $url = $icon = $url_title = $css_animation_type = $css_animation_delay = '';
extract(shortcode_atts(array(
	'title'					=> '',
	'url'					=> '',
	'icon'					=> '',
	'url_title'				=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
),$atts));

$data_animation		  = '';
$data_animation_delay = '';
$extra_css			  = '';

if ( ! empty( $css_animation_type )) {
	$extra_css = ' animated';
	$data_animation = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$data_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}

/**/
$attr_title = '';
if( ! empty( $icon ) ) {
	$icon = str_replace( 'fa ', '', $icon );
}
$icon = str_replace( 'fa ', '', $icon);
if( ! empty( $url_title ) ) {
	$attr_title = ' title="' .esc_attr( $url_title ). '"';
}
$output = '<div class="platform-icon text-center'.$extra_css.'"'. $data_animation .''. $data_animation_delay .'>';
if( ! empty( $url ) ) {
	
	$output .= '<a href="'. esc_url( $url ) .'"'. $attr_title .'><i class="fa '. esc_attr( $icon ) .'"></i>';
} else {
	$output .= '<i class="fa '. esc_attr( $icon ) .'"></i>';
}
if( ! empty( $title ) ) {
	$output .= '<h4>'. esc_attr( $title ) .'</h4>';
}
if( ! empty( $url ) ) {
$output .= '</a>';
}
$output .= '</div>';
echo $output; 
