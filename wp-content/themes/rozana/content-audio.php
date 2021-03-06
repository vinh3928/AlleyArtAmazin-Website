<?php
global $sama_options;
$blog_type = $sama_options['blog_type'];
if ( $blog_type == 'grid' && ! is_single() ) {
	// Blog Grid
	get_template_part( 'blog-templates/content-audio', 'grid' );
} elseif ( $blog_type == 'list' && ! is_single() ) {
	// Blog type list
	get_template_part( 'blog-templates/content-audio', 'list' );
} elseif ( $blog_type == 'masonry' && ! is_single() ) {
	// Blog masonry
	get_template_part( 'blog-templates/content-audio', 'masonry' );
} elseif ( ( $blog_type == 'bigthumbnails' || $blog_type == 'bigthumbwithsidebar' ) && ! is_single() ) {
	// Blog Big Thumbnails
	get_template_part( 'blog-templates/content-audio-big', 'thumb' );
} elseif ( ( $blog_type == 'wpdefalutfullwidth' || $blog_type == 'wpdefaultwithsidebar' ) && ! is_single() ) {
	// Blog Wordpress Default
	get_template_part( 'blog-templates/content-audio-wp', 'default' );
} elseif( is_single() ) {
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<!-- Banner Image -->
		<?php
			$audio_url = esc_url( get_post_meta( get_the_ID(), '_sama_audio_url', true ) );
			if ( $audio_url && isset( $sama_options['single_audio_at_top'] ) && $sama_options['single_audio_at_top'] == 'audio' ) {
		?>
				<div class="img-banner">
					<div class="video-fit sound-cloud">
						<iframe src="https://w.soundcloud.com/player/?url=<?php echo urlencode( esc_url( $audio_url) ); ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true" class="soundcloud"></iframe>
					</div>
				</div>
		<?php } elseif ( has_post_thumbnail() && isset( $sama_options['single_audio_at_top'] ) && $sama_options['single_audio_at_top'] == 'thumb' ) { // check if the post has a Post Thumbnail assigned to it. ?>
			<div class="img-banner">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('blog-big-thumb', array('class'=>'img-responsive img-blog-fullwidth')); ?>
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
			<header class="title-blog-name">
				<h1><?php the_title(); ?></h1>
			</header>
			<span class="divider-blog">
				<span></span>
			</span>
			<div class="breadcrumb-blog">
				<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
				<?php the_terms( get_the_ID(), 'category', '<span class="icon-folder-open"></span> ', ', ', '' ); ?>
				<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
				<?php sama_post_view(); ?>
				<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
			</div>
	   </div>
	   <!-- End# Date & Titles -->
	   
	   <!-- Blog Description -->
	   <div class="blog-desc-single">
			<?php 
				the_content();
				
				wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'samathemes' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
	   </div>
	   <footer class="entry-footer">
			<?php
				edit_post_link( __( 'Edit', 'samathemes' ), '<span class="edit-link">', '</span>' );
				if ( isset( $sama_options['single_display_share_icon'] ) && $sama_options['single_display_share_icon'] ) {
					get_template_part('blog-templates/share-icon');
				}
			?>
		</footer><!-- .entry-footer -->
	</article>
<?php
}
?>