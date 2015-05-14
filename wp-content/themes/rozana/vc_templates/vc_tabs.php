<?php
$output = $title = $interval = $el_class = '';
extract( shortcode_atts( array(
	'title' 	=> '',
	'style'		=> 'nav-tabs',
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode ) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
if( $style == 'nav-tabs2' ) {
	$nav_tabs = 'nav-tabs2';
	$tab_content = 'tab-content tab-content2';
} else {
	$nav_tabs = 'nav-tabs';
	$tab_content = 'tab-content';
}

$tabs_nav = '<ul class="nav '. $nav_tabs .'">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['title'])) {
		$data_animation = $data_animation_delay = $extra_css = $icon_html = $animated_css = $active_css = '';
		if ( ! empty( $tab_atts['css_animation_type'] )) {
			$animated_css = 'animated ';
			$data_animation = ' data-animation="'. esc_attr( $tab_atts['css_animation_type'] ) .'"';
			if( $tab_atts['css_animation_delay'] != '' ) {
				$data_animation_delay = ' data-animation-delay="'. absint( $tab_atts['css_animation_delay'] ) .'"';
			}
		}
		if( isset ( $tab_atts['active_tab'] ) && $tab_atts['active_tab'] == 'yes' ) {
			$active_css = 'active';
		}
		$extra_css = ' class="'. $animated_css . $active_css .'"';
		if( ! empty( $tab_atts['icon'] ) ) {
			if( ! empty( $icon ) ) {
				$icon = str_replace( 'fa ', '', $icon );
			}
			$icon_html = '<i class="fa '. esc_attr( $tab_atts['icon'] ) .'"></i> ';
		}
		$tabs_nav .= '<li'. $extra_css . $data_animation . $data_animation_delay .'><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $icon_html . esc_attr( $tab_atts['title'] ) . '</a></li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="' . $css_class . '">';
//$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
$output .= "\n\t\t\t" . $tabs_nav;
$output .= "\n\t\t" . '<div class="'. $tab_content .'">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
if ( 'vc_tour' == $this->shortcode ) {
	$output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __( 'Previous tab', 'js_composer' ) . '">' . __( 'Previous tab', 'js_composer' ) . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __( 'Next tab', 'js_composer' ) . '">' . __( 'Next tab', 'js_composer' ) . '</a></span></div>';
}
//$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.tabcontent' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );

echo $output;