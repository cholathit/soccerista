<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); }?>" />


<title>
<?php
	if (function_exists('is_tag') && is_tag()) {
	single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
	elseif (is_archive()) { wp_title(''); echo ' - '; }
	elseif (is_search()) { echo 'Search results for &quot;'.esc_html($s).'&quot; - '; }
	elseif (!(is_404()) && (is_single()) || (is_page())) { wp_title(''); echo ' - '; }
	elseif (is_404()) { echo 'Not Found - '; }
	if (is_home()) { bloginfo('name'); echo ' - '; bloginfo('description'); }
	else { bloginfo('name'); }
	if ($paged>1) { echo ' - page '. $paged; }
?>
</title>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/iecss.css" />
<![endif]-->
<?php if(get_option('gd_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('gd_favicon'); ?>" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<style type="text/css">
<?php $customcss = get_option('gd_customcss'); if ($customcss) { echo stripslashes($customcss); } ?>
</style>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="site">
	<div id="wrapper">
		<div id="nav-main-wrapper">
			<div id="nav-main">
				<div id="nav-main-left">
					<?php if(get_option('gd_logo_loc') == 'Small in navigation') { ?>
					<div id="nav-logo">
						<?php if(get_option('gd_logo')) { ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('gd_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php } else { ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php } ?>
					</div><!--nav-logo-->
					<?php } ?>
					<ul class="nav-main">
						<?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
					</ul>
					<div id="nav-mobi">
 						<?php wp_nav_menu(array( 'theme_location' => 'primary-menu', 'items_wrap' => '<select><option value="#">Menu</option>%3$s</select>', 'walker' => new select_menu_walker() )); ?>
					</div><!--nav-mobi-->
				</div><!--nav-main-left-->
				<div id="nav-search">
					<?php get_search_form(); ?>
				</div><!--nav-search-->
			</div><!--nav-main-->
		</div><!--nav-main-wrapper-->

		<?php if(get_option('gd_wall_ad')) { ?>
		<div id="wallpaper">
			<?php if(get_option('gd_wall_url')) { ?>
			<a href="<?php echo get_option('gd_wall_url'); ?>" class="wallpaper-link"></a>
			<?php } ?>
		</div><!--wallpaper-->
		<?php } ?>

		<div id="main-wrapper">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Scoreboard Widget Area') ) : ?>
			<div id="top-spacer"></div>
			<?php endif; ?>
			<?php if(get_option('gd_leader_ad')) { ?>
			<div id="leader-wrapper">
				<?php if(get_option('gd_mobile_ad')) { ?>
				<div id="ad-320">
					<?php echo get_option('gd_mobile_ad'); ?>
				</div><!--ad-320-->
				<?php } ?>

				<?php if(get_option('gd_logo_loc') == 'Small in navigation') { ?>
				<div id="ad-728-small">
					<?php echo get_option('gd_leader_ad'); ?>
				</div><!--ad-728-small-->
				<?php } ?>

				<?php if(get_option('gd_logo_loc') == 'Large below navigation') { ?>
				<div id="ad-728">
					<?php echo get_option('gd_leader_ad'); ?>
				</div><!--ad-728-->
				<div id="logo-large">
					<?php if(get_option('gd_logo_large')) { ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('gd_logo_large'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-large.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--logo-large-->
				<?php } ?>
			</div><!--leader-wrapper-->
			<?php } else { ?>
			<?php if(get_option('gd_logo_loc') == 'Large below navigation') { ?>
			<div id="logo-wide">
				<?php if(get_option('gd_logo_large')) { ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('gd_logo_large'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } else { ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-large.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } ?>
			</div><!--logo-wide-->
			<?php } ?>
			<?php } ?>
			<div id="content-outer">
					<div id="main-top">
					<div id="ticker">
						<span class="ticker-heading"><?php _e( "Don't Miss", 'mvp-text' ); ?></span>
						<ul class="ticker-list">
							<?php $recent = new WP_Query(array( 'tag' => get_option('gd_ticker_tags'), 'showposts' => get_option('gd_ticker_num') )); while($recent->have_posts()) : $recent->the_post();?>
							<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
							<?php endwhile; ?>
						</ul>
						
					</div><!--ticker-->
					<div id="content-social">
						<ul>
							<?php if(get_option('gd_facebook')) { ?>
							<li><a href="http://www.facebook.com/<?php echo get_option('gd_facebook'); ?>" alt="Facebook" class="fb-but" target="_blank"></a></li><?php } ?>
							<?php if(get_option('gd_twitter')) { ?><li><a href="http://www.twitter.com/<?php echo get_option('gd_twitter'); ?>" alt="Twitter" class="twitter-but" target="_blank"></a></li><?php } ?>
							<?php if(get_option('gd_pinterest')) { ?><li><a href="http://www.pinterest.com/<?php echo get_option('gd_pinterest'); ?>" alt="Pinterest" class="pinterest-but" target="_blank"></a></li><?php } ?>
							<?php if(get_option('gd_instagram')) { ?><li><a href="http://www.instagram.com/<?php echo get_option('gd_instagram'); ?>" alt="Instagram" class="instagram-but" target="_blank"></a></li><?php } ?>
							<?php if(get_option('gd_google')) { ?><li><a href="<?php echo get_option('gd_google'); ?>" alt="Google Plus" class="google-but" target="_blank"></a></li><?php } ?>
							<?php if(get_option('gd_youtube')) { ?><li><a href="http://www.youtube.com/user/<?php echo get_option('gd_youtube'); ?>" alt="YouTube" class="youtube-but" target="_blank"></a></li><?php } ?>
							<?php if(get_option('gd_linkedin')) { ?><li><a href="http://www.linkedin.com/company/<?php echo get_option('gd_linkedin'); ?>" alt="Linkedin" class="linkedin-but" target="_blank"></a></li><?php } ?>
							<li><a href="<?php bloginfo('rss_url'); ?>" alt="RSS Feed" class="rss-but"></a></li>
						</ul>
					</div><!--content-social-->
					</div><!--main-top-->
				<div id="content-inner">