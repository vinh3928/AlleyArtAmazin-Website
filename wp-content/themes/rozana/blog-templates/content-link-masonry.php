<?php global $sama_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'item' ); ?>>
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
			<span class="icon-link"></span>
			<?php sama_output_html5_time_format(); ?>
		</div>
   
		<!-- Blog Title -->
		<div class="blog-title">
			<div class="title-blog-name">
				<?php if( isset( $sama_options['display_title_in_link'] ) && $sama_options['display_title_in_link'] == 'yes' ) { ?>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php
					} else {
						the_content('');
					}
				?>
			</div>
			<span class="divider-blog">
				<span></span>
			</span>
			<div class="breadcrumb-blog">
				<?php sama_display_post_meta(); ?>
			</div>
		</div>
	   <!-- End# Date & Titles -->
	</div>
</article>