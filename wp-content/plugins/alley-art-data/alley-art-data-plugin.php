<?php
/*
Plugin Name: Alley Art Data
Description: A plugin for loading art installation data from the CfB open data plus API
Author: Code for Boulder
Version: 0.1
 */
 
 add_action('admin_menu', 'alley_art_admin_menu');
 
 function alley_art_admin_menu() {
 	add_menu_page('Alley Art Data', 'Alley Art', 'manage_options', 'alley-art-data-plugin', 'alley_art_init');
 }
 
 function alley_art_init() {
 	echo 'Alley Art Admin Page';
 }
 
 ?>
