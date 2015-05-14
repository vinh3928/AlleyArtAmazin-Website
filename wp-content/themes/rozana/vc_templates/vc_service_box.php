<?php
$output = $title = $icon_active = $icon = $image = $css_animation_type = $css_animation_delay = $el_class = '';
extract(shortcode_atts(array(
	'title'					=> '',
	'icon_active'			=> '',
	'icon'					=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
	'el_class'      		=> '',
),$atts));

$el_class 	= $this->getExtraClass($el_class);
$css = $box_animation_type = $box_animation_delay = '';
if( ! empty( $icon ) ) {
	$icon = str_replace( 'fa ', '', $icon );
}
if( ! empty( $el_class ) ) {
	$el_class .= ' '. $el_class;
}
if ( $css_animation_type != '' ) {
	$box_animation_type = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$box_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}

$output = '<div class="what-we-do-2'. $el_class .'"><div class="service-item animated"'. $box_animation_type . $box_animation_delay .'>';
if ( ! empty( $icon ) ) {
	if ( $icon_active == 'yes' ) {
		$output .= '<p><i class="fa '. esc_attr( $icon ) .' active"></i></p>';
	} else {
		$output .= '<p><i class="fa '. esc_attr( $icon ) .'"></i></p>';
	}
}
if( ! empty( $title ) ) {
	$output .= '<h3>'. esc_attr( $title ) .'</h3>';
}
if( ! empty( $content ) ) {
		$output .= '<p>'. wpb_js_remove_wpautop( $content ) .'</p>';
}
$output .= '</div></div>';
echo $output;