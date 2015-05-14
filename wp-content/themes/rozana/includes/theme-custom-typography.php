<?php
/*
 *	this function to out custom Typography CSS
 *	This file only load when you enable custom typography in theme option page
 */
function sama_output_custom_css_typography () {
	global $sama_options;
	if( isset( $sama_options['enable_typography'] ) &&  $sama_options['enable_typography'] ) {
		$body_font_size 			= $sama_options['body_font_size'];
		$body_line_height 			= $sama_options['body_line_height'];
		$h1_font_size 				= $sama_options['h_1_size'];
		$h1_line_height 			= $sama_options['h_1_lineheight'];
		$h2_font_size 				= $sama_options['h_2_size'];
		$h2_line_height 			= $sama_options['h_2_lineheight'];		
		$h3_font_size 				= $sama_options['h_3_size'];
		$h3_line_height 			= $sama_options['h_3_lineheight'];
		$h4_font_size 				= $sama_options['h_4_size'];
		$h4_line_height 			= $sama_options['h_4_lineheight'];
		$h5_font_size 				= $sama_options['h_5_size'];
		$h5_line_height 			= $sama_options['h_5_lineheight'];
		$h6_font_size 				= $sama_options['h_6_size'];
		$h6_line_height 			= $sama_options['h_6_lineheight'];
		$header_font_size 			= $sama_options['custom_header_font_size'];
		$header_line_height 		= $sama_options['custom_header_linghtheight'];
		$header_font_weight 		= $sama_options['custom_header_fontweight'];
?>
<style type="text/css">
body, input, select, textarea, header h5, .team-member h5, .fun-facts h5 { font-size: <?php echo absint( $body_font_size ); ?>px; line-height: <?php echo $body_line_height; ?>px; }
h1 { font-size:<?php echo absint( $h1_font_size ); ?>px; line-height:<?php echo absint( $h1_line_height ) ; ?>px;}
h2 { font-size:<?php echo absint( $h2_font_size ); ?>px; line-height:<?php echo absint( $h2_line_height ); ?>px;}
h3 { font-size:<?php echo absint( $h3_font_size ); ?>px; line-height:<?php echo absint( $h3_line_height ); ?>px;}
h4 { font-size:<?php echo absint( $h4_font_size ); ?>px; line-height:<?php echo absint( $h4_line_height ); ?>px;}
h5 { font-size:<?php echo absint( $h5_font_size ); ?>px; line-height:<?php echo absint( $h5_line_height ); ?>px;}
h6 { font-size:<?php echo absint( $h6_font_size ); ?>px; line-height:<?php echo absint($h6_line_height ); ?>px;}
header h1, header h2 { font-size:<?php echo absint( $header_font_size ); ?>px; line-height:<?php echo absint( $header_line_height ); ?>px; font-weight:<?php echo absint( $header_font_weight ); ?>;}
</style>
<?php
	}
}
add_action( 'wp_head', 'sama_output_custom_css_typography', 10 );

?>