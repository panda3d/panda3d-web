<?php
/**
 * The template for displaying download archive pages.
 *
 *
 * @package Panda3D
 */

$latest_download = wp_get_recent_posts(array(
	'numberposts' => 1,
    'post_type' => 'download',
    'post_status' => 'publish'
))[0];

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

            <header class="download__header">
                <div class="download__header-container">

                    <div class="download__recommended">
                        <h1>Download the Panda3D SDK</h1>

                        <?php
                        $latest_id = $latest_download['ID'];
                        $latest_version = $latest_download['post_title'];
                        $latest_release_date = date_i18n(get_option('date_format'), strtotime($latest_download['post_date']));
                        ?>

                        <p>The latest and most stable release of the Panda3D SDK is <?php echo $latest_version; ?>, which was released on <?php echo $latest_release_date; ?>. This is the recommended version for production use.</p>

                        <p>
                            <a class="cta cta--primary-ver" href="<?php echo get_permalink($latest_id); ?>">
                                <span class="cta-ver"><?php echo $latest_version; ?></span>
                                <span class="cta-text">Get the Latest SDK</span>
                            </a>
                        </p>
                    </div>

                    <div class="download__icon">
                        <i class="fas fa-cloud-download-alt"></i>
                    </div>

                </div>
            </header>

            <div class="archive-download__content">
                <h1>Old Versions</h1>
                <ul class="archive-download__list block">
                    <li>
                        <span class="title">Version</span>
                        <span class="date">Release Date</span>
                    </li>
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        if(get_the_ID() === $latest_id) {
                            continue;
                        }

                        $release_date = date_i18n(get_option('date_format'), strtotime(get_field('release_date')));
                        ?>
                        <a href="<?php echo get_permalink(); ?>">
                            <li>
                                <span class="title"><?php the_title(); ?></span>
                                <span class="date"><?php the_date(); ?></span>
                            </li>
                        </a>
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
