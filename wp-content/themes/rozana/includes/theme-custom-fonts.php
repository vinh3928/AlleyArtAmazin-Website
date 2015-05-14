<?php
/*
 *	Replcae Theme fonts with custom fonts from theme options
 */

add_action( 'wp_enqueue_scripts', 'sama_load_custom_fonts', 10 );
add_action( 'wp_head', 'sama_custom_css_for_fonts' );

function sama_custom_css_for_fonts () {
?>
<style  type="text/css">
<?php echo sama_output_font_css(); ?>
</style>
<?php

}

function sama_load_custom_fonts () {
	
	global $sama_options;
	
	if(  isset( $sama_options['enable_custom_fonts'] ) && $sama_options['enable_custom_fonts'] ) {
										
		// Font 1:: Check if Enable custom font to replace with Open Sans font
		if(  isset( $sama_options['enable-font-opensans'] ) && $sama_options['enable-font-opensans'] ) {
			if( isset( $sama_options['font-opensans'] ) && ! empty( $sama_options['font-opensans'] ) && $sama_options['font-opensans']['font-family'] != 'Open Sans' && isset( $sama_options['font-opensans']['google'] ) && $sama_options['font-opensans']['google'] ) {
			
				$font_weight = $font_url = $subsets = '';
				$font_url = '//fonts.googleapis.com/css?family='. urlencode($sama_options['font-opensans']['font-family']).':';
				if( isset( $sama_options['font-opensans']['font-weight'] ) && ! empty( $sama_options['font-opensans']['font-weight'] ) ) {
					$font_weight = $sama_options['font-opensans']['font-weight'];
					if( isset( $sama_options['font-opensans']['font-style'] ) && ! empty( $sama_options['font-opensans']['font-style'] ) ) {
						$font_weight = $font_weight . $sama_options['font-opensans']['font-style'];
					}
				}
				if( isset( $sama_options['font-opensans-style'] ) && ! empty( $sama_options['font-opensans-style'] ) ) {
					if( ! empty( $font_weight ) ) {
						$font_weight .= ','. $sama_options['font-opensans-style'];
					} else {
						$font_weight = $sama_options['font-opensans-style'];
					}
				}
				if( isset( $sama_options['font-opensans']['subsets'] ) && ! empty( $sama_options['font-opensans']['subsets'] ) ) {
					$subsets = $sama_options['font-opensans']['subsets'];
				}
				if( isset( $sama_options['font-opensans-subsets'] ) && ! empty( $sama_options['font-opensans-subsets'] ) ) {
					if( ! empty( $subsets ) ) {
						$subsets .= ','. $sama_options['font-opensans-subsets'];
					} else {
						$subsets = $sama_options['font-opensans-subsets'];
					}
				}
				if( $subsets == 'latin' ) {
					$subsets = '';
				} else {
					$subsets = '&amp;subset='. $subsets ;
				}
				
				$font_url = $font_url. $font_weight . $subsets;
				$font_name = preg_replace('/\s+/', '_', $sama_options['font-opensans']['font-family']);
				wp_enqueue_style( $font_name, $font_url);
			} else {
				wp_enqueue_style('Open-Sans');
			}
		} else {
			wp_enqueue_style('Open-Sans');
		}
		
		// Font 2:: Check if Enable custom font to replace with Oswald font
		if(  isset( $sama_options['enable-font-oswald'] ) && $sama_options['enable-font-oswald'] ) {
			if( isset( $sama_options['font-oswald'] ) && ! empty( $sama_options['font-oswald'] ) && $sama_options['font-oswald']['font-family'] != 'Oswald' && isset( $sama_options['font-oswald']['google'] ) && $sama_options['font-oswald']['google'] ) {
			
				$font_weight = $font_url = $subsets = '';
				$font_url = '//fonts.googleapis.com/css?family='. urlencode($sama_options['font-oswald']['font-family']).':';
				if( isset( $sama_options['font-oswald']['font-weight'] ) && ! empty( $sama_options['font-oswald']['font-weight'] ) ) {
					$font_weight = $sama_options['font-oswald']['font-weight'];
					if( isset( $sama_options['font-oswald']['font-style'] ) && ! empty( $sama_options['font-oswald']['font-style'] ) ) {
						$font_weight = $font_weight . $sama_options['font-oswald']['font-style'];
					}
				}
				if( isset( $sama_options['font-oswald-style'] ) && ! empty( $sama_options['font-oswald-style'] ) ) {
					if( ! empty( $font_weight ) ) {
						$font_weight .= ','. $sama_options['font-oswald-style'];
					} else {
						$font_weight = $sama_options['font-oswald-style'];
					}
				}
				if( isset( $sama_options['font-oswald']['subsets'] ) && ! empty( $sama_options['font-oswald']['subsets'] ) ) {
					$subsets = $sama_options['font-oswald']['subsets'];
				}
				if( isset( $sama_options['font-oswald-subsets'] ) && ! empty( $sama_options['font-oswald-subsets'] ) ) {
					if( ! empty( $subsets ) ) {
						$subsets .= ','. $sama_options['font-oswald-subsets'];
					} else {
						$subsets = $sama_options['font-oswald-subsets'];
					}
				}
				if( $subsets == 'latin' ) {
					$subsets = '';
				} else {
					$subsets = '&amp;subset='. $subsets ;
				}
				
				$font_url = $font_url. $font_weight . $subsets;
				$font_name = preg_replace('/\s+/', '_', $sama_options['font-oswald']['font-family']);
				wp_enqueue_style( $font_name, $font_url);
			} else {
				wp_enqueue_style('Oswald');
			}
		} else {
			wp_enqueue_style('Oswald');
		}
		
		// Font 3 :: Check if Enable custom font to replace with Open Sans Condensed font
		if(  isset( $sama_options['enable-font-opensans-condensed'] ) && $sama_options['enable-font-opensans-condensed'] ) {
			if( isset( $sama_options['font-opensans-condensed'] ) && ! empty( $sama_options['font-opensans-condensed'] ) && $sama_options['font-opensans-condensed']['font-family'] != 'Open Sans Condensed' && isset( $sama_options['font-opensans-condensed']['google'] ) && $sama_options['font-opensans-condensed']['google'] ) {
			
				$font_weight = $font_url = $subsets = '';
				$font_url = '//fonts.googleapis.com/css?family='. urlencode($sama_options['font-opensans-condensed']['font-family']).':';
				if( isset( $sama_options['font-opensans-condensed']['font-weight'] ) && ! empty( $sama_options['font-opensans-condensed']['font-weight'] ) ) {
					$font_weight = $sama_options['font-opensans-condensed']['font-weight'];
					if( isset( $sama_options['font-opensans-condensed']['font-style'] ) && ! empty( $sama_options['font-opensans-condensed']['font-style'] ) ) {
						$font_weight = $font_weight . $sama_options['font-opensans-condensed']['font-style'];
					}
				}
				if( isset( $sama_options['font-opensans-condensed-style'] ) && ! empty( $sama_options['font-opensans-condensed-style'] ) ) {
					if( ! empty( $font_weight ) ) {
						$font_weight .= ','. $sama_options['font-opensans-condensed-style'];
					} else {
						$font_weight = $sama_options['font-opensans-condensed-style'];
					}
				}
				if( isset( $sama_options['font-opensans-condensed']['subsets'] ) && ! empty( $sama_options['font-opensans-condensed']['subsets'] ) ) {
					$subsets = $sama_options['font-opensans-condensed']['subsets'];
				}
				if( isset( $sama_options['font-opensans-condensed-subsets'] ) && ! empty( $sama_options['font-opensans-condensed-subsets'] ) ) {
					if( ! empty( $subsets ) ) {
						$subsets .= ','. $sama_options['font-opensans-condensed-subsets'];
					} else {
						$subsets = $sama_options['font-opensans-condensed-subsets'];
					}
				}
				if( $subsets == 'latin' ) {
					$subsets = '';
				} else {
					$subsets = '&amp;subset='. $subsets ;
				}
				
				$font_url = $font_url. $font_weight . $subsets;
				$font_name = preg_replace('/\s+/', '_', $sama_options['font-opensans-condensed']['font-family']);
				wp_enqueue_style( $font_name, $font_url);
			} else {
				wp_enqueue_style('Open-Sans-Condensed');
			}
		} else {
			wp_enqueue_style('Open-Sans-Condensed');
		}
		
	} else {
		wp_enqueue_style('Open-Sans');
		wp_enqueue_style('Oswald');
		wp_enqueue_style('Open-Sans-Condensed');
	}
}

// used to define new fonts for html elments
function sama_output_font_css() {
	global $sama_options;
	$output = '';
	if(  isset( $sama_options['enable_custom_fonts'] ) && $sama_options['enable_custom_fonts'] ) {
		// Font 1
		if( isset( $sama_options['enable-font-opensans'] ) && $sama_options['enable-font-opensans'] && isset( $sama_options['font-opensans'] ) && ! empty( $sama_options['font-opensans'] ) && $sama_options['font-opensans']['font-family'] != 'Open Sans' ) {
			$font1 = esc_attr( $sama_options['font-opensans']['font-family'] );
			if( ! empty( $sama_options['font-opensans']['font-backup'] ) ) {
				$font1 .= ',' .  esc_attr( $sama_options['font-opensans']['font-backup'] );
			}
			$output .= "body,input,select,textarea,header h5,.team-member h5,.fun-facts h5 { font-family:$font1; }\n";
		}
		
		// Font 2
		if( isset( $sama_options['enable-font-oswald'] ) && $sama_options['enable-font-oswald'] && isset( $sama_options['font-oswald'] ) && ! empty( $sama_options['font-oswald'] ) && $sama_options['font-oswald']['font-family'] != 'Oswald' ) {
			$font2 = esc_attr( $sama_options['font-oswald']['font-family'] );
			if( ! empty( $sama_options['font-oswald']['font-backup'] ) ) {
				$font2 .= ',' . esc_attr( $sama_options['font-oswald']['font-backup'] );
			}
			$output .= "h1,h2,h3,h4,h5,h6,#top-menu h3 a,#top-menu ul ul li a,.what-we-do ul li,.portfolioFilter ul li a,.portfolio-sample .overlay h3,.newsletter input,.newsletter button,.title-slide-light,.title-slide-bold,.price_number,.features li,.hot-icon span,.social-touch  li a,.forms p,.footer-one-page p,#stlChanger .stBlock:first-child span,.fullwidth-slider_2 p,.slider-block-11 p,.nav-tabs>li>a,.testimonial-item p,.progress-bar,.dropcap,.nav-tabs2>li>a,.panel-default a.panel-link,.blog-date span:last-child,.about-author span,.comment-author span,.branches .panel-default a.accordion-toggle,.error_symbol,.error_symbol_2,.error_page_2 .search input,.faqs .panel-default a.accordion-toggle,.faqs_2 .panel-default a.accordion-toggle,#clock-ticker .block .label ,#clock-ticker .block,.small-btn,.medium-btn,.big-btn,.toggle_01 .panel-default a.accordion-toggle,.toggle_02 .panel-default a.accordion-toggle,#top-menu a,.format-link .blog-list .blog-title .title-blog-name p,.comment-body .fn,.comment-body .fn a,#commentform p,#commentform label,.blog-desc-single .post-password-form p label,.counter-wrapper,#main-menu > li > a, .main_nav ul.sub-menu > li > a, .mc4wp-form input, .newsletter input[type=\"submit\"] { font-family:$font2; }\n";
		}
		
		// Font 3
		if( isset( $sama_options['enable-font-opensans-condensed'] ) && $sama_options['enable-font-opensans-condensed'] && isset( $sama_options['font-opensans-condensed'] ) && ! empty( $sama_options['font-opensans-condensed'] ) && $sama_options['font-opensans-condensed']['font-family'] != 'Open Sans Condensed' ) {
			$font3 = esc_attr( $sama_options['font-opensans-condensed']['font-family'] );
			if( ! empty( $sama_options['font-opensans-condensed']['font-backup'] ) ) {
				$font3 .= ',' . esc_attr( $sama_options['font-opensans-condensed']['font-backup'] );
			}
			$output .= ".banners p,.head-sidebar p,.head-sidebar h3,.blog-desc blockquote,.login_page input[type=\"text\"],.login_page input[type=\"password\"],.login_page .login-btn,.login-form input[type=\"text\"],.login-form input[type=\"password\"],.login-form .login-btn, .login-bg form, .login-bg form label,.testimonial-item-list blockquote,.white-text p,.rev_slider_wrapper .slogan-text { font-family:$font3; }\n";
		}
	}
	
	return $output;
}
?>