<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Panda3D
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php panda3d_background_image(); ?>
        <div class="text-box">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

            <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php
                panda3d_posted_on();
                panda3d_posted_by();
                ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>
        </div>
	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php panda3d_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
