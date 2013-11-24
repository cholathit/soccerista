<?php get_header(); ?>

<div id="core">

	<div id="content">
            
				<?php
                $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                ?>
                
                <?php if (have_posts()) : ?>
            
                <h1><?php _e('Author archives: ','vergo');?> <?php echo $curauth->nickname; ?></h1>
    
            <div style="clear: both;"></div>

			<div class="postauthor">
                            
                <h3 class="additional"><?php _e('About Author: ','vergo');?></h3>
                  
                <?php echo get_avatar($curauth->user_email, 90 ); ?>

                <p class="authordesc">
                    <?php _e('Website','vergo');?>: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br/>
                    <?php echo $curauth->user_description; ?>
                </p>
                
            </div>
            
            <div style="clear: both;"></div>

			<div class="hrline"></div>

      		<ul class="archivepost">
          
    			<?php while (have_posts()) : the_post(); ?>
                                              		
            		<?php get_template_part('/includes/post-types/archivepost');?>
                    
   				<?php endwhile; ?>   <!-- end post -->
                    
     		</ul><!-- end latest posts section-->
            
            <div style="clear: both;"></div>
            

					<div class="pagination"><?php pagination('&laquo;', '&raquo;'); ?></div>

					<?php else : ?>
			

                        <h1>Sorry, no posts matched your criteria.</h1>
                        <?php get_search_form(); ?><br/>
					<?php endif; ?>

        </div><!-- end #core .eightcol-->
    
    
        <div id="sidebar">
        
        		<?php get_sidebar(); ?>
        
        </div>
        
    <div id="core_bg"></div>

</div><!-- #core -->

<?php get_footer(); ?>