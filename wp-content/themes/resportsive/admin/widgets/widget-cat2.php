<?php
/**
 * Plugin Name: Home Category 2 Widget
 */

add_action( 'widgets_init', 'resport_cat2_load_widgets' );

function resport_cat2_load_widgets() {
	register_widget( 'resport_cat2_widget' );
}

class resport_cat2_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function resport_cat2_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'resport_cat2_widget', 'description' => __('A widget that displays two category modules, each with one main story from a category and a specified number of headlines underneath.', 'resport_cat2_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'resport_cat2_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'resport_cat2_widget', __('Resportsive: Home Category 2', 'resport_cat2_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$category1 = $instance['category1'];
		$category2 = $instance['category2'];
		$cat_num = $instance['cat_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */

		?>


	<div class="home-cat-wrapper">
		<div class="home-cat-left">
			<?php $recent = new WP_Query(array( 'category_name' => ' ' . $category1 . ' ', 'showposts' => '1'  )); while($recent->have_posts()) : $recent->the_post();?>
			<div class="section-header">
				<h2><span><?php echo $category1; ?></span></h2>
			</div>
			<div class="home-story">
				<div class="img-story">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('half-thumb'); ?></a>
					<?php } ?>
				</div><!--img-story-->
				<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<?php content(19, __('Read more &raquo;')); ?>
				<?php endwhile; ?>
			</div><!--home-story-->
			<div class="home-headlines">
				<ul>
					<?php $recent = new WP_Query(array( 'category_name' => ' ' . $category1 . ' ', 'showposts' => ' ' . $cat_num . ' ', 'offset' => '1'  )); while($recent->have_posts()) : $recent->the_post();?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul>
			</div><!--home-headlines-->
		</div><!--home-cat-left-->
		<div class="home-cat-right">
			<?php $recent = new WP_Query(array( 'category_name' => ' ' . $category2 . ' ', 'showposts' => '1'  )); while($recent->have_posts()) : $recent->the_post();?>
			<div class="section-header">
				<h2><span><?php echo $category2; ?></span></h2>
			</div>
			<div class="home-story">
				<div class="img-story">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('half-thumb'); ?></a>
					<?php } ?>
				</div><!--img-story-->
				<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<?php content(20, __('Read more &raquo;')); ?>
				<?php endwhile; ?>
			</div><!--home-story-->
			<div class="home-headlines">
				<ul>
					<?php $recent = new WP_Query(array( 'category_name' => ' ' . $category2 . ' ', 'showposts' => ' ' . $cat_num . ' ', 'offset' => '1'  )); while($recent->have_posts()) : $recent->the_post();?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul>
			</div><!--home-headlines-->
		</div><!--home-cat-right-->

	</div><!--home-cat-wrapper-->


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
		$instance['category1'] = strip_tags( $new_instance['category1'] );
		$instance['category2'] = strip_tags( $new_instance['category2'] );
		$instance['cat_num'] = strip_tags( $new_instance['cat_num'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'cat_num' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Name of category #1 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category1' ); ?>">Name of category #1:</label>
			<input id="<?php echo $this->get_field_id( 'category1' ); ?>" name="<?php echo $this->get_field_name( 'category1' ); ?>" value="<?php echo $instance['category1']; ?>" style="width:90%;" />
		</p>

		<!-- Name of category #2 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category2' ); ?>">Name of category #2:</label>
			<input id="<?php echo $this->get_field_id( 'category2' ); ?>" name="<?php echo $this->get_field_name( 'category2' ); ?>" value="<?php echo $instance['category2']; ?>" style="width:90%;" />
		</p>

		<!-- Name of tag -->
		<p>
			<label for="<?php echo $this->get_field_id( 'cat_num' ); ?>">Number of headlines:</label>
			<input id="<?php echo $this->get_field_id( 'cat_num' ); ?>" name="<?php echo $this->get_field_name( 'cat_num' ); ?>" value="<?php echo $instance['cat_num']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>