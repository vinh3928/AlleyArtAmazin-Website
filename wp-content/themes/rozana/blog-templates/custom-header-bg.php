<?php
	$page_for_posts = get_option( 'page_for_posts' );
	if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
	
		$extra_css = $data_stellar = '';
		$enable_custom_bg 	= get_post_meta( $page_for_posts, '_sama_enable_custom_header', true );
		$subtitle		  	= get_post_meta( $page_for_posts, '_sama_sub_title', true );	
		$bg_image_id 		= get_post_meta( $page_for_posts, '_sama_page_bg', true );
		if( $enable_custom_bg && ! empty ( $bg_image_id ) ) {
			$bg_animation = get_post_meta( $page_for_posts, '_sama_bg_animation', true );
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
								<?php if( is_home() ) { ?>
									<h1 class="main-title"><?php _e('Blog','samathemes'); ?></h1>
									<h4 class="sub-title"><?php echo esc_attr($subtitle); ?></h4>
								<?php } elseif( is_search() ) { ?>
									<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
									<h1 class="sub-title"><?php printf( __( 'Search Results for: %s', 'samathemes' ), get_search_query() ); ?></h1>
								<?php } elseif( is_author() ) { ?>
									<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
									<h1 class="sub-title"><?php the_archive_title(); ?></h1>
								<?php } else { ?>
									<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
									<h1 class="sub-title"><?php the_archive_title(); ?></h1>
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
								<?php if( is_home() ) { ?>
									<h1 class="main-title"><?php _e('Blog','samathemes'); ?></h1>
									<h4 class="sub-title"><?php echo esc_attr($subtitle); ?></h4>
								<?php } elseif( is_search() ) { ?>
									<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
									<h1 class="sub-title"><?php printf( __( 'Search Results for: %s', 'samathemes' ), get_search_query() ); ?></h1>
								<?php } elseif( is_author() ) { ?>
									<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
									<h1 class="sub-title"><?php the_archive_title(); ?></h1>
								<?php } else { ?>
									<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
									<h1 class="sub-title"><?php the_archive_title(); ?></h1>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
<?php  
	} else { ?>
		<section class="shortcodes-banner">
			<div class="transparent-bg">
				<div class="container text-center">
					<div class="row">
						<div class="col-md-12">
							<?php if( is_home() ) { ?>
								<h1 class="main-title"><?php _e('Blog','samathemes'); ?></h1>
							<?php } elseif( is_search() ) { ?>
								<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
								<h1 class="sub-title"><?php printf( __( 'Search Results for: %s', 'samathemes' ), get_search_query() ); ?></h1>
							<?php } elseif( is_author() ) { ?>
								<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
								<h1 class="sub-title"><?php the_archive_title(); ?></h1>
							<?php } else { ?>
								<h4 class="main-title"><?php _e('Blog','samathemes'); ?></h4>
								<h1 class="sub-title"><?php the_archive_title(); ?></h1>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php } ?>