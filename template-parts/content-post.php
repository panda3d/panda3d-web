<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Panda3D
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php panda3d_background_image() ?>
        <div class="text-box">
            <?php

            the_title( '<h1 class="entry-title">', '</h1>' );
            if ( 'post' === get_post_type() ) :
                ?>
                <p class="entry-meta subheader">
                    <?php
                    panda3d_posted_on();
                    panda3d_posted_by();
                    ?>
                </p>
            <?php endif; ?>
        </div>
	</header>

	<div class="entry-content">

        <div class="block">
            <?php
            the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'panda3d' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'panda3d' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>

        <?php get_sidebar(); ?>

    </div>

	<!-- <footer class="entry-footer">
        <?php
        panda3d_entry_footer();
        the_post_navigation();
        ?>
	</footer> -->
</article>
