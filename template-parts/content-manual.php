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



	<div class="entry-content">
        <div class="block block--info block--warning">
            <div class="block__icon">
                <i class="fas fa-tools"></i>
            </div>
            <div class="block__content">
                <h3>Don't mind the mess!</h3>
                <p>We're currently in the process of migrating the Panda3D Manual to a new service. This is a temporary layout in the meantime.</p>
            </div>
        </div>

        <div class="block">
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
        </div>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
        <?php
        panda3d_entry_footer();
        the_post_navigation();
        ?>
	</footer> -->
</article>
