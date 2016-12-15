<?php

/**
 * Register a custom menu page.
 */
function uka_program_menu(){
    add_menu_page(
		__('UKA Program', 'uka' ),
        'UKA Program',
        'manage_options',
        'uka-program',
        'uka_program_options',
        null,
        60
    );
}
add_action('admin_menu', 'uka_program_menu' );

function register_uka_program_settings(){
	register_setting('uka-program-group', 'eventgroup');
}
add_action('admin_init', 'register_uka_program_settings');

function uka_program_options(){
	require_once('uka-program-options.php');
}

function get_uka_program_data(){
	
	global $program;
	$program = NULL;
	if (get_option('eventgroup')){
		$program = get_eventgroup_data(get_option('eventgroup'));		
	}
}
add_action('after_setup_theme', 'get_uka_program_data');

function uka_program_scripts(){
	wp_enqueue_style('uka-program-style', get_template_directory_uri().'/inc/plugins/uka-program/uka-program.css');
}
add_action('wp_enqueue_scripts', 'uka_program_scripts');

/**
 * UKA Program widget additions.
 */
require(get_template_directory().'/inc/widgets/uka-program/uka-program-widget.php');
require(get_template_directory().'/inc/widgets/uka-program-day/uka-program-day-widget.php');
require(get_template_directory().'/inc/widgets/uka-program-countdown/uka-program-countdown.php');


function get_eventgroup_data($eventgroup){

	$API_URL = 'https://billett.blindernuka.no/billett/api/';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $API_URL.'eventgroup/'.$eventgroup);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	$jsonData = curl_exec($ch);
	curl_close($ch);
	
	if ($jsonData){
		return json_decode($jsonData, true);
	}
	else{
		return NULL;
	}
	
}


?>
