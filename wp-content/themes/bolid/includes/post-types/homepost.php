<li <?php post_class('centerthreecol'); ?>>

	<?php echo vergo_ribbon() ?>

		  <?php if ( has_post_thumbnail()) {?>
          
               	<a class="imgwrap" href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
               
                  <?php the_post_thumbnail( 'homeblog',array('title' => "")); ?>
               
               	</a>
               
          <?php } else {?>
          
               	<a class="imgwrap nobg" href="<?php the_permalink(); ?>" title="<?php the_title();?>" >

					<img src="<?php echo get_template_directory_uri(); ?>/images/icons/more-blog-alt.png"/>
            
            	</a>
            
          <?php } ?>  
                  
          <div class="inside">
          
              <h3><?php echo short_title('...', 11); ?></h3>
                  
              <p class="meta">
              
			  	<?php the_time('M j, y') ?> &bull; 
              	<?php the_category(', ') ?>
                
              </p>
              
              
          </div>                
                        
</li>