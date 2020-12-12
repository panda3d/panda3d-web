<?php
/**
 * The template for displaying download lists.
 *
 * @package Panda3D
 */
?>

<h1>All Versions</h1>
<ul class="archive-download__list block">
    <li>
        <span class="title">Version</span>
        <span class="date">Release Date</span>
    </li>
    <?php
    /* Start the Loop */
    while ( have_posts() ) :
        the_post();

        $release_date = date_i18n(get_option('date_format'), strtotime(get_field('release_date')));
        ?>
        <a href="<?php echo get_permalink(); ?>">
            <li>
                <span class="title"><?php the_title(); ?></span>
                <span class="date"><?php the_date(); ?></span>
            </li>
        </a>
        <?php
    endwhile;
    ?>
</ul>
<?php
the_posts_navigation();
