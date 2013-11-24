<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>

<div id="core">

    <div id="content">
    
            <?php if (get_option('vergo_slider_dis') <> "true") { ?>
    
                <?php $type_slider_mag = get_option('vergo_type_slider_mag'); ?>
                <?php if($type_slider_mag == 'coin'){
                    get_template_part('/includes/sliders/coin' );
                    }elseif($type_slider_mag == 'flexslider'){
                    get_template_part('/includes/sliders/flexslider' );
                    } else {
                }?>
    
            <?php }?>
    
           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Homepage Content") ) : ?>
           <h4>To set magazine homepage go to Dashboard > Apperance > Widgets<br/>and use custom widgets with "Vergo - Home" prefix</h4>
           <?php endif; ?>
           
    </div><!-- #homecontent -->
    
    
    
    <div id="sidebar">
           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Homepage Sidebar") ) : ?>
           <?php endif; ?>
    </div><!-- #sidebar -->
            
    
    <div id="core_bg"></div>

</div><!-- #core -->
        
<?php get_footer(); ?>