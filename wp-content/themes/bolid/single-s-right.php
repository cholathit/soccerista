<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="core">

	<div id="content">

        	<div <?php post_class(); ?>> 

			<?php 
			$video_input = get_post_meta($post->ID, 'vrg_video', true);
			$audio_input = get_post_meta($post->ID, 'vrg_audio', true);
			?>

			<?php 	if(has_post_format('video')){
                            echo ($video_input);
                    }elseif(has_post_format('audio')){
                            echo ($audio_input);
                    }elseif(has_post_format('gallery')){
						if (get_option('vergo_post_gallery_dis') == 'true' );
						else
                            echo get_template_part( '/includes/post-types/gallery-slider' );
                    } else {
						if (get_option('vergo_post_image_dis') == 'true' );
						else
                           the_post_thumbnail('format-standard', array('class' => 'main-single'));  
                                
            }?>


			<div style="clear: both;"></div>
            
            <div class="entry">
            
            <?php echo vrg_ribbon() ?>

 			<h2 class="post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<p class="meta"><?php the_time('M j') ?> &bull; <?php the_category(', ') ?> &bull; <?php echo getPostViews(get_the_ID()); ?> <?php _e('Views','vergo');?> &bull; <?php comments_popup_link(); ?></p>
            
            <?php if(function_exists('the_ratings')) { the_ratings(); } ?> 

            <div style="clear: both;"></div>

                    
                    <div class="hrline"></div>  
                    
					<?php the_content(); ?>
                    
                    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','vergo') . '</span>', 'after' => '</div>' ) ); ?>
                    
                    <?php the_tags( '<p class="tagssingle">','',  '</p>'); ?>

                    <div class="hrline"></div>


					<?php 
                        if (get_option('vergo_post_related_dis') == 'true' );
                        else 
                        get_template_part('/includes/mag-relatedposts');
                    ?>
                                
                    <?php 
                        if (get_option('vergo_post_author_dis') == 'true' );
                        else
                        get_template_part('/includes/mag-authorinfo');
                    ?>

                    <div style="clear: both;"></div>
                        
                    
                    <?php comments_template(); ?>
                    
                    <p>
                        <?php previous_post_link('<span class="fl" style="width:45%;">&laquo; %link</span>'); ?>
                        <?php next_post_link('<span class="fr" style="width:45%; text-align:right">%link &raquo;</span>'); ?>
                        
                    </p>
                    
                    <div style="clear: both;"></div>
        
                    </div>

            </div>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria','vergo');?>.</p>

	<?php endif; ?>

                <div style="clear: both;"></div>

        </div>

    
    
    
        <div id="sidebar">
        
        		<?php get_sidebar(); ?>
        
        </div>
        
    <div id="core_bg"></div>

</div><!-- #core -->