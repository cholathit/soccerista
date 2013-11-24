<li <?php post_class('blogposts'); ?>>

	<?php
            $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
            $large_image = $large_image[0]; 
            $video_input = get_post_meta($post->ID, 'vergo_video_url', true);
    ?>

    <?php if($video_input) {?>
    
    <?php echo ($video_input); } else {?>

            <a class="imgwrap" rel="prettyPhoto[gallery]"  href="<?php if($video_input) echo $video_input; else echo $large_image; ?>">  
            
           		<?php the_post_thumbnail('format-image', array('class' => 'headimg')); ?>
                     
            </a>
        
    <?php }?>

    <div style="clear: both;"></div>
        
	<div class="entry">
    <?php echo vrg_ribbon() ?>
       
		<h2 class="post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
         
       	<div class="hrline"></div>  
        
        <p class="meta">
        
        	<?php the_time('M j, y') ?> &bull; 
           	<?php the_category(', ') ?>
              
        </p> 

	</div>
        
</li>