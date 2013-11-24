<?php
    /*
    Plugin Name: Theia Post Slider
    Description: Display multi-page posts using a slider, as a slideshow.
    Author: Liviu Cristian Mirea Ghiban
    Version: 1.0.8
    */

/*
 * Copyright 2012, Theia Post Slider, Liviu Cristian Mirea Ghiban.
 */

/*
 * Plugin version. Used to forcefully invalidate CSS and JavaScript caches by appending the version number to the
 * filename (e.g. "style.css?ver=TPS_VERSION").
 */
define('TPS_VERSION', '1.0.8');

/*
 * Decide whether to use these files as a standalone plugin or not (i.e. integrate them in a theme).
 */
if (!defined('TPS_USE_AS_STANDALONE')) {
    define('TPS_USE_AS_STANDALONE', true);
}

/*
 * Define the plugin URL.
 */
if (!defined('TPS_PLUGINS_URL')) {
    define('TPS_PLUGINS_URL', plugins_url('', __FILE__));
}

// Include other files.
include(dirname(__FILE__) . '/TpsMisc.php');
include(dirname(__FILE__) . '/TpsOptions.php');
include(dirname(__FILE__) . '/admin-menu.php');

// Initialize plugin options.
TpsOptions::initOptions();


// Add hooks.
add_action('the_post', 'TpsMisc::the_post', 999999);
add_action('the_content', 'TpsMisc::the_content', 999999);
add_action('wp_enqueue_scripts', 'TpsMisc::wp_enqueue_scripts');
add_action('admin_enqueue_scripts', 'TpsMisc::admin_enqueue_scripts');
add_filter('mce_buttons','TpsMisc::wysiwyg_editor');
add_filter('wp_head','TpsMisc::wp_head');