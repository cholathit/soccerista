<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

// VARIABLES
$themename = wp_get_theme('resportsive');
$themename = $themename['Name'];
$shortname = "resport";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "Select a category:");

//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post");

//Testing
$options_select = array("one","two","three","four","five");
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
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

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';

// Set the Options Array
$options = array();

$options[] = array( "name" => "General Settings",
                    "type" => "heading");

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png) The recommended maximum width for the logo is 300px.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16x16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Leaderboard Ad",
					"desc" => "Enter your banner code (Eg. Google Adsense). The recommended ad size is 728x90px.",
					"id" => $shortname."_leaderboard",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Slider Settings",
                    "type" => "heading");

$options[] = array( "name" => "Featured slider tags",
					"desc" => "Posts with tags in this field will show up on the homepage featured content slider. Separate tags by comma.",
					"id" => $shortname."_slider_tags",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Maximum slides",
					"desc" => "Set the maximum number of slides (posts) to appear in the featured content slider.",
					"id" => $shortname."_max_slides",
					"std" => "8",
					"type" => "text");

$options[] = array( "name" => "Slider Pause Time",
					"desc" => "Set the time for how long each slide will show (in milliseconds). 10000 milliseconds = 10 seconds.",
					"id" => $shortname."_slider_time",
					"std" => "10000",
					"type" => "text");

$options[] = array( "name" => "News Ticker Settings",
                    "type" => "heading");

$options[] = array( "name" => "News Ticker Tags",
					"desc" => "Posts with tags in this field will show up in the news ticker in the header. Separate tags by comma.",
					"id" => $shortname."_ticker_tags",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Maximum Ticker Items",
					"desc" => "Set the maximum number of items (posts) to appear in the news ticker.",
					"id" => $shortname."_ticker_items",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Social Media Options",
					"type" => "heading");

$options[] = array( "name" => "Facebook",
					"desc" => "Enter your Facebook username here.",
					"id" => $shortname."_facebook",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Twitter",
					"desc" => "Enter your Twitter username here.",
					"id" => $shortname."_twitter",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Google Plus",
					"desc" => "Enter the full URL to your Google Plus page",
					"id" => $shortname."_gplus",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Pinterest",
					"desc" => "Enter your Pinterest user name here",
					"id" => $shortname."_pinterest",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Footer Options",
					"type" => "heading");

$options[] = array( "name" => "Footer About Section Heading",
					"desc" => "Enter your heading for the About Section that will appear in the footer.",
					"id" => $shortname."_abt_head",
					"std" => "About Section",
					"type" => "text");

$options[] = array( "name" => "Footer About Section Text",
					"desc" => "Enter your About Section text that will appear in the footer.",
					"id" => $shortname."_abt_text",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Copyright Text",
					"desc" => "Here you can enter any text you want (eg. copyright text)",
					"id" => $shortname."_footer_text",
					"std" => "Copyright &copy; 2012 Resportsive Theme. Theme by MVP Themes Powered by Wordpress.",
					"type" => "textarea");

update_option('of_template',$options);
update_option('of_themename',$themename);
update_option('of_shortname',$shortname);

}
}
?>