<?php
$output = $algin = $el_class = '';
extract(shortcode_atts(array(
	'el_class'        	=> '',
),$atts));

$el_class = $this->getExtraClass($el_class);
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$output .= '<div class="service-block'. esc_attr( $el_class ) .'">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

echo $output;