<?php
$output = $title = $type = $images = $img_size = $onclick = $custom_links = $custom_links_target = $el_class = '';
extract(shortcode_atts(array(
	'title' 			=> '',
	'type'				=> 'like_client',
	'images' 			=> '',
	//'img_size' 		=> 'full',
	'onclick' 			=> 'link_no',
	'custom_links' 		=> '',
	'custom_links_target' => '_self',
	'el_class' 			=> '',
),$atts));

$el_class = $this->getExtraClass( $el_class );
if ( $images == '' ) {
	return;
}
$custom_links = explode( ',', $custom_links );
$images = explode( ',', $images );
$id_attr = rand(1,999);
if ( $type == 'like_client' ) {
	$output = '<div class="clients"><div id="'.$type.'-'. esc_attr( $id_attr ) .'" class="owl-carousel2 owl-theme-style2 clearfix '. esc_attr( $el_class ) .'">';
	$i = 0;
	foreach ( $images as $attach_id ) {
		$i++;
		if ( $attach_id > 0 ) {
			$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => 'full' ) );
		} else {
			$post_thumbnail = array();
			$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		}
		$thumbnail = $post_thumbnail['thumbnail'];
		$link_start = $link_end = $caption = '';
		if( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
			$link_start = '<a href="'. esc_url( $custom_links[$i] ) .'" target="'. esc_attr( $custom_links_target ) .'">';
			$link_end = '</a>';
		} elseif ( $onclick == 'open_fancy_box' ) {
			$image_url = wp_get_attachment_image_src( $attach_id, 'full' );
			$image_url = $image_url[0];
			$image_data  = get_post( $attach_id, 'OBJECT' );
			$caption = '<div class="overlay text-center"><a href="'. esc_url( $image_url ) .'" data-fancybox-group="gallery" title="'. esc_attr( $image_data->post_title ) .'" class="fancybox-effects-b"><i class="fa fa-search"></i></a></div>';                                
		}
		$output .= '<div class="text-center owl-item">'. $link_start . $thumbnail. $link_end . $caption .'</div>';

	}
	$output .= '</div></div>';
	echo $output;
} else {

	$output = '<div id="'.$type.'-'. esc_attr( $id_attr ) .'" class="owl-theme-style owl-carousel clearfix '. esc_attr( $el_class ) .'">';
	$i = 0;
	foreach ( $images as $attach_id ) {
		$i++;
		if ( $attach_id > 0 ) {
			$img_url = wp_get_attachment_image_src($attach_id, 'owl-screenshot-thumb');
			$post_thumbnail = array();
			$image_data  = get_post( $attach_id, 'OBJECT' );
			$post_thumbnail['thumbnail'] = '<img src="' . $img_url[0] . '" alt="'. $image_data->post_title .'" />';
		} else {
			$post_thumbnail = array();
			$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		}
		$thumbnail = $post_thumbnail['thumbnail'];
		$figcaption = '';
		if( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
			$figcaption = '	<figcaption>
								<div class="overlay text-center">
                                    <a href="'. esc_url( $custom_links[$i] ) .'" target="'. $custom_links_target .'"><i class="fa fa-link"></i></a>
                                </div>
                           </figcaption>';
		} elseif ( $onclick == 'open_fancy_box' ) {
			$image_url 		= wp_get_attachment_image_src( $attach_id, 'full' );
			$image_url 		= $image_url[0];
			$image_data  	= get_post( $attach_id, 'OBJECT' );
			$figcaption 	= '<figcaption>
							<div class="overlay text-center">
								<a href="'. esc_url($image_url) .'" data-fancybox-group="gallery" title="'. esc_attr( $image_data->post_title ) .'" class="fancybox-effects-b"><i class="fa fa-search"></i></a>
							</div>
						</figcaption>';                                
		}
		$output .= '<div class="col-md-3 text-center animated owl-item" data-animation="fadeInUp"><div class="portfolio-sample-2 animated" data-animation="fadeIn">'. $thumbnail. $figcaption .'</div></div>';

	}
	$output .= '</div>';
	echo $output;
}
?>