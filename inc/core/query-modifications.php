<?php
/**
 * Modifications of the main query
 *
 * @package Panda3D
 */

function panda3d_pre_get_posts($query) {
    // Only display SDK downloads on the download archive page
    if(is_post_type_archive('download') && !is_admin() && $query->is_main_query()) {
         $query->set('tax_query', array(
            array(
                'taxonomy' => 'download_category',
                'field'    => 'slug',
                'terms'    => 'sdk'
            )
        ));
    }
}
add_action( 'pre_get_posts','panda3d_pre_get_posts' );
