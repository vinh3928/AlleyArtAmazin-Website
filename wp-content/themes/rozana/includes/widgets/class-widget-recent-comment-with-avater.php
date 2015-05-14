<?php
/*
 * Social Icons
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Recentcommentswithavatar::register_this_widget');

class Sama_Widget_Recentcommentswithavatar extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_recent_comments_with_avatar',
				'description' => __( 'Recent Comments With Avatar', 'samathemes')
		);
		
		parent::__construct('widget_recent_comments_with_avatar', 'SAMA :: '. __('Recent Comments With Avatar', 'samathemes'), $widget_ops);
		
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
		$num    		= absint( $instance['num'] );
		$output		= '';
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$comments = get_comments('status=approve&number='.$num);
		foreach ($comments as $comment) :
			
			$output .= '<li>
						<a href="'. get_permalink($comment->comment_post_ID). '#comment-'.$comment->comment_ID.'" title="'. $comment->comment_author. __('On:', 'samathemes') .get_the_title($comment->comment_post_ID). '">'. get_avatar( $comment->comment_author_email, 40).
						''. $comment->comment_author .' '. __('On:', 'samathemes') .' '. get_the_title($comment->comment_post_ID). '
						</a></li>'
		?>
	
	<?php
		endforeach;
		
		
		echo '<ul class="comment-footer">'. $output .'</ul>';
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
		$instance 			= $old_instance;
		$instance['title']  = esc_attr($new_instance['title']);
		$instance['num']    = absint( $new_instance['num'] );
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
			'num' 			=> '4',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
		
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'title:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>"><?php _e( 'Number of comments:', 'anthemes'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('num');?>" id="<?php echo $this->get_field_id('num');?>" value="<?php echo absint($instance['num']);?>" />
		</p>	
	<?php
	}

} // End of class