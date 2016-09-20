<?php

/***** Load Google Fonts *****/

function mh_newsmagazine_fonts() {
	wp_dequeue_style('mh-google-fonts');
	wp_enqueue_style('mh-newsmagazine-fonts', 'https://fonts.googleapis.com/css?family=Sarala:400,700%7cAdamina:400', array(), null);
}
add_action('wp_enqueue_scripts', 'mh_newsmagazine_fonts', 11);

/***** Load Stylesheets *****/

function mh_newsmagazine_styles() {
    wp_enqueue_style('mh-magazine-lite', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('mh-newsmagazine', get_stylesheet_directory_uri() . '/style.css', array('mh-magazine-lite'), '1.0.6');
    if (is_rtl()) {
		wp_enqueue_style('mh-magazine-lite-rtl', get_template_directory_uri() . '/rtl.css');
		wp_enqueue_style('mh-newsmagazine-rtl', get_stylesheet_directory_uri() . '/rtl.css', array('mh-magazine-lite-rtl'));
	}
}
add_action('wp_enqueue_scripts', 'mh_newsmagazine_styles');

/***** Load Translations *****/

function mh_newsmagazine_theme_setup(){
	load_child_theme_textdomain('mh-newsmagazine', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'mh_newsmagazine_theme_setup');

/***** Remove Functions from Parent Theme *****/

function mh_newsmagazine_remove_parent_functions() {
    remove_action('admin_menu', 'mh_magazine_lite_theme_info_page');
    remove_action('customize_controls_enqueue_scripts', 'mh_magazine_lite_customizer_js');
}
add_action('wp_loaded', 'mh_newsmagazine_remove_parent_functions');

?>