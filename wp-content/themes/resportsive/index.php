<?php get_header(); ?>

<div id="main">
	<div id="home-top">
		<div id="home-feature">
			<?php if(get_option('resport_slider_tags')) { ?>
			<div class="flexslider-container">
				<div class="flexslider">
		    			<ul class="slides">
						<?php $recent = new WP_Query(array( 'tag' => get_option('resport_slider_tags'), 'showposts' => get_option('resport_max_slides')  )); while($recent->have_posts()) : $recent->the_post();?>
						<li>
						<div class="home-feature-main">
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('post-thumb'); ?></a>
							<?php } else { ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><img src="<?php echo bloginfo('template_url'); ?>/images/default610.jpg" /></a>
							<?php } ?>
						</div><!--home-feature-main-->
						<div class="home-feature-box">
							<?php if(get_post_meta($post->ID, "resportsive_featured_headline", true)): ?>
							<h1><a href="<?php the_permalink() ?>"><?php echo get_post_meta($post->ID, "resportsive_featured_headline", true); ?></a></h1>
							<?php else: ?>
							<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
							<?php endif; ?>
							<?php content(27, __('Read more &raquo;')); ?>
						</div><!--home-feature-box-->
						</li>
						<?php endwhile; ?>
					</ul>
				</div><!--flexslider-->
			</div><!--flexslider-container-->
			<?php } ?>
		</div><!--home-feature-->
	</div><!--home-top-->
	<?php
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widget Area')): 
	endif;
	?>
</div><!--main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>