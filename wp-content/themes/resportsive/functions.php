<?php

/////////////////////////////////////
// Enqueue Javascript Files
/////////////////////////////////////

function my_scripts_method() {

    	wp_deregister_script( 'jquery' );
    	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    	wp_enqueue_script( 'jquery' );

	wp_enqueue_script(
		'flexslider',
		get_template_directory_uri() . '/js/jquery.flexslider.js',
		array('jquery')
	);

	wp_enqueue_script(
		'elastislide',
		get_template_directory_uri() . '/js/jquery.elastislide.js',
		array('jquery')
	);

	wp_enqueue_script(
		'resportsive',
		get_template_directory_uri() . '/js/scripts.js',
		array('jquery')
	);

	wp_enqueue_script(
		'ticker',
		get_template_directory_uri() . '/js/ticker.js',
		array('jquery')
	);

	wp_enqueue_script(
		'respond',
		get_template_directory_uri() . '/js/respond.min.js',
		array('jquery')
	);

}
add_action('wp_enqueue_scripts', 'my_scripts_method');

/////////////////////////////////////
// Options Framework Functions
/////////////////////////////////////
/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

if ( get_stylesheet_directory() == get_template_directory() ) {
	define('OF_FILEPATH', get_template_directory());
	define('OF_DIRECTORY', get_template_directory_uri());
} else {
	define('OF_FILEPATH', get_stylesheet_directory());
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings

/////////////////////////////////////
// Register Widgets
/////////////////////////////////////

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Homepage Widget Area',
		'before_widget' => '<div class="widget-home">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget"><span class="widget">',
		'after_title' => '</span></h3>',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar Widget Area',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));
}

include("admin/widgets/widget-facebook.php");
include("admin/widgets/widget-tabs.php");
include("admin/widgets/widget-list.php");
include("admin/widgets/widget-car.php");
include("admin/widgets/widget-cat2.php");
include("admin/widgets/widget-recent.php");
include("admin/widgets/widget-ad.php");
include("admin/widgets/widget-social.php");

/////////////////////////////////////
// Register Custom Menus
/////////////////////////////////////
function register_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' ),
			'footer-category-menu' => __( 'Footer Category Menu' ),
	  		'footer-page-menu' => __( 'Footer Page Menu' ),)
	  	);
	  }

add_action( 'init', 'register_menus' );

/////////////////////////////////////
// Register Thumbnails
/////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 610, 400, true );
add_image_size( 'post-thumb', 610, 400, true );
add_image_size( 'half-thumb', 300, 197, true );
add_image_size( 'small-thumb', 145, 95, true );
add_image_size( 'square-thumb', 95, 95, true );
}

/////////////////////////////////////
// Add Bread Crumbs
/////////////////////////////////////

function wp_bac_breadcrumb() {
    //Variable (symbol >> encoded) and can be styled separately.
    //Use >> for different level categories (parent >> child >> grandchild)
            $delimiter = '<span class="delimiter"> / </span>';
    //Use bullets for same level categories ( parent . parent )
    $delimiter1 = '<span class="delimiter1"> &bull; </span>';

    //text link for the 'Home' page
            $main = 'Home';
    //Display only the first 30 characters of the post title.
            $maxLength= 30;

    //variable for archived year
    $arc_year = get_the_time('Y');
    //variable for archived month
    $arc_month = get_the_time('F');
    //variables for archived day number + full
    $arc_day = get_the_time('d');
    $arc_day_full = get_the_time('l');

    //variable for the URL for the Year
    $url_year = get_year_link($arc_year);
    //variable for the URL for the Month
    $url_month = get_month_link($arc_year,$arc_month);

    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */

    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page()) {
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
        echo '<div class="breadcrumb">';

        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;
        //A safe way of getting values for a named option from the options database table.
        $homeLink = home_url(); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        echo '<a href="' . $homeLink . '">' . $main . '</a>' . $delimiter;

        //Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $num_cat = count($category); //counts the number of categories the post is listed in.

            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
            if ($num_cat <=1)  //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                echo get_category_parents($category[0],  true,' ' . $delimiter . ' ');
                //Display the full post title.
                echo ' ' . get_the_title();
            }
            //then the post is listed in more than 1 category.
            else {
                //Put bullets between categories, since they are at the same level in the hierarchy.
                echo the_category( $delimiter1, multiple);
                    //Display partial post title, in order to save space.
                    if (strlen(get_the_title()) >= $maxLength) { //If the title is long, then don't display it all.
                        echo ' ' . $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...';
                    }
                    else { //the title is short, display all post title.
                        echo ' ' . $delimiter . get_the_title();
                    }
            }
        }
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            //If it is a subcategory, it will display the full path to the subcategory.
            //Returns the parent categories of the current category with links separated by '»'
            echo '' . get_category_parents($cat, true,'') . '' ;
        }
        //Display breadcrumb for tag archive
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo 'Posts Tagged: "' . single_tag_title("", false) . '"';
        }
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
            echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
        }
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
        }
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            echo $arc_year;
        }
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed.
            echo 'Search results for: "' . get_search_query() . '"';
        }
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            echo get_the_title();
        }
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.
            $post_array = get_post_ancestors($post);

            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array);

            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
            }
            the_title(); //returns the title of the current page.
        }
        //Display breadcrumb for author archive
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo  'Archived Article(s) by Author: ' . $user_info->display_name ;
        }
        //Display breadcrumb for 404 Error
        elseif ( is_404() ) {//checks if 404 error is being displayed
            echo  'Error 404 - Not Found.';
        }
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
       echo '</div>';
    }
}

/////////////////////////////////////
// Add Custom Meta Box
/////////////////////////////////////
/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'resportsive_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'resportsive_post_meta_boxes_setup' );

/* Meta box setup function. */
function resportsive_post_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'resportsive_add_post_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'resportsive_save_featured_headline_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function resportsive_add_post_meta_boxes() {

	add_meta_box(
		'resportsive-featured-headline',			// Unique ID
		esc_html__( 'Featured Headline', 'example' ),		// Title
		'resportsive_featured_headline_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',					// Context
		'high'					// Priority
	);
}

/* Display the post meta box. */
function resportsive_featured_headline_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'resportsive_featured_headline_nonce' ); ?>

	<p>
		<label for="resportsive-featured-headline"><?php _e( "Add a custom featured headline that will be displayed in the featured slider.", 'example' ); ?></label>
		<br />
		<input class="widefat" type="text" name="resportsive-featured-headline" id="resportsive-featured-headline" value="<?php echo esc_html__( get_post_meta( $object->ID, 'resportsive_featured_headline', true ) ); ?>" size="30" />
	</p>
<?php }

/* Save the meta box's post metadata. */
function resportsive_save_featured_headline_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['resportsive_featured_headline_nonce'] ) || !wp_verify_nonce( $_POST['resportsive_featured_headline_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['resportsive-featured-headline'] ) ? balanceTags( $_POST['resportsive-featured-headline'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'resportsive_featured_headline';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}

/////////////////////////////////////
// Add Content Limit
/////////////////////////////////////

function close_tags($text) {

    $patt_open    = "%((?<!</)(?<=<)[\s]*[^/!>\s]+(?=>|[\s]+[^>]*[^/]>)(?!/>))%";

    $patt_close    = "%((?<=</)([^>]+)(?=>))%";

    if (preg_match_all($patt_open,$text,$matches))

    {

        $m_open = $matches[1];

        if(!empty($m_open))

        {

            preg_match_all($patt_close,$text,$matches2);

            $m_close = $matches2[1];

            if (count($m_open) > count($m_close))

            {

                $m_open = array_reverse($m_open);

                foreach ($m_close as $tag) $c_tags[$tag]++;

                foreach ($m_open as $k => $tag)    if ($c_tags[$tag]--<=0) $text.='</'.$tag.'>';

            }

        }

    }

    return $text;

}

////////////////////////////////////////////////////////////////////////////////

// Content Limit

	function content($num, $more_link_text = '(more...)') {

	$theContent = get_the_content($more_link_text);

	$output = preg_replace('/<img[^>]+./','', $theContent);

	$limit = $num+1;

	$content = explode(' ', $output, $limit);

	array_pop($content);

	$content = implode(" ",$content);

    $content = strip_tags($content, '<p><a><address><a><abbr><acronym><b><big><blockquote><br><caption><cite><class><code><col><del><dd><div><dl><dt><em><font><h1><h2><h3><h4><h5><h6><hr><i><img><ins><kbd><li><ol><p><pre><q><s><span><strike><strong><sub><sup><table><tbody><td><tfoot><tr><tt><ul><var>');

      echo "<p>";

      echo close_tags($content);

      echo "...&nbsp;<strong><a href='";

      the_permalink();

      echo "'>".$more_link_text."</a></strong></p>";

}

/////////////////////////////////////
// Comments
/////////////////////////////////////

function resport_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">


		<div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
			<div class="comment-inner">

				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 40 ); ?>
				</div>

				<div class="commentmeta">
					<p class="comment-meta-1">
						<?php printf( __( '%s '), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</p>
					<p class="comment-meta-2">
						<?php echo get_comment_date(); ?> <?php _e( 'at', 'advanced'); ?> <?php echo get_comment_time(); ?>
						<?php edit_comment_link( __( 'Edit', 'advanced'), '(' , ')'); ?>
					</p>

				</div>

				<div class="text">

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="waiting_approval"><?php _e( 'Your comment is awaiting moderation.', 'advanced' ); ?></p>
					<?php endif; ?>

					<div class="c">
						<?php comment_text(); ?>
					</div>

				</div><!-- .text  -->
				<div class="clear"></div>
				<div class="comment-reply"><span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span></div>
			</div><!-- comment-inner  -->
		</div><!-- comment-wrapper  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'advanced' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'advanced' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

/////////////////////////////////////
// Popular Posts
/////////////////////////////////////

function popularPosts($num) {
    global $wpdb;

    $posts = $wpdb->get_results("SELECT comment_count, ID, post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $num");

    foreach ($posts as $post) {
        setup_postdata($post);
        $id = $post->ID;
        $title = $post->post_title;
        $count = $post->comment_count;

        if ($count != 0) {
            $popular .= '<li>';
            $popular .= '<a href="' . get_permalink($id) . '" title="' . $title . '">' . $title . '</a> ';
            $popular .= '</li>';
        }
    }
    return $popular;
}

/////////////////////////////////////
// Related Posts
/////////////////////////////////////

function getRelatedPosts( $count=4) {
    global $post;
    $orig_post = $post;

    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
        $args=array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page'=> $count, // Number of related posts that will be shown.
            'ignore_sticky_posts'=>1
        );
        $my_query = new WP_Query( $args );
        if( $my_query->have_posts() ) { ?>
            <div class="small-cat">
            <h2 class="section top-20"><span class="section">Related Posts</span></h2>
		<div class="small-cat-story"><ul>
            <?php
            while( $my_query->have_posts() ) {
            $my_query->the_post(); ?>
            <li>
                <div class="img-story">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><?php the_post_thumbnail('small-thumb'); ?></a>
			<?php } else { ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="img-shadow"><img src="<?php echo bloginfo('template_url'); ?>/images/default145.jpg" /></a>
			<?php } ?>
		</div><!--img-story-->
		<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
            </li>
            <?php }
            echo '</ul></div></div>';
        }
    }
    $post = $orig_post;
    wp_reset_query();
}

/////////////////////////////////////
// Miscellaneous
/////////////////////////////////////

// Set Content Width
if ( ! isset( $content_width ) ) $content_width = 610;

// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );

?>