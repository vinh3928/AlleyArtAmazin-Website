<?php
/*
 * Facebook Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Flickr_Feed::register_this_widget');

class Sama_Widget_Flickr_Feed extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_flickr_feed',
				'description' => __( 'Display recent flickr feed.', 'samathemes')
		);
		
		parent::__construct('widget_flickr_feed', 'SAMA :: '. __('Recent Flickr Feed', 'samathemes'), $widget_ops);
		
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
		
		$title          = apply_filters( 'widget_title', $instance['title'] );
		$flickrid       = esc_attr( $instance['flickrid'] );
		$num    		= absint( $instance['num'] );
		wp_enqueue_script('jflickrfeed');
		$params = '';
		
		$params['numbers']  = $num;
		$params['flickrid'] = $flickrid;
		wp_localize_script( 'jflickrfeed.init', 'flickr_data', $params );
		wp_enqueue_script( 'jflickrfeed.init' );
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo '<div class="bx_flicker"><ul id="basicuse" class="thumbs"></ul></div>';
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
		
		$instance 				 = $old_instance;
		$instance['title']       = esc_attr($new_instance['title']);
		$instance['flickrid']    = esc_attr($new_instance['flickrid']);
		$instance['num']         = absint( $new_instance['num'] );
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
					'flickrid'		=> '',
					'num' 			=> '9',
				);
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'samathemes'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickrid'); ?>"><?php _e( 'Flickr id:', 'samathemes'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('flickrid'); ?>" id="<?php echo $this->get_field_id('flickrid'); ?>" value="<?php echo esc_attr($instance['flickrid']); ?>" size="20" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>"><?php _e( 'Number of comments:', 'anthemes'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('num');?>" id="<?php echo $this->get_field_id('num');?>" value="<?php echo absint($instance['num']);?>" />
		</p>						
	<?php
	}

} // End of class