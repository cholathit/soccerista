<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

//Theme Shortname
$shortname = "gd";

//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');

if ( is_admin() ) {

//Access the WordPress Tags via an Array
$tt_tags = array();
$tt_tags_obj = get_tags('hide_empty=0');
foreach ($tt_tags_obj as $tt_tag) {
$tt_tags[$tt_tag->slug] = $tt_tag->slug;}
$tags_tmp = array_unshift($tt_tags, "Select a tag:");

$home_layout = array("Widgets","Blog");
$logo_loc = array("Large below navigation","Small in navigation");

}


/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall

/* General Settings */
$options[] = array( "name" => __('General Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Logo Location','framework_localize'),
			"desc" => __('Set the location of your logo.','framework_localize'),
			"id" => $shortname."_logo_loc",
			"std" => "1",
			"type" => "select",
			"options" => $logo_loc);

$options[] = array( "name" => __('Small Logo','framework_localize'),
			"desc" => __('Select a file to appear as the small logo for your site if you chose to have the logo in the nagivation. The recommended maximum dimensions for this logo are 100x30.','framework_localize'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Large Logo','framework_localize'),
			"desc" => __('Select a file to appear as the large logo for your site if you chose to have the logo below the navigation. The recommended maximum dimensions (if you plan on using a 728x90 ad) for this logo are 222x90.','framework_localize'),
			"id" => $shortname."_logo_large",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Custom Favicon','framework_localize'),
			"desc" => __('Upload a 16x16px PNG/GIF image that will represent your website\'s favicon.','framework_localize'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");


$options[] = array( "name" => __('Tracking Code','framework_localize'),
			"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
			"id" => $shortname."_tracking",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Custom CSS','framework_localize'),
			"desc" => "Enter your custom CSS here. You will not lose any of the CSS you enter here if you update the theme to a new version.",
			"id" => $shortname."_customcss",
			"std" => "",
			"type" => "textarea");


/* Theme Color Settings */
$options[] = array( "name" => __('Color Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Primary Theme Color','framework_localize'),
			"desc" => __('Primary color for the site.','framework_localize'),
			"id" => $shortname."_primary_theme",
			"std" => "#222222",
			"type" => "color");

$options[] = array( "name" => __('Theme Secondary Color','framework_localize'),
			"desc" => __('The secondary color for the site.','framework_localize'),
			"id" => $shortname."_secondary_theme",
			"std" => "#eb1e00",
			"type" => "color");

$options[] = array( "name" => __('Primary Link Color','framework_localize'),
			"desc" => __('Primary link color for the site.','framework_localize'),
			"id" => $shortname."_link_color",
			"std" => "#004276",
			"type" => "color");

$options[] = array( "name" => __('Widget Heading Color','framework_localize'),
			"desc" => __('Widget heeading color for the site.','framework_localize'),
			"id" => $shortname."_heading",
			"std" => "#777777",
			"type" => "color");


/* Homepage Settings */
$options[] = array( "name" => __('Homepage Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Homepage Layout','framework_localize'),
			"desc" => __('This is a dropdown list.','framework_localize'),
			"id" => $shortname."_home_layout",
			"std" => "1",
			"type" => "select",
			"options" => $home_layout);

$options[] = array( "name" => __('Featured Slider Tag Slug','framework_localize'),
			"desc" => __('Posts with tags in this field will show up in the Featured Slider.','framework_localize'),
			"id" => $shortname."_slider_tags",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tags);

$options[] = array( "name" => __('Maximum Featured Slider Items','framework_localize'),
			"desc" => "Set the maximum number of items (posts) to appear in the Featured Slider.",
			"id" => $shortname."_slider_num",
			"std" => "6",
			"type" => "text");

/* News Ticker Settings */
$options[] = array( "name" => __('News Ticker Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('News Ticker Tag Slug','framework_localize'),
			"desc" => __('Posts with tags in this field will show up in the News Ticker.','framework_localize'),
			"id" => $shortname."_ticker_tags",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tags);

$options[] = array( "name" => __('Maximum News Ticker Items','framework_localize'),
			"desc" => "Set the maximum number of items (posts) to appear in the News Ticker.",
			"id" => $shortname."_ticker_num",
			"std" => "10",
			"type" => "text");


/* Article Settings */
$options[] = array( "name" => __('Article Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Show Featured Image?','framework_localize'),
			"desc" => __('Check this box if you would like to display a featured image thumb.','framework_localize'),
			"id" => $shortname."_featured_img",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Previous/Next Post Links?','framework_localize'),
			"desc" => "Check this box if you would like to display links to the previous/next posts below each aricle.",
			"id" => $shortname."_prev_next",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Author Info Box?','framework_localize'),
			"desc" => "Check this box if you would like to display an author info box.",
			"id" => $shortname."_author_box",
			"std" => "true",
			"type" => "checkbox");


/* Social Media Settings */
$options[] = array( "name" => __('Social Media Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','framework_localize'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "While most fields require just the username, Google Plus requires the full URL to your Google Plus Page.",
			"type" => "info");

$options[] = array( "name" => __('Facebook','framework_localize'),
			"desc" => "Enter your Facebook Page username here.",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Twitter','framework_localize'),
			"desc" => "Enter your Twitter username here.",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Pinterest','framework_localize'),
			"desc" => "Enter your Pinterest username here.",
			"id" => $shortname."_pinterest",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Instagram','framework_localize'),
			"desc" => "Enter your Instagram username here.",
			"id" => $shortname."_instagram",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Google Plus','framework_localize'),
			"desc" => "Enter your full Google Plus URL here.",
			"id" => $shortname."_google",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Youtube','framework_localize'),
			"desc" => "Enter your Youtube username here.",
			"id" => $shortname."_youtube",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Linkedin','framework_localize'),
			"desc" => "Enter your Linkedin username here.",
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text");


/* Ad Management Settings */
$options[] = array( "name" => __('Ad Management','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','framework_localize'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "The 300x250 and 160x600 ad units are controlled via Widgets.",
			"type" => "info");

$options[] = array( "name" => __('728x90 Ad Code','framework_localize'),
			"desc" => "Enter your ad code (Eg. Google Adsense).",
			"id" => $shortname."_leader_ad",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('320x50 Mobile Ad Code','framework_localize'),
			"desc" => "Enter your ad code (Eg. Google Adsense).",
			"id" => $shortname."_mobile_ad",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Wallpaper Ad Image URL','framework_localize'),
			"desc" => "Enter the URL for your wallpaper ad image. Wallpaper ad code should be a minimum of 1280px wide. Please see the theme documentation for more on wallpaper ad specifications.",
			"id" => $shortname."_wall_ad",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Wallpaper Ad URL','framework_localize'),
			"desc" => "Enter the URL for your wallpaper ad click-through.",
			"id" => $shortname."_wall_url",
			"std" => "",
			"type" => "text");


/* Footer Settings */
$options[] = array( "name" => __('Footer Info','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Copyright Text','framework_localize'),
			"desc" => "Here you can enter any text you want (eg. copyright text)",
			"id" => $shortname."_copyright",
			"std" => "Copyright &copy; 2013 Gameday Theme. Theme by MVP Themes, powered by Wordpress.",
			"type" => "textarea");



update_option('of_template',$options);

update_option('of_shortname',$shortname);

}
}
?>