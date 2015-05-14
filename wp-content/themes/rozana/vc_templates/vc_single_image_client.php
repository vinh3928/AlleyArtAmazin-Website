<?php

extract(shortcode_atts(array(
	'type'				=> '',
	'image'				=> '',
	'img_size'			=> 'single-client-image',
	'url'				=> '',
	'target'			=> '_self',
	'el_class'			=> '',
	'min_height'		=> '',
	'width'				=> '',
	'pos_top'			=> '',
	'pos_left'			=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
),$atts));

$data_animation = $data_animation_delay = $extra_css = '';
$el_class = $this->getExtraClass( $el_class );
if ( ! empty( $animation_type )) {
	$extra_css = ' animated';
	$data_animation = ' data-animation="'. esc_attr( $animation_type ) .'"';
	if( $animation_delay != '' ) {
		$data_animation_delay = ' data-animation-delay="'. absint( $animation_delay ) .'"';
	}
}
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$img_id = preg_replace( '/[^\d]/', '', $image );
$img_url = wp_get_attachment_image_src($img_id, 'full');
$image_data  = get_post( $img_id, 'OBJECT' );
if( $type == 'image' ) {
	
	$output  = '<img src="'. esc_url( $img_url[0] ) .'" class="img-responsive'. esc_attr( $el_class ) .'" alt="'. esc_attr( $image_data->post_title ) .'">';
	echo $output;	
} elseif( $type == 'image-absolute' ) {
		$style = ' style="position:absolute;left:0;right:0;';
		if( ! empty( $width ) ) {
			$style .= 'width:'. $width .';';
		}
		if( ! empty( $min_height ) ) {
			$style .= 'min-height:'. $min_height .';';
		}
		if( ! empty( $pos_top ) ) {
			$style .= 'top:'. $pos_top .';';
		}
		if( ! empty( $pos_left ) ) {
			$style .= 'left:'. $pos_left .';';
		}
		$style .= '"';
		$output .= '<div class="absolute-image'. esc_attr( $el_class ) .'"'. $style .'>
                    <img src="'. esc_url( $img_url[0] ) .'" class="img-responsive" alt="'. esc_attr( $image_data->post_title ) .'" />
                </div>';
		echo $output;	
} else {

	$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => 'img-responsive' ) );
	if ( $img == NULL ) $img['thumbnail'] = '<img class="img-responsive ' . $style . $border_color . '" src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="no image found" />';
	$output = '<div class="client-img'. $el_class .''. $extra_css .'"'. $data_animation .''. $data_animation_delay .'>';
	if( empty($url) ) {
		$output .= $img['thumbnail'];
	} else {
		$output .=  '<a href="' . esc_url( $url ) . '" target="'. $target .'">'. $img['thumbnail'] .'</a>';
	}
	$output .= '</div>';
	echo $output;
}