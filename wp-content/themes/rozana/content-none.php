<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Rozana
 * @since Rozana 1.0
 */
?>
<article class="post post-0">
	<div class="blog-title">
		<div class="title-blog-name">
			<h1><?php _e( 'Nothing Found', 'samathemes' ); ?></h1>
		</div>
		<span class="divider-blog">
			<span></span>
		</span>
   </div>
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
		
   </div>
</article>