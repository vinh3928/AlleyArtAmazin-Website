<?php
$output = $title = $icon_active = $icon = $css_animation_type = $css_animation_delay = $el_class = '';
extract(shortcode_atts(array(
	'title'					=> '',
	'icon_active'			=> '',
	'icon'					=> '',
	'bord_color'			=> 'theme-color',
	'bord_size'				=> 2,
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
	'el_class'  			=> '',
),$atts));

$el_class = $this->getExtraClass($el_class);
$css_output = $icon_output = $title_output = $item_animation_type = $item_animation_delay = '';
if( ! empty( $icon ) ) {
	$icon = str_replace( 'fa ', '', $icon );
}
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
if ( $css_animation_type != '' ) {
	$el_class .= ' animated';
	$item_animation_type = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$item_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}
if( ! empty( $icon ) ) {
	if ( $icon_active == 'yes' ) {
			$icon_output .= '<i class="fa '. esc_attr( $icon ) .' active"></i>';
	} else {
		$icon_output .= '<i class="fa '. esc_attr( $icon ) .'"></i>';
	}
}
if( ! empty( $title ) ) {
	$title_output .= esc_attr( $title );
}
if( $bord_color == 'border-grey' ) {
	$el_class .= ' border-grey';
}
if( $bord_size == 1 ) {
	$el_class .= ' border-size-1';
}
if( ! empty( $el_class ) ) {
	$el_class = ltrim( $el_class );
	$css_output = ' class="'. esc_attr( $el_class ) .'"';
}
$output = '<li'. $css_output . $item_animation_type . $item_animation_delay .'>'. $icon_output . $title_output .'</li>';
echo $output;