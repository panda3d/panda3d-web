<section class="hero">
    <div class="hero__wrap" style="background-image: url(<?php the_sub_field( 'background_image' ) ?>);">
        <div class="hero__content">

            <h1><?php the_sub_field('header') ?></h1>

            <div class="hero__calltoaction">
                <?php if(get_field('primary_call_to_action', 'option')) { ?>
                    <a href="<?php the_field('primary_call_to_action_url', 'option'); ?>" class="cta--primary">
                        <i class="fas fa-<?php the_field('primary_call_to_action_icon', 'option'); ?>"></i>
                        <?php the_field('primary_call_to_action_text', 'option'); ?>
                    </a>
                <?php } ?>

                <?php if(get_field('secondary_call_to_action', 'option')) { ?>
                    <a href="<?php the_field('secondary_call_to_action_url', 'option'); ?>" class="cta--secondary">
                        <i class="fas fa-<?php the_field('secondary_call_to_action_icon', 'option'); ?>"></i>
                        <?php the_field('secondary_call_to_action_text', 'option'); ?>
                    </a>
                <?php } ?>
            </div>

        </div>
    </div>
</section>
