<?php
add_action('widgets_init', 'vrg_carousel');

function vrg_carousel()
{
	register_widget('vrg_carousel');
}

class vrg_carousel extends WP_Widget {
	
	function vrg_carousel()
	{
		$widget_ops = array('classname' => 'vrg_carousel', 'description' => 'Featured posts widget.');

		$control_ops = array('id_base' => 'vrg_carousel');

		$this->WP_Widget('vrg_carousel', 'Vergo - Home Carousel', $widget_ops, $control_ops);
		
		function check_widget_carousel() {
    		if( is_active_widget( '', '', 'vrg_carousel' ) ) { // check if flex carousel widget is used
				wp_enqueue_script('jquery.flexslider-min', get_template_directory_uri() .'/js/jquery.flexslider-min.js','','', true);
        		wp_enqueue_script('jquery.flexslider.start.carousel', get_template_directory_uri() .'/js/jquery.flexslider.start.carousel.js','','', true);
    }
}

add_action( 'init', 'check_widget_carousel' );
    }
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		
		echo $before_widget;
		?>
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>
			

			<h2 class="widget widget-single"><a href="<?php echo get_category_link($categories); ?>"><?php echo $title; ?></a>
            </h2>
			
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'cat' => $categories,
			));
			?>
            <div class="widgetflexslider flexslider">
            <ul class="slides">
			<?php  while($recent_posts->have_posts()): $recent_posts->the_post(); ?>

			<li>
                    
					<?php if ( has_post_thumbnail()) : ?>
                         <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
                         <?php the_post_thumbnail( 'carousel',array('title' => "")); ?>
                         </a>
                    <?php endif; ?>

					<p class="meta"><?php the_time('M j') ?> &bull; <?php echo getPostViews(get_the_ID()); ?> <?php _e('Views','vergo');?></p>
                    <p><a class="title" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo short_title('...', 16); ?></a></p>
                    
                    <?php echo vrg_ribbon() ?>
                    <?php if(function_exists('the_ratings')) { echo expand_ratings_template('<span class="rating">%RATINGS_IMAGES%</span>', get_the_ID()); } ?>   
			</li>

			<?php  endwhile; ?>
			</ul>
            </div>

		
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'post_type' => 'all', 'categories' => 'all', 'posts' => 12, 'show_excerpt' => null);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		

	<?php }
}
?>