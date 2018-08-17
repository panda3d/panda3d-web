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
				<div class="footer__menu footer__menu--1">
					<h2>Test Menu 1</h2>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu-1',
						'menu_id'        => 'footer-menu-1',
					) );
					?>
				</div>
				<div class="footer__menu footer__menu--2">
					<h2>Test Menu 2</h2>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu-2',
						'menu_id'        => 'footer-menu-2',
					) );
					?>
				</div>
				<div class="footer__menu footer__menu--3">
					<h2>Test Menu 3</h2>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu-3',
						'menu_id'        => 'footer-menu-3',
					) );
					?>
				</div>
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
