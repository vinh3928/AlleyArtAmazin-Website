<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="pad-top-40">
	<div class="login-bg">
		<h4><?php _e('Login', 'samathemes'); ?></h4>
		<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
			<?php $template->the_action_template_message( 'login' ); ?>
			<?php $template->the_errors(); ?>
			<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
					<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'samathemes' ); ?></label>
					<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />	
					<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'samathemes' ); ?></label>
					<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" />

				<?php do_action( 'login_form' ); ?>

				<p class="forgetmenot text-left">
					<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
					<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'samathemes' ); ?></label>
				</p>
				<p class="submit">
					<input class="login-btn" type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'samathemes' ); ?>" />
					<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
					<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
					<input type="hidden" name="action" value="login" />
				</p>
			</form>
			<div class="forget text-left">
				<?php $template->the_action_links( array( 'login' => false ) ); ?>
			</div>
		</div>
	</div>
</div>