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
			</div>

			<div class="site-info">
				<span>© 2010-<?php echo date("Y"); ?> Carnegie Mellon University</span>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
