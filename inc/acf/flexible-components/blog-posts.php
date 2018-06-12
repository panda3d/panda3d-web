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
            <h1><?php the_sub_field('header'); ?></h1>

            <div class="blog-posts__more">
                <?php if ($news_category === '') { ?>
                    <a href="/news/" class="cta--action">All Posts</a>
                <?php } else { ?>
                    <a href="/category/<?php echo $selected_category; ?>" class="cta--action">View More News</a>
                <?php } ?>
            </div>
        </div>

        <div class="article__container">

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="article">
                    <a href="<?php the_permalink(); ?>">
                        <div class="article__image" style="background-image: url('<?php the_post_thumbnail_url('large'); ?>');"></div>
                        <div class="article__info">
                            <div class="article__title">
                                <h3><?php the_title(); ?></h3>
                            </div>
                            <div class="article__details">
                                <span><?php the_author(); ?> - <i><?php the_date('M j Y'); ?></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>

        </div>

    </div>
</section>

<?php
wp_reset_postdata();
