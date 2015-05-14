<?php
$output = $type = $id = $image = $title = $role = $about = $facebook = $twitter = $linkedin = $googleplus = $el_class = '';
extract( shortcode_atts( array(
	'type' 				=> 'add_member',
	'display'			=> 'leftimage',
	'id' 				=> '',
	'excerpt_length'	=> 9,
	'image'				=> '',
	'title' 			=> '',
	'role' 				=> '',
	'about'				=> '',
	'facebook'			=> '',
	'twitter'			=> '',
	'linkedin'			=> '',
	'googleplus'		=> '',
	'el_class' 			=> ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
if( $type == 'woo_team' ) {
	$member_query = new WP_Query( 'post_type=team-member&p='. absint($id) .'' );
	if ( $member_query->have_posts() ) {
		while ( $member_query->have_posts() ) {
			$member_query->the_post();
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
			if( $display == 'leftimage' ) {	
				$output  = '<div class="row no-margin teams'. esc_attr( $el_class ) .'">';
				$output .= '<div class="col-md-4 no-margin">'. 
								get_the_post_thumbnail( get_the_ID() ,'testimonial-thumb', array('class'=>'img-circle')).
							'</div>
							<div class="col-md-8 no-margin">
								<h4>'. get_the_title() .'</h4>
								<h5>'. esc_attr( get_post_meta( get_the_ID(), '_byline', true) ) .'</h5>
								<p>'.  get_the_excerpt() .'</p>
								<ul>';
									if ( ! empty( $facebook_url ) ) {
										$output .= '<li><a href="'. esc_url( $facebook_url ) .'" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
									}
									if ( ! empty ( $twitter_url ) ) {
										$output .= '<li><a href="'. esc_url( $twitter_url ) .'" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
									}
									if ( ! empty ( $linkedin_url ) ) {
										$output .= '<li><a href="'. esc_url( $linkedin_url ) .'" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>';
									}
									if ( ! empty ( $gplus_url ) ) {
										$output .= '<li><a href="'. esc_url( $gplus_url ) .'" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>';
									}
									if ( ! empty ( $email ) ) {
										$output .= '<li><a href="mailto:'. esc_html( $email ) .'" title="Email"><i class="fa fa-envelope-o"></i></a></li>';
									}
				$output .= '</ul></div>';
				$output .= '</div>';
			} else {
				$output = '<div class="team-member marg-bottom-20 text-center'. $el_class .'">
						  <div class="img-member">'. 
								get_the_post_thumbnail( get_the_ID() ,'testimonial-thumb', array('class'=>'img-circle')).
                          '</div>
						  <h3>'. get_the_title() .'</h3>
						  <h5>'. esc_attr( get_post_meta( get_the_ID(), '_byline', true) ) .'</h5>
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
				
				$output .= '</div>';
			}
		}
		
		echo $output;
	}
	wp_reset_postdata();
} else {
	$facebook_url = esc_url( $facebook );
	$twitter_url  = esc_url( $twitter );
	$gplus_url    = esc_url( $googleplus );
	$linkedin_url = esc_url( $linkedin );
	$img_id = preg_replace( '/[^\d]/', '', $image );
	$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'testimonial-thumb', 'class' => 'img-circle' ) );
	if ( $img == NULL ) $img['thumbnail'] = '<img class="img-circle" src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
	if( $display == 'leftimage' ) {	
		$output  = '<div class="row no-margin teams'. $el_class .'">
						<div class="col-md-4 no-margin">'.$img['thumbnail'].'</div>
						<div class="col-md-8 no-margin">
							<h4>'. esc_attr( $title ) .'</h4>
							<h5>'. esc_attr( $role ).'</h5>
							<p>'.  esc_attr( $about ) .'</p>
							<ul>';
								if ( ! empty( $facebook_url ) ) {
									$output .= '<li><a href="'. esc_url( $facebook_url ) .'" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
								}
								if ( ! empty ( $twitter_url ) ) {
									$output .= '<li><a href="'. esc_url( $twitter_url ) .'" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
								}
								if ( ! empty ( $linkedin_url ) ) {
									$output .= '<li><a href="'. esc_url( $linkedin_url ) .'" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>';
								}
								if ( ! empty ( $gplus_url ) ) {
									$output .= '<li><a href="'. esc_url( $gplus_url) .'" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>';
								}
		$output .= '</ul></div></div>';
	} else {
		$output  = '<div class="team-member marg-bottom-20 text-center'. $el_class .'">
						<div class="img-member">'. $img['thumbnail']. '</div>
							<h3>'. esc_attr( $title ) .'</h3>
							<h5>'. esc_attr( $role ).'</h5>
							<p>'.  esc_attr( $about ) .'</p>
							<ul>';
								if ( ! empty( $facebook_url ) ) {
									$output .= '<li><a href="'. esc_url( $facebook_url ) .'" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
								}
								if ( ! empty ( $twitter_url ) ) {
									$output .= '<li><a href="'. esc_url( $twitter_url ) .'" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
								}
								if ( ! empty ( $linkedin_url ) ) {
									$output .= '<li><a href="'. esc_url( $linkedin_url ) .'" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>';
								}
								if ( ! empty ( $gplus_url ) ) {
									$output .= '<li><a href="'. esc_url( $gplus_url) .'" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>';
								}
		$output .= '</ul></div>';
	
	}
	echo $output;
}