<?php
$output = $title = $images = $el_class = '';
extract(shortcode_atts(array(
	'title' 			=> '',
	'images' 			=> '',
	'arrows' 			=> '',
	'bullets' 			=> '',
	'el_class' 			=> '',
),$atts));


$el_class = $this->getExtraClass( $el_class );
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
if ( empty( $images) ||  $images == '' ) {
	return;
}

$i = 0;
$nav_bullets = '';
$nav_arrows  = '';
$id_attr = 'carousel-'. rand(1,999);
$images  = explode( ',', $images );
$slider_content  = '<div class="carousel-inner" role="listbox">';

foreach ( $images as $attach_id ) {
	$i++;
	$active = '';
	if( $i == 1 ) {
		$active = ' active';
	}
	
	if ( $attach_id > 0 ) {
		$image_data  = get_post( $attach_id, 'OBJECT' );
		$img_url 	 = wp_get_attachment_image_src($attach_id, 'full');
		$nav_bullets .= '<li data-target="#'. esc_attr( $id_attr ) .'" data-slide-to="'. ($i - 1) .'" class="'. $active .'"></li>';
		$slider_content .= ' <div class="item'. $active .'"><img alt="'. esc_attr( $image_data->post_title )  .'" src="'. esc_url($img_url[0]) .'" class="img-responsive"></div>';
	} else {
		$nav_bullets .= '<li data-target="#'. esc_attr( $id_attr ) .'" data-slide-to="'. $i - 1 .'" class="'. ltrim($active) .'"></li>';
		$slider_content .= ' <div class="item'. $active .'"><img alt="First slide" src="'. vc_asset_url( 'vc/no_image.png' ) .'" class="img-responsive"></div>';
	}
}
$slider_content .= '</div>';
$nav_arrows =  '<a class="left carousel-control" href="#'. esc_attr( $id_attr ) .'" role="button" data-slide="prev">
					<span class="icon-arrow-left10"></span>
				</a>
				<a class="right carousel-control" href="#'. esc_attr( $id_attr ) .'" role="button" data-slide="next">
					<span class="icon-uniE91B"></span>
				</a>';
$nav_bullets = '<ol class="carousel-indicators">'. $nav_bullets .'</ol>';
if( $arrows != 'yes' ) {
	$nav_arrows = '';
}
if( $bullets != 'yes' ) {
	$nav_bullets = '';
}
$output = '<div id="'. esc_attr( $id_attr ) .'" class="carousel slide'. esc_attr( $el_class ) .'" data-ride="carousel">'. $nav_bullets . $slider_content . $nav_arrows .'</div>';
echo $output;
?>