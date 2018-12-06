<section class="call-to-action-alt">
    <div class="background-image" style="background-image: url(<?php the_sub_field( 'background_image' ) ?>);"></div>

    <div class="call-to-action-alt__wrap">
        <div class="call-to-action-alt__text">
            <div class="text-box">
                <h2><?php the_sub_field('header'); ?></h2>
                <p class="subheader"><?php the_sub_field('description'); ?></p>
            </div>
        </div>

        <div class="call-to-action-alt__buttons">
            <?php if(get_sub_field('display_primary_button')) { ?>
                <?php $primary_button = get_sub_field('custom_primary_button'); ?>
                <?php if($primary_button['override']) { ?>
                    <a href="<?php echo $primary_button['url']; ?>" class="cta cta--primary">
                        <i class="fas fa-<?php echo $primary_button['icon']; ?>"></i>
                        <?php echo $primary_button['label']; ?>
                    </a>
                <?php } else { ?>
                    <?php if(get_field('primary_call_to_action', 'option')) { ?>
                        <a href="<?php the_field('primary_call_to_action_url', 'option'); ?>" class="cta cta--primary">
                            <i class="fas fa-<?php the_field('primary_call_to_action_icon', 'option'); ?>"></i>
                            <?php the_field('primary_call_to_action_text', 'option'); ?>
                        </a>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

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
        </div>
    </div>

</section>
