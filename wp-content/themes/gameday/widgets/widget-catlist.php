<?php
/**
 * Plugin Name: Category List Widget
 */

add_action( 'widgets_init', 'gd_catlist_load_widgets' );

function gd_catlist_load_widgets() {
	register_widget( 'gd_catlist_widget' );
}

class gd_catlist_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function gd_catlist_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'gd_catlist_widget', 'description' => __('A widget that displays posts from a category of your choice.', 'gd_catlist_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gd_catlist_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'gd_catlist_widget', __('Gameday: Category List', 'gd_catlist_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$posts_num = $instance['posts_num'];

		?>

			<div class="widget-container">
				<div class="widget-inner">
					<h4 class="widget-header"><?php echo $title; ?></h4>
					<ul class="home-links2">
						<?php $recent = new WP_Query(array( 'cat' => $categories, 'showposts' => $posts_num )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
							<div class="widget-img">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
							</div><!--widget-img-->
							<?php } ?>
							<div class="home-links2-text">
								<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
								<p class="gd-widgets"><?php echo excerpt(7); ?></p>
							</div><!--home-links2-text-->
						</li>
						<?php endwhile; ?>
					</ul>
				</div><!--widget-inner-->
			</div><!--widget-container-->

		<?php

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = strip_tags( $new_instance['categories'] );
		$instance['posts_num'] = strip_tags( $new_instance['posts_num'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Category Title', 'posts_num' => 4);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Name of Category:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Select Category:</label>
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All Categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Number of Posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_num' ); ?>">Number of posts:</label>
			<input id="<?php echo $this->get_field_id( 'posts_num' ); ?>" name="<?php echo $this->get_field_name( 'posts_num' ); ?>" value="<?php echo $instance['posts_num']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>