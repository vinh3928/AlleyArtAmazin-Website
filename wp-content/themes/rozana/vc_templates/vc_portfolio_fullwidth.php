<?php
$output = $num = $exclude_cat = $el_class = $grid_css = '';
extract(shortcode_atts(array(
	'type'				=> 'fullwidthwithouttext', // fullwidthwithouttext, fullwidthwithtext
	'num'				=> '',
	'exclude_cat'		=> '',
	'filter'			=> 'yes',
	'view_more'			=> 'yes',
	'el_class'        	=> '',
),$atts));

$projects_html = $cat_hml = '';
$el_class = $this->getExtraClass($el_class);
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
if( $type == 'fullwidthwithtext') {
	$grid_css = ' portfolio-withtext';
}
$top_html = '<div class="col-md-12 portfolioFilter clearfix animated" data-animation="fadeInDown">
				<ul>
				<li><a href="#" data-filter="*" class="current">'. __('All Categories', 'samathemes') .'</a></li>';
$end_top_html = '</ul></div>';		
			
$args = array(
	'post_type' 			=> 'project',
	'ignore_sticky_posts' 	=> 1,
	'posts_per_page'		=> absint( $num ),
	'order'					=> 'DESC',
	'orderby'				=> 'date', 
);
if( ! empty( $exclude_cat ) ) {
	$exclude_cat = explode( ',', $exclude_cat );
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'project-category',
			'field'    => 'term_id',
			'terms'    => esc_attr( $exclude_cat ),
			'operator' => 'NOT IN' 
		),
	);
}

$recent_query = new WP_Query( $args );
if ( $recent_query->have_posts() ) :
	$projects_html .= '<div class="portfolioContainer clearfix'. $grid_css . $el_class .'">';
		while ( $recent_query->have_posts() ) : $recent_query->the_post();
			$project_cats = get_the_terms( get_the_ID(), 'project-category');
			$project_css 	= '';
			foreach ( $project_cats as $category ) {
				$project_css .= ' '. $category->slug;
				if ( ! empty( $cats ) ) {
					$cat_not_found = true;
					foreach ( $cats as $cat ) {
						if( $cat['slug'] ==  $category->slug ){
							$cat_not_found = false;
						}
					}
					if ( $cat_not_found ) {
						$cats[] = array( 'name' => $category->name, 'slug' => $category->slug);
					}
				} else {
					$cats[] = array( 'name' => $category->name, 'slug' => $category->slug);
				}
				
			}
			$thumbnail_id 	= get_post_thumbnail_id( get_the_ID() );
			$img_url 		= wp_get_attachment_image_src( $thumbnail_id , 'portfolio-thumb-344');
			$img_url_full 	= wp_get_attachment_image_src( $thumbnail_id , 'full');
			if( $type == 'fullwidthwithtext' ) {
				$projects_html .= '<div class="portfolio-sample animated'. esc_attr( $project_css ) .'" data-animation="fadeIn">
										<figure>
											<img src="'. esc_url( $img_url[0] ) .'" alt="' .the_title_attribute('echo=0') .'">
											<figcaption>
												<div class="overlay text-center">
													<a href="'. $img_url_full[0] .'" data-fancybox-group="gallery" title="'. the_title_attribute('echo=0') .'" class="fancybox-effects-b"><i class="fa fa-search"></i></a>
													<a href="'. get_permalink() .'" title="'. the_title_attribute('echo=0') .'"><i class="fa fa-link"></i></a>
												</div>
											</figcaption>
										</figure>
										<h3><a href="'. get_permalink() .'" title="'. the_title_attribute('echo=0') .'">'. the_title('', '', false) .'</a></h3>'
										. get_the_term_list( get_the_ID(), 'project-category', '<h5>', ', ', '</h5>' ) .
									'</div>';
			} else {
				$projects_html .= '<div class="portfolio-sample animated'. esc_attr( $project_css ) .'" data-animation="fadeIn">
										<figure>
											<img src="'. esc_url( $img_url[0] ) .'" alt="' .the_title_attribute('echo=0') .'">
											<figcaption>
												<div class="overlay text-center">
													<h3><a href="'. get_permalink() .'" title="'. the_title_attribute('echo=0') .'">'. the_title('', '', false) .'</a></h3>
													'. get_the_term_list( get_the_ID(), 'project-category', '<h5>', ', ', '</h5>' ) .
													'<a href="'. $img_url_full[0] .'" data-fancybox-group="gallery" title="'. the_title_attribute('echo=0') .'" class="fancybox-effects-b"><i class="fa fa-search"></i></a>
													<a href="'. get_permalink() .'" title="'. the_title_attribute('echo=0') .'"><i class="fa fa-link"></i></a>
												</div>
											</figcaption>
										</figure>
									</div>';
			}
		endwhile;
	$projects_html .= '</div>';
endif;
wp_reset_postdata();
if ( ! empty( $projects_html ) ) {
	$view_more_link  = $cat_hml = '';
	if( $view_more == 'yes' ) {
		$projects_id 	 =  projects_get_page_id('projects');
		$url 		  	 = get_permalink($projects_id);
		if( $projects_id ) {
			$view_more_link = 	'<div class="col-md-12 pad-top-60 view-more text-center animated" data-animation="fadeInUp">
							<a class="view-more-portfolio" href="'. esc_url($url) .'">'.__('View More', 'samathemes') .'</a>
						</div>';
		}
	}
	if( ! empty( $cats ) && $filter == 'yes' ) {
		foreach ( $cats as $cat ) {
			$cat_hml .= '<li><a href="#" data-filter=".'. esc_attr( $cat['slug'] ) .'">'. esc_attr( $cat['name'] ) .'</a></li>';
		}
	}
	if( $filter != 'yes' ) {
		$top_html = $cat_hml = $end_top_html = '';
	}
	$output = $top_html . $cat_hml . $end_top_html . $projects_html . $view_more_link;
	echo $output;
}