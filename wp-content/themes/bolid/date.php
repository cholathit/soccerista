<?php get_header(); ?>

<div id="core">

	<div id="content">
            
            	<?php if (have_posts()) : ?>
    
		<?php $post = $posts[0]; ?>
        
			<?php if (is_category()) { ?>
            
            <h1><?php _e('Archive for the','vergo');?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category','vergo');?></h1>
            
            <?php } elseif( is_tag() ) { ?>
            
            <h1><?php _e('Posts Tagged','vergo');?> &#8216;<?php single_tag_title(); ?>&#8217;</h1>
            
            <?php } elseif (is_day()) { ?>
            
            <h1><?php _e('Archive for','vergo');?> <?php the_time('F jS, Y'); ?></h1>
            
            <?php } elseif (is_month()) { ?>
            
            <h1><?php _e('Archive for','vergo');?> <?php the_time('F, Y'); ?></h1>
            
            <?php } elseif (is_year()) { ?>
            
            <h1><?php _e('Archive for','vergo');?> <?php the_time('Y'); ?></h1>
            
            <?php } elseif (is_author()) { ?>
            
            <h1><?php _e('Author Archive','vergo');?></h1>
            
            <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            
            <h1><?php _e('Blog Archives','vergo');?></h1>
            
            <?php } ?>
    
            <div style="clear: both;"></div> 

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

        </div>
    
        <div id="sidebar">
        
        		<?php get_sidebar(); ?>
        
        </div>
        
    <div id="core_bg"></div>

</div><!-- #core -->
    
<?php get_footer(); ?>