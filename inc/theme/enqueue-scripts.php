<?php
/**
 * Enqueue scripts and styles.
 */
function panda3d_scripts() {
	// Vendor
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '2018518', true );

	// Theme
	wp_enqueue_style( 'panda3d-style', get_stylesheet_uri() );
	wp_enqueue_script( 'panda3d-js', get_template_directory_uri() . '/bundle.min.js', array(), '2018518', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Fonts
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto:100,400,700', array(), '2018518', true );
}
add_action( 'wp_enqueue_scripts', 'panda3d_scripts' );
