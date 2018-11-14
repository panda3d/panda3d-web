<section class="choices">
    <div class="choices__container">

        <div class="choices__text">
            <h1><?php the_sub_field('header'); ?></h1>
            <p class="subheader"><?php the_sub_field('description'); ?></p>
        </div>

        <div class="choices__buttons">
            <?php if( have_rows('link_choices') ): while ( have_rows('link_choices') ) : the_row(); ?>
                <a class="cta cta--secondary" href="<?php the_sub_field('url') ?>"><i class="fas fa-<?php the_sub_field('icon') ?>"></i><?php the_sub_field('label') ?></a>
            <?php endwhile; endif; ?>
        </div>

    </div>
</section>
