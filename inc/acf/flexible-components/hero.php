<div class="hero">
    <div class="hero__wrap" style="background: linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3) ), url(<?php the_sub_field( 'background_image' ) ?>);">
        <div class="hero__content">

            <h1><?php the_sub_field('header') ?></h1>
            <p class="subheader"><?php the_sub_field('subheader') ?></p>

            <div class="hero__calltoaction">
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
</div>
