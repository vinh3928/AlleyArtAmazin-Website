<?php
$output = $type = $num = $exclude_cat = $el_class = $grid_css = '';
extract(shortcode_atts(array(
	'type'				=> '4colwithouttext', // 2colwithouttext, 2colwithtext, 3colwithouttext, 3colwithtext, 4colwithouttext, 4colwithtext
	'num'				=> '',
	'exclude_cat'		=> '',
	'filter'			=> 'no',
	'view_more'			=> 'yes',
	'el_class'        	=> '',
),$atts));

$projects_html = $grid_css_1 = $grid_css_2 = $css_with_text = $cat_hml = $top_html = $end_top_html = $cats = '';
$el_class = $this->getExtraClass($el_class);
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}

if( $type == '2colwithtext' || $type == '3colwithtext' || $type == '4colwithtext' ) {
	$grid_css = ' portfolio-withtext-gird';
}
if( $type == '2colwithouttext' ) {
	$grid_css_1	= 'col-md-6 col-sm-6 col-xs-6';
	$grid_css_2	= 'portfolio-sample-gird-4';
} elseif( $type == '2colwithtext' ) {
	$grid_css_1	= 'col-md-6 col-sm-6 col-xs-6';
	$grid_css_2	= 'portfolio-sample';
} elseif( $type == '3colwithouttext' ) {
	$grid_css_1	= 'col-md-4 col-sm-4 col-xs-6';
	$grid_css_2	= 'portfolio-sample-gird-4';
} elseif( $type == '3colwithtext' ) {
	$grid_css_1	= 'col-md-4 col-sm-4 col-xs-6';
	$grid_css_2	= 'portfolio-sample';
} elseif( $type == '4colwithtext' ) {
	$grid_css_1	= 'col-md-3 col-sm-4 col-xs-6';
	$grid_css_2	= 'portfolio-sample';
} else {
	$grid_css_1	= 'col-md-3 col-sm-6 col-xs-6';
	$grid_css_2	= 'portfolio-sample-gird-4';
}

if( $filter == 'no' ) {
	$top_html = '<div class="col-md-12 portfolioFilter text-center clearfix animated" data-animation="fadeInDown">
			<ul>
				<li><a href="#" data-filter="*" class="current">'. __('All Categories', 'samathemes') .'</a></li>';
	$end_top_html = '</ul></div>';		
}

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
	$projects_html .= '<div class="portfolioContainer clearfix'. $grid_css . esc_attr( $el_class ) .'">';
	//$i = 0;
		while ( $recent_query->have_posts() ) : $recent_query->the_post();	
			$project_cats = get_the_terms( get_the_ID(), 'project-category');
			$project_css 	= '';
			//$i = $i + 200;
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
			$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			if ( $type == '2colwithouttext' || $type == '2colwithtext' ) {
				$img_url = wp_get_attachment_image_src( $thumbnail_id , 'portfolio-thumb-570');
			} elseif( $type == '3colwithouttext' || $type == '3colwithtext' ) {
				$img_url = wp_get_attachment_image_src( $thumbnail_id , 'portfolio-thumb-370');
			} else {
				$img_url = wp_get_attachment_image_src( $thumbnail_id , 'portfolio-thumb-344');
			}
			$img_url_full = wp_get_attachment_image_src( $thumbnail_id , 'full');
			if( $type == '2colwithtext' || $type == '3colwithtext' || $type == '4colwithtext' ) {
				$projects_html	.= '<div class="'. $grid_css_1 .' '. trim($project_css) .'">
									<div class="'. $grid_css_2 .'">
										<figure>
											<img src="'. esc_url( $img_url[0] ) .'" alt="' .the_title_attribute('echo=0') .'">
											<figcaption>
												<div class="overlay text-center">
													<a href="'. $img_url_full[0] .'" data-fancybox-group="gallery" title="'. the_title_attribute('echo=0') .'" class="fancybox-effects-b"><i class="fa fa-search"></i></a>
													<a href="'. get_permalink() .'" title="'. the_title_attribute('echo=0') .'"><i class="fa fa-link"></i></a>
												</div>
											</figcaption>
										</figure>
										 <h3><a href="'. get_permalink() .'" title="'. the_title_attribute('echo=0') .'">'. the_title('', '', false) .'</a></h3>
										 '. get_the_term_list( get_the_ID(), 'project-category', '<h5>', ', ', '</h5>' ) .
									'</div>
								</div>';
			} else {
				$projects_html	.= '<div class="'. $grid_css_1 .' '. trim( $project_css ) .'">
									<div class="'. $grid_css_2 .'">
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
									</div>
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
			$view_more_link = 	'<div class="pad-top-60 view-more text-center animated" data-animation="fadeInUp">
							<a href="'. esc_url($url) .'">'.__('View More', 'samathemes') .'</a>
						</div>';
		}
	}
	if( ! empty( $cats ) && $filter == 'no' ) {
		foreach ( $cats as $cat ) {
			$cat_hml .= '<li><a href="#" data-filter=".'. esc_attr( $cat['slug'] ) .'">'. esc_attr( $cat['name'] ) .'</a></li>';
		}
	}
	$output = $top_html . $cat_hml . $end_top_html . $projects_html . $view_more_link;
	echo $output;
}