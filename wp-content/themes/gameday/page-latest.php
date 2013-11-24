<?php

	/* Template Name: Latest News */

?>


<?php get_header(); ?>
<?php if(get_query_var('author_name')) { $curauth = get_user_by( 'login', get_query_var('author_name') ); } else { $curauth = get_userdata(get_query_var('author')); } ?>

<div id="main">
	<h1 class="headline archive-header">Latest News</h1>
	<div id="archive-area">
		<div id="cat-blog-wrapper">
			<ul>
				<?php
									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
									$args= array(
										'posts_per_page' => 14,
										'paged' => $paged
									);
									query_posts($args);
				?>
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