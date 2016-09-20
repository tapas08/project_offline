<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Level
 */

get_header(); ?>
<div class="row">
 <?php
 if(get_theme_mod('website_layout')=='rightside'){
	 get_template_part('/layouts/right-page');
 }
 elseif (get_theme_mod('website_layout')=='left'){
	 get_template_part('/layouts/left-page');
 }
 elseif (get_theme_mod('website_layout')=='full'){
	 get_template_part('/layouts/full-page');
 } 
 else {
	 get_template_part('/layouts/right-page');
 }

 
 ?>
<?php get_footer(); ?>
