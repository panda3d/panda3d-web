<?php
/**
 * The template for displaying download archive pages.
 *
 * @package Panda3D
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <?php if (have_posts()) { ?>

            <?php
            $latest_id = get_the_ID();
            $latest_version = get_field('version_number', $latest_id);
            $latest_title = get_the_title();
            $latest_release_date = date_i18n(get_option('date_format'), strtotime(get_the_date()));
            $latest_category = get_the_terms(get_the_ID(), 'download_category')[0];
            ?>

            <?php include(locate_template('template-parts/downloads/download-header.php')); ?>

            <div class="archive-download__content">
                <?php include(locate_template('template-parts/downloads/download-list.php')); ?>

                <?php if (!is_tax('download_category', 'runtime')) { ?>
                    <h1>Development Builds</h1>
                    <div class="block block--info">
                        <div class="block__icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <div class="block__content">
                            <p>If you wish to try out an in-development version of Panda3D, you can find preview builds of Panda3D at <a href="/download.php?version=devel">this link</a>. But be careful, these builds may be unstable!</p>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!is_tax('download_category', 'runtime')) { ?>
                    <h1>Runtime</h1>
                    <div class="block block--info block--warning">
                        <div class="block__icon">
                            <i class="fas fa-minus-hexagon"></i>
                        </div>
                        <div class="block__content">
                            <p>The Panda3D Runtime, used to run .p3d files, is now deprecated. You can access archived versions at <a href="/download/runtime">this link</a>.</p>
                        </div>
                    </div>
                <?php } ?>
            </div>

        <?php } else { ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php } ?>

		</main>
	</div>

<?php
get_footer();
