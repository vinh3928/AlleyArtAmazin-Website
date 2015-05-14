<?php
$output = '';
extract(shortcode_atts(array(
	'title'					=> '',
	'href'					=> '#',
	'target'				=> '_self',
	'bgcolor'				=> 'alizarin-btn',
	'customcolor'			=> '',
	'size' 					=> 'small-btn',
	'border' 				=> '',
	'corner'				=> '',
	'icon'					=> '',
	'el_class'				=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
),$atts));

$data_animation = $data_animation_delay = $extra_css = $icon_html = $html_style = '';
$el_class = $this->getExtraClass($el_class);
if( ! empty( $icon ) ) {
	$icon = str_replace( 'fa ', '', $icon );
}
if ( ! empty( $css_animation_type )) {
	$extra_css .= ' animated';
	$data_animation = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$data_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}
if( ! empty ( $customcolor ) && $bgcolor == 'custom' ) {
	$html_style = ' style="background:'. $customcolor .';"';
	$extra_css .= ' '. esc_attr( $size );
} else {
	$extra_css .= ' '. esc_attr( $bgcolor ) . ' '. esc_attr( $size );
}
if( $border == 'yes' ) {
	$extra_css .= ' display-border';
}
if( ! empty ( $extra_css ) ) {
	$el_class = $el_class . $extra_css;
}
if( ! empty ( $corner ) ) {
	$el_class = $el_class . ' corner-btns';
}
if( ! empty( $icon ) ) {
	$icon_html = '<i class="fa '. esc_attr( $icon ) .'"></i>';
}
//$output = '';
$output = '<span class="btns-group"><a class="'. $el_class .'" href="'. esc_url($href) .'" title="'. esc_attr(strip_tags($title)) .'"'. $data_animation . $data_animation_delay . $html_style .'>'. $icon_html . esc_attr( $title ) .'</a></span>';
echo $output;