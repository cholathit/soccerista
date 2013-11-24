<?php
/*
Template Name: 404
*/
?>
<?php get_header(); ?>

<div id="core">

	<div id="content">
    
                <h2 class="post"><?php _e('Nothing found here!','vergo');?></h2>
                
                <h4><?php _e('Perhaps You will find something interesting form these lists...','vergo');?></h4>
                
                <div class="hrline"></div>
                
                <?php get_template_part('/includes/uni-404-content');?>
    
        </div>
    
        <div id="sidebar">
        
        		<?php get_sidebar(); ?>
        
        </div>
        
    <div id="core_bg"></div>

</div><!-- #core -->

<?php get_footer(); ?>