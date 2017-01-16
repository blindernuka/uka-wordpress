<?php
/*
Plugin Name: UKA Wordcloud
Plugin URI: 
Description: UKA wordcloud widget
Author: Vegard Andersen
Version: 0.1
Author URI: http://github.com/vegarda
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');	
	
add_action( 'widgets_init', function(){
	register_widget('UKA_Wordcloud');
	wp_enqueue_style('uka-wordcloud-style', get_template_directory_uri().'/inc/widgets/uka-wordcloud/uka-wordcloud.css');
	wp_enqueue_script('uka-wordcloud-script', get_template_directory_uri().'/inc/widgets/uka-wordcloud/uka-wordcloud.js', array('jquery'));
});	

/**
 * Adds UKA Wordcloud widget.
 */
class UKA_Wordcloud extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'UKA_Wordcloud', 			// Base ID
			__('UKA Wordcloud', 'uka'), 	// Name
			array( 'description' => __( 'UKA Wordcloud widget', 'uka' ), ) // Args
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
		
		#print_r($instance);
		
		$words = intval($instance['words']);
		
		for ($i = 1; $i <= $words; $i++){
			$weight = $instance['word_weight_'.$i];
			$word = $instance['word_'.$i];
			$url = $instance['word_url_'.$i];
			if ($word != ""){				
				if ($url != ""){
					echo '<a id="word-'.$i.'" href="'.$url.'" weight="'.$weight.'">';
				}
				if ($weight == ""){
					$weight = 1;
				}
				echo '<span class="word" style="display:block;" weight="'.$weight.'">';
				echo $word;
				echo '</span>';
				if ($url != ""){
					echo '</a>';
				}
			}
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
	public function form($instance){
		$defaults =  array('words' => 5);
		$instance = wp_parse_args((array) $instance, $defaults);
		$words = $instance['words'];
		
		?>
		<p><label for="<?php echo $this->get_field_id('words'); ?>"><?php _e('Number of words: '); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id('words'); ?>" name="<?php echo $this->get_field_name('words'); ?>" type="number" step="1" min="1" value="<?php echo $words; ?>" size="3" /></p>
		
		<?php 
		
		for ($i = 1; $i <= $words; $i++){
			if (isset($instance['word_'.$i]) && isset($instance['word_weight_'.$i])){
				$temp_event = $instance['word_'.$i];
				$temp_word_weight = $instance['word_weight_'.$i];
				$temp_word_url = $instance['word_url_'.$i];
			}
			else {
				$temp_event = '';
				$temp_word_weight = '';
				$temp_word_url = '';
			}
			echo '
				<p>
					<label for="'.$this->get_field_id('word_weight_'.$i).'">'.__( 'Weight:' ).'</label> 
					<input class="small-text" id="'.$this->get_field_id('word_weight_'.$i).'" name="'.$this->get_field_name('word_weight_'.$i).'" type="number" value="'.esc_attr($temp_word_weight).'" placeholder="'.($words+1-$i).'">
					<input class="widefat" id="'.$this->get_field_id('word_'.$i).'" name="'.$this->get_field_name('word_'.$i).'" type="text" value="'.esc_attr($temp_event).'" placeholder="Event '.$i.'">
					<input class="widefat" id="'.$this->get_field_id('word_url_'.$i).'" name="'.$this->get_field_name('word_url_'.$i).'" type="text" value="'.esc_attr($temp_word_url).'" placeholder="http://">
				</p>';
		}
		
		
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
		$instance['words'] = sanitize_text_field( $new_instance['words'] );

		for ($i = 1; $i <= $old_instance['words']; $i++){
			if (!empty($new_instance['word_'.$i])){
				$instance['word_'.$i] = $new_instance['word_'.$i];
			}
			else{
				$instance['word_'.$i] = '';
			}
			$instance['word_weight_'.$i] = (!empty($new_instance['word_weight_'.$i])) ? sanitize_text_field($new_instance['word_weight_'.$i]) : '';
			$instance['word_url_'.$i] = (!empty($new_instance['word_url_'.$i])) ? sanitize_text_field($new_instance['word_url_'.$i]) : '';
		}	
	
		return $instance;
	}

} // class UKA_Wordcloud



?>