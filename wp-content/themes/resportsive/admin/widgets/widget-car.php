<?php
/**
 * Plugin Name: Home Carousel Widget
 */

add_action( 'widgets_init', 'resport_car_load_widgets' );

function resport_car_load_widgets() {
	register_widget( 'resport_car_widget' );
}

class resport_car_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function resport_car_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'resport_car_widget', 'description' => __('A widget that displays a carousel with posts from a specific tag.', 'resport_car_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'resport_car_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'resport_car_widget', __('Resportsive: Home Carousel', 'resport_car_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = $instance['title'];
		$tag = $instance['tag'];
		$num = $instance['num'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */

		?>


		<div class="small-cat-home">
			<h2 class="section"><span class="section"><?php echo $title; ?></span></h2>

			<div id="carousel" class="small-cat-story es-carousel-wrapper">
				<div class="es-carousel">
				<ul>
				<?php $recent = new WP_Query('tag=' . $tag . '&showposts=' . $num . ' '); while($recent->have_posts()) : $recent->the_post();?>
					<li>
						<div class="img-story">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('small-thumb'); ?></a>
							<?php } else { ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><img src="<?php echo bloginfo('template_url'); ?>/images/default145.jpg" /></a>
							<?php } ?>
						</div><!--img-story-->
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
					</li>
				<?php endwhile; ?>
				</ul>
				</div>
			</div><!--small-cat-story-->

		</div><!--small-cat-->


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
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tag'] = strip_tags( $new_instance['tag'] );
		$instance['num'] = strip_tags( $new_instance['num'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Featured', 'num' => 100);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Name of tag -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tag' ); ?>">Name of tag:</label>
			<input id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>" value="<?php echo $instance['tag']; ?>" style="width:90%;" />
		</p>

		<!-- Number of items -->
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>">Maximum number of items in carousel:</label>
			<input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>