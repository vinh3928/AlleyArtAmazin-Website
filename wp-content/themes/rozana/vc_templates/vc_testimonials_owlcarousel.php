<?php
$output = $type = $display = $num = $ids = $el_class = '';
extract( shortcode_atts( array(
	'type' 		=> 'with_thumb',
	'display' 	=> 'recent',
	'num' 		=> '4',
	'ids' 		=> '',
	'el_class' 	=> ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
if( ! empty( $el_class ) ) {
		$el_class = ' '. $el_class;
	}
if( $display == 'id' && ! empty( $ids ) ) {
	$ids = explode(',', $ids);
	$args = array(
		'post_type' 			=> 'testimonial',
		'ignore_sticky_posts' 	=> 1,
		'orderby'				=> 'none',
		'post__in'				=> esc_attr( $ids)
	);
} else {
	$args = array(
		'post_type' 			=> 'testimonial',
		'ignore_sticky_posts' 	=> 1,
		'posts_per_page'		=> absint( $num ),
		'order'					=> 'DESC', //ASC
		'orderby'				=> 'date', 
	);
}

$testimonial_query = new WP_Query( $args );
if ( $testimonial_query->have_posts() ) {
	$id_attr = rand(1,999);
	$output .= '<div id="owl-testimonials-'. esc_attr( $id_attr ) .'" class="owl-theme-style3 owl-carousel clearfix'. esc_attr( $el_class ) .'">';
	
	while ( $testimonial_query->have_posts() ) {
		$testimonial_query->the_post();
		if ( $type == 'with_thumb' ) {
			$output .= '<div class="testimonial-item owl-item  owl-wrapper-outer text-center">';
		} else {
			$output .= '<div class="testimonial-item testimonial-item-no-thumb owl-item  owl-wrapper-outer text-center">';
		}
		if ( $type == 'with_thumb' ) {
			$output .= get_the_post_thumbnail( get_the_ID() ,'testimonial-thumb', array('class'=>'img-responsive img-circle'));
			$output .= '<h2>'. get_the_title() .'</h2>';
			$output .= '<h4>'.get_post_meta( get_the_ID(), '_byline', true).'</h4>';
			$output .= '<p><span><i class="fa fa-quote-left"></i></span>'. strip_tags( get_the_content() ) .'<span><i class="fa fa-quote-right"></i></span></p>';
			
		} else {
			$output .= '<p><span><i class="fa fa-quote-left"></i></span>'. strip_tags( get_the_content() ) .'<span><i class="fa fa-quote-right"></i></span></p>';
			$output .= '<h2>'. get_the_title() .'</h2>';
			$output .= '<h4>'.get_post_meta( get_the_ID(), '_byline', true).'</h4>';
		} 
		$output .= '</div>';
	}
	
	$output .= '</div>';
	echo $output;
}
wp_reset_postdata();