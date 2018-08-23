<section class="plan">
    <div class="plan__outer">

        <h1><?php the_sub_field('header') ?></h1>
        <p><?php the_sub_field('subheader') ?></p>

        <div class="plan__inner">
            <?php if ( have_rows('steps') ) : ?>
                <?php while( have_rows('steps') ) : the_row(); ?>
                    <div class="plan__feature">
                        <i class="fa <?php the_sub_field('icon') ?>" aria-hidden="true"></i>
                        <div>
                            <p class="item__title"><?php the_sub_field('title') ?></p>
                            <p class="item__desc"><?php the_sub_field('description') ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="plan__calltoaction">
            <?php if(get_field('secondary_call_to_action', 'option')) { ?>
                <a href="<?php the_field('secondary_call_to_action_url', 'option'); ?>" class="cta cta--secondary">
                    <?php the_field('secondary_call_to_action_text', 'option'); ?>
                </a>
            <?php } ?>

            <?php if(get_field('primary_call_to_action', 'option')) { ?>
                <a href="<?php the_field('primary_call_to_action_url', 'option'); ?>" class="cta cta--primary">
                    <?php the_field('primary_call_to_action_text', 'option'); ?>
                </a>
            <?php } ?>
        </div>

    </div>
</section>
