<?php 

// Register Styles
function register_styles(){
	
	wp_register_style('style', get_template_directory_uri() .	'/style.css');
		wp_enqueue_style( 'style');
	wp_register_style('prettyPhoto', get_template_directory_uri() .	'/styles/prettyPhoto.css');
		wp_enqueue_style( 'prettyPhoto');
}
add_action('vergo_head', 'register_styles');

/*-----------------------------------------------------------------------------------*/
/* Custom functions */
/*-----------------------------------------------------------------------------------*/


	global $vergo_options;
	$output = '';

// Add custom styling
add_action('wp_head','vergo_custom_styling');
function vergo_custom_styling() {
	
	// Get options
	$home = home_url();
	$home_theme  = get_template_directory_uri();
	
	$sec_body_color = get_option('vergo_custom_color');
	$thi_body_color = get_option('vergo_thi_body_color');
	$for_body_color = get_option('vergo_for_body_color');
	$body_color = get_option('vergo_body_color');
	$background_color = get_option('vergo_background_color');
	$text_color = get_option('vergo_text_color');
	$text_color_alter = get_option('vergo_text_color_alter');
	$body_color_sec = get_option('vergo_body_color_sec');
	$sec_text_color = get_option('vergo_sec_text_color');
	$thi_text_color = get_option('vergo_thi_text_color');
	$link = get_option('vergo_link_color');
	$link_alter = get_option('vergo_thi_link_color');
	$hover = get_option('vergo_link_hover_color');
	$sec_link = get_option('vergo_sec_link_color');
	$sec_hover = get_option('vergo_sec_link_hover_color');
	$thi_hover = get_option('vergo_thi_link_hover_color');
	$body_bg = get_option('vergo_body_bg');
	$body_bg_sec = get_option('vergo_body_bg_sec');
	$shadows = get_option('vergo_shadows_color');
	$shadows_sec = get_option('vergo_shadows_color_sec');
	$shadows_thi = get_option('vergo_shadows_color_thi');
	$border = get_option('vergo_border_color');
	$border_sec = get_option('vergo_border_color_sec');

	    $custom_css = get_option('vergo_custom_css');
		
	// Add CSS to output
	
		if ($custom_css)
		$output .= $custom_css ;
		$output = '';
	
	if ($body_color)
		$output .= '.flexslider a.flex-prev,.flexslider a.flex-next,.nav>li>ul,.container {background-color:'.$body_color.'}' . "\n";
		$output .= 'ul#serinfo-nav{border-color:'.$body_color.' !important}' . "\n";
	if ($sec_body_color)
		$output .= '.body2,.header_scroll,.headbg,.header_noslide,#footer,.services h3 i,#portfolio-list>li>span,#content>span,li.main h3
		{background-color:'.$sec_body_color.'}' . "\n";
		$output .= '#nav li a,.nav>li>a,h2.widget
		{border-color:'.$sec_body_color.'}' . "\n";
	if ($thi_body_color)
		$output .= '#serinfo,#serinfo-nav li.current,#navigation{background-color:'.$thi_body_color.'}' . "\n";
	if ($for_body_color)
		$output .= '#sidebar p input[type=submit],span.ribbon,a#triggernav,a#triggernav-sec,a.fromhome,.imgwrap,a.mainbutton,a.itembutton,.page-numbers.current,a.comment-reply-link,#submit,#comments .navigation a,.tagssingle a,.contact-form .submit,.intro,li.main h2,.plan-bottom a,.scrollTo_top a,.gallery-item, submit{background-color:'.$for_body_color.'}' . "\n";
		$output .= 'a.moreposts,.meta span,.meta a{color:'.$for_body_color.' !important}' . "\n";
	if ($background_color)
		$output .= 'body{background-color:'.$background_color.'}' . "\n";
		$output .= 'h2.widget{border-color:'.$background_color.' !important}' . "\n";

	if ($text_color)
		$output .= 'body,.body1,.tabbig p {color:'.$text_color.'}' . "\n";	
	if ($sec_text_color)
		$output .= '.body2{color:'.$sec_text_color.'}' . "\n";
	if ($text_color_alter)
		$output .= '.body3XXX {color:'.$text_color_alter.' !important}' . "\n";
	if ($link)
		$output .= '.body1 a, a:link, a:visited{color:'.$link.'}' . "\n";
		$output .= 'span>a.moreposts{color:'.$link.' !important}' . "\n";
	if ($link_alter)
		$output .= 'h3.fromhome,li.inside h3,.inside,li.normal h3,.plan-bottom a,.homeblog a {color:'.$link_alter.' !important}' . "\n";
	if ($hover)
		$output .= 'a:hover,.body1 a:hover,#serinfo a:hover,.nav>li.sfHover>a,.nav>li.current-menu-item>a,#serinfo-nav li.current a,#sec-nav>li.current-menu-item>a{color:'.$hover.'  !important}' . "\n";
		$output .= '.nav>li>a:hover,.nav>li.current-menu-ancestor>a,.nav>li.current-menu-item>a,.nav>li.sfHover>a,.nav>li.current-menu-item>a{border-bottom-color:'.$hover.' !important}' . "\n";
	if ($sec_link)
		$output .= '.body2 a,a.body2 {color:'.$sec_link.'}' . "\n";
	if ($sec_hover)
		$output .= '
		.body2 a:hover,p.body2 a:hover{color:'.$sec_hover.'!important}' . "\n";
	if ($thi_hover)
		$output .= '
		submit:hover{color:'.$thi_hover.' !important}' . "\n";
		
	

	if ($body_bg)
		$output .= 'body{background-image:url('.$home_theme.'/images/bg/'.$body_bg.')}' . "\n";
		
		
	if ($border)
		$output .= '.archivepost li,#comments,#header,#sec-navigation,#core_bg,.seccol li,.teaser,.meta,.etabs,.tab,.widgetflexslider,.widgetcol,.widgetcol_small,#sec-nav>li>a,ul#serinfo,#serinfo-nav li.current,#hometab,#navigation,.nav>li>a,#sidebar h2,.ad300,.searchformhead input.s,.searchform input.s,.nav>li>ul,#main-nav>li,.nav li ul li a,.pagination,input, textarea,input checkbox,input radio,select, file{border-color:'.$border.' !important}' . "\n";	

		




		// General Typography		
		$font_text = get_option('vergo_font_text');	
		$font_text_sec = get_option('vergo_font_text_sec');	
		$font_text_thi = get_option('vergo_font_text_thi');	
		
		$font_nav = get_option('vergo_font_nav');
		$font_h1 = get_option('vergo_font_h1');	
		$font_h2 = get_option('vergo_font_h2');	
		$font_h2_alt = get_option('vergo_font_h2_alt');	
		$font_h3 = get_option('vergo_font_h3');	
		$font_h4 = get_option('vergo_font_h4');	
		$font_h5 = get_option('vergo_font_h5');	
		$font_h6 = get_option('vergo_font_h5');	
		
		
		$font_h2_tagline = get_option('vergo_font_h2_tagline');	
	
	
		if ( $font_text )
			$output .= 'body,#sec-nav,input, textarea,input checkbox,input radio,select, file,h3.sd-title {font:'.$font_text["style"].' '.$font_text["size"].'px/2.2em '.stripslashes($font_text["face"]).';color:'.$font_text["color"].'}' . "\n";
			$output .= 'h2.ads{color:'.$font_text["color"].'}' . "\n";
			
		if ( $font_text_sec )
			$output .= '.body2 {font:'.$font_text_sec["style"].' '.$font_text_sec["size"].'px/2.2em '.stripslashes($font_text_sec["face"]).';color:'.$font_text_sec["color"].'}' . "\n";
			$output .= '.body2 h2,.body2 h3,.tickerwrap>span {color:'.$font_text_sec["color"].' !important}' . "\n";
			
		if ( $font_text_thi )
			$output .= '.intro{font:'.$font_text_thi["style"].' '.$font_text_thi["size"].'px/2.2em '.stripslashes($font_text_thi["face"]).';color:'.$font_text_thi["color"].'}' . "\n";
			$output .= '.intro h1,.intro h1 a,a.itembutton,a.mainbutton,.page-numbers.current{color:'.$font_text_thi["color"].'}' . "\n";

		if ( $font_h1 )
			$output .= 'h1 {font:'.$font_h1["style"].' '.$font_h1["size"].'px/1.5em '.stripslashes($font_h1["face"]).';color:'.$font_h1["color"].'}';	
			$output .= '#block ul li h2 {font-family:'.stripslashes($font_h1["face"]).'}';
		if ( $font_h2 )
			$output .= 'h2 {font:'.$font_h2["style"].' '.$font_h2["size"].'px/1.2em '.stripslashes($font_h2["face"]).';color:'.$font_h2["color"].'}';
			$output .= 'h2.widget>a {color:'.$font_h2["color"].'}';
		
		if ( $font_h2_alt )
			$output .= 'h2.post {font:'.$font_h2_alt["style"].' '.$font_h2_alt["size"].'px/1.2em '.stripslashes($font_h2_alt["face"]).';color:'.$font_h2_alt["color"].'}';
			$output .= '#sidebar h2 {color:'.$font_h2_alt["color"].'}';
			
		if ( $font_h3 )
			$output .= 'h3,h3#reply-title,#respond h3 {font:'.$font_h3["style"].' '.$font_h3["size"].'px/1.5em '.stripslashes($font_h3["face"]).';color:'.$font_h3["color"].' !important}';
		if ( $font_h4 )
			$output .= 'h4 {font:'.$font_h4["style"].' '.$font_h4["size"].'px/1.5em '.stripslashes($font_h4["face"]).';color:'.$font_h4["color"].'}';	
		if ( $font_h5 )
			$output .= 'h5 {font:'.$font_h5["style"].' '.$font_h5["size"].'px/1.5em '.stripslashes($font_h5["face"]).';color:'.$font_h5["color"].'}';	
		if ( $font_h6 )
			$output .= 'h6 {font:'.$font_h6["style"].' '.$font_h6["size"].'px/1.5em '.stripslashes($font_h6["face"]).';color:'.$font_h6["color"].'}' . "\n";
			
			
		if ( $font_nav )
			$output .= '#nav li a,.nav>li>a,ul#serinfo-nav li a,#sec-nav>li>a,.searchformhead>input.s,.tickerwrap>span {font:'.$font_nav["style"].' '.$font_nav["size"].'px/1.7em '.stripslashes($font_nav["face"]).';color:'.$font_nav["color"].'}';		
		
		
	// custom stuff	
		if ( $font_text )
			$output .= '.tab-post small a,.taggs a {color:'.$font_text["color"].'}' . "\n";	
	
	// Output styles
		if ($output <> '') {
			$output = "<!-- Vergo Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
	}
		
} 


// Add custom styling
add_action('vergo_head','vergo_mobile_styling');
	// Add stylesheet for shortcodes to HEAD
	function vergo_mobile_styling() {
		
		// google fonts link generator
		get_template_part('/functions/admin-fonts');
		
		wp_register_style('font-awesome.min', get_template_directory_uri() .	'/styles/font-awesome.min.css');
			wp_enqueue_style( 'font-awesome.min');
		wp_register_style('font-awesome-ie7', get_template_directory_uri() .	'/styles/font-awesome-ie7.css');
			wp_enqueue_style( 'font-awesome-ie7');
		
		wp_register_style('mobile.start', get_template_directory_uri() .	'/styles/mobile.start.css');
			wp_enqueue_style( 'mobile.start');
		
		if (get_option('vergo_res_mode_general') <> "true") {	
				wp_register_style('mobile', get_template_directory_uri() .	'/styles/mobile.css');
					wp_enqueue_style( 'mobile');
		}
} 
?>