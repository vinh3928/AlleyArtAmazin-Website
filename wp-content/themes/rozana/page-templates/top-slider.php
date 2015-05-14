<?php
$page_id = '';
$allowed_tags = sama_allowed_html();
if( is_front_page() ) {
	$page_id = get_option('page_on_front');
} else {
	$page_id = get_the_ID();
}
$slider_type 		= get_post_meta( $page_id, '_sama_slider_type', true );
$slider_content		= do_shortcode( get_post_meta( $page_id, '_sama_slider_content', true ) );
$css_transparent	= 'transparent-bg';
$transparent		= get_post_meta( $page_id, '_sama_slider_transparent', true ) ;
if( ! empty( $transparent ) ) {
	$css_transparent	= 'transparent-bg '. $transparent ;
}
if( ! empty ( $slider_type ) || $slider_type != 'no' ) {
	if( $slider_type == 'supersized' ) {
?>	
		<section id="home-header" class="top-header-fullscreen fullwidth-slider_4 supersized">
			<!--Control Bar-->
			<div id="controls-wrapper" class="load-item">
				<div id="controls">
					<a id="play-button"><img id="pauseplay" src="<?php echo esc_url( SAMA_THEME_URI . '/img/pause.png' ); ?>" alt=""></a>
					<!--Slide counter-->
					<div id="slidecounter">
						<span class="slidenumber"></span> / <span class="totalslides"></span>
					</div>
					<!--Thumb Tray button-->
					<!--Navigation-->
					<ul id="slide-list"></ul>			
				</div>
			</div>
			<div class="<?php echo $css_transparent; ?>">
				<!-- # Contet Text #  -->
				 <div class="container text-center">
					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	} elseif( $slider_type == 'zooming' ) {
?>
		<section id="home-header" class="top-header-fullscreen fullwidth-slider_3">
			<div class="<?php echo $css_transparent; ?>">
				<!-- # Contet Text #  -->
				 <div class="container text-center">
					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
						</div>
					</div>
				</div>
				<!-- # End / Contet Text #  -->
			</div>
		</section>
<?php
	} elseif( $slider_type == 'fullscreenslidercbg' || $slider_type == 'fullwidthslidercbg' ) { // fullscreenslidercbg  fullwidthslidercbg
		$bg_image_ids = get_post_meta( $page_id, '_sama_slider_images', false );
		$images = '';
		foreach ( $bg_image_ids as $image ) {
			$image = preg_replace( '/[^\d]/', '', $image );
			$image 		 = wp_get_attachment_image_src($image, 'full');
			$image_url   = esc_url( $image[0] );
			$images[] =  $image_url;
		}
?>
		<?php if( $slider_type == 'fullscreenslidercbg' ) { ?>
			<section id="home-header" class="top-header-fullscreen fullwidth-slider_3">
		<?php } else { ?>
			<section id="fullwidthslider2" class="fullwidth-slider_2">
		<?php } ?>
			<div class="<?php echo $css_transparent; ?>">
				<!-- # SlideShow #  -->
			  <ul id="cbp-bislideshow" class="cbp-bislideshow">
					<?php foreach( $images as $image ) { ?>
						<li><img src="<?php echo esc_url($image); ?>"></li>
					<?php } ?>
				</ul>
				<!-- # End / SlideShow #  -->
				
				<!-- # Contet Text #  -->
				<?php if( $slider_type == 'fullscreenslidercbg' ) { ?>
					<div class="container text-center">
				<?php } else { ?>
					<div class="container center-content text-center">
				<?php } ?>
					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
						</div>
					</div>
				</div>
				<!-- # End / Contet Text #  -->
			</div>
		</section>
<?php
	} elseif( $slider_type == 'fullscreenbg' ) {
?>
		<section id="home-header" class="top-header-fullscreen full-background" data-stellar-background-ratio="0.5">
			<div class="<?php echo $css_transparent; ?>">
				 <div class="container text-center">
					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
						</div>
					</div>
				</div>
			</div>
        </section>      

<?php
	} elseif( $slider_type == 'patterndark' || $slider_type == 'patternlight' ) {
?>
		<section id="home-header" class="top-header-fullscreen full-background-pattern">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-12">
						<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
					</div>
				</div>
			</div>
		</section>               
<?php
	} elseif( $slider_type == 'movementbg' ) {
?>
		<section id="home-header" class="top-header-fullscreen full-background move-bg">
			<div class="<?php echo $css_transparent; ?>">
				 <div class="container text-center">
					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>                 
<?php
	} elseif( $slider_type == 'html5videoslider' ) {
			$bg_image_ids = get_post_meta( $page_id, '_sama_bgvideo', false );
			$image_url = '';
			foreach ( $bg_image_ids as $image ) {
				$image = preg_replace( '/[^\d]/', '', $image );
				$image 		 = wp_get_attachment_image_src($image, 'full');
				if( ! empty( $image[0] )  ) {
					$image_url   = esc_url( $image[0] );
					break;
				}
			}
			$webm = esc_url( get_post_meta( $page_id, '_sama_webm', true ) );
			$mp4  = esc_url( get_post_meta( $page_id, '_sama_mp4', true ) );
			$ogv  = esc_url( get_post_meta( $page_id, '_sama_ogv', true ) );
?>
		<section class="video-wrapper" data-vide-bg="<?php echo 'mp4: '. esc_url( $mp4 ). ',webm: '. esc_url( $webm ) .',ogv: '. esc_url( $ogv ) .',poster: '. esc_url( $image_url) ; ?>">
			<section id="home-header" class="top-header-fullscreen">
				<div class="<?php echo $css_transparent; ?>">
					 <div class="container text-center">
						<div class="row">
							<div class="col-md-12">
								<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>   
<?php
	} elseif( $slider_type == 'youtubevideobg' ) {
			$youtube = esc_url(get_post_meta( $page_id, '_sama_youtube', true ));
?>
			<section>
				<div id="bgndVideo" class="player" data-property="{videoURL:'<?php echo esc_url( $youtube ); ?>',containment:'body',autoPlay:true, mute:true, startAt:0, opacity:1}"></div>
				<div id="home-header" class="top-header-fullscreen">
					<div class="<?php echo esc_attr( $css_transparent ); ?>">
						 <div class="container text-center">
							<div class="row">
								<div class="col-md-12">
									<?php echo wp_kses( $slider_content, $allowed_tags  ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php
	}
} 
?>
