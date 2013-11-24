<?php get_header(); ?>

<div id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="breadcrumb">
		<?php echo dimox_breadcrumbs(); ?>
	</div><!--breadcrumb-->
	<h1 class="headline"><?php the_title(); ?></h1>
	<div id="post-info-wrapper">
		<ul class="post-info">
			<li>
			<ul class="post-social">
				<li>
					<a href="http://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="horizontal">Tweet</a>
				</li>
				<li>
					<?php $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
				</li>
				<li>
				<g:plusone size="medium" annotation="inline" width="120"></g:plusone>
				</li>
				<li>
					<div class="fb-like" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
				</li>
			</ul>
			</li>
		</ul>
	</div><!--post-info-wrapper-->
	<div id="post-area" <?php post_class(); ?>>
		<?php $gd_featured_img = get_option('gd_featured_img'); if ($gd_featured_img == "true") { ?>
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
			<div class="post-image">
				<?php the_post_thumbnail('post-thumb'); ?>
			</div><!--post-image-->
			<?php } ?>
		<?php } ?>
		<div id="content-area">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
			<div class="post-tags">
				<?php the_tags('','','') ?>
			</div><!--post-tags-->
		</div><!--content-area-->
		<?php endwhile; endif; ?>	
	</div><!--post-area-->
	<?php get_sidebar(); ?>

</div><!--main -->


<?php get_footer(); ?>