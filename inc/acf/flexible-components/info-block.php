<section class="info-block">
    <div class="background-image" style="background-image: url(<?php the_sub_field( 'background_image' ) ?>);"></div>

    <div class="info-block__wrap info-block__wrap--<?php the_sub_field('position'); ?>">
        <div class="info-block__text">
            <div class="text-box">
                <h2><?php the_sub_field('header'); ?></h2>
                <p class="subheader"><?php the_sub_field('description'); ?></p>
            </div>
        </div>
    </div>

</section>
