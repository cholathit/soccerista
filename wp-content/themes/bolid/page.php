<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   
<div id="core">

	<div id="content">

        	<div <?php post_class(); ?>>

			<h2 class="post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <div class="entry">
            
            	<?php the_content(); ?>
            
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','vergo') . '</span>', 'after' => '</div>' ) ); ?>
                
                <?php the_tags( '<p class="tagssingle">','',  '</p>'); ?>
 
                
                <div class="hrline"></div>   
                  
               	<?php comments_template(); ?>
                
        	</div> 

    </div>



	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria','vergo');?>.</p>

	<?php endif; ?>

                <div style="clear: both;"></div>

        </div><!-- end #core .eightcol-->

    
    
    
        <div id="sidebar">
        
        		<?php get_sidebar(); ?>
        
        </div>

    
    <div id="core_bg"></div>

</div><!-- #core -->

<?php get_footer(); ?>