<?php
global $sama_options;
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
		<?php
			$audio_url = esc_url( get_post_meta( get_the_ID(), '_sama_audio_url', true ) );
			if ( $audio_url && isset( $sama_options['audio_post_view_thumb'] ) && $sama_options['audio_post_view_thumb'] != 'yes' ) {
		?>
				<div class="img-banner">
					<div class="video-fit sound-cloud">
						<?php echo wp_oembed_get( esc_url( $audio_url ) ); ?>
					</div>
				</div>
		<?php } elseif ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
			<div class="img-banner">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
				</a>
			</div>
		<?php } ?>
	   <!-- End# Banner Image -->
	   
		<!-- Date & Titles -->
		<div class="blog-date">
			<span class="icon-soundcloud"></span>
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
