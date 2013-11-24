<li <?php post_class(); ?>>

	<?php echo vrg_ribbon() ?>

	<?php if ( has_post_thumbnail()) : ?>
         <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
         <?php the_post_thumbnail( 'archives',array('title' => "")); ?>
         </a>
    <?php endif; ?>

   	<h3> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    
    <p class="meta">
        
        <?php the_time('M j, y') ?> &bull; 
		<?php echo getPostViews(get_the_ID()); ?> <?php _e('Views','vergo');?> &bull; 
		<?php the_category(', ') ?> &bull; 
        <?php the_author_posts_link(); ?> &bull; 
        <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
              
    </p> 
    
    <p class="teaser">
    
		<?php echo vergo_excerpt( get_the_excerpt(), '260'); ?>
        
    </p>     
    
    <?php if(function_exists('the_ratings')) { echo expand_ratings_template('<span class="rating">%RATINGS_IMAGES%</span>', get_the_ID()); } ?>
    
</li>