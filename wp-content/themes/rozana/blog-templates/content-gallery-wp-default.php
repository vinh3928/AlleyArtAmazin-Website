<?php global $sama_options; ?>		
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-list animated' ); ?> data-animation="fadeInUp">
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
		<?php the_content(); ?>
		<p><a href="<?php the_permalink(); ?>" class="btn-icon"><i class="fa fa-link"></i><?php _e('READ MORE', 'samathemes'); ?></a></p>
	</div>
	<!-- End# Blog Description -->
</article>