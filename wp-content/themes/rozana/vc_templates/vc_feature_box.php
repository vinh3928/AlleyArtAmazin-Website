<?php
$output = $title = $p_font_size = $position = $type = $icon_active = $icon_rounded = $icon_font_size = $icon_line_height = $icon = $image = $btn_url = $btn_txt = $css_animation_type = $css_animation_delay = $el_class = '';
extract(shortcode_atts(array(
	'title'					=> '',
	'text_align'			=> '',
	'p_font_size'			=> '',
	'position' 				=> 'icon_centered',
	'type'					=> 'icon',
	'icon_active'			=> 'no',
	'icon_rounded'			=> '',
	'icon_font_size'		=> '',
	'icon_line_height'		=> '',
	'icon'					=> '',
	'icon_border'			=> 'theme-border',
	'image'					=> '',
	'btn_url'				=> '',
	'btn_txt'				=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
	'el_class'      		=> '',
),$atts));

$css = $box_animation_type = $box_animation_delay = '';
if( ! empty( $icon ) ) {
	$icon = str_replace( 'fa ', '', $icon );
}
$el_class = $this->getExtraClass($el_class);
if ( $position == 'icon_centered' ) {
	$css .= ' i-marg-bottom';
}
if ( $position != 'icon_centered' ) {
	$css .= ' h3-marg-top';
}
if ( $icon_rounded == 'yes' ) {
	$css .= ' i-round-corner';
}
if ( $icon_font_size == '28px' ) {
	$css .= ' i-font-size-28';
}
if ( $icon_line_height == '65px' ) {
	$css .= ' i-lh-65';
}
if ( ! empty ( $text_align ) ) {
	$css .= ' ' . $text_align;
}
if ( $css_animation_type != '' ) {
	$el_class .= ' animated';
	$box_animation_type = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( $css_animation_delay != '' ) {
		$box_animation_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}

$el_class .= ' '. $css;
if( ! empty( $icon_border ) ) {
	$icon_border = ' '. esc_attr( $icon_border );
}
$el_class = ltrim( $el_class );
$output = '<div class="block-item '. esc_attr( $el_class ) .'"'. $box_animation_type . $box_animation_delay .'>';
if( $position == 'icon_centered' ) {
	if ( ! empty( $icon ) && $type == 'icon' ) {
		if ( $icon_active == 'yes' ) {
			$output .= '<p><i class="fa '. esc_attr( $icon ) . $icon_border .' active"></i></p>';
		} else {
			$output .= '<p><i class="fa '. esc_attr( $icon ) . $icon_border .'"></i></p>';
		}
	} elseif( ! empty( $image ) && $type == 'image' ) {
		$img_url = wp_get_attachment_image_src($image, 'full');
		$output .= '<p><img src="'. esc_url( $img_url[0] ) .'" class="img-responsive" alt="'. esc_attr( strip_tags( $title ) ) .'"></p>';
	}
	if( ! empty( $title ) ) {
		$output .= '<h3>'. esc_attr( $title ) .'</h3>';
	}

	if( ! empty( $content ) ) {
		if( empty ( $p_font_size ) ) {
			$output .= '<p>'. wpb_js_remove_wpautop( $content ) .'</p>';
		} else {
			$output .= '<p class="font-size-15">'. wpb_js_remove_wpautop( $content ) .'</p>';
		}
	}
	if( ! empty( $btn_txt ) ) {
		$btn_url = ( $btn_url != '' ) ? $btn_url : '#';
		$output .= '<p><a href="'. esc_url( $btn_url ) .'" class="square-btn">'. esc_attr( $btn_txt ) .'</a></p>';
	}
} elseif( $position == 'icon_left' ) {
	$output .= '<div class="row no-margin">';
	if ( ! empty( $icon ) && $type == 'icon' ) {
		if ( $icon_active == 'yes' ) {
			$output .= '<div class="col-md-3"><p><i class="fa '. esc_attr( $icon ) . $icon_border .' active"></i></p></div>';
		} else {
			$output .= '<div class="col-md-3"><p><i class="fa '. esc_attr( $icon ) . $icon_border .'"></i></p></div>';
		}
	} elseif( ! empty( $image ) && $type == 'image' ) {
		$img_url = wp_get_attachment_image_src($image, 'full');
		$output .= '<div class="col-md-3"><p><img src="'. esc_url( $img_url[0] ) .'" class="img-responsive" alt="'. esc_attr( strip_tags( $title ) ) .'"></p></div>';
	}
	$output .= '<div class="col-md-9">';
	if( ! empty( $title ) ) {
		$output .= '<h3>'. esc_attr( $title ) .'</h3>';
	}
	if( ! empty( $content ) ) {
		if( empty ( $p_font_size ) ) {
			$output .= '<p>'. wpb_js_remove_wpautop( $content ) .'</p>';
		} else {
			$output .= '<p class="font-size-15">'. wpb_js_remove_wpautop( $content ) .'</p>';
		}
	}
	if( ! empty( $btn_txt ) ) {
		$btn_url = ( $btn_url != '' ) ? esc_url( $btn_url ) : '#';
		$output .= '<p><a href="'. $btn_url.'" class="square-btn">'. esc_attr( $btn_txt ) .'</a></p>';
	}
	$output .= '</div></div>';
}

$output .= '</div>';
echo $output;