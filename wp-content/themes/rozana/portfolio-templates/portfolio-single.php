<?php get_template_part( 'page-templates/custom-header-bg'); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php	
	$terms_as_text 		= get_the_term_list( $post->ID, 'project-category', '<li>', '</li><li>', '</li>' ); // Categories
	$client 			= esc_attr( get_post_meta( get_the_ID(), '_client', true ) );
	$url 				= esc_url( get_post_meta( get_the_ID(), '_url', true ) );
	$portofolio_type 	= get_post_meta( get_the_ID(), '_portolio_type', true );
	$video_url			= esc_url( get_post_meta( get_the_ID(), '_video_url', true ) );
	$attachment_ids 	= projects_get_gallery_attachment_ids();
?>
<section class="theme-color pad-top-bottom text-center">
	<div class="container">
		<div class="row">
			<article id="project-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="col-md-12 single-portfolio animated" data-animation="fadeInDown">
				   <div class="portfolio-pagination">
						<ul>
							<?php next_post_link( '<li>%link</li>','<i class="fa fa-angle-left"></i>' ); ?>
							<?php 
								$projects_page_id =  projects_get_page_id('projects');								
								if( ! empty( $projects_page_id ) && $projects_page_id != -1 ) {
							?>
								<li>
									<a href="<?php echo esc_url( get_page_link($projects_page_id) ); ?>" title="<?php _e('Portfolio', 'samathemes'); ?>"><i class="fa fa-th"></i></a>
								</li>
							<?php } ?>
							<?php previous_post_link( '<li>%link</li>','<i class="fa fa-angle-right"></i>' ); ?>
						</ul>
				   </div>
				</div>
				<!-- End # Title Portfolio  # -->

				<!-- # Img Portfolio # -->
				<div class="col-md-12 single-portfolio animated" data-animation="fadeInDown">
					<?php if( $portofolio_type == 'video' ) { ?>
						<div class="video-fit">
							<?php echo wp_oembed_get( esc_url( $video_url ) ); ?>
						</div>
					<?php } elseif ( $portofolio_type == 'gallery' ) { ?>
						<?php
							if( $attachment_ids ) {
						?>
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php
										$i = 0;
										foreach ( $attachment_ids as $attachment_id ) {
											$i++;
											$active = '';
											if( $i == 1 ) {
												$active = ' active';
											}
											$img_url = wp_get_attachment_image_src($attachment_id, 'full');
											$image_data  = get_post( $attachment_id, 'OBJECT' );
									?>
											<div class="item<?php echo esc_attr( $active ); ?>">
												<img src="<?php echo esc_url( $img_url[0] ); ?>" class="img.full-width-img img-responsive" alt="<?php echo esc_attr( $image_data->post_title ); ?>">
											</div>
									<?php } ?>
								</div>
									<!-- Controls -->
									<a rel="nofollow" class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
										<span class="icon-arrow-left8"></span>
									</a>
									<a rel="nofollow" class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
										<span class="icon-arrow-right8"></span>
									</a>
								
							</div>
						<?php
							}
						?>
					<?php } elseif( $attachment_ids ) {
						$img_url = '';
						foreach ( $attachment_ids as $attachment_id ) {
							$img_url = wp_get_attachment_image_src($attachment_id, 'portfolio-thumb-1170');
							break;
						}
						$img_url_full = wp_get_attachment_image_src($attachment_id, 'full');
						$image = '<img class="aligncenter img-responsive" src="'. esc_url( $img_url[0] ) .'" alt="'. the_title_attribute('echo=0').'">';
						$with_light_box = '<a href="'. esc_url( $img_url_full[0] ) .'" title="'. the_title_attribute('echo=0') .'" class="fancybox-effects-b">'. $image .'</a>';
						echo $with_light_box;
					?>
					<?php } elseif ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
						<?php
							$thumbnail_id 	= get_post_thumbnail_id( get_the_ID() );
							$img_url 		= wp_get_attachment_image_src( $thumbnail_id , 'portfolio-thumb-1170');
							$img_url_full 	= wp_get_attachment_image_src($thumbnail_id, 'full');
							$image = '<img class="aligncenter img-responsive" src="'. esc_url( $img_url[0] ).'" alt="'. the_title_attribute('echo=0').'">';
							echo '<a href="'. esc_url( $img_url_full[0] ) .'" title="'. the_title_attribute('echo=0') .'" class="fancybox-effects-b">'. $image .'</a>';
						?>
						
					<?php } ?>
				</div>
				<!-- End # Img Portfolio  # -->

				<div class="blog-desc-single portfolio-description animated" data-animation="fadeInDown">
					<div class="col-md-3 col-sm-4">
						
						<h4><?php _e('ADDED', 'samathemes'); ?></h4>
						<p><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_date(); ?></time></p>
						
						<?php if( $client ) { ?>
							<h4><?php _e('Client', 'samathemes'); ?></h4>
							<p><?php echo esc_attr( $client ); ?></p>
						<?php } ?>
						<?php
							if ( $terms_as_text ) {
								echo '<h4>' . __( 'Categories', 'projects-by-woothemes' ) . '</h4>';
								echo '<ul class="single-project-categories">';
								echo wp_kses_post( $terms_as_text );
								echo '</ul>';
							}
						?>
						
					</div>
				
					<div class="col-md-9 col-sm-8">
							<!-- Description -->
							<h4><?php _e('DESCRIPTION', 'samathemes'); ?></h4>
							<?php the_content(); ?>
							<?php	
								wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'samathemes' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								) );
								
								edit_post_link( __( 'Edit', 'samathemes' ), '<span class="edit-link">', '</span>' );
							?>
							<!-- End#  Description -->
							
							<!-- Share -->
							<?php get_template_part('portfolio-templates/share-icon'); ?>
							<!-- End# Share -->
					</div>
				</div>
			</article>
		</div>
	</div>
</section>
<?php endwhile; // end of the loop. ?>