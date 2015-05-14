<?php
$output = $category = $num = $author = $tags = $comments = $views = $el_class = '';
extract(shortcode_atts(array(
	'type'					=> 'recent', // ids
	'ids'					=> '',
	'category'				=> -1,
	'num'					=> '3',
	'author'				=> 'yes',
	'tags' 					=> 'yes',
	'comments' 				=> 'yes',
	'views'					=> 'no',
	'ex_lengs'				=> 16,
	'display_excerpt'		=> 'no',
	'display_view_more'		=> 'no',
	'el_class'      		=> '',
),$atts));

$el_class 	= $this->getExtraClass($el_class);
global $sama_options;

if( $type == 'ids' && ! empty( $ids ) ) {
	$ids = esc_attr( $ids );
	$ids = explode(',', $ids);
	$args = array(
		'post_type' 			=> 'post',
		'ignore_sticky_posts' 	=> 1,
		'orderby'				=> 'none',
		'post__in'				=> $ids
	);
} else {
	$args = array(
		'post_type' 			=> 'post',
		'ignore_sticky_posts' 	=> 1,
		'posts_per_page'		=> absint( $num ),
		'order'					=> 'DESC',
	);
	if ( ! empty( $category ) && $category != -1 ) {
		$args['cat'] = absint( $catid );
	}
}

$query = new WP_Query( $args );
if ( $query->have_posts() ) {
	$output .= '<div class="blog-gird-style">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$format = get_post_format();
		$postClass = get_post_class(); 
		$output .= '<article id="post-'.get_the_ID().'" class="col-md-4 col-sm-4 '. implode(' ', $postClass) .'">
					<div class="blog-list animated" data-animation="fadeInUp">';
		ob_start();
		if( $format == 'video' ) {
	?>
			<?php
				$video_url = esc_url( get_post_meta( get_the_ID(), '_sama_video_url', true ) );
				if ( $video_url && $sama_options['video_post_view_thumb'] != 'yes' ) {
			?>
					<div class="img-banner">
						<div class="video-fit">
							<?php echo wp_oembed_get( esc_url( $video_url) ); ?>
						</div>
					</div>
			<?php } elseif ( has_post_thumbnail() ) { ?>
				<div class="img-banner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
					</a>
				</div>
			<?php } ?>
			<div class="blog-date">
				<span class="icon-video2"></span>
				<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
			</div>
			<div class="blog-title">
				<div class="title-blog-name">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<span class="divider-blog">
					<span></span>
				</span>
				<div class="breadcrumb-blog">
					<?php if( $author == 'yes' ) { ?>
						<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
					<?php } ?>
					<?php if( $tags == 'yes' ) { ?>
						<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
					<?php } ?>
					<?php if( $views == 'yes' ) { ?>
						<?php sama_post_view(); ?>
					<?php } ?>
					<?php if( $comments == 'yes' ) { ?>
						<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
					<?php } ?>
				</div>
			</div>
			<?php if ( $display_excerpt == 'yes' ) { ?>
				<div class="blog-desc">
					<?php sama_custom_excerpt($ex_lengs); ?>
				</div>
			<?php } ?>
	<?php
		} elseif( $format == 'aside' ) {
	?>
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
				<div class="img-banner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
					</a>
				</div>
			<?php } ?>
		   <div class="blog-date">
				<span class="icon-file3"></span>
				<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
		   </div>
		   <div class="blog-title">
				<?php if( $sama_options['display_title_in_aside'] == 'yes') { ?>
					<div class="title-blog-name">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
					<span class="divider-blog">
						<span></span>
					</span>
				<?php } ?>
				
				<div class="breadcrumb-blog">
					<?php if( $author == 'yes' ) { ?>
						<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
					<?php } ?>
					<?php if( $tags == 'yes' ) { ?>
						<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
					<?php } ?>
					<?php if( $views == 'yes' ) { ?>
						<?php sama_post_view(); ?>
					<?php } ?>
					<?php if( $comments == 'yes' ) { ?>
						<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
					<?php } ?>
				</div>
		   </div>
		   <?php if ( $display_excerpt == 'yes' ) { ?>
				<div class="blog-desc">
					<?php sama_custom_excerpt($ex_lengs); ?>
				</div>
			<?php } ?>
	<?php
		} elseif( $format == 'audio' ) {
	?>
			<?php
				$audio_url = esc_url( get_post_meta( get_the_ID(), '_sama_audio_url', true ) );
				if ( $audio_url && $sama_options['audio_post_view_thumb'] != 'yes' ) {
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

			<div class="blog-date">
				<span class="icon-soundcloud"></span>
				<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
			</div>
	   
			<div class="blog-title">
				<div class="title-blog-name">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<span class="divider-blog">
					<span></span>
				</span>
				
				<div class="breadcrumb-blog">
					<?php if( $author == 'yes' ) { ?>
						<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
					<?php } ?>
					<?php if( $tags == 'yes' ) { ?>
						<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
					<?php } ?>
					<?php if( $views == 'yes' ) { ?>
						<?php sama_post_view(); ?>
					<?php } ?>
					<?php if( $comments == 'yes' ) { ?>
						<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
					<?php } ?>
				</div>
			</div>
			<?php if ( $display_excerpt == 'yes' ) { ?>
				<div class="blog-desc">
					<?php sama_custom_excerpt($ex_lengs); ?>
				</div>
			<?php } ?>
	<?php
		} elseif( $format == 'gallery' ) {
	?>
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
				if( $images && $sama_options['gallery_post_view_thumb'] != 'yes' ) {
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

				<div class="blog-date">
					<span class="icon-images"></span>
					<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
				</div>
		   
				<div class="blog-title">
					<div class="title-blog-name">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
					<span class="divider-blog">
						<span></span>
					</span>
					
					<div class="breadcrumb-blog">
						<?php if( $author == 'yes' ) { ?>
							<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
						<?php } ?>
						<?php if( $tags == 'yes' ) { ?>
							<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
						<?php } ?>
						<?php if( $views == 'yes' ) { ?>
							<?php sama_post_view(); ?>
						<?php } ?>
						<?php if( $comments == 'yes' ) { ?>
							<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
						<?php } ?>
					</div>
				</div>
				<?php if ( $display_excerpt == 'yes' ) { ?>
					<div class="blog-desc">
						<?php sama_custom_excerpt($ex_lengs); ?>
					</div>
				<?php } ?>
	<?php
		} elseif( $format == 'image' ) {
	?>
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
				<div class="img-banner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
					</a>
				</div>
			<?php } ?>
			<div class="blog-date">
				<span class="icon-image"></span>
				<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
			</div>
			<div class="blog-title">
				<div class="title-blog-name">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<span class="divider-blog">
					<span></span>
				</span>
				<div class="breadcrumb-blog">
					<?php if( $author == 'yes' ) { ?>
						<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
					<?php } ?>
					<?php if( $tags == 'yes' ) { ?>
						<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
					<?php } ?>
					<?php if( $views == 'yes' ) { ?>
						<?php sama_post_view(); ?>
					<?php } ?>
					<?php if( $comments == 'yes' ) { ?>
						<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
					<?php } ?>
				</div>
				</div>
			<?php if ( $display_excerpt == 'yes' ) { ?>
				<div class="blog-desc">
					<?php sama_custom_excerpt($ex_lengs); ?>
				</div>
			<?php } ?>
	<?php
		} elseif( $format == 'link' ) {
	?>
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
				<div class="img-banner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
					</a>
				</div>
			<?php } ?>
			<div class="blog-date">
				<span class="icon-link"></span>
				<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
			</div>
	   
			<div class="blog-title">
				<div class="title-blog-name">
					<?php
						global $sama_options;
						if( $sama_options['display_title_in_link'] == 'yes' ) {
					?>
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php
						} else {
							the_content(__('Read more', 'sama_themes'));
						}
					?>
				</div>
				<span class="divider-blog">
					<span></span>
				</span>
				<div class="breadcrumb-blog">
					<?php if( $author == 'yes' ) { ?>
						<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
					<?php } ?>
					<?php if( $tags == 'yes' ) { ?>
						<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
					<?php } ?>
					<?php if( $views == 'yes' ) { ?>
						<?php sama_post_view(); ?>
					<?php } ?>
					<?php if( $comments == 'yes' ) { ?>
						<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
					<?php } ?>
				</div>
			</div>
			<?php if( $sama_options['display_title_in_link'] == 'yes') { ?>
				<?php if ( $display_excerpt == 'yes' ) { ?>
					<div class="blog-desc">
						<?php sama_custom_excerpt($ex_lengs); ?>
					</div>
				<?php } ?>
			<?php } ?>
	<?php
		} elseif( $format == 'quote' ) {
	?>
			<?php if ( $sama_options['display_quote_in_archive'] == 'quote' ) { ?>
				<div class="img-banner">
					<blockquote>
					<i class="fa fa-quote-left"></i>
					<?php 
						$content = apply_filters( 'the_content', get_the_content('','') );
						$content = str_replace('<blockquote>', '', $content);
						$content = str_replace('</blockquote>', '', $content);
						echo wp_kses_post( $content );
					?>
					</blockquote>
				</div>
			<?php } elseif( $sama_options['display_quote_in_archive'] == 'thumb' ) { ?>
				<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
					<div class="img-banner">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
						</a>
					</div>
				<?php } ?>
			<?php } ?>
	   
			<?php if( $sama_options['display_title_in_quote'] == 'yes' || $sama_options['display_quote_in_archive'] == 'thumb' ) { ?>
				<div class="blog-date">
					<span class="icon-quotes-left"></span>
					<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
				</div>
			<?php } ?>
	   
		   <div class="blog-title">
				<?php if( $sama_options['display_title_in_quote'] == 'yes' || $sama_options['display_quote_in_archive'] == 'thumb' ) { ?>
					<div class="title-blog-name">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
				<?php } ?>
				<span class="divider-blog">
					<span></span>
				</span>
				<div class="breadcrumb-blog">
					<?php if( $author == 'yes' ) { ?>
						<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
					<?php } ?>
					<?php if( $tags == 'yes' ) { ?>
						<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
					<?php } ?>
					<?php if( $views == 'yes' ) { ?>
						<?php sama_post_view(); ?>
					<?php } ?>
					<?php if( $comments == 'yes' ) { ?>
						<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
					<?php } ?>
				</div>
		   </div>
			<?php if ( $sama_options['display_quote_in_archive'] == 'thumb' ) { ?>
				<?php if ( $display_excerpt == 'yes' ) { ?>
					<div class="blog-desc">
						<?php sama_custom_excerpt($ex_lengs); ?>
					</div>
				<?php } ?>
			<?php } ?>
	<?php
		} else {
	?>
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
				<div class="img-banner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive')); ?>
					</a>
				</div>
			<?php } ?>
			   <div class="blog-date">
					<span class="icon-image"></span>
					<span><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date('j') ); ?> <br><?php echo esc_attr( get_the_date('M') ); ?></time></span>
			   </div>
			   <div class="blog-title">
					<div class="title-blog-name">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
					<span class="divider-blog">
						<span></span>
					</span>
					
					<div class="breadcrumb-blog">
						<?php if( $author == 'yes' ) { ?>
						<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
					<?php } ?>
					<?php if( $tags == 'yes' ) { ?>
						<?php the_tags( '<span class="icon-tag"></span>', ', ', ''); ?>
					<?php } ?>
					<?php if( $views == 'yes' ) { ?>
						<?php sama_post_view(); ?>
					<?php } ?>
					<?php if( $comments == 'yes' ) { ?>
						<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
					<?php } ?>
					</div>
			   </div>
			  <?php if ( $display_excerpt == 'yes' ) { ?>
				<div class="blog-desc">
					<?php sama_custom_excerpt($ex_lengs); ?>
				</div>
			 <?php } ?>
	<?php
		}
		$output .= ob_get_clean();
		$output .= '</div></article>';	
	}
	$output .= '</div>';
	if( $display_view_more == 'yes' ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$blog_url	= get_permalink( $page_for_posts );
			$output .= '<div class="col-md-12 view-more text-center animated" data-animation="fadeInUp">
							<a href="'. esc_url($blog_url) .'">'.__('View More', 'samathemes') .'</a>
						</div>';
		}		
	}
}
wp_reset_postdata();
echo $output;