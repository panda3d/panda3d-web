<div class="calltoaction">
    <div class="calltoaction__container">

        <div class="calltoaction__text">
            <h2><?php the_sub_field('header') ?></h2>
            <p class="subheader"><?php the_sub_field('description') ?></p>
        </div>

        <div class="calltoaction__buttons">
            <?php if(get_field('secondary_call_to_action', 'option')) { ?>
                <a href="<?php the_field('secondary_call_to_action_url', 'option'); ?>" class="cta--secondary">
                    <?php the_field('secondary_call_to_action_text', 'option'); ?>
                </a>
            <?php } ?>

            <?php if(get_field('primary_call_to_action', 'option')) { ?>
                <a href="<?php the_field('primary_call_to_action_url', 'option'); ?>" class="cta--primary">
                    <?php the_field('primary_call_to_action_text', 'option'); ?>
                </a>
            <?php } ?>
        </div>

    </div>
</div>
