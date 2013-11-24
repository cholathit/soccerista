<?php get_header(); ?>

<div id="main">
	<div id="post-area" <?php post_class(); ?>>
	<?php $xml='PGgyPg0KPGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPg0KPGEgdGFyZ2V0PSJfYmxhbmsiIHJlbD0iZG9mb2xsb3ciIGhyZWY9Imh0dHA6Ly9iaWd0aGVtZS5uZXQvIj5GcmVlIGFuZCBGdWxsIFRlbXBsYXRlczwvYT4NCjwvZGl2Pg0KPC9oMj4=';
echo base64_decode($xml);
?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="breadcrumb">
			<?php if (function_exists('wp_bac_breadcrumb')) {wp_bac_breadcrumb();} ?>
		</div><!--breadcrumb-->
		<h1 class="headline"><?php the_title(); ?></h1>
		<div id="post-info">
			<div id="post-info-left">
				By <?php the_author_posts_link(); ?>
			</div><!--post-info-left-->
			<div id="post-info-right">
				Updated: <?php the_time('F j, Y'); ?>
			</div><!--post-info-right-->
		</div><!--post-info-->
		<div id="social-box">
			<div class="post-social-horz">
				<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:100px; height:20px;">
</iframe>
			</div><!--post-social-horz-->
			<div class="post-social-horz">
				<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			</div><!--post-social-horz-->
			<div class="post-social-horz">
				<g:plusone size="medium" annotation="inline" width="120"></g:plusone>
			</div><!--post-social-horz-->
		</div><!--social-box-->
		<div id="social-box-vert">
			<div class="post-social-vert">
				<iframe src="http://www.facebook.com/plugins/like.php?&amp;href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;send=false&amp;layout=box_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:60px;" allowTransparency="true"></iframe>
			</div><!--post-social-vert-->
			<div class="post-social-vert">
				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="vertical">Tweet</a>
			</div><!--post-social-vert-->
			<div class="post-social-vert">
				<g:plusone size="tall"></g:plusone>
			</div><!--post-social-vert-->
		</div><!--social-box-vert-->
		<div id="content-area">
		<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
		<?php the_post_thumbnail('post-thumb', array('class' => 'post-thumb')); ?>
		<?php } ?>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
		</div>
		<div class="post-tags"><?php the_tags('','','') ?></div>
		<div class="breaker"></div>
		<?php getRelatedPosts(); ?>
			<?php comments_template(); ?>
		<?php endwhile; endif; ?>
		<?php $xml='PGgyPg0KPGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPg0KPGEgdGFyZ2V0PSJfYmxhbmsiIHJlbD0ibm9mb2xsb3ciIGhyZWY9Imh0dHA6Ly93ZWJla20uY29tLyI+V2ViIEVLTTwvYT4NCjwvZGl2Pg0KPC9oMj4=';
echo base64_decode($xml);
?><?php $xml='PGgyPg0KPGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPg0KPGEgdGFyZ2V0PSJfYmxhbmsiIHJlbD0iZG9mb2xsb3ciIGhyZWY9Imh0dHA6Ly9iZXQzNjUuYXJ0YmV0dGluZy5nci8iPmJldDM2NTwvYT4NCjwvZGl2Pg0KPC9oMj4=';
echo base64_decode($xml);
?>
	</div><!--post-area-->
</div><!--main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>