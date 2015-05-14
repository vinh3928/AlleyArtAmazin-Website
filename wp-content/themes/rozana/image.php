<?php
/**
 * The template for displaying image attachments.
 *
 * @package WordPress
 * @subpackage rozana
 * @since rozana 1.0
 */
 
get_header(); ?>
	
	<section class="shortcodes-banner">
		<div class="transparent-bg">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-12">
						<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="theme-color pad-top-bottom">	
		<div class="container">
			<div class="row">
				<div class="animated" data-animation="fadeInUp">
					<div class="col-md-12">
						<?php if ( have_posts() ) : ?>
								
							<?php while ( have_posts() ) : the_post(); ?>
								
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="img-banner-attachment">
										<?php
											echo wp_get_attachment_image( get_the_ID(), 'full' );
										?>
									</div>
									<div class="blog-date">
										<span class="icon-image"></span>
										<?php sama_output_html5_time_format(); ?>
									</div>
									<div class="blog-title">
										<div class="title-blog-name">
											<h1><?php the_title(); ?></h1>
										</div>
										<span class="divider-blog">
											<span></span>
										</span>
										<div class="breadcrumb-blog">
											<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <a href=""><?php the_author_posts_link(); ?></a>
											<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
										</div>
								    </div>
								    <div class="blog-desc-single">
										<?php if ( has_excerpt() ) : ?>
											<div class="entry-caption">
												<?php the_excerpt(); ?>
											</div><!-- .entry-caption -->
										<?php endif; ?>
										<?php 
											the_content();
											
											wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'samathemes' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
											) );
										?>
										<nav id="image-navigation" class="navigation image-navigation">
											<div class="nav-links">
												<span class="pull-left nav-previous"><?php previous_image_link( false, '<i class="fa fa-angle-left"></i> '. __( 'Previous Image', 'samathemes' ) ); ?></span>
												<span class="pull-right nav-next"><?php next_image_link( false, __( 'Next Image', 'samathemes' ). ' <i class="fa fa-angle-right"></i>' ); ?></span>
											</div><!-- .nav-links -->
										</nav><!-- .image-navigation -->
										<?php
											if ( $sama_options['single_display_share_icon'] == 'yes' ) {
												get_template_part('blog-templates/share-icon');
											}
										?>
										
								    </div>
									<footer class="entry-footer">
										<?php edit_post_link( __( 'Edit', 'samathemes' ), '<span class="edit-link">', '</span>' ); ?>
									</footer><!-- .entry-footer -->
								</article>
								<?php 
									if ( comments_open() || get_comments_number() ) {
										comments_template();
									}
								?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>	
	<!-- # Content End #  -->
<?php get_footer(); ?>