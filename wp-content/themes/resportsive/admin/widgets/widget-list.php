<?php
/**
 * Plugin Name: Category List Widget
 */

add_action( 'widgets_init', 'resport_list_load_widgets' );

function resport_list_load_widgets() {
	register_widget( 'resport_list_widget' );
}

class resport_list_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function resport_list_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'resport_list_widget', 'description' => __('A widget that displays category posts with a square thumbnail', 'resport_list_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'resport_list_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'resport_list_widget', __('Resportsive: Category List', 'resport_list_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$category = apply_filters('widget_title', $instance['category'] );
		$cat_num = $instance['cat_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?>

		<div class="widget-list">
		<h3 class="widget"><span class="widget"><?php echo $category; ?></span></h3>
			<ul>
			<?php $recent = new WP_Query(array( 'category_name' => ' ' . $category . ' ', 'showposts' => ' ' . $cat_num . ' '  )); while($recent->have_posts()) : $recent->the_post();?>
			<li>
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
			<div class="contain">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('square-thumb'); ?></a>
			</div>
			<div class="text">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php content(11, __('')); ?>
			</div>
			<?php } else { ?>
			<div class="text-noimg">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php content(11, __('')); ?>
			</div>
			<?php } ?>
			</li>
			<?php endwhile; ?>
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
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['cat_num'] = strip_tags( $new_instance['cat_num'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'cat_num' => 3);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Name of category:</label>
			<input id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo $instance['category']; ?>" style="width:90%;" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'cat_num' ); ?>">Number of posts:</label>
			<input id="<?php echo $this->get_field_id( 'cat_num' ); ?>" name="<?php echo $this->get_field_name( 'cat_num' ); ?>" value="<?php echo $instance['cat_num']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>