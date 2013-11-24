<?php
/*
 * Copyright 2012, Theia Post Slider, Liviu Cristian Mirea Ghiban.
 */

class TpsOptions {
	// Get all available transition effects.
	public static function getTransitionEffects() {
		$options = array(
			'none' => 'None',
			'simple' => 'Simple',
			'slide' => 'Slide',
			'fade' => 'Fade'
		);
		return $options;
	}

	// Get button horizontal positions.
	public static function getButtonHorizontalPositions() {
		$options = array(
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right'
		);
		return $options;
	}

	// Get button vertical positions.
	public static function getButtonVerticalPositions() {
		$options = array(
			'top_and_bottom' => 'Top and bottom',
			'top' => 'Top',
			'bottom' => 'Bottom'
		);
		return $options;
	}

	// Get all available themes.
	public static function getThemes() {
		$themes = array();

		// Special files to ignore
		$ignore = array('admin.css');

		// Get themes corresponding to .css files.
		$dir = dirname(__FILE__) . '/css';
		if ($handle = opendir($dir)) {
		    while (false !== ($entry = readdir($handle))) {
			    if (in_array($entry, $ignore)) {
				    continue;
			    }

			    $file = $dir . '/' . $entry;
			    if (!is_file($file)) {
				    continue;
			    }

			    // Beautify name
			    $name = substr($entry, 0, -4); // Remove ".css"
			    $name = str_replace('--', ', ', $name);
			    $name = str_replace('-', ' ', $name);
				$name = ucwords($name);

			    // Add theme
	            $themes[$entry] = $name;
		    }
		    closedir($handle);
		}

		$themes['none'] = 'None';

		// Sort alphabetically
		asort($themes);

		return $themes;
	}

	public static function get($option) {
		$options = get_option('tps_general');
		return $options[$option];
	}

	// Initialize options
	public static function initOptions() {
		$defaults = array(
			'transition_effect' => 'slide',
			'transition_speed' => 400,
			'theme' => 'buttons-orange.css',
			'navigation_text' => '%{currentSlide} of %{totalSlides}',
			'prev_text' => 'Prev',
			'next_text' => 'Next',
			'button_width' => 0,
			'post_navigation' => false,
			'refresh_page_on_slide' => false,
			'nav_horizontal_position' => 'left',
			'nav_vertical_position' => 'top_and_bottom',
			'enable_on_pages' => false
		);
		$options = get_option('tps_general');
		$changed = false;

		// Validate options
		if (array_key_exists($options['transition_effect'], TpsOptions::getTransitionEffects()) == false) {
			$options['transition_effect'] = $defaults['transition_effect'];
			$changed = true;
		}

		if ($options['transition_speed'] < 0) {
			$options['transition_speed'] = $defaults['transition_speed'];
			$changed = true;
		}

		if ($options['button_width'] < 0) {
			$options['button_width'] = $defaults['button_width'];
			$changed = true;
		}

		// Add missing options
		foreach ($defaults as $key => $value) {
			if (isset($options[$key]) == false) {
				$changed = true;
				$options[$key] = $value;
			}
		}

		// Save options
		if ($changed) {
			update_option('tps_general', $options);
		}
	}
}