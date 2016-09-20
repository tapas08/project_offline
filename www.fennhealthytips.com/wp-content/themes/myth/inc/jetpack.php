<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Myth
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function myth_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'type'		=> 'click',
		'container' => 'main',
		'render'    => 'myth_infinite_scroll_render',
		'footer'    => 'page',
	) );

	/**
	 * Add theme support for Responsive Videos.
	 */
	add_theme_support( 'jetpack-responsive-videos' );

	// Declare theme support for Site Logo.
	add_theme_support( 'site-logo', array() );

} // end function myth_jetpack_setup
add_action( 'after_setup_theme', 'myth_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function myth_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function myth_infinite_scroll_render
