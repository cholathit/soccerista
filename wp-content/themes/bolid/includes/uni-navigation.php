<?php
if ( function_exists('has_nav_menu') && has_nav_menu('main-menu') ) {
	wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_class' => 'nav custom-nav', 'menu_id' => 'main-nav' , 'theme_location' => 'main-menu' ) );
} else {
?>
    <ul id="main-nav" class="nav">
        <?php 
        if ( get_option('vergo_custom_nav_menu') == 'true' ) {
            if ( function_exists('vergo_custom_navigation_output') )
                vergo_custom_navigation_output();

        } else { ?>
            
            <?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
            <?php 
                wp_list_categories('sort_column=menu_order&depth=2&title_li=&exclude='.get_option('vergo_nav_exclude')); 

        }
        ?>
    </ul><!-- /#nav -->
<?php } ?>
	  