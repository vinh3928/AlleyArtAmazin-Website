<!-- # Sidebar # -->
<div id="leftsidebar" class="col-md-3 col-sm-4 sidebar widget-area span3" role="complementary">
	<?php 		
		if ( dynamic_sidebar('sidebar-2') ) {
		
		} else {
			the_widget('WP_Widget_Meta','', array(
				'before_widget' => '<aside id="%1$s" class="widget widget_meta %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<div class="titleHeader clearfix"><h3 class="widget-title">',
				'after_title' => '</h3></div>',
			));
		}
	?>
</div><!-- #secondary -->