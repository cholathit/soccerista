<?php
/**
 * Plugin Name: Scoreboard Widget
 */

add_action( 'widgets_init', 'gd_scoreboard_load_widgets' );

function gd_scoreboard_load_widgets() {
	register_widget( 'gd_scoreboard_widget' );
}

class gd_scoreboard_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function gd_scoreboard_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'gd_scoreboard_widget', 'description' => __('A scoreboard widget.', 'gd_scoreboard_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gd_scoreboard_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'gd_scoreboard_widget', __('Gameday: Scoreboard Widget', 'gd_scoreboard_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$score_name1 = $instance['score_name1'];
		$score_cat1 = $instance['score_cat1'];
		$score_name2 = $instance['score_name2'];
		$score_cat2 = $instance['score_cat2'];
		$score_name3 = $instance['score_name3'];
		$score_cat3 = $instance['score_cat3'];
		$score_name4 = $instance['score_name4'];
		$score_cat4 = $instance['score_cat4'];
		$score_name5 = $instance['score_name5'];
		$score_cat5 = $instance['score_cat5'];
		$score_name6 = $instance['score_name6'];
		$score_cat6 = $instance['score_cat6'];
		$score_name7 = $instance['score_name7'];
		$score_cat7 = $instance['score_cat7'];
		$score_name8 = $instance['score_name8'];
		$score_cat8 = $instance['score_cat8'];

		?>

			<div class="score-wrapper tabber-container">
				<ul class="score-nav tabs">
					<?php if($score_name1) { ?><li><a href="#tab1"><?php echo $score_name1; ?></a></li><?php } ?>
					<?php if($score_name2) { ?><li><a href="#tab2"><?php echo $score_name2; ?></a></li><?php } ?>
					<?php if($score_name3) { ?><li><a href="#tab3"><?php echo $score_name3; ?></a></li><?php } ?>
					<?php if($score_name4) { ?><li><a href="#tab4"><?php echo $score_name4; ?></a></li><?php } ?>
					<?php if($score_name5) { ?><li><a href="#tab5"><?php echo $score_name5; ?></a></li><?php } ?>
					<?php if($score_name6) { ?><li><a href="#tab6"><?php echo $score_name6; ?></a></li><?php } ?>
					<?php if($score_name7) { ?><li><a href="#tab7"><?php echo $score_name7; ?></a></li><?php } ?>
					<?php if($score_name8) { ?><li><a href="#tab8"><?php echo $score_name8; ?></a></li><?php } ?>
				</ul>
				<?php if($score_name1) { ?>
				<div id="tab1" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat1 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab1-->
				<?php } ?>
				<?php if($score_name2) { ?>
				<div id="tab2" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat2 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab2-->
				<?php } ?>
				<?php if($score_name3) { ?>
				<div id="tab3" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat3 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab2-->
				<?php } ?>
				<?php if($score_name4) { ?>
				<div id="tab4" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat4 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab2-->
				<?php } ?>
				<?php if($score_name5) { ?>
				<div id="tab5" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat5 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab2-->
				<?php } ?>
				<?php if($score_name6) { ?>
				<div id="tab6" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat6 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab2-->
				<?php } ?>
				<?php if($score_name7) { ?>
				<div id="tab7" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat7 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab2-->
				<?php } ?>
				<?php if($score_name8) { ?>
				<div id="tab8" class="carousel es-carousel es-carousel-wrapper tabber-content">
					<ul class="score-list">
						<?php global $post; $recent = new WP_Query(array( 'post_type' => 'scoreboard', 'showposts' => '999', 'tax_query' => array(array( 'taxonomy' => 'scores_cat', 'field' => 'slug', 'terms' => $score_cat8 ))  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span class="score-status"><?php echo get_post_meta($post->ID, "gd_status", true); ?></span>
							<div class="score-teams">
								<?php echo get_post_meta($post->ID, "gd_away_team", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team", true); ?>
							</div><!--score-teams-->
							<div class="score-right">
								<?php echo get_post_meta($post->ID, "gd_away_team_score", true); ?><br />
								<?php echo get_post_meta($post->ID, "gd_home_team_score", true); ?>
							</div><!--score-right-->
							</a>
						</li>
						<?php endwhile; ?>
					</ul><!--score-list-->
				</div><!--tab2-->
				<?php } ?>
			</div><!--score-wrapper-->

		<?php

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['score_name1'] = strip_tags( $new_instance['score_name1'] );
		$instance['score_cat1'] = strip_tags( $new_instance['score_cat1'] );
		$instance['score_name2'] = strip_tags( $new_instance['score_name2'] );
		$instance['score_cat2'] = strip_tags( $new_instance['score_cat2'] );
		$instance['score_name3'] = strip_tags( $new_instance['score_name3'] );
		$instance['score_cat3'] = strip_tags( $new_instance['score_cat3'] );
		$instance['score_name4'] = strip_tags( $new_instance['score_name4'] );
		$instance['score_cat4'] = strip_tags( $new_instance['score_cat4'] );
		$instance['score_name5'] = strip_tags( $new_instance['score_name5'] );
		$instance['score_cat5'] = strip_tags( $new_instance['score_cat5'] );
		$instance['score_name6'] = strip_tags( $new_instance['score_name6'] );
		$instance['score_cat6'] = strip_tags( $new_instance['score_cat6'] );
		$instance['score_name7'] = strip_tags( $new_instance['score_name7'] );
		$instance['score_cat7'] = strip_tags( $new_instance['score_cat7'] );
		$instance['score_name8'] = strip_tags( $new_instance['score_name8'] );
		$instance['score_cat8'] = strip_tags( $new_instance['score_cat8'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Category Name 1 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name1' ); ?>">Name of Category #1:</label>
			<input id="<?php echo $this->get_field_id( 'score_name1' ); ?>" name="<?php echo $this->get_field_name( 'score_name1' ); ?>" value="<?php echo $instance['score_name1']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 1 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat1'); ?>">Select Scoreboard Category #1:</label>
			<select id="<?php echo $this->get_field_id('score_cat1'); ?>" name="<?php echo $this->get_field_name('score_cat1'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat1']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat1']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Category Name 2 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name2' ); ?>">Name of Category #2:</label>
			<input id="<?php echo $this->get_field_id( 'score_name2' ); ?>" name="<?php echo $this->get_field_name( 'score_name2' ); ?>" value="<?php echo $instance['score_name2']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 2 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat2'); ?>">Select Scoreboard Category #2:</label>
			<select id="<?php echo $this->get_field_id('score_cat2'); ?>" name="<?php echo $this->get_field_name('score_cat2'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat2']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat2']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Category Name 3 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name3' ); ?>">Name of Category #3:</label>
			<input id="<?php echo $this->get_field_id( 'score_name3' ); ?>" name="<?php echo $this->get_field_name( 'score_name3' ); ?>" value="<?php echo $instance['score_name3']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 3 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat3'); ?>">Select Scoreboard Category #3:</label>
			<select id="<?php echo $this->get_field_id('score_cat3'); ?>" name="<?php echo $this->get_field_name('score_cat3'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat3']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat3']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Category Name 4 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name4' ); ?>">Name of Category #4:</label>
			<input id="<?php echo $this->get_field_id( 'score_name4' ); ?>" name="<?php echo $this->get_field_name( 'score_name4' ); ?>" value="<?php echo $instance['score_name4']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 4 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat4'); ?>">Select Scoreboard Category #4:</label>
			<select id="<?php echo $this->get_field_id('score_cat4'); ?>" name="<?php echo $this->get_field_name('score_cat4'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat4']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat4']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Category Name 5 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name5' ); ?>">Name of Category #5:</label>
			<input id="<?php echo $this->get_field_id( 'score_name5' ); ?>" name="<?php echo $this->get_field_name( 'score_name5' ); ?>" value="<?php echo $instance['score_name5']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 5 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat5'); ?>">Select Scoreboard Category #5:</label>
			<select id="<?php echo $this->get_field_id('score_cat5'); ?>" name="<?php echo $this->get_field_name('score_cat5'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat5']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat5']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Category Name 6 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name6' ); ?>">Name of Category #6:</label>
			<input id="<?php echo $this->get_field_id( 'score_name6' ); ?>" name="<?php echo $this->get_field_name( 'score_name6' ); ?>" value="<?php echo $instance['score_name6']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 6 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat6'); ?>">Select Scoreboard Category #6:</label>
			<select id="<?php echo $this->get_field_id('score_cat6'); ?>" name="<?php echo $this->get_field_name('score_cat6'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat6']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat6']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Category Name 7 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name7' ); ?>">Name of Category #7:</label>
			<input id="<?php echo $this->get_field_id( 'score_name7' ); ?>" name="<?php echo $this->get_field_name( 'score_name7' ); ?>" value="<?php echo $instance['score_name7']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 7 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat7'); ?>">Select Scoreboard Category #7:</label>
			<select id="<?php echo $this->get_field_id('score_cat7'); ?>" name="<?php echo $this->get_field_name('score_cat7'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat7']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat7']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Category Name 8 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'score_name8' ); ?>">Name of Category #8:</label>
			<input id="<?php echo $this->get_field_id( 'score_name8' ); ?>" name="<?php echo $this->get_field_name( 'score_name8' ); ?>" value="<?php echo $instance['score_name8']; ?>" style="width:90%;" />
		</p>

		<!-- Category Slug 8 -->
		<p>
			<label for="<?php echo $this->get_field_id('score_cat8'); ?>">Select Scoreboard Category #8:</label>
			<select id="<?php echo $this->get_field_id('score_cat8'); ?>" name="<?php echo $this->get_field_name('score_cat8'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['score_cat8']) echo 'selected="selected"'; ?>>Select a category:</option>
				<?php $scores = get_terms('scores_cat'); ?>
				<?php foreach($scores as $score) { ?>
				<option value='<?php echo $score->slug; ?>' <?php if ($score->slug == $instance['score_cat8']) echo 'selected="selected"'; ?>><?php echo $score->slug; ?></option>
				<?php } ?>
			</select>
		</p>


	<?php
	}
}

?>