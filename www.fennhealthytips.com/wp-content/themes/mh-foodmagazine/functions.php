<?php

/***** Load Google Fonts *****/

function mh_foodmagazine_fonts() {
	wp_dequeue_style('mh-google-fonts');
	wp_enqueue_style('mh-foodmagazine-fonts', 'https://fonts.googleapis.com/css?family=ABeeZee:400,400italic%7cSarala:400,700', array(), null);
}
add_action('wp_enqueue_scripts', 'mh_foodmagazine_fonts', 11);

/***** Load Stylesheets *****/

function mh_foodmagazine_styles() {
    wp_enqueue_style('mh-magazine-lite', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('mh-foodmagazine', get_stylesheet_directory_uri() . '/style.css', array('mh-magazine-lite'), '1.0.6');
    if (is_rtl()) {
		wp_enqueue_style('mh-magazine-lite-rtl', get_template_directory_uri() . '/rtl.css');
		wp_enqueue_style('mh-foodmagazine-rtl', get_stylesheet_directory_uri() . '/rtl.css', array('mh-magazine-lite-rtl'));
	}
}
add_action('wp_enqueue_scripts', 'mh_foodmagazine_styles');

/***** Load Translations *****/

function mh_foodmagazine_theme_setup(){
	load_child_theme_textdomain('mh-foodmagazine', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'mh_foodmagazine_theme_setup');

/***** Change Defaults for Custom Colors *****/

function mh_foodmagazine_custom_colors() {
	remove_theme_support('custom-header');
	remove_theme_support('custom-background');
	add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => '4f4f4f', 'width' => 300, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
	add_theme_support('custom-background', array('default-color' => 'f2ffff'));
}
add_action('after_setup_theme', 'mh_foodmagazine_custom_colors');

/***** Remove Functions from Parent Theme *****/

function mh_foodmagazine_remove_parent_functions() {
    remove_action('mh_before_header', 'mh_magazine_boxed_container_open');
    remove_action('mh_after_footer', 'mh_magazine_boxed_container_close');
    remove_action('admin_menu', 'mh_magazine_lite_theme_info_page');
    remove_action('customize_controls_enqueue_scripts', 'mh_magazine_lite_customizer_js');
}
add_action('wp_loaded', 'mh_foodmagazine_remove_parent_functions');

/***** Enable Wide Layout *****/

function mh_foodmagazine_wide_container_open() {
	echo '<div class="mh-container mh-container-outer">' . "\n";
}
add_action('mh_after_header', 'mh_foodmagazine_wide_container_open');

function mh_foodmagazine_wide_container_close() {
	mh_before_container_close();
	echo '</div><!-- .mh-container-outer -->' . "\n";
}
add_action('mh_before_footer', 'mh_foodmagazine_wide_container_close');

?>