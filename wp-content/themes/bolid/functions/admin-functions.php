<?php

/*-----------------------------------------------------------------------------------*/
/* Output HEAD - vergo_wp_head */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'vergo_wp_head' ) ) {
	function vergo_wp_head() {

		do_action( 'vergo_wp_head_before' );

		// Favicon
		if(get_option('vergo_custom_favicon') != '') {
	        echo '<link rel="shortcut icon" href="'.  get_option('vergo_custom_favicon')  .'"/>'."\n";
	    }   

		// Output shortcodes stylesheet
		if ( function_exists( 'tmnf_shortcode_stylesheet' ) )
			tmnf_shortcode_stylesheet();
			

			
		do_action( 'vergo_wp_head_after' );
		
		

	} // End vergo_wp_head()
}



add_action( 'wp_head', 'vergo_wp_head', 10 );


/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/
function fiftytwo_style_path() {
    $style = $_REQUEST[style];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = get_option('vergo_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/
function vergo_analytics(){
	$output = get_option('vergo_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','vergo_analytics');

/*-----------------------------------------------------------------------------------*/
/* THE END */
/*-----------------------------------------------------------------------------------*/
?>