<?php
$output = $type = $display = $bgcolor = $id = $el_class = '';
extract( shortcode_atts( array(
	'type' 		=> 'with_thumb',
	'bgcolor' 	=> '',
	'id' 		=> '',
	'el_class' 	=> ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$testimonial_query = new WP_Query( 'post_type=testimonial&p='. absint( $id ) .'' );
if ( $testimonial_query->have_posts() ) {
	if( ! empty( $el_class ) ) {
		$el_class = ' '. $el_class;
	}
	if( $bgcolor == 'second-bg' ) {
		$el_class = ' second-bg '. $el_class;
	}
	$id_attr = rand(1,999);
	$output = '<div class="testimonial-item-list  text-center'. esc_attr( $el_class ) .'">';
	
	while ( $testimonial_query->have_posts() ) {
		$testimonial_query->the_post();
		$output .= '<div class="testimonial-item owl-item  owl-wrapper-outer text-center">';
		if ( $type == 'with_thumb' ) {
			$output .= get_the_post_thumbnail( get_the_ID() ,'testimonial-thumb', array('class'=>'img-responsive img-circle'));
			$output .= '<h2>'. get_the_title() .'</h2>';
			$output .= '<h4>'.get_post_meta( get_the_ID(), '_byline', true).'</h4>';
			$output .= '<p><span><i class="fa fa-quote-left"></i></span>'. strip_tags(get_the_content()) .'<span><i class="fa fa-quote-right"></i></span></p>';
			
		} else {
			$output .= '<p><span><i class="fa fa-quote-left"></i></span>'. strip_tags(get_the_content()) .'<span><i class="fa fa-quote-right"></i></span></p>';
			$output .= '<h2>'. get_the_title() .'</h2>';
			$output .= '<h4>'.get_post_meta( get_the_ID(), '_byline', true).'</h4>';
		} 
		$output .= '</div>';
	}
	
	$output .= '</div>';
	echo $output;
}
wp_reset_postdata();