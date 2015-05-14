<?php

/**
 * WooThemes Projects Template Functions
 *
 * @package WordPress
 * @subpackage rozana
 * @since rozana 1.0
 */
 
get_header(); ?>

<?php
	global $sama_options;
	$portfolio_type = ( isset( $sama_options['portfolio_type'] ) ) ? $sama_options['portfolio_type'] : 'portfolio_fullwidth_without_text';
?>
<?php if ( have_posts() ) : ?>
<?php 
	if( ! is_singular ('project') ) {
	
		$projects_page_id   	= projects_get_page_id( 'projects' );
		if( ! empty( $projects_page_id ) && $projects_page_id != -1 ) {
			$extra_css = $data_stellar = '';
			$enable_custom_bg 	= get_post_meta( $projects_page_id, '_sama_enable_custom_header', true );
			$subtitle		  	= get_post_meta( $projects_page_id, '_sama_sub_title', true );	
			$bg_image_id 		= get_post_meta( $projects_page_id, '_sama_page_bg', true );
			if( $enable_custom_bg && ! empty ( $bg_image_id ) ) {
				$bg_animation = get_post_meta( $projects_page_id, '_sama_bg_animation', true );
				if( $bg_animation == 'parallax' ) {
					$data_stellar = ' data-stellar-background-ratio="0.5"';
				} elseif( $bg_animation == 'movement' ) {
					$extra_css = ' move-bg';
				}
?>
					<section class="fullwidth-banner<?php echo esc_attr( $extra_css ); ?>"<?php echo esc_attr( $data_stellar ); ?>>
						<div class="transparent-bg">
							<div class="center-content container text-center">
								<div class="row">
									<div class="col-md-12">
										<?php if( is_project_taxonomy() ) { ?>
											<h1 class="main-title"><?php projects_page_title(); ?></h1>
											<?php
												if ( is_tax( array( 'project-category', 'project-tag' ) ) && get_query_var( 'paged' ) == 0 ) {
													$description = strip_tags( term_description() );
													if ( $description ) {
														echo '<h4 class="sub-title">' . esc_attr( $description ) . '</h4>';
													}
												}
											?>
										<?php } else { ?>
											<h1 class="main-title"><?php _e('portfolio', 'samathemes'); ?></h1>
											<?php if( ! empty( $subtitle ) ) { ?>
												<h4 class="sub-title"><?php echo esc_attr( $subtitle ); ?></h4>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</section>
			<?php } else { ?>
					<section class="shortcodes-banner">
						<div class="transparent-bg">
							<div class="container text-center">
								<div class="row">
									<div class="col-md-12">
										<?php if( is_project_taxonomy() ) { ?>
											<h1 class="main-title"><?php projects_page_title(); ?></h1>
											<?php
												if ( is_tax( array( 'project-category', 'project-tag' ) ) && get_query_var( 'paged' ) == 0 ) {
													$description = strip_tags( term_description() );
													if ( $description ) {
														echo '<h4 class="sub-title">' . esc_attr( $description ) . '</h4>';
													}
												}
											?>
										<?php } else { ?>
											<h1 class="main-title"><?php _e('portfolio', 'samathemes'); ?></h1>
											<?php if( ! empty( $subtitle ) ) { ?>
												<h4 class="sub-title"><?php echo esc_attr( $subtitle ); ?></h4>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</section>
			<?php } ?>
		<?php } else {  ?>
				<section class="shortcodes-banner">
					<div class="transparent-bg">
						<div class="container text-center">
							<div class="row">
								<div class="col-md-12">
									<?php if( is_project_taxonomy() ) { ?>
										<h1 class="main-title"><?php projects_page_title(); ?></h1>
										<?php
											if ( is_tax( array( 'project-category', 'project-tag' ) ) && get_query_var( 'paged' ) == 0 ) {
												$description = strip_tags( term_description() );
												if ( $description ) {
													echo '<h4 class="sub-title">' . esc_attr( $description ) . '</h4>';
												}
											}
										?>
									<?php } else { ?>
										<h1 class="main-title"><?php _e('portfolio', 'samathemes'); ?></h1>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</section>
		<?php } ?>
		<section class="theme-color pad-top-bottom">
			<?php if ( $portfolio_type != 'portfolio_fullwidth_without_text' && $portfolio_type != 'portfolio_fullwidth_with_text' ) { ?>
				<div class="container">
			<?php } ?>
					<div class="row">
						
						<?php
							if( $portfolio_type == 'portfolio_fullwidth_without_text' ) {
								get_template_part('portfolio-templates/portfolio-fullwidth-without-text');
							} elseif( $portfolio_type == 'portfolio_fullwidth_with_text' ) {
								get_template_part('portfolio-templates/portfolio-fullwidth-with-text');
							} elseif( $portfolio_type == 'portfolio_gird_two_column_withtext' ) {
								get_template_part('portfolio-templates/portfolio-gird-two-column-with-text');
							} elseif( $portfolio_type == 'portfolio_gird_two_column_withouttext' ) {
								get_template_part('portfolio-templates/portfolio-gird-two-column-without-text');
							} elseif( $portfolio_type == 'portfolio_gird_three_column_withtext' ) {
								get_template_part('portfolio-templates/portfolio-gird-three-column-with-text');
							} elseif( $portfolio_type == 'portfolio_gird_three_column_withouttext' ) {
								get_template_part('portfolio-templates/portfolio-gird-three-column-without-text');
							} elseif( $portfolio_type == 'portfolio_gird_four_column_withtext' ) {
								get_template_part('portfolio-templates/portfolio-gird-four-column-with-text');
							} elseif( $portfolio_type == 'portfolio_gird_four_column_withouttext' ) {
								get_template_part('portfolio-templates/portfolio-gird-four-column-without-text');
							}
						?>
						
					</div>
			<?php if ( $portfolio_type != 'portfolio_fullwidth_without_text' && $portfolio_type != 'portfolio_fullwidth_with_text' ) { ?>
				</div>
			<?php } ?>
		</section>
<?php 
	} else {
		// Single portoflio page
		get_template_part('portfolio-templates/portfolio-single');
		get_template_part('portfolio-templates/portfolio-recent');
		do_action('sama_after_single_portfolio_recent');
	}
?>
<?php else : ?>
	<?php get_template_part( 'portfolio-templates/portfolio-none' ); ?>
<?php endif; ?>
<?php get_footer(); ?>