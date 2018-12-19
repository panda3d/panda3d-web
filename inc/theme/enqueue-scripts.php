<?php
/**
 * Enqueue scripts and styles.
 */
function panda3d_scripts() {
	// Vendor
	wp_enqueue_script('fontawesome', get_template_directory_uri() . '/assets/js/vendor/fontawesome/all.min.js', array(), '5.6.1', true);
	wp_enqueue_script('offside-js', get_template_directory_uri() . '/assets/js/vendor/offside/offside.min.js', array(), '1.4.0', true);

	// Theme
	wp_enqueue_style('panda3d-style', get_stylesheet_uri());
	wp_enqueue_script('panda3d-js', get_template_directory_uri() . '/bundle.min.js', array(), '20180518', true);

	if (is_singular() && comments_open() && get_option('thread_comments' ) ) {
		wp_enqueue_script('comment-reply');
	}

	// Fonts
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto:400,400i,700', false);
}
add_action('wp_enqueue_scripts', 'panda3d_scripts');
