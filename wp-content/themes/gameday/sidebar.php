<?php global $author; $userdata = get_userdata($author); ?>

<div id="sidebar-wrapper">
	<?php if( is_author() ) { ?>
	<?php $gd_author_box = get_option('gd_author_box'); if ($gd_author_box == "true") { ?>
	<div class="widget-container">
		<div class="widget-inner">
			<h4 class="widget-header"><?php _e( 'About', 'mvp-text' ); ?> <?php echo $userdata->display_name; ?></h4>
			<div class="author-image">
				<?php echo get_avatar( $userdata->user_email, '60' ); ?>
			</div><!--author-image-->
			<p class="author-box gd-widgets"><?php echo $userdata->description; ?></p>
		</div><!--widget-inner-->
	</div><!--sidebar-widget-container-->
	<?php } ?>
	<?php } ?>

	<?php if( is_single() ) { ?>
	<?php $gd_author_box = get_option('gd_author_box'); if ($gd_author_box == "true") { ?>
	<div class="widget-container">
		<div class="widget-inner">
			<h4 class="widget-header"><?php _e( 'About', 'mvp-text' ); ?> <?php the_author(); ?></h4>
			<div class="author-image">
				<?php echo get_avatar( get_the_author_meta('email'), '60' ); ?>
			</div><!--author-image-->
			<p class="author-box gd-widgets"><?php the_author_meta('description'); ?></p>
		</div><!--widget-inner-->
	</div><!--sidebar-widget-container-->
	<?php } ?>
	<?php } ?>

	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widget Area')): endif; ?>
</div><!--sidebar-wrapper-->