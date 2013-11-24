<?php
/**
 * Plugin Name: Category Feature Widget
 */

add_action( 'widgets_init', 'gd_catfeat_load_widgets' );

function gd_catfeat_load_widgets() {
	register_widget( 'gd_catfeat_widget' );
}

class gd_catfeat_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function gd_catfeat_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'gd_catfeat_widget', 'description' => __('A widget that displays posts from a category of your choice.', 'gd_catfeat_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gd_catfeat_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'gd_catfeat_widget', __('Gameday: Category Feature', 'gd_catfeat_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$links = $instance['links'];
		$links_num = $instance['links_num'];

		?>

			<div class="widget-container">
				<span class="blog-cat-title"><?php echo $title; ?></span>
				<?php $recent = new WP_Query(array( 'cat' => $categories, 'showposts' => 1 )); while($recent->have_posts()) : $recent->the_post();?>
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<div class="widget-img">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('large-thumb'); ?></a>
				</div><!--widget-img-->
				<?php } ?>
				<div class="widget-inner">
					<h3 class="home-title1"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<p class="gd-widgets"><?php echo excerpt(20); ?></p>
					<?php endwhile; ?>

					<?php if($links) { ?>
					<ul class="home-links1">
						<?php $recent = new WP_Query(array( 'cat' => $categories, 'showposts' => $links_num, 'offset' => 1 )); while($recent->have_posts()) : $recent->the_post();?>
						<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
					</ul>
					<?php } ?>
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
		$instance['links'] = strip_tags( $new_instance['links'] );
		$instance['links_num'] = strip_tags( $new_instance['links_num'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Category Title', 'links' => 'on', 'links_num' => 4);
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

		<!-- Links -->
		<p>
			<label for="<?php echo $this->get_field_id( 'links' ); ?>">Show Links:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'links' ); ?>" name="<?php echo $this->get_field_name( 'links' ); ?>" <?php checked( (bool) $instance['links'], true ); ?> />
		</p>

		<!-- Number of Links -->
		<p>
			<label for="<?php echo $this->get_field_id( 'links_num' ); ?>">Number of links:</label>
			<input id="<?php echo $this->get_field_id( 'links_num' ); ?>" name="<?php echo $this->get_field_name( 'links_num' ); ?>" value="<?php echo $instance['links_num']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>