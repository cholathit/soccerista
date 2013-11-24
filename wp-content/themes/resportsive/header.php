<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<title>
<?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
</title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" /><![endif]-->
<?php if(get_option('resport_custom_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('resport_custom_favicon'); ?>" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="site">
	<div id="header-top-wrapper">
		<div id="header-top">
			<div id="header-top-left">
				<?php wp_nav_menu(array('theme_location' => 'secondary-menu')); ?>
			</div><!--header-top-left-->
			<div id="header-top-right">
				<?php get_search_form(); ?>
			</div><!--header-top-right-->
		</div><!--header-top-->
	</div><!--header-top-wrapper-->
	<div id="header-wrapper">
		<div id="header">
			<div id="header-contain">
				<div id="header-bottom">
					<div id="logo">
						<?php if(get_option('resport_logo')) { ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('resport_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php } else { ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php } ?>
					</div><!--logo-->
					<?php if(get_option('resport_ticker_tags')) { ?>
					<div id="news-ticker">
						<ul id="ticker">
							<?php $recent = new WP_Query(array( 'tag' => get_option('resport_ticker_tags'), 'showposts' => get_option('resport_ticker_items')  )); while($recent->have_posts()) : $recent->the_post();?>
							<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
							<?php endwhile; ?>
						</ul>
					</div><!--news-ticker-->
					<?php } ?>
				</div><!--header-bottom-->
				<div id="nav-main">
					<?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
				</div><!--nav-main-->
				<div id="nav-mobi">
					<div class="flip">Menu</div>
					<div class="panel"><?php wp_nav_menu(array('menu' => 'primary-menu')); ?></div>
				</div><!--nav-mobi-->
			</div><!--header-contain-->
		</div><!--header-->
	</div><!--header-wrapper-->
	<div id="wrapper">
		<div id="wrapper-inner">
			<?php if(get_option('resport_leaderboard')) { ?>
				<div id="leaderboard">
					<?php echo get_option('resport_leaderboard'); ?>
				</div><!--leaderboard-->
				<?php } ?>
				<div id="content">