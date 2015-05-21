<?php
/**
 * Plugin Name: Alley Art Data
 * Plugin URI: https://github.com/CodeForBoulder/AlleyArtAmazin-Website/tree/data-module/wp-content/plugins/alley-art-data
 * Description: A wordpress plugin for integrating with Alley Art Data API.
 * Version: 0.1
 * Author: Code for Boulder (Jeff Dillon and Jason Strayer)
 * License: MIT
 */

add_action('admin_menu', 'alley_art_admin_menu');

function alley_art_admin_menu() {
	add_menu_page('Alley Art Data', 'Alley Art', 'manage_options', 'alley-art-data-plugin', 'alley_art_init');
}

function alley_art_init() {
	echo '<h1>Alley Art Admin Page</h1>';
	echo getArt();
}

//Test code for json parsing
function getArt() {
	$json = file_get_contents('https://odp.agile9.com:3000/datasets/54daba1dc4612d9306ba68d1/docs');
	$obj = json_decode($json);
	return $obj -> {'status'};
}


 ?>
