<?php
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
extract(shortcode_atts(array(
	'style'		=> 'faqs_2',
    'el_class' 	=> '',
), $atts));

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  $el_class , $this->settings['base'], $atts );

global $id_accordion_tab;
$id_rand = rand(1, 999);
$id_accordion_tab = 'accordion-'. $id_rand;
$output .= "\n\t".'<div id="'. $id_accordion_tab .'" class="panel-group '. esc_attr( $style ) . esc_attr( $css_class ) .'" role="tablist" aria-multiselectable="true">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_accordion');

echo $output; 