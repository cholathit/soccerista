<?php get_header(); ?>

<?php global $author; $userdata = get_userdata($author); ?>

<div id="main">
	<div class="breadcrumb">
		<?php echo dimox_breadcrumbs(); ?>
	</div><!--breadcrumb-->
	

		<?php if( is_tag() ) { ?><h1 class="headline archive-header"><?php _e( 'All posts tagged', 'mvp-text' ); ?> "<?php single_tag_title(); ?>"</h1>
		<?php } elseif( is_author() ) { ?><h1 class="headline archive-header"><?php _e( 'All posts by', 'mvp-text' ); ?> <?php echo $userdata->display_name; ?></h1>
		<?php } ?>

	
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