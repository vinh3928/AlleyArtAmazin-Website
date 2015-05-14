<!-- About Author -->
<div class="about-author">
	<p>
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'sama_author_bio_avatar_size', 100 )); ?>
		<span>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'samathemes' ), get_the_author() ); ?>" rel="author">
				<?php the_author(); ?>
			</a>
		</span>
		<?php the_author_meta( 'description' ); ?>
	</p>
</div>
<!-- End # About Author -->