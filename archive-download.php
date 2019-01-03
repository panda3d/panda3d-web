<?php
/**
 * The template for displaying download archive pages.
 *
 *
 * @package Panda3D
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

            <div class="archive-download__content">
                <h1>Old Versions</h1>
                <ul class="block">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                        $release_date = date_i18n(get_option('date_format'), strtotime(get_field('release_date')));
                        ?>
                        <li>
                            <a href="<?php echo get_permalink(); ?>">
                                <?php the_title(); ?>
                                <?php the_date(); ?>
                            </a>
                        </li>
                        <?php
                    endwhile;
                    ?>
                </ul>
            </div>

            <?php
			the_posts_navigation();

		else:

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main>
	</div>

<?php
get_footer();
