</div><!--content-->

<div id="footer">
	<div id="footer-about">
		<h3><?php echo get_option('resport_abt_head'); ?></h3>
		<p><?php echo get_option('resport_abt_text'); ?></p>
	</div><!--footer-about-->
	<div class="footer-twitter">
		<h3>Twitter Feed</h3>
		<ul id="twitter_update_list">
			<li>Twitter feed loading...</li>
		</ul>
	</div>
	<div class="footer-links">
		<h3>Categories</h3>
		<?php wp_nav_menu(array('theme_location' => 'footer-category-menu')); ?>
	</div>
	<div class="footer-links">
		<h3>Pages</h3>
		<?php wp_nav_menu(array('theme_location' => 'footer-page-menu')); ?>
	</div>

</div><!--footer-->
<div id="footer-bottom">
	<div id="footer-info">
		<?php echo get_option('resport_footer_text'); ?>
	</div><!--footer-info-->
</div><!--footer-bottom-->

</div><!--wrapper-inner-->
</div><!--wrapper-->
</div><!--site-->

<?php wp_footer(); ?>



<?php $google_analytics = get_option('resport_google_analytics'); if ($google_analytics) { echo stripslashes($google_analytics); } ?>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script type="text/javascript">
	$(window).load(function() {
	$('.flexslider').flexslider({
	animation: "slide",
	slideshowSpeed: 10000,
	controlsContainer: ".flexslider-container"
	});
	});
</script>

<script type="text/javascript">
$('#carousel').elastislide({
	imageW 	: 145,
	minItems	: 2,
	margin		: 10
});
var main_menu=new main_menu.dd("main_menu");
main_menu.init("main_menu","menuhover");
</script>

<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo get_option('resport_twitter'); ?>.json?callback=twitterCallback2&count=2"></script>

</body>
</html>