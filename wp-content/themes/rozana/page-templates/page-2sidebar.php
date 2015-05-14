<?php
/**
 * Template Name: Page With Two Sidebar
 *
 * @package WordPress
 * @subpackage rozana
 * @since rozana 1.0
 */
 
get_header(); ?>

<?php get_template_part( 'page-templates/custom-header-bg'); ?>                      
	<section class="theme-color pad-top-bottom">	
		<div class="container">
			<div class="row">
				<div class="animated" data-animation="fadeInUp">
					
					<?php get_sidebar('second'); ?>
					
					<div class="col-md-6 col-sm-6">

						<?php if ( have_posts() ) : ?>
							
							<?php while ( have_posts() ) : the_post(); ?>
							
								<?php get_template_part( 'content', 'page' ); ?>
														
								<?php 
									if ( comments_open() || get_comments_number() ) {
										comments_template();
									}
								?>
					
							<?php endwhile; ?>
							
						<?php else : ?>
						
							<?php get_template_part( 'content', 'none' ); ?>
							
						<?php endif; ?>
						
					</div>
					
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>	
	<!-- # Content End #  -->
<?php get_footer(); ?>