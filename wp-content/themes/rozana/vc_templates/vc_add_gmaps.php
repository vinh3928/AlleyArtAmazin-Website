<?php
$output = $title = $latlang = $zoom = $image = $el_class = '';
extract(shortcode_atts(array(
	'title'				=> '',
	'latlang'			=> '',
	'zoom' 				=> 17,
	'image'				=> '',
	'el_class'      	=> '',
),$atts));
$el_class 		= $this->getExtraClass($el_class);
$allowed_tags 	= sama_allowed_html();
$title 			= esc_attr( $title );
$latlang 		= esc_attr($latlang);
$zoom 			= absint($zoom);
if( ! empty( $image ) ) {
		$img_url = wp_get_attachment_image_src($image, 'full');
		$image  = esc_url($img_url[0]);
		
	}
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$id = rand(1, 999);
$output .= '<div class="custom-google-map-wrap">';
if( ! empty( $content ) ) {
	$output .= '<div class="custom-google-map-desc">'. wpb_js_remove_wpautop( $content, $allowed_tags  ) .'</div>';
}
$output .= '<div id="custom-map" class="map custom-google-map'. esc_attr( $el_class ) .'" data-mape-title="'. $title .'" data-map-latlang="'. $latlang .'" data-map-zoom="'. $zoom .'" data-map-image="'. esc_url( $image ).'"></div></div>';
echo $output;