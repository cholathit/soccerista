<?php

/*-----------------------------------------------------------------------------------*/
/* Hook Definitions */
/*-----------------------------------------------------------------------------------*/

// header.php
function vergo_head() { do_action( 'vergo_head' ); }					
function vergo_top() { do_action( 'vergo_top' ); }					
function vergo_header_before() { do_action( 'vergo_header_before' ); }			
function vergo_header_inside() { do_action( 'vergo_header_inside' ); }				
function vergo_header_after() { do_action( 'vergo_header_after' ); }			
function vergo_nav_before() { do_action( 'vergo_nav_before' ); }					
function vergo_nav_inside() { do_action( 'vergo_nav_inside' ); }					
function vergo_nav_after() { do_action( 'vergo_nav_after' ); }		

// Template files: 404, archive, single, page, sidebar, index, search
function vergo_content_before() { do_action( 'vergo_content_before' ); }					
function vergo_content_after() { do_action( 'vergo_content_after' ); }					
function vergo_main_before() { do_action( 'vergo_main_before' ); }					
function vergo_main_after() { do_action( 'vergo_main_after' ); }					
function vergo_post_before() { do_action( 'vergo_post_before' ); }					
function vergo_post_after() { do_action( 'vergo_post_after' ); }					
function vergo_post_inside_before() { do_action( 'vergo_post_inside_before' ); }					
function vergo_post_inside_after() { do_action( 'vergo_post_inside_after' ); }	
function vergo_loop_before() { do_action( 'vergo_loop_before' ); }	
function vergo_loop_after() { do_action( 'vergo_loop_after' ); }	

// Sidebar
function vergo_sidebar_before() { do_action( 'vergo_sidebar_before' ); }					
function vergo_sidebar_inside_before() { do_action( 'vergo_sidebar_inside_before' ); }					
function vergo_sidebar_inside_after() { do_action( 'vergo_sidebar_inside_after' ); }					
function vergo_sidebar_after() { do_action( 'vergo_sidebar_after' ); }					

// footer.php
function vergo_footer_top() { do_action( 'vergo_footer_top' ); }					
function vergo_footer_before() { do_action( 'vergo_footer_before' ); }					
function vergo_footer_inside() { do_action( 'vergo_footer_inside' ); }					
function vergo_footer_after() { do_action( 'vergo_footer_after' ); }	
function vergo_foot() { do_action( 'vergo_foot' ); }					

?>