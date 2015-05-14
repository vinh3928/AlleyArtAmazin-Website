<?php if( ! is_project_category() ) { ?>
	<!--div class="col-md-12 portfolioFilter clearfix animated" data-animation="fadeInDown">
		<ul>
			<li><a rel="nofollow" href="#" data-filter="*" class="current"><?php _e('All Categories', 'samathemes'); ?></a></li>
			<?php
				$args = array(
					'type'                     => 'project',
					'child_of'                 => 0,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 0,
					'taxonomy'                 => 'project-category',
				);
				$categories = get_categories( $args );
				foreach ( $categories as $category ) {
			?>
				<li><a rel="nofollow" href="#" data-filter=".<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name ); ?></a></li>
			<?php		
				}
			?>
		</ul>
	</div-->
<?php } ?>
<div class="portfolioContainer">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
			$project_cats = get_the_terms( get_the_ID(), 'project-category');
			$project_css 	= '';
			if( is_array( $project_cats ) ) {
				foreach ( $project_cats as $category ) {
					$project_css .= ' '. $category->slug;
				}
			}
		?>
		<div class="col-md-3 col-sm-4<?php echo esc_attr( $project_css ); ?>">
			<div class="portfolio-sample-gird-4 animated" data-animation="fadeIn">
				<figure>
					<?php 
						if ( has_post_thumbnail() ) {
							$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
							$img_url = wp_get_attachment_image_src( $thumbnail_id , 'portfolio-thumb-450');
					?>
							<img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php the_title_attribute(); ?>">
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
		</div>
		
	<?php endwhile; // end of the loop. ?>
</div>
<div class="col-md-12 pad-top-60 view-more animated" data-animation="fadeInUp">
	<?php sama_paging_nav(); ?>
</div>