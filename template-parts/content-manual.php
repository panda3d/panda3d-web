<?php
/**
 * Template part for displaying manual pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Panda3D
 */

?>

<article id="manual-page" <?php post_class(); ?>>
	<header class="entry-header">
        <?php panda3d_background_image() ?>
        <div class="text-box">
            <h2 class="entry-title"><?php echo manual_title(); ?></h2>
        </div>
	</header>

	<div class="entry-content block">
		<?php
		$prev = manual_prev();
		$top = manual_top();
		$next = manual_next();
		echo '<div>';
		if ($prev) {
			echo '<a href="' . $prev . '">Previous</a> ';
		}
		if ($top) {
			echo '<a href="' . $top . '">Top</a>';
		}
		if ($next) {
			echo ' <a href="' . $next . '">Next</a>';
		}

		// Language selector
		$link = manual_permalink();
		echo ' <div style="float:right">';
		$lang = manual_language();
		if ($lang == 'python') {
			echo '<b>Python</b>';
		} else {
			echo '<a href="' . $link . '?language=python">Python</a>';
		}
		if ($lang == 'cxx') {
			echo ' <b>C++</b>';
		} else {
			echo ' <a href="' . $link . '?language=cxx">C++</a>';
		}
		echo '</div>';
		echo '</div>';

		echo manual_content();

		if ($prev) {
			echo '<a href="' . $prev . '">Previous</a> ';
		}
		if ($top) {
			echo '<a href="' . $top . '">Top</a>';
		}
		if ($next) {
			echo ' <a href="' . $next . '">Next</a>';
		}
		?>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
        <?php
        panda3d_entry_footer();
        the_post_navigation();
        ?>
	</footer> -->
</article>
