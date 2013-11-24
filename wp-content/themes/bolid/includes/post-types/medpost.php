<li <?php post_class('blogposts'); ?>>

	<?php
    $video_input = get_post_meta($post->ID, 'vrg_video', true);
	$audio_input = get_post_meta($post->ID, 'vrg_audio', true);
	?>

	<?php 	if(has_post_format('video')){
                    echo ($video_input);
            }elseif(has_post_format('audio')){
                    echo ($audio_input);
            }elseif(has_post_format('gallery')){
                    echo get_template_part( '/includes/post-types/gallery-slider' );
            } else {
                    if ( has_post_thumbnail()); ?>
                        <a href="<?php the_permalink(); ?>">  
  
                             <?php the_post_thumbnail('format-standard', array('class' => 'headimg')); ?>
      
                        </a>  
                        
    <?php }?>
    
    <div style="clear: both;"></div>

	<div class="entry">
    
    	<?php echo vrg_ribbon() ?>

        <h2 class="post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <p class="meta"><?php the_time('M j') ?> &bull; <?php the_category(', ') ?> &bull; <?php echo getPostViews(get_the_ID()); ?> <?php _e('Views','vergo');?></p>
        
        <?php if(function_exists('the_ratings')) { the_ratings(); } ?> 

        <div style="clear: both;"></div>

        
		<?php global $more; $more = 0; ?>
        
        <?php the_content('Continue Reading'); ?>
        
        <p class="meta">
        
              <?php the_author_posts_link(); ?> &bull; <?php comments_popup_link(); ?>
              
        </p> 
        
        <a class="mainbutton fr" href="<?php the_permalink(); ?>"><?php _e('Read More','vergo');?> <i class="icon-circle-arrow-right"></i></a>

	</div>
        
</li>