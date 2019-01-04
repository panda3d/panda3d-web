<?php
/**
 * Filters to edit the appearance of post excerpts
 *
 * @package Panda3D
 */

/**
 * Limit character length of post excerpts
 */
function panda3d_excerpt_length( $length ) {
    return 40;
}
add_filter('excerpt_length', 'panda3d_excerpt_length');

 /**
 * Changes the post excerpt more string to "..."
 */
function panda3d_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'panda3d_excerpt_more');
