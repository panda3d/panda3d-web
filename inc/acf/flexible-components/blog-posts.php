<?php
    $blog_category = get_sub_field('blog_category');

    $args = array(
        'post_type'      => 'post',
        'category_name'  => $blog_category,
        'posts_per_page' => 4
    );

    $loop = new WP_Query( $args );
?>

<section class="blog-posts">
    <div class="wrap">

        <div class="blog-section-header">
            <h2><?php the_sub_field('header'); ?></h2>

            <div class="blog-posts__more">
                <?php if ($news_category === '') { ?>
                    <a href="/news/" class="cta cta--action">All Posts</a>
                <?php } else { ?>
                    <a href="/category/<?php echo $selected_category; ?>" class="cta cta--action">View More</a>
                <?php } ?>
            </div>
        </div>

        <div class="article__container">

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="article">
                    <a href="<?php the_permalink(); ?>">
                        <div class="article__image" style="background-image: url('<?php the_post_thumbnail_url('large'); ?>');"></div>
                        <div class="article__info">
                            <span class="date"><?php the_date('F j, Y'); ?></span>
                            <h2 class="title"><?php the_title(); ?></h2>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>

        </div>

    </div>
</section>

<?php
wp_reset_postdata();
