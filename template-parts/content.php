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
        <div class="background-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
        <div class="text-box">
            <?php
            if ( is_singular() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

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

	<div class="entry-content block">
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
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
        <?php
        panda3d_entry_footer();
        the_post_navigation();
        ?>
	</footer> -->
</article>
