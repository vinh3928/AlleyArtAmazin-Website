<?php
$output = $algin = $el_class = '';
extract(shortcode_atts(array(
	'algin'				=> 'flt-left',
	'el_class'        	=> '',
),$atts));

$el_class = $this->getExtraClass($el_class);
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$output .= '<div class="what-we-do'. esc_attr( $el_class ) .'"><ul class="'. $algin .'">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</ul></div>';

echo $output;