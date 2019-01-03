<?php
// Get info about latest SDK version for the Call to Action
$latest_download = wp_get_recent_posts(array(
	'numberposts' => 1,
    'post_type' => 'download',
    'post_status' => 'publish'
))[0];

$latest_id = $latest_download['ID'];
$latest_version = $latest_download['post_title'];
?>

<section class="hero">
    <div class="background-image" style="background-image: url(<?php the_sub_field( 'background_image' ) ?>);"></div>
    <div class="hero__wrap">
        <div class="hero__content">

            <h1 class="text-box"><?php the_sub_field('header') ?></h1>

            <div class="hero__calltoaction">
                <?php if(get_field('primary_call_to_action', 'option')) { ?>
                    <a class="cta cta--primary-ver" href="<?php echo get_permalink($latest_id); ?>">
                        <span class="cta-ver"><?php echo $latest_version; ?></span>
                        <span class="cta-text">
                            <i class="fas fa-<?php the_field('primary_call_to_action_icon', 'option'); ?>"></i>
                            <?php the_field('primary_call_to_action_text', 'option'); ?>
                        </span>
                    </a>
                <?php } ?>

                <?php if(get_field('secondary_call_to_action', 'option')) { ?>
                    <a href="<?php the_field('secondary_call_to_action_url', 'option'); ?>" class="cta cta--secondary">
                        <i class="fas fa-<?php the_field('secondary_call_to_action_icon', 'option'); ?>"></i>
                        <?php the_field('secondary_call_to_action_text', 'option'); ?>
                    </a>
                <?php } ?>
            </div>

        </div>
    </div>
</section>
