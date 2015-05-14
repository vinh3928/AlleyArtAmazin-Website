<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
	<section class="shortcodes-banner">
		<div class="transparent-bg">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-12">
						<h1 class="main-title"><?php _e( 'PAGE NOT FOUND', 'samathemes' ); ?></h1>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="theme-color error-404 not-found">
		<div class="container text-center pad-top-bottom">
			<div class="animated" data-animation="fadeInUp"> 
				<div class="row">
					<div class="col-md-12">
						<div class="page-content">
							<div class="blog-desc-single error-content">
								<h2>Are you lost</h2>
								<h2>somewhere?</h2>
								<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'samathemes' ); ?></p>
								<div  class="col-md-6 col-md-offset-3">
									<?php get_search_form(); ?>
									<a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>" class="btn-icon"><i class="fa fa-home"></i><?php _e('Back to home', 'samathemes'); ?></a>
								</div>
							</div>
						</div><!-- .page-content -->
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>