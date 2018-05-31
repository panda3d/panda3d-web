<?php
/**
 * Set up Advanced Custom Fields options page for the ACP.
 *
 * @package Panda3D
 */

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Panda3D Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'panda3d-theme-settings',
	));
}
