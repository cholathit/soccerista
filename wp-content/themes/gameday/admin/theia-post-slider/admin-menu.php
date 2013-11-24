<?php
/*
 * Copyright 2012, Theia Post Slider, Liviu Cristian Mirea Ghiban.
 */

add_action('admin_init', 'TpsMenu::admin_init');
add_action('admin_menu', 'TpsMenu::admin_menu');

class TpsMenu {
	public static function admin_init() {
		register_setting('tps_options', 'tps_general', 'TpsMenu::validate');
	}

	public static function admin_menu() {
		if (TPS_USE_AS_STANDALONE) {
			add_theme_page('Theia Post Slider Settings', 'Theia Post Slider', 'manage_options', 'tps', 'TpsMenu::do_page');
		}
	}

	public static function do_page() {
		?>
    <div class="wrap" xmlns="http://www.w3.org/1999/html">
			<div id="icon-options-general" class="icon32"><br></div>
			<h2>Theia Post Slider</h2>
			<form method="post" action="options.php">
				<?php settings_fields('tps_options'); ?>
				<?php $options = get_option('tps_general'); ?>
				<h3><?php _e("General Settings", 'theia-post-slider'); ?></h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="tps_theme"><?php _e("Theme:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<select id="tps_theme" name="tps_general[theme]" onchange="updateSlider()">
								<?php
								foreach (TpsOptions::getThemes() as $key => $value) {
									$output = '<option value="' . $key . '"' . ($key == $options['theme'] ? ' selected' : '') . '>' .$value . '</option>' . "\n";
									echo $output;
								}
								?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="tps_transition_effect"><?php _e("Transition effect:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<select id="tps_transition_effect" name="tps_general[transition_effect]" onchange="updateSlider()">
								<?php
								foreach (TpsOptions::getTransitionEffects() as $key => $value) {
									$output = '<option value="' . $key . '"' . ($key == $options['transition_effect'] ? ' selected' : '') . '>' .$value . '</option>' . "\n";
									echo $output;
								}
								?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="tps_transition_speed"><?php _e("Transition duration (ms):", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<input type="text" id="tps_transition_speed" name="tps_general[transition_speed]" value="<?php echo $options['transition_speed']; ?>" class="regular-text" onchange="updateSlider()"/>
						</td>
					</tr>
				</table>

				<h3><?php _e("Navigation Bar Settings", 'theia-post-slider'); ?></h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="tps_navigation_text"><?php _e("Navigation text:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<input type="text" id="tps_navigation_text" name="tps_general[navigation_text]" value="<?php echo $options['navigation_text']; ?>" class="regular-text" onchange="updateSlider()"/>
							<p class="description">Variables: <b>%{currentSlide}</b> and <b>%{totalSlides}</b></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="tps_prev_button_text"><?php _e("Previous button text:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<input type="text" id="tps_prev_button_text" name="tps_general[prev_text]" value="<?php echo $options['prev_text']; ?>" class="regular-text" onchange="updateSlider()"/>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="tps_next_button_text"><?php _e("Next button text:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<input type="text" id="tps_next_button_text" name="tps_general[next_text]" value="<?php echo $options['next_text']; ?>" class="regular-text" onchange="updateSlider()"/>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="tps_button_width"><?php _e("Button width (px):", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<input type="text" id="tps_button_width" name="tps_general[button_width]" value="<?php echo $options['button_width']; ?>" class="regular-text" onchange="updateSlider()"/>
							<p class="description">Use this if you want both buttons to have the same width. Insert "0" for no fixed width.</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="tps_nav_horizontal_position"><?php _e("Horizontal position:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<select id="tps_nav_horizontal_position" name="tps_general[nav_horizontal_position]" onchange="updateSlider()">
								<?php
								foreach (TpsOptions::getButtonHorizontalPositions() as $key => $value) {
									$output = '<option value="' . $key . '"' . ($key == $options['nav_horizontal_position'] ? ' selected' : '') . '>' .$value . '</option>' . "\n";
									echo $output;
								}
								?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="tps_nav_vertical_position"><?php _e("Vertical position:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<select id="tps_nav_vertical_position" name="tps_general[nav_vertical_position]" onchange="updateSlider()">
								<?php
								foreach (TpsOptions::getButtonVerticalPositions() as $key => $value) {
									$output = '<option value="' . $key . '"' . ($key == $options['nav_vertical_position'] ? ' selected' : '') . '>' .$value . '</option>' . "\n";
									echo $output;
								}
								?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label><?php _e("Button behavior:", 'theia-post-slider'); ?></label>
						</th>
						<td>
							<label>
								<input type="checkbox" name="tps_general[post_navigation]" value="true"<?php echo $options['post_navigation'] ? ' checked' : ''?>> Enable additional post navigation
							</label>
							<p class="description">Clicking the "previous" button on the <b>first</b> slide will open the previous post, and clicking the "next" button on the <b>last</b> slide will open the next post.</p>

							<label>
								<input type="checkbox" name="tps_general[refresh_page_on_slide]" value="true"<?php echo $options['refresh_page_on_slide'] ? ' checked' : ''?>> Refresh page on each slide
							</label>
							<p class="description">The page will refresh on each displayed slide. This is useful, for example, if you want your ads to reload on each slide. Transition effects cannot be used with this option.</p>

							<label>
								<input type="checkbox" name="tps_general[enable_on_pages]" value="true"<?php echo $options['enable_on_pages'] ? ' checked' : ''?>> Enable slider on pages
							</label>
							<p class="description">By default, the slider is enabled only on <b>posts</b>. This will enable it also on <b>pages</b>. Note that some themes may be incompatible with this option.</p>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save All Changes', 'theia-post-slider') ?>" />
				</p>
			</form>

			<h3><?php _e("Live Preview", 'theia-post-slider'); ?></h3>
			<div class="theiaPostSlider_adminPreview">
				<?php
				echo TpsMisc::getNavigationBar(array(
					'currentSlide' => 1,
					'totalSlides' => 3,
					'id' => 'tps_nav_upper',
					'class' => '_upper',
					'style' => in_array(TpsOptions::get('nav_vertical_position'), array('top_and_bottom', 'top')) ? '' : 'display: none'
				));
				?>
				<div id="tps_dest" class="theiaPostSlider_slides"></div>
				<div id="tps_src" class="theiaPostSlider_slides">
					<?php include dirname(__FILE__) . '/preview-slider.php'; ?>
				</div>
				<?php
				echo TpsMisc::getNavigationBar(array(
					'currentSlide' => 1,
					'totalSlides' => 3,
					'id' => 'tps_nav_lower',
					'class' => '_lower',
					'style' => in_array(TpsOptions::get('nav_vertical_position'), array('top_and_bottom', 'bottom')) ? '' : 'display: none'
				));
				?>
				<script type='text/javascript'>
					var slider, theme;
					jQuery(document).ready(function() {
						slider = new tps.createSlideshow({
							'src': '#tps_src > div',
							'dest': '#tps_dest',
							'nav': ['#tps_nav_upper', '#tps_nav_lower'],
							'navText': '<?php echo TpsOptions::get('navigation_text') ?>',
							'transitionEffect': '<?php echo TpsOptions::get('transition_effect') ?>',
							'transitionSpeed': <?php echo TpsOptions::get('transition_speed') ?>,
							'keyboardShortcuts': true
						});
					});

					function updateSlider() {
						var $ = jQuery;

						// Update transition
						slider.setTransition({
							'effect': $('#tps_transition_effect').val(),
							'speed': parseInt($('#tps_transition_speed').val())
						});

						// Update navigation text
						slider.setNavText($('#tps_navigation_text').val());

						// Update button text
						$('.theiaPostSlider_nav ._prev ._2').html($('#tps_prev_button_text').val());
						$('.theiaPostSlider_nav ._next ._2').html($('#tps_next_button_text').val());

						// Update button width
						var width = parseInt($('#tps_button_width').val());
						$('.theiaPostSlider_nav ._2').css('width', width > 0 ? width : '');

						// Update horizontal position
						$('#tps_nav_upper, #tps_nav_lower')
							.removeClass('_left _center _right')
							.addClass('_' + $('#tps_nav_horizontal_position').val());

						// Update vertical position
						$('#tps_nav_upper').toggle(['top_and_bottom', 'top'].indexOf($('#tps_nav_vertical_position').val()) != -1);
						$('#tps_nav_lower').toggle(['top_and_bottom', 'bottom'].indexOf($('#tps_nav_vertical_position').val()) != -1);

						// Update theme
						var css = $('#theiaPostSlider-css');
						var href = '<?php echo TPS_PLUGINS_URL . 'css/' ?>' + $('#tps_theme').val() + '?ver=<?php echo TPS_VERSION ?>';
						if (css.attr('href') != href) {
							css.attr('href', href);
						}
					}
				</script>
			</div>

			<h3><?php _e("Credits", 'theia-post-slider'); ?></h3>
			Many thanks go out to the following:
			<ul>
				<li><a href="http://www.doublejdesign.co.uk/products-page/icons/super-mono-icons/">Super Mono Icons</a> by <a href="http://www.doublejdesign.co.uk/">Double-J Design</a></li>
				<li><a href="http://p.yusukekamiyamane.com/">Fugue Icons</a> by <a href="http://yusukekamiyamane.com/">Yusuke Kamiyamane</a></li>
				<li><a href="http://www.brightmix.com/blog/brightmix-icon-set-free-for-all/">Brightmix icon set</a> by <a href="http://www.brightmix.com">Brightmix</a></li>
				<li><a href="http://freebiesbooth.com/hand-drawn-web-icons">Hand Drawn Web icons</a> by <a href="http://highonpixels.com/">Pawel Kadysz</a></li>
				<li><a href="http://icondock.com/free/20-free-marker-style-icons">20 Free Marker-Style Icons</a> by <a href="http://icondock.com">IconDock</a></li>
				<li><a href="http://taytel.deviantart.com/art/ORB-Icons-87934875">ORB Icons</a> by <a href="http://taytel.deviantart.com">~taytel</a></li>
				<li><a href="http://www.visualpharm.com/must_have_icon_set/">Must Have Icon Set</a> by <a href="http://www.visualpharm.com">VisualPharm</a></li>
	            <li><a href="http://github.com/balupton/History.js/">The History.js project</a></li>
	            <li><a href="http://jquery.com/">The jQuery.js project</a></li>
			</ul>
		</div>
		<?php
	}

	public static function validate($input) {
		return $input;
	}
}