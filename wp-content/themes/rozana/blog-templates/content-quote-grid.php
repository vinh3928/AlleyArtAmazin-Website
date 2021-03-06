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
		<?php if ( isset( $sama_options['display_quote_in_archive'] ) && $sama_options['display_quote_in_archive'] == 'quote' ) { ?>
			<div class="img-banner">
				<blockquote>
				<i class="fa fa-quote-left"></i>
				<?php 
					$content = apply_filters( 'the_content', get_the_content('','') );
					$content = str_replace('<blockquote>', '', $content);
					$content = str_replace('</blockquote>', '', $content);
					echo wp_kses_post($content);
				?>
				</blockquote>
			</div>
		<?php } else { ?>
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
				<div class="img-banner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('blog-grid-thumb', array('class'=>'img-responsive img-blog-fullwidth')); ?>
					</a>
				</div>
			<?php } ?>
		<?php } ?>
	   
		<?php if( ( isset( $sama_options['display_title_in_quote'] ) && $sama_options['display_title_in_quote'] == 'yes' ) || ( isset( $sama_options['display_quote_in_archive'] ) && $sama_options['display_quote_in_archive'] == 'thumb' ) ) { ?>
			<div class="blog-date">
				<span class="icon-quotes-left"></span>
				<?php sama_output_html5_time_format(); ?>
			</div>
		<?php } ?>
	   
		<div class="blog-title">
			<?php if( ( isset( $sama_options['display_title_in_quote'] ) && $sama_options['display_title_in_quote'] == 'yes' ) || ( isset( $sama_options['display_quote_in_archive'] ) && $sama_options['display_quote_in_archive'] == 'thumb' ) ) { ?>
				<div class="title-blog-name">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
			<?php } ?>
			
			<span class="divider-blog">
				<span></span>
			</span>
			
			<div class="breadcrumb-blog">
				<?php sama_display_post_meta(); ?>
			</div>
		</div>
		<!-- End# Date & Titles -->
	    <?php if ( isset( $sama_options['display_quote_in_archive'] ) && $sama_options['display_quote_in_archive'] == 'thumb' ) { ?>
			<!-- Blog Description -->
			<div class="blog-desc">
				<?php the_excerpt(); ?>
			</div>
			<!-- End# Blog Description -->
		<?php } ?>
   </div>
</article>