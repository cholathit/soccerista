<div class="tab-post">

	<?php if ( has_post_thumbnail()) : ?>
    
         <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
         <?php the_post_thumbnail( 'tabs',array('title' => "")); ?>
         </a>
         
    <?php endif; ?>

        <p><a class="title" href="<?php the_permalink(); ?>"><?php echo short_title('...', 13);?></a></p>
        
        <p class="meta"><?php the_time('M j') ?> &bull; <?php echo getPostViews(get_the_ID()); ?> <?php _e('Views','vergo');?></p>
        
</div>