<?php
$output = $title = $second_heading = $border_bottom = $css_animation_type = $css_animation_delay = $margin_bottom = $el_class = '';
extract(shortcode_atts(array(
	'title' 				=> '',
	'second_heading' 		=> '',
	'text_align'			=> '',
	'border_bottom'			=> 'yes',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
	'margin_bottom'			=> '',
	'tag'					=> 'h2',
	'tag_marg_bottom'		=> 'default',
	'el_class'				=> '',
),$atts));

$box_animation_type = $box_animation_delay = $css_output = $css = '';
$el_class 	= $this->getExtraClass($el_class);
if( ! empty( $text_align ) ) {
	$el_class .= ' '. esc_attr( $text_align );
}
if ( $css_animation_type != '' ) {
	$el_class .= ' animated';
	$box_animation_type = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$box_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}
if( ! empty( $el_class ) ) {
	$css = trim( $el_class );
}
if( ! empty( $margin_bottom) && $margin_bottom != 'default' ) {
	$css .= ' ' . trim( esc_attr( $margin_bottom ) );
}
if( ! empty( $tag_marg_bottom ) && $tag_marg_bottom != 'default' ) {
	$css .= ' '. esc_attr( $tag_marg_bottom );
}
if( ! empty( $css ) ) {
	$css_output = ' class="'. trim( $css ) .'"';	
}
$output = "\n\t".'<header'. $css_output . $box_animation_type . $box_animation_delay .'>';
if( ! empty( $title ) ) {
	if( $tag == 'h3' ) {
		$output .= '<h3>'. esc_attr( $title ) .'</h3>';
	} elseif( $tag == 'h4' ) {
		$output .= '<h4>'. esc_attr( $title ) .'</h4>';
	} elseif( $tag == 'h5' ) {
		$output .= '<h4>'. esc_attr( $title ) .'</h4>';
	} elseif( $tag == 'h6' ) {
		$output .= '<h6>'. esc_attr( $title ) .'</h6>';
	} else {
		$output .= '<h2>'. esc_attr( $title ) .'</h2>';
	}
}
if ( $border_bottom == 'yes' ) {
	$output .= '<span class="line"><span></span></span>';
}
if( ! empty( $second_heading ) ) {
	$output .= '<h5>'. wpb_js_remove_wpautop( $second_heading ) .'</h5>';
}
$output .= '</header>';
echo $output;