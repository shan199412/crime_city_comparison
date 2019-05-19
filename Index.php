<?php

/*
Plugin Name: Crime Comparison
Description: Short Code: [Crime-City-Comparison]
Version: 1.1
Author: Zoe
*/

// User cannot access the plugin directly
if (!defined('ABSPATH')) {
	exit;
}

// Add short code for the plugin
function generate_ccc_short_code() {
	include 'crime-city-comparison.php';
}

add_shortcode('Crime-City-Comparison', 'generate_ccc_short_code');

// Add the scripts
function add_ccc_scripts() {
	wp_enqueue_script('cricity_script', plugins_url('/js/cricity_script.js',__FILE__), array('jquery'),'1.1', true);
	wp_enqueue_script('cridia_script', plugins_url('/js/cridia_script.js',__FILE__), array('jquery'),'1.1', true);
	wp_enqueue_style( 'cricity_style', plugins_url('/css/cricity_style.css', __FILE__), array(), '1.1');
	wp_enqueue_style( 'cridia_style', plugins_url('/css/cridia_style.css', __FILE__), array(), '1.1');

}

add_action('wp_enqueue_scripts', 'add_ccc_scripts');
