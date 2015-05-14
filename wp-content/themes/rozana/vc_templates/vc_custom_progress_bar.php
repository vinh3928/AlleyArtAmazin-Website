<?php
$output = $title = $value = $unit = $bgcolor = $custombgcolor = $options = $el_class = '';
extract( shortcode_atts( array(
	'title' 		=> '',
	'value' 		=> '',
	'unit' 			=> '%',
	'bgcolor' 		=> '',
	'custombgcolor' => '',
	'options' 		=> '',
	'el_class' 		=> ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$bar_options = '';
$options = explode( ",", $options );
if ( in_array( "animated", $options ) ) $bar_options .= " active";
if ( in_array( "striped", $options ) ) $bar_options .= " progress-bar-striped progress-striped";

$output = '<div class="skill'. esc_attr( $el_class ) .'">';
if( !empty( $title ) ) {
	$output .= '<h4>'. esc_attr( $title ) .'</h4>';
}
$output .= '<div class="progress">';
if( ! empty ($custombgcolor) && $bgcolor == 'custom' ) {
	$style = ' style="background-color:'.$custombgcolor.';width:'. absint( $value ) .'%;';
	$output .= '<div class="progress-bar'. $bar_options .'" '. $style .'role="progressbar" data-value="'. absint( $value ) .'">
					<span>'. absint( $value ) .''. esc_attr( $unit ) .'</span>
				</div><span class="sr-only">'. absint( $value ) .''. esc_attr( $unit ) .' '. __('Complete', 'samathemes'). '</span>
			';
} else {
	
	$output .= '<div class="progress-bar '. $bgcolor .''. $bar_options .'" role="progressbar" data-value="'. absint( $value ) .'" style="width: '. absint( $value ) .'%;">
					<span>'. absint( $value ) .''. esc_attr( $unit ) .'</span>
				</div><span class="sr-only">'. absint( $value ) .''. esc_attr( $unit ) .' '. __('Complete', 'samathemes'). '</span>
			';
}

$output .= '</div></div>';
echo $output;