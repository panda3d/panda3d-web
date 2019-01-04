<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Panda3D
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if (have_posts()) { ?>

			<header class="archive__header">

                <?php if (is_home()) { ?>
                    <h1 class="page-title">Latest Blog Posts</h1>
                <?php } else { ?>
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                <?php } ?>
			</header>

            <div class="archive__content">
                <?php while (have_posts()) { ?>
                    <?php the_post(); ?>

                    <div class="archive__item block">
                        <?php
                        if ( has_post_thumbnail() ) {
                            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        } else {
                            $thumbnail_url = get_field('default_post_thumbnail', 'option');
                        }
                        ?>
                        <a class="article__image" style="background-image: url('<?php echo $thumbnail_url; ?>');" href="<?php the_permalink(); ?>"></a>
                        <div class="article__info">
                            <span class="date"><?php the_date() ?></span>
                           <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
                            <p class="summary"><?php echo get_the_excerpt() ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

			<?php the_posts_navigation(); ?>
        <?php } ?>

		</main>
	</div>

<?php
get_footer();
