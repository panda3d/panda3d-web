<section class="feature-images">
    <div class="feature-images__outer">

        <div class="wrap">
            <h2><?php the_sub_field('header') ?></h2>
            <p class="subheader"><?php the_sub_field('subheader') ?></p>
        </div>

        <div class="feature-images__inner">
            <?php if( have_rows('feature_images') ): while ( have_rows('feature_images') ) : the_row(); ?>
                <div class="feature-images__item">
                    <div class="feature-images__image">
                        <img src="<?php the_sub_field('image'); ?>" />
                    </div>
                    <div class="feature-images__text">
                        <h3><?php the_sub_field('title'); ?></h3>
                        <p><?php the_sub_field('description'); ?></p>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>

    </div>
</section>
