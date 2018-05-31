<div class="curvable features">
  <div class="features__outer">

    <h1><?php the_sub_field('header') ?></h1>
    <p><?php the_sub_field('subheader') ?></p>

    <div class="features__inner">
        <?php if( have_rows('features') ): while ( have_rows('features') ) : the_row(); ?>

            <div class="features__item">
                <i class="fa <?php the_sub_field('icon'); ?>" aria-hidden="true"></i>
                <div>
                    <p class="item__title"><?php the_sub_field('title'); ?></p>
                    <p class="item__desc"><?php the_sub_field('description'); ?></p>
                </div>
            </div>

        <?php endwhile; else : endif; ?>
    </div>

  </div>
</div>
