<?php
/**
 * Plugin Name: Tabs Widget
 */

add_action( 'widgets_init', 'resport_tabs_load_widgets' );

function resport_tabs_load_widgets() {
	register_widget( 'resport_tabs_widget' );
}

class resport_tabs_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function resport_tabs_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'resport_tabs_widget', 'description' => __('A widget that displays recent headlines, popular posts and recent comments in tabs', 'resport_tabs_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'resport_tabs_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'resport_tabs_widget', __('Resportsive: Tabs', 'resport_tabs_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$head_tag = $instance['head_tag'];
		$head_num = $instance['head_num'];
		$popular = $instance['popular'];
		$com_num = $instance['com_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */

		?>


	<div class="tabs-wrapper">

			<ul class="tabs">
    			 <li><a href="#tab1">Headlines</a></li>
    			 <li><a href="#tab2">Popular</a></li>
    			 <li><a href="#tab3">Comments</a></li>
  			</ul>

			<div id="tab1" class="tab-content">
					<ul>
					<?php $recent = new WP_Query('tag=' . $head_tag . '&showposts=' . $head_num . ' '); while($recent->have_posts()) : $recent->the_post();?>
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
   			<div id="tab2" class="tab-content">
				<?php
				$popular_posts = new WP_Query('showposts=' . $popular . '&orderby=comment_count&order=DESC');
				if($popular_posts->have_posts()): ?>

				<ul>
					<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
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
				<?php endif; ?>
			</div>
   			<div id="tab3" class="tab-content">

				<?php
				global $wpdb;
				$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type,comment_author_url,
				SUBSTRING(comment_content,1,45) AS com_excerpt
				FROM $wpdb->comments
				LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
				$wpdb->posts.ID)
				WHERE comment_approved = '1' AND comment_type = '' AND
				post_password = ''
				ORDER BY comment_date_gmt DESC
				LIMIT $com_num";
				$comments = $wpdb->get_results($sql);
				foreach ($comments as $comment) {

				?>

				<ul class="latest-comments">

					<li>

					<?php echo get_avatar( $comment, '40' ); ?>
					<strong><?php echo strip_tags($comment->comment_author); ?> says:</strong><br />
					<?php echo strip_tags($comment->com_excerpt); ?>...<br />
					<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->post_title); ?></a>

					</li>
				</ul>
				<?php } ?>

			</div>

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
		$instance['head_tag'] = strip_tags( $new_instance['head_tag'] );
		$instance['head_num'] = strip_tags( $new_instance['head_num'] );
		$instance['popular'] = strip_tags( $new_instance['popular'] );
		$instance['com_num'] = strip_tags( $new_instance['com_num'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'head_num' => 3, 'popular' => 3, 'com_num' => 4);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Headlines tag -->
		<p>
			<label for="<?php echo $this->get_field_id( 'head_tag' ); ?>">Headline tag:</label>
			<input id="<?php echo $this->get_field_id( 'head_tag' ); ?>" name="<?php echo $this->get_field_name( 'head_tag' ); ?>" value="<?php echo $instance['head_tag']; ?>" style="width:90%;" />
			<small>Posts with this tag will show up in the Headlines tab.</small>
		</p>

		<!-- Headlines number -->
		<p>
			<label for="<?php echo $this->get_field_id( 'head_num' ); ?>">Number of headlines:</label>
			<input id="<?php echo $this->get_field_id( 'head_num' ); ?>" name="<?php echo $this->get_field_name( 'head_num' ); ?>" value="<?php echo $instance['head_num']; ?>" style="width:20%;" />
		</p>

		<!-- Popular posts number -->
		<p>
				<label for="<?php echo $this->get_field_id( 'popular' ); ?>">Number of popular posts:</label>
				<input id="<?php echo $this->get_field_id( 'popular' ); ?>" name="<?php echo $this->get_field_name( 'popular' ); ?>" value="<?php echo $instance['popular']; ?>" style="width:20%;" />
		</p>

		<!-- Recent comments number -->
		<p>
				<label for="<?php echo $this->get_field_id( 'com_num' ); ?>">Number of recent comments:</label>
				<input id="<?php echo $this->get_field_id( 'com_num' ); ?>" name="<?php echo $this->get_field_name( 'com_num' ); ?>" value="<?php echo $instance['com_num']; ?>" style="width:20%;" />
		</p>



	<?php
	}
}

?>