<section class="call-to-action">
    <div class="call-to-action__container">

        <div class="call-to-action__text">
            <h2><?php the_sub_field('header'); ?></h2>
            <p><?php the_sub_field('description'); ?></p>

            <div class="call-to-action__buttons">
                <?php if(get_sub_field('display_secondary_button')) { ?>
                    <?php $secondary_button = get_sub_field('custom_secondary_button'); ?>
                    <?php if($secondary_button['override']) { ?>
                        <a href="<?php echo $secondary_button['url']; ?>" class="cta cta--secondary">
                            <i class="fas fa-<?php echo $secondary_button['icon']; ?>"></i>
                            <?php echo $secondary_button['label']; ?>
                        </a>
                    <?php } else { ?>
                        <?php if(get_field('secondary_call_to_action', 'option')) { ?>
                            <a href="<?php the_field('secondary_call_to_action_url', 'option'); ?>" class="cta cta--secondary">
                                <i class="fas fa-<?php the_field('primary_call_to_action_icon', 'option'); ?>"></i>
                                <?php the_field('secondary_call_to_action_text', 'option'); ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>

                <?php if(get_sub_field('display_primary_button')) { ?>
                    <?php $primary_button = get_sub_field('custom_primary_button'); ?>
                    <?php if($primary_button['override']) { ?>
                        <a href="<?php echo $primary_button['url']; ?>" class="cta cta--primary">
                            <i class="fas fa-<?php echo $primary_button['icon']; ?>"></i>
                            <?php echo $primary_button['label']; ?>
                        </a>
                    <?php } else { ?>
                        <?php if(get_field('primary_call_to_action', 'option')) { ?>
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

                            <a class="cta cta--primary-ver" href="<?php echo get_permalink($latest_id); ?>">
                                <span class="cta-ver"><?php echo $latest_version; ?></span>
                                <span class="cta-text">
                                    <i class="fas fa-<?php the_field('primary_call_to_action_icon', 'option'); ?>"></i>
                                    <?php the_field('primary_call_to_action_text', 'option'); ?>
                                </span>
                            </a>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>

        </div>

        <div class="call-to-action__icon">
            <i class="far fa-<?php the_sub_field('icon'); ?>"></i>
        </div>

    </div>
</section>
