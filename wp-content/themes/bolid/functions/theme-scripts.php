<?php
if ( ! is_admin() ) { add_action( 'wp_print_scripts', 'vergo_add_javascript' ); }

function vergo_add_javascript() {

		// Load Common scripts	
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js','','', true);
		wp_enqueue_script('jquery.hoverIntent.minified', get_template_directory_uri().'/js/jquery.hoverIntent.minified.js','','', true);
		wp_enqueue_script('css3-mediaqueries', get_template_directory_uri().'/js/css3-mediaqueries.js','','', true);
		wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js','','', true);
		wp_enqueue_script('jquery.li-scroller.1.0', get_template_directory_uri() .'/js/jquery.li-scroller.1.0.js','','', true);
		wp_enqueue_script('ownScript', get_template_directory_uri() .'/js/ownScript.js','','', true);


		// Load Mobile script		
		if (get_option('vergo_res_mode_general') <> "true") {	
			wp_enqueue_script('mobile', get_template_directory_uri() .'/js/mobile.js','','', true);
		}


		// Load flex script
		if ( is_home() || is_front_page()|| is_page_template('template-blog.php')) { 
					wp_enqueue_script('jquery.flexslider-min', get_template_directory_uri() .'/js/jquery.flexslider-min.js','','', true);
					wp_enqueue_script('jquery.flexslider.start.main', get_template_directory_uri() .'/js/jquery.flexslider.start.main.js','','', true);
		} 


		// Singular comment script		
		if ( is_singular() ) wp_enqueue_script( 'comment-reply','','', true );

	}
?>