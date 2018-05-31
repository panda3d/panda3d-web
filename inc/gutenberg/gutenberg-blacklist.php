<?php
/**
 * Disables Gutenberg editor on certain post types and page templates.
 *
 * @package Panda3D
 */

 /**
 * Check if current page ID can use the Gutenberg editor.
 */
function panda3d_page_supports_gutenberg( $id = false ) {
	// Define excluded page templates
	$excluded_templates = array(
		'flexible-content-page.php'
	);

	// Check template of current page ID
	$id = intval( $id );
	$template = get_page_template_slug( $id );
	return !in_array( $template, $excluded_templates );
}

/**
 * Override gutenberg_can_edit_post_type to check theme conditions to disable
 * Gutenberg editor.
 */
function panda3d_gutenberg_can_edit_post_type( $can_edit, $post_type ) {
	// Grab current page ID
	$id = $_GET['post'];

	// Check if page ID supports Gutenberg editor
	if( ! ( is_admin() && !empty( $id ) ) ) {
		return $can_edit;
	} else if ( ! panda3d_page_supports_gutenberg( $id ) ) {
		$can_edit = false;
	}
	return $can_edit;
}
add_filter( 'gutenberg_can_edit_post_type', 'panda3d_gutenberg_can_edit_post_type', 10, 2 );
