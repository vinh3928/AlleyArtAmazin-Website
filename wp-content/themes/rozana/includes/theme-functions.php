<?php

$sama_options = wp_parse_args( 
    get_option( 'rozana', array() ), 
    sama_get_option_defaults() 
);

/* Define Theme Version */
define( 'SAMA_THEME_VER', '1.7');

/* Define Parent Theme Constants */
define( 'SAMA_THEME_DIR', get_template_directory());
define( 'SAMA_THEME_URI', get_template_directory_uri() );
define( 'SAMA_INC_DIR', trailingslashit( SAMA_THEME_DIR ). 'includes' );

/* Define Child Theme Constants */
define( 'THEME_DIR', get_stylesheet_directory() );
define( 'THEME_URI', get_stylesheet_directory_uri() );



/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/
$includes = array(
	'includes/widgets/class-widget-tabs.php',
	'includes/widgets/class-widget-ads.php',
	'includes/widgets/class-widget-shareicon.php',
	'includes/widgets/class-widget-recent-comment-with-avater.php',
	'includes/widgets/class-widget-facebook.php',
	'includes/widgets/class-widget-flickr.php',
	'includes/theme-custom-css-js.php',
);
if( isset( $sama_options['enable_custom_fonts'] ) && $sama_options['enable_custom_fonts'] ) {
	$load_custom_fonts = array(
		'includes/theme-custom-fonts.php',
	);
	$includes = array_merge($includes,$load_custom_fonts);
}
if( isset( $sama_options['enable_custom_color'] ) && $sama_options['enable_custom_color'] ) {
	$load_custom_color = array(
		'includes/theme-custom-css-color.php',
	);
	$includes = array_merge($includes,$load_custom_color);
}
if( isset( $sama_options['enable_typography'] ) && $sama_options['enable_typography'] ) {
	$load_custom_typography = array(
		'includes/theme-custom-typography.php',
	);
	$includes = array_merge($includes,$load_custom_typography);
}
if ( ! is_admin() ) {
	$includes_menu = array(
		'includes/walker-menu.php',
	);
	$includes = array_merge($includes,$includes_menu);
}
if ( is_admin() ) {
	$includes_admin = array(
		'includes/theme-options/theme-options.php',
		'includes/tgm-plugin-activation/class-tgm-plugin-activation.php',
		'includes/tgm-plugin-activation/rozana-plugin.php',
	);
	$includes = array_merge($includes,$includes_admin);
}

foreach ( $includes as $i ) {

	locate_template( $i, true, true );
}

/*
 *	Initialising Visual shortcode editor
 */
if (class_exists('WPBakeryVisualComposerAbstract')) {
	function sama_requireVcExtend(){
		include_once( get_template_directory().'/includes/vc-extend/extend-vc.php');
	}
	add_action('init', 'sama_requireVcExtend',2);
}

/*
 *	Initialize the metabox class
 */
function sama_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) && is_admin() ) {
		require_once( SAMA_INC_DIR .'/meta-box/theme-meta-box.php' );
	}
}
add_action( 'init', 'sama_initialize_cmb_meta_boxes', 9999 );

/*
 *	Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) $content_width = 870;

function sama_content_width() {

	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 1170;
	} elseif( function_exists('is_project') && is_project() ) {
		$GLOBALS['content_width'] = 1170;
	} elseif( is_page() ) {
		if( is_page_template( 'page-templates/page-fullwidth.php' ) || is_page_template( 'page-templates/page-fullwidth-shortcode.php' ) ){
			$GLOBALS['content_width'] = 1170;
		} elseif( is_page_template( 'page-templates/page-2sidebar.php' ) ) {
			$GLOBALS['content_width'] = 570;
		}
	} elseif( is_single() ) {
		global $post;
		$post_layout = get_post_meta( $post->ID, '_sama_page_layout', true );
		if( $post_layout == '2sidebar' ) {
			$GLOBALS['content_width'] = 570;
		} elseif( $post_layout == 'fullwidth' ) {
			$GLOBALS['content_width'] = 1170;
		}
	}
}
add_action( 'template_redirect', 'sama_content_width' );

/*
 *	Enqueues scripts and styles for front-end.
 */
if ( ! function_exists ( 'sama_enqueue_scripts_styles' ) ) {
	function sama_enqueue_scripts_styles() {
		global $post, $sama_options;
		
		/*
		 *	Google Fonts
		 */
		wp_register_style( 'Open-Sans', 			'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700');
		wp_register_style( 'Oswald', 				'http://fonts.googleapis.com/css?family=Oswald:400,700,300');
		wp_register_style( 'Open-Sans-Condensed', 	'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic');
		if( isset( $sama_options['enable_custom_fonts'] ) && $sama_options['enable_custom_fonts'] ) {
		} else {
			wp_enqueue_style('Open-Sans');
			wp_enqueue_style('Oswald');
			wp_enqueue_style('Open-Sans-Condensed');
		}
		
		/*
		 * Fonts Icon
		 */
		wp_enqueue_style( 'font-awesome', 	SAMA_THEME_URI .'/css/fontawesome/font-awesome.css', '', '4.2.0');
		wp_enqueue_style( 'icomoon', 		SAMA_THEME_URI .'/css/icomoon/icomoon.css', '', SAMA_THEME_VER);
		
		// Register Styles
		wp_register_style( 'patternlight', 			SAMA_THEME_URI .'/css/home/patternlight.css', '', SAMA_THEME_VER);
		wp_register_style( 'patterndark', 			SAMA_THEME_URI .'/css/home/patterndark.css', '', SAMA_THEME_VER);
		wp_register_style( 'supersized', 			SAMA_THEME_URI .'/css/slider/supersized.css', array('bootstrap-custom'), SAMA_THEME_VER);
		wp_register_style( 'supersized.shutter', 	SAMA_THEME_URI .'/css/slider/supersized.shutter.css', array('supersized'), SAMA_THEME_VER);
		wp_register_style( 'videobackground', 		SAMA_THEME_URI .'/css/jquery.videobackground.css', array('bootstrap-custom'), SAMA_THEME_VER);
		wp_register_style( 'owl-carousel', 			SAMA_THEME_URI .'/css/carousal/owl.carousel.css', array('bootstrap-custom'), SAMA_THEME_VER);
		wp_register_style( 'owl-theme', 			SAMA_THEME_URI .'/css/carousal/owl.theme.css', array('owl-carousel'), SAMA_THEME_VER);
		
		// Enqueue styles
		wp_enqueue_style( 'bootstrap-min', 		SAMA_THEME_URI .'/css/bootstrap/bootstrap.min.css', '', '3.1.1');
		wp_enqueue_style( 'bootstrap-custom', 	SAMA_THEME_URI .'/css/bootstrap/bootstrap-custom.css', array('bootstrap-min'), SAMA_THEME_VER);
		wp_enqueue_style( 'fancybox', 			SAMA_THEME_URI .'/js/fancybox/jquery.fancybox.css', '', '2.1.5');
		wp_enqueue_style( 'fancybox-thumbs', 	SAMA_THEME_URI .'/js/fancybox/helpers/jquery.fancybox-thumbs.css', '', '2.1.5');
		wp_enqueue_style( 'animate', 			SAMA_THEME_URI .'/css/animate.css', '', SAMA_THEME_VER);
		wp_enqueue_style( 'theme-font', 		SAMA_THEME_URI .'/css/font.css', '', SAMA_THEME_VER);		
		
		/*
		 *	Register Scripts
		 */
		wp_register_script( 'video-background',  			SAMA_THEME_URI .'/js/video_plugin/jquery.videobackground.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script( 'youtube-video-background',  	SAMA_THEME_URI .'/js/video_plugin/jquery.mb.YTPlayer.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script( 'google-maps',  				'https://maps.googleapis.com/maps/api/js?key=&amp;sensor=false&amp;extension=.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script( 'owl-carousel',  				SAMA_THEME_URI .'/js/carousal/owl.carousel.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script( 'counterup',  					SAMA_THEME_URI .'/js/jquery.counterup.min.js', '', '1.0', true);
		wp_register_script( 'supersized',  					SAMA_THEME_URI .'/js/slider/superized/supersized.3.2.7.min.js', array('jquery'), '3.2.7', true);
		wp_register_script( 'supersized.shutter',  			SAMA_THEME_URI .'/js/slider/superized/supersized.shutter.min.js', array('jquery'), '3.2.7', true);
		wp_register_script( 'jflickrfeed',  				SAMA_THEME_URI .'/js/jflickrfeed.min.js', '', SAMA_THEME_VER, true);
		wp_register_script( 'jflickrfeed.init',  			SAMA_THEME_URI .'/js/jflickrfeed.init.js', '', SAMA_THEME_VER, true);
		wp_register_script( 'movebg',  						SAMA_THEME_URI .'/js/move.bg.js', '', SAMA_THEME_VER, true);
		wp_register_script( 'zooming',  					SAMA_THEME_URI .'/js/slider/mb_bg/mb.bgndGallery.js', array('jquery'), '3.2.7', false);
		wp_register_script( 'cbpBGSlideshow-js',  			SAMA_THEME_URI .'/js/slider/cbp_bg_slideshow/cbpBGSlideshow.min.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script( 'imagesloaded',  				SAMA_THEME_URI .'/js/slider/cbp_bg_slideshow/jquery.imagesloaded.min.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script( 'timer',  						SAMA_THEME_URI .'/js/timer.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script( 'isotope',  			SAMA_THEME_URI .'/js/jquery.isotope.js', '', '1.5.25', true); // theme used in vc
		/*
		 *	Enqueue Scripts
		 */
		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'bootstrap',  		SAMA_THEME_URI .'/js/bootstrap.min.js', '', '3.1.1', true);
		wp_enqueue_script( 'modernizr',  		SAMA_THEME_URI .'/js/modernizr.js', '', '2.6.2', true);
		wp_enqueue_script( 'easing',  			SAMA_THEME_URI .'/js/jquery.easing.1.3.js', '', '1.3', true);
		wp_enqueue_script( 'mousewheel',  		SAMA_THEME_URI .'/js/jquery.mousewheel.js', '', '3.0.6', true);
		wp_enqueue_script( 'retina',  			SAMA_THEME_URI .'/js/retina.js', '', '0.0.2', true);
		wp_enqueue_script( 'appear',  			SAMA_THEME_URI .'/js/jquery.appear.js', '', SAMA_THEME_VER, true);
		wp_enqueue_script( 'fancybox',  		SAMA_THEME_URI .'/js/fancybox/jquery.fancybox.js', '', '2.1.5', true);
		wp_enqueue_script( 'fancybox-media',  	SAMA_THEME_URI .'/js/fancybox/helpers/jquery.fancybox-media.js', '', '2.1.5', true);
		wp_enqueue_script( 'fancybox-thumbs', 	SAMA_THEME_URI .'/js/fancybox/helpers/jquery.fancybox-thumbs.js', '', '2.1.5', true);
		wp_enqueue_script( 'waypoints',  		SAMA_THEME_URI .'/js/waypoints.min.js', '', '2.0.3', true); // theme used in vc
		wp_enqueue_script( 'nicescroll',  		SAMA_THEME_URI .'/js/jquery.nicescroll.min.js', '', '3.5.4', true);
		wp_enqueue_script( 'ticker',  			SAMA_THEME_URI .'/js/ticker.js', '', SAMA_THEME_VER, true);
		wp_enqueue_script( 'stellar',  			SAMA_THEME_URI .'/js/jquery.stellar.js', '', SAMA_THEME_VER, true);
		wp_enqueue_script( 'video-devices',  	SAMA_THEME_URI .'/js/video_plugin/device.min.js', '', SAMA_THEME_VER, true);
		wp_enqueue_script( 'video-vidscale',  	SAMA_THEME_URI .'/js/video_plugin/vidscale.js', '', SAMA_THEME_VER, true);
		
		if( $sama_options['blog_type'] == 'masonry' || $sama_options['blog_type'] == 'grid' ) {
			wp_enqueue_script('imagesloaded');
			wp_enqueue_script('masonry');
			wp_enqueue_script('isotope');
		}
		if( ( function_exists('is_projects_archive') && is_projects_archive() ) || ( function_exists('is_project_category') && is_project_category() ) ) {
			wp_enqueue_script('imagesloaded');
			wp_enqueue_script('masonry');
			wp_enqueue_script('isotope');
		}
		
		if( is_page() && isset($post->post_content) ) {
		
			if( has_shortcode( $post->post_content, 'sama_counter') || has_shortcode( $post->post_content, 'vc_counter') ) {
				wp_enqueue_script('counterup');
			}
			if( has_shortcode( $post->post_content, 'vc_add_gmaps') || has_shortcode( $post->post_content, 'sama_gmaps') ) { 
				wp_enqueue_script('google-maps');
			}
			if( has_shortcode( $post->post_content, 'vc_images_owl_carousel') || has_shortcode( $post->post_content, 'vc_team_members_carousel') || has_shortcode( $post->post_content, 'vc_testimonials_owlcarousel') ) { 
				wp_enqueue_style('owl-theme');
				wp_enqueue_script('owl-carousel');
			}
			if( has_shortcode( $post->post_content, 'vc_timer') || has_shortcode( $post->post_content, 'sama_timer') ) { 
				wp_enqueue_script('timer');
			}
			if( has_shortcode( $post->post_content, 'vc_portfolio_fullwidth') || has_shortcode( $post->post_content, 'vc_portfolio_grid') ) {
				wp_enqueue_script('imagesloaded');
				wp_enqueue_script('masonry');
				wp_enqueue_script('isotope');
			}
			if( has_shortcode( $post->post_content, 'vc_row') )  {
				if( strpos( $post->post_content, 'bgtype="video"' ) !== false) {
					wp_enqueue_style('videobackground');
					wp_enqueue_script('video-background');
				}
			}
		}
		
		$page_id = sama_get_current_page_id();
		if( isset( $page_id ) && $page_id != -1 ) {
			$bg_animation = get_post_meta( $page_id, '_sama_bg_animation', true );		
			if( $bg_animation == 'movement' ) {
				wp_enqueue_script( 'movebg');
			}
		}
		
		if( isset( $page_id ) && $page_id != -1 ) {
			$slider_type 		= get_post_meta( $page_id, '_sama_slider_type', true );
			if( ! empty ( $slider_type ) || $slider_type != 'no' ) {
				if( $slider_type == 'supersized' ) {
					wp_enqueue_style('supersized');
					wp_enqueue_style('supersized.shutter');
					wp_enqueue_script('supersized');
					wp_enqueue_script('supersized.shutter');
				} elseif( $slider_type == 'zooming' ) {
					wp_enqueue_script('zooming');
				} elseif( $slider_type == 'fullscreenslidercbg' ||  $slider_type == 'fullwidthslidercbg') {
					wp_enqueue_script('imagesloaded');
					wp_enqueue_script( 'cbpBGSlideshow-js');
				} elseif( $slider_type == 'fullscreenbg' ) {
				} elseif( $slider_type == 'patterndark' ) {
					wp_enqueue_style('patterndark');
				} elseif( $slider_type == 'patternlight' ) {
					wp_enqueue_style('patternlight');
				} elseif( $slider_type == 'movementbg' ) {
					wp_enqueue_style('portfolio-slider');
					wp_enqueue_script( 'movebg');
				} elseif( $slider_type == 'html5videoslider' ) {
					wp_enqueue_style('videobackground');
					wp_enqueue_script( 'video-background' );
				} elseif( $slider_type == 'youtubevideobg' ) {
					wp_enqueue_script('youtube-video-background');
				}
			}
		}
		
		wp_enqueue_style( 'style', 				get_stylesheet_uri(), '', SAMA_THEME_VER);
		if( isset( $sama_options['themestyle'] ) && $sama_options['themestyle'] == 'dark'  ) {			
			wp_enqueue_style( 'dark', 	SAMA_THEME_URI .'/css/theme/dark.css', '', SAMA_THEME_VER);
		} else {
			wp_enqueue_style( 'light', 	SAMA_THEME_URI .'/css/theme/light.css', '', SAMA_THEME_VER);
		}
		if( isset( $sama_options['enable_custom_color'] ) && $sama_options['enable_custom_color'] ) {
		} else {
			if( isset( $sama_options['themecolor'] ) && ! empty( $sama_options['themecolor'] ) && $sama_options['themecolor'] != 'alizarin'  ) {
				wp_enqueue_style( $sama_options['themecolor'], 			SAMA_THEME_URI .'/css/color/'. esc_attr( $sama_options['themecolor'] ) .'.css', '', SAMA_THEME_VER);
			} else {
				wp_enqueue_style( 'alizarin', SAMA_THEME_URI .'/css/color/alizarin.css', '', SAMA_THEME_VER);
			}
		}
		wp_enqueue_style( 'responsive', 		SAMA_THEME_URI .'/css/responsive.css', '', SAMA_THEME_VER);
		wp_enqueue_style( 'slider-block', 		SAMA_THEME_URI .'/css/top-slider-block.css', '', SAMA_THEME_VER);
		
		
		if ( !is_front_page() && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script('comment-reply');
		}
		wp_enqueue_script( 'theme-script',  	SAMA_THEME_URI .'/js/theme-scripts.js', '', SAMA_THEME_VER, true);
	}
}
add_action( 'wp_enqueue_scripts', 'sama_enqueue_scripts_styles', 10);

/*
 *	Admin Enqueue scripts  
 *	Used for VC Elments
 */

function sama_admin_theme_enqueue_styles($hook) {
    if ( 'edit.php' != $hook ) {
        wp_enqueue_style( 'font-awesome', 	SAMA_THEME_URI .'/css/fontawesome/font-awesome.css', '', '4.2.0');
		wp_enqueue_style( 'icomoon', 		SAMA_THEME_URI .'/css/icomoon/icomoon.css', '', SAMA_THEME_VER);
		wp_enqueue_style( 'icon-select', 	SAMA_THEME_URI .'/css/admin/icon-select.css', '', SAMA_THEME_VER);
    }
}

add_action( 'admin_enqueue_scripts', 'sama_admin_theme_enqueue_styles' );

/*
 *	More Link
 */
function sama_excerpt_more( $more ) {
	global $sama_options;
	global $post;
	$blog_type = $sama_options['blog_type'];
	$format = get_post_format( $post->ID );
	if( $post->post_type == 'post' && $format == 'quote' ) {
		return '';
	} elseif( ( $blog_type == 'list' || $blog_type == 'bigthumbnails' || $blog_type == 'bigthumbwithsidebar' ) && $post->post_type == 'post' ) {
		return ' ...';
	} elseif ( $post->post_type == 'team-member' ) {
		return '';
	}
	return '... [<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('read more', 'samathemes') . '</a>]';
}
add_filter( 'excerpt_more', 'sama_excerpt_more' );

/*
 *	EXcerpt Length
 */
function sama_custom_excerpt_length( $length ) {
	global $sama_options;
	global $post;
	$blog_type = $sama_options['blog_type'];
	if ( $blog_type == 'grid' && $post->post_type == 'post' ) {
	
		if( isset( $sama_options['grid_excerpt'] ) && $sama_options['grid_excerpt'] > 1 ) {
			return $sama_options['grid_excerpt'];
		} else {
			return 16;
		}
	} elseif ( $blog_type == 'list' && $post->post_type == 'post' ) {
	
		if( isset( $sama_options['list_excerpt'] ) && $sama_options['list_excerpt'] > 1 ) {
			return $sama_options['list_excerpt'];
		} else {
			return 45;
		}
	} elseif ( ( $blog_type == 'bigthumbnails' || $blog_type == 'bigthumbwithsidebar' ) && $post->post_type == 'post' ) {
	
		if( isset( $sama_options['bigthumbnails_excerpt'] ) && $sama_options['bigthumbnails_excerpt'] > 1 ) {
			return $sama_options['bigthumbnails_excerpt'];
		} else {
			return 75;
		}
	} elseif ( $post->post_type == 'team-member' ) {
		return 9;
	}
	return $length;
}

add_filter( 'excerpt_length', 'sama_custom_excerpt_length', 999 );

/*
 * Custom Excerpt
 * since 1.3
 */
function sama_custom_excerpt($excerpt_length = 20, $new_more = '...') {
	
	$content = get_the_content();
	$content = strip_shortcodes($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	$excerpt_length = absint( $excerpt_length );
	$words = explode(' ', $content, $excerpt_length + 1);
	if( count( $words ) > $excerpt_length ) {
		array_pop($words);
		$content = implode(' ', $words);
	}
 
  // wrap it back up in p tags
  $output = '<p>'. $content .'</p>';
  // the above line may not be needed depending on the status of wpautop
 
  // echo that sucker
  echo $output;
}

/**
 *	Sets up theme defaults and 
 *  registers the various WordPress features thattheme support 
 *	
 * @since Rozana 1.0
 */
if ( ! function_exists ( 'samathemes_setup' ) ) {
	function samathemes_setup() {
		/*
		 * Make Rozana available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Rozana, use a find and
		 * replace to change 'rozana' to the name of your theme in all
		 * template files.
		 */
		load_theme_textdomain( 'samathemes', get_template_directory() . '/languages' );
		
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		
		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );
				
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top-menu' 			=> __( 'Top Menu', 'samathemes' ),
			'one-page-menu' 	=> __( 'One Page Menu', 'samathemes' ),
			'landing-page-menu' => __( 'Landing Page Menu', 'samathemes' ),
		) );
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		
		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-grid-thumb', 		520, 520, true);			// Blog Grid Thumbnail
		add_image_size( 'blog-big-thumb', 		1170, 420, true);  		// Blog Big Thumbnails without thumbnails
		add_image_size( 'single-client-image', 	300, 120, true);
		add_image_size( 'testimonial-thumb', 	130, 130, true); 		// testimonial Thumb for slider and team members
		add_image_size( 'owl-screenshot-thumb', 270, 270, true);
		add_image_size( 'portfolio-thumb-344', 	344, 344, true);
		add_image_size( 'portfolio-thumb-570', 	570, 570, true);
		add_image_size( 'portfolio-thumb-370', 	370, 370, true);
		add_image_size( 'portfolio-thumb-450', 	450, 450, true);
		add_image_size( 'portfolio-thumb-1170', 1170, 585, true); 	//single portfolio
	}
}
add_action( 'after_setup_theme', 'samathemes_setup' );

/*
 *	Support title tag for Old Wordpress Version < 4.1
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function sama_theme_slug_render_title() {
?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'sama_theme_slug_render_title' );
}

if ( ! function_exists( 'sama_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Rozana 1.0
 */
function sama_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'type'	   => 'list',
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => '<span class="icon-arrow-left9"></span>',
		'next_text' => '<span class="icon-arrow-right9"></span>',
	) );

	if ( $links ) :
		$links = str_replace( "<ul class='page-numbers'>", '<ul class="pagination pagination-lg">', $links );
	?>
	<nav class="navigation" role="navigation">
		<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

/**
 * Registers our main widget area.
 *
 * @since Rozana 1.0
 */
if ( ! function_exists ( 'sama_widgets_init' ) ) {

	function sama_widgets_init() {
		// default sidebar
		register_sidebar( array(
			'name' 			=> __( 'Default Sidebar', 'samathemes' ),
			'id' 			=> 'sidebar',
			'description' 	=> __( 'Appears on all posts and pages.', 'samathemes' ),
			'before_widget' => '<aside id="%1$s" class="marg-divider animated widget %2$s" data-animation="fadeInUp">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<div class="head-sidebar"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar( array(
			'name' 			=> __( 'Sidebar 2', 'samathemes' ),
			'id' 			=> 'sidebar-2',
			'description' 	=> __( 'Appears as second sidebar when you choose post with two side bar.', 'samathemes' ),
			'before_widget' => '<aside id="%1$s" class="marg-divider animated widget %2$s" data-animation="fadeInUp">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<div class="head-sidebar"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		//Footer
		register_sidebars( 4, array(
			'name'          => 'Footer %d',
			'id'            => 'footer',
			'description' 	=> __( 'The sidebar for footer widget.', 'samathemes' ),
			'class'         => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="titleHeader clearfix"><h3 class="widget-title">',
			'after_title'   => '</h3></div>' 
		));
	}
}
add_action( 'widgets_init', 'sama_widgets_init' );

/*
 * Widget Tags
 * make largest and smallest fontsize for tags as same.
 *
 * @since rozana 1.0
 */
if ( ! function_exists ( 'sama_widget_tag_cloud_args' ) ) {

	function sama_widget_tag_cloud_args( $args ) {
		$args['largest'] = 13; // make largest and smallest the same - i don't like the varying font-size look
		$args['smallest'] = 13;
		$args['unit'] = 'px';
		return $args;
	}
}

add_filter( 'widget_tag_cloud_args', 'sama_widget_tag_cloud_args' ); // WP Default tag widget

/*
 * Post view plugin
 * Display post views if plugin exists
 *
 * @since rozana 1.0
 */
function sama_post_view() {
	global $post;
	$post_views = intval( get_post_meta( $post->ID, 'views', true ) );
	if( $post_views > 0 ) {
		echo '<span class="icon-eye"></span> '. absint( $post_views );
	}
	return '';
}

if ( ! function_exists ( 'sama_display_post_meta' ) ) {
	function sama_display_post_meta() {
		global $sama_options;
			if( isset( $sama_options['display_author_archive'] ) && $sama_options['display_author_archive'] ) {
		?>
				<span class="icon-user"></span> <?php _e('By', 'samathemes'); ?> <?php the_author_posts_link(); ?>
		<?php
			}
			if( isset( $sama_options['display_tags_archive'] ) && $sama_options['display_tags_archive'] ) {
				the_tags( '<span class="icon-tag"></span>', ', ', '');
			}
				sama_post_view();
			if( isset( $sama_options['display_comments_archive'] ) && $sama_options['display_comments_archive'] ) {
		?>
				<span class="icon-comment"></span> <?php comments_popup_link('0', '1', '%'); ?>
		<?php
		}
	
	}
}

/*
 * Out put HTML5 Time Format
 */
function sama_output_html5_time_format() {
	$post_id = get_the_id();
	$html_sticky = '';
	if ( is_sticky() && is_home() && ! is_paged() ) {
		$html_sticky = '<span class="flag-sticky">'. __('Featured', 'samathemes') .'</span>';
	}
	echo $html_sticky . '<span><time class="entry-date" datetime="'. esc_attr( get_the_date( 'c', $post_id ) ) .'">'. esc_attr( get_the_date('j', $post_id) ) .' <br>'. esc_attr( get_the_date('M', $post_id) ) .'</time></span>';
}
/*
 *	Used to Add any content in end of single portfolio
 */
function sama_after_single_portfolio_recent() {
	global $sama_options;
	if( isset( $sama_options['single_portfolio_after_recent'] ) && ! empty( $sama_options['single_portfolio_after_recent'] ) ) {
		$output  = '<section class="theme-color pad-top-bottom"><div class="container"><div class="row"><div class="col-md-12 animated" data-animation="fadeIn">';
		$patterns  = array('#^\s*</p>#','#<p>\s*$#');
        $content   = do_shortcode( $sama_options['single_portfolio_after_recent'] );
		$output   .= preg_replace($patterns, '', $content);  
        $output   .= '</div></div></div></section>';
		$allowed_tags = sama_allowed_html();
		echo wp_kses( $output, $allowed_tags );
	}
}
add_action('sama_after_single_portfolio_recent', 'sama_after_single_portfolio_recent');

/*
 *	Return Current Page ID
 */
function sama_get_current_page_id() {
	$current_page = -1;
	if ( is_front_page() && is_home() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif ( is_front_page() ) {
		$page_id = get_option('page_on_front');
		if( ! empty( $page_id ) && $page_id != -1 ) {
			$current_page = $page_id;
		}
	} elseif ( is_home() ) {
		// Blog page
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif ( ( function_exists('is_projects_archive') && is_projects_archive() ) || ( function_exists('is_project_category') && is_project_category() ) ) {
		$projects_page_id = projects_get_page_id( 'projects' );
		if( ! empty( $projects_page_id ) && $projects_page_id != -1 ) {
			$current_page = projects_get_page_id( 'projects' );
		}
	} elseif( is_page() ) {
		$current_page = get_the_ID();
	} elseif( function_exists( 'is_project' ) && is_project() ) {
		$current_page = get_the_ID();
	} elseif ( is_post_type_archive('post') ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	}
	
	return $current_page;
}

function sama_allowed_html() {
	$allowed_tags = wp_kses_allowed_html('post');
	$allowed_tags['input'] = array(
		'type'	=> true,
		'class'	=> true,
		'id'	=> true,
		'value'	=> true,
	);
	$allowed_tags['div'] = array(
		'align'					=> true,
		'dir'					=> true,
		'lang'					=> true,
		'xml:lang'				=> true,
		'class'					=> true,
		'id'					=> true,
		'style'					=> true,
		'align'					=> true,
		'title'					=> true,
		'role'					=> true,
		'data-animation'		=> true,
		'data-animation-delay' 	=> true,
	);
	//var_dump($allowed_tags);
	return $allowed_tags;
}

function sama_get_option_defaults() {
	$defaults = array(
		'display_load_img'				=> true,
		'menu_phone_1'					=> '',
		'menu_phone_2'					=> '',
		'logo_url'						=> '',
		'logo_url_inside_menu'			=> '',
		'vertical_logo_outside'			=> '',
		'vertical_logo_inside'			=> '',
		'favicon'						=> '',
		'apple_touch_icon_57'			=> '',
		'apple_touch_icon_72'			=> '',
		'apple_touch_icon_114'			=> '',
		'main_menu'						=> 'defaultmenu',
		'display_vertical_menu'			=> array(),
		'remove_top_header'				=> array(),
		'remove_menu_and_header'		=> array(),
		'landing_menu'					=> array(),
		'one_page_menu'					=> array(),
		'remove_phone_menu'				=> array(),
		'blog_type'						=> 'wpdefaultwithsidebar', //bigthumbwithsidebar
		'display_blog_grid_cat'			=> true,
		'display_title_in_aside'		=> 'no',
		'display_title_in_link'			=> 'no',
		'display_title_in_quote'		=> 'no',
		'video_post_view_thumb'			=> 'no',
		'gallery_post_view_thumb'		=> 'no',
		'audio_post_view_thumb'			=> 'no',
		'display_quote_in_archive'		=> 'quote',
		'display_author_archive'		=> true,
		'display_tags_archive'			=> true,
		'display_views_archive'			=> true,
		'display_comments_archive'		=> true,
		'grid_excerpt'					=> '',
		'list_excerpt'					=> '',
		'bigthumbnails_excerpt'			=> '',
		'single_display_author_bio'		=> true,
		'single_display_share_icon'		=> true,
		'single_share_facebook'			=> true,
		'single_share_twitter'			=> true,
		'single_share_pinterest'		=> true,
		'single_standard_at_top'		=> 'thumb',
		'single_aside_at_top'			=> 'thumb',
		'single_image_at_top'			=> 'thumb',
		'single_link_at_top'			=> 'thumb',
		'single_video_at_top'			=> 'video',
		'single_audio_at_top'			=> 'audio',
		'single_gallery_at_top'			=> 'gallery',
		'portfolio_type'				=> 'portfolio_fullwidth_without_text',
		'portfolio_sub_title'			=> '',
		'portfolio_display_share_icon'	=> true,
		'portfolio_display_facebook'	=> true,
		'portfolio_display_twitter'		=> true,
		'portfolio_display_pin'			=> true,
		'portfolio_display_gplus'		=> false,
		'portfolio_display_linkedin'	=> false,
		'single_portfolio_after_recent'	=> '',
		'display_top_bottom_footer'		=> true,
		'display_widegt_footer'			=> true,
		'footer_widegt_type'			=> '3columns',
		'display_bottom_footer'			=> true,
		'footer_bottom_bg'				=> 'bottom-footer',
		'footer_bottom_pad'				=> 'pad-top-bottom-20',
		'bt_footer_content'				=> '',
		'remove_top_bottom_footer'		=> array(),
		'remove_top_footer'				=> array(),
		'remove_bottom_footer'			=> array(),
		'footer_share_icon'				=> true,
		'analyticscode'					=> '',
		'themestyle'					=> 'light',
		'themecolor'					=> 'alizarin',
		'enable_custom_color'			=> false,
		'enable_custom_fonts'			=> false,
		'enable_typography'				=> false,
		'custom_css'					=> '',
		'favicon'						=> '',
		'small_defaultmenu'				=> 'yes'
	);
	
	return $defaults;
}

/* Support for 3rd Party plugins
---------------------------------------------------------- */
/*
 *	dequeue styles in projects plugin
 */
function sama_dequeue_projects_css() {
	wp_dequeue_style( 'projects-styles' ); 		// Disable general projects css
	wp_dequeue_style( 'projects-handheld' ); 	// Disable handheld projects css
	if ( function_exists('is_project') && is_project() ) {
		wp_dequeue_style( 'dashicons' ); 		// Disable dashicons
	}
}
add_action( 'wp_enqueue_scripts', 'sama_dequeue_projects_css', 999 );

/*
 *	Add more fields to Team members plugin by woothemes
 */
function sama_add_new_fields_team_members( $fields ) {
    $fields['facebook'] = array(
        'name'            => __( 'Facebook URL', 'our-team-by-woothemes' ),
        'type'            => 'text',
        'default'         => '',
		'description'     => '',
        'section'         => 'info'
    );
	$fields['googleplus'] = array(
        'name'            => __( 'Google + URL', 'our-team-by-woothemes' ),
        'type'            => 'text',
        'default'         => '',
		'description'     => '',
        'section'         => 'info'
    );
	$fields['linkedin'] = array(
        'name'            => __( 'Linked in URL', 'our-team-by-woothemes' ),
        'type'            => 'text',
        'default'         => '',
		'description'     => '',
        'section'         => 'info'
    );
    return $fields;
}
add_filter( 'woothemes_our_team_member_fields', 'sama_add_new_fields_team_members' );

/*
 *	Portfolio
 *	Add more fields to porjects plugin by woothemes
 */
function sama_add_new_projects_fields( $fields ) {

	$fields['portolio_type'] = array(
		'name'          => __( 'type', 'projects' ),
		'description'   => __( 'Select portofilo type default, gallery, video ', 'projects' ),
		'type'          => 'select',
		'default'       => 'default',
		'section'       => 'info',
		'options'       => array( 'default' => 'Default', 'gallery' => 'Gallery', 'video' => 'Video' )
	);
	$fields['video_url'] = array(
		'name'          => __( 'Video URL', 'samathemes' ),
		'description'   => __( 'from youtube, vimeo ', 'samathemes' ),
		'type'          => 'url',
		'default'       => '',
		'section'       => 'info',
	);
	
	return $fields;
}
add_filter( 'projects_custom_fields', 'sama_add_new_projects_fields' );