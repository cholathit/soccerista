<?php
/**
 * Plugin Name: Social Widget
 */

add_action( 'widgets_init', 'resport_soc_load_widgets' );

function resport_soc_load_widgets() {
	register_widget( 'resport_soc_widget' );
}

class resport_soc_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function resport_soc_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'resport_soc_widget', 'description' => __('A widget to display social buttons in sidebar', 'resport_soc_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'resport_soc_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'resport_soc_widget', __('Resportsive: Social Widget', 'resport_soc_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$code = $instance['code'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */

		?>

		<div class="social-contain">

			<ul id="social">
				<?php if(get_option('resport_facebook')) { ?><li><a href="http://www.facebook.com/<?php echo get_option('resport_facebook'); ?>" target="_blank" class="soc-fb"></a></li><?php } ?>
				<?php if(get_option('resport_twitter')) { ?><li><a href="http://www.twitter.com/<?php echo get_option('resport_twitter'); ?>" target="_blank" class="soc-twi"></a></li><?php } ?>
				<?php if(get_option('resport_gplus')) { ?><li><a href="<?php echo get_option('resport_gplus'); ?>" target="_blank" class="soc-gp"></a></li><?php } ?>
				<?php if(get_option('resport_pinterest')) { ?><li><a href="http://www.pinterest.com/<?php echo get_option('resport_pinterest'); ?>" target="_blank" class="soc-pin"></a></li><?php } ?>
				<li><a href="<?php bloginfo('rss_url'); ?>" class="soc-rss"></a></li>
			</ul>

		</div>

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
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
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Ad code -->
		<p>Social media buttons will automatically appear once you enter your information in the "Social Media Options" section of the <a href="../wp-admin/themes.php?page=optionsframework">Theme Options.</a></p>


	<?php
	}
}

?>