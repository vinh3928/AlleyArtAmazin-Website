<?php
/*
 * Tabs Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Tabs::register_this_widget');

class Sama_Widget_Tabs extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_blog_tab',
				'description' => __( 'A tabbed Widgets that display popular posts by comments, recent posts, recent comments and tags.', 'samathemes')
		);
		
		parent::__construct('widget_blog_tab', 'SAMA :: '. __('Tabs', 'samathemes'), $widget_ops);
		
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
		
		$title_popular      = apply_filters( 'widget_title', $instance['title_popular'] );
		$title_recent       = apply_filters( 'widget_title', $instance['title_recent'] );
		//$title_comments     = apply_filters( 'widget_title', $instance['title_comments'] );
		$title_tags         = apply_filters( 'widget_title', $instance['title_tags'] );
		
		echo $before_widget;
		?>
		<div class="tabed-widget animated" data-animation="fadeInUp">
			<ul class="nav nav-tabs3" id="myTab">
				<li class="active animated" data-animation="fadeInUp" data-animation-delay="200">
					<a href="#tab1" title="<?php echo esc_attr( $title_popular ); ?>"><?php echo esc_attr( $title_popular ); ?></a>
                </li>
                <li class="animated" data-animation="fadeInUp" data-animation-delay="400">                           
                    <a href="#tab2" title="<?php echo esc_attr( $title_recent ); ?>"><?php echo esc_attr( $title_recent ); ?></a>
                </li>
			</ul>
			
			<div class="tab-content tab-content3">
				<div class="tab-pane popular-post active" id="tab1">
					<ul>
						<?php
							$query_popular 	= new WP_Query( array( 'orderby' => 'comment_count', 'posts_per_page' => 4, 'ignore_sticky_posts' => -1 ) );
							while ( $query_popular->have_posts() ) : $query_popular->the_post();
						?>
							<li>
								<a class="block-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
								<span class="icon-calendar5"></span> <?php echo get_the_date('F j, Y'); ?>&nbsp;&nbsp;
								<span class="icon-comments"></span> <?php comments_popup_link('0', '1', '%'); ?>
							</li>
						<?php endwhile; wp_reset_query(); ?>
					
					</ul>
				</div>
				<div class="tab-pane recent-post" id="tab2">
					<ul>
					<?php
						$query_recent 	= new WP_Query( array( 'orderby' => 'date', 'posts_per_page' => 4, 'ignore_sticky_posts' => -1 ) );
						while ( $query_recent->have_posts() ) : $query_recent->the_post();
					?>
						<li>
							<a class="block-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
							<span class="icon-calendar5"></span> <?php echo get_the_date('F j, Y'); ?>&nbsp;&nbsp;
							<span class="icon-comments"></span> <?php comments_popup_link('0', '1', '%'); ?>
						</li>
					<?php endwhile; wp_reset_query(); ?>
					</ul>
				</div>
			</div>
		</div>
		
	<?php 
	
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
		
		$instance['title_popular']     = esc_attr($new_instance['title_popular']);
		$instance['title_recent']      = esc_attr($new_instance['title_recent']);
		//$instance['title_comments']    = esc_attr($new_instance['title_comments']);
		//$instance['title_tags']        = esc_attr($new_instance['title_tags']);

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
	
		$defaults = array(  'title_popular'  => __('Popular', 'samathemes'), 
							'title_recent' 	 => __('Recent', 'samathemes'),
							//'title_comments' => __('Comments', 'samathemes'),
							//'title_tags' 	 => __('Tags', 'samathemes')
						);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('title_popular'); ?>"><?php _e( 'Tab 1 Title:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title_popular'); ?>" id="<?php echo $this->get_field_id('title_popular'); ?>" value="<?php echo esc_attr($instance['title_popular']); ?>" size="20" /></p>
		
		<p><label for="<?php echo $this->get_field_id('title_recent'); ?>"><?php _e( 'Tab 2 Title:', 'samathemes'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title_recent'); ?>" id="<?php echo $this->get_field_id('title_recent'); ?>" value="<?php echo esc_attr($instance['title_recent']); ?>" size="20" /></p>		
						
	<?php
	}

} // End of class