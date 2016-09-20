<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package coral-dark
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
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'coral-dark' ); ?></a>

	<header id="masthead" class="site-header grid-container" role="banner">
		<div class="site-branding egrid <?php coral_dark_logo_class(); ?>">
			<?php if (get_theme_mod('custom_logo')) : ?>
				<?php coral_dark_the_custom_logo(); ?>
			<?php else: ?>
				<?php if (is_front_page()) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2> 			
				<?php else: ?>
					<h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
					<h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
				<?php endif; ?>	
			<?php endif; ?>				
		</div><!-- .site-branding -->
		<div id="headerright" class="grid-parent egrid <?php coral_dark_header_right_class(); ?>">
			
			<div id="social1" class="egrid <?php coral_dark_social_class(); ?>">
			<?php 
				$youtubeurl = get_theme_mod('coral_dark_youtube_url_setting');
				$feedurl = get_theme_mod('coral_dark_feed_url_setting');
				$twitterurl = get_theme_mod('coral_dark_twitter_url_setting');
				$googleurl = get_theme_mod('coral_dark_google_url_setting');
				$facebookurl = get_theme_mod('coral_dark_facebook_url_setting');
			?>
			<?php if($facebookurl) : ?>
				<a target="_blank" class="myfacebook" href="<?php echo esc_url($facebookurl); ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
			<?php endif; ?>
			<?php if($googleurl) : ?>
				<a target="_blank" class="mygoogle" href="<?php echo esc_url($googleurl); ?>" title="Google"><i class="fa fa-google-plus"></i></a>
			<?php endif; ?>
			<?php if($twitterurl) : ?>
				<a target="_blank" class="mytwitter" href="<?php echo esc_url($twitterurl); ?>" title="Twitter"><i class="fa fa-twitter"></i></a>
			<?php endif; ?>
			<?php if($feedurl) : ?>
				<a target="_blank" class="myfeed" href="<?php echo esc_url($feedurl); ?>" title="Feed"><i class="fa fa-rss"></i></a>
			<?php endif; ?>
			<?php if($youtubeurl) : ?>
				<a target="_blank" class="myyoutube" href="<?php echo esc_url($youtubeurl); ?>" title="Youtube"><i class="fa fa-youtube"></i></a>
			<?php endif; ?>
			</div>
			
			<div id="search1" class="search <?php coral_dark_search_class(); ?>">
				<?php get_search_form(); ?>
			</div>
		</div>

		<nav id="site-navigation" class="main-navigation egrid grid-100 tablet-grid-100 mobile-grid-100" role="navigation">
			<i id="menu-button" class="fa fa-bars collapsed"><span><?php _e( '  Menu', 'coral-dark' ); ?></span></i>
			<?php 
			if (!is_rtl()) {
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'main-menu', 'menu_class' => 'sm sm-clean collapsed' ) );
				} else {
					wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb'  => 'coral_dark_wp_page_menu_mine' ) ); 
				}
			} else {
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'main-menu', 'menu_class' => 'sm sm-rtl sm-clean collapsed' ) );
				} else {
					wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb'  => 'coral_dark_wp_page_menu_mine' ) );
				}	
			}
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php do_action( 'coral_dark_slider' ); ?>	
<!-- breadcrumbs from Yoast or NavXT plugins -->
	<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
	<div id="breadcrumbs" class="grid-container">
		<div class="breadcrumbs grid-100 tablet-grid-100 mobile-grid-100">
			<?php yoast_breadcrumb(); ?>
		</div>
	</div>
	<?php elseif (function_exists('bcn_display')) : ?>
	<div id="breadcrumbs" class="grid-container">
		<div class="breadcrumbs grid-100 tablet-grid-100 mobile-grid-100" xmlns:v="http://rdf.data-vocabulary.org/#">
			<?php bcn_display(); ?>
		</div>
	</div>
	<?php endif; ?>
	
	<div id="content" class="site-content grid-container">
