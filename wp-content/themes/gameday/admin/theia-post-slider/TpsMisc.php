<?php
/*
 * Copyright 2012, Theia Post Slider, Liviu Cristian Mirea Ghiban.
 */

class TpsMisc {
    public static
        $beginComment = '<!-- BEGIN THEIA POST SLIDER -->',
        $endComment = '<!-- END THEIA POST SLIDER -->',
        // Set this to true to prevent the_content() from calling itself in an infinite loop.
        $theContentIsCalled = false,
        // The posts for which we have enabled the slider (i.e. the script has been appended).
        $postsWithSlider = array();

    /*
     * We want to enable sliders only for the main post on a post page. This usually means that is_singular() returns true
     * (i.e. the query is for only one post). But, some themes have single queries used only to display the excerpts.
     * So, here we'll prepare the post for sliders, but these sliders will be activated only if the_content() is also
     * called.
     */
    public static function the_post($post) {
        global $post, $page, $pages, $multipage;

        // Get previous and next posts.
        if (TpsOptions::get('post_navigation')) {
            $prevPost = self::getPrevNextPost(true);
            $nextPost = self::getPrevNextPost(false);
        }
        else {
            $prevPost = null;
            $nextPost = null;
        }

        /*
         * Prepare the sliders if
         * a) This is a single post with multiple pages.
         * - OR -
         * b) Previous/next post navigation is enabled and we do have a previous or a next post.
         */
        if (!((
            self::isCompatiblePost() && $multipage
        ) || (
            $prevPost || $nextPost
        ))) {
            return;
        }

        // Save some variables that we'll also use in the_content()
        $post->theiaPostSlider = array(
            'srcId' => 'tps_src_' . $post->ID,
            'destId' => 'tps_dest_' . $post->ID,
            'navIdUpper' => 'tps_nav_upper_' . $post->ID,
            'navIdLower' => 'tps_nav_lower_' . $post->ID,
            'prevPost' => $prevPost,
            'nextPost' => $nextPost
        );

        // Add sliders to the page.
        $content = '';
        // Top slider
        if (in_array(TpsOptions::get('nav_vertical_position'), array('top_and_bottom', 'top'))) {
            $content .= TpsMisc::getNavigationBar(array(
                'currentSlide' => $page,
                'totalSlides' => count($pages),
                'prevPost' => $prevPost,
                'nextPost' => $nextPost,
                'id' => $post->theiaPostSlider['navIdUpper'],
                'class' => '_upper'
            ));
        }
        $content .= '<div id="' . $post->theiaPostSlider['destId'] . '" class="theiaPostSlider_slides"></div>';
        $content .= '<div id="' . $post->theiaPostSlider['srcId'] . '" class="theiaPostSlider_slides"><div>';
        $content .= "\n\n" . trim($pages[$page - 1]) . "\n\n";
        $content .= '</div></div>';
        // Bottom slider
        if (in_array(TpsOptions::get('nav_vertical_position'), array('top_and_bottom', 'bottom'))) {
            $content .= TpsMisc::getNavigationBar(array(
                'currentSlide' => $page,
                'totalSlides' => count($pages),
                'prevPost' => $prevPost,
                'nextPost' => $nextPost,
                'id' => $post->theiaPostSlider['navIdLower'],
                'class' => '_lower'
            ));
        }

        // Save the page.
        $pages[$page - 1] = $content;

        // Set this to false so that the theme doesn't display pagination buttons. Kind of a hack.
        $multipage = false;
    }

    /*
     * Append the JavaScript code only if the_content is called (i.e. the whole post is being displayed, not just the
     * excerpt).
     */
    public static function the_content($content) {
        global $post, $page, $pages, $multipage;

        if (!isset($post) || !property_exists($post, 'theiaPostSlider')) {
            return $content;
        }

        // Prevent this function from calling itself.
        if (self::$theContentIsCalled) {
            return $content;
        }
        self::$theContentIsCalled = true;

        $currentPage = min(max($page, 1), count($pages));

        // Get all slides except the current one, which will be echoed as actual HTML.
        $slides = array();
        for ($i = 1; $i <= count($pages); $i++) {
            $page = $i;
            $slide = array();
            $slide['title'] = self::getPageTitle();
            $slide['permalink'] = self::getPostPageUrl($i);
            if ($i != $currentPage) {
                // Get the content.
                $slideContent = self::$beginComment . get_the_content() . self::$endComment;
                $slideContent = apply_filters('the_content', $slideContent);
                $slideContent = str_replace(']]>', ']]&gt;', $slideContent);

                /*
                 * Leave only the actual text. Aditional headers or footers will be discarded. Plugins like "video quicktags"
                 * will be left intact, while plugins like "related posts thumbnails" and "better author bio" will be discarded.
                 */
                $begin = mb_strpos($slideContent, self::$beginComment);
                $end = mb_strpos($slideContent, self::$endComment);
                if ($begin !== false && $end !== false) {

                    // Preserve beginning <p> tag.
                    if (mb_substr($slideContent, $begin - 3, 3) == '<p>') {
                        if (mb_substr($slideContent, $begin + mb_strlen(self::$beginComment), 4) == '</p>') {
                            $begin += mb_strlen(self::$beginComment) + 4;
                        }
                        else {
                            $begin -= 3;
                        }
                    }
                    else {
                        $begin += mb_strlen(self::$beginComment);
                    }

                    // Preserve ending <p> tag.
                    if (mb_substr($slideContent, $end + mb_strlen(self::$endComment), 4) == '</p>') {
                        if (mb_substr($slideContent, $end - 3, 3) == '<p>') {
                            $end -= 3;
                        }
                        else {
                            $end += mb_strlen(self::$endComment) + 4;
                        }
                    }

                    // Cut!
                    $slideContent = mb_substr($slideContent, $begin, $end - $begin);
                }

                // Trim left and right whitespaces.
                $slideContent = trim($slideContent);

                /*
                 * Bug fix for WordPress. Sometimes it adds an invalid "</p>" closing tag at the beginning and/or an
                 * opening "<p>" tag at the end.
                 */
                if (mb_substr($slideContent, 0, 4) == '</p>') {
                    $slideContent = mb_substr($slideContent, 4);
                }
                if (mb_substr($slideContent, -3) == '<p>') {
                    $slideContent = mb_substr($slideContent, 0, -3);
                }
                $slide['content'] = $slideContent;
            }
            $slides[$i - 1] = $slide;
        }
        $page = $currentPage;

        // Append the slider initialization script to the "theiaPostSlider.js" script.
        if (
            TpsOptions::get('refresh_page_on_slide') == false &&
            in_array($post->ID, self::$postsWithSlider) == false
        ) {
            $script = "
                jQuery(document).ready(function() {
                    var p = new tps.createSlideshow({
                        'src': '#" . $post->theiaPostSlider['srcId'] . " > div',
                        'dest': '#" . $post->theiaPostSlider['destId'] . "',
                        'nav': " . json_encode(array('#' . $post->theiaPostSlider['navIdUpper'], '#' . $post->theiaPostSlider['navIdLower'])) . ",
                        'navText': '" . TpsOptions::get('navigation_text') . "',
                        'defaultSlide': " . ($currentPage - 1) . ",
                        'transitionEffect': '" . TpsOptions::get('transition_effect') . "',
                        'transitionSpeed': " . TpsOptions::get('transition_speed') . ",
                        'keyboardShortcuts': " . (self::isCompatiblePost() ? 'true' : 'false') . ",
                        'slides': " . json_encode($slides) . ",
                        'prevPost': " . json_encode($post->theiaPostSlider['prevPost']) . ",
                        'nextPost': " . json_encode($post->theiaPostSlider['nextPost']) . "
                    });
                });
            ";
            global $wp_scripts;
            $data = $wp_scripts->get_data('theiaPostSlider.js', 'data');
            if ($data) {
                $script = "$data\n$script";
            }
            $wp_scripts->add_data('theiaPostSlider.js', 'data', $script);
            self::$postsWithSlider[] = $post->ID;
        }

        // Return the unchanged content.
        self::$theContentIsCalled = false;
        return $content;
    }

    // Is this post a "post" or a "page" (i.e. should we display the slider)?
    public static function isCompatiblePost() {
        return
            TpsOptions::get('enable_on_pages') ?
            is_single() || is_page() :
            is_single();
    }

    // Get HTML for a navigation bar.
    public static function getNavigationBar($options) {
        $defaults = array(
            'currentSlide' => null,
            'totalSlides' => null,
            'prevPost' => null,
            'nextPost' => null,
            'id' => null,
            'class' => null,
            'style' => null
        );
        $options = array_merge($defaults, $options);

        // Get button text
        $text = TpsOptions::get('navigation_text');
        $text = str_replace('%{currentSlide}', $options['currentSlide'], $text);
        $text = str_replace('%{totalSlides}', $options['totalSlides'], $text);

        // Get button URLs
        $prevUrl = self::getPostPageUrl($options['currentSlide'] - 1);
        if (!$prevUrl) {
            $prevUrl = $options['prevPost'];
        }
        $nextUrl = self::getPostPageUrl($options['currentSlide'] + 1);
        if (!$nextUrl) {
            $nextUrl = $options['nextPost'];
        }

        $style = TpsOptions::get('button_width') == 0 ? '' : 'style="width: ' . TpsOptions::get('button_width') . 'px"';
        $htmlPart1 = '<span class="_1"></span><span class="_2" ' . $style . '>';
        $htmlPart2 = '</span><span class="_3"></span>';

        // HTML for previous button
        $html = $htmlPart1 . TpsOptions::get('prev_text') . $htmlPart2;
        if ($prevUrl) {
            $prev = '<a href="' . $prevUrl . '" class="_prev">' . $html . '</a>';
        }
        else {
            $prev = '<span class="_prev _disabled">' . $html . '</span>';
        }

        // HTML for next button
        $html = $htmlPart1 . TpsOptions::get('next_text') . $htmlPart2;
        if ($nextUrl) {
            $next = '<a href="' . $nextUrl . '" class="_next">' . $html . '</a>';
        }
        else {
            $next = '<span class="_next _disabled">' . $html . '</span>';
        }

        // Final HTML
        $class = array('theiaPostSlider_nav');
        $class[] = '_' . TpsOptions::get('nav_horizontal_position');
        if ($options['class'] != null) {
            $class[] = $options['class'];
        }

        $html =
            '<div' . ($options['id'] !== null ? ' id="' . $options['id'] . '"' : '') . ($options['style'] !== null ? ' style="' . $options['style'] . '"' : '') . ' class="' . implode($class, ' ') . '">' .
            $prev . '<span class="_text">' . $text . '</span>' . $next .
            '</div>';

        return $html;
    }

    // Get the previous or next post.
    public static function getPrevNextPost($previous) {
        if ($previous && is_attachment()) {
            $post = & get_post($GLOBALS['post']->post_parent);
        }
        else {
            $post = get_adjacent_post(false, '', $previous);
        }

        if (!$post) {
            return null;
        }

        return get_permalink($post);
    }

    // Add the "next page" button to the post editor.
    public static function wysiwyg_editor($mce_buttons) {
        $pos = array_search('wp_more', $mce_buttons, true);
        if ($pos !== false) {
            $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
            $tmp_buttons[] = 'wp_page';
            $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
        }
        return $mce_buttons;
    }

    // Get the URL of a post's page.
    public static function getPostPageUrl($i) {
        global $post, $wp_rewrite, $pages;
        if ($i < 1 || $i > count($pages)) {
            return null;
        }
        if ( 1 == $i ) {
            $url = get_permalink();
        } else {
            if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
                $url = add_query_arg( 'page', $i, get_permalink() );
            elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
                $url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
            else
                $url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
        }
        return $url;
    }

    /**
     * Tries to get the correct title of the page. Very hackish, but there's no other way.
     * @return string
     */
    public static function getPageTitle() {
        // Set the current page of the WP query since it's used by SEO plugins.
        global $wp_query, $page;
        $oldPage = $wp_query->get('page');
        if ($page > 1) {
            $wp_query->set('page', $page);
        }
        else {
            $wp_query->set('page', null);
        }

        // Get the title.
        $title = self::getPageTitleHelper();
        $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');

        // Set back the current page.
        $wp_query->set('page', $oldPage);

        // Return the title.
        return $title;
    }

    private static function getPageTitleHelper() {
        // If the WordPress SEO plugin is active and compatible.
        global $wpseo_front;
        if (
            isset($wpseo_front) &&
            method_exists($wpseo_front, 'title')
        ) {
            return $wpseo_front->title('', false);
        }

        // If the SEO Ultimate plugin is active and compatible.
        global $seo_ultimate;
        if (
            isset($seo_ultimate) &&
            property_exists($seo_ultimate, 'modules') &&
            isset($seo_ultimate->modules['titles']) &&
            method_exists($seo_ultimate->modules['titles'], 'get_title')
        ) {
            @$title = $seo_ultimate->modules['titles']->get_title();
	        return $title;
        }

        // If all else fails, return the standard WordPress title. Unfortunately, most theme hard-code their <title> tag.
        return wp_title('', false);
    }

    // Enqueue the required JavaScript for a given transition effect.
    public static function enqueueTransition($transition) {
        wp_register_script('theiaPostSlider-transition-' . $transition . '.js', TPS_PLUGINS_URL . 'js/tps-transition-' . $transition . '.js', array( 'jquery'), TPS_VERSION);
        wp_enqueue_script('theiaPostSlider-transition-' . $transition . '.js');
    }

    // Enqueue JavaScript and CSS.
    public static function wp_enqueue_scripts() {
        // CSS
        if (TpsOptions::get('theme') != 'none') {
            wp_register_style('theiaPostSlider', TPS_PLUGINS_URL . 'css/' . TpsOptions::get('theme'), TPS_VERSION);
            wp_enqueue_style('theiaPostSlider');
        }

        // jQuery
        //wp_register_script('jquery', TPS_PLUGINS_URL . 'js/jquery-1.8.0.min.js', '1.8.0');
        //wp_enqueue_script('jquery');

        // history.js
        wp_register_script('history.js', TPS_PLUGINS_URL . 'js/balupton-history.js/history.js', array('jquery'), '1.7.1');
        wp_enqueue_script('history.js');
        wp_register_script('history.adapter.jquery.js', TPS_PLUGINS_URL . 'js/balupton-history.js/history.adapter.jquery.js', array('jquery', 'history.js'), '1.7.1');
        wp_enqueue_script('history.adapter.jquery.js');

        // The slider
        wp_register_script('theiaPostSlider.js', TPS_PLUGINS_URL . 'js/tps.js', array('jquery'), TPS_VERSION, true);
        wp_enqueue_script('theiaPostSlider.js');

        // The selected transition effect
        self::enqueueTransition(TpsOptions::get('transition_effect'));
    }

    // Enqueue JavaScript and CSS for the admin interface.
    public static function admin_enqueue_scripts() {
        self::wp_enqueue_scripts();

        foreach (TpsOptions::getTransitionEffects() as $key => $value) {
            self::enqueueTransition($key);
        }

        // CSS, even if there is no theme, so we can change the path via JS.
        if (TpsOptions::get('theme') == 'none') {
            wp_register_style('theiaPostSlider', TPS_PLUGINS_URL . 'css/' . TpsOptions::get('theme'), TPS_VERSION);
            wp_enqueue_style('theiaPostSlider');
        }

        // Admin CSS
        wp_register_style('theiaPostSlider-admin', TPS_PLUGINS_URL . 'css/admin.css', TPS_VERSION);
        wp_enqueue_style('theiaPostSlider-admin');
    }

    // This improves compatibility with certain themes that also call the_content before wp_head (e.g. Telegraph2 by WPZOOM).
    public static function wp_head() {
        self::$postsWithSlider = array();
    }
}
