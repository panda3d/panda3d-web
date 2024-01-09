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

$sphinx_link = manual_sphinx_link();
if ($sphinx_link) {
	wp_redirect($sphinx_link, 301);
	exit;
}

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
