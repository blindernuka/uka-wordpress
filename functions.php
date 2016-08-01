<?php

function open_graph(){
	
	global $post;
	
	echo '<meta property="fb:app_id" content="" />'."\n";
	echo '<meta property="fb:admin" content="vegarda,miaemiliefj,marthesandli,750936250,kjersti.fossen,svalheim,swintherlarsen,potetsaus" />'."\n";
	echo '<meta property="og:title" content="'.get_bloginfo('name').'" />'."\n";
	echo '<meta property="og:description" content="'.get_bloginfo('description').'" />'."\n";
	echo '<meta property="og:type" content="website" />'."\n";
	echo '<meta property="og:url" content="http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'" />'."\n";
	
	$custom_logo_id = get_theme_mod('custom_logo');
	$image = wp_get_attachment_image_src($custom_logo_id , 'full');
	echo '<meta property="og:image" content="'.$image[0].'" />'."\n";
	
}
add_action('wp_head', 'open_graph');

function uka_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'uka' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'uka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'uka' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'uka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'uka' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'uka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uka_widgets_init' );

if ( ! function_exists( 'uka_setup' ) ) :
function uka_setup() {
	
	date_default_timezone_set('Europe/Oslo');
	setlocale(LC_ALL, 'nb_NO', 'nb_no', 'nb', 'no', 'norwegian');
	
	register_nav_menus( array(
		'main-menu' => __( 'Main menu', 'uka' ),
	) );
		register_nav_menus( array(
		'footer-menu' => __( 'Footer menu', 'uka' ),
	) );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

}
add_action( 'after_setup_theme', 'uka_setup' );
endif; // uka_setup

function uka_scripts() {

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/lib/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '4.1.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'uka-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'uka_scripts' );

/**
 * Widget additions.
 */
require(get_template_directory().'/inc/widgets/social-icons/social-icons.php');
require(get_template_directory().'/inc/widgets/instagram/instagram.php');
require(get_template_directory().'/inc/widgets/uka-program/uka-program.php');
require(get_template_directory().'/inc/widgets/uka-program-countdown/uka-program-countdown.php');

/**
 * Customizer additions.
 */
require(get_template_directory().'/inc/customizer.php');

?>