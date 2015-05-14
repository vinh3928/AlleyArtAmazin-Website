<?php
$output = $style = $margin_top = $margin_bottom = $el_class = '';
extract(shortcode_atts(array(
	'style'				=> 'divider-dashed alizarin-divider',
	'margin_top'		=> '',
	'margin_bottom'		=> '',
	'el_class'			=> '',
),$atts));

$el_class = $this->getExtraClass($el_class);
$html_margin = '';
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$el_class = $style . $el_class;

if( ! empty( $margin_top ) || ! empty( $margin_bottom ) ) {
	$margin_top = ( $margin_top ) ? $margin_top : 0;
	$margin_bottom = ( $margin_bottom ) ? $margin_bottom : 0;
	$html_margin = ' style="margin-top:'. esc_attr( $margin_top ) .'px;margin-bottom:'. esc_attr( $margin_bottom ) .'px;"';
}

$output = '<div class="divider clearfix '. esc_attr( $el_class ) .'"'. $html_margin .'></div>';
echo $output;