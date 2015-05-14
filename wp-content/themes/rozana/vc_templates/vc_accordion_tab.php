<?php
$output = $title = $active_tab = '';

extract(shortcode_atts(array(
	'title' 		=> __("Section", "js_composer"),
	'active_tab'	=> '',
), $atts));
global $id_accordion_tab;
$active_class = '';
$icon = '<i class="glyphicon glyphicon-plus"></i>';
if( $active_tab == 'yes' ) {
	$active_class=' in';
	$icon = '<i class="glyphicon glyphicon-minus"></i>';
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div class="panel panel-default animated '.$css_class.'" data-animation="fadeInUp">';
	$output .= "\n\t\t\t\t" . '<a class="accordion-toggle" data-toggle="collapse" data-parent="#'. esc_attr( $id_accordion_tab ).'" href="#'. sanitize_title($title).'">'. $icon . esc_attr( $title ).'</a>';
    $output .= "\n\t\t\t\t" . '<div id="'. sanitize_title($title) .'" class="panel-collapse collapse'. $active_class .'"><div class="panel-body">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div></div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;