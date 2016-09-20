<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Level
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
    
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'level' ); ?></a>
	<?php get_template_part( 'template-parts/top'); ?>
<div class="header-area"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></div>

	<div id="content" class="site-content">
	
	<?php if ( is_active_sidebar( 'below-navi' ) ) { ?>
	 <div class="medium-12 columns">
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'below-navi' ); ?>
</div><!-- #secondary -->
</div>
<?php } ?>