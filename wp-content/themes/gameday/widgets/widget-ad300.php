<?php
/**
 * Plugin Name: 300px Ad Widget
 */

add_action( 'widgets_init', 'gd_ad300_load_widgets' );

function gd_ad300_load_widgets() {
	register_widget( 'gd_ad300_widget' );
}

class gd_ad300_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function gd_ad300_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'gd_ad300_widget', 'description' => __('A widget that displays any 300px wide ad.', 'gd_ad300_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gd_ad300_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'gd_ad300_widget', __('Gameday: 300px Ad Widget', 'gd_ad300_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$code = $instance['code'];

		?>

			<div class="widget-container">
				<?php echo $code; ?>
			</div><!--widget-container-->

		<?php

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['code'] = $new_instance['code'];


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'code' => 'Enter ad code here');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Ad code -->
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>">Ad code:</label>
			<textarea id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>" style="width:96%;" rows="6"><?php echo $instance['code']; ?></textarea>
		</p>


	<?php
	}
}

?>