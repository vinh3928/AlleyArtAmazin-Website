<?php
	/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */
class Rozana_walker_nav_menu extends Walker_Nav_Menu {
  
  
	// add main/sub classes to li's and links
	function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		
		$icon_css = ''; // used to add fortawesome
		$scroll   = '';
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
		
		if( ! empty( $item->classes ) ) {
			
			foreach( $item->classes as $key => $val ) {
				
				if( 'scroll' == $val ) {
					$scroll = 'scroll';
					unset( $item->classes[ $key ] );
				}
				if( strpos( $val, 'fa-' ) !== false ) {
					$icon_css = $val;
					unset( $item->classes[ $key ] );
				}
				
				if( 'fa' == $val ) {
					unset( $item->classes[ $key ] );
				}

			}
		}
		$link_css = 'menu-link';
		if( ! empty( $scroll ) ) {
			$link_css .= ' '. $scroll;
		}
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	  
		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
		
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="'. $link_css .' ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		
		if( $icon_css ) {
			$icon_css = '<i class="fa '. $icon_css .'"></i> ';
		}
	  
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
			$args->before,
			$attributes,
			$icon_css,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
	  
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
?>