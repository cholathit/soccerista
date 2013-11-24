<?php get_header(); ?>

<div id="main" class="full">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1 class="headline"><?php the_title(); ?></h1>
	<div id="post-info-wrapper">
		<ul class="post-info">
			<li>
			<ul class="post-social">
				<li>
					<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:100px; height:20px;">
</iframe>
				</li>
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
			</ul>
			</li>
		</ul>
	</div><!--post-info-wrapper-->
	<div id="post-area" class="full">
		<div id="content-area" class="full">
  			<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "large"); ?>
			<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" class="attachment-medium" alt="<?php the_title(); ?>" /></a>
			<?php else : ?>
			<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
			<?php endif; ?>
		</div><!--content-area-->
		<?php endwhile; endif; ?>	
	</div><!--post-area-->

</div><!--main -->


<?php get_footer(); ?>