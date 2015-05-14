<?php
	$extra_css = $data_stellar = '';
	$enable_custom_bg 	= get_post_meta( get_the_ID(), '_sama_enable_custom_header', true );
	$subtitle		  	= get_post_meta( get_the_ID(), '_sama_sub_title', true );	
	$bg_image_id 		= get_post_meta( get_the_ID(), '_sama_page_bg', true );
	if( $enable_custom_bg && ! empty ( $bg_image_id ) ) {
		$bg_animation = get_post_meta( get_the_ID(), '_sama_bg_animation', true );
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
							<h1><?php the_title(); ?></h1>
							<?php if( ! empty( $subtitle ) ) { ?>
								<h4><?php echo esc_attr( $subtitle ); ?></h4>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php	
	} else { ?>
<section class="shortcodes-banner">
	<div class="transparent-bg">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h1><?php the_title(); ?></h1>
					<?php if( ! empty( $subtitle ) ) { ?>
						<h4><?php echo esc_attr( $subtitle ); ?></h4>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>