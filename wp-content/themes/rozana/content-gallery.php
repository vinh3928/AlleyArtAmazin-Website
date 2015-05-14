<?php
global $sama_options;
$blog_type = $sama_options['blog_type'];
if ( $blog_type == 'grid' && ! is_single() ) {
	// Blog Grid
	get_template_part( 'blog-templates/content-gallery', 'grid' );
} elseif ( $blog_type == 'list' && ! is_single() ) {
	// Blog type list
	get_template_part( 'blog-templates/content-gallery', 'list' );
} elseif ( $blog_type == 'masonry' && ! is_single() ) {
	// Blog masonry
	get_template_part( 'blog-templates/content-gallery', 'masonry' );
} elseif ( ( $blog_type == 'bigthumbnails' || $blog_type == 'bigthumbwithsidebar' ) && ! is_single() ) {
	// Blog Big Thumbnails
	get_template_part( 'blog-templates/content-gallery-big', 'thumb' );
} elseif ( ( $blog_type == 'wpdefalutfullwidth' || $blog_type == 'wpdefaultwithsidebar' ) && ! is_single() ) {
	// Blog Wordpress Default
	get_template_part( 'blog-templates/content-gallery-wp', 'default' );
} elseif( is_single() ) {
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
			if( $images && isset( $sama_options['single_gallery_at_top'] ) && $sama_options['single_gallery_at_top'] == 'gallery' ) {
		?>
			<div class="img-banner">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
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
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="icon-arrow-left8"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="icon-arrow-right8"></span>
					</a>
				</div>
			</div>
		<?php } elseif ( has_post_thumbnail() && isset( $sama_options['single_gallery_at_top'] ) && $sama_options['single_gallery_at_top'] == 'thumb' ) { // check if the post has a Post Thumbnail assigned to it. ?>
			<div class="img-banner">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
				</a>
			</div>
		<?php } ?>
	   
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