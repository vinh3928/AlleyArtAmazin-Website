<?php
$output = $image_block_position = $image = $title_first_box_1 = $title_first_box_2 = $animation_first_box = $delay_first_box = $title_second_box = $txt_second_box = $animation_second_box = $delay_second_box = $image_size = $el_class = '';
/*
 *	first box have rounded image
 */
extract(shortcode_atts(array(
	'image_block_position'	=> 'left',
	'image'					=> '',
	'title_first_box_1'		=> '',
	'title_first_box_2'		=> '',
	'animation_first_box'	=> '',
	'delay_first_box'		=> '',
	'title_second_box'		=> '',
	'txt_second_box'		=> '',
	'animation_second_box'	=> '',
	'delay_second_box'		=> '',
	'image_size'			=> '',
	'el_class'        		=> '',
),$atts));

$el_class = $this->getExtraClass($el_class);
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}

$first_block = '';
$second_block = '';
$first_box_animation_type = '';
$first_box_animation_delay = '';
$second_box_animation_type = '';
$second_box_animation_delay = '';
if ( $animation_first_box != '' ) {
	$first_box_animation_type = ' data-animation="'. esc_attr( $animation_first_box ) .'"';
	if( $delay_first_box != '' ) {
		$first_box_animation_delay = ' data-animation-delay="'. absint( $delay_first_box ) .'"';
	}
}
if ( $animation_second_box != '' ) {
	$second_box_animation_type = ' data-animation="'. esc_attr( $animation_second_box ) .'"';
	if( $delay_second_box != '' ) {
		$second_box_animation_delay = ' data-animation-delay="'. absint( $delay_second_box ) .'"';
	}
}



if( $image_block_position == 'right' ) {
	$wrap = '<div class="build-left'. esc_attr( $el_class ) .'">';
} else {
	$wrap = '<div class="build-right'. esc_attr( $el_class ) .'">';
}

/* First Block */
$image_html = '';
if( ! empty( $image ) ) {
	$img_url = wp_get_attachment_image_src($image, 'full');
	$image_h_w = '';
	if( ! empty( $img_url ) ) {
		if( $image_size == 'default' ) {
			$image_h_w = ' width="98" height="98"';
		}
		$image_html = '<img class="img-circle" src="'. esc_url( $img_url[0] ) .'"'. $image_h_w .' alt="'. esc_attr( strip_tags( $title_first_box_1 ) ) .'">';
	}
}
$first_block = '<div class="img-build"><div class="img-content animated"'. $first_box_animation_type . '' . $first_box_animation_delay .'>'. $image_html;
if( ! empty( $title_first_box_1 ) ) {
	$first_block .= '<h4>'. esc_attr( $title_first_box_1 ) .'</h4>';
}
if( ! empty( $title_first_box_2 ) ) {
	$first_block .= '<h4>'. esc_attr( $title_first_box_2 ) .'</h4>';
}
$first_block .= '</div></div>';

$second_block = '<div class="company-history animated"'. $second_box_animation_type . $first_box_animation_delay .'>';
if( ! empty( $title_second_box ) ) {
	$second_block .= '<h3>'. esc_attr( $title_second_box ) .'</h3>';
}
if( ! empty( $txt_second_box ) ) {
	$second_block .= esc_attr( $txt_second_box );
}
$second_block .= '</div>';

$output = $wrap . $first_block . $second_block . '</div>';

echo $output;