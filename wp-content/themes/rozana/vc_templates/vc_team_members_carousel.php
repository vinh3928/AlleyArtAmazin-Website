<?php
$output = $display = $num = $ids = $el_class = '';
extract( shortcode_atts( array(
	'display' 			=> 'recent',
	'num' 				=> '4',
	'ids' 				=> '',
	'order' 			=> 'DESC',
	'orderby' 			=> 'date',
	'excerpt_length'	=> 9,
	'el_class' 			=> ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

if( $display == 'id' && ! empty( $ids ) ) {
	$ids = explode(',', $ids);
	$args = array(
		'post_type' 			=> 'team-member',
		'ignore_sticky_posts' 	=> 1,
		'orderby'				=> 'none',
		'post__in'				=> esc_attr( $ids )
	);
} else {
	$args = array(
		'post_type' 			=> 'team-member',
		'ignore_sticky_posts' 	=> 1,
		'posts_per_page'		=> absint( $num ),
		'order'					=> esc_attr($order), //ASC
		'orderby'				=> esc_attr($orderby), 
	);
}

$team_query = new WP_Query( $args );
if ( $team_query->have_posts() ) {
	if( ! empty( $el_class ) ) {
		$el_class = ' '. $el_class;
	}
	$id_attr = rand(1,999);
	$output .= '<div id="owl-team-members-'. esc_attr( $id_attr ) .'" class="owl-theme-style owl-carousel clearfix'. $el_class .'">';
	
	while ( $team_query->have_posts() ) {
		$team_query->the_post();
		$facebook_url = esc_url ( get_post_meta( get_the_ID(), '_facebook', true) );
		$twitter_url  = '';
		if( get_post_meta( get_the_ID(), '_twitter', true) ) {
			$twitter_url  = esc_url ( 'https://twitter.com/'. get_post_meta( get_the_ID(), '_twitter', true) );
		}
		$gplus_url  = esc_url ( get_post_meta( get_the_ID(), '_googleplus', true) );
		$linkedin_url  = esc_url ( get_post_meta( get_the_ID(), '_linkedin', true) );
		$email	= esc_attr ( get_post_meta( get_the_ID(), '_contact_email', true) );
		$content = get_the_content();
		$content = strip_shortcodes($content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = strip_tags($content);
		$excerpt_length = absint( $excerpt_length );
		$words = explode(' ', $content, $excerpt_length + 1);
		if( count( $words ) > $excerpt_length ) {
			array_pop($words);
			$content = implode(' ', $words);
		}
		$output .= '<div class="col-md-3 text-center animated owl-item" data-animation="fadeInUp">
					<div class="team-member">
						<div class="img-member">'
							. get_the_post_thumbnail( get_the_ID() ,'testimonial-thumb', array('class'=>'img-circle')) .'
						</div>
						<h3>'. get_the_title() .'</h3>
						<h5>'. esc_attr( get_post_meta( get_the_ID(), '_byline', true) ).'</h5>
						<p>'.esc_attr( $content ).'</p>
						<ul>';
					if ( ! empty( $facebook_url ) ) {
						$output .= '<li><a href="'. esc_url( $facebook_url ).'" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
					}
					if ( ! empty ( $twitter_url ) ) {
						$output .= '<li><a href="'. esc_url( $twitter_url ) .'" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
					}
					if ( ! empty ( $linkedin_url ) ) {
						$output .= '<li><a href="'. esc_url( $linkedin_url ).'" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>';
					}
					if ( ! empty ( $gplus_url ) ) {
						$output .= '<li><a href="'. esc_url( $gplus_url ) .'" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>';
					}
					if ( ! empty ( $email ) ) {
						$output .= '<li><a href="mailto:'. esc_html( $email ) .'" title="Email"><i class="fa fa-envelope-o"></i></a></li>';
					}
					
		$output .=  '</ul></div></div>';	
	}
	
	$output .= '</div>';
	echo $output;
}
wp_reset_postdata();