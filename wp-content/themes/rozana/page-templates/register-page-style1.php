<?php
/**
 * Template Name: Register Page Style 1
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
				
				<section class="theme-color pad-top-bottom login-form login-form-style2">
					<div class="container">
						<div class="row">
							<?php the_content(); ?>
						</div>
					</div>
				</section>
				
			<?php endwhile; ?>
				
		<?php else : ?>
			
		<?php endif; ?>
	<!-- # Content End #  -->
<?php get_footer(); ?>