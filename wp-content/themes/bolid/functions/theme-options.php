<?php

add_action('init','vergo_options');  
function vergo_options(){
	
// VARIABLES
$themename = "Bolid";
$shortname = "vergo";

// Populate option in array for use in theme 
global $vergo_options; 
$vergo_options = get_option('vergo_options');

$GLOBALS['template_path'] = get_template_directory_uri();;

//Access the WordPress Categories via an Array
$vergo_categories = array();  
$vergo_categories_obj = get_categories('hide_empty=0');
foreach ($vergo_categories_obj as $vergo_cat) {
    $vergo_categories[$vergo_cat->cat_ID] = $vergo_cat->cat_name;}
$categories_tmp = array_unshift($vergo_categories, "Select a category:");    


// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 


//Stylesheets Reader
$alt_stylesheet_path = get_template_directory() . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}
// Set the Options Array
$bgurl =  get_template_directory_uri() . '/functions/images/bg';
//More Options
$all_uploads_path =  home_url() . '/wp-content/uploads/';
$all_uploads = get_option('vergo_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// THIS IS THE DIFFERENT FIELDS
$options = array();   

$options[] = array( "name" => "General Settings",
                    "type" => "heading");

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");   

					

		
// general layout
					

					                        
// primary styling

$options[] = array( "name" => " Primary Styling",
					"type" => "heading");

			
$options[] = array( "name" => "General Text Font Style",
					"desc" => "Select the typography used in general text. <br />* semi-safe font <br />*** Google Webfonts (Must be allowed in General Settings tab).",
					"id" => $shortname."_font_text",
					"std" => array('size' => '12','face' => 'Arial, sans-serif','style' => '400','color' => '#545454'),
					"type" => "typography"); 
					
					
$options[] = array( "name" =>  "Container Background Color",
					"desc" => "Pick a custom color for background color of the theme.",
					"id" => $shortname."_body_color",
					"std" => "#ffffff",
					"type" => "color");

					
$options[] = array( "name" =>  "Link Color",
					"desc" => "Pick a custom color for links. e.g. #585a66",
					"id" => $shortname."_link_color",
					"std" => "#2E373F",
					"type" => "color");     

$options[] = array( "name" =>  "Hover Color",
					"desc" => "Pick a custom color for links (hover). #73b8f5",
					"id" => $shortname."_link_hover_color",
					"std" => "#F34747",
					"type" => "color"); 
					
$options[] = array( "name" =>  "Borders",
					"desc" => "Pick a custom color for borders. e.g. #fff",
					"id" => $shortname."_border_color",
					"std" => "#ededed ",
					"type" => "color"); 
				
	
// secondary styling	
	
$options[] = array( "name" => "Secondary Styling",
					"type" => "heading");
	
					
$options[] = array( "name" => "Secondary Text Font Style",
					"desc" => "Select the typography for Announcement, More section <br />* semi-safe font <br />*** Google Webfonts (Must be allowed in General Settings tab).",
					"id" => $shortname."_font_text_sec",
					"std" => array('size' => '11','face' => 'Arial, sans-serif','style' => '400','color' => '#fff'),
					"type" => "typography");  
									
 
$options[] = array( "name" => "Secondary Background Color",
					"desc" => "Pick a custom color for background color of the theme e.g. #32333d",
					"id" => $shortname."_custom_color",
					"std" => "#4f4f4f",
					"type" => "color"); 
     
					
$options[] = array( "name" =>  "Secondary Link Color",
					"desc" => "Pick a custom color for links in slider, footer and headings area. #f0f0f0",
					"id" => $shortname."_sec_link_color",
					"std" => "#fff",
					"type" => "color");     

$options[] = array( "name" =>  "Secondary Link Hover Color",
					"desc" => "Pick a custom color for links (hover) in slider, footer and headings area. e.g. #fff",
					"id" => $shortname."_sec_link_hover_color",
					"std" => "#F34747",
					"type" => "color");       


	

// other styling	
	
$options[] = array( "name" => "Other Styling",
					"type" => "heading");	

$options[] = array( "name" =>  "Alternative Background Color",
					"desc" => "Pick a custom color for Main navigation, Tabs widget, Ads widgets etc.",
					"id" => $shortname."_thi_body_color",
					"std" => "#f9f9f9",
					"type" => "color");
					
$options[] = array( "name" =>  "Elements Color",
					"desc" => "Pick a custom color for Intro, Item ribbon, Main buttons etc.",
					"id" => $shortname."_for_body_color",
					"std" => "#F34747",
					"type" => "color");
					
					
$options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a custom color for main background. If you want to set BG image go to Appearance > Background",
					"id" => $shortname."_background_color",
					"std" => "#4f4f4f",
					"type" => "color");

$options[] = array( "name" => "Show Container Shadow",
                    "desc" => "You can disable container shadow here.",
                    "id" => $shortname."_cont_shadow",
                    "std" => "true",
                    "type" => "checkbox");
					

$options[] = array( "name" => "Show Uppercase Fonts",
                    "desc" => "You can disable general uppercase here.",
                    "id" => $shortname."_upper",
                    "std" => "true",
                    "type" => "checkbox");
	
$options[] = array( "name" => "Background overlay",
                    "desc" => "Choose bg overlay.",
                    "id" => $shortname."_body_bg",
					"type" => "select2",
					"options" => array(
					"" => "None",
					"bg-line1.png" => "Line 1",
					"bg-line2.png" => "Line 2", 
					"bg-line3.png" => "Line 3", 
					"bg-line4.png" => "Line 4", 
					"bg-line5.png" => "Line 5", 
					"bg-line6.png" => "Line 6", 
					"bg-line7.png" => "Line 7", 
					"bg-line8.png" => "Line 8", 
					"bg-line9.png" => "Line 9", 
					"bg-square1.png" => "Square 1",
					"bg-square2.png" => "Square 2",
					"bg-square3.png" => "Square 3",
					"bg-square4.png" => "Square 4",
					"bg-square5.png" => "Square 5",
					"bg-square6.png" => "Square 6",
					"bg-pattern1.png" => "Pattern 1", 
					"bg-dots1.png" => "Dots",
					"bg-zig.png" => "Zig Zag", 
					"bg-transparent.png" => "Transparent", 
					) );
			

// typography

$options[] = array( "name" => "Headings Typography",
					"type" => "heading");    


$options[] = array( "name" => "Navigation Font Style",
					"desc" => "Select the typography you want for heading H1. <br />* semi-safe font <br />*** Google Webfonts.",
					"id" => $shortname."_font_nav",
					"std" => array('size' => '12','face' => 'Raleway','style' => '800','color' => '#2E373F'),
					"type" => "typography");  

$options[] = array( "name" => "H1 Font Style (Site title)",
					"desc" => "Select the typography you want for heading H1. <br />* semi-safe font <br />*** Google Webfonts.",
					"id" => $shortname."_font_h1",
					"std" => array('size' => '25','face' => 'Raleway, sans-serif','style' => '900','color' => '#2E373F'),
					"type" => "typography");  

$options[] = array( "name" => "H2 Font Style (Homepage + Widgets)",
					"desc" => "Select the typography you want for heading H2 (on homepage, widgets). <br />* semi-safe font <br />*** Google Webfonts.",
					"id" => $shortname."_font_h2",
					"std" => array('size' => '16','face' => 'Raleway','style' => '900','color' => '#3d3d3d'),
					"type" => "typography");  

$options[] = array( "name" => "H2 Font Style (Post titles)",
					"desc" => "Select the typography you want for heading H2. <br />* semi-safe font <br />*** Google Webfonts.",
					"id" => $shortname."_font_h2_alt",
					"std" => array('size' => '28','face' => 'Raleway','style' => '900','color' => '#3d3d3d'),
					"type" => "typography");  

$options[] = array( "name" => "H3 Font Style",
					"desc" => "Select the typography you want for heading H3 <br />* semi-safe font <br />*** Google Webfonts.",
					"id" => $shortname."_font_h3",
					"std" => array('size' => '20','face' => 'Raleway','style' => '600','color' => '#222222'),
					"type" => "typography"); 

$options[] = array( "name" => "H4 Font Style",
					"desc" => "Select the typography you want for heading H4. <br />* semi-safe font <br />*** Google Webfonts.",
					"id" => $shortname."_font_h4",
					"std" => array('size' => '14','face' => 'Open Sans, sans-serif','style' => '400','color' => '#222222'),
					"type" => "typography");  
					
$options[] = array( "name" => "H5 & H6 Font Style",
					"desc" => "Select the typography you want for heading H5 and H6. <br />* semi-safe font <br />*** Google Webfonts.",
					"id" => $shortname."_font_h5",
					"std" => array('size' => '14','face' => 'Raleway, sans-serif','style' => '400','color' => '#222222'),
					"type" => "typography"); 

// responsivity
		
$options[] = array( "name" => "Responsive Mode",
    				"type" => "heading");

$options[] = array( "name" => "Disable General Responsive mode",
                    "desc" => "On mobile screens (740px and less) will be responsive mode disabled",
                    "id" => $shortname."_res_mode_general",
                    "std" => "false",
                    "type" => "checkbox");					

$options[] = array( "name" => "Disable Header Ad in responsive mode",
                    "desc" => "This section will be not visible on mobile screens (740px and less)",
                    "id" => $shortname."_ad_res_mode",
                    "std" => "false",
                    "type" => "checkbox");

$options[] = array( "name" => "Disable Ticker in responsive mode",
                    "desc" => "This section will be not visible on mobile screens (740px and less)",
                    "id" => $shortname."_ticker_res_mode",
                    "std" => "false",
                    "type" => "checkbox");
					

// magazine sliders


$options[] = array( "name" => "Ticker",
					"type" => "heading");  

					
$options[] = array( "name" => "News Ticker Category (Header)",
					"desc" => "Select a category for ticker slider.",
					"id" => $shortname."_ticker_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $vergo_categories);

					
$options[] = array( "name" => "Disable Ticker",
					"desc" => "Check to disable this area",
					"id" => $shortname."_ticker_dis",
					"std" => "false",
					"type" => "checkbox");

// post settings

$options[] = array( "name" => "Post Settings",
					"type" => "heading");    
			

$options[] = array( "name" => "Disable Featured Image",
					"desc" => "Check to disable featured image in single post",
					"id" => $shortname."_post_image_dis",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => "Disable Slideshow Gallery",
					"desc" => "Check to disable slideshow gallery in single post",
					"id" => $shortname."_post_gallery_dis",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => "Disable Author Info",
					"desc" => "Check to disable author section in single post",
					"id" => $shortname."_post_author_dis",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => "Disable Related Posts",
					"desc" => "Check to disable related posts section in single post",
					"id" => $shortname."_post_related_dis",
					"std" => "false",
					"type" => "checkbox");



// about us



		
// social networks	

$options[] = array( "name" => "Social Networks",
    				"type" => "heading");
			

$options[] = array( "name" => "Rss Feed",
					"desc" => "",
					"id" => $shortname."_socials_rss",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Facebook",
					"desc" => "",
					"id" => $shortname."_socials_fa",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Twitter",
					"desc" => "",
					"id" => $shortname."_socials_tw",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Google+",
					"desc" => "",
					"id" => $shortname."_socials_googleplus",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Pinterest",
					"desc" => "",
					"id" => $shortname."_socials_pinterest",
					"std" => "",
					"type" => "text");
					

$options[] = array( "name" => "Instagram",
					"desc" => "",
					"id" => $shortname."_socials_instagram",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Behance",
					"desc" => "",
					"id" => $shortname."_socials_behance",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "You Tube",
					"desc" => "",
					"id" => $shortname."_socials_yo",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Vimeo",
					"desc" => "",
					"id" => $shortname."_socials_vi",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Tumblr",
					"desc" => "",
					"id" => $shortname."_socials_tu",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Deviant Art",
					"desc" => "",
					"id" => $shortname."_socials_de",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Flickr",
					"desc" => "",
					"id" => $shortname."_socials_fl",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "LinkedIn",
					"desc" => "",
					"id" => $shortname."_socials_li",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Last FM",
					"desc" => "",
					"id" => $shortname."_socials_la",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Myspace",
					"desc" => "",
					"id" => $shortname."_socials_my",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Posterous",
					"desc" => "",
					"id" => $shortname."_socials_po",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Spotify",
					"desc" => "",
					"id" => $shortname."_socials_sp",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Skype",
					"desc" => "",
					"id" => $shortname."_socials_sk",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Yahoo",
					"desc" => "",
					"id" => $shortname."_socials_ya",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Delicious",
					"desc" => "",
					"id" => $shortname."_socials_dl",
					"std" => "",
					"type" => "text");


					
// footer
$options[] = array( "name" => "Footer",
                    "type" => "heading");
					
$options[] = array( "name" => "Footer Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
					"id" => $shortname."_about_img",
					"std" => "",
					"type" => "upload");    

					
$options[] = array("name" => "About Us - Info text",
					"desc" => "Enter About Information",
					"id" => $shortname."_aboutus_text",
					"std" => "",
					"type" => "textarea"); 
					
$options[] = array( "name" => "Enable Custom Footer (Left)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_left",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Left)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_left_text",
					"std" => "<p></p>",
					"type" => "textarea");
					
$options[] = array( "name" => "Enable Custom Footer (Right)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_right",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Right)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_right_text",
					"std" => "<p></p>",
					"type" => "textarea");

// ads					
					
$options[] = array( "name" => "Static Ads",
					"type" => "heading");  

$options[] = array("name" => "Header Advertisement Code",
					"desc" => "Enter your code here.",
					"id" => $shortname."_headeradscript",
					"std" => "",
					"type" => "textarea");  
					

$options[] = array("name" => "Header Image URL",
					"desc" => "Enter your image url here (468x60px).",
					"id" => $shortname."_headeradimg1",
					"std" => "",
					"type" => "text");   
	   
$options[] = array("name" => "Header Link URL",
					"desc" => "Enter link url here.",
					"id" => $shortname."_headeradurl1",
					"std" => "#",
					"type" => "text");




							                        
update_option('vergo_template',$options);      
update_option('vergo_themename',$themename);   
update_option('vergo_shortname',$shortname);

                                     
// Vergo Metabox Options
$vergo_metaboxes = array();

$vergo_metaboxes[] = array (	"name" => "image",
							"label" => "Image",
							"type" => "upload",
							"desc" => "Upload file here...");							
    
update_option('vergo_custom_template',$vergo_metaboxes);      

}

?>