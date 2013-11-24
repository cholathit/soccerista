<?php get_header(); ?>

<div id="main-home">
	<div id="featured-wrapper">
		<div id="featured-main">
			<div class="flexslider">
				<ul class="slides">
					<?php $recent = new WP_Query(array( 'tag' => get_option('gd_slider_tags'), 'showposts' => get_option('gd_slider_num')  )); while($recent->have_posts()) : $recent->the_post();?>
					<li>
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('slider-thumb'); ?></a>
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/noimg.jpg" /></a>
						<?php } ?>
						<div class="featured-text">
							<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
							<h2 class="slider-headline"><a href="<?php the_permalink() ?>"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></a></h2>
							<?php else: ?>
							<h2 class="slider-headline"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<?php endif; ?>
							<p><?php echo excerpt(22); ?></p>
						</div><!--featured-text-->
					</li>
					<?php endwhile; ?>
				</ul>
			</div><!--flexslider-->
		</div><!--featured-main-->
		<div id="headlines-wrapper">
			<span class="headlines-header"><?php _e( 'Right Now', 'mvp-text' ); ?></span>
			<ul class="headlines">
				<?php $recent = new WP_Query('showposts=6'); while($recent->have_posts()) : $recent->the_post();?>
				<li>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('small-thumb'); ?></a>
					<div class="headlines-text">
						<span class="date-cat"><?php the_time('F j, Y'); ?> | </span><ul class="headlines-cat"><?php the_category(); ?></ul>
						<p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
					</div><!--headlines-text-->
				</li>
				<?php endwhile; ?>
			</ul>
		</div><!--headlines-wrapper-->
	</div><!--featured-wrapper-->
	<div id="homepage-wrapper">
		<?php if(get_option('gd_home_layout') == 'Widgets') { ?>
		<div id="home-widget-wrapper">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widget Area')): endif; ?>
		</div><!--home-widget-wrapper-->
		<?php } else { ?>
		<div id="home-blog-contain">
			<div id="home-blog-wrapper">
				<ul>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<li class="blog-container">
						<span class="blog-cat"><?php the_category(); ?></span>
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<div class="widget-img">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('large-thumb'); ?></a>
						</div><!--widget-img-->
						<?php } else { ?>
						<div style="height: 20px;"></div>
						<?php } ?>
						<div class="blog-inner">
							<h3 class="home-title1"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
							<p><?php echo excerpt(20); ?></p>
						</div><!--blog-inner-->
					</li>
					<?php endwhile; endif; ?>
				</ul>
			</div><!--home-blog-wrapper-->
			<div class="nav-links">
				<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
			</div><!--nav-links-->
		</div><!--home-blog-contain-->
		<div id="sidebar-wrapper" class="home-blog-sidebar">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Blog Sidebar Widget Area')): endif; ?>
		</div><!--sidebar-wrapper-->
		<?php } ?>
	</div><!--homepage-wrapper-->
</div><!--main-home-->

<?php get_footer(); ?>