<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function sama_metaboxes( $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_sama_';
	
	// Layout metabox
	$meta_boxes[] = array(
		'id'         => 'video-url',
		'title'      => __('Media URL', 'samathemes'),
		'pages'      => array( 'post'), // Post type
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => 'Video URL',
				'id'      => $prefix . 'video_url',
				'type'    => 'url',
				'desc'  => __( 'Just link, not embed code, this field is used for oEmbed', 'samathemes' ),
			),
			array(
				'name'    => 'Sound URL',
				'id'      => $prefix . 'audio_url',
				'type'    => 'url',
				'desc'  => __( 'Just link, not embed code, this field is used for oEmbed', 'samathemes' ),
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'Layout-template',
		'title'      => __('Layout', 'samathemes'),
		'pages'      => array( 'post'), // Post type
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __( 'Layout', 'samathemes' ),
				'id'      => $prefix. 'page_layout',
				'type'    => 'select',
				'options' => array(
					'rightsidebar' 	=> __( 'Right Sidebar', 'samathemes' ),
					'fullwidth' 	=> __( 'Full Width', 'samathemes' ),
					'leftsidebar'	=> __( 'Left Sidebar', 'samathemes' ),
					'2sidebar'		=> __( 'Two Sidebar', 'samathemes' )
				),
				'multiple'    => false,
			),
		),
		
	);
	$meta_boxes[] = array(
		'id'         => 'header-template',
		'title'      => __('Page Header', 'samathemes'),
		'pages'      => array( 'page','project'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __( 'Enable Custom Header', 'samathemes' ),
				'id'      => $prefix. 'enable_custom_header',
				'type'    => 'checkbox',
				'options' => array(
					'yes' 	=> __( 'Enable custom header', 'samathemes' ),
				),
			),
			array(
				'name'    => __( 'Subtitle', 'samathemes' ),
				'id'      => $prefix. 'sub_title',
				'type'    => 'text',
			),
			array(
				'name'    => __( 'Upload image background', 'samathemes' ),
				'id'      => $prefix. 'page_bg',
				'type'    => 'file_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'    => __( 'Background animation', 'samathemes' ),
				'id'      => $prefix. 'bg_animation',
				'type'    => 'select',
				'options' => array(
					'no' 		=> __( 'No', 'samathemes' ),
					'parallax' 	=> __( 'Parallax', 'samathemes' ),
					'movement'		=> __( 'movement', 'samathemes' ),
				),
				'multiple'    => false,
			),
			
		),
		
	);
	
	$meta_boxes[] = array(
		'id'         => 'slider-template',
		'title'      => __('Top Slider', 'samathemes'),
		'pages'      => array( 'page'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __( 'Slider Type', 'samathemes' ),
				'id'      => $prefix. 'slider_type',
				'type'    => 'select',
				'options' => array(
					'no' 					=> __( 'No', 'samathemes' ),
					'fullscreenbg'			=> __( 'Full Screen Background', 'samathemes' ),
					'fullscreenslidercbg' 	=> __( 'Full Screen Slider Background jQuery CBG', 'samathemes' ),
					'fullwidthslidercbg'	=> __( 'Full Width Slider Background jQuery CBG', 'samathemes' ),
					'zooming' 				=> __( 'Zooming', 'samathemes' ),
					'supersized' 			=> __( 'Supersized', 'samathemes' ),
					'youtubevideobg' 		=> __( 'Youtube Video Background', 'samathemes' ),
					'html5videoslider' 		=> __( 'HTML 5 Video Slider', 'samathemes' ),
					'movementbg' 			=> __( 'Movement Background', 'samathemes' ),
					'patternlight' 			=> __( 'Pattern Light', 'samathemes' ),
					'patterndark' 			=> __( 'Pattern Dark', 'samathemes' ),
				),
				'multiple'    => false,
			),
			array(
				'name'    => __( 'Overlay Transparent', 'samathemes' ),
				'id'      => $prefix. 'slider_transparent',
				'type'    => 'select',
				'options' => array(
					''					=> __('no','samathemes'),
					'transparent-bg-0'		=> __('Transparent 0', 'samathemes'),
					'transparent-bg-1'		=> __('Transparent 0.1', 'samathemes'),
					'transparent-bg-2'		=> __('Transparent 0.2', 'samathemes'),
					'transparent-bg-3'		=> __('Transparent 0.3', 'samathemes'),
					'transparent-bg-4'		=> __('Transparent 0.4', 'samathemes'),
					'transparent-bg-5'		=> __('Transparent 0.5', 'samathemes'),
					'transparent-bg-6'		=> __('Transparent 0.6', 'samathemes'),
					'transparent-bg-7' 		=> __('Transparent 0.7', 'samathemes'),
					'transparent-bg-8' 		=> __('Transparent 0.8', 'samathemes'),
					'transparent-bg-9'		=> __('Transparent 0.9', 'samathemes'),
					'transparent-bg-10'		=> __('Transparent 1',   'samathemes')
				),
				'multiple'    => false,
			),
			array(
				'name'    => __( 'Upload image background', 'samathemes' ),
				'id'      => $prefix. 'slider_images',
				'type'    => 'file_advanced',
				//'max_file_uploads' => 1,
			),
			array(
				'name'    => __( 'Content', 'samathemes' ),
				'id'      => $prefix. 'slider_content',
				'type'    => 'textarea',
				'rows'	  => 8,
			),
			array(
				'name'    => __( 'Video HTML5 Image', 'samathemes' ),
				'id'      => $prefix. 'bgvideo',
				'type'    => 'file_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'    => __('WebM File URL', 'samathemes'),
				'id'      => $prefix. 'webm',
				'type'    => 'text',
				'size'	  => 60,
			),
			array(
				'name'    => __('MP4 File URL', 'samathemes'),
				'id'      => $prefix. 'mp4',
				'type'    => 'text',
				'size'	  => 60,
			),
			array(
				'name'    => __('OGV File URL', 'samathemes'),
				'id'      => $prefix. 'ogv',
				'type'    => 'text',
				'size'	  => 60,
			),
			array(
				'name'    => __( 'Youtube Video URL', 'samathemes' ),
				'id'      => $prefix. 'youtube',
				'type'    => 'text',
				'size'	  => 60,
			),
		),
		
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'sama_metaboxes' );
?>
