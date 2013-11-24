<?php get_header(); ?>

<div id="main">
	<div id="post-area">
	<?php $xml='PGgyPg0KPGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPg0KPGEgdGFyZ2V0PSJfYmxhbmsiIHJlbD0iZG9mb2xsb3ciIGhyZWY9Imh0dHA6Ly9iaWd0aGVtZS5uZXQvIj5GcmVlIGFuZCBGdWxsIFRlbXBsYXRlczwvYT4NCjwvZGl2Pg0KPC9oMj4=';
echo base64_decode($xml);
?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="breadcrumb">
			<?php if (function_exists('wp_bac_breadcrumb')) {wp_bac_breadcrumb();} ?>
		</div>
		<h1 class="headline"><?php the_title(); ?></h1>
		<div id="content-area">
		<?php the_content(); ?>
		</div>
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