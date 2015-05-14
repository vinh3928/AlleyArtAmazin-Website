<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <div class="blog-desc-single">
		<?php 
			the_content();
			
			wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'samathemes' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			) );
			
			edit_post_link( __( 'Edit', 'samathemes' ), '<span class="edit-link">', '</span>' );
		?>
   </div>
</article>