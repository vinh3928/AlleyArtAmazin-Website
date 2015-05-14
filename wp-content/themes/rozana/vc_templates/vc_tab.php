<?php
$output = $title = $tab_id = '';
extract(shortcode_atts(array(
	'title'      			=> '',
    'tab_id' 				=> '',
	'active_tab'			=> '',
	'icon'					=> '',
	'css_animation_type' 	=> '',
	'css_animation_delay' 	=> '',
), $atts));
$extra_css = '';
if( $active_tab == 'yes' ) {
	$extra_css = 'active ';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tab-pane', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="'. $extra_css . esc_attr( $css_class ).'">';
$output .= ($content=='' || $content==' ') ? __("Empty tab. Edit page to add content here.", "samathemes") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');

echo $output;