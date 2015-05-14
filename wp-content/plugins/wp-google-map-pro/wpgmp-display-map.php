<?php
function wpgmp_display_map($atts){
	
 ob_start();
 global $wpdb;
 	
 include_once dirname(__FILE__).'/class-google-map.php';

 $map = new Wpgmp_Google_Map();

 $marker_array = array();
 $address_array = array();
 foreach ($atts as $key => $value) {
    if ( strpos($key, 'marker') === 0 )
	{
        $marker_array[$key] = $value;
		$first_marker = current($marker_array);
 		$explode_marker = explode('|',$first_marker);
		$map->center_lat = $explode_marker[0];
    	$map->center_lng = $explode_marker[1];
    }
	if( strpos($key, 'address') === 0 )
	{
		$address_array[$key] = $value;
		$first_address = current($address_array);
		$rm_space_ads = str_replace(' ','+',$first_address);
		$explode_ads = explode('|',$rm_space_ads);
		$geocode=wp_remote_get('http://maps.google.com/maps/api/geocode/json?address='.$explode_ads[0].'&sensor=false');
		$output= json_decode($geocode['body']);
		$map->center_lat = $output->results[0]->geometry->location->lat;
		$map->center_lng = $output->results[0]->geometry->location->lng;
	}
 }

 if(isset($atts['width']))
 $map->map_width = $atts['width'];
 
 if(isset($atts['height']))
 $map->map_height = $atts['height'];
 
 if(isset($atts['zoom']))
 $map->zoom = $atts['zoom'];

 if(empty($atts['zoom']))
 $map->zoom = 14;

 if(is_array($marker_array)) {
	 foreach($marker_array as $marker){
		 $explode_marker = explode('|',$marker);
		 
		 if(isset($explode_marker[5]) and $explode_marker[5]!='')
		 {
			$icon = $wpdb->get_row($wpdb->prepare('SELECT group_marker FROM '.$wpdb->prefix.'group_map WHERE group_map_id=%d',$explode_marker[5]));
			
			$icon = $icon->group_marker;
		 }
		 else
		 {
			 $icon = '';
		 }
		 
		 if(isset($explode_marker[4]) and $explode_marker[4]=='')
		 {
			 $clickable = 'true';
		 }
		 elseif(isset($explode_marker[4]))
		 {
			 $clickable = trim($explode_marker[4]);
		 }
		 
		 if(empty($explode_marker[3]))
		 {
			 $draggable = 'false';
		 }
		 else
		 {
			 $draggable = trim($explode_marker[3]);
		 }
		
		if(!isset($explode_marker[2]))
		$explode_marker[2] = "";

		if(!isset($clickable))
			$clickable = true;

		$map->addMarker(rand(500000, 1000000),'',$explode_marker[0],$explode_marker[1],$clickable,'',$explode_marker[2],$icon,'',$draggable,'',$group_id='');
	 }
 }
 
 if(is_array($address_array)) {
	  foreach($address_array as $address) {
		$explode_address = explode('|',$address); 		  
		$rm_space_ads = str_replace(' ','+',$explode_address[0]);
		$geocode=wp_remote_get('http://maps.google.com/maps/api/geocode/json?address='.$rm_space_ads.'&sensor=false');
		$output= json_decode($geocode['body']);
		$lat = $output->results[0]->geometry->location->lat;
		$lng = $output->results[0]->geometry->location->lng; 
		   
		if(isset($explode_address[4]) and $explode_address[4]!='')
		{
			$icon_image = $wpdb->get_row($wpdb->prepare('SELECT group_marker FROM '.$wpdb->prefix.'group_map WHERE group_map_id=%d',$explode_address[4]));
			
			$icon = $icon_image->group_marker;
		}
		else
		{
			 $icon = '';
		}
		 
		if(empty($explode_address[2]))
		{
			 $clickable = 'true';
		}
		else
		{
			 $clickable = $explode_address[2];
		}
		 
		 if(isset($explode_address[3]) and $explode_address[3]=='')
		{
			 $draggable = 'false';
		}
		else if(isset($explode_address[3]))
		{
			 $draggable = $explode_address[3];
		} 
		else
		 $draggable = 'false'; 

		if(!isset($explode_address[1])) { $content = ""; } 
		else { $content = $explode_address[1]; }


		$map->addMarker(rand(500000, 1000000),'',$lat,$lng,$clickable,'',$content,$icon,'',$draggable,'',$group_id='');
	 }
 }
 
 echo $map->showmap();
 $content =  ob_get_contents();
 ob_clean();
 return $content;
}
