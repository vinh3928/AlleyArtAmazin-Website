<?php
global $sama_options;
$blog_type = $sama_options['blog_type'];
$categories = get_the_category();
$post_css 	= '';
foreach ( $categories as $category ) {
	$post_css .= $category->slug . ' ';
}
$post_css .= 'col-md-4 col-sm-4';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_css ); ?>>
	<div class="blog-list animated" data-animation="fadeInUp">
		<!-- Banner Image -->
		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
			<div class="img-banner">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
				</a>
			</div>
		<?php } ?>
		<!-- End# Banner Image -->
	   
		<!-- Date & Titles -->
		<div class="blog-date">
			<span class="icon-image"></span>
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
		</div>
		<!-- End# Blog Description -->
	</div>
</article>