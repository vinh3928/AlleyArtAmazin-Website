<?php
/*------------------------------------------------------------------------------
Plugin Name: Rozana Shortcodes
Plugin URI: http://samathemes.com/
Description: Shortcodes for bootstrap.
Version: 1.2
Author: samathemes
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
------------------------------------------------------------------------------*/

add_action( 'init', 'sama_bootstrap_add_editor_shortcodes' );

function sama_bootstrap_add_editor_shortcodes() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )	return;
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'sama_add_bootstrap_shortcode_tinymce_plugin');
		add_filter( 'mce_buttons', 'sama_bootstrap_register_shortcode_button');
	}
}

function sama_bootstrap_register_shortcode_button( $buttons ) {
	array_push($buttons, "|", "sama_shortcodes_button");
	return $buttons;
}

function sama_add_bootstrap_shortcode_tinymce_plugin( $plugin_array ) {
	$plugin_array['SamaShortcodes'] = plugins_url('shortcode_plugin.js' , __FILE__);
	return $plugin_array;
}


if ( ! class_exists('Sama_ShortCodes') ) {

	class Sama_ShortCodes {
		
		function __construct() {
			
			add_action( 'init', array( $this, 'sama_add_shortcodes' ));
			add_action( 'wp_enqueue_scripts', array( $this, 'sama_enqueue_scripts_styles' ));
		}
		
		function sama_enqueue_scripts_styles () {
		
			if ( wp_style_is('bootstrap-min') ) {
				wp_enqueue_style ( 'bootstrap-min', plugins_url('css/bootstrap.min.css' , __FILE__), '', '3.1.1');
				wp_enqueue_style ( 'custom-bootstrap', plugins_url('css/bootstrap-custom.css' , __FILE__), array('bootstrap-min'), '3.1.1');
			}
			if ( wp_style_is('font-awesome') ) {
				wp_enqueue_style ( 'font-awesome', plugins_url('css/font-awesome.css' , __FILE__), '', '4.2.0');
			}
			if ( wp_script_is('bootstrap') ) {
				wp_enqueue_script( 'bootstrap',  plugins_url('js/bootstrap.min.js' , __FILE__), array('bootstrap'),'3.1.1', true);
				wp_enqueue_script( 'custom-bootstrap',  plugins_url('js/custom-bootstrap.js' , __FILE__), array('bootstrap'),'3.1.1', true);
			}
		}
		
		function sama_add_shortcodes() {
		
			add_shortcode( 'sama_alert', 			array( $this, 'insert_alert' ));
			add_shortcode( 'sama_button', 			array( $this, 'insert_button' ));
			add_shortcode( 'sama_tooltip', 			array( $this, 'insert_tooltip' ));
			add_shortcode( 'sama_popovers', 		array( $this, 'insert_popovers' ));
			add_shortcode( 'sama_label', 			array( $this, 'insert_label' ));
			add_shortcode( 'sama_badge', 			array( $this, 'insert_badges' ));
			add_shortcode( 'sama_blockquote', 		array( $this, 'insert_blockquote' ));
			add_shortcode( 'sama_clear', 			array( $this, 'insert_clear' ));
			add_shortcode( 'sama_well', 			array( $this, 'insert_well' ));
			add_shortcode( 'sama_code', 			array( $this, 'insert_code' ));
			add_shortcode( 'sama_divider', 			array( $this, 'insert_divider' ));
			add_shortcode( 'sama_row', 				array( $this, 'insert_row' ));
			add_shortcode( 'sama_column', 			array( $this, 'insert_column' ));
			add_shortcode( 'sama_tabs', 			array( $this, 'insert_tabs' ));
			add_shortcode( 'sama_tab', 				array( $this, 'insert_tab' ));
			add_shortcode( 'sama_accordions', 		array( $this, 'insert_accordions' ));
			add_shortcode( 'sama_accordion', 		array( $this, 'insert_accordion' ));
			add_shortcode( 'sama_panel', 			array( $this, 'insert_panel' ));
			add_shortcode( 'sama_panel_footer',		array( $this, 'insert_panel_footer' ));
			add_shortcode( 'sama_panel_body',		array( $this, 'insert_panel_body' ));
			add_shortcode( 'sama_progressbar',		array( $this, 'insert_progressbar'));
			add_shortcode( 'sama_jumbotron',		array( $this, 'insert_jumbotron'));
			add_shortcode( 'sama_icon',				array( $this, 'insert_icon'));
			add_shortcode( 'sama_left', 			array( $this, 'insert_left' ));
			add_shortcode( 'sama_right', 			array( $this, 'insert_right' ));
			add_shortcode( 'sama_socialicons',		array( $this, 'insert_social_icons'));
			add_shortcode( 'sama_pricing_table',	array( $this, 'insert_pricing_table'));
			add_shortcode( 'sama_team_member',		array( $this, 'insert_team_member'));
			add_shortcode( 'sama_counter',			array( $this, 'insert_counter'));
			add_shortcode( 'sama_gmaps',			array( $this, 'insert_gmaps'));
			
			add_shortcode( 'sama_timer',			array( $this, 'insert_timer'));
			// add shortcode in widget
			add_filter( 'widget_text', 'do_shortcode' );
		}
		
		function url_image( $image_name ) {
			return plugins_url( 'img/socials/'. $image_name .'.png', __FILE__ );
		}
		
		// Alert & Box Shortcode
		function insert_alert( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'type' 		=> 'alert-warning',
				'close' 	=> 'no',
				'cssclass'	=> '',
			), $atts));
				
			$cssoutput = 'alert';
			$cssoutput .= ' '. wp_strip_all_tags( $type );
			if ( $cssclass != '' ) {
				$cssoutput .= ' '. wp_strip_all_tags( $cssclass );
			}
			$output = '<div class="'. $cssoutput .'" role="alert">';
			if ( $close == 'yes' ) {
				$output .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
			}
			$content = $this->remove_empty_p_tag($content);
			$output .= do_shortcode($content).'</div>';
			return apply_filters('sama_alert_shortcode_output',$output, $content, $type, $close, $cssclass);
		}
		
		// Button Shortcode
		function insert_button( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				//'title'      	=> '',
				'url'			=> '',
				'target'		=> '_self',
				'bgcolor'      	=> '',
				'size' 			=> 'small-btn',
				'border'      	=> '',
				'corner'		=> '',
				'icon'			=> '',
				'cssclass'		=> '',
			), $atts));
			
			$icon_html = '';
			if ( ! empty( $url ) ) {
				$url	= esc_url($url);
			} else {
				$url    = '#';
			}
			
			$extra_css = $bgcolor . ' '. $size;
			
			if( $border == 'yes' ) {
				$extra_css .= ' display-border';
			}
			if( ! empty ( $cssclass ) ) {
				$extra_css = ' '. $cssclass;
			}
			if( $corner == 'yes' ) {
				$extra_css .= ' corner-btns';
			}
			if( ! empty( $icon ) ) {
				$icon_html = '<i class="fa '. esc_attr( $icon ) .'"></i>';
			}
			$content = $this->remove_empty_p_tag($content);
			$output = '<span class="btns-group"><a class="'. $extra_css .'" href="'. $url .'" title="'. esc_attr(strip_tags($content)) .'" target="'. esc_attr( $target ) .'">'. $icon_html . do_shortcode($content) .'</a></span>';
			
			return $output;
			//return apply_filters('sama_button_shortcode_output',$output, $content, $type, $style, $size, $url, $target, $cssclass);
		}
		
		// ToolTip Shortcode
		function insert_tooltip( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'desc' 			=> '',
				'direction' 	=> 'top',
				'cssclass'		=> '',
			), $atts));
			
			$cssoutput = '';
			if ( $cssclass != '' ) {
				$cssoutput .= wp_strip_all_tags( $cssclass );
			}
			$content = $this->remove_empty_p_tag($content);
			$output = '<a href="#" class="'. $cssoutput .'" data-thumb="tooltip" data-toggle="tooltip" data-placement="'. wp_strip_all_tags($direction) .'" title="" data-original-title="'. wp_strip_all_tags($desc) .'">'.do_shortcode($content).'</a>';
			
			return apply_filters('sama_tooltip_shortcode_output',$output, $content, $desc, $direction, $cssclass);
		}
		
		// Popovers Shortcode
		function insert_popovers( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'title'			=> '',
				'desc' 			=> '',
				'direction' 	=> 'top',
				'cssclass'		=> '',
				'style'			=> '',
			), $atts));
			
			$cssoutput = 'btn';
			if ( $style != '' ) {
				$cssoutput .= ' '. wp_strip_all_tags( $style );
			}
			if ( $cssclass != '' ) {
				$cssoutput .= ' ' . wp_strip_all_tags( $cssclass );				
			}
			$content = $this->remove_empty_p_tag($content);
			$output = '<a class="'. $cssoutput .'" data-thumb="popover" data-toggle="popover" data-placement="'. wp_strip_all_tags($direction) .'" data-content="'. wp_strip_all_tags($desc) .'" title="" data-original-title="Popover on top">'.do_shortcode($content).'</a>';
			
			return apply_filters('sama_popovers_shortcode_output',$output, $content, $title, $desc, $direction, $cssclass);
		}
		
		// Label Shortcode
		function insert_label( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'title' 		=> '',
				'style' 		=> 'label-default',
				'cssclass'		=> '',
			), $atts));
			
			$cssoutput = 'label '. wp_strip_all_tags( $style );
			if ( $cssclass != '' ) {
				$cssoutput .= ' '. wp_strip_all_tags( $cssclass );
			}
			$output = '<span class="'. $cssoutput .'">'. wp_strip_all_tags( $title ) .'</span>';
			return apply_filters('sama_label_shortcode_output',$output, $title, $style, $cssclass);
		}
		
		// Badges Shortcode
		function insert_badges( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'title' 		=> '',
				'style'			=> '',
				'cssclass'		=> '',
			), $atts));
				
			//$cssoutput = 'badge';
			if ( ! empty( $cssclass ) ) {
				$cssoutput = ' '. wp_strip_all_tags( $cssclass );
			}
			
			$output = '<span class="'. $cssoutput .'">'. $title .'</span>';
			return apply_filters('sama_badges_shortcode_output',$output, $title, $cssclass);
		}
		
		// Blockquote Shortcode
		function insert_blockquote( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'float'			=> 'left',
				'style'			=> '',
				'source' 		=> '',
				'beforsource'	=> '',
				'cssclass'		=> '',
			), $atts));
			
			$icon = '';
			if ( $float == 'right' ) {
				$css = 'blockquote-reverse';
				
			} else {
				$css = '';
			}
			if ( ! empty( $cssclass ) ) {
				if ( $float == 'right' ) {
					$css .= ' '. wp_strip_all_tags( $cssclass );
				} else {
					$css .= wp_strip_all_tags( $cssclass );
				}
			}
			if( $style == 'style2' ) {
				$css .= ' blockquote-bg';
			} elseif( $style == 'style3' ) {
				$css .= ' blockquote-colorful';
			}
			
			$output = '<blockquote class="' .$css. '">';
			$content = $this->remove_empty_p_tag($content);
			if( $style == 'style2' || $style == 'style3' ) {
				$icon = '<i class="fa fa-quote-left"></i> ';
			}
			$output .= '<p>'. $icon . do_shortcode($content) .'</p>';
			
			if ( $source != '' ) {
				$output .= '<footer>' . wp_strip_all_tags( $beforsource );
				$output .= ' <cite title="'. wp_strip_all_tags($source) .'">'. wp_strip_all_tags($source) . '</cite></footer>';
			}
			$output .= '</blockquote>';
			
			return apply_filters('sama_blockquote_shortcode_output', $output, $content, $float, $source, $beforsource, $cssclass);
		}
		
		// Clear
		function insert_clear( $atts, $content = null ) {
			
			return '<div class="clearfix"></div>';
		}
		
		// Well Shortcode
		function insert_well( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'size' 			=> 'well-sm',
				'cssclass'		=> '',
			), $atts));
			
			$cssoutput = 'well '. wp_strip_all_tags( $size );
			if ( ! empty( $cssclass ) ) {
				$cssoutput .= ' '. wp_strip_all_tags( $cssclass );
			}
			
			$content = str_replace('<br class="removebr" />', '', $content);
			$content = $this->remove_empty_p_tag($content);
			$output = '<div class="'. $cssoutput .'">'. do_shortcode($content) .'</div>';
			return apply_filters('sama_well_shortcode_output', $output, $content, $size, $cssclass);
		}
		
		// Code Shortcode
		function insert_code( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'type' 			=> 'block',
			), $atts));
			
			$content = $this->remove_empty_p_tag($content);
			if ( $type == 'inline' ) {
				return '<code>'. $content .'</code>';
				
			} else {
				return '<pre>'. $content .'</pre>';
				
			}
			
		}
		
		// Divider shortcode
		function insert_divider( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'height'     => '',
				'style'		 => '',
				'cssclass'	 => '',
				'hide' 		 => 'no',
			), $atts));
			$el_style = '';
			if ( ! empty( $height ) ) {
				$el_style .= 'height:'. absint( $height ) .'px;';
			}
			
			if ( $hide == 'yes' ) {
				$el_style .= 'background:none;border:0';
			}
			if ( ! empty( $cssclass ) ) {
				$class= 'divider clear'. $style .' '. wp_strip_all_tags( $cssclass );
			} else {
				$class= 'divider clear'. $style;
			}
			if ( $el_style == '' ) {
				$output = '<div class="'. $class .'"></div>';
			} else {
				$output = '<div class="'. $class .'" style="'.$el_style.'"></div>';
			}
			
			return apply_filters('sama_divider_shortcode_output', $output, $height, $style, $cssclass, $hide);
		}
		
		/* 
		 *	Icon shortcode
		 *
		 *	font http://fortawesome.github.io/Font-Awesome/icons/
		 *  font http://glyphicons.com/
		 */	
		function insert_icon( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'name'		=> '',
				'font'		=> 'fontawesome', // or Font Awesome
				'cssclass'	=> '',
			), $atts));
			
			if( empty ($name) ) return;
			
			if ( $font == 'glyphicon' ) {
				if ( ! empty( $cssclass ) ) {
					$css = $name . ' ' . wp_strip_all_tags( $cssclass );
				} else {
					$css = $name;
				}
				$output = '<span class="'.$css.'"></span>';
			} else if( $font == 'fontawesome' ) {
				if ( ! empty( $cssclass ) ) {
					$css = $name . ' ' . wp_strip_all_tags( $cssclass );
				} else {
					$css = $name;
				}
				$output = '<i class="'.$css.'"></i>';
			} else {
				return;
			}
			
			return apply_filters('sama_icon_shortcode_output', $output, $name, $font, $cssclass);
		}
		
		// row 
		function insert_row( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'type'		=> 'fixed-width',
				'cssclass'	=> '',
			), $atts));
			if( ! empty( $cssclass ) ) {
				$cssclass = ' ' . wp_strip_all_tags($cssclass);
			}
			$content = $this->remove_empty_p_tag($content);
			if( $type == 'full-width' ) {
				$block_before = '<div class="container-fluid'. $cssclass .'"><div class="row">';
			} else {
				$block_before = '<div class="container'. $cssclass .'"><div class="row">';
			}
			$output  =  $block_before . do_shortcode($content) .'</div></div>';
			return apply_filters('sama_row_shortcode_output', $output, $content, $type ,$cssclass );
		}
		
		// Column Shortcode
		function insert_column( $atts, $content = null ) {
			
			extract(shortcode_atts(array( 
				'cssclass'	=> 'col-md-6',
			), $atts));
			
			$content = $this->remove_empty_p_tag($content);
			$output  = '<div class="'.$cssclass.'">'. do_shortcode($content) .'</div>';
			return apply_filters('sama_column_shortcode_output', $output, $content, $cssclass );
		}
		
		// Tabs Shortcode
		function insert_tabs( $atts, $content = null ) {
		
			extract(shortcode_atts(array(
				'style'			=> 'light',
				'cssclass'		=> '',
			), $atts));
			
			$css = 'wrap_tab';
			if ( ! empty( $cssclass ) ) {
				$css = ' ' . wp_strip_all_tags( $cssclass );
			}
			
			if( $style == 'light' ) {
				$nav_tabs = 'nav-tabs2';
				$tab_content = 'tab-content tab-content2';
			} else {
				$nav_tabs = 'nav-tabs';
				$tab_content = 'tab-content';
			}
			$tabs_nav = '<ul class="nav '. $nav_tabs .'">';
			

			
			$GLOBALS['tab_count'] = 0;
			$content = $this->remove_empty_p_tag($content);
			do_shortcode( $content );
			if( is_array( $GLOBALS['tabs'] ) ){
				$i = 1;
				foreach( $GLOBALS['tabs'] as $tab ){
					
					$rand = rand(1,999);
					$icon = '';
					if ( ! empty( $tab['icon_name']) ) {
						$icon = do_shortcode('[sama_icon name="'.$tab['icon_name'].'" font="'.$tab['icon_font'].'"]') . ' ';
					}
					if ( $i == 1 ) {						
						$tabs[] = '<li class="active"><a href="#custom-tab-'.$i.'-'. $rand .'" role="tab">'. $icon . $tab['title'].'</a></li>';
					} else {
						$tabs[] = '<li><a href="#custom-tab-'.$i.'-'. $rand .'" role="tab">'. $icon .$tab['title'].'</a></li>';
					}
					if ( $i == 1 ) {
						$panes[] = '<div class="tab-pane fade in active" id="custom-tab-'.$i.'-'. $rand .'">'.$tab['content'].'</div>';
					} else {
						$panes[] = '<div class="tab-pane fade" id="custom-tab-'.$i.'-'. $rand .'">'.$tab['content'].'</div>';
					}
					$i++;
				}
			}
			$output = '<div class="wpb_tabs wpb_content_element '.$css.'">'. $tabs_nav . implode( "\n", $tabs ).'</ul><div class="'. $tab_content .'">'.implode( "\n", $panes ) .'</div></div>';
									
			return apply_filters('sama_tabs_shortcode_output', $output, $content,  $cssclass);
		}
		
		function insert_tab( $atts, $content ) {
		
			extract(shortcode_atts(array(
				'title' 	=> 'Tab %d',
				'active'	=> '',
				'icon_name'	=> '',
				'icon_font' => '',
				), $atts));
			$x = $GLOBALS['tab_count'];
			$content = preg_replace('~^(\<br /\>)+~', "", $content); // Remove <br>
			$content = preg_replace("/(^)?(<br\s*\/?>\s*)+$/", "", $content); // Remove </br>
			$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  do_shortcode($content), 'icon_name' => $icon_name, 'icon_font' => $icon_font, 'active' => $active );
			$GLOBALS['tab_count']++;
		}
		
		// Accordions shortcode
		function insert_accordions( $atts, $content = null ) {
			extract(shortcode_atts(array(
				'style'			=> 'light',
				'cssclass'		=> '',
			), $atts));

			if( $style == 'light' ) {
				$cssclass .= ' toggle_01';
			} else {
				$cssclass .= ' toggle_02';
			}
			
			$id = rand(1,999);
			$GLOBALS ['id_accordions_parent'] = 'accordion-'. $id . '';
			$content = $this->remove_empty_p_tag($content);
			$output  = '<div class="panel-group '.$cssclass.'" id="'. $GLOBALS ['id_accordions_parent'] .'">'. do_shortcode( $content ) .'</div>';
			
			return apply_filters('sama_panels_shortcode_output', $output, $content,  $cssclass);
		}
		
		// Accordion Shortcode
		function insert_accordion( $atts, $content ){
			extract(shortcode_atts(array(
				'title'		=> '',
				'active'	=> '',
				), $atts));
			$content = $this->remove_empty_p_tag($content);
			$id = 'collapse-' . rand(1,999);
			$active_class = '';
			$icon = '<i class="glyphicon glyphicon-plus"></i>';
			if( $active == 'in' ) {
				$active_class=' in';
				$icon = '<i class="glyphicon glyphicon-minus"></i>';
			}
			
			$output = '
					<div class="panel panel-default animated" data-animation="fadeInUp">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$GLOBALS ['id_accordions_parent'].'" href="#'. sanitize_title($title) . $id .'">'. $icon .' '. $title.'</a>
						<div id="'. sanitize_title($title) . $id .'" class="panel-collapse collapse'. $active_class .'">
							<div class="panel-body">
							'. do_shortcode($content) .'
							</div>
						</div>
					</div>';
			return apply_filters('sama_panel_shortcode_output', $output, $content, $title, $active);
		}
		
		// Panels Shortcode
		function insert_panel( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'title'			=> '',
				'style'			=> 'panel-default',
				'icon'			=> '',
				'cssclass'		=> '',
			), $atts));
			$output_icon = '';
			$cssoutput = 'panel '. wp_strip_all_tags( $style );
			if ( $cssclass != '' ) {
				$cssoutput .= ' ' . wp_strip_all_tags( $cssclass );				
			}
			$content = $this->remove_empty_p_tag($content);
			
			$output = '<div class="'. $cssoutput .'">';
			if( ! empty( $title ) ) {
				if( ! empty ( $icon ) ) {
					$output_icon = '<i class="'. $icon .'"></i> ';
				}
				$output .= '<div class="panel-heading">'. $output_icon . wp_strip_all_tags( $title ) .'</div>';
			}
			$output .= do_shortcode( $content ) . '</div>';				
			
			return apply_filters('sama_panel_shortcode_output',$output, $content, $title, $style, $cssclass);
		}
		
		// Panel content Body
		function insert_panel_body( $atts, $content = null ) {
			
			$content = $this->remove_empty_p_tag($content);
			$output  = '<div class="panel-body">' . do_shortcode( $content ) . '</div>';				
			return apply_filters('sama_panel_body_shortcode_output',$output, $content);
		}
		
		// Panel content Footer
		function insert_panel_footer( $atts, $content = null ) {
			
			$content = $this->remove_empty_p_tag($content);
			$output  = '<div class="panel-footer">' . do_shortcode( $content ) . '</div>';				
			return apply_filters('sama_panel_footer_shortcode_output',$output, $content);
		}
		
		// Progressbar
		function insert_progressbar( $atts, $content = null ) {
		
			extract(shortcode_atts(array(
				'title'			=> '',
				'value'			=> '',
				'unit'			=> '',
				'style'			=> '',
				'striped'		=> '',
				'animated'		=> '',
				'cssclass'		=> '',
			), $atts));
			$bar_options = '';
			$title = wp_strip_all_tags( $title );
			$value = absint( $value );
			if ( $striped == 'yes' ) {
				$bar_options .= ' progress-bar-striped';
			}
			if ( $animated == 'yes' ) {
				$bar_options .= ' active';
			}
			
			$output = '<div class="skill'. esc_attr( $cssclass ) .'">';
			if( !empty( $title ) ) {
				$output .= '<h4>'. esc_attr( $title ) .'</h4>';
			}
			$output .= '<div class="progress">';
			$output .= '<div class="progress-bar '. $style .''. $bar_options .'" role="progressbar" data-value="'. absint( $value ) .'" style="width: '. absint( $value ) .'%;">
					<span>'. absint( $value ) .''. esc_attr( $unit ) .'</span>
				</div><span class="sr-only">'. absint( $value ) .''. esc_attr( $unit ) .' '. __('Complete', 'samathemes'). '</span>
			';
			$output .= '</div></div>';
			
			return apply_filters('sama_progressbar_shortcode_output',$output, $title, $value, $style, $striped, $animated, $cssclass);
		}
		
		function insert_jumbotron( $atts, $content = null ) {
		
			extract(shortcode_atts(array(
				'cssclass'		=> '',
			), $atts));
			
			$cssoutput = 'jumbotron';
			if ( $cssclass != '' ) {
				$cssoutput .= ' ' . wp_strip_all_tags( $cssclass );		
			}
			
			$content = $this->remove_empty_p_tag($content);
			$output  = '<div class="'. $cssoutput .'">'. do_shortcode($content) .'</div>';
			return apply_filters('sama_progressbar_shortcode_output',$output, $content, $cssclass);
		}
		
		function insert_left( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'cssclass'		=> '',
			), $atts));
			$content = $this->remove_empty_p_tag($content);
			$cssoutput = 'pull-left';
			if ( ! empty( $cssclass ) ) {
				$cssoutput .= ' ' . wp_strip_all_tags( $cssclass );		
			}
			$output  = '<div class="'. $cssoutput .'">'. do_shortcode($content) .'</div>';
			return apply_filters('sama_pull_left_shortcode_output',$output, $content, $cssoutput);
		}
		
		function insert_right( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'cssclass'		=> '',
			), $atts));
			$content = $this->remove_empty_p_tag($content);
			$cssoutput = 'pull-right';
			if ( ! empty( $cssclass ) ) {
				$cssoutput .= ' ' . wp_strip_all_tags( $cssclass );		
			}
			$output  = '<div class="'. $cssoutput .'">'. do_shortcode($content) .'</div>';
			return apply_filters('sama_pull_right_shortcode_output', $output, $content, $cssoutput);
		}
		
		
		function insert_social_icons( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'type'			=> 'fontawesome',
				'style'			=> '',
				'cssclass'		=> '',
				'facebook'		=> '',
				'twitter'		=> '',
				'dribbble'		=> '',
				'linkedin'		=> '',
				'gplus'			=> '',
				'youtube'		=> '',
				'soundcloud'	=> '',
				'behance'		=> '',
				'vimeo'			=> '',
				'instagram'		=> '',
				'pinterest'		=> '',
				'tumblr'		=> '',
				'digg'			=> '',
				'lastfm'		=> '',
				'rss'			=> '',
			), $atts));
			
			$path_url = SAMA_THEME_URI;
			
			$el_class = 'social-network-footer white-icons';
			if( $style == 'circle' ) {
				$el_class .= ' cricle-icons';
			} elseif( $style == 'corner' ) {
				$el_class .= ' radius-icons';
			}
			if( ! empty( $cssclass ) ) {
				$el_class .= ' '. wp_strip_all_tags( $cssclass );
			}
			$output = '<ul class="'. $el_class .'">';
			if( $type == 'image' ) {
				if( ! empty( $facebook ) ) {
					$output .= '<li><a href="'. esc_url( $facebook ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Facebook','samathemes'). '"><img src="'. $this->url_image('facebook') .'"></a></li>';
				}
				if( ! empty( $twitter ) ) {
					//$output .= '<li><a href="'. esc_url( $twitter ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Twitter','samathemes'). '"><img src="'. $this->url_image('facebook') .'"></a></li>';
				}
				if( ! empty( $dribbble ) ) {
					//$output .= '<li><a href="'. esc_url( $dribbble ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Dribbble','samathemes'). '"><img src="'. $this->url_image('facebook') .'"></a></li>';
				}
				if( ! empty( $linkedin ) ) {
					$output .= '<li><a href="'. esc_url( $linkedin ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Linkedin','samathemes'). '"><img src="'. $this->url_image('linkedin') .'"></a></li>';
				}
				if( ! empty( $gplus ) ) {
					$output .= '<li><a href="'. esc_url( $gplus ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Google plus','samathemes'). '"><img src="'. $this->url_image('google_plus') .'"></a></li>';
				}
				if( ! empty( $youtube ) ) {
					$output .= '<li><a href="'. esc_url( $youtube ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Youtube','samathemes'). '"><img src="'. $this->url_image('youtube') .'"></a></li>';
				}
				if( ! empty( $soundcloud ) ) {
					//$output .= '<li><a href="'. esc_url( $soundcloud ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Soundcloud','samathemes'). '"><img src="'. $this->url_image('youtube') .'"></a></li>';
				}
				if( ! empty( $behance ) ) {
					$output .= '<li><a href="'. esc_url( $behance ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Behance','samathemes'). '"><img src="'. $this->url_image('behance') .'"></a></li>';
				}
				if( ! empty( $vimeo ) ) {
					$output .= '<li><a href="'. esc_url( $vimeo ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Vimeo','samathemes'). '"><img src="'. $this->url_image('vimeo') .'"></a></li>';
				}
				if( ! empty( $instagram ) ) {
					//$output .= '<li><a href="'. esc_url( $instagram ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Instagram','samathemes'). '"><img src="'. $this->url_image('vimeo') .'"></a></li>';
				}
				if( ! empty( $pinterest ) ) {
					$output .= '<li><a href="'. esc_url( $pinterest ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Pinterest','samathemes'). '"><img src="'. $this->url_image('pinterest') .'"></a></li>';
				}
				if( ! empty( $tumblr ) ) {
					//$output .= '<li><a href="'. esc_url( $tumblr ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Tumblr','samathemes'). '"><img src="'. $this->url_image('pinterest') .'"></i></a></li>';
				}
				if( ! empty( $digg ) ) {
					$output .= '<li><a href="'. esc_url( $digg ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Digg','samathemes'). '"><img src="'. $this->url_image('digg') .'"></a></li>';
				}
				if( ! empty( $lastfm ) ) {
					$output .= '<li><a href="'. esc_url( $lastfm ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Lastfm','samathemes'). '"><img src="'. $this->url_image('fastfm') .'"></a></li>';
				}
				if( ! empty( $rss ) ) {
					$output .= '<li><a href="'. esc_url( $rss ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('RSS','samathemes'). '"><img src="'. $this->url_image('rss') .'"></a></li>';
				}
			} else {
				if( ! empty( $facebook ) ) {
					$output .= '<li><a href="'. esc_url( $facebook ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Facebook','samathemes'). '"><i class="fa fa-facebook"></i></a></li>';
				}
				if( ! empty( $twitter ) ) {
					$output .= '<li><a href="'. esc_url( $twitter ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Twitter','samathemes'). '"><i class="fa fa-twitter"></i></a></li>';
				}
				if( ! empty( $dribbble ) ) {
					$output .= '<li><a href="'. esc_url( $dribbble ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Dribbble','samathemes'). '"><i class="fa fa-dribbble"></i></a></li>';
				}
				if( ! empty( $linkedin ) ) {
					$output .= '<li><a href="'. esc_url( $linkedin ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Linkedin','samathemes'). '"><i class="fa fa-linkedin"></i></a></li>';
				}
				if( ! empty( $gplus ) ) {
					$output .= '<li><a href="'. esc_url( $gplus ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Google plus','samathemes'). '"><i class="fa fa-google-plus"></i></a></li>';
				}
				if( ! empty( $youtube ) ) {
					$output .= '<li><a href="'. esc_url( $youtube ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Youtube','samathemes'). '"><i class="fa fa-youtube"></i></a></li>';
				}
				if( ! empty( $soundcloud ) ) {
					$output .= '<li><a href="'. esc_url( $soundcloud ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Soundcloud','samathemes'). '"><i class="fa fa-soundcloud"></i></a></li>';
				}
				if( ! empty( $behance ) ) {
					$output .= '<li><a href="'. esc_url( $behance ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Behance','samathemes'). '"><i class="fa fa-behance"></i></a></li>';
				}
				if( ! empty( $vimeo ) ) {
					$output .= '<li><a href="'. esc_url( $vimeo ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Vimeo','samathemes'). '"><i class="fa fa-vimeo-square"></i></a></li>';
				}
				if( ! empty( $instagram ) ) {
					$output .= '<li><a href="'. esc_url( $instagram ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Instagram','samathemes'). '"><i class="fa fa-instagram"></i></a></li>';
				}
				if( ! empty( $pinterest ) ) {
					$output .= '<li><a href="'. esc_url( $pinterest ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Pinterest','samathemes'). '"><i class="fa fa-pinterest"></i></a></li>';
				}
				if( ! empty( $tumblr ) ) {
					$output .= '<li><a href="'. esc_url( $tumblr ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Tumblr','samathemes'). '"><i class="fa fa-tumblr"></i></a></li>';
				}
				if( ! empty( $digg ) ) {
					$output .= '<li><a href="'. esc_url( $digg ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Digg','samathemes'). '"><i class="fa fa-digg"></i></a></li>';
				}
				if( ! empty( $lastfm ) ) {
					$output .= '<li><a href="'. esc_url( $lastfm ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Lastfm','samathemes'). '"><i class="fa fa-lastfm"></i></a></li>';
				}
				if( ! empty( $rss ) ) {
					$output .= '<li><a href="'. esc_url( $rss ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('RSS','samathemes'). '"><i class="fa fa-rss"></i></a></li>';
				}
			}
			$output .= '</ul>';
			
			return $output;
		}
		
		function insert_pricing_table( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'title'			=> '',
				'hoticon'		=> '',
				'style'			=> '',
				'price'			=> '',
				'currency'		=> '',
				'subtitle'		=> '',
				'features'		=> '',
				'btntitle'		=> '',
				'btnurl'		=> '',
				'target'		=> '_self',
				'cssclass'		=> '',
			), $atts));
			
			if( ! empty( $cssclass ) ) {
				$cssclass = ' '. $cssclass;
			}
			
			if( $style == 'dark' ) {
				$style = '';
			}
			if( ! empty( $style ) ) {
				$style = ' '. $style;
			}
			$output = '<div class="pricing_table'. $cssclass .'">
							<div class="price_block'. $style .'">';

			if( ! empty( $hoticon ) && $hoticon == 'yes' ) {
				$output .= '<div class="hot-icon"><span>'.__('hot', 'samathemes') .'</span></div>';
			}
			if( ! empty( $title ) ) {
				$output .= '<h3>'. esc_attr( $title ) .'</h3>';
			}
			if( !empty( $price ) ) {
				$output .= '<div class="price"><div class="price_figure">
								<span class="price_number">'. $price .' <small>'. $currency .'</small></span>';
								if( !empty( $subtitle ) ) {
									$output .= '<span class="price_tenure">'. esc_attr( $subtitle ) .'</span>';
								}
				$output .= '</div></div>';
			}
			$output .= '<ul class="features">';
			$column_features = explode( ",", $features );
			foreach ( $column_features as $feature ) {
				$output .= '<li>'. esc_attr( $feature ) .'</li>';
			}
			$output .= '</ul>';

			if( !empty( $btnurl ) ) {				
				$title_attr_link = ' title="'. esc_attr( strip_tags ( $title )) .'"';
				$output .= '<div class="footer"><a class="action_button" href="'.esc_url( $btnurl ) .' target="'. $target .'"'. $title_attr_link .'>'. esc_attr( $btntitle ) .'</a></div>';
			}
			$output .= '</div></div>';
			return $output;
		}
		
		function insert_team_member( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'style'			=> 'style1',
				'name'			=> '',
				'role'			=> '',
				'image'			=> '',
				'facebook'		=> '',
				'twitter'		=> '',
				'linkedin'		=> '',
				'gplus'			=> '',
				'cssclass'		=> '',
			), $atts));
			
			$output = '';
			$content = $this->remove_line_break( $content );
			if( ! empty( $cssclass ) ) {
				$cssclass = ' '. $cssclass;
			}
			if( $style == 'style1' ) {
				$output .= '<div class="teammemeber text-center'. $cssclass .'">';
				if( ! empty( $image ) ) {
					$output .= '<img src="'. esc_url( $image ) .'" class="img-responsive marg-auto margin-20" alt="'. esc_attr( strip_tags( $name ) ) .'">';
				}
				if( ! empty( $name ) ) {
					$output .= '<h3>'. esc_attr( $name ) .'</h3>';
				}
				if( ! empty( $role ) ) {
					$output .= '<h4><em>'. esc_attr( $role ) .'</em></h4>';
				}
				if( ! empty( $content ) ) {
					$output .= '<p>'. do_shortcode( $content ) .'</p>';
				}
				$output .= '<ul class="social-network-footer">';
				if( ! empty( $facebook ) ) {
					$output .= '<li><a href="'. esc_url( $facebook ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Facebook','samathemes'). '"><i class="fa fa-facebook"></i></a></li>';
				}
				if( ! empty( $twitter ) ) {
					$output .= '<li><a href="'. esc_url( $twitter ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Twitter','samathemes'). '"><i class="fa fa-twitter"></i></a></li>';
				}
				if( ! empty( $linkedin ) ) {
					$output .= '<li><a href="'. esc_url( $linkedin ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Linkedin','samathemes'). '"><i class="fa fa-linkedin"></i></a></li>';
				}
				if( ! empty( $gplus ) ) {
					$output .= '<li><a href="'. esc_url( $gplus ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Google plus','samathemes'). '"><i class="fa fa-google-plus"></i></a></li>';
				}		
				$output .= '</ul></div>';
			} elseif( $style == 'style2' ) {
				$output .= '<div class="teammemeber marg-bottom-20 text-center'. $cssclass .'"><div class="team-member">';
				if( ! empty( $image ) ) {
					$output .= '<div class="img-member"><img src="'. esc_url( $image ) .'" class="img-circle"></div>';
				}
				if( ! empty( $name ) ) {
					$output .= '<h3>'. esc_attr( $name ) .'</h3>';
				}
				if( ! empty( $role ) ) {
					$output .= '<h5>'. esc_attr( $role ) .'</h5>';
				}
				if( ! empty( $content ) ) {
					$output .= '<p>'. do_shortcode( $content ) .'</p>';
				}
				$output .= '<ul>';
				if( ! empty( $facebook ) ) {
					$output .= '<li><a href="'. esc_url( $facebook ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Facebook','samathemes'). '"><i class="fa fa-facebook"></i></a></li>';
				}
				if( ! empty( $twitter ) ) {
					$output .= '<li><a href="'. esc_url( $twitter ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Twitter','samathemes'). '"><i class="fa fa-twitter"></i></a></li>';
				}
				if( ! empty( $linkedin ) ) {
					$output .= '<li><a href="'. esc_url( $linkedin ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Linkedin','samathemes'). '"><i class="fa fa-linkedin"></i></a></li>';
				}
				if( ! empty( $gplus ) ) {
					$output .= '<li><a href="'. esc_url( $gplus ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Google plus','samathemes'). '"><i class="fa fa-google-plus"></i></a></li>';
				}		
				$output .= '</ul></div></div>';
			
			} else {
				$output .= '<div class="teammemeber row no-margin teams'. $cssclass .'">';
				if( ! empty( $image ) ) {
					$output .= '<div class="col-md-4 no-margin"><img src="'. esc_url( $image ) .'" class="img-circle"></div>';
				}
				$output .= '<div class="col-md-8 no-margin">';
				if( ! empty( $name ) ) {
					$output .= '<h4>'. esc_attr( $name ) .'</h4>';
				}
				
				if( ! empty( $role ) ) {
					$output .= '<h5>'. esc_attr( $role ) .'</h5>';
				}
				if( ! empty( $content ) ) {
					$output .= '<p>'. do_shortcode( $content ) .'</p>';
				}
				$output .= '<ul>';
				if( ! empty( $facebook ) ) {
					$output .= '<li><a href="'. esc_url( $facebook ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Facebook','samathemes'). '"><i class="fa fa-facebook"></i></a></li>';
				}
				if( ! empty( $twitter ) ) {
					$output .= '<li><a href="'. esc_url( $twitter ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Twitter','samathemes'). '"><i class="fa fa-twitter"></i></a></li>';
				}
				if( ! empty( $linkedin ) ) {
					$output .= '<li><a href="'. esc_url( $linkedin ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Linkedin','samathemes'). '"><i class="fa fa-linkedin"></i></a></li>';
				}
				if( ! empty( $gplus ) ) {
					$output .= '<li><a href="'. esc_url( $gplus ).'" data-thumb="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.__('Google plus','samathemes'). '"><i class="fa fa-google-plus"></i></a></li>';
				}		
				$output .= '</ul></div></div>';
			}
			
			return $output;
		}
		
		function insert_counter( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'title'			=> '',
				'type'			=> 'box',
				'icon'			=> '',
				'value'			=> '',
				'unit'			=> '',
				'cssclass'		=> '',
			), $atts));
			if( ! empty( $cssclass ) ) {
				$cssclass = ' '. $cssclass;
			}
			$css_counter = 'counter';
			$unit = esc_attr( $unit );
			$value =  $value ;
			if( $type == 'box' ) {
			$output = 	'<div class="animated" data-animation="fadeInUp"><div class="fun-facts text-center'.$cssclass.'">
							<div class="icon-facts">
								<i class="fa '. esc_attr($icon) .'"></i>
							</div>
							<div class="counter-wrapper"><span class="'. $css_counter .'">'. $value .'</span>'. $unit .'</div>
							<h5>'. esc_attr( $title ) .'</h5>
						</div></div>';
			} elseif ( $type == 'circle' ) {
				$output = 	'<div class="animated" data-animation="fadeInUp"><div class="cricle-process text-center animated'.$cssclass.'" data-animation="fadeInUp">
								<div class="counter-wrapper"><span class="'.$css_counter.'">'. $value .'</span>'. $unit .'</div>
								<h5>'. esc_attr( $title ) .'</h5>
							</div></div>';
			} else {
				$output = '<div class="animated" data-animation="fadeInUp"><div class="counter-wrapper text-center animated'.$cssclass.'" data-animation="fadeInUp"><span class="'. $css_counter .' bord-bottom">'. $value .'</span>'. esc_attr( $unit ) .' '. esc_attr( $title ) .'</div></div>';
			}
			
			return $output;
		}
		
		function insert_gmaps( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				'title'			=> '',
				'latlang'		=> '',
				'zoom'			=> '',
				'image'			=> '',
				'cssclass'		=> '',
			), $atts));
			if( ! empty( $cssclass ) ) {
				$cssclass = ' '. $cssclass;
			}
			$title 		= esc_attr( $title );
			$latlang 	= esc_attr($latlang);
			$zoom 		= absint($zoom);
			$image 		= esc_url($image);
			$id = rand(1, 999);
			$output	= '<div id="custom-map" class="map custom-google-map'. $cssclass .'" data-mape-title="'. $title .'" data-map-latlang="'. $latlang .'" data-map-zoom="'. $zoom .'" data-map-image="'.$image.'"></div>';
			return $output;
		}
		
		function insert_timer( $atts, $content = null ) {
			$tp_years = $tp_days = $tp_hours = $tp_minutes = $tp_seconds = '';
			extract(shortcode_atts(array( 
				'date'			=> '',	//Date format yy/mm/dd/ ex 2015/10/30 or ex 2015/02/09'
				'hours'			=> '00',	// 23
				'minutes' 		=> '00',	// 59
				'bgcolor'		=> '',	// empty or cssclass ='bgblockcolor'
				'cssclass'      => '',
			), $atts));
			
			$mins = $minutes;
			if( empty( $date ) ) {
				return;
			}
			
			if( ! empty( $bgcolor ) ) {
				$bgcolor = ' bgblockcolor';
			}
			if( ! empty( $cssclass ) ) {
				$cssclass = ' '. $cssclass;
			}
			
			$target_time 		= $date . ' '. $hours .':'. $mins . ':00';
			$target_time_unx 	= strtotime( $target_time );
			$now_time_unx		= (int) current_time( 'timestamp' );
			$difference 		=  $target_time_unx - $now_time_unx;
			$difference 		= ($difference < 0) ? $difference = 0 : $difference;
			
			
			$output = '';
			if( $difference < 1 ) {
				$output .= do_shortcode( $content );
			} else {
				
				$target_year 	= getdate($target_time_unx);
				$current_year 	= getdate($now_time_unx);
				
				$output .= '<div id="clock-ticker" class="countdown-timer timer-main'. $cssclass .'">';
				$output .= '<input type="hidden" class="tp-widget-date" value="'. $date .'" />
						<input type="hidden" class="tp-widget-time" value="'. $hours .':'. $mins .':00" />';
						
				$seconds	=	1000;
				$minutes	=	$seconds*60;
				$hours		=	$minutes*60;
				$days		=	$hours*24;
				$years		=   $days*365;
				
				$difference = $difference * 1000;
				$tp_years 	= floor( $difference / $years ); 
				$tp_days 	= floor( $difference / $days ) - ( $tp_years * 365 );
				$tp_hours 	= floor( $difference/ $hours )-( $tp_days*24 )-( $tp_years*365*24 );
				$tp_minutes = floor( $difference/ $minutes )-( $tp_hours*60 )-( $tp_days*24*60 )-( $tp_years*365*24*60 );
				$tp_seconds = floor( $difference/ $seconds )-( $tp_minutes*60 )-( $tp_hours*60*60 )-( $tp_days*60*24*60 )-( $tp_years*365*24*60*60 );
				//echo  $tp_years . ':'. $tp_days. ':'. ($tp_hours - 2) .':'. $tp_minutes . ':'. $tp_seconds;		
				
				if( $target_year['year'] > $current_year['year'] ) {
					$output .= '<div class="block'. $bgcolor .'">
									<span class="flip-top year" id="years" class="year">'. $tp_years .'</span>
									<span class="flip-btm"></span>
									<footer class="label">'.__('Year', 'samathemes').'</footer>
								</div>';
				}
				$output .= ' <div class="block'. $bgcolor .'">
								<span class="flip-top days" id="numdays">'. $tp_days .'</span>
								<span class="flip-btm"></span>
								<footer class="label">'.__('Days', 'samathemes').'</footer>
							</div>';
				$output .= ' <div class="block'. $bgcolor .'">
								<span class="flip-top hours" id="numhours">'. ($tp_hours) .'</span>
								<span class="flip-btm"></span>
								<footer class="label">'.__('Hours', 'samathemes').'</footer>
							</div>';
				$output .= ' <div class="block'. $bgcolor .'">
								<span class="flip-top mins" id="nummins">'. $tp_minutes .'</span>
								<span class="flip-btm"></span>
								<footer class="label">'.__('Minutes', 'samathemes').'</footer>
							</div>';
				$output .= ' <div class="block'. $bgcolor .'">
								<span class="flip-top secs" id="numsecs">'. $tp_seconds .'</span>
								<span class="flip-btm"></span>
								<footer class="label">'.__('Seconds', 'samathemes').'</footer><br>
							</div>';
				$output .= '</div>';
			}
			
			return $output;
		}
		/*
		 * This function used to remove <p></p> tags if empty inside shortcode
		 *
		 */
		function remove_empty_p_tag( $content ) {
			
			$content = $this->remove_line_break($content);
			$patterns = array('#^\s*</p>#','#<p>\s*$#');
			return preg_replace($patterns, '', $content);
			
		}
		
		function remove_line_break( $content ) {
			$content = str_replace('<br class="removebr" />', '', $content);
			return $content;
		}
	}
		
	new Sama_ShortCodes();

}
?>