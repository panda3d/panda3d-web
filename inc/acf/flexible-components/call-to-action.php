<div class="call-to-action">
    <div class="call-to-action__container">

        <div class="call-to-action__text">
            <h1><?php the_sub_field('header') ?></h1>
            <p class="subheader"><?php the_sub_field('description') ?></p>

            <div class="call-to-action__buttons">
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

        <div class="call-to-action__icon">
            <i class="far fa-box-open fa-10x"></i>
        </div>

    </div>
</div>
