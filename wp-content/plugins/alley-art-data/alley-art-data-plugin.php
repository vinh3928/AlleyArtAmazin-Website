<?php
/**
 * Plugin Name: Alley Art Data
 * Plugin URI: https://github.com/CodeForBoulder/AlleyArtAmazin-Website/tree/data-module/wp-content/plugins/alley-art-data
 * Description: A wordpress plugin for integrating the Open Data Plus API with the WP Google Map plugin.
 * Version: 0.1
 * Author: Code for Boulder (Jeff Dillon)
 * License: MIT
 * Questions: where are the images; how many maps will be on the site; geo-location is off
 * Dependencies: Wordpress 4.2.2; WP Google Map Plugin 2.3.9; Open Data Plus API
 */
 
  
 /**
  * +++++++++++++++++++++++++++++++++++++++++++++
  * Register the plugin functions with wordpress
  * +++++++++++++++++++++++++++++++++++++++++++++
  */

add_action('admin_menu', 'alley_art_admin_menu');
register_activation_hook( __FILE__, 'aadp_activation' );
register_deactivation_hook( __FILE__, 'aadp_deactivation');
add_action( 'admin_enqueue_scripts', 'aadp_enqueue_custom_admin_style' );



/**
 * +++++++++++++++++++++++++++++++++++++++++++
 * Plugin functions registered with wordpress
 * +++++++++++++++++++++++++++++++++++++++++++
 */

 
/**
 * Add bootstrap to the page for CSS
 */
function aadp_enqueue_custom_admin_style() {
        //wp_register_style( 'custom_aadp_admin_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', false, '1.0.0' );
        //wp_enqueue_style( 'custom_aadp_admin_css' );
}

/**
 * Create the plugin admin menu in WordPress
 */
function alley_art_admin_menu() {
	add_menu_page('Alley Art Data', 'Alley Art', 'manage_options', 'alley-art-data-plugin', 'alley_art_init');
}


/**
 * Add database table, set the default value for the map id in wp options
 */
function aadp_activation() {
	global $wpdb;
    $table_name = $wpdb->prefix.'alley_odp';
	$alley_odp = "CREATE TABLE IF NOT EXISTS `$table_name` (
  				  `location_id` int(11) NOT NULL,
  				  `odp_id` varchar(255) NOT NULL
  				  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8" ;
	$wpdb->query($alley_odp);
	add_option('aadp_map_id', '1');
}

/**
 * Remove database table, delete map id from wp options
 */
function aadp_deactivation() {
	global $wpdb;
    $table_name = $wpdb->prefix.'alley_odp';
	$alley_odp = "DROP TABLE `$table_name`" ;
	$wpdb->query($alley_odp);
	delete_option('aadp_map_id');
}

/**
 * Main function for the plugin. This displays the admin page and performs the form actions.
 */
function alley_art_init() {
	
	$apilocations = getArtFromAPI();
	//var_dump($apilocations);
	usort($apilocations, 'aadp_cmp');
	
	if( $_GET['page']=='alley-art-data-plugin' && isset($_POST['r_id']) && $_POST['r_id']!='' ) {
		$remove_ids = $_POST['r_id'];
		removeFromDB($remove_ids);
	}
	
	if( $_GET['page']=='alley-art-data-plugin' && isset($_POST['a_id']) && $_POST['a_id']!='' ) {
		$add_ids = $_POST['a_id'];
		addToDB($add_ids, $apilocations);
	}
	
	if( $_GET['page']=='alley-art-data-plugin' && isset($_POST['s_map']) && $_POST['s_map']!='' ) {
		$map_id = $_POST['s_map'];
		update_option('aadp_map_id', $map_id);
	}
	
	$dblocations = getArtFromDB();
	$references = getReferencesFromDB();
	$ref_array = array();
	foreach ($references as $ref) {
		array_push($ref_array, $ref->odp_id);
	}
	
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			 <H1>Alley Art Admin Page</H1>
 			<p class="lead">This page controls the art locations displayed on the map.</p>
 			<br/>
 			<br/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
 				<div class="panel-heading"><H2 class="panel-title">Available Maps</H2></div>
			<div class="panel-body">
 				<form class="form-inline" name="select_map_form" action="admin.php?page=alley-art-data-plugin" method="post">
		  			<div class="form-group">
		    			<label class="sr-only" for="s_map">Target Map</label>
		    			<div class="input-group">
		      				<div class="input-group-addon">Map</div>
		      				<select name="s_map" class="form-control">
		 						<?php foreach (getMapsFromDB() as $map) { 
		 							if($map->map_id == get_option('aadp_map_id')) { ?>
									<option value="<?php echo $map -> map_id; ?>" selected><?php echo $map -> map_title; ?></option>	 
									<?php }  else { ?>
									<option value="<?php echo $map -> map_id; ?>"><?php echo $map -> map_title; ?></option>	
									<?php } } ?>
		 	  				</select>
		    			</div>
		  			</div>
		  				<button type="submit" class="btn btn-default">Select Map</button>
				</form>
			</div>
		</div>
		<br/>
		<br/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
	<div class="panel-heading">
	 <H2 class="panel-title">Available Art Locations</H2> 		
 	</div>
	<div class="panel-body">
<form name="remove_from_db" action="admin.php?page=alley-art-data-plugin" method="post">
<table class="table table-hover">
	<thead>
		<tr>
			<th>year</th>
			<th>description</th>
			<th>address</th>
			<th>lat</th>
			<th>lon</th>
			<th>add</th>
			<th>remove</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($apilocations as $location) { ?>
		<?php
			if(in_array($location->_id, $ref_array)) {
				?>
				<tr class="success">
				<?php
				} else {
				?>
				<tr>
				<?php
				}
			?>
		
			<td><?php echo $location -> year; ?></td>
			<td>Artist: <?php echo $location -> artist; ?> <br/>Title: <?php echo $location -> title; ?><br/> Media: <?php echo $location -> media; ?></td>
			<td><?php echo $location -> address; ?></td>
			<td><?php echo $location -> latitude; ?></td>
			<td><?php echo $location -> longitude; ?></td>
			<?php
			if(in_array($location->_id, $ref_array)) {
				?>
				<td align="center">&nbsp;</td>
				<td align="center"><input type="checkbox" name="r_id[]" value="<?php echo getApiId($location->_id, $references); ?>"/></td>
				<?php
				} else {
				?>
				<td align="center"><input type="checkbox" name="a_id[]" value="<?php echo $location -> _id; ?>"/></td>
				<td align="center">&nbsp;</td>
				<?php
				}
			?>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="7" align="right"><button type="submit" class="btn btn-default">Update Map</button></td>
		</tr>
	</tbody>
</table>
</form>
</div>
</div>
		</div>
	</div>
</div>

<?php
}

/**
* +++++++++++++++++++
* Helper functions
* +++++++++++++++++++
*/

/**
* Get the art data from the Open Data Plus API
* The data is provided in a json array of art installation objects
* Fields provided by the API: _id, address, artist, collection, image, latitude, longitude, media, title, year
*/
function getArtFromAPI() {
	$arrContextOptions=array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false,),);
	$apiurl = 'https://odp.agile9.com:3000/datasets/54daba1dc4612d9306ba68d1/docs';
	return json_decode(file_get_contents($apiurl, false, stream_context_create($arrContextOptions)));
}

/**
* Get the art that has been stored as map locations
*/
function getArtFromDB() {
	global $wpdb;
    $table_name = $wpdb->prefix.'map_locations';
	return $wpdb->get_results("SELECT * FROM $table_name");
}

/**
* Get the references that tie the API IDs to the location IDs
*/
function getReferencesFromDB() {
	global $wpdb;
    $table_name = $wpdb->prefix.'alley_odp';
	return $wpdb->get_results("SELECT * FROM $table_name");
}

/**
* Get the list of maps
*/
function getMapsFromDB() {
	global $wpdb;
    $table_name = $wpdb->prefix.'create_map';
	return $wpdb->get_results("SELECT * FROM $table_name");
}

/**
* Removes locations and their associated references and updates the map
*/
function removeFromDB($ids) {
	global $wpdb;
    $map_table_name = $wpdb->prefix.'map_locations';
    $odp_table_name = $wpdb->prefix.'alley_odp';
	foreach ($ids as $id) {
		$wpdb->delete($map_table_name, array('location_id' => $id));
		$wpdb->delete($odp_table_name, array('location_id' => $id));
	}
	updateMap();
}

/**
* Adds locations and their associated references
* The only odd part of this is the message that is displayed on the location markers.
* The message is stored as an associative array, serialized, and base 64 encoded before it is put in the db
*/
function addToDB($ids, $locs) {
	global $wpdb;
    $map_table_name = $wpdb->prefix.'map_locations';
    $odp_table_name = $wpdb->prefix.'alley_odp';
	
	//loop through the IDs that were passed in from the form
	foreach ($ids as $id) {
		//loop through the locations from the API and when you find a match take the data from the api and put it in the db
		foreach ($locs as $loc) {
			if($loc->_id == $id) {
				//build the message for this location by storing it in an associative array, serializing it, and base 64 encoding it - because, why not
				$message = array('googlemap_infowindow_message_one'=>'Artist: ' . $loc->artist. '<br/>Title: ' . $loc->title . '<br/>Media: ' . $loc->media);
				$wpdb->insert($map_table_name,
					array(	'location_title'=>$loc->title,
					'location_address'=>$loc->address,
					'location_latitude'=>$loc->latitude,
					'location_longitude'=>$loc->longitude,
					'location_messages'=>base64_encode(serialize($message))),
					array('%s','%s','%f','%f'));
				// get the id of the newly inserted location
				$insert_id = $wpdb->insert_id;
				
				// add the API ID and the MAP ID to the alley_odp table so we can keep track of the mapped locations
				$wpdb->insert($odp_table_name,
					array(	'location_id'=>$insert_id,
					'odp_id'=>$loc->_id),
					array('%d','%s'));
			}
		}
	}
	
	//update the map to display the locations
	updateMap();
}

/**
* Updates which locations are displayed on the map. This is determined by an odd multi-dimensional array stored in the create_map table.
* Example Array:
* a:17:{i:0;s:3:"213";i:1;s:3:"214";i:2;s:3:"215";i:3;s:3:"216";i:4;s:3:"226";i:5;s:3:"228";i:6;s:3:"230";i:7;s:3:"232";i:8;s:3:"234";i:9;s:3:"236";i:10;s:3:"237";i:11;s:3:"238";i:12;s:3:"239";i:13;s:3:"240";i:14;s:3:"241";i:15;s:3:"242";i:16;s:3:"243";}
* The first part "a:17" appartenly identifies this as an array with 17 elements.
* This second part between the "{}" is comprised of pairs of elements separated by ";"
* Each pair is comprised of the array index and the string length of the location id / location id
* Example: i:1;s:3:"214"
* This represents the second item in the array "i:1" and references the location id "214" which has a string length of "3"
*/
function updateMap() {
	global $wpdb;
    $map_table_name = $wpdb->prefix.'create_map';
	$i = 0;
	
	// get the full list of art locations
	$dblocs = getArtFromDB();
	
	//build the string
	$map_locations = 'a:'.count($dblocs).':{';
	foreach ($dblocs as $dbloc) {
		$map_locations = $map_locations . 'i:'.$i.';s:'.strlen(strval($dbloc->location_id)).':"'.$dbloc->location_id.'";';
		$i++;
	}
	$map_locations = $map_locations . '}';
	
	// update the database
	$wpdb->update(	$map_table_name,
		array('map_locations' => $map_locations),
		array('map_id' => get_option('aadp_map_id')),
		array('%s'),
		array('%d'));
}

/**
 * simple compare function used in sorting the locations by year in descending order
 */
function aadp_cmp($a, $b) {
	return strcmp($b->year, $a->year);
}

function getApiId($id, $ref) {
	//var_dump($ref);
	foreach ($ref as $r) {
		if($r->odp_id == $id) {
			return $r->location_id;
		}
	}
}
 ?>