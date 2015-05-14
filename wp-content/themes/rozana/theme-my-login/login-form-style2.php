<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
	<h2><?php _e('Login', 'samathemes'); ?></h2>
	<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
		<?php $template->the_action_template_message( 'login' ); ?>
		<?php $template->the_errors(); ?>
		<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
				
				<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" placeholder="<?php _e('Email Address','samathemes'); ?>" />	
				
				<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" placeholder="<?php _e('Email Address','samathemes'); ?>" />

			<?php do_action( 'login_form' ); ?>

			<p class="forgetmenot text-left">
				<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
				<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me' ); ?></label>
			</p>
			<p class="submit">
				<input class="login-btn" type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In' ); ?>" />
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="login" />
			</p>
		</form>
		<div class="forget text-center">
			<?php $template->the_action_links( array( 'login' => false ) ); ?>
		</div>
	</div>
</div>