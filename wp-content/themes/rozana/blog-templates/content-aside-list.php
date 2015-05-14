<?php global $sama_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-md-6 col-sm-6' ); ?>>
   <div class="blog-list animated" data-animation="fadeInUp">
		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
			<!-- Banner Image -->
			<div class="img-banner">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive img-blog-fullwidth')); ?>
				</a>
			</div>
			<!-- End# Banner Image -->
		<?php } ?>
		
		<!-- Date & Titles -->
	   <div class="blog-date">
			<span class="icon-file3"></span>
			<?php sama_output_html5_time_format(); ?>
	   </div>
	   
	   <div class="blog-title">
			<?php if( isset( $sama_options['display_title_in_aside'] ) && $sama_options['display_title_in_aside'] == 'yes') { ?>
				<div class="title-blog-name">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<span class="divider-blog">
					<span></span>
				</span>
			<?php } ?>
			<div class="breadcrumb-blog">
				<?php sama_display_post_meta(); ?>
			</div>
	   </div>
	   <!-- End# Date & Titles -->
	   
	   <!-- Blog Description -->
	   <div class="blog-desc">
			<?php the_content(); ?>
			<p><a href="<?php the_permalink(); ?>" class="btn-icon"><i class="fa fa-link"></i><?php _e('READ MORE', 'samathemes'); ?></a></p>
	   </div>
	   <!-- End# Blog Description -->
	</div>
	<!-- End # Blog Block -->
</article>