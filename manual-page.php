<?php
/**
 * Template Name: Manual Page
 * Description: Temporary solution to serve up manual pages
 *
 * @package Panda3D
 */

// For remembering language
session_start();

require get_template_directory() . '/inc/manual/functions.php';

$redirect = manual_redirect();
if ($redirect) {
	wp_redirect(manual_permalink($redirect), 301);
	exit;
}

get_header();

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		get_template_part( 'template-parts/content-manual', 'page' );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
