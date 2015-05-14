<?php
/**
 * Template Name: Full Width Page Builder
 *
 * @package WordPress
 * @subpackage Rozana
 * @since Rozana 1.0
 */
 
get_header(); ?>
			
		<?php if ( have_posts() ) : ?>
							
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'page-templates/top-slider'); ?>
				
				<?php the_content(); ?>
									
		
			<?php endwhile; ?>
				
		<?php else : ?>
			
		<?php endif; ?>
	<!-- # Content End #  -->
<?php get_footer(); ?>