<?php
/**
 * Template Name: Register Page Style 2
 *
 * @package WordPress
 * @subpackage rozana
 * @since rozana 1.0
 */
 
get_header(); ?>

		<?php if ( have_posts() ) : ?>
							
			<?php while ( have_posts() ) : the_post(); ?>
			<?php
				$transparent 		= get_post_meta( get_the_ID(), '_sama_slider_transparent', true ) ;
				$css_transparent 	= '';
				if( ! empty( $transparent ) ) {
					$css_transparent	= ' transparent-bg '. $transparent ;
				}
			?>
			<section id="home-header" class="full-bg login-background full-background">
				<div class="black-transparent-fullscreen<?php echo esc_attr( $css_transparent ); ?>">
						<div class="sign-page-onepage">
							<div class="container text-center">
								<div class="row">
									<div class="col-md-12">
										<?php the_content(); ?>
									</div>
								</div>
							</div>
						</div>
				</div>
			</section>  
				                 
            <!-- # End Full Background #  --> 
			<?php endwhile; ?>
				
		<?php else : ?>
			
		<?php endif; ?>
	<!-- # Content End #  -->
<?php get_footer(); ?>