<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Myth
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="background-image custom-background" style="background-image:url(<?php echo get_background_image(); ?>)"></div>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'myth' ); ?></a>

	<div id="hidden-header" class="hidden" style="display:none;">
		<nav id="mobile-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Mobile Navigation', 'myth' ); ?>">
			<div class="menu-title"><h1><?php _e( 'Menu', 'myth' ); ?></h1></div>
			<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>

			<div id="mobile-search" class="search-container">
				<?php get_search_form(); ?>
			</div><!-- #mobile-search -->
		</nav><!-- #site-navigation -->

		<div id="desktop-search" class="search-container">
			<?php get_search_form(); ?>
		</div><!-- #desktop-search -->
	</div><!-- #hidden-header -->

	<header id="masthead" class="site-header" role="banner">
		<div id="header-top" class="site-header-inner">
			<div class="site-branding">
				<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div><!-- .site-branding -->

			<div class="social-top">
				<?php if ( has_nav_menu( 'social' ) ) { get_template_part( 'template-parts/navigation-social' ); } ?>
			</div><!-- .social-top -->

			<div class="menu-toggle-container">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="toggle-text"><?php esc_html_e( 'Menu', 'myth' ); ?></span>
					<span class="toggle-lines" aria-hidden="true"></span>
				</button>
			</div><!-- .menu-toggle-container -->
		</div><!-- #header-top -->

		<div id="header-middle" class="site-header-inner">
			<?php if ( get_header_image() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
			</a>
			<?php endif; // End header image check. ?>
		</div><!-- #header-middle -->

		<div id="header-bottom" class="site-header-inner">
			<nav id="desktop-navigation" class="main-navigation" role="navigation">
				<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>
			</nav><!-- #desktop-navigation -->
			<button class="search-toggle">
				<span class="search-text"><?php _e('Search...', 'myth'); ?></span>
				<span class="genericon genericon-search" aria-hidden="true"></span>
			</button>
		</div><!-- #header-bottom -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
