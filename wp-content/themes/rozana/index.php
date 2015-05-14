<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage rozana
 * @since rozana 1.0
 */
 
get_header(); ?>
<?php 
	global $sama_options;
	$blog_type 				= $sama_options['blog_type'];
	$display_blog_grid_cat 	= $sama_options['display_blog_grid_cat'];
?>
	<?php get_template_part( 'blog-templates/custom-header-bg'); ?>

	<?php
		$cssclass = 'theme-color pad-top-bottom';
		if( $blog_type == 'masonry' ) {
			$cssclass = 'grey-bg pad-top-bottom';
		}
	?>
		<section class="<?php echo esc_attr( $cssclass ); ?>">
			<?php
				$cssclass = '';
				if ( $blog_type == 'grid' && ! is_single() ) {
					$cssclass = ' blog-gird-style';
				} elseif ( $blog_type == 'list' && ! is_single() ) {
					$cssclass = ' blog-list-style';
				} elseif ( $blog_type == 'masonry' && ! is_single() ) {
					$cssclass = ' blog-masonry-style';
				}
			?>
			
			<div class="container<?php echo esc_attr( $cssclass ); ?>">
				<div class="row">

					<?php if ( have_posts() ) : ?>
					
						<?php if ( ( $blog_type == 'grid' && ! is_category() ) && $display_blog_grid_cat  ) { ?>
								<!-- # Tabs # -->
								<div class="col-md-12 portfolioFilter text-center clearfix animated" data-animation="fadeInDown">
									<ul>
										<li><a href="#" data-filter="*" class="current"><?php _e('All Categories', 'samathemes'); ?></a></li>
										<?php
											$args = array(
												'type'                     => 'post',
												'child_of'                 => 0,
												'orderby'                  => 'name',
												'order'                    => 'ASC',
												'hide_empty'               => 1,
												'hierarchical'             => 0,
												'taxonomy'                 => 'category',
											);
											$categories = get_categories( $args );
											foreach ( $categories as $category ) {
										?>
											<li><a href="#" data-filter=".<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name ); ?></a></li>
										<?php		
											}
										?>
									</ul>
								</div>
								<!-- End # Tabs # -->
								<div class="portfolioContainer">
								
							<?php } elseif ( $blog_type == 'masonry' ) { ?>
									<div class="col-md-12">
										<div class="isotope js-isotope">
							<?php } elseif ( $blog_type == 'bigthumbnails' || $blog_type == 'wpdefalutfullwidth' ) { ?>
									<div class="col-md-12">
							<?php } elseif ( $blog_type == 'bigthumbwithsidebar' || $blog_type == 'wpdefaultwithsidebar' ) { ?>
									<div class="col-md-9 col-sm-8">
							<?php } ?>
							
						<?php while ( have_posts() ) : the_post(); ?>
								
									<?php get_template_part( 'content', get_post_format() ); ?>
							
						<?php endwhile; ?>
								
							<?php 
								// Previous/next post navigation.
								if ( $blog_type != 'grid' && $blog_type != 'masonry' ) {
									sama_paging_nav();
								}
							?>
							<?php if ( ( $blog_type == 'grid' && ! is_category() ) && $display_blog_grid_cat ) { ?>
								</div>
							<?php } 
							if( $blog_type == 'grid' ) { ?>
								<?php sama_paging_nav(); ?>
							<?php } elseif( $blog_type == 'masonry' ) { ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php sama_paging_nav(); ?>
								</div>
							<?php } elseif ( $blog_type == 'bigthumbnails'  || $blog_type == 'wpdefalutfullwidth' ) { ?>
								</div>
							<?php } elseif ( $blog_type == 'bigthumbwithsidebar' || $blog_type == 'wpdefaultwithsidebar' ) { ?>
								</div>
							<?php } ?>
							
						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
					
					<?php if ( $blog_type == 'bigthumbwithsidebar' || $blog_type == 'wpdefaultwithsidebar' ) { ?>
						<?php get_sidebar(); ?>
					<?php } ?>
				
				</div>
			</div>
		</section>
	<!-- # Content End #  -->
<?php get_footer(); ?>