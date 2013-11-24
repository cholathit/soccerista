<?php get_header(); ?>

<div id="main">
	<div class="breadcrumb">
		<?php echo dimox_breadcrumbs(); ?>
	</div><!--breadcrumb-->
	<h1 class="headline archive-header">Search results for "<?php the_search_query() ?>"</h1>
	<div id="archive-area">
		<div id="cat-blog-wrapper">
			<ul>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li class="cat-blog-container">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<div class="widget-img">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('large-thumb'); ?></a>
					</div><!--widget-img-->
					<?php } ?>
					<div class="cat-blog-inner">
						<h3 class="home-title1"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<p><?php echo excerpt(18); ?></p>
					</div><!--cat-blog-inner-->
				</li>
				<?php endwhile; endif; ?>
			</ul>
		</div><!--cat-blog-wrapper-->
		<div class="nav-links">
			<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
		</div><!--nav-links-->
	</div><!--archive-area-->
	<?php get_sidebar(); ?>
</div><!--main -->

<?php get_footer(); ?>