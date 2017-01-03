<?php
/*
Plugin Name: Instagram
Plugin URI: 
Description: Instagram
Author: Vegard Andersen
Version: 0.2
Author URI: http://github.com/vegarda
*/


// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');	
	
add_action( 'widgets_init', function(){
	register_widget( 'Instagram' );
	wp_enqueue_style('instagram-style', get_template_directory_uri().'/inc/widgets/instagram/instagram.css');
});	

/**
 * Adds Instagram widget.
 */
class Instagram extends WP_Widget {


	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Instagram', 			// Base ID
			__('Instagram', 'uka'), 	// Name
			array( 'description' => __( 'Instagram widget', 'uka' ), ) // Args
		);
		
		//add_action( 'wp_enqueue_scripts', 'instagram_style' );
		
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
		
		$access_token = $instance['access_token'];
		$rows = $instance['rows'];
		$columns = $instance['columns'];
		$size = $instance['size'];

		echo $args['before_widget'];
		echo '<div class="widget-instagram-container">';
		$data = $this->get_instagram_data($access_token);
		if ($data !== NULL && ($data['meta']['code'] == 200) && (count($data['data']) > 0)){
			foreach ($data['data'] as $key => $image){
				if ($rows * $columns == $key){
					break;
				}
				if ($key % $columns === 0){
					echo '<div class="widget-row flex center">';
				}
				echo '<a href="'.$image['link'].'" target="_blank" class="widget-item"><img class="instagram-image size'.$size.'" src="'.$image['images']['thumbnail']['url'].'"></a>';
				if (($key + 1) % $columns === 0){
					echo '</div>';
				}
			}
		}
		echo '</div>';
		echo $args['after_widget'];

		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defaults =  array('access_token' => '', 'rows' => 3, 'columns' => 2, 'size' => 100);
		$instance = wp_parse_args((array) $instance, $defaults);
		$access_token = $instance['access_token'];
		//$number = $instance['number'];
		$rows = $instance['rows'];
		$columns = $instance['columns'];
		$sizes = array(50,75,100,150);
		
		?>
		<p><label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access token: '); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" type="text" value="<?php echo esc_attr($access_token); ?>" /></p>
		<?php 
		/*
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of images to show: '); ?></label>
		<input class="small-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		*/
		?>
		
		<p><label for="<?php echo $this->get_field_id('rows'); ?>"><?php _e('Number of rows to show: '); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>" type="number" step="1" min="1" value="<?php echo $rows; ?>" size="3" /></p>
		
		<p><label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Number of columns to show: '); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" type="number" step="1" min="1" value="<?php echo $columns; ?>" size="10" /></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Image size: '); ?></label>
			<select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>">
			<?php foreach ($sizes as $size ) : ?>
				<option value="<?php echo $size; ?>" <?php selected( $instance['size'], $size ); ?>>
			<?php echo $size.' px'; ?>
				</option>
			<?php endforeach; ?>
			</select>
		</p>
		
		
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
		$instance['access_token'] = sanitize_text_field( $new_instance['access_token'] );
		$instance['rows'] = sanitize_text_field( $new_instance['rows'] );
		$instance['columns'] = sanitize_text_field( $new_instance['columns'] );
		$instance['size'] = sanitize_text_field( $new_instance['size'] );

		return $instance;
	}


	private function get_instagram_data($access_token){

		$API_URL = 'https://api.instagram.com/v1/';
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_URL.'users/self/media/recent?access_token='.$access_token);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		$jsonData = curl_exec($ch);
		curl_close($ch);
		
		if ($jsonData){
			return json_decode($jsonData, true);
		}
		else{
			return NULL;
		}

	}

} // class Instagram



?>