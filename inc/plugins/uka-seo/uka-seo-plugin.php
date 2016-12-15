<?php

/**
 * Register a custom menu page.
 */
function uka_seo_menu() {
    add_menu_page(
		__('UKA SEO', 'uka' ),
        'UKA SEO',
        'manage_options',
        'uka-seo',
        'uka_seo_options',
        null,
        60
    );
}
add_action('admin_menu', 'uka_seo_menu' );

function register_uka_seo_settings() {
	register_setting('uka-seo-group', 'fb-app-id');
	register_setting('uka-seo-group', 'fb-admins');
	register_setting('uka-seo-group', 'google-tracking-id');
}
add_action('admin_init', 'register_uka_seo_settings');

function uka_seo_options(){
	require_once('seo-options.php');
}

function open_graph(){
	if (get_option('fb-app-id')){
		echo '<meta property="fb:app_id" content="'.get_option('fb-app-id').'" />'."\n";
	}
	if (get_option('fb-admins')){
		echo '<meta property="fb:admins" content="'.get_option('fb-admins').'" />'."\n";
	}
	echo '<meta property="og:title" content="'.get_bloginfo('name').'" />'."\n";
	echo '<meta property="og:description" content="'.get_bloginfo('description').'" />'."\n";
	echo '<meta property="og:type" content="website" />'."\n";
	echo '<meta property="og:url" content="http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'" />'."\n";
	
	$custom_logo_id = get_theme_mod('custom_logo');
	$image = wp_get_attachment_image_src($custom_logo_id , 'full');
	echo '<meta property="og:image" content="'.$image[0].'" />'."\n";
	
}
add_action('wp_head', 'open_graph');

function facebook_sdk(){
	if (get_option('fb-app-id')){
		require_once('facebook-sdk.php');
	}
}
add_action('wp_head', 'facebook_sdk');

function google_analytics(){
	if (get_option('fb-app-id')){
		require_once('google-analytics.php');
	}
}
add_action('wp_head', 'google_analytics');

?>
