<?php
$output = $font_color = $el_class = $width = $offset = '';
extract(shortcode_atts(array(
	'font_color'      		=> '',
    'el_class' 				=> '',
    'width' 				=> '1/1',
    'css' 					=> '',
	'offset' 				=> '',
	'text_align'			=> 'no',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
), $atts));

$el_class 	= $this->getExtraClass($el_class);
$width 		= wpb_translateColumnWidthToSpan($width);
$width 		= vc_column_offset_class_merge($offset, $width);
$style 		= $this->buildStyle( $font_color );
$css_class 	= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class  = str_replace( 'vc_hidden-lg', 'hidden-lg', $css_class );
$css_class  = str_replace( 'vc_hidden-md', 'hidden-md', $css_class );
$css_class  = str_replace( 'vc_hidden-sm', 'hidden-sm', $css_class );
$css_class  = str_replace( 'vc_hidden-xs', 'hidden-xs', $css_class );
$css_class 	= preg_replace('/vc_col-sm-(\d{1,2})/', 'col-md-$1 col-sm-$1', $css_class);

if( ! empty( $text_align ) && $text_align != 'no' ) {
	$css_class	.= $css_class .' '. $text_align;
}
if ( $css_animation_type != '' ) {
	$css_delay ='';
	if( $css_animation_delay != '' ) {
		$css_delay = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
	$output .= "\n\t".'<div class="'. esc_attr( $css_class ) .' animated" data-animation="'. esc_attr( $css_animation_type ) .'"'. $style .''. $css_delay .'>';
} else {
	$output .= "\n\t".'<div class="'. esc_attr( $css_class ) .'"'.$style.'>';
}

$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;