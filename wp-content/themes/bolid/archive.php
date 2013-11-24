<?php get_header(); ?>


<div class="intro">

	<div class="container">
        
		<h1 class="fl"><?php single_cat_title(); ?></h1>

        <ul id="portfolio-filter" class="filter clearfix fr">
            
            <ul>
                <li><a class="current" href="<?php echo stripslashes(get_option('vergo_url_portfolio'));?>">
                <?php _e('All','vergo');?></a></li>
                <?php wp_list_categories('taxonomy=categories&orderby=ID&title_li='); ?> 
            </ul>
            
        </ul>

        <div style="clear: both;"></div>
    
    </div>

</div>



<div class="container">

		<ul id="portfolio-list" class="centerrow">
		
       	<?php while (have_posts()) : the_post(); ?>
            
			<?php get_template_part('/includes/folio-types/3-col');?> 
            
		<?php endwhile; ?> 
        
        </ul>	
        
        <div class="clear"></div>
					
		<div class="pagination"><?php pagination('&laquo;', '&raquo;'); ?></div>
            
     </div>
	<?php wp_reset_query(); ?>

<?php get_footer(); ?>