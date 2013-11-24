				</div><!--content-inner-->
			</div><!--content-outer-->
		</div><!--main-wrapper-->
	</div><!--wrapper-->
	<div id="footer-wrapper">
		<div id="footer">
			<div id="footer-nav">
				<?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>
			</div><!--footer-nav-->
			<div id="copyright">
				<p><?php echo get_option('gd_copyright'); ?></p>
			</div><!--copyright-->
		</div><!--footer-->
	</div><!--footer-wrapper-->
</div><!--site-->

<script type='text/javascript'>
//<![CDATA[
jQuery(document).ready(function($){
  $(window).load(function(){
    $('.flexslider').flexslider({
	animation: 'fade',
	slideshowSpeed: 8000
    	});
  	});

$('.carousel').elastislide({
	imageW 	: 80,
	minItems	: 2,
	margin		: 3
});
});
//]]>
</script>

<?php if ( is_single() || is_page() ) { ?>
<script type="text/javascript">
//<![CDATA[
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.async=true;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = "http://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
//]]>
</script>

<div id="fb-root"></div>
<script type="text/javascript">
//<![CDATA[
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.async = true;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
//]]>
</script>
<?php } ?>

<?php $analytics = get_option('gd_tracking'); if ($analytics) { echo stripslashes($analytics); } ?>

<?php wp_footer(); ?>

</body>
</html>