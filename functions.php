<?php
/**
 * Panda3D functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Panda3D
 */

	/**
 * Theme Setup
	 */
require get_template_directory() . '/inc/theme/setup.php';           // Perform theme setup
require get_template_directory() . '/inc/theme/enqueue-scripts.php'; // Enqueue styles and scripts for the theme
require get_template_directory() . '/inc/theme/widget-areas.php';    // Add widget areas

		/**
 * Core Wordpress Modifications
		 */
require get_template_directory() . '/inc/core/custom-header.php';      // Implement the Custom Header feature
require get_template_directory() . '/inc/core/template-tags.php';      // Add custom template tags
require get_template_directory() . '/inc/core/template-functions.php'; // Functions which enhance the theme by hooking into WordPress
require get_template_directory() . '/inc/core/customizer.php';         // Customizer additions

.
