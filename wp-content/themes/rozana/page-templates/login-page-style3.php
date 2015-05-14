<?php
/**
 * Template Name: Login Page Style 3
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
			<section class="full-bg login-background full-background login-form-style3">
				<div class="black-transparent-fullscreen<?php echo esc_attr( $css_transparent ); ?>">
						<div class="login_page_2">
							<div class="container pad-top-20 text-center">
								<div class="row">
									<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
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
	
	
	</section>

<?php wp_footer(); ?>
</body>
</html>