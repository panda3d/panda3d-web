<section class="brand-showcase">
    <div class="wrap">

        <div class="brand-showcase__logos">
            <?php $imgIndex = 0; ?>
            <?php if( have_rows('companies') ): while ( have_rows('companies') ) : the_row(); ?>
                <?php $imgIndex++; ?>
                <img class="img-<?php echo $imgIndex; ?>" src="<?php the_sub_field('company_logo') ?>" alt="<?php the_sub_field('company_name') ?>" />
            <?php endwhile; endif; ?>
        </div>

        <div class="brand-showcase__info">
            <h2><?php the_sub_field('header') ?></h2>
            <p class="subheader"><?php the_sub_field('description') ?></p>

            <a class="cta cta--secondary" href="#"><i class="fas fa-gamepad"></i> View Showcase</a>
        </div>

    </div>
</section>
