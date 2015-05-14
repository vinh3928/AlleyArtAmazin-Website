<?php
/**
 * This function used to create a new map in backend.
 * @author Flipper Code <hello@flippercode.com>
 * @version 1.0.0
 * @package Maps
 */
function wpgmp_create_map()
{
if( isset($_POST['create_map_location']) && $_POST['create_map_location']=="Save Map" )
{
  
  
if( empty($_POST['map_title']) )
{
   $error[]= __( 'Please enter title.', 'wpgmp_google_map' );
}
if( !intval($_POST['map_width']) && !empty($_POST['map_width']) )
{
  $error[]= __( 'Please enter Integer value in map width.', 'wpgmp_google_map' );
}
if( empty($_POST['map_height']) )
{
  $error[]= __( 'Please enter map height.', 'wpgmp_google_map' );
}
else if( !intval($_POST['map_height']) )
{
  $error[]= __( 'Please enter Integer value in map height.', 'wpgmp_google_map' );
}
if( !empty($_POST['direction_servics']['route_direction']) )
{
  if( empty($_POST['direction_servics']['specific_routes']) ) 
  {
    $error[]= __( 'Please choose a route.', 'wpgmp_google_map' ); 
  }
}
if( empty($_POST['scrolling_wheel']) )
{
  $_POST['scrolling_wheel'] = 'true';
}
else
{
  $_POST['scrolling_wheel'] = $_POST['scrolling_wheel'];
}
if( empty($_POST['visual_refresh']) )
{
    $_POST['visual_refresh'] = 'false';
}
else
{
  $_POST['visual_refresh'] = $_POST['visual_refresh'];
}
if( empty($_POST['45imagery']) )
{
    $_POST['45imagery'] = "";
}
else
{
  $_POST['45imagery'] = $_POST['45imagery'];
}
if( empty($_POST['street_view_control']['street_control']) )
{
   $_POST['street_view_control']['street_control'] = 'false';
}
else
{
  $_POST['street_view_control']['street_control'] = $_POST['street_view_control']['street_control'];
}
if( empty($_POST['street_view_control']['street_view_close_button']) )
{
   $_POST['street_view_control']['street_view_close_button'] = 'false';
}
else
{
  $_POST['street_view_control']['street_view_close_button'] = $_POST['street_view_control']['street_view_close_button'];
}
if( empty($_POST['street_view_control']['links_control']) )
{
   $_POST['street_view_control']['links_control'] = 'true';
}
else
{
  $_POST['street_view_control']['links_control'] = $_POST['street_view_control']['links_control'];
}
if( empty($_POST['street_view_control']['street_view_pan_control']) )
{
   $_POST['street_view_control']['street_view_pan_control'] = 'true';
}
else
{
  $_POST['street_view_control']['street_view_pan_control'] = $_POST['street_view_control']['street_view_pan_control'];
}
if( empty($_POST['control']['pan_control']) )
{
   $_POST['control']['pan_control'] = 'true';
}
else
{
  $_POST['control']['pan_control'] = $_POST['control']['pan_control'];
}
if( empty($_POST['control']['zoom_control']) )
{
   $_POST['control']['zoom_control'] = 'true';
}
else
{
  $_POST['control']['zoom_control'] = $_POST['control']['zoom_control'];
}
if( empty($_POST['control']['map_type_control']) )
{
   $_POST['control']['map_type_control'] = 'true';
}
else
{
  $_POST['control']['map_type_control'] = $_POST['control']['map_type_control'];
}
if( empty($_POST['control']['scale_control']) )
{
   $_POST['control']['scale_control'] = 'true';
}
else
{
  $_POST['control']['scale_control'] = $_POST['control']['scale_control'];
}
if( empty($_POST['control']['street_view_control']) )
{
   $_POST['control']['street_view_control'] = 'true';
}
else
{
  $_POST['control']['street_view_control'] = $_POST['control']['street_view_control'];
}
if( empty($_POST['control']['overview_map_control']) )
{
   $_POST['control']['overview_map_control'] = 'true';
}
else
{
  $_POST['control']['overview_map_control'] = $_POST['control']['overview_map_control'];
}
if( empty($_POST['control']['drawing_control']) )
{
   $_POST['control']['drawing_control'] = 'true';
}
if( empty($_POST['info_window_setting']['info_window']) )
{
   $_POST['info_window_setting']['info_window'] = 'true';
}
else
{
  $_POST['info_window_setting']['info_window'] = $_POST['info_window_setting']['info_window'];
}

if( !empty($_POST['group_map_setting']['enable_group_map']) && $_POST['group_map_setting']['enable_group_map']=='true' )
{
  if( empty($_POST['group_map_setting']['select_group_map']) )
  {
    $error[]= __( 'Please check at least one group map.', 'wpgmp_google_map' );
  }
}
if( !empty($_POST['layer_setting']['choose_layer']['kml_layer']) && $_POST['layer_setting']['choose_layer']['kml_layer']=="KmlLayer" && empty($_POST['layer_setting']['map_links']) )
{
  $error[]= __( 'Please insert KML link.', 'wpgmp_google_map' );
}
if( !empty($_POST['layer_setting']['choose_layer']['fusion_layer']) && $_POST['layer_setting']['choose_layer']['fusion_layer']=="FusionTablesLayer" && empty($_POST['layer_setting']['fusion_select']) )
{
  $error[]= __( 'Please insert Fusion Select.', 'wpgmp_google_map' );
}
if( !empty($_POST['layer_setting']['choose_layer']['fusion_layer']) && $_POST['layer_setting']['choose_layer']['fusion_layer']=="FusionTablesLayer" && empty($_POST['layer_setting']['fusion_from']) )
{
  $error[]= __( 'Please insert Fusion From.', 'wpgmp_google_map' );
}
if( !empty($_POST['layer_setting']['choose_layer']['fusion_layer']) && $_POST['layer_setting']['choose_layer']['fusion_layer']=="FusionTablesLayer" && empty($_POST['layer_setting']['heat_map']) )
{
  $_POST['layer_setting']['heat_map'] = 'false';
}
if( empty($_POST['cluster_setting']['marker_cluster']) )
{
  $_POST['cluster_setting']['marker_cluster'] = 'false';
}
else
{
  $_POST['cluster_setting']['marker_cluster'] = $_POST['cluster_setting']['marker_cluster'];
}
if( $_POST['cluster_setting']['marker_cluster']=='true' )
{
  if( empty($_POST['cluster_setting']['grid']) )
  {
     $error[]= __( 'Please enter grid.', 'wpgmp_google_map' );
  }
  else if( !intval($_POST['cluster_setting']['grid']) )
  {
    $error[]= __( 'Please enter Integer value in grid.', 'wpgmp_google_map' );
  }
}
else
{
  $_POST['cluster_setting']['grid'] = '15';
  $_POST['cluster_setting']['map_style'] = '-1';
  $_POST['cluster_setting']['max_zoom'] = '1';
}
if( !empty($_POST['overlay_setting']['overlay']) )
{
  $_POST['overlay_setting']['overlay'] = $_POST['overlay_setting']['overlay'];
  if( empty($_POST['overlay_setting']['overlay_width']) )
  {
     $error[]= __( 'Please enter overlay width.', 'wpgmp_google_map' );
  } else if( !intval($_POST['overlay_setting']['overlay_width']) ) {
    $error[]= __( 'Please enter Integer value in overlay width.', 'wpgmp_google_map' );
  }
  if( empty($_POST['overlay_setting']['overlay_height']) )
  {
     $error[]= __( 'Please enter overlay height.', 'wpgmp_google_map' );
  } else if( !intval($_POST['overlay_setting']['overlay_height']) ) {
    $error[]= __( 'Please enter Integer value in overlay height.', 'wpgmp_google_map' );
  }
  if( empty($_POST['overlay_setting']['overlay_fontsize']) )
  {
     $error[]= __( 'Please enter overlay Font Size.', 'wpgmp_google_map' );
  } else if( !intval($_POST['overlay_setting']['overlay_fontsize']) ) {
    $error[]= __( 'Please enter Integer value in overlay Font Size.', 'wpgmp_google_map' );
  }
  if( empty($_POST['overlay_setting']['overlay_border_width']) )
  {
     $error[]= __( 'Please enter overlay border width.', 'wpgmp_google_map' );
  } else if( !intval($_POST['overlay_setting']['overlay_border_width']) ) {
    $error[]= __( 'Please enter Integer value in overlay border width.', 'wpgmp_google_map' );
  }
}
else
{
  $_POST['overlay_setting']['overlay'] = 'false';
  $_POST['overlay_setting']['overlay_border_color'] = 'f22800';
  $_POST['overlay_setting']['overlay_width'] = '200'; 
  $_POST['overlay_setting']['overlay_height'] = '200';
  $_POST['overlay_setting']['overlay_fontsize'] = '16';
  $_POST['overlay_setting']['overlay_border_width'] = '2';
  $_POST['overlay_setting']['overlay_border_style'] = 'default';
}

if( !empty($_POST['control']['display_marker_category']) && $_POST['control']['display_marker_category']==true)
{
  
  if(empty($_POST['control']['category_font_size']))
  {
    $_POST['control']['category_font_size'] = '15';
  }
  
  if(empty($_POST['control']['location_font_size']))
  {
    $_POST['control']['location_font_size'] = '14';
  }
}

if( empty($error) )
{

  $width_pos = strpos($_POST['map_width'], "px");
  if ($width_pos === false)
  {
    $_POST['map_width'] = $_POST['map_width'];
  }
  else
  {
    $_POST['map_width'] = trim( str_replace("px", "", $_POST['map_width']) );
  }

  $height_pos = strpos($_POST['map_height'], "px");
  if ($height_pos === false)
  {
    $_POST['map_height'] = $_POST['map_height'];
  }
  else
  {
    $_POST['map_height'] = trim( str_replace("px", "", $_POST['map_height']) );
  }


global $wpdb;
$map_table=$wpdb->prefix.'create_map';
$create_map_data = array(
  'map_title' => htmlspecialchars(stripslashes($_POST['map_title'])),
  'map_width' => $_POST['map_width'],
  'map_height' => $_POST['map_height'],
  'map_zoom_level' => $_POST['zoom_level'],
  'map_type' => $_POST['choose_map'],
  'map_scrolling_wheel' => $_POST['scrolling_wheel'],
  'map_visual_refresh' => $_POST['visual_refresh'],
  'map_45imagery' => $_POST['45imagery'],
  'map_street_view_setting' => serialize($_POST['street_view_control']),
  'map_route_direction_setting' => ((isset($_POST['direction_servics'])) ? serialize($_POST['direction_servics']) : serialize('')),
  'map_all_control' => serialize($_POST['control']),
  'style_google_map' => serialize($_POST['style_array_type']),
  'map_locations' => ((isset($_POST['locations'])) ? serialize($_POST['locations']) : serialize('')),
  'map_layer_setting' => serialize($_POST['layer_setting']),
  'map_cluster_setting' => serialize($_POST['cluster_setting']),
  'map_overlay_setting' => serialize($_POST['overlay_setting']),
  'map_infowindow_setting' => serialize(base64_encode(($_POST['control']['infowindow_setting'])))
  );
$wpdb->insert($map_table,$create_map_data);
$success = __( 'Map created successfully. You can manage your maps <a href="'.admin_url('admin.php?page=wpgmp_google_wpgmp_manage_map').'">here</a>.', 'wpgmp_google_map' );
//$_POST = '';
}
}
?>
<div class="wpgmp-wrap">
  
  <div class="col-md-11">
    
    <div id="icon-options-general" class="icon32"><br></div>
  
   <script>
     
   jQuery(document).ready(function($){
     
     $('.filter_location').change(function () {
       
      what_value=$(this).val();
       if(what_value>0)   
       {
        $('td[class^="group"]').parent().hide();
          $('td[class="group'+$(this).val()+'"]').parent().show();
       }
       else
       $('td[class^="group"]').parent().show();
       
       } );
     
     
     });
     
   </script>
   
   
    <h3><span class="glyphicon glyphicon-asterisk"></span>
      <?php _e('Create a Map', 'wpgmp_google_map')?>
    </h3>
    
    <div class="wpgmp-overview">
      <form method="post">
    <?php
        if( !empty($error) )
        {
            $error_msg=implode('<br>',$error);
            
            wpgmp_showMessage($error_msg,true);
        }
        if( !empty($success) )
        {
            wpgmp_showMessage($success);
        }
        ?>
        <div class="form-horizontal">
          <fieldset>
            <legend>
            <?php _e('General Setting', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Map Title', 'wpgmp_google_map')?>
                  &nbsp;<span style="color:#F00;">*</span></label>
              </div>
              <div class="col-md-7">
                <input type="text" name="map_title" value="<?php if( !empty($_POST['map_title']) ) { echo $_POST['map_title']; } ?>" class="create_map form-control" />
                <p class="description">
                  <?php _e('Enter here the title', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
           
           
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Map Width', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <input type="text" name="map_width" value="<?php if( !empty($_POST['map_width']) ) { echo $_POST['map_width']; } ?>" class="create_map form-control" />
                <p class="description">
                  <?php _e('Enter here the map width in pixel. Leave it blank for 100% width.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Map Height', 'wpgmp_google_map')?>
                  &nbsp;<span style="color:#F00;">*</span></label>
              </div>
              <div class="col-md-7">
                <input type="text" name="map_height" value="<?php if( !empty($_POST['map_height']) ) { echo $_POST['map_height']; } ?>" class="create_map form-control" />
                <p class="description">
                  <?php _e('Enter here the map height in pixel.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Map Zoom Level', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <select name="zoom_level">
                  <?php 
        for($i=1;$i<20;$i++)
        {
      ?>
                  <option value="<?php echo $i; ?>"<?php if( !empty($_POST['zoom_level']) ) { selected($_POST['zoom_level'],$i); } ?>><?php echo $i; ?></option>
                  <?php
  }
  ?>
                </select>
                <p class="description">
                  <?php _e('(Available options - 1,2,3,4,5,6,8,9,10,11,12,13,14,15,16,17,18,19).', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            
               <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Center Latitude', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <input type="text" name="control[map_center_latitude]" value="<?php if( !empty($_POST['control']['map_center_latitude']) ) { echo $_POST['control']['map_center_latitude']; } ?>" class="create_map form-control" />
                <p class="description">
                  <?php _e('Enter here the center latitude. You may leave it blank.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Center Longitude', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <input type="text" name="control[map_center_longitude]" value="<?php if( !empty($_POST['control']['map_center_longitude']) ) { echo $_POST['control']['map_center_longitude']; } ?>" class="create_map form-control" />
                <p class="description">
                  <?php _e('Enter here the center longitude. You may leave it blank.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Choose Map Type', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <select name="choose_map">
                  <option value="ROADMAP"<?php if( !empty($_POST['choose_map']) ) { selected($_POST['choose_map'],'ROADMAP'); } ?>>
                  <?php _e('ROADMAP', 'wpgmp_google_map')?>
                  </option>
                  <option value="SATELLITE"<?php if( !empty($_POST['choose_map']) ) { selected($_POST['choose_map'],'SATELLITE'); } ?>>
                  <?php _e('SATELLITE', 'wpgmp_google_map')?>
                  </option>
                  <option value="HYBRID"<?php if( !empty($_POST['choose_map']) ) { selected($_POST['choose_map'],'HYBRID'); } ?>>
                  <?php _e('HYBRID', 'wpgmp_google_map')?>
                  </option>
                  <option value="TERRAIN"<?php if( !empty($_POST['choose_map']) ) { selected($_POST['choose_map'],'TERRAIN'); } ?>>
                  <?php _e('TERRAIN', 'wpgmp_google_map')?>
                  </option>
                </select>
                <p class="description">
                  <?php _e('(Available options - ROADMAP,SATELLITE,HYBRID,TERRAIN {Default is roadmap type}).', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Center by Nearest Location', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[nearest_location]" value="true"<?php if( !empty($_POST['control']['nearest_location']) ) { checked($_POST['control']['nearest_location'],'true'); } ?>/>
                  <?php _e('Please check to set center by nearest location.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn Off Scrolling Wheel', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="scrolling_wheel" value="false"<?php if( !empty($_POST['scrolling_wheel']) ) { checked($_POST['scrolling_wheel'],'false'); } ?>/>
                  <?php _e('Please check to disable scroll wheel zooms.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Map Draggable', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[map_draggable]" value="false"<?php if( !empty($_POST['control']['map_draggable']) ) { checked($_POST['control']['map_draggable'],'false'); } ?>/>
                  <?php _e('Please check to disable map draggable.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
           
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Enable Visual Refresh', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="visual_refresh" value="true"<?php if( !empty($_POST['visual_refresh']) ) { checked($_POST['visual_refresh'],'true'); } ?>/>
                  <?php _e('Please check to enable visual refresh.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('45&deg; Imagery', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="45imagery" value="45"<?php if( !empty($_POST['45imagery']) ) { checked($_POST['45imagery'],45); } ?> />
                  <?php _e('Apply 45&deg; Imagery ? (only available for map type SATELLITE and HYBRID).', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Infowindow Open', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[infowindow_open]" value="true"<?php if( !empty($_POST['control']['infowindow_open']) ) { checked($_POST['control']['infowindow_open'],'true'); } ?> />
                  <?php _e('please check to enable infowindow default open.','wpgmp_google_map')?>
                </p>
              </div>
            </div>
          </fieldset>
          <?php
          global $wpdb;
          $group_results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."group_map");

          ?>
          <fieldset>
            <legend>
       <input type="checkbox" name="control[select_all_locations]" class="wpgmp-select-all" value="true"<?php if( !empty($_POST['control']['select_all_locations']) ) { checked($_POST['control']['select_all_locations'],'true'); } ?>/>&nbsp;
            <?php _e('Choose Locations', 'wpgmp_google_map')?>
            <span style="margin-left:50%;">Filter : 
    <select name="filter_location" class="filter_location">
           
             <option value="">Select group</option>
    <?php if( !empty($group_results) )
    {
      $all_categories = array();
    ?>
    <?php
        for($i = 0; $i < count($group_results); $i++)
        {
          $all_categories[$group_results[$i]->group_map_id] = $group_results[$i]->group_map_title;
    ?>
    
        <option value="<?php echo $group_results[$i]->group_map_id; ?>"<?php if( !empty($_POST['location_group_map']) ) { selected($group_results[$i]->group_map_id,$_POST['location_group_map']); } ?>><?php echo $group_results[$i]->group_map_title; ?></option>
    
     <?php
        
        }
    } 
    ?>
    </select>
    </span>
    </legend>
        <?php
         global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."map_locations order by location_title");
    
        if( !empty($results) )
        { 
        ?>
          <table class="table">
           
            <tr>
            <th>Select</th>
            <th>Address</th>
            <th>Title</th>
            <th>Category</th>
            </tr>
           
           
              <?php
      
        for($i = 0; $i < count($results); $i++)
        {
          ?>
          <tr>
                <td class="group<?php echo $results[$i]->location_group_map; ?>">
                <?php 
                $s='';
                if( !empty($_POST['locations']) )
                { 

                  if( in_array($results[$i]->location_id, $_POST['locations']) )
                  {
                    $s="checked='checked'";
                  }
                    
                }
                ?>
                <input <?php echo $s;?> type="checkbox" name="locations[]" class="wpgmp-location-checkbox" value="<?php echo $results[$i]->location_id; ?>"/>
                 </td>
                <td><?php echo $results[$i]->location_address; ?></td>
                <td><?php echo $results[$i]->location_title; ?></td>
                <td><?php 
                          if(is_array($all_categories)) {
                                  if( isset($all_categories[$results[$i]->location_group_map]))
                                   echo $all_categories[$results[$i]->location_group_map];
                                 else
                                  echo "---";
                              
                          }
                ?></td>
          </tr>
          <?php
        }
        echo "</table>";  
        }
     else
     {
        ?>
              <?php _e('Seems you don\'t have any location right now.', 'wpgmp_google_map')?>
              &nbsp;<a href="<?php echo admin_url('admin.php?page=wpgmp_add_location') ?>">
              <?php _e('Click here', 'wpgmp_google_map')?>
              </a>&nbsp;
              <?php _e('to add a location now', 'wpgmp_google_map')?>
              <?php
     }
     ?>
           
           
          
          </fieldset>
           <fieldset>
            <legend>
            <?php _e('Infowindow Setting', 'wpgmp_google_map')?>
            </legend>
            
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Infowindow Setting', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
				     <textarea rows="4" cols="80" name="control[infowindow_setting]"><?php if( !empty($_POST['control']['infowindow_setting']) ) { echo $_POST['control']['infowindow_setting']; }?></textarea>
                <p class="description">
               
                    <?php _e('Enter placeholders {marker_title},{marker_message},{marker_address},{marker_category},{marker_latitude},{marker_longitude}.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Show Infowindow on', 'wpgmp_google_map')?>
                </label>
              </div>
          
              
              <div class="col-md-7">
				  <select name="control[infowindow_openoption]">
					  <option value="mouseclick" <?php if( !empty($_POST['control']['infowindow_openoption']) ) { selected($_POST['control']['infowindow_openoption'],'mouseclick'); } ?>><?php _e('Mouse Click','wpgmp_google_map'); ?></option>
					  <option value="mousehover" <?php if( !empty($_POST['control']['infowindow_openoption']) ) { selected($_POST['control']['infowindow_openoption'],'mousehover'); } ?>><?php _e('Mouse Hover','wpgmp_google_map'); ?></option>
				  
				  </select>
         
                <p class="description">
               
                    <?php _e('Select infowindow open on Mouse Click or Mouse Hover.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            </fieldset>
          <fieldset>
            <legend>
            <?php _e('Layers', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Kml Layer', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="layer_setting[choose_layer][kml_layer]" id="kml_layer" onclick="mylayer(this.value)" value="KmlLayer"<?php if( !empty($_POST['layer_setting']['choose_layer']['kml_layer']) ) { checked($_POST['layer_setting']['choose_layer']['kml_layer'],'KmlLayer'); } ?> />
                  <?php _e('Please check to enable Kml Layer.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <?php
if( !empty($_POST['layer_setting']['choose_layer']['kml_layer']) && $_POST['layer_setting']['choose_layer']['kml_layer']=="KmlLayer" )
{
?>
            <div id="kmldisplay">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="col-md-7">
                  <textarea type="text" rows="4" name="layer_setting[map_links]" class="create_map form-control"><?php if( !empty($_POST['layer_setting']['map_links']) ) { echo stripslashes($_POST['layer_setting']['map_links']); } ?></textarea>
                  <p class="description">
                    <?php _e('Insert here the Kml Link if you select KML Layer.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
            <?php
}
else
{
?>
            <div id="kmldisplay" style="display:none;">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="col-md-7">
                  <textarea type="text" rows="4" name="layer_setting[map_links]" class="create_map form-control"><?php if( !empty($_POST['layer_setting']['map_links']) ) { echo stripslashes($_POST['layer_setting']['map_links']); } ?></textarea>
                  <p class="description">
                    <?php _e('Insert here the Kml Link if you select KML Layer.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
            <?php
}
?>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Fusion Table Layer', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="layer_setting[choose_layer][fusion_layer]" id="fusion_layer" onclick="mylayer(this.value)" value="FusionTablesLayer"<?php if( !empty($_POST['layer_setting']['choose_layer']['fusion_layer']) ) { checked($_POST['layer_setting']['choose_layer']['fusion_layer'],'FusionTablesLayer'); } ?> />
                  <?php _e('Please check to enable Fusion Table Layer.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <?php
if( !empty($_POST['layer_setting']['choose_layer']['fusion_layer']) && $_POST['layer_setting']['choose_layer']['fusion_layer']=="FusionTablesLayer" )
{
?>
            <div id="fusiondisplay">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Select', 'wpgmp_google_map')?>
                    &nbsp;<span style="color:#F00;">*</span></label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="layer_setting[fusion_select]" class="create_map form-control" value="<?php if( !empty($_POST['layer_setting']['fusion_select']) ) { echo stripslashes($_POST['layer_setting']['fusion_select']); } ?>" />
                  <p class="description">
                    <?php _e('Insert here the fusion select.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('From', 'wpgmp_google_map')?>
                    &nbsp;<span style="color:#F00;">*</span></label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="layer_setting[fusion_from]" class="create_map form-control" value="<?php if( !empty($_POST['layer_setting']['fusion_from']) ) { echo stripslashes($_POST['layer_setting']['fusion_from']); } ?>" />
                  <p class="description">
                    <?php _e('Insert here the fusion from.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Heat Map', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="checkbox" name="layer_setting[heat_map]" value="true"<?php if( !empty($_POST['layer_setting']['heat_map']) ) { checked($_POST['layer_setting']['heat_map'],'true'); } ?> />
                  <p class="description">
                    <?php _e('Please check if heat map is enable.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
            <?php
}
else
{
?>
            <div id="fusiondisplay" style="display:none;">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Select', 'wpgmp_google_map')?>
                    &nbsp;<span style="color:#F00;">*</span></label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="layer_setting[fusion_select]" class="create_map form-control" value="<?php if( !empty($_POST['layer_setting']['fusion_select']) ) { echo stripslashes($_POST['layer_setting']['fusion_select']); } ?>" />
                  <p class="description">
                    <?php _e('Insert here the fusion select.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('From', 'wpgmp_google_map')?>
                    &nbsp;<span style="color:#F00;">*</span></label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="layer_setting[fusion_from]" class="create_map form-control" value="<?php if( !empty($_POST['layer_setting']['fusion_from']) ) { echo stripslashes($_POST['layer_setting']['fusion_from']); } ?>" />
                  <p class="description">
                    <?php _e('Insert here the fusion from.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Heat Map', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="checkbox" name="layer_setting[heat_map]" value="true"<?php if( !empty($_POST['layer_setting']['heat_map']) ) { checked($_POST['layer_setting']['heat_map'],'true'); } ?> />
                  <p class="description">
                    <?php _e('Please check if heat map is enable.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
            <?php
}
?>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Traffic Layer', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="layer_setting[choose_layer][traffic_layer]" onclick="mylayer(this.value)" value="TrafficLayer"<?php if( !empty($_POST['layer_setting']['choose_layer']['traffic_layer']) ) { checked($_POST['layer_setting']['choose_layer']['traffic_layer'],'TrafficLayer'); } ?> />
                  <?php _e('Please check to enable Traffic Layer.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Transit Layer', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="layer_setting[choose_layer][transit_layer]" onclick="mylayer(this.value)" value="TransitLayer"<?php if( !empty($_POST['layer_setting']['choose_layer']['transit_layer']) ) { checked($_POST['layer_setting']['choose_layer']['transit_layer'],'TransitLayer'); } ?> />
                  <?php _e('Please check to enable Transit Layer.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Weather Layer', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="layer_setting[choose_layer][weather_layer]" id="weather_layer" onclick="mylayer(this.value)" value="WeatherLayer"<?php if( !empty($_POST['layer_setting']['choose_layer']['weather_layer']) ) { checked($_POST['layer_setting']['choose_layer']['weather_layer'],'WeatherLayer'); } ?> />
                  <?php _e('Please check to enable Weather Layer.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <?php
if( !empty($_POST['layer_setting']['choose_layer']['weather_layer']) && $_POST['layer_setting']['choose_layer']['weather_layer']=='WeatherLayer' )
{
?>
            <div id="weatherlayer">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Temperature units:', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="radio" name="layer_setting[temp]" value="CELSIUS"<?php if( !empty($_POST['layer_setting']['temp']) ) { checked($_POST['layer_setting']['temp'],'CELSIUS'); } ?> />
                  <?php _e('&nbsp;Celsius&nbsp;&nbsp;&nbsp;', 'wpgmp_google_map')?>
                  <input type="radio" name="layer_setting[temp]" value="FAHRENHEIT"<?php if( !empty($_POST['layer_setting']['temp']) ) { checked($_POST['layer_setting']['temp'],'FAHRENHEIT'); } ?> />
                  <?php _e('&nbsp;Fahrenheit', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Please check temperature unit.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Wind speed units:', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="radio" name="layer_setting[wind]" value="MILES_PER_HOUR"<?php if( !empty($_POST['layer_setting']['wind']) ) { checked($_POST['layer_setting']['wind'],'MILES_PER_HOUR'); } ?> />
                  <?php _e('&nbsp;mph&nbsp;&nbsp;&nbsp;', 'wpgmp_google_map')?>
                  <input type="radio" name="layer_setting[wind]" value="KILOMETERS_PER_HOUR"<?php if( !empty($_POST['layer_setting']['wind']) ) { checked($_POST['layer_setting']['wind'],'KILOMETERS_PER_HOUR'); } ?> />
                  <?php _e('&nbsp;km/h&nbsp;&nbsp;&nbsp;', 'wpgmp_google_map')?>
                  <input type="radio" name="layer_setting[wind]" value="METERS_PER_SECOND"<?php if( !empty($_POST['layer_setting']['wind']) ) { checked($_POST['layer_setting']['wind'],'METERS_PER_SECOND'); } ?> />
                  <?php _e('&nbsp;m/s', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Please check wind speed unit.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
            <?php
}
else
{
?>
            <div id="weatherlayer" style="display:none;">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Temperature units:', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="radio" name="layer_setting[temp]" value="CELSIUS"<?php if( !empty($_POST['layer_setting']['temp']) ) { checked($_POST['layer_setting']['temp'],'CELSIUS'); } ?>  />
                  <?php _e('&nbsp;Celsius&nbsp;&nbsp;&nbsp;', 'wpgmp_google_map')?>
                  <input type="radio" name="layer_setting[temp]" value="FAHRENHEIT"<?php if( !empty($_POST['layer_setting']['temp']) ) { checked($_POST['layer_setting']['temp'],'FAHRENHEIT'); } ?> />
                  <?php _e('&nbsp;Fahrenheit', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Please check temperature unit.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Wind speed units:', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="radio" name="layer_setting[wind]" value="MILES_PER_HOUR"<?php if( !empty($_POST['layer_setting']['wind']) ) { checked($_POST['layer_setting']['wind'],'MILES_PER_HOUR'); } ?>  />
                  <?php _e('&nbsp;mph&nbsp;&nbsp;&nbsp;', 'wpgmp_google_map')?>
                  <input type="radio" name="layer_setting[wind]" value="KILOMETERS_PER_HOUR"<?php if( !empty($_POST['layer_setting']['wind']) ) { checked($_POST['layer_setting']['wind'],'KILOMETERS_PER_HOUR'); } ?>/>
                  <?php _e('&nbsp;km/h&nbsp;&nbsp;&nbsp;', 'wpgmp_google_map')?>
                  <input type="radio" name="layer_setting[wind]" value="METERS_PER_SECOND"<?php if( !empty($_POST['layer_setting']['wind']) ) { checked($_POST['layer_setting']['wind'],'METERS_PER_SECOND'); } ?> />
                  <?php _e('&nbsp;m/s', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Please check wind speed unit.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
            <?php
}
?>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Bicycling Layer', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="layer_setting[choose_layer][bicycling_layer]" onclick="mylayer(this.value)" value="BicyclingLayer"<?php if( !empty($_POST['layer_setting']['choose_layer']['bicycling_layer']) ) { checked($_POST['layer_setting']['choose_layer']['bicycling_layer'],'BicyclingLayer'); } ?> />
                  <?php _e('Please check to enable Bicycling Layer.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Panoramio Layer', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="layer_setting[choose_layer][panoramio_layer]" onclick="mylayer(this.value)" value="PanoramioLayer"<?php if( !empty($_POST['layer_setting']['choose_layer']['panoramio_layer']) ) { checked($_POST['layer_setting']['choose_layer']['panoramio_layer'],'PanoramioLayer'); } ?> />
                  <?php _e('Please check to enable Panoramio Layer.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>
            <?php _e('Control Setting', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn Off Pan Control', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[pan_control]" value="false"<?php if( !empty($_POST['control']['pan_control']) ) { checked($_POST['control']['pan_control'],'false'); } ?>/>
                  <?php _e('Please check to disable pan control.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn Off Zoom Control', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[zoom_control]" value="false"<?php if( !empty($_POST['control']['zoom_control']) ) { checked($_POST['control']['zoom_control'],'false'); } ?>/>
                  <?php _e('Please check to disable zoom control.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn Off Map Type Control', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[map_type_control]" value="false"<?php if( !empty($_POST['control']['map_type_control']) ) { checked($_POST['control']['map_type_control'],'false'); } ?>/>
                  <?php _e('Please check to disable map type control.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn Off Scale Control', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[scale_control]" value="false"<?php if( !empty($_POST['control']['scale_control']) ) { checked($_POST['control']['scale_control'],'false'); } ?>/>
                  <?php _e('Please check to disable scale control.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn Off Street View Control', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[street_view_control]" value="false"<?php if( !empty($_POST['control']['street_view_control']) ) { checked($_POST['control']['street_view_control'],'false'); } ?>/>
                  <?php _e('Please check to disable street view control.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn Off Overview Map Control', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[overview_map_control]" value="false"<?php if( !empty($_POST['control']['overview_map_control']) ) { checked($_POST['control']['overview_map_control'],'false'); } ?>/>
                  <?php _e('Please check to disable overview map control.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>
            <?php _e('Map Style Setting', 'wpgmp_google_map')?>
            </legend>
            <?php
$featuredtype=array("administrative",'administrative.country','administrative.land_parcel','administrative.locality','administrative.neighborhood','administrative.province','all',
'landscape','landscape.man_made','landscape.natural','landscape.natural.landcover','landscape.natural.terrain','poi','poi.attraction','poi.business','poi.government','poi.medical','poi.park','poi.place_of_worship','poi.school','poi.sports_complex','road','road.arterial','road.highway','road.highway.controlled_access','road.local','transit','transit.line','transit.station','transit.station.airport','transit.station.bus','transit.station.rail','water');
$elementstype=array('all','geometry','geometry.fill','geometry.stroke','labels','labels.icon','labels.text','labels.text.fill','labels.text.stroke');
?>
            <div class="col-md-1">#</div>
            <div class="col-md-4">
              <label for="title">
                <?php _e('Feature Type', 'wpgmp_google_map')?>
              </label>
            </div>
            <div class="col-md-3">
              <label for="title">
                <?php _e('Element Type', 'wpgmp_google_map')?>
              </label>
            </div>
            <div class="col-md-2">
              <label for="title">
                <?php _e('Color', 'wpgmp_google_map')?>
              </label>
            </div>
            <div class="col-md-2">
              <label for="title">
                <?php _e('Visibility', 'wpgmp_google_map')?>
              </label>
            </div>
            <?php
for( $i=0; $i<10; $i++)
{
?>
            <div class="col-md-1"><b>
              <?php _e('Style', 'wpgmp_google_map')?>
              <?php echo ($i+1); ?></b></div>
            <div class="col-md-4">
              <select name="style_array_type[mapfeaturetype][<?php echo $i; ?>]" class="form-control">
                <option value="">
                <?php _e('Select Featured Type', 'wpgmp_google_map')?>
                </option>
                <?php 
      foreach($featuredtype as $key=>$value)
      { 
      ?>
                <option value="<?php echo $value;?>"><?php echo $value;?></option>
                <?php 
      }
      ?>
              </select>
            </div>
            <div class="col-md-3">
              <select name="style_array_type[mapelementtype][<?php echo $i; ?>]" class="form-control">
                <option value="">
                <?php _e('Select Element Type', 'wpgmp_google_map')?>
                </option>
                <?php 
      
      foreach($elementstype as $key=>$value)
      { 
      ?>
                <option value="<?php echo $value;?>"><?php echo $value;?></option>
                <?php 
      }
      ?>
              </select>
            </div>
            <div class="col-md-2">
              <?php
        if( !empty($_POST['style_array_type']['color'][$i]) )
        {
        ?>
              <input type="text" value="<?php echo $_POST['style_array_type']['color'][$i]; ?>" name="style_array_type[all][color][]" class="color {pickerClosable:true}" />
              <?php
        }
        else
        {
        ?>
              <input type="text" value="" name="style_array_type[color][<?php echo $i; ?>]" class="color {pickerClosable:true} form-control" />
              <?php
        }
        ?>
            </div>
            <div class="col-md-2">
              <select name="style_array_type[visibility][<?php echo $i; ?>]" class="style_select_map form-control">
                <option value="on"<?php  if( !empty($_POST['style_array_type']['visibility'][$i] ) ) { selected($_POST['style_array_type']['visibility'][$i],'on'); } ?>>
                <?php _e('Yes', 'wpgmp_google_map')?>
                </option>
                <option value="off"<?php if( !empty($_POST['style_array_type']['visibility'][$i] ) ) { selected($_POST['style_array_type']['visibility'][$i],'off'); } ?>>
                <?php _e('No', 'wpgmp_google_map')?>
                </option>
                <option value="simplifed"<?php if( !empty($_POST['style_array_type']['visibility'][$i] ) ) { selected($_POST['style_array_type']['visibility'][$i],'simplifed'); } ?>>
                <?php _e('Simplifed', 'wpgmp_google_map')?>
                </option>
              </select>
            </div>
            <?php
}
?>
          <div class="row_toggle">
        <div class="col-md-12" style="text-align:center; font-size:18px; font-weight:bold; text-transform: uppercase; margin:12px 0;"><strong>or</strong></div>
    </div>

    <div class="row_toggle">         
        <div class="col-md-12">
          <p class="description">
              <?php _e('Javascript style array here. You can get awesome readymade styles from <a href="http://snazzymaps.com/" target="_blank">here</a>', 'wpgmp_google_map')?>
          </p>         
          <textarea rows="10" class="form-control" name="control[custom_style]"><?php if( !empty($_POST['control']['custom_style']) ) { echo stripslashes($_POST['map_all_control']['custom_style']); } ?></textarea>           
        </div>
    </div>
          </fieldset>
          <fieldset>
            <legend>
            <?php _e('Street View Setting', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn On Street View', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="street_view_control[street_control]" class="street_view_toggle" value="true"<?php if( !empty($_POST['street_view_control']['street_control']) ) { checked($_POST['street_view_control']['street_control'],'true'); } ?>/>
                  <?php _e('Please check to enable Street View control.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <?php  
            if( !empty($_POST['street_view_control']['street_control']) && $_POST['street_view_control']['street_control'] == "true")
            $street_view_display = "display:block;";
            else
            $street_view_display = "display:none;";
            ?>
            <div id="disply_street_view" style="<?php echo $street_view_display ?>">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Turn On Close Button', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <p class="description">
                    <input type="checkbox" name="street_view_control[street_view_close_button]" value="true"<?php if( !empty($_POST['street_view_control']['street_view_close_button']) ) { checked($_POST['street_view_control']['street_view_close_button'],'true'); } ?>/>
                    <?php _e('Please check to enable Close button.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Turn Off links Control', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <p class="description">
                    <input type="checkbox" name="street_view_control[links_control]" value="false"<?php if( !empty($_POST['street_view_control']['links_control']) ) { checked($_POST['street_view_control']['links_control'],'false'); } ?>/>
                    <?php _e('Please check to disable links control.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Turn Off Street View Pan Control', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <p class="description">
                    <input type="checkbox" name="street_view_control[street_view_pan_control]" value="false"<?php if( !empty($_POST['street_view_control']['street_view_pan_control']) ) { checked($_POST['street_view_control']['street_view_pan_control'],'false'); } ?>/>
                    <?php _e('Please check to disable Street View Pan control.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
                <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('POV Heading', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <p class="description">
                    <input type="text" name="street_view_control[pov_heading]" value="<?php if( !empty($_POST['street_view_control']['pov_heading']) ) { echo $_POST['street_view_control']['pov_heading']; } ?>" class= "create_map form-control"/>
                    <?php _e('Please enter POV heading', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              
                <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('POV Pitch', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <p class="description">
                    <input type="text" name="street_view_control[pov_pitch]" value="<?php if( !empty($_POST['street_view_control']['pov_pitch']) ) { echo $_POST['street_view_control']['pov_pitch']; } ?>" class= "create_map form-control"/>
                    <?php _e('Please enter POV Pitch', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              
            </div>
          </fieldset>
          <fieldset>
            <legend>
            <?php _e('Route Direction Setting', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Turn On Map Route Directions', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="direction_servics[route_direction]" class="route_direction_toggle" value="true"<?php if( !empty($_POST['direction_servics']['route_direction']) ) { checked($_POST['direction_servics']['route_direction'],'true'); } ?>/>
                  <?php _e('Please check to enable map route directions.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>

            <?php 
             if( !empty($_POST['direction_servics']['route_direction']) && $_POST['direction_servics']['route_direction'] == "true" )
            $route_direction_display = "display:block;";
            else
            $route_direction_display = "display:none;";
            ?>
            <div id="disply_route_direction" style="<?php echo $route_direction_display; ?>">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Select Routes', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <?php
                  $routes_results = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."map_routes",NULL));
                  echo '<ul>';
                  if( !empty($routes_results) )
                  {
                        for($i = 0; $i < count($routes_results); $i++)
                    {
                      echo '<li>';
                      if(empty($_POST['direction_servics']['specific_routes'])) 
                      { 
                      ?>
                          <input type="checkbox" name="direction_servics[specific_routes][]" value="<?php echo $routes_results[$i]->route_id; ?>" />&nbsp;<?php echo $routes_results[$i]->route_title; ?>
                          <?php
                          }
                          else
                          {
                            if(in_array($routes_results[$i]->route_id, $_POST['direction_servics']['specific_routes']))
                            {
                              ?>
                                <input type="checkbox" checked="checked" name="direction_servics[specific_routes][]" value="<?php echo $routes_results[$i]->route_id; ?>" />&nbsp;<?php echo $routes_results[$i]->route_title; ?>
                              <?php 
                            }
                            else
                            {
                              ?>
                                <input type="checkbox" name="direction_servics[specific_routes][]" value="<?php echo $routes_results[$i]->route_id; ?>" />&nbsp;<?php echo $routes_results[$i]->route_title; ?>
                              <?php
                            } 
                          } 
                          echo '</li>';  
                          }
                        }
                        else
                        {
                      ?>
                          Seems you don't have any route right now &nbsp; <a href="<?php echo admin_url('admin.php?page=wpgmp_add_routes') ?>"> Click here </a> &nbsp; to add a route now.
                        <?php  
                  }
                  echo '</ul>';
                  ?>
                </div>
              </div>
            </div>
            
          </fieldset>
          <fieldset>
            <legend>
            <?php _e('Marker Cluster Setting', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Marker Cluster', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="cluster_setting[marker_cluster]" class="marker_cluster_toggle" value="true"<?php if( !empty($_POST['cluster_setting']['marker_cluster']) ) {  checked($_POST['cluster_setting']['marker_cluster'],'true'); } ?> />
                  <?php _e('Apply Marker Cluster ?', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <?php 
            if( !empty($_POST['cluster_setting']['marker_cluster']) && $_POST['cluster_setting']['marker_cluster'] == "true" )
            $marker_cluster_display = "display:block;";
            else
            $marker_cluster_display = "display:none;";
            ?>
            <div id="disply_marker_cluster" style = "<?php echo $marker_cluster_display; ?>">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Grid', 'wpgmp_google_map')?>
                    &nbsp;<span style="color:#F00;">*</span></label>
                </div>
                <div class="col-md-7">
                  <input type="text" size="15" name="cluster_setting[grid]" value="<?php if( !empty($_POST['cluster_setting']['grid']) ) { echo $_POST['cluster_setting']['grid']; } ?>" class="create_map form-control" />
                  <p class="description">
                    <?php _e('Enter grid here. Default is 15', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Style', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <select name="cluster_setting[map_style]">
                    <option value="-1"<?php if( !empty($_POST['cluster_setting']['map_style']) ) { selected($_POST['cluster_setting']['map_style'],'-1'); } ?>>
                    <?php _e('Default', 'wpgmp_google_map')?>
                    </option>
                    <option value="0"<?php if( !empty($_POST['cluster_setting']['map_style']) ) { selected($_POST['cluster_setting']['map_style'],'0'); } ?>>
                    <?php _e('People', 'wpgmp_google_map')?>
                    </option>
                    <option value="1"<?php if( !empty($_POST['cluster_setting']['map_style']) ) { selected($_POST['cluster_setting']['map_style'],'1'); } ?>>
                    <?php _e('Conversation', 'wpgmp_google_map')?>
                    </option>
                    <option value="2"<?php if( !empty($_POST['cluster_setting']['map_style']) ) { selected($_POST['cluster_setting']['map_style'],'2'); } ?>>
                    <?php _e('Heart', 'wpgmp_google_map')?>
                    </option>
                  </select>
                  <p class="description">
                    <?php _e('(Available options - Default,People,Conversation,Herat).', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Max Zoom Level', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <select name="cluster_setting[max_zoom]">
                    <option value="1"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'1'); } ?>>1</option>
                    <option value="2"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'2'); } ?>>2</option>
                    <option value="3"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'3'); } ?>>3</option>
                    <option value="4"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'4'); } ?>>4</option>
                    <option value="5"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'5'); } ?>>5</option>
                    <option value="6"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'6'); } ?>>6</option>
                    <option value="7"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'7'); } ?>>7</option>
                    <option value="8"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'8'); } ?>>8</option>
                    <option value="9"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'9'); } ?>>9</option>
                    <option value="10"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'10'); } ?>>10</option>
                    <option value="11"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'11'); } ?>>11</option>
                    <option value="12"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'12'); } ?>>12</option>
                    <option value="13"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'13'); } ?>>13</option>
                    <option value="14"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'14'); } ?>>14</option>
                    <option value="15"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'15'); } ?>>15</option>
                    <option value="16"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'16'); } ?>>16</option>
                    <option value="17"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'17'); } ?>>17</option>
                    <option value="18"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'18'); } ?>>18</option>
                    <option value="19"<?php if( !empty($_POST['cluster_setting']['max_zoom']) ) { selected($_POST['cluster_setting']['max_zoom'],'19'); } ?>>19</option>
                    
                  </select>
                  <p class="description">
                    <?php _e('(Available options - 1,2,3,4,5,6,8,9,10,11,12,13,14,15,16,17,18,19).', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>
            <?php _e('Overlay Setting', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Overlay', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="overlay_setting[overlay]" class="overlays_toggle" value="true"<?php if( !empty($_POST['overlay_setting']['overlay']) ) { checked($_POST['overlay_setting']['overlay'],'true'); } ?> />
                  <?php _e('Overlays (if you checked,below information can not be empty).', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            <?php 
            if( !empty($_POST['overlay_setting']['overlay']) && $_POST['overlay_setting']['overlay'] == "true" )
            $overlays_display = "display:block;";
            else
            $overlays_display = "display:none;";
            ?>
            <div id="disply_overlays" style="<?php echo $overlays_display; ?>">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Overlay Border Color', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <?php
  if( !empty($_POST['overlay_setting']['overlay_border_color']) )
  {
  ?>
                  <input type="text" value="<?php echo $_POST['overlay_setting']['overlay_border_color']; ?>" name="overlay_setting[overlay_border_color]" class="color {pickerClosable:true}" />
                  <?php
  }
  else
  {
  ?>
                  <input type="text" value="f22800" name="overlay_setting[overlay_border_color]" class="color {pickerClosable:true}" />
                  <?php
  }
  ?>
                  <p class="description">
                    <?php _e('(Default is red).', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Overlay Width', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="overlay_setting[overlay_width]" class="create_map form-control" value="<?php if( !empty($_POST['overlay_setting']['overlay_width']) ) { echo $_POST['overlay_setting']['overlay_width']; } ?>" />
                  <?php _e('&nbsp;px', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Insert here Overlay Width. Default is 200px', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Overlay Height', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="overlay_setting[overlay_height]" class="create_map form-control" value="<?php if( !empty($_POST['overlay_setting']['overlay_height']) ) { echo $_POST['overlay_setting']['overlay_height']; } ?>" />
                  <?php _e('&nbsp;px', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Enter here Overlay Height. Default is 200px', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Overlay Font size', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="overlay_setting[overlay_fontsize]" class="create_map form-control" value="<?php if( !empty($_POST['overlay_setting']['overlay_fontsize']) ) { echo $_POST['overlay_setting']['overlay_fontsize']; } ?>" />
                  <?php _e('&nbsp;px', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Enter here Overlay Font Size. Default is 16px', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Overlay Border Width', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <input type="text" name="overlay_setting[overlay_border_width]" class="create_map form-control" value="<?php if( !empty($_POST['overlay_setting']['overlay_border_width']) ) { echo $_POST['overlay_setting']['overlay_border_width']; } ?>" />
                  <?php _e('&nbsp;px', 'wpgmp_google_map')?>
                  <p class="description">
                    <?php _e('Enter here Overlay Border Width. Default is 2px', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Overlay Border Style', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <select name="overlay_setting[overlay_border_style]">
                    <option value="default"<?php if( !empty($_POST['overlay_setting']['overlay_border_style']) ) { selected($_POST['overlay_setting']['overlay_border_style'],'default'); } ?>>
                    <?php _e('Default', 'wpgmp_google_map')?>
                    </option>
                    <option value="solid"<?php if( !empty($_POST['overlay_setting']['overlay_border_style']) ) { selected($_POST['overlay_setting']['overlay_border_style'],'solid'); } ?>>
                    <?php _e('Solid', 'wpgmp_google_map')?>
                    </option>
                    <option value="dashed"<?php if( !empty($_POST['overlay_setting']['overlay_border_style']) ) { selected($_POST['overlay_setting']['overlay_border_style'],'dashed'); } ?>>
                    <?php _e('Dashed', 'wpgmp_google_map')?>
                    </option>
                  </select>
                  <p class="description">
                    <?php _e('(Available options - Default,Solid,Dashed).', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>
            <?php _e('Limit Panning and Zoom', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Limit Panning and Zoom', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[panning_control]" class="limit_panning_toggle" value="true"<?php if( !empty($_POST['control']['panning_control']) ) { checked($_POST['control']['panning_control'],'true'); } ?> />
                  <?php _e('Limit panning and zoom (if you checked,below information can not be empty).', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>

           <?php
            if( !empty($_POST['control']['panning_control']) && $_POST['control']['panning_control'] == "true" )
            $limit_panning_display = "display:block;";
            else
            $limit_panning_display = "display:none;";
            ?>
            <div id="disply_limit_panning" style = "<?php echo $limit_panning_display;?>">
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('From', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="control[from_latitude]" class="create_map form-control" value="<?php if( !empty($_POST['control']['from_latitude']) ) { echo $_POST['control']['from_latitude']; } ?>" />
                      <p class="description">
                        <?php _e('Insert here latitude', 'wpgmp_google_map')?>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="control[from_longitude]" class="create_map form-control" value="<?php if( !empty($_POST['control']['from_longitude']) ) { echo $_POST['control']['from_longitude']; } ?>" />
                      <p class="description">
                        <?php _e('Insert here longitude', 'wpgmp_google_map')?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('To', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="control[to_latitude]" class="create_map form-control" value="<?php if( !empty($_POST['control']['to_latitude']) ) { echo $_POST['control']['to_latitude']; } ?>" />
                      <p class="description">
                        <?php _e('Insert here latitude', 'wpgmp_google_map')?>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="control[to_longitude]" class="create_map form-control" value="<?php if( !empty($_POST['control']['to_longitude']) ) { echo $_POST['control']['to_longitude']; } ?>" />
                      <p class="description">
                        <?php _e('Insert here longitude', 'wpgmp_google_map')?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Zoom Level', 'wpgmp_google_map')?>
                  </label>
                </div>
                <div class="col-md-7">
                  <select name="control[zoom_level]">
                    <option value="1"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'1'); } ?>>1</option>
                    <option value="2"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'2'); } ?>>2</option>
                    <option value="3"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'3'); } ?>>3</option>
                    <option value="4"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'4'); } ?>>4</option>
                    <option value="5"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'5'); } ?>>5</option>
                    <option value="6"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'6'); } ?>>6</option>
                    <option value="7"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'7'); } ?>>7</option>
                    <option value="8"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'8'); } ?>>8</option>
                    <option value="9"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'9'); } ?>>9</option>
                    <option value="10"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'10'); } ?>>10</option>
                    <option value="11"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'11'); } ?>>11</option>
                    <option value="12"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'12'); } ?>>12</option>
                    <option value="13"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'13'); } ?>>13</option>
                    <option value="14"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'14'); } ?>>14</option>
                     <option value="15"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'15'); } ?>>15</option>
                    <option value="16"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'16'); } ?>>16</option>
                    <option value="17"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'17'); } ?>>17</option>
                    <option value="18"<?php if( !empty($_POST['control']['zoom_level']) ) { selected($_POST['control']['zoom_level'],'18'); } ?>>18</option>
                  </select>
                  <p class="description">
                    <?php _e('Do you want to set minimum zoom level?', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
            </div>
 
          </fieldset>
          
          <fieldset>
            <legend>
            <?php _e('Tabs Settings', 'wpgmp_google_map')?>
            </legend>
            
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Display Tabs', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[display_marker_category]" class="marker_category_toggle" value="true" <?php if( !empty($_POST['control']['display_marker_category']) ) { checked($_POST['control']['display_marker_category'],'true'); } ?> />
                    <?php _e('Display various tabs on the map.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
          
<?php
if( !empty($_POST['control']['display_marker_category']) && $_POST['control']['display_marker_category']=='true')
{
?>        

<div id="disply_marker_category_toggle">

  <div class="row"> 
            <div class="col-md-3"><label for="wpgmp_direction_tab"><?php _e( 'Display Categories Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                <input type="checkbox" name="control[wpgmp_category_tab]"  value="true" <?php if( !empty($_POST['control']['wpgmp_category_tab']) ) { checked($_POST['control']['wpgmp_category_tab'],'true'); } ?> />
                
                <?php _e( 'Display various tabs on the map.', 'wpgmp_google_map' ) ?>
              </div>
            </div>
  
  
   <div class="row">  
            <div class="col-md-3"><label for="wpgmp_direction_tab"><?php _e( 'Display Directions Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                
                
                <input type="checkbox" name="control[wpgmp_direction_tab]"  class="direction_tab_toggle" value="true" <?php if( !empty($_POST['control']['wpgmp_direction_tab']) ) { checked($_POST['control']['wpgmp_direction_tab'],'true'); } ?> />
                
                <?php _e( 'Display Direction Tab.', 'wpgmp_google_map' ) ?>
              </div>
            </div>
            <?php  
  

        
if(!empty($_POST['control']['wpgmp_direction_tab']) && $_POST['control']['wpgmp_direction_tab'] == "true")
{
	?>
<div id="disply_direction_tab">
	
	         <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Select Unit', 'wpgmp_google_map')?>
                   </label>
                </div>
                <div class="col-md-7">
                  <select name="control[wpgmp_unit_selected]" >
					  <option value="km" <?php if( !empty($_POST['control']['wpgmp_unit_selected'])) {  selected($_POST['control']['wpgmp_unit_selected'],'km'); } ?>>Km</option>
					   <option value="miles" <?php if( !empty($_POST['control']['wpgmp_unit_selected'])) {  selected($_POST['control']['wpgmp_unit_selected'],'miles'); } ?>>Miles</option>
                  </select>
                   <p class="description">
                    <?php _e('Select Unit.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Default Start Location', 'wpgmp_google_map')?>
                   </label>
                </div>
                <div class="col-md-7">
                  <input type="text" size="15" id="googlemap_address" name="control[wpgmp_default_start_location]" value="<?php if(!empty($_POST['control']['wpgmp_default_start_location'])) { echo $_POST['control']['wpgmp_default_start_location']; } ?>" class="create_map form-control" />
                   <p class="description">
                    <?php _e('Default Start Location.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              
               <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Default End Location', 'wpgmp_google_map')?>
                    </label>
                </div>
                <div class="col-md-7">
                  <input type="text" size="15" name="control[wpgmp_default_end_location]" value="<?php if(!empty($_POST['control']['wpgmp_default_end_location'])) { echo $_POST['control']['wpgmp_default_end_location']; } ?>" class="create_map form-control" />
                   <p class="description">
                    <?php _e('Default End Location.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
 </div>
<?php 
}
else
{ ?>  
<div id="disply_direction_tab" style="display:none">
	
	           <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Select Unit', 'wpgmp_google_map')?>
                   </label>
                </div>
                <div class="col-md-7">
                  <select name="control[wpgmp_unit_selected]" >
					  <option value="km" <?php if( !empty($_POST['control']['wpgmp_unit_selected'])) {  selected($_POST['control']['wpgmp_unit_selected'],'km'); } ?>>Km</option>
					   <option value="miles" <?php if( !empty($_POST['control']['wpgmp_unit_selected'])) {  selected($_POST['control']['wpgmp_unit_selected'],'miles'); } ?>>Miles</option>
                  </select>
                   <p class="description">
                    <?php _e('Select Unit.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Default Start Location', 'wpgmp_google_map')?>
                    </label>
                </div>
                <div class="col-md-7">
                  <input type="text" size="15" id="googlemap_address" name="control[wpgmp_default_start_location]" value="<?php if(!empty($unserialize_map_control_setting['wpgmp_default_start_location'])) { echo $unserialize_map_control_setting['wpgmp_default_start_location']; } ?>" class="create_map form-control" />
                   <p class="description">
                    <?php _e('Default Start Location.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              
               <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Default End Location', 'wpgmp_google_map')?>
                   </label>
                </div>
                <div class="col-md-7">
                  <input type="text" size="15" name="control[wpgmp_default_end_location]" value="<?php if(!empty($unserialize_map_control_setting['wpgmp_default_end_location'])) { echo $unserialize_map_control_setting['wpgmp_default_end_location']; } ?>" class="create_map form-control" />
                   <p class="description">
                    <?php _e('Default End Location.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              </div>
<?php }
?>
            <div class="row">     
            <div class="col-md-3"><label for="wpgmp_direction_tab"><?php _e( 'Display Nearby Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                
                  <input type="checkbox" name="control[wpgmp_nearby_tab]"  value="true" <?php if( !empty($_POST['control']['wpgmp_nearby_tab']) ) { checked($_POST['control']['wpgmp_nearby_tab'],'true'); } ?> />
              
                <?php _e( 'Display Nearby Tab.', 'wpgmp_google_map' ) ?>
              </div>
            </div>
            
            <div class="row">     
            <div class="col-md-3"><label for="wpgmp_route_tab"><?php _e( 'Display Route Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                
                  <input type="checkbox" name="control[wpgmp_route_tab]"  value="true" <?php if( !empty($_POST['control']['wpgmp_route_tab']) ) { checked($_POST['control']['wpgmp_route_tab'],'true'); } ?> />
              
                <?php _e( 'Display Route Tab.', 'wpgmp_google_map' ) ?>
              </div>
            </div>
            
            
            
      <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Tabs Font Color', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
          <?php if(empty($_POST['control']['tabs_font_color'])) { ?>    
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[tabs_font_color]" value="818392" />
                    <?php } else { ?>
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[tabs_font_color]" value="<?php echo $_POST['control']['tabs_font_color']; ?>" />
                    <?php } ?>  
                    <?php _e('Please choose font color.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Category Font Color', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
           <?php if(empty($_POST['control']['category_font_color'])) { ?> 
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[category_font_color]" value="000000" />
                     <?php } else { ?>
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[category_font_color]" value="<?php echo $_POST['control']['category_font_color']; ?>" />
                     <?php } ?>    
                    <?php _e('Please choose font color.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
          
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Category Font Size', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="text" class="create_map form-control" name="control[category_font_size]" value="<?php if( !empty($_POST['control']['category_font_size']) ) { echo $_POST['control']['category_font_size']; } ?>" />
                    <?php _e('Please enter font size.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            
                <div class="row">
                  <div class="col-md-3">
                    <label for="title">
                      <?php _e('Location Font Color', 'wpgmp_google_map')?>
                    </label>
                  </div>
                  <div class="col-md-7">
                    <p class="description">
            <?php if(empty($_POST['control']['location_font_color'])) { ?>
              <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[location_font_color]" value="9C9797" />
                        <?php } else { ?>
              <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[location_font_color]" value="<?php echo $_POST['control']['location_font_color']; ?>" />
            <?php } ?>
                        <?php _e('Please choose font color.', 'wpgmp_google_map')?>
                    </p>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-md-3">
                    <label for="title">
                      <?php _e('Location Font Size', 'wpgmp_google_map')?>
                    </label>
                  </div>
                  <div class="col-md-7">
                    <p class="description">
                        <input type="text" class="create_map form-control" name="control[location_font_size]" value="<?php if( !empty($_POST['control']['location_font_size']) ) { echo $_POST['control']['location_font_size']; } ?>" />
                        <?php _e('Please enter font size.', 'wpgmp_google_map')?>
                    </p>
                  </div>
              </div> 
</div>  

<?php 
}
else
{
?>
<div id="disply_marker_category_toggle" style="display:none;">

  <div class="row"> 
            <div class="col-md-3"><label for="wpgmp_direction_tab"><?php _e( 'Display Categories Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                <input type="checkbox" name="control[wpgmp_category_tab]"  value="true" <?php if( !empty($_POST['control']['wpgmp_category_tab']) ) { checked($_POST['control']['wpgmp_category_tab'],'true'); } ?> />
                
                <?php _e( 'Display Categories/Locations Tab.', 'wpgmp_google_map' ) ?>
              </div>
            </div>
  
  
   <div class="row">  
            <div class="col-md-3"><label for="wpgmp_direction_tab"><?php _e( 'Display Directions Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                
                
                <input type="checkbox" name="control[wpgmp_direction_tab]" class="direction_tab_toggle"  value="true" <?php if( !empty($_POST['control']['wpgmp_direction_tab']) ) { checked($_POST['control']['wpgmp_direction_tab'],'true'); } ?> />
                
                <?php _e( 'Display Direction Tab.', 'wpgmp_google_map' ) ?>
              </div>
            </div>

<div id="disply_direction_tab" style="display:none">
	
	          <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Select Unit', 'wpgmp_google_map')?>
                   </label>
                </div>
                <div class="col-md-7">
                  <select name="control[wpgmp_unit_selected]" >
					  <option value="km" <?php if( !empty($_POST['control']['wpgmp_unit_selected'])) {  selected($_POST['control']['wpgmp_unit_selected'],'km'); } ?>>Km</option>
					   <option value="miles" <?php if( !empty($_POST['control']['wpgmp_unit_selected'])) {  selected($_POST['control']['wpgmp_unit_selected'],'miles'); } ?>>Miles</option>
                  </select>
                   <p class="description">
                    <?php _e('Select Unit.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Default Start Location', 'wpgmp_google_map')?>
                    </label>
                </div>
                <div class="col-md-7">
                  <input type="text" size="15" id="googlemap_address" name="control[wpgmp_default_start_location]" value="<?php if(!empty($_POST['control']['wpgmp_default_start_location'])) { echo $_POST['control']['wpgmp_default_start_location']; } ?>" class="create_map form-control" />
                   <p class="description">
                    <?php _e('Default Start Location.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              
               <div class="row">
                <div class="col-md-3">
                  <label for="title">
                    <?php _e('Default End Location', 'wpgmp_google_map')?>
                   </label>
                </div>
                <div class="col-md-7">
                  <input type="text" size="15" name="control[wpgmp_default_end_location]" value="<?php if(!empty($_POST['control']['wpgmp_default_end_location'])) { echo $_POST['control']['wpgmp_default_end_location']; } ?>" class="create_map form-control" />
                   <p class="description">
                    <?php _e('Default End Location.', 'wpgmp_google_map')?>
                  </p>
                </div>
              </div>
              </div>

            
            <div class="row">     
            <div class="col-md-3"><label for="wpgmp_direction_tab"><?php _e( 'Display Nearby Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                
                  <input type="checkbox" name="control[wpgmp_nearby_tab]"  value="true" <?php if( !empty($_POST['control']['wpgmp_nearby_tab']) ) { checked($_POST['control']['wpgmp_nearby_tab'],'true'); } ?> />
              
                <?php _e( 'Display Nearby Tab.', 'wpgmp_google_map' ) ?>
              </div>
            </div>
            
            
              <div class="row">     
            <div class="col-md-3"><label for="wpgmp_route_tab"><?php _e( 'Display Route Tab', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                
                  <input type="checkbox" name="control[wpgmp_route_tab]"  value="true" <?php if( !empty($_POST['control']['wpgmp_route_tab']) ) { checked($_POST['control']['wpgmp_route_tab'],'true'); } ?> />
              
                <?php _e( 'Display Route Tab.', 'wpgmp_google_map' ) ?>
              </div>
            </div>
            
            
            
      <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Tabs Font Color', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
          <?php if(empty($_POST['control']['tabs_font_color'])) { ?>    
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[tabs_font_color]" value="818392" />
                    <?php } else { ?>
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[tabs_font_color]" value="<?php echo $_POST['control']['tabs_font_color']; ?>" />
                    <?php } ?>  
                    <?php _e('Please choose font color.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Category Font Color', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
           <?php if(empty($_POST['control']['category_font_color'])) { ?> 
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[category_font_color]" value="000000" />
                     <?php } else { ?>
            <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[category_font_color]" value="<?php echo $_POST['control']['category_font_color']; ?>" />
                     <?php } ?>    
                    <?php _e('Please choose font color.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
          
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Category Font Size', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="text" class="create_map form-control" name="control[category_font_size]" value="<?php if( !empty($_POST['control']['category_font_size']) ) { echo $_POST['control']['category_font_size']; } ?>" />
                    <?php _e('Please enter font size.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            
                <div class="row">
                  <div class="col-md-3">
                    <label for="title">
                      <?php _e('Location Font Color', 'wpgmp_google_map')?>
                    </label>
                  </div>
                  <div class="col-md-7">
                    <p class="description">
            <?php if(empty($_POST['control']['location_font_color'])) { ?>
              <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[location_font_color]" value="9C9797" />
                        <?php } else { ?>
              <input type="text" class="color {pickerClosable:true} create_map form-control" name="control[location_font_color]" value="<?php echo $_POST['control']['location_font_color']; ?>" />
            <?php } ?>
                        <?php _e('Please choose font color.', 'wpgmp_google_map')?>
                    </p>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-md-3">
                    <label for="title">
                      <?php _e('Location Font Size', 'wpgmp_google_map')?>
                    </label>
                  </div>
                  <div class="col-md-7">
                    <p class="description">
                        <input type="text" class="create_map form-control" name="control[location_font_size]" value="<?php if( !empty($_POST['control']['location_font_size']) ) { echo $_POST['control']['location_font_size']; } ?>" />
                        <?php _e('Please enter font size.', 'wpgmp_google_map')?>
                    </p>
                  </div>
              </div> 
</div> 
<?php
}
?>        
          
</fieldset>
     
       <fieldset><legend>Listing Settings</legend>
          
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Display Listing', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="checkbox" name="control[display_listing]" class="marker_listing_toggle" value="true"<?php if( !empty($_POST['control']['display_listing']) ) { checked($_POST['control']['display_listing'],'true'); } ?> />
                    <?php _e('Display locations listing below the map.', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            
              
<?php
 if( !empty($_POST['control']['display_listing']) && $_POST['control']['display_listing'] == "true" )
            $listing_toggle_display = "display:block;";
            else
            $listing_toggle_display = "display:none;";
?>        
  
  <div id="disply_listing_toggle" style = "<?php echo $listing_toggle_display ?>">
   
          
            <div class="row">     
            <div class="col-md-3"><label for="wpgmp_listing_number"><?php _e( 'Locations per Page', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                <input type="textbox" class="form-control" name="control[wpgmp_listing_number]"  value="<?php if( !empty($_POST['control']['wpgmp_listing_number']) ) { echo $_POST['control']['wpgmp_listing_number']; } ?>" />
                <p class="description"><?php _e( 'Set locations to display per page. Default is 10.', 'wpgmp_google_map' ) ?></p>
              </div>
            </div> 
            
            <div class="row">     
            <div class="col-md-3"><label for="wpgmp_centerlongitude"><?php _e( 'Display Search Form', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
                
                <input type="checkbox" name="control[wpgmp_search_display]"  value="true" <?php if( !empty($_POST['control']['wpgmp_search_display']) ) { checked($_POST['control']['wpgmp_search_display'],'true'); } ?> />
                
                <?php _e( 'Display Search Form', 'wpgmp_google_map' ) ?>
              </div>
            </div>
            
            <div class="row">     
              <div class="col-md-3"><label for="wpgmp_before_listing"><?php _e( 'Before Listing Placeholder', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
            <?php if( !empty($_POST['control']['wpgmp_before_listing']) ) { ?>
                <textarea type="text" class="form-control" name="control[wpgmp_before_listing]" rows="3" style="width: 530px;"><?php if( !empty($_POST['control']['wpgmp_before_listing']) ) { echo stripslashes($_POST['control']['wpgmp_before_listing']); } ?>
                </textarea>
                <?php } 
                
                else { ?>
                <textarea type="text" class="form-control" name="control[wpgmp_categorydisplayformat]" rows="3" style="width: 530px;">
<?php $default='<h2>Map Locations</h2>'; echo stripcslashes($default);?></textarea>
                <?php } ?>
                <p class="description"><?php _e('Display a text/html/shortcode before displaylisting.', 'wpgmp_google_map' ) ?></p>
              </div>
            </div>
            
            <div class="row">     
              <div class="col-md-3"><label for="wpgmp_categorydisplayformat"><?php _e( 'Listing Placeholder', 'wpgmp_google_map' ) ?></label></div>
              <div class="col-md-7">
            <?php if( !empty($_POST['control']['wpgmp_categorydisplayformat']) ) { ?>
                <textarea type="text" class="form-control" name="control[wpgmp_categorydisplayformat]" rows="10" style="width: 530px;"><?php if( !empty($_POST['control']['wpgmp_categorydisplayformat']) ) { echo stripslashes($_POST['control']['wpgmp_categorydisplayformat']); } ?>
                </textarea>
                <?php } 
                
                else { ?>
                <textarea type="text" class="form-control" name="control[wpgmp_categorydisplayformat]" rows="10" style="width: 530px;">
<?php $default='<div class="wpgmp_locations">
<div class="wpgmp_locations_head">
<div class="wpgmp_location_title">
<a  href="{marker_link}">{location_title}</a></div>
<div class="wpgmp_location_meta">
<span class="wpgmp_location_category">Category : {category_title}</span>
</div>
</div>
<div class="wpgmp_locations_content"> {marker_image}
 {location_address}</div>
<div class="wpgmp_locations_foot"></div>
</div>'; echo stripcslashes($default);?></textarea>
                <?php } ?>
                <p class="description"><?php _e( '{marker_link},{location_title}, {location_address}, {location_message}, {location_latitude}, {location_longitude}, {marker_image} and {category_title}.', 'wpgmp_google_map' ) ?></p>
              </div>
              </div>
            <div class="row">     
              <div class="col-md-3"><label for="wpgmp_listing_number"><?php _e( 'Sort By', 'wpgmp_google_map' ) ?></label></div>
                <div class="col-md-7">
                <select name="control[wpgmp_categorydisplaysort]" >
                <option value="title" <?php if( !empty($_POST['control']['wpgmp_categorydisplaysort']) ) { selected($_POST['control']['wpgmp_categorydisplaysort'],'title'); } ?>>Title</option>
                <option value="address" <?php if( !empty($_POST['control']['wpgmp_categorydisplaysort']) ) { selected($_POST['control']['wpgmp_categorydisplaysort'],'address'); } ?>>Address</option>
                <option value="category" <?php if( !empty($_POST['control']['wpgmp_categorydisplaysort']) ) { selected($_POST['control']['wpgmp_categorydisplaysort'],'category'); } ?>>Category</option>
                </select>
                  <p class="description"><?php _e( 'Select this to sort alphabetically.', 'wpgmp_google_map' ) ?></p>
                </div>
            </div> 
</fieldset>       

          <fieldset>
            <legend>
            <?php _e('GEOJSON', 'wpgmp_google_map')?>
            </legend>
            <div class="row">
              <div class="col-md-3">
                <label for="title">
                  <?php _e('Paste GEO JSON URL', 'wpgmp_google_map')?>
                </label>
              </div>
              <div class="col-md-7">
                <p class="description">
                  <input type="text" name="control[geojson_url]" class="create_map form-control" value="<?php if( !empty($_POST['control']['geojson_url']) ) { echo $_POST['control']['geojson_url']; } ?>"/>
                  <?php _e('Please enter GEO JSON Url', 'wpgmp_google_map')?>
                </p>
              </div>
            </div>
            
          </fieldset>
         
          <p class="submit">
              <input type="submit" name="create_map_location" id="submit" class="btn btn-lg btn-primary" value="<?php _e('Save Map', 'wpgmp_google_map')?>" >
          </p>
        </div>
      </form>
    </div>
  </div>
</div>
<?php 
}
