<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title><?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' ); echo " | $site_description"; if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s','vergo'), max( $paged, $page ) ); ?></title>

<!-- Set the viewport width to device width for mobile -->

<?php if (get_option('vergo_res_mode_general') <> "true") { ?>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<?php } ?>


<?php vergo_head(); ?>
<?php wp_head(); ?>
</head><a style="display:none" href="http://searchsongs.net">Free songs</a>

     
<body <?php body_class(); ?>>

<div class="container <?php if (get_option('vergo_res_mode_general') == 'false' ); else echo 'generalresp'; ?> <?php if (get_option('vergo_cont_shadow') == 'false' ); else echo 'container_shadow'; ?> <?php if (get_option('vergo_upper') == 'false' ); else echo 'upper'; ?>"> 


<div id="top-nav" class="body2"> 

	<?php if (get_option('vergo_ticker_dis') <> "true") { 
	
		get_template_part('/includes/mag-ticker');
	
	} ?>

</div> 

	<header id="header">
          
        <nav id="sec-navigation">
        
       		<a id="triggernav-sec" href="#"><?php _e('MENU','vergo');?></a>
        
            <?php 
			
				get_template_part('/includes/sec-navigation');
				
				get_template_part('/includes/uni-searchformhead');
			
			?>
            
        </nav>
        <div style="clear: both;"></div>
        
        <?php if(get_option('vergo_logo')) { ?>
                
            <a class="homelink" href="<?php echo home_url(); ?>/">
            
                <img id="logo" src="<?php echo get_option('vergo_logo');?>" alt="<?php bloginfo('name'); ?>"/>
                    
            </a>
                
        <?php } 
                
            else { ?> <h1><a class="homelink" href="<?php echo home_url(); ?>/"><?php bloginfo('name');?></a></h1> 
                
        <?php } ?>
          
          
          	<?php if(get_option('vergo_headeradscript')) { 
     
				echo '<div class="headad">';
			 
				echo get_option('vergo_headeradscript');
			
				echo '</div>';
			
			} elseif(get_option('vergo_headeradimg1')) { ?> 
			
				<div class="headad <?php if (get_option('vergo_ad_res_mode') == 'false' ); else echo 'resmode-No'; ?>">
				
					<a href="<?php echo get_option('vergo_headeradurl1');?>"><img src="<?php echo get_option('vergo_headeradimg1');?>" alt="" /></a>
					
				</div>
				
			<?php } else {} ?>
          
          
          	
              
          	<a id="triggernav" href="#"><?php _e('MENU','vergo');?></a>
          
            <nav id="navigation">
            
                <?php get_template_part('/includes/uni-navigation');?>
                
            </nav>
            
    </header>    
    
	<div style="clear: both;"></div>