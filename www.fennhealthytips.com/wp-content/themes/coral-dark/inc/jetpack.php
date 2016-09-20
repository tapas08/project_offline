<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package coral-dark
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function coral_dark_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'coral_dark_jetpack_setup' );
