<?php
/**
 * Template Name: Flexible Content Page
 * Description: Used to display content from the Advanced Custom Fields Flexible
 * Content field group.
 *
 * @package Panda3D
 */

get_header();
panda3d_display_flexible_content();
get_sidebar();
get_footer();

add_action( 'the_post', 'panda3d_display_flexible_content' );
