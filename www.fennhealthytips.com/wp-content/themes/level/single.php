<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Level
 */

get_header(); ?>
 <div class="row">
 <?php
 if(get_theme_mod('website_layout')=='rightside'){
	 get_template_part('/layouts/right-single');
 }
 elseif (get_theme_mod('website_layout')=='left'){
	 get_template_part('/layouts/left-single');
 }
 elseif (get_theme_mod('website_layout')=='full'){
	 get_template_part('/layouts/full-single');
 } 
 else {
	 get_template_part('/layouts/right-single');
 }

 
 ?>
<?php get_footer(); ?>
