<?php
/**
 * The template part for displaying a message that projects cannot be found
 *
 *
 * @package WordPress
 * @subpackage Rozana
 * @since Rozana 1.0
 */
?>
<section class="shortcodes-banner">
	<div class="transparent-bg">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h1 class="main-title"><?php _e( 'Nothing Found', 'samathemes' ); ?></h1>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="theme-color pad-top-bottom text-center portofolio-none">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<article class="post post-0">
				   <div class="blog-desc-single">
						<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

							<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'samathemes' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

						<?php elseif ( is_search() ) : ?>

							<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'samathemes' ); ?></p>
							<?php get_search_form(); ?>

						<?php else : ?>

							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'samathemes' ); ?></p>
							<?php get_search_form(); ?>

						<?php endif; ?>
						<p><a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>" class="btn-icon"><i class="fa fa-home"></i><?php _e('Back to home', 'samathemes'); ?></a></p>
				   </div>
				</article>
			</div>
		</div>
	</div>
</section>