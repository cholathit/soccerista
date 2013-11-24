<?php
add_action('widgets_init', 'vrg_slider_2col');

function vrg_slider_2col()
{
	register_widget('vrg_slider_2col_widget');
}

class vrg_slider_2col_widget extends WP_Widget {
	
	function vrg_slider_2col_widget()
	{
		$widget_ops = array('classname' => 'vrg_slider_2col', 'description' => 'Homepage widget Slider + One category.');

		$control_ops = array('id_base' => 'vrg_slider_2col');

		$this->WP_Widget('vrg_slider_2col', 'Vergo - Home Slider +', $widget_ops, $control_ops);
		
		function check_widget_flex() {
    		if( is_active_widget( '', '', 'vrg_slider_2col' ) ) { // check if flex carousel widget is used
				wp_enqueue_script('jquery.flexslider-min', get_template_directory_uri() .'/js/jquery.flexslider-min.js','','', true);
        		wp_enqueue_script('jquery.flexslider.start.main', get_template_directory_uri() .'/js/jquery.flexslider.start.main.js','','', true);
    }
}

add_action( 'init', 'check_widget_flex' );
		
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$images = true;

		$title_2 = $instance['title_2'];
		$post_type_2 = 'all';
		$categories_2 = $instance['categories_2'];
		$posts_2 = $instance['posts_2'];
		$images_2 = true;
		
		echo $before_widget;
		?>


		
		<div class="slidercol">
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'cat' => $categories,
			));
			?>
            <div class="mainflex flexslider">
                <ul class="slides">
                <?php  while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
    
                    <li>
                            
                            <?php if ( has_post_thumbnail()) : ?>
                                 <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
                                 <?php the_post_thumbnail( 'slider',array('title' => "")); ?>
                                 </a>
                            <?php endif; ?>
                                
                            <h2 class="upperfont"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo short_title('...', 14); ?></a></h2>
                            <p class="meta"><?php the_time('M j') ?> &bull; <?php echo getPostViews(get_the_ID()); ?> <?php _e('Views','vergo');?> &bull; <?php comments_popup_link(); ?></p>
                            <p class="teaser">
								<?php echo vergo_excerpt( get_the_excerpt(), '260'); ?>
                                <?php echo vrg_ribbon() ?>
                            </p> 
                           <?php if(function_exists('the_ratings')) { echo expand_ratings_template('<span class="rating">%RATINGS_IMAGES%</span>', get_the_ID()); } ?>     
                    </li>
                    
                <?php  endwhile; ?>
                </ul>
            </div>
            <div style="clear: both;"></div>
            <a class="moreposts" href="<?php echo get_category_link($categories); ?>"><?php echo $title; ?></a>
		</div>
		
		<div class="seccol">

			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts_2,
				'cat' => $categories_2,
			));
			?>		
            
			<?php $counter = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); if($counter == 1): ?>	
            <ul>

			<li>
                    
					<?php if ( has_post_thumbnail()) : ?>
                         <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
                         <?php the_post_thumbnail( 'seccol',array('title' => "")); ?>
                         </a>
                    <?php endif; ?>
                        
                    <p><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo short_title('...', 16); ?> </a></p>
                    
                    <p class="pnormal">
                        <?php the_time('M j') ?> &bull; 
                        <?php echo getPostViews(get_the_ID()); ?> <?php _e('Views','vergo');?> &bull; 
						<?php echo vergo_excerpt( get_the_excerpt(), '125'); ?><br/>
                        <?php if(function_exists('the_ratings')) { echo expand_ratings_template('<span class="rating">%RATINGS_IMAGES%</span>', get_the_ID()); } ?>
                   	</p> 
                        
			</li>
            
			<?php else: ?>
            
            <li>  
              
                <p><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo short_title('...', 16); ?> </a></p>
                
                <p class="pnormal"> <?php echo vergo_excerpt( get_the_excerpt(), '100'); ?></p> 
                    
			</li>

			<?php endif; $counter++; endwhile; ?>
			</ul>

        
		<a class="moreposts" href="<?php echo get_category_link($categories_2); ?>"><?php echo $title_2; ?></a>
		</div><div style="clear: both;"></div>
        
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
		$instance['show_images'] = true;
		
		$instance['title_2'] = $new_instance['title_2'];
		$instance['post_type_2'] = 'all';
		$instance['categories_2'] = $new_instance['categories_2'];
		$instance['posts_2'] = $new_instance['posts_2'];
		$instance['show_images_2'] = true;
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('show_excerpt' => null, 'title' => 'Recent Posts', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'title_2' => 'Recent Posts', 'post_type_2' => 'all', 'categories_2' => 'all', 'posts_2' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		
		<h3>Slider category</h3>
		
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
		
		<h3 style='margin-top: 40px;'>2nd Category</h3>
		
		<p>
			<label for="<?php echo $this->get_field_id('title_2'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title_2'); ?>" name="<?php echo $this->get_field_name('title_2'); ?>" value="<?php echo $instance['title_2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories_2'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories_2'); ?>" name="<?php echo $this->get_field_name('categories_2'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories_2']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories_2']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_2'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts_2'); ?>" name="<?php echo $this->get_field_name('posts_2'); ?>" value="<?php echo $instance['posts_2']; ?>" />
		</p>
	<?php }
}
?>