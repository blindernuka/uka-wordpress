<?php

/**
 * Register a custom menu page.
 */
function uka_panels_menu(){
    add_menu_page(
		__('UKA Panels', 'uka' ),
        'UKA Panels',
        'manage_options',
        'uka-panels',
        'uka_panels_options',
        null,
        60
    );
}
add_action('admin_menu', 'uka_panels_menu' );

function register_uka_panels_settings(){
	register_setting('uka-panels-group', 'panels');
}
add_action('admin_init', 'register_uka_panels_settings');

function uka_panels_options(){
	require_once('uka-panels-options.php');
}

function get_uka_panels_data(){
	global $panels;
	$panels = NULL;
}
add_action('after_setup_theme', 'get_uka_panels_data');

function uka_panels_style(){
	wp_enqueue_style('uka-panels-style', get_template_directory_uri().'/inc/plugins/uka-panels/uka-panels.css');
}
add_action('wp_enqueue_scripts', 'uka_panels_style');

function uka_panels_widget_init(){
	$panels = intval(get_option('panels'));
	if ($panels > 0){			
		for ($i = 1; $i < $panels + 1; $i++){
			$title = get_theme_mod('panel-'.$i.'-title');
			$title = $title == '' ? 'Panel '.$i : 'Panel '.$i.' - '.$title;
			register_sidebar(array(
				'name'          => __($title, 'uka'),
				'id'            => 'panel-'.$i,
				'description'   => __('Add widgets here to appear in your panel.', 'uka'),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			));
		}
	}
}
add_action('widgets_init', 'uka_panels_widget_init');

/**
 * UKA panels widget additions.
 */
#require(get_template_directory().'/inc/widgets/uka-panels/uka-panels-widget.php');
#require(get_template_directory().'/inc/widgets/uka-panels-countdown/uka-panels-countdown.php');



?>
