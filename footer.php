<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Panda3D
 */

?>

	</div><!-- #content -->

	<footer id="footer" class="site-footer">
		<div class="wrap">
			<div class="footer__navigation">
				<?php
				// Cycle through theme locations to retrieve custom menu and title
				$locations = get_nav_menu_locations();
				$footer_locations = array('footer-menu-1', 'footer-menu-2', 'footer-menu-3');
				?>
				<?php foreach($footer_locations as $location) { ?>
					<div class="footer__menu">
						<?php $menu_id = $locations[$location]; ?>
						<h2><?php $nav_menu = wp_get_nav_menu_object($menu_id); echo $nav_menu->name; ?></h2>
						<?php
						wp_nav_menu( array(
							'theme_location' => $location,
							'menu_id'        => $location,
						) );
						?>
					</div>
				<?php } ?>

				<div class="footer__social">
					<div class="footer__textblock">
						<i class="fal fa-comment-alt-dots fa-flip-horizontal fa-5x"></i>
						Want to chat with other developers, or ask questions about Panda3D? Join our IRC channel: <a target="_blank" href="irc://irc.freenode.net/panda3d">#panda3d</a> on <a target="_blank" href="https://freenode.net/">FreeNode</a>.
					</div>
					<?php if(have_rows('social_icons', 'option')): ?>
						<?php while(have_rows('social_icons', 'option')): the_row(); ?>
							<a href="<?php the_sub_field('social_url'); ?>" target="_blank"><i title=""<?php the_sub_field('social_name'); ?>" class="fab fa-<?php the_sub_field('social_icon'); ?> fa-3x"></i></a>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>

			<div class="footer__copyright">
                <?php
                $date_start = get_field('copyright_year', 'option');
                $date_current = date("Y");
                if(strcmp($date_start, $date_current) == 0) {
                    $date_string = $date_start;
                } else {
                    $date_string = $date_start . '-' . $date_current;
                }
                ?>
				<span>© <?php echo $date_string; ?> <a href="<?php the_field('copyright_url', 'option'); ?>" target="_blank"><?php the_field('copyright_holder', 'option'); ?></a></span>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
