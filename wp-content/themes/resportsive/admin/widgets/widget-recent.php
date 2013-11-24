<?php
/**
 * Plugin Name: Home Recent Posts Widget
 */

add_action( 'widgets_init', 'resport_recent_load_widgets' );

function resport_recent_load_widgets() {
	register_widget( 'resport_recent_widget' );
}

class resport_recent_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function resport_recent_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'resport_recent_widget', 'description' => __('A widget that displays a specified number of posts in a list.', 'resport_recent_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'resport_recent_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'resport_recent_widget', __('Resportsive: Home Recent Posts', 'resport_recent_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = $instance['title'];
		$post_num = $instance['post_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */

		?>



				<h2 class="section"><span class="section"><?php echo $title; ?></span></h2>

			<ul class="recent">
			<?php $recent = new WP_Query('showposts=' . $post_num . ' '); while($recent->have_posts()) : $recent->the_post();?>
			<li>
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
			<div class="home-story-cat">
				<div class="img-contain">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('home-thumb'); ?></a>
				</div><!--img-contain-->
				<div class="story-text">
					<div class="cat-small"><?php the_category(); ?></div>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php content(20, __('Read more &raquo;')); ?>
				</div><!--story-text-->
			</div><!--home-story-cat-->
			<?php } else { ?>
			<div class="home-story-cat">
				<div class="story-text-noimg">
					<div class="cat-small"><?php the_category(); ?></div>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php content(20, __('Read more &raquo;')); ?>
				</div><!--story-text-->
			</div>
			<?php } ?>
			</li>
			<?php endwhile; ?>
			</ul>


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
		$instance['post_num'] = strip_tags( $new_instance['post_num'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'More Stories', 'post_num' => 6);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Name of category #1:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_num' ); ?>">Number of posts:</label>
			<input id="<?php echo $this->get_field_id( 'post_num' ); ?>" name="<?php echo $this->get_field_name( 'post_num' ); ?>" value="<?php echo $instance['post_num']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>