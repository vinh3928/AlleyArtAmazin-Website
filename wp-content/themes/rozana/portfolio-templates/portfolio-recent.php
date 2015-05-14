<!-- # Recent Work #  -->
<?php
$args = array(
	'post_type' 			=> 'project',
	'ignore_sticky_posts' 	=> 1,
	'posts_per_page'		=> 4,
	'order'					=> 'DESC',
	'orderby'				=> 'date', 
	
);
$recent_query = new WP_Query( $args );
if ( $recent_query->have_posts() ) {
?>
	<section class="grey-bg pad-top-bottom text-center">
		<div class="container">
			<div class="row">
				<!-- # Header # -->
				<div class="col-md-12 animated" data-animation="fadeIn">
					<header>
						<h2><?php _e('recent work', 'samathemes'); ?></h2>
						<span class="line">
							<span></span>
						</span>
					</header>
				</div>
				<!-- End # Header # -->
				
				<!-- # Work Samples # -->
				<div class="portfolioContainer">
					<?php while ( $recent_query->have_posts() ) { ?>
						<?php $recent_query->the_post(); ?>
						<div class="col-md-3 col-sm-6 col-xs-6">
							<!-- # Portfolio 1 # -->
							<div class="portfolio-sample-gird-4 animated" data-animation="fadeIn" data-animation-delay="200">
								<figure>
									<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
										<?php
											$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
											$img_url = wp_get_attachment_image_src( $thumbnail_id , 'portfolio-thumb-450');
										?>
										<img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
									<?php } ?>
									<figcaption>
										<div class="overlay text-center">
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h3>
											<?php the_terms( get_the_ID(), 'project-category', '<h5>', ', ', '</h5>' ); ?>
											<?php
												$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
												$img_url = wp_get_attachment_image_src( $thumbnail_id , 'full');
											?>
											<a href="<?php echo esc_url( $img_url[0] ); ?>" data-fancybox-group="gallery" title="<?php the_title_attribute(); ?>" class="fancybox-effects-b"><i class="fa fa-search"></i></a>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><i class="fa fa-link"></i></a>
										</div>
									</figcaption>
								</figure>
							</div>
							<!-- # End Portfolio 1 # -->
						</div>
					
					<?php } ?>
				</div>
				<!-- End # Work Samples # -->
			</div>
		</div>
	</section>
<?php } ?>
<?php wp_reset_postdata(); ?>