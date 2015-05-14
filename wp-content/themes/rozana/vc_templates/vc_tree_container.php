<?php
$output = $el_class = '';
extract(shortcode_atts(array(
	'el_class' => '',
),$atts));

$el_class = $this->getExtraClass($el_class);
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$output .= '<div class="tree-timeline'. esc_attr( $el_class ) .'"><div class="tree-repeat">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div></div>';

echo $output;