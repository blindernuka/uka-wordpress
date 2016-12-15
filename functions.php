<?php


function uka_widgets_init(){
	register_sidebar(array(
		'name'          => __('Home top left', 'uka'),
		'id'            => 'home-top-left',
		'description'   => __('Add widgets here to appear top left.', 'uka'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(
		'name'          => __('Home top right', 'uka'),
		'id'            => 'home-top-right',
		'description'   => __('Add widgets here to appear top right.', 'uka'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(
		'name'          => __('Home bottom left', 'uka'),
		'id'            => 'home-bottom-left',
		'description'   => __('Add widgets here to appear bottom left.', 'uka'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(
		'name'          => __('Home bottom right', 'uka'),
		'id'            => 'home-bottom-right',
		'description'   => __('Add widgets here to appear bottom right.', 'uka'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
}
add_action('widgets_init', 'uka_widgets_init');

if (! function_exists('uka_setup')):
	function uka_setup(){
		
		date_default_timezone_set('Europe/Oslo');
		setlocale(LC_ALL, 'nb_NO', 'nb_no', 'nb', 'no', 'norwegian');
		
		register_nav_menus(array(
			'main-menu' => __('Main menu', 'uka'),
		));
		register_nav_menus(array(
			'footer-menu' => __('Footer menu', 'uka'),
		));
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(600, 0);
		
		
		update_option( 'thumbnail_size_w', 150 );
		update_option( 'thumbnail_size_h', 0 );
		update_option( 'medium_size_w', 200 );
		update_option( 'medium_size_h', 0 );
		//update_option( 'medium_large_size_w', 300 );
		//update_option( 'medium_large_size_h', 0 );
		update_option( 'large_size_w', 600 );
		update_option( 'large_size_h', 0 );
		
		add_theme_support('post-formats', array('link'));

	}
	add_action('after_setup_theme', 'uka_setup');
endif; // uka_setup


function custom_excerpt_length( $length ) {
	return 0;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function uka_scripts(){

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.1.1.min.js');
	
	wp_enqueue_script('uka-wordpress-script', get_template_directory_uri() . '/js/uka-wordpress.js', array('jquery'));
	
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/lib/font-awesome/css/font-awesome.min.css', array(), '4.7.0');
	wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '5.0.0');

	// Theme stylesheet.
	wp_enqueue_style('uka-style', get_stylesheet_uri(), array('normalize'));

}
add_action('wp_enqueue_scripts', 'uka_scripts');


/**
 * Plugin additions.
 */
require(get_template_directory().'/inc/plugins/uka-seo/uka-seo-plugin.php');
require(get_template_directory().'/inc/plugins/uka-program/uka-program-plugin.php');
require(get_template_directory().'/inc/plugins/uka-panels/uka-panels-plugin.php');

/**
 * Widget additions.
 */
 
require(get_template_directory().'/inc/widgets/social-icons/social-icons.php');
require(get_template_directory().'/inc/widgets/instagram/instagram.php');
require(get_template_directory().'/inc/widgets/uka-wordcloud/uka-wordcloud-widget.php');

/**
 * Customizer additions.
 */
require(get_template_directory().'/inc/customizer.php');



/**
 * Remove categories
 */
function uka_remove_categories(){
    register_taxonomy('category', array());
}
add_action('init', 'uka_remove_categories');



/**
 * Remove unused Wordpress widgets
 */
function uka_remove_widgets(){
    register_taxonomy('category', array());
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	#unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'uka_remove_widgets');

 
?>






