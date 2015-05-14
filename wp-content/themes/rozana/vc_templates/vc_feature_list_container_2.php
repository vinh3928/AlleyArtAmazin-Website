<?php
$output = $algin = $el_class = '';
extract(shortcode_atts(array(
	'el_class'        	=> '',
),$atts));

$el_class = $this->getExtraClass($el_class);
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$output .= '<div class="social-touch'. esc_attr( $el_class ) .'"><ul>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</ul></div>';

echo $output;