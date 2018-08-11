<?php
/**
 * Include ACF Flexible Components for the Flexible Content Page.
 *
 * @package Panda3D
 */

function panda3d_display_flexible_content() {
	while ( have_rows('flexible_content') ) : the_row();
		// Check which component we're trying to view
		if ( get_row_layout() == 'hero' ) {
			include 'flexible-components/hero.php';
		} elseif ( get_row_layout() == 'features' ) {
			include 'flexible-components/features.php';
		} elseif ( get_row_layout() == 'call_to_action' ) {
			include 'flexible-components/calltoaction.php';
		} elseif ( get_row_layout() == 'plan' ) {
			include 'flexible-components/plan.php';
		} elseif ( get_row_layout() == 'blog_posts' ) {
			include 'flexible-components/blog-posts.php';
		} elseif ( get_row_layout() == 'brand_showcase' ) {
			include 'flexible-components/brand-showcase.php';
		}
	endwhile;
}
