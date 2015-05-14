<?php
// Disable update for Visual Composer 
vc_set_as_theme( $disable_updater = false );

/*
 * Disable CSS and JS in Frondend
 */
//vc_disable_frontend();
function sama_vc_dequeue_script() {
   wp_deregister_style( 'js_composer_custom_css' );
   wp_deregister_style( 'js_composer_front' );
}
add_action( 'wp_enqueue_scripts', 'sama_vc_dequeue_script', 10 );

/* 
 * Remove Elements  from Visual Composer 
 */
vc_remove_element('vc_button');
vc_remove_element('vc_button2');
vc_remove_element('vc_cta_button');
vc_remove_element('vc_cta_button2');
vc_remove_element('vc_separator');
vc_remove_element('vc_text_separator');
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_message");
vc_remove_element("vc_toggle");
vc_remove_element("vc_gallery");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_tour");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_pie");
vc_remove_element("vc_masonry_grid");
vc_remove_element("vc_media_grid");
vc_remove_element("vc_basic_grid");
vc_remove_element("vc_masonry_media_grid");

/* Global Variables
---------------------------------------------------------- */
// Return all of categories for posts as array 
function sama_get_all_categories() {
	$cats['All Categories'] = -1;
	$categories = get_terms( 'category', array(
		'orderby'    => 'name',
		'hide_empty' => 0,
	));
	foreach ( $categories as $cat ) {
		$cats[$cat->name] = $cat-> term_id ;
	}
	
	return $cats;
}
// Link target
$target_arr = array(
	__( 'Same window', 'samathemes' ) => '_self',
	__( 'New window', 'samathemes' )  => '_blank'
);

// Button Background Color
$colors_arr = array(
	__( 'Pomegranate', 'samathemes' ) 	=> 'alizarin-btn',
	__( 'Red light', 'samathemes' ) 	=> 'pomegranate-btn',
	__( 'Turquoise', 'samathemes' ) 	=> 'turqioise-btn',
	__( 'Green Sea', 'samathemes' ) 	=> 'green_sea-btn',
	__( 'emerald', 'samathemes' ) 		=> 'emerald-btn',
	__( 'nephritis', 'samathemes' ) 	=> 'nephritis-btn',
	__( 'peter river', 'samathemes' ) 	=> 'peter_river-btn',
	__( 'belize hole', 'samathemes' ) 	=> 'belize_hole-btn',
	__( 'amethyst ', 'samathemes' ) 	=> 'amethyst-btn',
	__( 'belize hole', 'samathemes' ) 	=> 'wisteria-btn',
	__( 'amethyst ', 'samathemes' ) 	=> 'wet_asphalt-btn',
	__( 'belize hole', 'samathemes' ) 	=> 'midnight_blue-btn',
	__( 'Sun flower', 'samathemes' ) 	=> 'sun_flower-btn',
	__( 'Orange', 'samathemes' ) 		=> 'orange-btn',
	__( 'Carrot', 'samathemes' ) 		=> 'carrot-btn',
	__( 'Pumpkin', 'samathemes' ) 		=> 'pumpkin-btn',
	__( 'Brown', 'samathemes' ) 		=> 'brown-btn',
	__( 'Concrete', 'samathemes' ) 		=> 'concrete-btn',
	__( 'Asbestos', 'samathemes' ) 		=> 'asbestos-btn',
	__( 'Silver', 'samathemes' ) 		=> 'silver-btn',
	__( 'Custom Color', 'samathemes' ) 	=> 'custom',
	
);

// CSS3 Animation Type
function add_sama_animation( $param_name = 'css_animation_type' ) {
	$add_sama_animation = array(
		'type' 		=> 'dropdown',
		'heading' 	=> __('CSS Animation', 'samathemes'),
		'param_name' 	=> $param_name,
		'admin_label' => true,
		'value' 		=> array (
			'No' 					=> '',
			'bounce' 				=> 'bounce',
			'flash' 				=> 'flash',
			'pulse' 				=> 'pulse',
			'rubberBand' 			=> 'rubberBand',
			'shake' 				=> 'shake',
			'swing' 				=> 'swing',
			'tada' 					=> 'tada',
			'wobble' 				=> 'wobble',
			'bounceIn' 				=> 'bounceIn',
			'bounceInDown' 			=> 'bounceInDown',
			'bounceInLeft' 			=> 'bounceInLeft',
			'bounceInRight' 		=> 'bounceInRight',
			'bounceInUp' 			=> 'bounceInUp',
			'bounceOut' 			=> 'bounceOut',
			'fadeIn' 				=> 'fadeIn',
			'fadeInDown' 			=> 'fadeInDown',
			'fadeInDownBig' 		=> 'fadeInDownBig',
			'fadeInLeft' 			=> 'fadeInLeft',
			'fadeInLeftBig' 		=> 'fadeInLeftBig',
			'fadeInRight' 			=> 'fadeInRight',
			'fadeInRightBig' 		=> 'fadeInRightBig',
			'fadeInUp' 				=> 'fadeInUp',
			'fadeInUpBig' 			=> 'fadeInUpBig',
			'flip' 					=> 'flip',
			'flipInX' 				=> 'flipInX',
			'flipInY' 				=> 'flipInY',
			'flipOutX' 				=> 'flipOutX',
			'flipOutY' 				=> 'flipOutY',
			'lightSpeedIn' 			=> 'lightSpeedIn',
			'lightSpeedOut' 		=> 'lightSpeedOut',
			'rotateIn' 				=> 'rotateIn',
			'rotateInDownLeft' 		=> 'rotateInDownLeft',
			'rotateInDownRight' 	=> 'rotateInDownRight',
			'rotateInUpLeft' 		=> 'rotateInUpLeft',
			'rotateInUpRight' 		=> 'rotateInUpRight',
			'hinge' 				=> 'hinge',
			'rollIn' 				=> 'rollIn',
			'rollOut' 				=> 'rollOut',
			'zoomIn' 				=> 'zoomIn',
			'zoomInDown' 			=> 'zoomInDown',
			'zoomInLeft' 			=> 'zoomInLeft',
			'zoomInRight' 			=> 'zoomInRight',
			'zoomInUp' 				=> 'zoomInUp',
		)
	);
	
	return $add_sama_animation;
}

// CSS3 Animation Delay
function data_animation_delay( $param_name = 'css_animation_delay' ) {

	$data_animation_delay = array(
		'type' 		=> 'dropdown',
		'heading' 	=> __('CSS Animation Delay', 'samathemes'),
		'param_name' 	=> $param_name,
		'std'			=> '',
		'value' 		=> array (
			'No'   => '',
			'100'  => '100',
			'200'  => '200',
			'300'  => '300',
			'400'  => '400',
			'500'  => '500',
			'600'  => '600',
			'700'  => '700',
			'800'  => '800',
			'900'  => '900',
			'1000' => '1000',
			'1100' => '1100',
			'1200' => '1200',
			'1300' => '1300',
			'1400' => '1400',
			'1500' => '1500',
			'1600' => '1600',
			'1700' => '1700',
			'1800' => '1800',
			'1900' => '1900',
			'2000' => '2000',
			'2100' => '2100',
			'2200' => '2200',
			'2300' => '2300',
			'2400' => '2400',
			'2500' => '2500',
			'2600' => '2600',
			'2700' => '2700',
			'2800' => '2800',
			'2900' => '2900',
			'3000' => '3000',
		)
	);
	
	return $data_animation_delay;
}

// Info
function sama_vc_info_field( $settings, $value ) {
	return '<div class="info-field"><h3>'. $settings['heading'] .'</h3></div>';
}
add_shortcode_param('infofield', 'sama_vc_info_field' );


/* Edit Elments in Visual Composer
---------------------------------------------------------- */
/*	
 * Edit VC Row 
 */
vc_add_param( 'vc_row' , array(
	'type' 			=> 'textfield',
	'heading' 		=> __('Anchor Id','brad-framework'),
	'value' 		=> '',
	'param_name' 	=> 'sid',
	'description' 	=> __('You can use this Anchor id in Appearance -> Menus to scroll to  this row/section', 'samathemes')
  )
);vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Add Progress Image', 'samathemes'),
		  'param_name' 	=> 'progress_img',
		  'description' => __('Choose this when you need to add progress image for counters', 'samathemes'),
		  'std'			=> 'no',
		  'value' 		=> array(
							__('Yes','samathemes') 	=> 'yes',
							__('No', 'samathemes')	=> 'no',
						)
		)
);
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Choose extra CSS class', 'samathemes'),
		  'param_name' 	=> 'extra_css',
		  'description' => __('Choose this when you need to make this block like demo', 'samathemes'),
		  'std'			=> '',
		  'value' 		=> array(
							'' 														=> '',
							__('Welcome Box with dark background', 'samathemes') 	=> 'welcome',
							__('Add pattern to tranparent', 'samathemes')			=> 'pattern',
							__('Details', 'samathemes')								=> 'details',
							__('Service Block', 'samathemes')						=> 'service-block',
							__('Pricing table without margin', 'samathemes')		=> 'pricing-off-marg',
							__('Make H1, h2, h3 color White', 'samathemes')			=> 'connect ',
							__('banners Block text', 'samathemes')					=> 'banners ',
							__('FAQ Links', 'samathemes')							=> 'faqs',
							__('Block have Accordions With Google maps', 'samathemes')	=> 'branches',
							__('Block have Contact us information', 'samathemes')	=> 'contact-information',
							__('comming soon page style 3', 'samathemes')			=> 'construction-block-2',
						)
		)
);


vc_add_param( 'vc_row' , array(
	'type' 			=> 'dropdown',
	'heading' 		=> __('Full width', 'samathemes'),
	'param_name' 	=> 'fullwidth',
	'description' 	=> __('Full width container useful for portfolio and google custom map, revolution slider', 'samathemes'),
	'group' 		=> 'Theme Extra Options',
	'value' 		=> array(
					__('Default','samathemes') 				 => '',
					__('Full Width Container', 'samathemes') => 'yes',
				)
	)
);

vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Add Padding Top Bottom', 'samathemes'),
		  'param_name' 	=> 'box_padding',
		  'description' => __('Add padding to this box at top and bottom 100px', 'samathemes'),
		  'std'			=> 'pad-top-bottom',
		  'group' 		=> 'Theme Extra Options',
		  'value' 		=> array(
							__('no','samathemes') 							=> 'without-padding',
							__('padding top bottom 20px', 'samathemes')		=> 'pad-top-bottom-20',
							__('padding top bottom 40px', 'samathemes')		=> 'pad-top-bottom-40',
							__('padding top bottom 60px', 'samathemes')		=> 'pad-top-bottom-60',
							__('padding top bottom 80px', 'samathemes')		=> 'pad-top-bottom-80',
							__('padding top bottom 100px', 'samathemes')	=> 'pad-top-bottom',
							__('padding top bottom 250px', 'samathemes')	=> 'pad-top-bottom-250',
							__('padding top 100 bottom 80px', 'samathemes')	=> 'pad-top-100-bottom-80',
							__('padding top 100 bottom 60px', 'samathemes')	=> 'pad-top-100-bottom-60',
							__('padding top bottom 40px', 'samathemes')		=> 'pad-40',
							__('padding top 100px', 'samathemes')			=> 'pad-top-100',
							__('padding top 80px', 'samathemes')			=> 'pad-top-80',
							__('padding top 60px', 'samathemes')			=> 'pad-top-60',
							__('padding top 40px', 'samathemes')			=> 'pad-top-40',
							__('padding top 20px', 'samathemes')			=> 'pad-top-20',
							__('padding bottom 100px', 'samathemes')		=> 'pad-bottom-100',
							__('padding bottom 80px', 'samathemes')			=> 'pad-bottom-80',
							__('padding bottom 60px', 'samathemes')			=> 'pad-bottom-60',
							__('padding bottom 40px', 'samathemes')			=> 'pad-bottom-40',
							__('padding bottom 20px', 'samathemes')			=> 'pad-bottom-20',
						)
		)
);

vc_add_param( 'vc_row' , array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> __('Box Background', 'samathemes'),
		  'param_name' 		=> 'theme_color',
		  'description' 	=> __('Choose darkness when you used background image, and choose grey background to change background for this box to grey', 'samathemes'),
		  'std'				=> 'theme-color',
		  'group' 			=> 'Theme Extra Options',
		  'value' 			=> array(
							__('Theme color','samathemes') 		=> 'theme-color',
							__('Darkness', 'samathemes')		=> 'darkness',
							__('Grey background', 'samathemes')	=> 'grey-bg',
						)
		)
);

vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background Opacity Overlay', 'samathemes'),
		  'param_name' 	=> 'transparent_bg',
		  'description' => __('Choose transparent background when you choose darkness from box background', 'samathemes'),
		  'group' 		=> 'Theme Extra Options',
		  'std'			=> '',
		  'value' 		=> array(
							__('No','samathemes')				=> 'transparent-bg-0',
							__('Transparent 0.1','samathemes') 	=> 'transparent-bg-1',
							__('Transparent 0.2','samathemes') 	=> 'transparent-bg-2',
							__('Transparent 0.3','samathemes') 	=> 'transparent-bg-3',
							__('Transparent 0.4','samathemes') 	=> 'transparent-bg-4',
							__('Transparent 0.5', 'samathemes')	=> 'transparent-bg-5',
							__('Transparent 0.6', 'samathemes')	=> 'transparent-bg-6',
							__('Transparent 0.7','samathemes') 	=> 'transparent-bg-7',
							__('Transparent 0.8', 'samathemes')	=> 'transparent-bg-8',
							__('Transparent 0.9', 'samathemes')	=> 'transparent-bg-9',
							__('Transparent 1', 'samathemes')	=> 'transparent-bg-10',
						),
		"dependency" => array( 'element' => 'theme_color', 'value' =>  array('darkness') )
		)
);

// VC ROW Inner
vc_add_param( 'vc_row_inner' , array(
	'type' 			=> 'textfield',
	'heading' 		=> __('Anchor Id','brad-framework'),
	'value' 		=> '',
	'param_name' 	=> 'sid',
	'description' 	=> __('You can use this Anchor id in Appearance -> Menus to scroll to  this row/section', 'samathemes')
  )
);vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Add Progress Image', 'samathemes'),
		  'param_name' 	=> 'progress_img',
		  'description' => __('Choose this when you need to add progress image for counters', 'samathemes'),
		  'std'			=> 'no',
		  'value' 		=> array(
							__('Yes','samathemes') 	=> 'yes',
							__('No', 'samathemes')	=> 'no',
						)
		)
);
vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Choose extra CSS class', 'samathemes'),
		  'param_name' 	=> 'extra_css',
		  'description' => __('Choose this when you need to make this block like demo', 'samathemes'),
		  'std'			=> '',
		  'value' 		=> array(
							'' 														=> '',
							__('Welcome Box with dark background', 'samathemes') 	=> 'welcome',
							__('Add pattern to tranparent', 'samathemes')			=> 'pattern',
							__('Details', 'samathemes')								=> 'details',
							__('Service Block', 'samathemes')						=> 'service-block',
							__('Pricing table without margin', 'samathemes')		=> 'pricing-off-marg',
							__('Make H1, h2, h3 color White', 'samathemes')			=> 'connect ',
							__('banners Block text', 'samathemes')					=> 'banners ',
							__('FAQ Links', 'samathemes')							=> 'faqs',
							__('Block have Accordions With Google maps', 'samathemes')	=> 'branches',
							__('Block have Contact us information', 'samathemes')	=> 'contact-information',
							__('comming soon page style 3', 'samathemes')			=> 'construction-block-2',
						)
		)
);


vc_add_param( 'vc_row_inner' , array(
	'type' 			=> 'dropdown',
	'heading' 		=> __('Full width', 'samathemes'),
	'param_name' 	=> 'fullwidth',
	'description' 	=> __('Full width container useful for portfolio and google custom map, revolution slider', 'samathemes'),
	'group' 		=> 'Theme Extra Options',
	'value' 		=> array(
					__('Default','samathemes') 				 => '',
					__('Full Width Container', 'samathemes') => 'yes',
				)
	)
);

vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Add Padding Top Bottom', 'samathemes'),
		  'param_name' 	=> 'box_padding',
		  'description' => __('Add padding to this box at top and bottom 100px', 'samathemes'),
		  'std'			=> 'pad-top-bottom',
		  'group' 		=> 'Theme Extra Options',
		  'value' 		=> array(
							__('no','samathemes') 							=> 'without-padding',
							__('padding top bottom 20px', 'samathemes')		=> 'pad-top-bottom-20',
							__('padding top bottom 40px', 'samathemes')		=> 'pad-top-bottom-40',
							__('padding top bottom 60px', 'samathemes')		=> 'pad-top-bottom-60',
							__('padding top bottom 80px', 'samathemes')		=> 'pad-top-bottom-80',
							__('padding top bottom 100px', 'samathemes')	=> 'pad-top-bottom',
							__('padding top bottom 250px', 'samathemes')	=> 'pad-top-bottom-250',
							__('padding top 100 bottom 80px', 'samathemes')	=> 'pad-top-100-bottom-80',
							__('padding top 100 bottom 60px', 'samathemes')	=> 'pad-top-100-bottom-60',
							__('padding top bottom 40px', 'samathemes')		=> 'pad-40',
							__('padding top 100px', 'samathemes')			=> 'pad-top-100',
							__('padding top 80px', 'samathemes')			=> 'pad-top-80',
							__('padding top 60px', 'samathemes')			=> 'pad-top-60',
							__('padding top 40px', 'samathemes')			=> 'pad-top-40',
							__('padding top 20px', 'samathemes')			=> 'pad-top-20',
							__('padding bottom 100px', 'samathemes')		=> 'pad-bottom-100',
							__('padding bottom 80px', 'samathemes')			=> 'pad-bottom-80',
							__('padding bottom 60px', 'samathemes')			=> 'pad-bottom-60',
							__('padding bottom 40px', 'samathemes')			=> 'pad-bottom-40',
							__('padding bottom 20px', 'samathemes')			=> 'pad-bottom-20',
						)
		)
);

vc_add_param( 'vc_row_inner' , array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> __('Box Background', 'samathemes'),
		  'param_name' 		=> 'theme_color',
		  'description' 	=> __('Choose darkness when you used background image, and choose grey background to change background for this box to grey', 'samathemes'),
		  'std'				=> 'theme-color',
		  'group' 			=> 'Theme Extra Options',
		  'value' 			=> array(
							__('Theme color','samathemes') 		=> 'theme-color',
							__('Darkness', 'samathemes')		=> 'darkness',
							__('Grey background', 'samathemes')	=> 'grey-bg',
						)
		)
);

vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background Opacity Overlay', 'samathemes'),
		  'param_name' 	=> 'transparent_bg',
		  'description' => __('Choose transparent background when you choose darkness from box background', 'samathemes'),
		  'group' 		=> 'Theme Extra Options',
		  'std'			=> '',
		  'value' 		=> array(
							__('No','samathemes')				=> 'transparent-bg-0',
							__('Transparent 0.1','samathemes') 	=> 'transparent-bg-1',
							__('Transparent 0.2','samathemes') 	=> 'transparent-bg-2',
							__('Transparent 0.3','samathemes') 	=> 'transparent-bg-3',
							__('Transparent 0.4','samathemes') 	=> 'transparent-bg-4',
							__('Transparent 0.5', 'samathemes')	=> 'transparent-bg-5',
							__('Transparent 0.6', 'samathemes')	=> 'transparent-bg-6',
							__('Transparent 0.7','samathemes') 	=> 'transparent-bg-7',
							__('Transparent 0.8', 'samathemes')	=> 'transparent-bg-8',
							__('Transparent 0.9', 'samathemes')	=> 'transparent-bg-9',
							__('Transparent 1', 'samathemes')	=> 'transparent-bg-10',
						),
		"dependency" => array( 'element' => 'theme_color', 'value' =>  array('darkness') )
		)
);

// Row Parallax Background
vc_add_param( 'vc_row' , array(
	'type' 		 => 'checkbox',
	'heading' 	 => __( 'Parallax Background?', 'samathemes' ),
	'param_name' => 'parallax',
	'group' 	 => 'Parallax Background',
	'value'		 => array(
		__( 'Enable Parallax Background?', 'samathemes' ) => 'yes'
		)
	)
);
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background Type', 'samathemes'),
		  'param_name' 	=> 'bgtype',
		  'group' 		=> 'Parallax Background',
		  'std'			=> 'image',
		  'value' 		=> array(
							__('Image','samathemes') 	=> 'image',
							__('Video', 'samathemes')	=> 'video',
						),
		'dependency' => array( 'element' => 'parallax', 'value' =>  array('yes') )
		)
);
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background attachment fixed', 'samathemes'),
		  'param_name' 	=> 'bgfixed',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'value' 		=> array(
							__('No','samathemes') 	=> 'no',
							__('Yes', 'samathemes')	=> 'yes',
						),
			'dependency' => array( 'element' => 'bgtype', 'value' =>  array('image') )
		)
);
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background Repeat', 'samathemes'),
		  'param_name' 	=> 'bgrepeat',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'value' 		=> array(
							'' 	=> '',
							__('No Repeat','samathemes') 	=> 'no-repeat',
							__('Repeat X', 'samathemes')	=> 'repeat-x',
							__('Repeat y', 'samathemes')	=> 'repeat-y',
							__('Repeat', 'samathemes')	=> 'repeat',
						),
		"dependency" => array( 'element' => 'bgtype', 'value' =>  array('image') )
		)
);

vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background position', 'samathemes'),
		  'param_name' 	=> 'bgposition',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'value' 		=> array(
							'' 	=> '',
							__('Left Top', 'samathemes')		=> 'left top',
							__('Left Center', 'samathemes')		=> 'left center',
							__('Left Bottom', 'samathemes')		=> 'left bottom',
							__('Right Top', 'samathemes')		=> 'right top',
							__('Right Center', 'samathemes') 	=> 'right center',
							__('Right Bottom', 'samathemes')	=> 'right bottom',
							__('Center Top', 'samathemes')		=> 'center top',
							__('Center Center', 'samathemes')	=> 'center center',
							__('Center Bottom', 'samathemes')	=> 'center bottom',
							__('custom', 'samathemes')			=> 'custom',
						),
		"dependency" => array( 'element' => 'bgtype', 'value' =>  array('image') )				
		)
);

vc_add_param( 'vc_row' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('Background position X', 'samathemes'),
		  'param_name' 	=> 'bgposition_x',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency' => array( 'element' => 'bgposition', 'value' =>  array('custom') )
));

vc_add_param( 'vc_row' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('Background position Y', 'samathemes'),
		  'param_name' 	=> 'bgposition_y',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency' => array( 'element' => 'bgposition', 'value' =>  array('custom') )
));
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'attach_image',
		  'heading' 	=> __('Background Video', 'samathemes'),
		  'param_name' 	=> 'bgvideo',
		  'group' 		=> 'Parallax Background',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('WebM File URL', 'samathemes'),
		  'param_name' 	=> 'webm',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('MP4 File URL', 'samathemes'),
		  'param_name' 	=> 'mp4',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('OGV File URL', 'samathemes'),
		  'param_name' 	=> 'ogv',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));

// VC ROW Inner
vc_add_param( 'vc_row_inner' , array(
	'type' 		 => 'checkbox',
	'heading' 	 => __( 'Parallax Background?', 'samathemes' ),
	'param_name' => 'parallax',
	'group' 	 => 'Parallax Background',
	'value'		 => array(
		__( 'Enable Parallax Background?', 'samathemes' ) => 'yes'
		)
	)
);
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background Type', 'samathemes'),
		  'param_name' 	=> 'bgtype',
		  'group' 		=> 'Parallax Background',
		  'std'			=> 'image',
		  'value' 		=> array(
							__('Image','samathemes') 	=> 'image',
							__('Video', 'samathemes')	=> 'video',
						),
		'dependency' => array( 'element' => 'parallax', 'value' =>  array('yes') )
		)
);
vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background attachment fixed', 'samathemes'),
		  'param_name' 	=> 'bgfixed',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'value' 		=> array(
							__('No','samathemes') 	=> 'no',
							__('Yes', 'samathemes')	=> 'yes',
						),
			'dependency' => array( 'element' => 'bgtype', 'value' =>  array('image') )
		)
);
vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background Repeat', 'samathemes'),
		  'param_name' 	=> 'bgrepeat',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'value' 		=> array(
							'' 	=> '',
							__('No Repeat','samathemes') 	=> 'no-repeat',
							__('Repeat X', 'samathemes')	=> 'repeat-x',
							__('Repeat y', 'samathemes')	=> 'repeat-y',
							__('Repeat', 'samathemes')	=> 'repeat',
						),
		"dependency" => array( 'element' => 'bgtype', 'value' =>  array('image') )
		)
);

vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Background position', 'samathemes'),
		  'param_name' 	=> 'bgposition',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'value' 		=> array(
							'' 	=> '',
							__('Left Top', 'samathemes')		=> 'left top',
							__('Left Center', 'samathemes')		=> 'left center',
							__('Left Bottom', 'samathemes')		=> 'left bottom',
							__('Right Top', 'samathemes')		=> 'right top',
							__('Right Center', 'samathemes') 	=> 'right center',
							__('Right Bottom', 'samathemes')	=> 'right bottom',
							__('Center Top', 'samathemes')		=> 'center top',
							__('Center Center', 'samathemes')	=> 'center center',
							__('Center Bottom', 'samathemes')	=> 'center bottom',
							__('custom', 'samathemes')			=> 'custom',
						),
		"dependency" => array( 'element' => 'bgtype', 'value' =>  array('image') )				
		)
);

vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('Background position X', 'samathemes'),
		  'param_name' 	=> 'bgposition_x',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency' => array( 'element' => 'bgposition', 'value' =>  array('custom') )
));

vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('Background position Y', 'samathemes'),
		  'param_name' 	=> 'bgposition_y',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency' => array( 'element' => 'bgposition', 'value' =>  array('custom') )
));
vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'attach_image',
		  'heading' 	=> __('Background Video', 'samathemes'),
		  'param_name' 	=> 'bgvideo',
		  'group' 		=> 'Parallax Background',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));
vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('WebM File URL', 'samathemes'),
		  'param_name' 	=> 'webm',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));
vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('MP4 File URL', 'samathemes'),
		  'param_name' 	=> 'mp4',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));
vc_add_param( 'vc_row_inner' , array(
		  'type' 		=> 'textfield',
		  'heading' 	=> __('OGV File URL', 'samathemes'),
		  'param_name' 	=> 'ogv',
		  'group' 		=> 'Parallax Background',
		  'std'			=> '',
		  'dependency'  => array( 'element' => 'bgtype', 'value' =>  array('video') )
));

vc_remove_param( 'vc_row', 'full_width' );
/*	
 * Edit VC Column 
 */

vc_add_param( 'vc_column' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> __('Text Align', 'samathemes'),
		  'param_name' 	=> 'text_align',
		  'description' => __('to make this column text align to center', 'samathemes'),
		  'std'			=> 'text-center',
		  'value' 		=> array(
							__('default', 	'samathemes')	=> 'no',
							__('Center',	'samathemes') 	=> 'text-center',
							__('Left',   	'samathemes')	=> 'text-left',
							__('Right',   	'samathemes')	=> 'text-right',
						)
		)
);
vc_add_param('vc_column', add_sama_animation() );
vc_add_param('vc_column', data_animation_delay() );

/*	
 * Edit VC accordion 
 */
vc_remove_param( 'vc_accordion', 'title' );
vc_remove_param( 'vc_accordion', 'active_tab' );
vc_remove_param( 'vc_accordion', 'collapsible' );
vc_add_param( 'vc_accordion' , array(
	'type' 			=> 'dropdown',
	'heading' 		=> __('Style', 'samathemes'),
	'param_name' 	=> 'style',
	'value' => array(
				__( 'light', 'samathemes' ) => 'faqs',
				__( 'dark', 'samathemes' ) 	=> 'faqs_2',
			),
	)
);
vc_add_param( 'vc_accordion_tab' , array(
	'type' 			=> 'checkbox',
	'heading' 		=> __('Active panel', 'samathemes'),
	'param_name' 	=> 'active_tab',
	'description' 	=> __( 'Select checkbox to allow this panel to be collapsible.', 'samathemes' ),
	'value' 		=> array( __( 'Allow', 'samathemes' ) => 'yes' )
	)
);

/*	
 * Edit VC Tabs 
 */
vc_remove_param( 'vc_tabs', 'interval' );
vc_add_param( 'vc_tabs' , array(
	'type' 			=> 'dropdown',
	'heading' 		=> __('Style', 'samathemes'),
	'param_name' 	=> 'style',
	'value' 		=> array(
							__('Dark', 'samathems') 		=> 'nav-tabs',
							__('Light', 'samathemes') 	=> 'nav-tabs2',
						)
	)
);
vc_add_param( 'vc_tab' , array(
	'type' 			=> 'checkbox',
	'heading' 		=> __('Active tab', 'samathemes'),
	'param_name' 	=> 'active_tab',
	'description' 	=> __( 'Select checkbox to allow this panel to be collapsible.', 'samathemes' ),
	'value' 		=> array( __( 'Allow', 'samathemes' ) => 'yes' )
	)
);
vc_add_param( 'vc_tab' , array(
	'type' => 'iconpicker',
	'heading' => __( 'Icon', 'samathemes' ),
	'param_name' => 'icon',
	'value' => '', // default value to backend editor admin_label
	'settings' => array(
		'emptyIcon' => true, // default true, display an "EMPTY" icon?
		'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
	),
	)
);
vc_add_param( 'vc_tab' , add_sama_animation());
vc_add_param( 'vc_tab' , data_animation_delay());


/* Add Custom Heading
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Add_Heading extends WPBakeryShortCode {}
}
vc_map( array(
	'name'			=> __('Add Custom Heading', 'samathemes'),
	'base' 			=> 'vc_add_heading',
	'class' 	  	=> 'vc_icon_feature',
	'icon' 			=> 'icon-wpb-ui-custom_heading',
	'category' 	  	=> __('Content', 'samathemes'),
	'admin_label' 	=> true,
	'category' 		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Title', 'samathemes'),
			'param_name' 	=> 'title',
			'admin_label' 	=> true
		),		
		array(
		  'type' 			=> 'textarea',
		  'heading' 		=> __('Content', 'samathemes'),
		  'param_name' 		=> 'second_heading',
		  'admin_label' 	=> true,
		  'description' 	=> __("Leave blank if you don't want to have a second title or content under title.", 'samathemes'),
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> __('Header Margin Bottom', 'samathemes'),
		  'param_name' 		=> 'margin_bottom',
		  'std'				=> 'default',
		  'value' 			=> array(
								__('0px', 		'samathemes')	=> 'no-margin',
								__('10px', 		'samathemes')	=> 'marg-bottom-10',
								__('20px', 		'samathemes')	=> 'marg-bottom-20',
								__('30px',		'samathemes') 	=> 'marg-bottom-30',
								__('40px',   	'samathemes')	=> 'marg-bottom-40',
								__('50px',   	'samathemes')	=> 'marg-bottom-50',
								__('60px',   	'samathemes')	=> 'marg-bottom-60',
								__('70px',   	'samathemes')	=> 'marg-bottom-70',
								__('80px',   	'samathemes')	=> 'default',
							)
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> __('Text Align', 'samathemes'),
		  'param_name' 		=> 'text_align',
		  'description' 	=> __('to make this column text align to center', 'samathemes'),
		  'std'				=> 'text-center',
		  'value' 			=> array(
								__('default', 	'samathemes')	=> '',
								__('Center',	'samathemes') 	=> 'text-center',
								__('Left',   	'samathemes')	=> 'text-left',
								__('Right',   	'samathemes')	=> 'text-right',
							)
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> __('Element Tag', 'samathemes'),
		  'param_name' 		=> 'tag',
		  'std'				=> 'default',
		  'value' 			=> array(
								__('h2', 	'samathemes')	=> 'h2',
								__('h3',	'samathemes') 	=> 'h3',
								__('h4',   	'samathemes')	=> 'h4',
								__('h5',   	'samathemes')	=> 'h5',
								__('h6',   	'samathemes')	=> 'h6',
							)
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> __('Element Tag Margin Bottom', 'samathemes'),
		  'param_name' 		=> 'tag_marg_bottom',
		  'std'				=> 'default',
		  'value' 			=> array(
								__('0px', 	'samathemes')	=> 'tag-no-marg',
								__('20px',	'samathemes') 	=> 'default',
							)
		),
		
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> __('Border Bottom', 'samathemes'),
		  'param_name' 		=> 'border_bottom',
		  'std'				=> 'yes',
		  'value' 			=> array(
								__('Yes','samathemes') 	=> 'yes',
								__('No', 'samathemes') 	=> 'no',
							)
		),
		add_sama_animation(),
		data_animation_delay(),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Extra class name', 'samathemes'),
			'param_name' 	=> 'el_class',
			'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
		),
	)
));

/* Blog Grid
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Custom_Blog_Grid extends WPBakeryShortCode {
    }
}
vc_map( array(
	'name'			=> __('Blog Grid', 'samathemes'),
	'base' 			=> 'vc_custom_blog_grid',
	'class' 	  	=> 'vc_icon_feature_blog_grids',
	'icon' 			=> 'icon-wpb-application-icon-large',
	'admin_label' 	=> true,
	'category' 		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    'params' => array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display Blog By', 'samathemes' ),
			'param_name' 	=> 'type',
			'admin_label'	=> true,
			'value' 		=> array(
								__( 'Recent', 'samathemes' ) 	=> 'recent',
								__( 'IDS',  'samathemes' ) 		=> 'ids',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Posts Category', 'samathemes'),
			'param_name' 	=> 'category',
			'value'			=> sama_get_all_categories(),
			'admin_label'	=> true,
			'dependency'  => array( 'element' => 'type', 'value' =>  array('recent') )
		),
		array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Post IDS', 'samathemes' ),
				'param_name' 	=> 'ids',
				'description' 	=> __('use comma to Separates between ids.', 'samathemes'),
				'dependency' 	=> array( 'element' => 'display','value' => array( 'ids' ) )
			),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Number of Posts', 'samathemes' ),
			'param_name' 	=> 'num',
			'std'			=> 3,
			'admin_label'	=> true,
			'dependency'  => array( 'element' => 'type', 'value' =>  array('recent') )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display author name', 'samathemes' ),
			'param_name' 	=> 'author',
			'admin_label'	=> true,
			'value' 		=> array(
								__( 'Yes', 'samathemes' ) 	=> 'yes',
								__( 'No',  'samathemes' ) 	=> 'no',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display tags', 'samathemes' ),
			'param_name' 	=> 'tags',
			'value' 		=> array(
								__( 'Yes', 'samathemes' ) 	=> 'yes',
								__( 'No',  'samathemes' ) 	=> 'no',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display Number of comments', 'samathemes' ),
			'param_name' 	=> 'comments',
			'value' 		=> array(
								__( 'Yes', 'samathemes' ) 	=> 'yes',
								__( 'No',  'samathemes' ) 	=> 'no',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display Number of views', 'samathemes' ),
			'param_name' 	=> 'views',
			'std'			=> 'no',
			'value' 		=> array(
								__( 'Yes', 'samathemes' ) 	=> 'yes',
								__( 'No',  'samathemes' ) 	=> 'no',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display Excerpt', 'samathemes' ),
			'param_name' 	=> 'display_excerpt',
			'std'			=> 'no',
			'value' 		=> array(
								__( 'Yes', 'samathemes' ) 	=> 'yes',
								__( 'No',  'samathemes' ) 		=> 'no',
							)
		),
		array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Excerpt Length', 'samathemes' ),
				'param_name'	=> 'ex_lengs',
				'value' 		=> 16,
				'dependency' 	=> array( 'element' => 'display_excerpt','value' => array( 'yes' ) )
			),
		array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Display link to Blog Page', 'samathemes' ),
				'param_name'	=> 'display_view_more',
				'std'			=> 'no',
				'value' 		=> array(
								__( 'Yes', 'samathemes' ) 	=> 'yes',
								__( 'No',  'samathemes' ) 		=> 'no',
							)
			),
        array(
            'type' 			=> 'textfield',
            'heading' 		=> __('Extra class name', 'samathemes'),
            'param_name' 	=> 'el_class',
            'description' 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        ),
    )
));

/* Custom Big Icon with link
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Big_Icon_With_link extends WPBakeryShortCode {}
}
vc_map( array(
	'name'			=> __('Box with big icon', 'samathemes'),
	'base' 			=> 'vc_big_icon_with_link',
	'class' 		=> 'vc_icon_feature',
	'icon' 			=> 'vc_icon_feature',
	'category' 		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'admin_label' 	=> true,
	'params' => array(
		array(
		  'type' 			=> 'textfield',
		  'heading' 		=> __('Title', 'samathemes'),
		  'param_name' 		=> 'title',
		  'description' 	=> __('Optional', 'samathemes'),
		  'admin_label' 	=> true,
		),
		array(
		  'type' 			=> 'textfield',
		  'heading' 		=> __('Link URL', 'samathemes'),
		  'param_name' 		=> 'url',
		),
		array(
		  'type' 			=> 'textfield',
		  'heading' 		=> __('Link Title Attributes ', 'samathemes'),
		  'param_name' 		=> 'url_title',
		  'description' 	=> __('Optional: used of a tag attribute title ', 'samathemes'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'samathemes' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
		),
		add_sama_animation(),
		data_animation_delay(),
	)
));

/* Buttons
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Feature_Button extends WPBakeryShortCode {
    }
}
vc_map( array(
    'name' 		=> __('Button', 'samathemes'),
    'base' 		=> 'vc_feature_button',
	'icon' 		=> 'icon-wpb-ui-button',
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-custom.css'),
    'params' 	=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Button text', 'samathemes' ),
			'param_name' 	=> 'title',
			'holder' 		=> 'button',
			'class' 		=> 'wpb_button',
			'value' 		=> __( 'Text on the button', 'samathemes' ),
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'href',
			'heading' 		=> __( 'URL (Link)', 'samathemes' ),
			'param_name' 	=> 'href',
			'description' 	=> __( 'Button link.', 'samathemes' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Target', 'samathemes' ),
			'param_name' 	=> 'target',
			'value' 		=> $target_arr,
			'dependency' 	=> array( 'element'=>'href', 'not_empty'=>true, 'callback' => 'vc_button_param_target_callback' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Color', 'samathemes' ),
			'param_name' 	=> 'bgcolor',
			'value' 		=> $colors_arr,
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> __( 'Custom color', 'samathemes' ),
			'param_name' 	=> 'customcolor',
			'dependency' 	=> array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Size', 'samathemes'),
			'param_name' 	=> 'size',
			'value' 		=> array(
								__('small', 'samathems') 	=> 'small-btn',
								__('Medium', 'samathemes') 	=> 'medium-btn',
								__('Large', 'samathemes') 	=> 'big-btn',
								__('Full Width', 'samathemes') 	=> 'medium-btn full-width-btn',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Display Border Button', 'samathemes'),
			'param_name' 	=> 'border',
			'value' 		=> array(
									'' 	=> '',
									__('Yes', 'samathemes') 	=> 'yes',
								)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Display CORNER', 'samathemes'),
			'param_name' 	=> 'corner',
			'value' 		=> array(
								'' 	=> '',
								__('Yes', 'samathemes') 	=> 'yes',
							)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'samathemes' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
		),
		add_sama_animation(),
		data_animation_delay(),
        array(
			"type" 			=> "textfield",
			"heading" 		=> __("Extra class name", "samathemes"),
			"param_name" 	=> "el_class",
			"description" 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    ),
));

/* Dividers
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Dividers extends WPBakeryShortCode {
    }
}
vc_map( array(
    'name' 		=> __('Dividers', 'samathemes'),
    'base' 		=> 'vc_dividers',
	'icon' 		=> 'icon-wpb-ui-separator',
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    'params' 	=> array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Style', 'samathemes'),
			'param_name' 	=> 'style',
			'admin_label'	=> true,
			'value' 		=> array(
								__('Style 1 Dashed', 'samathems') 			=> 'divider-dashed alizarin-divider',
								__('Style 2 solid', 'samathemes') 			=> 'divider-solid',
								__('Style 3 dotted', 'samathemes') 			=> 'divider-dotted',
								__('Style 4 strong solid', 'samathemes') 	=> 'divider-solid divider-3',
								__('Style 5 with image', 'samathemes') 		=> 'divider-img-1',
								__('Style 6 with image', 'samathemes') 		=> 'divider-img-2',
							)
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Margin Top', 'samathemes' ),
			'param_name' 	=> 'margin_top',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Margin Bottom', 'samathemes' ),
			'param_name' 	=> 'margin_bottom',
			'admin_label'	=> true,
		),
        array(
			"type" 			=> "textfield",
			"heading" 		=> __("Extra class name", "samathemes"),
			"param_name" 	=> "el_class",
			"description" 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    ),
));


/* Custom Google Maps
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Add_Gmaps extends WPBakeryShortCode {}
}
vc_map( array(
	'name'			=> __('Custom Google Map', 'samathemes'),
	'base' 			=> 'vc_add_gmaps',
	'class' 	  	=> 'vc_icon_feature',
	'icon' 			=> 'icon-wpb-map-pin',
	'category' 	  	=> __('Content', 'samathemes'),
	'admin_label' 	=> true,
	'category' 		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'samathemes' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Coordinates', 'samathemes' ),
			'param_name' 	=> 'latlang',
			'admin_label'	=> true,
			'description' 	=> __( 'Ex: 30.068476, 31.311973 <a href="https://support.google.com/maps/answer/18539?hl=en">more info</a>','samathemes'),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Zoom', 'samathemes' ),
			'param_name' 	=> 'zoom',
			'value'			=> 17,
			'admin_label'	=> true,
		),
		array(
		  'type' 			=> 'attach_image',
		  'heading' 		=> __('Image', 'samathemes'),
		  'param_name' 		=> 'image',
		  'description' 	=> __( 'Add Logo here to display in google map','samathemes'),
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> __('Content', 'samathemes'),
			'param_name' 	=> 'content',
			//'admin_label' 	=> true
		),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "samathemes"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        ),
	)
));

/* Custom Counter
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Counter extends WPBakeryShortCode {}
}
vc_map( array(
	'name'			=> __('Custom Counter', 'samathemes'),
	'base' 			=> 'vc_counter',
	'class' 		=> 'vc_icon_feature',
	'icon' 			=> 'vc_icon_feature',
	'category' 		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'admin_label' 	=> true,
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Title', 'samathemes'),
			'param_name' 	=> 'title',
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Counter Type', 'samathemes'),
			'param_name' 	=> 'type',
			'value' 		=> array(
								__('Box','samathemes') 		=> 'box',
								__('Circle', 'samathemes') 	=> 'circle',
								__('Line','samathemes') 	=> 'line',
								__('Icon inside circle','samathemes') 	=> 'icon_in_circle',
							)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'samathemes' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('box','icon_in_circle') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Value to count', 'samathemes'),
			'param_name' 	=> 'value',
			'description'	=> __('This value must be an integer', 'samathemes'),
			'admin_label' 	=> true
		),	
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Unit', 'samathemes'),
			'param_name' 	=> 'unit',
			'description' 	=> __('You can use any text such as % , cm or any other . Leave Blank if you do not want to display any unit value', 'samathemes'),
		),
		add_sama_animation(),
		data_animation_delay(),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Hide Counter', 'samathemes'),
			'param_name' 	=> 'hidecounter',
			'value' 		=> array(
								'' 		=> '',
								__('Yes', 'samathemes') 	=> 'yes',
							)
		),
	)
));

/* Custom single image client
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Single_Image_Client extends WPBakeryShortCode {}
}
vc_map( array(
	'name'			=> __('Custom Singe Image', 'samathemes'),
	'base' 			=> 'vc_single_image_client',
	'class' 		=> 'vc_icon_feature',
	'icon' 			=> 'icon-wpb-single-image',
	'category' 		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'admin_label' 	=> true,
	'params' 		=> array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Type', 'samathemes'),
			'param_name' 	=> 'type',
			'value' 		=> array(
								'' => '',
								__('Only image tag','samathemes') 		=> 'image',
								__('Image with absolute position','samathemes') => 'image-absolute',
							)
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> __('Image', 'samathemes'),
			'param_name' 	=> 'image',
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Image size', 'samathemes'),
			'param_name' 	=> 'img_size',
			'std'		   	=> 'single-client-image',
			'description' 	=> __('Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'samathemes'),
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Image Link', 'samathemes'),
			'param_name' 	=> 'url',
			'description' 	=> __('Option: used of a tag attribute title ', 'samathemes'),
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('') )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Link target', 'samathemes'),
			'param_name' 	=> 'target',
			'std'			=> '_self',
			'value' 		=> $target_arr ,
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('min Height', 'samathemes'),
			'param_name' 	=> 'min_height',
			'std'		   	=> '',
			'description' 	=> __('Ex: 100px or 100%', 'samathemes'),
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('image-absolute') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Width', 'samathemes'),
			'param_name' 	=> 'width',
			'description' 	=> __('Ex: 100px or 100%', 'samathemes'),
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('image-absolute') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Position Top', 'samathemes'),
			'param_name' 	=> 'pos_top',
			'description' 	=> __('Ex: 100px or 100%', 'samathemes'),
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('image-absolute') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Position Left', 'samathemes'),
			'param_name' 	=> 'pos_left',
			'description' 	=> __('Ex: 100px or 100%', 'samathemes'),
			'dependency' 	=> array( 'element' => 'type', 'value' =>  array('image-absolute') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Extra class name', 'samathemes'),
			'param_name' 	=> 'el_class',
			'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
		),
		add_sama_animation(),
		data_animation_delay(),
	)
));

/* Feature Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Feature_Box extends WPBakeryShortCode {}
}

vc_map( array(
	'name'			=> __('Feature Box', 'samathemes'),
	'base' 			=> 'vc_feature_box',
	'class' 		=> 'vc_icon_feature',
	'icon' 			=> 'vc_icon_feature',
	'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'admin_label' 	=> true,
	'params' 		=> array(
		array(
			'type' => 'textfield',
			'heading' => __('Title', 'samathemes'),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' 		 	=> 'dropdown',
			'heading'		=> __('Text Align', 'samathemes'),
			'param_name' 	=> 'text_align',
			'std'			=> 'text-center',
			'value' 		=> array(
								__('default', 	'samathemes')	=> '',
								__('Center',	'samathemes') 	=> 'text-center',
								__('Left',   	'samathemes')	=> 'text-left',
								__('Right',   	'samathemes')	=> 'text-right',
							)
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> __('Content', 'samathemes'),
			'param_name' 	=> 'content',
			'admin_label' 	=> true
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Parghraph font size', 'samathemes'),
			'param_name' 	=> 'p_font_size',
			'value' 		=> array(
								__('Defalut','samathemes') => '',
								__('15px', 'samathemes')   => '15px',
						)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Feature Box Icon Position', 'samathemes'),
			'param_name' 	=> 'position',
			'value' 		=> array(
								__('Centered Box','samathemes') => 'icon_centered',
								__('Icon side', 'samathemes') 		=> 'icon_left',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Feature Box With', 'samathemes'),
			'param_name' 	=> 'type',
			'std'			=> 'icon',
			'value' 		=> array(
								__('Icon','samathemes') 	=> 'icon',
								__('Image', 'samathemes') 	=> 'image',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon Active', 'samathemes'),
			'param_name' 	=> 'icon_active',
			'value' 		=> array(
								'' 	=> '',
								__('Yes', 'samathemes') 	=> 'yes',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'icon' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon Border', 'samathemes'),
			'param_name' 	=> 'icon_border',
			'value' 		=> array(
								__('Default', 'samathemes') => 'theme-border',
								__('Grey', 'samathemes') 	=> 'grey-border',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'icon' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon Rounded corner', 'samathemes'),
			'param_name' 	=> 'icon_rounded',
			'value' 		=> array(
								'' 	=> '',
								__('Yes', 'samathemes') 	=> 'yes',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'icon' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon font size', 'samathemes'),
			'param_name' 	=> 'icon_font_size',
			'value' 		=> array(
								__('default 36px', 'samathemes') => '',
								__('28px', 'samathemes') 		 => '28px',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'icon' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon line height', 'samathemes'),
			'param_name' 	=> 'icon_line_height',
			'value' 		=> array(
								__('default 70px', 'samathemes') => '',
								__('65px', 'samathemes') 		 => '65px',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'icon' ) )
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'samathemes' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'icon' ) )
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> __('Image', 'samathemes'),
			'param_name' 	=> 'image',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'image' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Button Link', 'samathemes'),
			'param_name' 	=> 'btn_url',
			'description' 	=> "Leave blank if you do't want to have a link for whole box.",
		),	
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Button Text', 'samathemes'),
			'param_name' 	=> 'btn_txt',
			'admin_label' 	=> true
		),
		add_sama_animation() ,
		data_animation_delay(),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Extra class name', 'samathemes'),
			'param_name' 	=> 'el_class',
			'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
		),	
	)
));

/* Feature list
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vc_Feature_List_Container extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Feature_List_Item extends WPBakeryShortCode {}
}

// Feature list Container
vc_map( array(
    'name' 			=> __('Feature List container', "samathemes"),
    'base' 			=> 'vc_feature_list_container',
    'as_parent' 	=> array('only' => 'vc_feature_list_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    'content_element' => true,
    'show_settings_on_create' => true,
	'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    'params' 		=> array(
        array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon align', 'samathemes'),
			'param_name' 	=> 'algin',
			'value' 		=> array(
								__('Left', 'samathemes') 	=> 'flt-left',
								__('Right', 'samathemes') 	=> 'flt-right',
							),
		),
       array(
			"type" => "textfield",
			"heading" => __("Extra class name", "samathemes"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    ),
	'js_view' => 'VcColumnView'
));

// Feature list item
vc_map( array(
    'name' 		=> __('Feature List item', "samathemes"),
    'base' 		=> 'vc_feature_list_item',
    'as_child' 	=> array('only' => 'vc_feature_list_container'),
    'content_element' => true,
    'show_settings_on_create' => true,
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'samathemes' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type'			=> 'dropdown',
			'heading' 	 	=> __('Icon Active', 'samathemes'),
			'param_name' 	=> 'icon_active',
			'value' 		=> array(
								'' 	=> '',
								__('Yes', 'samathemes') 	=> 'yes',
							)
		),
		array(
			'type'			=> 'dropdown',
			'heading' 	 	=> __('Border Color', 'samathemes'),
			'param_name' 	=> 'bord_color',
			'std'			=> 'theme-color',
			'value' 		=> array(
								__('Theme Color', 'samathemes') 	=> 'theme-color',
								__('Grey', 'samathemes') 	=> 'border-grey',
							)
		),
		array(
			'type'			=> 'dropdown',
			'heading' 	 	=> __('Border Color', 'samathemes'),
			'param_name' 	=> 'bord_size',
			'std'			=> 2,
			'value' 		=> array(
								__('1px', 'samathemes') 	=> 1,
								__('2px', 'samathemes') 	=> 2,
							)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'samathemes' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
		),
		add_sama_animation(),
		data_animation_delay(),
        array(
			"type" => "textfield",
			"heading" => __("Extra class name", "samathemes"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    ),
));

/* Feature list 2
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vc_Feature_List_Container_2 extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Feature_List_Item_2 extends WPBakeryShortCode {}
}
// Feature list Container
vc_map( array(
    'name' 		=> __('Feature List container 2', 'samathemes'),
    'base' 		=> 'vc_feature_list_container_2',
    'as_parent' => array('only' => 'vc_feature_list_item_2'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    'content_element' => true,
    'show_settings_on_create' => true,
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    'params' 	=> array(
       array(
            "type" => "textfield",
            "heading" => __("Extra class name", "samathemes"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    ),
	'js_view' => 'VcColumnView'
) );

// Feature list item 
vc_map( array(
    "name" => __("Feature List item 2", "samathemes"),
    "base" => "vc_feature_list_item_2",
    "as_child" => array('only' => 'vc_feature_list_container_2'),
    "content_element" => true,
    "show_settings_on_create" => true,
	'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    "params" => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'samathemes' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'URL Link', 'samathemes' ),
			'param_name' 	=> 'url',
			'description' 	=>  __('OPtional', 'samathemes'),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Left position', 'samathemes' ),
			'param_name' 	=> 'pos_left',
			'description' 	=>  __('Ex 110px or 75%', 'samathemes'),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Margin Top', 'samathemes' ),
			'param_name' 	=> 'margin_top',
			'description' 	=>  __('Ex 110px or 75%', 'samathemes'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'samathemes' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
		),
		add_sama_animation(),
		data_animation_delay(),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "samathemes"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    ),
));


/* Image owl Carousel
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Images_Owl_Carousel extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 		=> __( 'Image Owl Carousel', 'samathemes' ),
	'base' 		=> 'vc_images_owl_carousel',
	'icon'		=> 'icon-wpb-images-carousel',
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'description' => __( 'Animated carousel with images', 'samathemes' ),
	'params' 	=> array(
		array(
			'type' 		=> 'dropdown',
			'heading' 	=> __( 'Type', 'samathemes' ),
			'param_name' => 'type',
			'value' 	=> array(
				__( 'Like client carousel', 'samathemes' ) => 'like_client',
				__( 'Like Screen shot carousel', 'samathemes' ) => 'like_screen_shot',
			),
			'description' => __( 'Choose slider type like theme demo', 'samathemes' )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'samathemes' ),
			'param_name' 	=> 'title',
			'description' 	=> __( 'Only display in Admin', 'samathemes' ),
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'attach_images',
			'heading' 		=> __( 'Images', 'samathemes' ),
			'param_name' 	=> 'images',
			'value'		 	=> '',
			'admin_label' 	=> true,
			'description' 	=> __( 'Select images from media library.', 'samathemes' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'On click', 'samathemes' ),
			'param_name' 	=> 'onclick',
			'value' 		=> array(
				__( 'Do nothing', 'samathemes' ) => 'link_no',
				__( 'Open custom link', 'samathemes' ) => 'custom_link',
				__( 'Open Fancybox', 'samathemes' ) => 'open_fancy_box'
			),
			'description' 	=> __( 'What to do when slide is clicked?', 'samathemes' )
		),
		array(
			'type' 			=> 'exploded_textarea',
			'heading' 		=> __( 'Custom links', 'samathemes' ),
			'param_name' 	=> 'custom_links',
			'description' 	=> __( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'samathemes' ),
			'dependency' 	=> array( 'element' => 'onclick', 'value' => array( 'custom_link' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Custom link target', 'samathemes' ),
			'param_name' 	=> 'custom_links_target',
			'description' 	=> __( 'Select where to open  custom links.', 'samathemes' ),
			'dependency' 	=> array( 'element' => 'onclick', 'value' => array( 'custom_link' )
			),
			'value' => $target_arr
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Extra class name', 'samathemes' ),
			'param_name' 	=> 'el_class',
			'description' 	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'samathemes' )
		)
	)
) );

/* Image Bootstrap Carousel
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Images_Bootstrap_Carousel extends WPBakeryShortCode {}
}
vc_map( array(
	'name' => __( 'Image Bootstrap Carousel', 'samathemes' ),
	'base' => 'vc_images_bootstrap_carousel',
	'icon' => 'icon-wpb-images-carousel',
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'description' => __( 'Animated carousel with images', 'samathemes' ),
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'samathemes' ),
			'param_name' 	=> 'title',
			'description' 	=> __( 'Only display in Admin', 'samathemes' ),
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'attach_images',
			'heading' 		=> __( 'Images', 'samathemes' ),
			'param_name' 	=> 'images',
			'value' 		=> '',
			'admin_label' 	=> true,
			'description' 	=> __( 'Select images from media library.', 'samathemes' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Show navigation arrows', 'samathemes' ),
			'param_name' 	=> 'arrows',
			'std'			=> '',
			'value' 		=> array(
					__( 'No',	'samathemes' )	=> 'no',
					__( 'Yes', 	'samathemes' )	=> 'yes',
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Show pagination bullets', 'samathemes' ),
			'param_name' => 'bullets',
			'std'		=> '',
			'value' => array(
					__( 'No',	'samathemes' )	=> 'no',
					__( 'Yes', 	'samathemes' )	=> 'yes',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'samathemes' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'samathemes' )
		)
	)
) );


/* Progress Bar
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Custom_Progress_Bar extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 			=> __( 'Progress Bar', 'samathemes' ),
	'base' 			=> 'vc_custom_progress_bar',
	'icon' 			=> 'icon-wpb-graph',
	'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'description' 	=> __( 'Animated progress bar', 'samathemes' ),
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'title', 'samathemes' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'value', 'samathemes' ),
			'param_name' => 'value',
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Unit', 'samathemes' ),
			'param_name' => 'unit',
			'std'		 => '%',
			'description' => __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'samathemes' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'Bar color', 'samathemes' ),
			'param_name' => 'bgcolor',
			'value' => array(
				__( 'default', 'samathemes' ) 			=> '',
				__( 'violet', 'samathemes' ) 			=> 'violet-bar',
				__( 'Orange', 'samathemes' ) 			=> 'orange-bar',
				__( 'Red', 'samathemes' ) 				=> 'red-bar',
				__( 'Dark green', 'samathemes' ) 		=> 'dark-green-bar',
				__( 'Light green', 'samathemes' ) 		=> 'light-green-bar',
				__( 'Blue', 'samathemes' ) 				=> 'blue-bar',
				__( 'Bootstrap green', 'samathemes')	=> 'progress-bar-success',
				__( 'Bootstrap Viking', 'samathemes')	=> 'progress-bar-info',
				__( 'Bootstrap Red', 'samathemes')		=> 'progress-bar-danger',
				__( 'Bootstrap Sandy brown', 'samathemes')=> 'progress-bar-warning',
				__( 'Custom Color', 'samathemes' )		=> 'custom'
			),
			'description' => __( 'Select bar background color.', 'samathemes' ),
			'admin_label' => true
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Bar custom color', 'samathemes' ),
			'param_name' => 'custombgcolor',
			'description' => __( 'Select custom background color for bars.', 'samathemes' ),
			'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
		),
	)
));

/* Custom Pricing Table
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Pricing_Column extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 			=> __( 'Pricing Column', 'samathemes' ),
	'base' 			=> 'vc_pricing_column',
	'icon' 			=> 'vc_icon_feature',
	'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'description' 	=> __( 'Pricing column for Pricing Table', 'samathemes' ),
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'title', 'samathemes' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display hot icon', 'samathemes' ),
			'param_name' 	=> 'hoticon',
			'std'			=> '',
			'value' 		=> array(
								__( 'No', 'samathemes' ) 			=> '',
								__( 'Yes', 'samathemes' ) 			=> 'yes',
							),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Column Style', 'samathemes' ),
			'param_name' 	=> 'column_style',
			'std'			=> '',
			'value' 		=> array(
								__( 'Dark',			'samathemes' )	=> '',
								__( 'Theme Color', 	'samathemes' )	=> 'active',
								__( 'Green',		'samathemes' )	=> 'green-price',
								__( 'Dark Blue',	'samathemes' )	=> 'wet-asphelt-price'
							),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Price', 'samathemes' ),
			'param_name' 	=> 'price',
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Currency', 'samathemes' ),
			'param_name'	=> 'currency',
			'std'			=> '%',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Price subtitle', 'samathemes' ),
			'param_name' 	=> 'price_subtitle',
			'std'			=> 'per month',
		),
		array(
			'type' 			=> 'exploded_textarea',
			'heading' 		=> __( 'Pricing Features', 'samathemes' ),
			'param_name' 	=> 'features',
			'description' 	=> __( 'Input price column features here. Divide values with linebreaks (Enter)', 'samathemes'),
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Button Text', 'samathemes'),
			'param_name' 	=> 'btn_text',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Button URL', 'samathemes'),
			'param_name' 	=> 'url',
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Link target', 'samathemes'),
			'param_name' 	=> 'target',
			'std'			=> '_self',
			'value' 		=> $target_arr ,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Button Title Attributes ', 'samathemes'),
			'param_name' 	=> 'title_attr',
			'description' 	=> __('Optional: used of a tag attribute title ', 'samathemes'),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Extra class name', 'samathemes'),
			'param_name' 	=> 'el_class',
			'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
		),		
	)
));

/* Tree Container
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vc_Tree_Container extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Tree_Box extends WPBakeryShortCode {}
}
vc_map( array(
    'name' 				=> __('Tree Time line container', "samathemes"),
    'base' 				=> 'vc_tree_container',
    'as_parent' 		=> array('only' => 'vc_tree_box'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    'content_element' 	=> true,
    'show_settings_on_create' => true,
	'category'			=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    'params' => array(
       array(
            "type" => "textfield",
            "heading" => __("Extra class name", "samathemes"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    ),
	'js_view' => 'VcColumnView'
));

//	Tree Box Element
vc_map( array(
    'name' 			=> __('Tree Timeline item', 'samathemes'),
    'base' 			=> 'vc_tree_box',
    'as_child' 		=> array('only' => 'vc_tree_container'),
    'content_element' => true,
    'show_settings_on_create' => true,
	'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
    'params' 		=> array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Image Block Position', 'samathemes' ),
			'param_name' 	=> 'image_block_position',
			'value' 		=> array(
								__( 'Left', 'samathemes' ) => 'left',
								__( 'Right', 'samathemes' ) => 'right',
							),
			'description' => __( 'Choose position of block contain image.', 'samathemes' )
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> __('Upload image', 'samathemes'),
			'param_name' 	=> 'image',
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Size', 'samathemes' ),
			'param_name' 	=> 'image_size',
			'value' 		=> array(
								'' => '',
								__( '98 * 98 px', 'samathemes' ) => 'default',
							),
			'description' => __( 'If your image size great than 100 px please choose 98px option.', 'samathemes' )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Text under image', 'samathemes'),
			'param_name' 	=> 'title_first_box_1',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Second text under image', 'samathemes'),
			'param_name' 	=> 'title_first_box_2',
		),
		add_sama_animation('animation_first_box') ,
		data_animation_delay('delay_first_box'),
		array(
			'type' 			=> 'infofield',
			'heading' 		=> __('Second Block', 'samathemes'),
			'param_name' 	=> 'info_1',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'samathemes' ),
			'param_name' 	=> 'title_second_box',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'textarea',
			'heading' 		=> __('Text Under title', 'samathemes'),
			'param_name' 	=> 'txt_second_box',
		),
		add_sama_animation('animation_second_box') ,
		data_animation_delay('delay_second_box'),
        array(
            'type' 			=> 'textfield',
            'heading' 		=> __('Extra class name', 'samathemes'),
            'param_name' 	=> 'el_class',
            'description' 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "samathemes")
        )
    )
) );


/* Single Team members Block
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Single_Team_Member extends WPBakeryShortCode {}
}
global $wpdb;
$team_members = $wpdb->get_results( $wpdb->prepare("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = %s AND post_status='publish'", 'team-member') );
$members = array();
if ( $team_members ) {
	foreach ( $team_members as $member ) {
		$members[$member->post_title] = $member->ID;
	}
} else {
	$members[__( 'No team member found', 'samathemes' )] = 0;
}
vc_map( array(
	'name' 			=> __( ' Single Team members', 'samathemes' ),
	'base' 			=> 'vc_single_team_member',
	'icon' 			=> 'vc_icon_feature',
	'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'params' 		=> array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Type', 'samathemes' ),
			'param_name' => 'type',
			'std'		=> '',
			'admin_label'	=> true,
			'value' => array(
				__( 'Woo Team memebers', 'samathemes' ) => 'woo_team',
				__( 'Add Team member', 'samathemes' ) 	=> 'add_member',
			),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Display', 'samathemes' ),
			'param_name' 	=> 'display',
			'std'			=> 'leftimage',
			'admin_label'	=> true,
			'value' => array(
				__( 'Image in Left', 'samathemes' ) => 'leftimage',
				__( 'Image in Top', 'samathemes' ) 	=> 'topimage',
			),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Select team member', 'samathemes' ),
			'param_name' 	=> 'id',
			'value'			=> $members,
			'dependency'	=> array( 'element' => 'type', 'value' => array( 'woo_team' ) )
		),
		array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Excerpt Length', 'samathemes' ),
				'param_name' 	=> 'excerpt_length',
				'std'			=> 9,
				'dependency'	=> array( 'element' => 'type', 'value' => array( 'woo_team' ) )
			),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> __('Image', 'samathemes'),
			'param_name' 	=> 'image',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'title', 'samathemes' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Role', 'samathemes' ),
			'param_name' 	=> 'role',
			'description' 	=> __('Enter a byline for the team member (for example: "Director of Production").', 'samathemes'),
			'admin_label'	=> true,
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
			'type' 			=> 'textarea',
			'heading' 		=> __( 'About member', 'samathemes' ),
			'param_name' 	=> 'about',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Facebook URL', 'samathemes' ),
			'param_name' 	=> 'facebook',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Twitter URL', 'samathemes' ),
			'param_name' 	=> 'twitter',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Linkedin URL', 'samathemes' ),
			'param_name' 	=> 'linkedin',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Googleplus URL', 'samathemes' ),
			'param_name' 	=> 'googleplus',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'add_member' ) )
		),
		array(
		  'type' 			=> 'textfield',
		  'heading' 		=> __('Extra class name', 'samathemes'),
		  'param_name' 		=> 'el_class',
		  'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
		),
		
	)
) );

/* Service Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Service_Box extends WPBakeryShortCode {}
}

vc_map( array(
	'name'		=> __('Service Box', 'samathemes'),
	'base' 		=> 'vc_service_box',
	'class' 	=> 'vc_icon_feature',
	'icon' 		=> 'vc_icon_feature',
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'admin_label' => true,
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Title', 'samathemes'),
			'param_name' 	=> 'title',
			'admin_label' 	=> true
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> __('Content', 'samathemes'),
			'param_name' 	=> 'content',
			'admin_label' 	=> true
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon Active', 'samathemes'),
			'param_name' 	=> 'icon_active',
			'value' 		=> array(
								'' 	=> '',
								__('Yes', 'samathemes') 	=> 'yes',
							)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'samathemes' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
		),
		add_sama_animation() ,
		data_animation_delay(),
		array(
		  'type' => 'textfield',
		  'heading' => __('Extra class name', 'samathemes'),
		  'param_name' => 'el_class',
		  'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
		),
			
	)
));

/* Service Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Timer extends WPBakeryShortCode {}
}

vc_map( array(
	'name'		=> __('Timer', 'samathemes'),
	'base' 		=> 'vc_timer',
	'class' 	=> 'vc_timer',
	'icon' 		=> 'vc_icon_feature',
	'category'	=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
	'admin_label' => true,
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Title', 'samathemes'),
			'param_name' 	=> 'title',
			'admin_label' 	=> true,
			'description'	=> __('Not Display in frontend', 'samathemes')
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __('Add date', 'samathemes'),
			'param_name' 	=> 'date',
			'value'			=> '12/31/2015',
			'description'	=> __('Date format yy/mm/dd/ ex 2015/10/30 or ex 2015/02/09', 'samathemes')
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Background Color', 'samathemes'),
			'param_name' 	=> 'bgcolor',
			'std'			=> '',
			'value' 		=> array(
								'' 	=> '',
								__('Theme Color', 'samathemes') => 'bgblockcolor',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Hours', 'samathemes'),
			'param_name' 	=> 'hours',
			'value' 		=> array(
								'00' 	=> '0',
								'01' 	=> '1',
								'02' 	=> '2',
								'03' 	=> '3',
								'04' 	=> '4',
								'05' 	=> '5',
								'06' 	=> '6',
								'07' 	=> '7',
								'08' 	=> '8',
								'09' 	=> '9',
								'10' 	=> '10',
								'11' 	=> '11',
								'12' 	=> '12',
								'13' 	=> '13',
								'14' 	=> '14',
								'15' 	=> '15',
								'16' 	=> '16',
								'17' 	=> '17',
								'18' 	=> '18',
								'19' 	=> '19',
								'20' 	=> '20',
								'21' 	=> '21',
								'22' 	=> '22',
								'23' 	=> '23',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Minuts', 'samathemes'),
			'param_name' 	=> 'mins',
			'value' 		=> array(
								'00' 	=> '0',
								'01' 	=> '1',
								'02' 	=> '2',
								'03' 	=> '3',
								'04' 	=> '4',
								'05' 	=> '5',
								'06' 	=> '6',
								'07' 	=> '7',
								'08' 	=> '8',
								'09' 	=> '9',
								'10' 	=> '10',
								'11' 	=> '11',
								'12' 	=> '12',
								'13' 	=> '13',
								'14' 	=> '14',
								'15' 	=> '15',
								'16' 	=> '16',
								'17' 	=> '17',
								'18' 	=> '18',
								'19' 	=> '19',
								'20' 	=> '20',
								'21' 	=> '21',
								'22' 	=> '22',
								'23' 	=> '23',
								'24' 	=> '24',
								'25' 	=> '25',
								'26' 	=> '26',
								'27' 	=> '27',
								'28' 	=> '28',
								'29' 	=> '29',
								'30' 	=> '30',
								'31' 	=> '31',
								'32' 	=> '32',
								'33' 	=> '33',
								'34' 	=> '34',
								'35' 	=> '35',
								'36' 	=> '36',
								'37' 	=> '37',
								'38' 	=> '38',
								'39' 	=> '39',
								'40' 	=> '40',
								'41' 	=> '41',
								'42' 	=> '42',
								'43' 	=> '43',
								'44' 	=> '44',
								'45' 	=> '45',
								'46' 	=> '46',
								'47' 	=> '47',
								'48' 	=> '48',
								'49' 	=> '49',
								'50' 	=> '50',
								'51' 	=> '51',
								'52' 	=> '52',
								'53' 	=> '53',
								'54' 	=> '54',
								'55' 	=> '55',
								'56' 	=> '56',
								'57' 	=> '57',
								'58' 	=> '58',
								'59' 	=> '59',
							)
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> __('Content', 'samathemes'),
			'param_name' 	=> 'timer_text',
			'admin_label' 	=> true,
			'description' 	=> __('Content to display if timer expire.', 'samathemes')
		),
		array(
		  'type' => 'textfield',
		  'heading' => __('Extra class name', 'samathemes'),
		  'param_name' => 'el_class',
		  'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
		),	
	)
));

/* Support for 3rd Party plugins
---------------------------------------------------------- */
// Testimonials plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if ( is_plugin_active( 'testimonials-by-woothemes/woothemes-testimonials.php' ) ) {
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Testimonials_Owlcarousel extends WPBakeryShortCode {}
	}
	//	Testimonials OWL Carousel
	vc_map( array(
		'name' 			=> __( 'Testimonials carousel', 'samathemes' ),
		'base' 			=> 'vc_testimonials_owlcarousel',
		'icon' 			=> 'vc_icon_feature',
		'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
		'params' 		=> array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Testimonials carousel type', 'samathemes' ),
				'param_name' 	=> 'type',
				'std'			=> '',
				'admin_label'	=> true,
				'value' 		=> array(
									__( 'With thumbnails', 'samathemes' ) 		=> 'with_thumb',
									__( 'Without thumbnails', 'samathemes' ) 	=> 'without_thumb',
								),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Display', 'samathemes' ),
				'param_name' 	=> 'display',
				'value' 		=> array(
									__( 'Recent testimonials', 'samathemes' ) 	=> 'recent',
									__( 'Testimonials by ID', 'samathemes' ) 	=> 'id',
								),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Number of testimonials', 'samathemes' ),
				'param_name'	=> 'num',
				'value' 		=> 4,
				'dependency' 	=> array( 'element' => 'display','value' => array( 'recent' ) )
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'testimonials IDS', 'samathemes' ),
				'param_name' 	=> 'ids',
				'description' 	=> __('use comma to Separates between ids.', 'samathemes'),
				'dependency' 	=> array( 'element' => 'display','value' => array( 'id' ) )
			),
			array(
			  'type' 			=> 'textfield',
			  'heading' 		=> __('Extra class name', 'samathemes'),
			  'param_name' 		=> 'el_class',
			  'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
			),
			
		)
	));
	
	// Single Testimonials
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Single_Testimonial extends WPBakeryShortCode {}
	}
	global $wpdb;
	$testimonials_posts = $wpdb->get_results( $wpdb->prepare("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = %s", 'testimonial') );
	$testimonials = array();
	if ( $testimonials_posts ) {
		foreach ( $testimonials_posts as $testimonial ) {
			$testimonials[$testimonial->post_title] = $testimonial->ID;
		}
	} else {
		$testimonials[__( 'No testimonials found', 'samathemes' )] = 0;
	}
	
	vc_map( array(
		'name' 			=> __( ' Single testimonial', 'samathemes' ),
		'base' 			=> 'vc_single_testimonial',
		'icon' 			=> 'vc_icon_feature',
		'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
		'params' 		=> array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Testimonial type', 'samathemes' ),
				'param_name' 	=> 'type',
				'std'			=> '',
				'admin_label'	=> true,
				'value' 		=> array(
									__( 'With thumbnails', 'samathemes' ) 		=> 'with_thumb',
									__( 'Without thumbnails', 'samathemes' ) 	=> 'without_thumb',
								),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Select Testimonial', 'samathemes' ),
				'param_name' 	=> 'id',
				'admin_label'	=> true,
				'value' 		=> $testimonials,
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Background Color', 'samathemes' ),
				'param_name' 	=> 'bgcolor',
				'value'			=> array(
									__('Default','samathemes') 		=> '',
									__('Grey background', 'samathemes')	=> 'second-bg',
								)
			),
			array(
			  'type' 			=> 'textfield',
			  'heading' 		=> __('Extra class name', 'samathemes'),
			  'param_name' 		=> 'el_class',
			  'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
			),
			
		)
	) );
}

// TeamMembers plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if ( is_plugin_active( 'our-team-by-woothemes/woothemes-our-team.php' ) ) {
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Team_Members_Carousel extends WPBakeryShortCode {}
	}
	vc_map( array(
		'name' 			=> __( 'Team members carousel', 'samathemes' ),
		'base' 			=> 'vc_team_members_carousel',
		'icon' 			=> 'vc_icon_feature',
		'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
		'params' 		=> array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Display', 'samathemes' ),
				'param_name' 	=> 'display',
				'value' 		=> array(
									__( 'Recent team members', 'samathemes' ) 	=> 'recent',
									__( 'Team members by ID', 'samathemes' ) 	=> 'id',
								),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Number of members', 'samathemes' ),
				'param_name' 	=> 'num',
				'value' 		=> 4,
				'dependency' 	=> array( 'element' => 'display','value' => array( 'recent' ) )
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Order ', 'samathemes' ),
				'param_name' 	=> 'order',
				'std'			=> 'DESC',
				'value'			=> array(
									'ASC' 	=> 'ASC',
									'DESC'	=> 'DESC',
								)
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'OrderBy ', 'samathemes' ),
				'param_name' 	=> 'orderby',
				'std'			=> 'date',
				'value'			=> array(
									__( 'ID', 		'samathemes' ) 	=> 'ID',
									__( 'Author', 	'samathemes' ) 	=> 'author',
									__( 'Title', 	'samathemes' ) 	=> 'title',
									__( 'Name', 	'samathemes' ) 	=> 'name',
									__( 'Date', 	'samathemes' ) 	=> 'date',
									__( 'Rand', 	'samathemes' ) 	=> 'rand',
									__( 'Menu Order', 'samathemes' ) => 'menu_order',
								)
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Team members IDS', 'samathemes' ),
				'param_name' 	=> 'ids',
				'description' 	=> __('use comma to Separates between ids.', 'samathemes'),
				'dependency' 	=> array( 'element' => 'display','value' => array( 'id' ) )
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Excerpt Length', 'samathemes' ),
				'param_name' 	=> 'excerpt_length',
				'std'			=> 9
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __('Extra class name', 'samathemes'),
				'param_name' 	=> 'el_class',
				'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
			),
			
		)
	) );
}

// Portfolio
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if ( is_plugin_active( 'projects-by-woothemes/projects.php' ) ) {
	
	// Portfolio FullWidth
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Portfolio_fullwidth extends WPBakeryShortCode {}
	}
	vc_map( array(
		'name' 			=> __( 'Portfolio Full Width', 'samathemes' ),
		'base' 			=> 'vc_portfolio_fullwidth',
		'icon' 			=> 'vc_icon_feature',
		'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
		'admin_label'	=> true,
		'params' => array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Type', 'samathemes' ),
				'param_name' 	=> 'type',
				'std'			=> 'fullwidthwithouttext',
				'value'			=> array(
									__('Full Width',			'samathemes') 	=> 'fullwidthwithouttext',
									__('Full Width With Text', 	'samathemes')	=> 'fullwidthwithtext',
								)
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Number of portfolio', 'samathemes' ),
				'param_name' 	=> 'num',
				'value'			=> 8,
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __('Exclude categories', 'samathemes'),
				'param_name' 	=> 'exclude_cat',
				'description' 	=> __('Coma separated list of categories to exclude from display.', 'samathemes'),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Display Portfolio Filter', 'samathemes' ),
				'param_name' 	=> 'filter',
				'std'			=> 'yes',
				'value' 		=> array(
									__( 'Yes', 'samathemes' ) 	=> 'yes',
									__( 'No', 'samathemes' ) 	=> 'no',
								),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Display view more link', 'samathemes' ),
				'param_name' 	=> 'view_more',
				'std'			=> 'yes',
				'value' 		=> array(
									__( 'Yes', 'samathemes' ) 	=> 'yes',
									__( 'No', 'samathemes' ) 	=> 'no',
								),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __('Extra class name', 'samathemes'),
				'param_name' 	=> 'el_class',
				'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
			),
		)
	));
	// Portfolio Grid
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Portfolio_Grid extends WPBakeryShortCode {}
	}
	vc_map( array(
		'name' 			=> __( 'Portfolio Grid', 'samathemes' ),
		'base' 			=> 'vc_portfolio_grid',
		'icon' 			=> 'vc_icon_feature',
		'category'		=>	array( __('By SamaThemes', 'samathemes'),__('Content', 'samathemes') ),
		'admin_label'	=> true,
		'params' => array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Type', 'samathemes' ),
				'param_name' 	=> 'type',
				'std'			=> '4colwithouttext',
				'value'			=> array(
									__('Grid 2 Column',				'samathemes') 	=> '2colwithouttext',
									__('Grid 2 Column With Text', 	'samathemes')	=> '2colwithtext',
									__('Grid 3 Column',				'samathemes') 	=> '3colwithouttext',
									__('Grid 3 Column With Text', 	'samathemes')	=> '3colwithtext',
									__('Grid 4 Column',				'samathemes') 	=> '4colwithouttext',
									__('Grid 4 Column With Text', 	'samathemes')	=> '4colwithtext',
								)
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __( 'Number of portfolio', 'samathemes' ),
				'param_name' 	=> 'num',
				'value'			=> 4,
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __('Exclude categories', 'samathemes'),
				'param_name' 	=> 'exclude_cat',
				'description' 	=> __('Coma separated list of categories to exclude from display.', 'samathemes'),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Display Portfolio Filter', 'samathemes' ),
				'param_name' 	=> 'filter',
				'std'			=> 'yes',
				'value' 		=> array(
									__( 'Yes', 'samathemes' ) 	=> 'yes',
									__( 'No', 'samathemes' ) 	=> 'no',
								),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Display view more link', 'samathemes' ),
				'param_name' 	=> 'view_more',
				'std'			=> 'yes',
				'value' 		=> array(
									__( 'Yes', 'samathemes' ) 	=> 'yes',
									__( 'No', 'samathemes' ) 	=> 'no',
								),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> __('Extra class name', 'samathemes'),
				'param_name' 	=> 'el_class',
				'description' 	=> __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'samathemes'),
			),
		)
	));
}
?>