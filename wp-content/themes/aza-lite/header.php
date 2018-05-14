<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package aza-lite
 */

$preloader_toggle = get_theme_mod('aza_preloader_toggle','1');
$preloader_type = get_theme_mod('aza_preloader_type','1');
$aza_buttons_type = get_theme_mod ('aza_header_buttons_type','normal_buttons');
$aza_sticky_navbar = get_theme_mod('aza_sticky_navbar', false);
if( (bool) $aza_sticky_navbar === true ) {
	$class_to_add = "sticky-navbar";
} else {
	$class_to_add = "";
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="fixedbg"></div>

<?php if( ( $preloader_toggle )&& ( ! is_customize_preview() ) ) { ?>

	<div id="loader-wrapper">
		<div id="loader">

			<?php

			switch ( $preloader_type ) {
				case '1': ?>
					<div class="sk-rotating-plane"></div>
					<?php break;
				case '2': ?>
					<div class="sk-three-bounce">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
					<?php
					break;
				case '3': ?>
					<div class="sk-folding-cube">
						<div class="sk-cube1 sk-cube"></div>
						<div class="sk-cube2 sk-cube"></div>
						<div class="sk-cube4 sk-cube"></div>
						<div class="sk-cube3 sk-cube"></div>
					</div>
					<?php
					break;
				case '4': ?>
					<div class="spinner">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>
					<?php
					break;
			}
			?>
		</div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>

<?php } ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'aza-lite' ); ?></a>

<!-- =========================
 SECTION: HOME / HEADER
============================== -->
<!--header-->
<header itemscope itemtype="http://schema.org/WPHeader" id="masthead" role="banner" class="header site-header">
	<div class="overlay-layer-nav">
		<div class="navbar <?php if( ! empty( $class_to_add ) ) { echo esc_attr( $class_to_add ); } ?>">
			<div class="container">
				<div class="navbar-header">
					<!-- LOGO -->
					<button title='<?php _e( 'Toggle Menu', 'aza-lite' ); ?>' aria-controls='menu-main-menu' aria-expanded='false' type="button" class="navbar-toggle menu-toggle" id="menu-toggle" data-toggle="collapse" data-target="#menu-primary">
						<span class="screen-reader-text"><?php esc_html_e('Toggle navigation','aza-lite'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						$website_logo_id = get_theme_mod( 'custom_logo' );
						$website_logo_meta = wp_get_attachment_image_src($website_logo_id, 'full');
						$website_logo = $website_logo_meta[0];
					} else {
						$website_logo = get_theme_mod('aza_logo', get_template_directory_uri() . '/images/logo.png' );
					}
					if(!empty($website_logo)) {

						echo '<div class="navbar-brand-wrapper">';

						echo '<a href="'.esc_url( home_url( '/' ) ).'" class="navbar-brand vert-align" title="'.get_bloginfo('title').'">';

						echo '<img src="'.esc_url($website_logo).'" alt="'.get_bloginfo('title').'">';

						echo '</a>';

						echo '</div>';

					} elseif( (bool) display_header_text() == true ) {

						echo '<div class="title-tagline-wrapper">';

						echo '<div class="header-logo-wrap vert-align">';

						echo '<h1 id="site-title" class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';

						echo '<p id="site-description" class="site-description">'.get_bloginfo( 'description' ).'</p>';

						echo '</div>';

						echo '</div>';

					}

					?>

				</div>

				<!-- MENU -->
				<div itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_html_e('Primary Menu','aza-lite') ?>" id="menu-primary" class="navbar-collapse collapse">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php
						wp_nav_menu( array(
							'menu'            => esc_html__( 'Primary Menu', 'baicus' ),
							'theme_location'  => 'primary',
							'depth'           => 2,
							'menu_class'      => 'nav navbar-nav',
							'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
							'walker'          => new wp_bootstrap_navwalker(),
						) );
						?>
					</nav>
				</div>


			</div>
			<!-- /END CONTAINER -->
		</div>
		<!-- /END STICKY NAVIGATION -->
