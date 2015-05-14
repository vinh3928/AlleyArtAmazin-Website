<?php
function wpgmp_display_map_location($atts, $content=null){
	 	
 global $wpdb;

  
 $map_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."create_map where map_id=%d",trim($atts["id"]) ));
 
 $map_location_ids = unserialize($map_data->map_locations);
 
 $map_control_setting  = unserialize($map_data->map_all_control);
 
 $js='';
 
 if(isset($map_control_setting['wpgmp_search_display']) && $map_control_setting['wpgmp_search_display']==true)
 {
	 
 $js='
 <div class="wpgmp_listing_header"> 
 <div class="wpgmp_search_form">'.wpgmp_search_form($atts["id"]).'</div>
 </div>';
 }
 
 $js.= do_shortcode($map_control_setting['wpgmp_before_listing']);

 $js.='<div id="wpgmp_locations_listing'.$atts["id"].'" class="wpgmp_locations_listing wpgmp_loading" rel="'.$atts["id"].'"></div>

<script type="text/javascript" >
jQuery(document).ready(function($) {
		wpgmp_filter_locations('.$atts["id"].',1);	
});
</script>';
 
 return $js;
 
}

add_action( 'wp_ajax_wpgmp_get_map_location', 'wpgmp_get_map_location_ajax' );
add_action( 'wp_ajax_nopriv_wpgmp_get_map_location', 'wpgmp_get_map_location_ajax' );

function wpgmp_get_map_location_ajax() {
	
	global $wpdb; // this is how you get access to the database

	$map_id = intval( $_POST['map_id'] );

    if(@$_POST['search_text']!="")
    {		
		$options['search']=$_POST['search_text'];	
	}
	
	if(@$_POST['is_near_by']!="")
    {
		$options['is_near_by']=$_POST['is_near_by'];
		$options['near_by_lat']=$_POST['near_by_lat'];
		$options['near_by_lng']=$_POST['near_by_lng'];
	}
	
	
	if(@$_POST['filter_category']!='')
	{
	
	$options['filter_category']=$_POST['filter_category'];
		
	}
	
	if(@$_POST['location_ids']!="")
	{
		$options['location_ids']=$_POST['location_ids'];
	}
	
	if($_POST['page']!="")
	{
		$options['page']=$_POST['page'];
	}
	else
	$options['page']=1;
	
	if(@$_POST['do_export']=='true')
	{
		$options['do_export']=true;
		$options['export_format']=$_POST['export_format'];
		
	
		
		wpgmp_get_map_location($map_id,$options);
		die();
	}
    else
    echo wpgmp_get_map_location($map_id,$options);

	die(); // this is required to return a proper result
}

function wpgmp_get_map_location($map_id, $options=''){
	
    global $wpdb;
    
    add_action('wp_head','wpgmp_load_css');
    
   include_once(plugin_dir_path( __FILE__ )."/csspagination.class.php");
    
    $map_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."create_map where map_id=%d",trim($map_id) ));
 
    $map_location_ids = unserialize($map_data->map_locations);
 
    $map_control_setting  = unserialize($map_data->map_all_control);
    
    $soryby = "location_title";
    if($map_control_setting['wpgmp_categorydisplaysort'] == 'title')
     $soryby = "location_title";
    elseif($map_control_setting['wpgmp_categorydisplaysort'] == 'address')
	 $soryby = "location_address";
    elseif($map_control_setting['wpgmp_categorydisplaysort'] == 'category')
	 $soryby = "group_map_title";
	 
	 
	if($map_control_setting['wpgmp_listing_number']>0)
	$locations_per_page=$map_control_setting['wpgmp_listing_number'];
	else
	$locations_per_page=10;
   
   	if(is_array($map_location_ids))
    $find_ids=implode(',',$map_location_ids);
	else
	$find_ids=0;
		
	if(@$options['is_near_by']=='true')
	{
	
	$near_by_lat=$options['near_by_lat'];
	$near_by_lng=$options['near_by_lng'];
	
	 $query="SELECT *, ( 3959 * acos( cos( radians($near_by_lat) ) * cos( radians( location_latitude ) ) * cos( radians( location_longitude ) - radians($near_by_lng) ) + sin( radians($near_by_lat) ) * sin( radians( location_latitude ) ) ) ) AS distance FROM ".$wpdb->prefix."map_locations HAVING distance < 25 ORDER BY distance";
	
	}
    
    else if(@$options['location_ids']!='')
   {
	 $search='%'.$options['search'].'%';

	 $query=$wpdb->prepare("SELECT *,".$wpdb->prefix."group_map.group_map_title FROM ".$wpdb->prefix."map_locations left join ".$wpdb->prefix."group_map ON ".$wpdb->prefix."map_locations.location_group_map=".$wpdb->prefix."group_map.group_map_id where location_id in ( ".$options['location_ids']." ) ",null);	
   
   }
   else if(@$options['filter_category']!='')
   {
	 $search='%'.$options['search'].'%';
		
	 $query=$wpdb->prepare("SELECT *,".$wpdb->prefix."group_map.group_map_title FROM ".$wpdb->prefix."map_locations left join ".$wpdb->prefix."group_map ON ".$wpdb->prefix."map_locations.location_group_map=".$wpdb->prefix."group_map.group_map_id where location_id in ( $find_ids ) and ((location_address like %s ) or ( location_title like %s ) or ( location_latitude like %s ) or ( location_longitude like %s )) and ( location_group_map in (".$options['filter_category'].") ) ",$search,$search,$search,$search);	
   
   }
   else if(@$options['search']!='')
   {
	 $search='%'.$options['search'].'%';
		
	 $query=$wpdb->prepare("SELECT *,".$wpdb->prefix."group_map.group_map_title FROM ".$wpdb->prefix."map_locations left join ".$wpdb->prefix."group_map ON ".$wpdb->prefix."map_locations.location_group_map=".$wpdb->prefix."group_map.group_map_id where location_id in ( $find_ids ) and ((location_address like %s ) or ( location_title like %s ) or ( location_latitude like %s ) or ( location_longitude like %s ) or ( location_group_map in (select group_map_id from ".$wpdb->prefix."group_map where group_map_title like %s) )) ",$search,$search,$search,$search,$search,$search);	
   
   }
   else
    $query=$wpdb->prepare("SELECT *,".$wpdb->prefix."group_map.group_map_title FROM ".$wpdb->prefix."map_locations left join ".$wpdb->prefix."group_map ON ".$wpdb->prefix."map_locations.location_group_map=".$wpdb->prefix."group_map.group_map_id where location_id in ( $find_ids ) and 1 = %d ",'1');	

 
     $meta_data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key='_wpgmp_map_id'");
 

   $map_locations = new Wpgmp_Pagination($query,$locations_per_page,$options['page'],trim($map_id));
    
   $map_locations_records=$map_locations->GetResult();
	//$map_locations_records= $wpdb->get_results($query);
   if(!empty($meta_data))
	{   
		foreach($meta_data as $mdata)
		{
			
			$s_maps = get_post_meta( $mdata->post_id, '_wpgmp_map_id', true );
		
			$map_ids = unserialize($s_maps);
			
			if(is_array($map_ids) and in_array($map_id,$map_ids))
			
			{
				
				$wpgmp_location_address = get_post_meta( $mdata->post_id, '_wpgmp_location_address', true );
				$wpgmp_metabox_marker_id = get_post_meta( $mdata->post_id, '_wpgmp_metabox_marker_id', true );
			    $wpgmp_metabox_latitude = get_post_meta( $mdata->post_id, '_wpgmp_metabox_latitude', true );
			    $wpgmp_metabox_longitude = get_post_meta( $mdata->post_id, '_wpgmp_metabox_longitude', true);
				$marker_detail = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."group_map WHERE group_map_id=".$wpgmp_metabox_marker_id."");
				
				if(@$options['filter_category']!='')
				{
					$find_in_categories = explode(',',$options['filter_category']);
					if(in_array($wpgmp_metabox_marker_id,$find_in_categories) != true)
					continue;
				}
				else if(@$options["search"]!="" and stristr(@$post->post_title,$options["search"]) === false and stristr($wpgmp_location_address,$options["search"])===false)
				{
					continue;
				}
				
				global $post;  
				$save_post = $post;
				$post = get_post($mdata->post_id);
				setup_postdata( $post );
				$location_object =  new StdClass;
				$location_object->location_title=get_the_title($mdata->post_id);
				$message_format["googlemap_infowindow_message_one"] = $post->post_excerpt;
				wp_reset_postdata($save_post);
				$location_object->location_id = 2000 + $mdata->post_id;
				
				$location_object->location_messages=base64_encode(serialize($message_format));
				$location_object->location_address=$wpgmp_location_address;
				$location_object->location_latitude=$wpgmp_metabox_latitude;
				$location_object->location_longitude=$wpgmp_metabox_longitude;
				$marker_title = $wpdb->get_row('SELECT group_map_title FROM '.$wpdb->prefix.'group_map WHERE group_map_id='.$wpgmp_metabox_marker_id);
		
				$location_object->group_map_title=$marker_title->group_map_title;
				$location_object->location_group_map=$wpgmp_metabox_marker_id;
				$map_locations_records[]=$location_object;
			   
			}
		}
	
		
	} 

	   // here provide a filter to load data from custom tables or custom fields

$custom_markers = array(); 
$all_custom_markers = apply_filters('wpgmp_marker_source',$custom_markers,$map_id); 

if(is_array($all_custom_markers ) and !empty($all_custom_markers ))
{
	$new_markers_filters = array();
	$all_group_marker = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."group_map",null));

  if(is_array($all_group_marker))
  {
    $category_data = array();
    foreach($all_group_marker as $group_category) {
      $category_data[$group_category->group_map_title] ['id'] = $group_category->group_map_id;
      $category_data[$group_category->group_map_title] ['icon'] = $group_category->group_marker;
    }
  }
	foreach($all_custom_markers as $marker)
	{
		
		if($options['filter_category']!='')
				{
					$find_in_categories = explode(',',$options['filter_category']);
					if(in_array($category_data[$marker['category']]['id'],$find_in_categories) != true)
					continue;
				}
				else if($options["search"]!="" and stristr($marker['title'],$options["search"]) === false and stristr($marker['address'],$options["search"])===false)
				{
					continue;
				}
		$x = new stdClass();
		
		if(!isset($marker['id']) or $marker['id']=="")
         $x->location_id = rand(3000,10000);
     	else
     	 $x->location_id = $marker['id'];	
		
		$x->location_title = $marker['title'];
		$x->location_address=$marker['address'];
		$x->location_latitude=$marker['latitude'];
		$x->location_longitude=$marker['longitude'];
		$x->group_map_title=$marker['category'];
		$x->location_group_map=$category_data[$marker['category']]['id'];
		$x->location_messages=$marker['message'];
		$new_markers_filters[] = $x;
	}
	$map_locations_records= array_merge($map_locations_records,$new_markers_filters );


}

	$map_locations_records = apply_filters("wpgmp_map_listing",$map_locations_records);
	   
	   
	
	    if($soryby == "location_title")
		uasort($map_locations_records,'wpgmp_comparelocationElems');
		elseif($soryby == "location_address")
		uasort($map_locations_records,'wpgmp_compareaddressElems');
		elseif($soryby == "group_map_title")
		uasort($map_locations_records,'wpgmp_comparecategoryElems');
     $total_counter = count($map_locations_records);
   
   
    if($options['page'])
     $staringlocation = ($options['page']-1)*($locations_per_page);
    else
     $staringlocation = 0;
   

     
  $map_locations_records = array_slice($map_locations_records,$staringlocation,$locations_per_page);
   $content ="";
    if(!empty($map_locations_records))
	{
	
		
	    
    $content='<div class="wpgmp_categoriese">';	
	
	foreach($map_locations_records as $map_locations_record) {

	$messages = unserialize(base64_decode($map_locations_record->location_messages));
	$marker_categories = $wpdb->get_row('SELECT * FROM '.$wpdb->prefix.'group_map WHERE group_map_id='.$map_locations_record->location_group_map);
	
	$html_string = stripcslashes($map_control_setting["wpgmp_categorydisplayformat"]);
	
	$variables = array(
		"marker_link" => 'javascript:open_current_location(marker'.$map_locations_record->location_id.'map2)',
		"location_title" => $map_locations_record->location_title,
		"location_address" => stripcslashes($map_locations_record->location_address),
		"location_message" 	=> stripcslashes($messages['googlemap_infowindow_message_one']),
		"location_latitude" => $map_locations_record->location_latitude,
		"location_longitude" => $map_locations_record->location_longitude);
		
	if(@$marker_categories->group_marker!='')
	$variables["marker_image"] = "<img src=".$marker_categories->group_marker." />";
    else
    $variables["marker_image"] = "";
    
    
    if(@$marker_categories->group_map_title!='')
	$variables["category_title"] = $marker_categories->group_map_title;
	else
	$variables["category_title"] = "";
	
	$list_content = apply_filters("wpgmp_listing_html",wpgmp_dynamic_string($html_string,$variables),$variables,$mdata->post_id,$map_id);
	
	$content.= $list_content;
	}

	
	$content.='</div><div>'.$map_locations->showPage($total_counter).'</div>';

}
else
	echo "<div class='wpgmp_no_results'>".__("No Locations found.",'wpgmp_google_map')."</div>";


    return $content;
}

function wpgmp_dynamic_string($search, $replace){
    preg_match_all("/\{(.+?)\}/", $search, $matches);

    if (isset($matches[1]) && count($matches[1]) > 0){
        foreach ($matches[1] as $key => $value) {
            if (array_key_exists($value, $replace)){
                $search = preg_replace("/\{$value\}/", $replace[$value], $search);
            }
        }
    }
    return $search;
}

function wpgmp_search_form($map_id)
{

$search_form="<input type='text' rel='".$map_id."' name='wpgmp_search_input' class='wpgmp_search_input' placeholder='".__("Enter address or latitude or longitude or category or title here...",'wpgmp_google_map')."'>";	

return $search_form;	
}
