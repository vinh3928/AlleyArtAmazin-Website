<?php
$output = $title = $type = $icon = $value = $unit = $css_animation_type = $css_animation_delay = '';
extract(shortcode_atts(array(
	'title'					=> '',
	'type'					=> 'box',
	'icon'					=> '',
	'value' 				=> '',
	'unit'					=> '',
	'hidecounter'			=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
),$atts));

$data_animation = $data_animation_delay = $extra_css = '';
if( ! empty( $icon ) ) {
	$icon = str_replace( 'fa ', '', $icon );
}
$css_counter = 'counter';
if( $hidecounter == 'yes' ) {
	$css_counter = 'nocounter';
}
if ( ! empty( $unit )) {
	$unit = ' ' . esc_attr( $unit );
}

if ( ! empty( $css_animation_type )) {
	$extra_css = ' animated';
	$data_animation = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$data_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}

if( $type == 'box' ) {
	$output = 	'<div class="fun-facts text-center'.$extra_css.'"'. $data_animation .''. $data_animation_delay .'>
					<div class="icon-facts">
						<i class="fa '. esc_attr($icon) .'"></i>
					</div>
					<div class="counter-wrapper"><span class="'. $css_counter .'">'. esc_attr( $value ) .'</span>'. esc_attr( $unit ) .'</div>
					<h5>'. esc_attr( $title ) .'</h5>
				</div>';
} elseif ( $type == 'circle' ) {
	$output = 	'<div class="cricle-process text-center'.$extra_css.'"'. $data_animation .''. $data_animation_delay .'>
					<div class="counter-wrapper"><span class="'.$css_counter.'">'. esc_attr( $value ) .'</span>'. $unit .'</div>
					<h5>'. esc_attr( $title ) .'</h5>
				</div>';
} elseif ( $type == 'line' ) {
	$output = '<div class="counter-wrapper text-center'. $extra_css .'"'. $data_animation .''. $data_animation_delay .'"><span class="'. $css_counter .' bord-bottom">'. esc_attr( $value ) .'</span>'. esc_attr( $unit ) .' '. esc_attr( $title ) .'</div>';
} elseif ( $type == 'icon_in_circle' ) {
	$output = '<div class="cricle-process text-center'.$extra_css.'"'. $data_animation .''. $data_animation_delay .'><i class="fa '.$icon.'"></i><h4>'. esc_attr( $title) .'</h4></div>';

}
echo $output; 