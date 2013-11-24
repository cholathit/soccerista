<div id="footer" class="body2">
    
    <?php get_template_part('/includes/uni-bottombox');?>   
    
    <div class="aboutus">
        
        <div style="clear: both;"></div>
    
        <?php if(get_option('vergo_about_img')) { ?>
        
        <a href="<?php echo home_url(); ?>/"><img src="<?php echo get_option('vergo_about_img');?>" alt="<?php bloginfo('name'); ?>"/></a><?php } 
        
        else {} ?>
        <div style="clear: both;"></div>
        
        <?php echo stripslashes(get_option('vergo_aboutus_text'));?>
        
        <div style="clear: both;"></div>
        
        <div class="aboutus_social">

			<?php get_template_part('/includes/uni-social');?>
        
    	</div> 
    
    </div>
    
</div><!-- /#footer  -->

    <div id="copyright">
            
        <div class="fl">
        </div>
    
    
        <div class="fl">
        
            <?php if(get_option('vergo_footer_left') == 'true'){
                
                echo stripslashes(get_option('vergo_footer_left_text'));
                
            } else { ?>
    
                <p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></p>
                
            <?php } ?>
                
        </div>
    
        <div class="fr">
        
            <?php if(get_option('vergo_footer_right') == 'true'){
                
                echo stripslashes(get_option('vergo_footer_right_text'));
                
            } else { ?>
            
                <p><?php _e('Powered by','vergo');?> <a href="http://www.themesddl.com">Wordpress</a>. <?php _e('Designed by','vergo');?> <a href="http://wpbox.net">Vergo&trade;</a></p>
                
            <?php } ?>
            
        </div>
              
    </div> 
    
</div>
        

<div class="scrollTo_top" style="display: block">

    <a title="Scroll to top" href="#">
    
    	<i class="icon-double-angle-up"></i>
        
    </a>
    
</div>

<?php vergo_foot(); ?>
<?php wp_footer();?>

</body>
</html>