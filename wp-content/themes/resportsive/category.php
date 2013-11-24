<?php get_header(); ?>

<div id="main">
	<div id="post-area">
		<div class="breadcrumb">
			<?php if (function_exists('wp_bac_breadcrumb')) {wp_bac_breadcrumb();} ?>
		</div>
		<h1 class="page-header headline"><?php single_cat_title(); ?></h1>
		<ul class="recent">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<li>
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
			<div class="home-story-cat">
				<div class="img-contain">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('home-thumb'); ?></a>
				</div><!--img-contain-->
				<div class="story-text">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php content(30, __('Read more &raquo;')); ?>
				</div><!--story-text-->
			</div><!--home-story-cat-->
			<?php } else { ?>
			<div class="home-story-cat">
				<div class="story-text-noimg">
					<div class="cat-small"><?php the_category(); ?></div>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php content(20, __('Read more &raquo;')); ?>
				</div><!--story-text-->
			</div>
			<?php } ?>
			</li>
		<?php endwhile; endif; ?>
		</ul>
		<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>
	</div><!--post-area-->
</div><!--main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>