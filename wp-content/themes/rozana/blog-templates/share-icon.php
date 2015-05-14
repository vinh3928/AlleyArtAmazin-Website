<?php
	global $sama_options;
?>
<div class="post-share">
	<p class="share">
		<?php if( isset( $sama_options['single_share_facebook'] ) && $sama_options['single_share_facebook'] ) { ?>
			<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&#038;t=<?php echo esc_attr( str_replace(' ', '%20', get_the_title())); ?>" class="facebook-share"><span class="icon-facebook"></span> <?php _e('Share', 'samathemes'); ?></a>
		<?php } ?>
		<?php if( isset( $sama_options['single_share_twitter'] ) && $sama_options['single_share_twitter'] ) { ?>
		<a rel="nofollow" href="http://twitter.com/home?status=<?php echo esc_attr( str_replace(' ', '%20', get_the_title()) ); ?>%20<?php the_permalink(); ?>" class="twitter-share"><span class="icon-twitter"></span> <?php _e('Tweet', 'samathemes'); ?></a>
		<?php } ?>
		<?php if( isset( $sama_options['single_share_pinterest'] ) && $sama_options['single_share_pinterest'] ) { ?>
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			<a rel="nofollow" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( esc_url( get_permalink() ) ); ?>&#038;description=<?php echo urlencode( esc_attr( $post->post_title ) ); ?>&#038;media=<?php echo urlencode( esc_url( $full_image[0] ) ); ?>" class="pinterest-share"><span class="icon-pinterest"></span> <?php _e('Pin', 'samathemes'); ?></a>
		<?php } ?>
		<?php if( isset( $sama_options['single_share_gplus'] ) && $sama_options['single_share_gplus'] ) { ?>
			<a rel="nofollow" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"  class="google-share"><span class="icon-googleplus3"></span> <?php _e('Google+', 'samathemes'); ?></a>
		<?php } ?>
		<?php if( isset( $sama_options['single_share_linkedin'] ) && $sama_options['single_share_linkedin'] ) { ?>
			<a rel="nofollow" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&#038;title=<?php the_title(); ?>" class="linkedin-share"><span class="icon-linkedin3"></span> <?php _e('LinkedIn', 'samathemes'); ?></a>		
		<?php } ?>
	</p>
</div>
