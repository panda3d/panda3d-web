<?php
/**
 * Set up Advanced Custom Fields options page for the ACP.
 *
 * @package Panda3D
 */

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
		'page_title' 	=> 'Panda3D Download Management',
		'menu_title'	=> 'P3D Downloads',
        'menu_slug' 	=> 'panda3d-downloads',
        'icon_url'      => 'dashicons-download',
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Panda3D Theme Settings',
		'menu_title'	=> 'P3D Theme',
		'menu_slug' 	=> 'panda3d-theme-settings',
    ));
}
