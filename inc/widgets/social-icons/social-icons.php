<?php
/*
Plugin Name: Social Icons
Plugin URI: 
Description: Social icons
Author: Vegard Andersen
Version: 0.1
Author URI: http://github.com/vegarda
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');	
	
add_action( 'widgets_init', function(){
	register_widget( 'Social_Icons' );
	wp_enqueue_style('social-icons-style', get_template_directory_uri().'/inc/widgets/social-icons/social-icons.css');
});	

/**
 * Adds Social_Icons widget.
 */
class Social_Icons extends WP_Widget {

	private $n = 4;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Social_Icons', 			// Base ID
			__('Social Icons', 'uka'), 	// Name
			array( 'description' => __( 'Social icons widget', 'uka' ), ) // Args
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
		
		$rows = $instance['rows'];
		$columns = $instance['columns'];
		$this->n = $rows * $columns;
	
		echo $args['before_widget'];
		echo '<div class="widget-social-icons-container">';

		for ($i = 1; $i <= $this->n; $i++) {
			if ( ! empty( $instance['link_'.$i] ) ) {
				if (preg_match('(https?:\/\/(www.)?.+\..+\/)', $instance['link_'.$i])){
					if ($rows * $columns == $i - 1){
						break;
					}
					if (($i - 1) % $columns === 0){
						echo '<div class="widget-row flex space-around">';
					}
					echo '<a class="social-icon-anchor widget-item" href="'.$instance['link_'.$i].'" target="_blank"><i class="social-icon '.get_classes($instance['link_'.$i]).'" aria-hidden="true"></i></a>';
					//echo '<div class="social-icon-container widget-item"><a class="social-icon-anchor widget-item" href="'.$instance['link_'.$i].'" target="_blank"><i class="social-icon '.get_classes($instance['link_'.$i]).'" aria-hidden="true"></i></a></div>';
					if (($i) % $columns === 0){
						echo '</div>';
					}
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
	public function form($instance){
		
		$defaults =  array('rows' => 4, 'columns' => 1);
		$instance = wp_parse_args((array) $instance, $defaults);
		$rows = $instance['rows'];
		$columns = $instance['columns'];
		$this->n = $rows * $columns;
		
		?>
	
		<p><label for="<?php echo $this->get_field_id('rows'); ?>"><?php _e('Number of rows to show: '); ?></label>
		<input class="small-text" id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>" type="number" step="1" min="1" value="<?php echo $rows; ?>" size="3" /></p>
		
		<p><label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Number of columns to show: '); ?></label>
		<input class="small-text" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" type="number" step="1" min="1" value="<?php echo $columns; ?>" size="10" /></p>
		
		<?php
		for ($i = 1; $i <= $this->n; $i++) {
			if ( isset( $instance[ 'link_'.$i ] ) ) {
				$temp_link = $instance[ 'link_'.$i ];
			}
			else {
				$temp_link = 'http://'; //__( '', 'uka' );
			}
			echo '
				<p>
					<label for="'.$this->get_field_id('link_'.$i).'">'._e( 'Link '.$i.':' ).'</label> 
					<input class="widefat" id="'.$this->get_field_id( 'link_'.$i ).'" name="'.$this->get_field_name( 'link_'.$i ).'" type="text" value="'.esc_attr( $temp_link ).'">
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
		$instance = array();
		$instance['rows'] = sanitize_text_field( $new_instance['rows'] );
		$instance['columns'] = sanitize_text_field( $new_instance['columns'] );
		for ($i = 1; $i <= $this->n; $i++){
			if (preg_match('(https?:\/\/)', sanitize_text_field($new_instance['link_'.$i]))) {
				$instance['link_'.$i] = ( ! empty( $new_instance['link_'.$i] ) ) ? sanitize_text_field( $new_instance['link_'.$i] ) : '';
			}
		}
		return $instance;
	}

} // class Social_Icons

function get_classes($link){
	$icons = array('facebook'=>'facebook', 'instagram'=>'instagram', 'snapchat'=>'snapchat-ghost', 'youtube'=>'youtube-play', 'twitter'=>'twitter', 'spotify'=>'spotify');
	$classes = '';
	foreach ($icons as $key => $value){
		if (strpos($link, $key.'.com') !== FALSE){
			$classes = 'fa fa-'.$value;
			break;
		}
	}

	return $classes;
}

?>