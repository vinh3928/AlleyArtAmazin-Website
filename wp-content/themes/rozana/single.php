<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage rozana
 * @since rozana 1.0
 */
 
get_header(); ?>

	<!-- # Content Start Here #  -->
	<!-- # Banner #  -->
	<section class="shortcodes-banner">
		<div class="transparent-bg">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-12">
						<h4 class="main-title"><?php _e( 'Blog', 'samathemes') ?></h4>
					</div>
				</div>
			</div>
		</div>
	</section>               
	<!-- # End Banner #  -->

	<section class="theme-color pad-top-bottom">	
		<div class="container">
			<div class="row">
				<div class="animated" data-animation="fadeInUp">
					<?php
						$post_layout = get_post_meta( get_the_ID(), '_sama_page_layout', true );
						if ( $post_layout == 'leftsidebar' ) {
							get_sidebar();
						} elseif( $post_layout == '2sidebar' ) {
							get_sidebar('second');
						}
						
						if ( $post_layout == 'fullwidth' ) {
							echo '<div class="col-md-12">';
						} elseif( $post_layout == '2sidebar' ) {
							echo '<div class="col-md-6 col-sm-6">';
						} else {
							echo '<div class="col-md-9 col-sm-8">';
						}
					?>
					<?php if ( have_posts() ) : ?>
							
						<?php while ( have_posts() ) : the_post(); ?>
							
							<?php get_template_part( 'content', get_post_format() ); ?>
							
							<?php 
								if( isset( $sama_options['single_display_author_bio'] ) && $sama_options['single_display_author_bio'] ) {
									get_template_part('blog-templates/about-author');
								}
							?>
							
							<?php if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
							?>
					
						<?php endwhile; ?>
							
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
					
					<?php 
						echo '</div>';
						if ( $post_layout == 'rightsidebar' || $post_layout == '2sidebar' || empty( $post_layout ) ) {
							get_sidebar();
						}
					?>
				</div>
			</div>
		</div>
	</section>	
	<!-- # Content End #  -->
<?php get_footer(); ?>