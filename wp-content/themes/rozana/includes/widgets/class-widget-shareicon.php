<?php
/*
 * Social Icons
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Socialicon::register_this_widget');

class Sama_Widget_Socialicon extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_social_icon',
				'description' => __( 'Social Icon.', 'samathemes')
		);
		
		parent::__construct('widget_social_icon', 'SAMA :: '. __('Social Icon', 'samathemes'), $widget_ops);
		
	}
	
	static function register_this_widget () {
		register_widget(__class__);
	}
	
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget ($args, $instance) {
	
		extract($args);
		
		$title      = apply_filters( 'widget_title', $instance['title'] );
		$output		= '';
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		
		if ( ! empty( $instance['facebook'] ) ) {
			$output .= '<li><a class="social-facebook" href="'. esc_attr( $instance['facebook'] ).'"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( ! empty( $instance['twitter'] ) ) {
			$output .= '<li><a class="social-twitter" href="'. esc_attr( $instance['twitter'] ).'"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( ! empty( $instance['dribbble'] ) ) {
			$output .= '<li><a class="social-dribbble" href="'. esc_attr( $instance['dribbble'] ) .'"><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( ! empty( $instance['linkedin'] ) ) {
			$output .= '<li><a class="social-linkedin" href="'. esc_attr( $instance['linkedin'] ).'"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( ! empty( $instance['gplus'] ) ) {
			$output .= '<li><a class="social-gplus" href="'. esc_attr( $instance['gplus'] ) .'"><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( ! empty( $instance['youtube'] ) ) {
			$output .= '<li><a class="social-youtube" href="'. esc_attr( $instance['youtube'] ).'"><i class="fa fa-youtube"></i></a></li>';
		}
		if ( ! empty( $instance['rss'] ) ) {
			$output .= '<li><a class="social-rss" href="'. esc_attr( $instance['rss'] ).'"><i class="fa fa-rss"></i></a></li>';
		}
		
		echo '<ul class="social-network-footer">'. $output .'</ul>';
		echo $after_widget;
	}
	
	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update ($new_instance, $old_instance) {
		$instance 	= $old_instance;
		$instance['title']             	= esc_attr($new_instance['title']);
		$instance['facebook']     	   	= esc_url($new_instance['facebook']);
		$instance['twitter']		   	= esc_url($new_instance['twitter']);
		$instance['dribbble']          	= esc_url($new_instance['dribbble']);
		$instance['linkedin']          	= esc_url($new_instance['linkedin']);
		$instance['gplus']			   	= esc_url($new_instance['gplus']);
		$instance['youtube']          	= esc_url($new_instance['youtube']);
		$instance['rss']          		= esc_url($new_instance['rss']);
		return $instance;		
	}
	
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form ($instance) {
	
		$defaults = array(  
			'title'  		=> '',
			'facebook'		=> '',
			'twitter' 		=> '',
			'dribbble'		=> '',
			'linkedin' 		=> '',
			'gplus'			=> '',
			'youtube'		=> '',
			'rss'			=> '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'title:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e( 'Facebook URL:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('facebook'); ?>" id="<?php echo $this->get_field_id('facebook'); ?>" value="<?php echo esc_attr($instance['facebook']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e( 'Twitter URL:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('twitter'); ?>" id="<?php echo $this->get_field_id('twitter'); ?>" value="<?php echo esc_attr($instance['twitter']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php _e( 'Dribbble URL:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('dribbble'); ?>" id="<?php echo $this->get_field_id('dribbble'); ?>" value="<?php echo esc_attr($instance['dribbble']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e( 'Linkedin URL:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('linkedin'); ?>" id="<?php echo $this->get_field_id('linkedin'); ?>" value="<?php echo esc_attr($instance['linkedin']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e( 'Google plus URL:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('gplus'); ?>" id="<?php echo $this->get_field_id('gplus'); ?>" value="<?php echo esc_attr($instance['gplus']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e( 'Youtube URL:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('youtube'); ?>" id="<?php echo $this->get_field_id('youtube'); ?>" value="<?php echo esc_attr($instance['youtube']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e( 'RSS URL:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('rss'); ?>" id="<?php echo $this->get_field_id('rss'); ?>" value="<?php echo esc_attr($instance['rss']); ?>" size="20" /></p>
	<?php
	}

} // End of class