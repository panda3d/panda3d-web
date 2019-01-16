<?php
/**
 * Header template for download pages.
 *
 * @package Panda3D
 */

$is_runtime = ($latest_category->slug === 'runtime');
$is_obsolete = (($is_runtime) || (is_single() && !$is_latest));
?>

<header class="download__header <?php if($is_obsolete) { echo 'download__header--obsolete'; } ?>">
    <div class="download__header-container">

        <div class="download__recommended">
            <h1>Download the Panda3D <?php echo $latest_category->name; ?></h1>

            <?php if (is_single()) { ?>

                <?php if($is_latest) { ?>
                    <?php if ($is_runtime) { ?>
                        <p>The last version of the Panda3D Runtime, released on <?php echo get_the_date(); ?>. The Panda3D Runtime is now deprecated and will not have any new releases. Please download the <a href="<?php echo get_post_type_archive_link('download'); ?>">Panda3D SDK</a> instead.</p>
                    <?php } else { ?>
                        <p>The latest and most stable release of the Panda3D SDK, released on <?php echo get_the_date(); ?>. Recommended for production use.</p>
                    <?php } ?>
                <?php } else { ?>
                    <?php $latest_release_date = date_i18n(get_option('date_format'), strtotime($latest_download['post_date'])); ?>
                    <p>This version of the Panda3D <?php echo $latest_category->name; ?> was released on <?php echo get_the_date(); ?> and is now obsolete. The <a href="<?php echo get_permalink($latest_id); ?>">most recent version</a> was released on <?php echo $latest_release_date; ?>. Use at your own risk.</p>
                <?php } ?>

                <?php
                // Attempt to determine primary download from the user's OS
                if(have_rows('downloads')) {
                    while(have_rows('downloads')): the_row();
                        $os_id = getOSIdentifier();
                        $os_icon = $os_data[$os_id][1];
                        $primary_download = get_sub_field($os_id);
                    endwhile;
                }
                ?>

                <p>
                    <a class="cta cta--primary-ver" href="<?php echo $primary_download[0]['download_url']; ?>">
                        <span class="cta-ver"><?php echo get_the_title(); ?></span>
                        <span class="cta-text"><i class="<?php echo $os_icon; ?>"></i> <?php echo $primary_download[0]['download_label']; ?></span>
                    </a>
                </p>

                <?php if($is_runtime) { ?>
                    <p><a href="<?php echo get_term_link($latest_category); ?>">...Or choose a different version.</a></p>
                <?php } else { ?>
                    <p><a href="<?php echo get_post_type_archive_link('download'); ?>">...Or choose a different version.</a></p>
                <?php } ?>

            <?php } else { ?>

                <?php if ($is_runtime) { ?>
                    <p>The Panda3D Runtime was used for running .p3d files, however it is now deprecated. The last version was <?php echo $latest_version; ?>, which was released on <?php echo $latest_release_date; ?>.</p>
                <?php } else { ?>
                    <p>The latest and most stable release of the Panda3D SDK is <?php echo $latest_version; ?>, which released on <?php echo $latest_release_date; ?>. This is the recommended version for production use.</p>
                <?php } ?>

                <p>
                    <a class="cta cta--primary-ver" href="<?php echo get_permalink($latest_id); ?>">
                        <span class="cta-ver"><?php echo $latest_title; ?></span>
                        <span class="cta-text">Get the Latest <?php echo $latest_category->name; ?></span>
                    </a>
                </p>
                <?php if ($is_runtime) { ?>
                    <p><a href="<?php echo get_post_type_archive_link('download'); ?>">...Or click here to get the SDK instead.</a></p>
                <?php } ?>

            <?php } ?>
        </div>

        <div class="download__icon">
            <?php if ($is_runtime) { ?>
                <i class="fas fa-minus-hexagon"></i>
            <?php } else { ?>
                <i class="fas fa-cloud-download-alt"></i>
            <?php } ?>
        </div>

    </div>
</header>

<?php
