<?php
$output = $title = $url = $icon = $pos_left = $css_animation_type = $css_animation_delay = $el_class = '';
extract(shortcode_atts(array(
	'title'					=> '',
	'url'					=> '',
	'icon'					=> '',
	'pos_left'				=> '',
	'margin_top'			=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
	'el_class'  			=> '',
),$atts));

$el_class = $this->getExtraClass($el_class);
$icon_output = $title_output = $item_animation_type = $item_animation_delay = $link_start = $link_end = $style = '';
if( ! empty( $icon ) ) {
	$icon = str_replace( 'fa ', '', $icon );
}
if( ! empty( $el_class ) ) {
	$el_class = $el_class .' ';
}
if ( $css_animation_type != '' ) {
	$el_class = ' animated';
	$item_animation_type = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$item_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}
if( ! empty( $icon ) ) {
	$icon_output .= '<i class="fa '. esc_attr( $icon ) .'"></i>';
}
if( ! empty( $title ) ) {
	$title_output .= esc_attr( $title );
}
if( ! empty( $url ) ) {
	$link_start = '<a href="'. esc_url( $url ) .'">';
	$link_end   = '</a>';
}
if( ! empty( $pos_left ) || ! empty( $margin_top ) ) {
	$pos_left 	= ( ! empty( $pos_left ) ) ? $pos_left : 0;
	$margin_top = ( ! empty( $margin_top ) ) ? $margin_top : 0;
	$style = ' style="left:'. esc_attr( $pos_left ) .';margin-top:'. esc_attr( $margin_top ) .'"';
}
$output = '<li class="'. $el_class .'"'. $item_animation_type . $item_animation_delay . $style .'>'. $link_start . $icon_output . $title_output . $link_end .'</li>';
echo $output;