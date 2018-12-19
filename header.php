<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Panda3D
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Off Canvas Navigation -->
	<nav id="off-canvas-menu">
		<?php
			wp_nav_menu(array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			));
		?>
	</nav>

	<div id="off-canvas-overlay"></div>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'panda3d' ); ?></a>

		<header id="header" class="site-header">
			<div class="header-container">
				<div class="site-branding">
					<?php the_custom_logo(); ?>
				</div>

				<!-- Desktop Navigation -->
				<nav id="site-navigation" class="main-navigation">
					<?php
						wp_nav_menu(array(
							'theme_location' => 'primary-menu',
							'menu_id'        => 'primary-menu',
						));
					?>
					<button id="off-canvas-toggle"><i title="Menu" class="fas fa-bars"></i></button>
				</nav>

			</div>
		</header>

		<div id="content" class="site-content">
