<?php
/*
Plugin Name: UKA Program Countdown
Plugin URI: 
Description: UKA program countdown widget
Author: Vegard Andersen
Version: 0.1
Author URI: http://github.com/vegarda
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');	
	
add_action( 'widgets_init', function(){
	register_widget( 'UKA_Program_Countdown' );
	wp_enqueue_style('uka-program-countdown-style', get_template_directory_uri().'/inc/widgets/uka-program-countdown/uka-program-countdown.css');
	wp_enqueue_script('uka-program-countdown-script', get_template_directory_uri().'/inc/widgets/uka-program-countdown/uka-program-countdown.js', array('jquery'));
});	

/**
 * Adds UKA Program Countdown widget.
 */
class UKA_Program_Countdown extends WP_Widget {


	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'UKA_Program_Countdown', 			// Base ID
			__('UKA Program Countdown', 'uka'), 	// Name
			array( 'description' => __( 'UKA Program Countdown widget', 'uka' ), ) // Args
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
	public function widget( $args, $instance ) {
	
		global $program;
	
		//$eventgroup = $instance['eventgroup'];
		//$data = get_eventgroup_data($eventgroup);
		
		if ($program['events'][0] !== NULL){
			
			$first = $program['events'][0]['time_start'];
			
			if (strtotime('midnight', $first) > strtotime('today')){
				
				$time = $first - strtotime('now');
				
				echo $args['before_widget'];
				echo '<div id="countdown" class="widget-uka-program-countdown-container" timestamp="'.$time.'">';
				echo '</div>';
				echo $args['after_widget'];
			}
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defaults =  array('eventgroup' => 1);
		$instance = wp_parse_args((array) $instance, $defaults);
		$eventgroup = $instance['eventgroup'];
		
		?>
		<p><label for="<?php echo $this->get_field_id('eventgroup'); ?>"><?php _e('Eventgroup: '); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id('eventgroup'); ?>" name="<?php echo $this->get_field_name('eventgroup'); ?>" type="text" value="<?php echo esc_attr($eventgroup); ?>" /></p>
		<?php 
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
		$instance['eventgroup'] = sanitize_text_field( $new_instance['eventgroup'] );

		return $instance;
	}
	

} // class UKA_Program_Countdown



?>