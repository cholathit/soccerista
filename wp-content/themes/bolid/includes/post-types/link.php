<li <?php post_class(); ?>>

	<div class="entry">
            
		<h2 class="heading"><a href="<?php echo get_post_meta($post->ID, 'vrg_linkss', true); ?>"><?php the_title(); ?></a></h2>

        <div class="hrline"></div>

        <p class="meta">
        
        	<?php the_time('M j, y') ?> | 
           	<?php the_category(', ') ?>
              
        </p> 

    	<p class="teaser"><?php echo vergo_excerpt( get_the_excerpt(), '280'); ?></p>

	</div>

</li>