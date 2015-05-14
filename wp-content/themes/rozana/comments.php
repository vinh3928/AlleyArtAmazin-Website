<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area comment-blog">

	<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
			printf( _n( 'One thought on &ldquo;[%2$s]&rdquo;', '[%1$s] thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'samathemes' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'samathemes' ); ?></h3>
		<div class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'samathemes' ) ); ?></div>
		<div class="nav-next pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'samathemes' ) ); ?></div>
		<div class="clearfix"></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ol id="comments-list" class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 80,
				'reply_text' => '<i class="fa fa-reply"></i>'
			) );
		?>
	</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'samathemes' ); ?></h3>
		<div class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'samathemes' ) ); ?></div>
		<div class="nav-next pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'samathemes' ) ); ?></div>
		<div class="clearfix"></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'samathemes' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>
	
	<?php
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$post_layout = get_post_meta( get_the_ID(), '_sama_page_layout', true );
		$css_field = '';
		$args = array(
			'class_submit'         => 'submit',
			'comment_notes_before' => '<div class="row no-margin">',
			'comment_notes_after' => '</div>',
			'comment_field' => '<div class="col-md-12 animated" data-animation="fadeInUp"><p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'samathemes' ) .
    '</label><textarea id="comment" name="comment" aria-required="true">' .
    '</textarea></p></div>',
			'must_log_in' => '<div class="col-md-12 animated" data-animation="fadeInUp"><p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'samathemes' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '</p></div>',
			'logged_in_as' => '<div class="col-md-12 animated" data-animation="fadeInUp"><p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'samathemes' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p></div>',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="col-md-4 animated" data-animation="fadeInUp"><p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'samathemes' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" placeholder="'.__('Your Name...*', 'samathemes').'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p></div>',
				'email' => '<div class="col-md-4 animated" data-animation="fadeInUp"><p class="comment-form-email"><label for="email">' . __( 'Email', 'samathemes' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" placeholder="'.__('E-Mail...*', 'samathemes').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p></div>',
				'url' => '<div class="col-md-4 animated" data-animation="fadeInUp"><p class="comment-form-url"><label for="url">' . __( 'Website', 'samathemes' ) . '</label>' . '<input id="url" placeholder="'.__('URL...', 'samathemes').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>',

				) ) );
	?>
	
	<?php comment_form($args); ?>

</div><!-- #comments -->
