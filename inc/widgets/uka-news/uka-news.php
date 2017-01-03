<?php
/*
Plugin Name: UKA News
Plugin URI: 
Description: UKA news widget
Author: Vegard Andersen
Version: 0.1
Author URI: http://github.com/vegarda
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');	
	
add_action('widgets_init', function(){
	register_widget('UKA_News');
	//wp_enqueue_script('uka-news-script', get_template_directory_uri().'/inc/widgets/uka-news/uka-news-widget.js', array('jquery'));
	wp_enqueue_style('uka-news-style', get_template_directory_uri().'/inc/widgets/uka-news/uka-news.css');
});	

/**
 * Adds UKA News widget.
 */
class UKA_News extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'UKA_News', 			// Base ID
			__('UKA News', 'uka'), 	// Name
			array( 'description' => __( 'UKA News widget', 'uka' ), ) // Args
		);
		
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance){

		echo $args['before_widget'];

		if (have_posts()){
			if (is_home() && !is_front_page()){
				echo '<header>
					<h1 class="page-title screen-reader-text">'.single_post_title().'</h1>
				</header>';
			}

			while (have_posts()){
				the_post();
				get_template_part('template-parts/content', get_post_format());
			}

		}
		// If no content, include the "No posts found" template.
		else{
			//get_template_part( 'template-parts/content', 'none' );
		}
	
		echo $args['after_widget'];

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		$defaults =  array();
		$instance = wp_parse_args((array) $instance, $defaults);		
	}


	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		return $instance;
	}

} // class UKA_News



?>