<?php global $sama_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-list animated' ); ?> data-animation="fadeInUp">
	<?php
			$images = get_children(
				array(
					'numberposts' => -1, // Load all posts
					'orderby' => 'menu_order', // Images will be loaded in the order set in the page media manager
					'order'=> 'ASC', // Use ascending order
					'post_mime_type' => 'image', // Loads only images
					'post_parent' => get_the_ID(), // Loads only images associated with the specific page
					'post_status' => null, // No status
					'post_type' => 'attachment' // Type of the posts to load - attachments
				)
			);
			$id = 'carousel-'. rand(1,999);
			if( $images && isset( $sama_options['gallery_post_view_thumb'] ) && $sama_options['gallery_post_view_thumb'] != 'yes' ) {
		?>
			<div class="img-banner">
				<div id="<?php echo esc_attr( $id ); ?>" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php $i = 1; ?>
						<?php foreach($images as $image) { ?>
							<div class="item<?php if( $i == 1 ) echo ' active'; ?>">
								<?php $src = wp_get_attachment_image_src( $image->ID, 'blog-grid-thumb' ); ?>
							  <img src="<?php echo esc_url($src[0]); ?>" alt="<?php echo esc_attr( $image->post_title ); ?>" class="img-responsive">
							</div>
							<?php $i++; ?>
						<?php } ?>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#<?php echo esc_attr( $id ); ?>" role="button" data-slide="prev">
						<span class="icon-arrow-left8"></span>
					</a>
					<a class="right carousel-control" href="#<?php echo esc_attr( $id ); ?>" role="button" data-slide="next">
						<span class="icon-arrow-right8"></span>
					</a>
				</div>
			</div>
		<?php } elseif ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
			<div class="img-banner">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
				</a>
			</div>
		<?php } ?>
	   
	<!-- Date & Titles -->
	<div class="blog-date">
		<span class="icon-images"></span>
		<?php sama_output_html5_time_format(); ?>
	</div>
	   
	<div class="blog-title">
		<div class="title-blog-name">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</div>
		<span class="divider-blog">
			<span></span>
		</span>
		<div class="breadcrumb-blog">
			<?php sama_display_post_meta(); ?>
		</div>
	</div>
	<!-- End# Date & Titles -->
	   
	<!-- Blog Description -->
	<div class="blog-desc">
		<?php the_excerpt(); ?>
		<p><a href="<?php the_permalink(); ?>" class="btn-icon"><i class="fa fa-link"></i><?php _e('READ MORE', 'samathemes'); ?></a></p>
	</div>
	<!-- End# Blog Description -->
</article>