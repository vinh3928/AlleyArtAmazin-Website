<?php
/**
 * Template Name: Full Width Page Builder With Title
 *
 * @package WordPress
 * @subpackage rozana
 * @since rozana 1.0
 */
 
get_header(); ?>

		<?php if ( have_posts() ) : ?>
							
			<?php while ( have_posts() ) : the_post(); ?>
				<!-- # Banner #  -->
				<?php get_template_part( 'page-templates/custom-header-bg'); ?>
				<!-- # End Banner #  -->
				
				<?php the_content(); ?>
									
		
			<?php endwhile; ?>
				
		<?php else : ?>
			
		<?php endif; ?>
	<!-- # Content End #  -->
<?php get_footer(); ?>